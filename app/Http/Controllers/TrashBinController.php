<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\TrashBin;
use Yajra\DataTables\DataTables;

class TrashBinController extends Controller
{
	public function showAll()
	{
		$bins = TrashBin::all();
		return response()->json(['trashBins' => $bins]);
	}

	public function show($id)
	{
		$bin = TrashBin::find($id);

		if (!$bin) {
			return response()->json(['message' => 'Trash Bin Tidak Ditemukan!'], 404);
		}

		return response()->json(['trashBin' => $bin]);
	}

	public function getTrashBins(Request $request)
	{
		if ($request->ajax()) {
			$bins = DB::table('trash_bins')
			->leftJoin('users as residents', 'trash_bins.resident_id', '=', 'residents.id')
			->leftJoin('schedules', 'trash_bins.id', '=', 'schedules.trash_bin_id')
			->leftJoin('users as collectors', 'schedules.collector_id', '=', 'collectors.id')
			->select(
				'trash_bins.*',
				'residents.name as resident',
				'collectors.name as collector'
			)
			->get();

			return DataTables::of($bins)
				->addIndexColumn()
				->addColumn('collector', function($bin) {
					return $bin->collector;
				})
				->addColumn('resident', function($bin) {
					return $bin->resident;
				})
				->addColumn('actions', function ($bin) {
					$btn = '<div class="flex items-center gap-2 justify-center">';
					$btn .= '
						<button id="editTrashBin" type="button" class="w-6 h-6 edit-button cursor-pointer" data-id="' . $bin->id . '" data-resident="' . $bin->resident_id . '" data-status="' . $bin->status . '" data-type="' . $bin->bin_type . '" data-latitude="' . $bin->latitude . '" data-longitude="' . $bin->longitude . '" data-capacity="' . $bin->capacity . '" data-url="' . route('trash_bins.update', ['id' => $bin->id]) . '">
							<img src="' . asset('icons/edit.svg') . '" alt="Edit" class="w-full h-full object-contain">
						</button>
					';
					$btn .= '
						<button id="deleteTrashBin" data-id="' . $bin->id . '" class="w-6 h-6 cursor-pointer"
						data-url="' . route('trash_bins.delete', ['id' => $bin->id]) . '">
							<img src="' . asset('icons/delete.svg') . '" alt="Delete" class="w-full h-full object-contain">
						</button>';
					return $btn;
				})
				->editColumn('status', function ($bin) {
					if ($bin->status == 'collected') {
						return '<p class="w-6 h-6"><img src="'. asset('icons/check.svg') .'" alt="Status" class="w-full h-full object-contain"></p>';
					} else {
						return '<p class="w-6 h-6"><img src="'. asset('icons/cancel.svg') .'" alt="Status" class="w-full h-full object-contain"></p>';
					}
				})
				->rawColumns(['actions', 'status'])
				->make(true);
		}

		abort(403);
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'resident_id' => 'required|integer',
			'bin_type' => ['required', Rule::in(TrashBin::BIN_TYPES)],
			'latitude' => ['required', 'numeric', 'between:-90,90'],
			'longitude' => ['required', 'numeric', 'between:-180,180'],
			'capacity' => 'required|numeric',
		]);

		$bin = TrashBin::create($request->all());

		return response()->json([
			'title' => 'Berhasil!',
			'status' => 'success',
			'message' => 'Tempat sampah ditambahkan!',
			'bin' => $bin
		]);
	}

	public function update(Request $request, $id)
	{
		$bin = TrashBin::find($id);

		if (!$bin) {
			return response()->json(['message' => 'Trash Bin Tidak Ditemukan!'], 404);
		}

		$validated = $request->validate([
			'resident_id' => 'required|integer',
			'bin_type' => ['required', Rule::in(TrashBin::BIN_TYPES)],
			'latitude' => ['required', 'numeric', 'between:-90,90'],
			'longitude' => ['required', 'numeric', 'between:-180,180'],
			'capacity' => 'required|numeric',
		]);

		$bin->update($validated);

		return response()->json([
			'title' => 'Berhasil!',
			'status' => 'success',
			'message' => 'Tempat sampah diperbarui!',
			'bin' => $bin
		]);
	}

	public function destroy($id)
	{
		$bin = TrashBin::find($id);

		if (!$bin) {
			return response()->json([
				'title' => 'Gagal!',
				'status' => 'fail',
				'message' => 'Tempat sampah tidak ditemukan!'
			]);
		}

		$bin->delete();

		return response()->json([
			'title' => 'Berhasil!',
			'status' => 'success',
			'message' => 'Tempat sampah dihapus!'
		]);
	}
}
