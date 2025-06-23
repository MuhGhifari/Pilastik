<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
	public function showAll()
	{
		$users = User::all();
		return response()->json(['users' => $users]);
	}

	public function show($id)
	{
		$user = User::find($id);

		if (!$user) {
			return response()->json(['message' => 'User Tidak Ditemukan!'], 404);
		}

		return response()->json(['user' => $user]);
	}

	public function getUsers(Request $request)
	{
		if ($request->ajax()) {
			$users = User::all();

			return DataTables::of($users)
				->addIndexColumn()
				->addColumn('actions', function ($user) {
					$btn = '<div class="flex items-center gap-2 justify-center">';
					$btn .= '
						<button id="editUser" type="button" class="w-6 h-6 edit-button cursor-pointer" data-id="' . $user->id . '" data-name="' . $user->name . '" data-email="' . $user->email . '" data-role="' . $user->role . '" data-phone="' . $user->phone . '" data-dob="' . $user->date_of_birth . '" data-url="'. route('users.update', ['id' => $user->id]) .'">
							<img src="' . asset('icons/edit.svg') . '" alt="Edit" class="w-full h-full object-contain">
						</button>
					';
					$btn .= '
						<button id="deleteUser" data-id="'. $user->id .'" class="w-6 h-6 cursor-pointer"
						data-url="'. route('users.delete', ['id' => $user->id]) .'">
							<img src="' . asset('icons/delete.svg') . '" alt="Delete" class="w-full h-full object-contain">
						</button>';
					return $btn;
				})
				->editColumn('role', function ($user) {
					return ucfirst($user->role);
				})
				->rawColumns(['actions'])
				->make(true);
		}

		abort(403);
	}

	public function store(Request $request)
	{
		$request->password = bcrypt($request->date_of_birth);
		$validated = $request->validate([
			'name' => 'required|string',
			'email' => 'required|email|unique:users,email',
			'role' => ['required', Rule::in(User::ROLES)],
			'phone' => 'required|string',
			'date_of_birth' => 'required|date'
		]);

		$rawPassword = Carbon::parse($validated['date_of_birth'])->format('dmY');
		$validated['password'] = bcrypt($rawPassword);

		$user = User::create($validated);

		return response()->json([
			'title' => 'Berhasil!',
			'status' => 'success',
			'message' => 'User berhasil ditambahkan!',
			'user' => $user
		]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|max:255|unique:users,email,' . $id,
			'password' => 'nullable|string|min:8',
			'role' => ['required', Rule::in(User::ROLES)],
			'phone' => 'required|string',
			'date_of_birth' => 'required|date'
		]);

		$user = User::findOrFail($id);

		$user->name = $request->name;
		$user->email = $request->email;
		$user->role = $request->role;
		$user->phone = $request->phone;
		$user->phone = $request->date_of_birth;

		if ($request->filled('password')) {
			$user->password = Hash::make($request->password);
		}

		$user->save();
		
		return response()->json([
			'title' => 'Berhasil!',
			'status' => 'success',
			'message' => 'User berhasil diperbarui!',
			'user' => $user
		]);
	}

	public function destroy($id)
	{
		$user = User::find($id);

		if (!$user) {
			return response()->json(['message' => 'User Tidak Ditemukan!'], 404);
		}

		$user->delete();

		return response()->json([
			'title' => 'Berhasil!',
			'status' => 'success',
			'message' => 'User berhasil dihapus!'
		]);
	}
}
