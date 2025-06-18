@extends('admin.layouts.app')

@section('styles')
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
		integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

	<!-- DataTables CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

	<!-- DataTables + jQuery -->
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
	<div class="content flex flex-col w-full gap-8 py-8 px-10 flex-1">
		<div class="flex gap-8 w-full items-center justify-center">
			<div class="w-2/3">
				<x-display>Peta Tempat Sampah Warga</x-display>
				<x-breadcrumb>
					Admin &gt; <span class="text-black">Tempat Sampah Warga</span>
				</x-breadcrumb>
			</div>
			<div class="w-1/3">
				<img src="{{ asset('images/logo-fill.png') }}" alt="Pilastik Logo" class="w-auto h-20 ml-auto">
			</div>
		</div>
		<div class="flex flex-1 gap-8 w-full">
			<div class="w-1/2">
				<div class="flex flex-col w-full h-full gap-8">
					<x-map id="map"></x-map>
				</div>
			</div>
			<div class="flex flex-col w-1/2 h-full gap-8">
				<x-card class="h-auto gap-4">
					<div class="w-35 h-35 bg-secondary rounded-2xl overflow-hidden">
						<img src="{{ asset('images/rina-pp.png') }}" alt="Profile Picture" class="w-full h-full object-cover">
					</div>
					<div class="flex-1">
						<div class="relative">
							<h2 class="text-4xl font-helvetica font-bold">Rina</h2>
							<h3 class="text-secondary-dark text-lg font-helvetica">ID #<span class="font-bold">92834</span></h3>
							<span
								class="absolute top-0 right-0 bg-tennis-light px-4 py-1 rounded-full text-forest font-coolvetica font-base text-xl">
								Sudah Diambil
							</span>
						</div>
						<div class="mt-3 text-base text-secondary-dark">
							<p class="flex items-center gap-2">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-secondary-dark" fill="none"
									viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M3 5h2l3.6 7.59a1 1 0 01-.1.91l-1.35 2.44a1 1 0 00.9 1.5H19" />
								</svg>
								+62 0092 8236 2837
							</p>
							<p class="flex items-center gap-2 mt-1">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-secondary_dark" fill="none"
									viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M17.657 16.657L13.414 12l4.243-4.243M6.343 7.343L10.586 12l-4.243 4.243" />
								</svg>
								Lebak Pilar RT 02/04, Desa Bendungan, Kota Bogor
							</p>
						</div>
					</div>
				</x-card>
				<x-card class="flex-1 flex-col">
					<!-- Filter & Search -->
					<div class="flex items-center gap-4 mb-4">
						<h2 class="text-xl font-coolvetica text-forest m-0 p-0">Data Tempat Sampah</h2>
						<a href="{{ route('admin.add.trash_bin') }}"
							class="bg-green-700 text-white px-6 py-2 rounded-full font-semibold">+ Tambah</a>
						<div class="ml-auto relative">
							<input type="text" id="searchBox" class="rounded-full border px-4 py-1 pl-10 text-gray-600"
								placeholder="Pencarian">
							<svg class="absolute left-3 top-2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
								viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 7.65a7.5 7.5 0 014.35 4.35z" />
							</svg>
						</div>
					</div>

					<!-- Table -->
					<table id="residentTable" class="w-full text-sm text-left">
						<thead class="bg-green-200 text-green-900 font-semibold">
							<tr>
								<th class="px-4 py-2">No</th>
								<th class="px-4 py-2">Pemilik</th>
								<th class="px-4 py-2">Diambil</th>
								<th class="px-4 py-2">Kolektor</th>
								<th class="px-4 py-2">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@php
								$i = 0;
							@endphp
							@foreach ($trashBins as $bin)
								<tr class="hover:bg-gray-100">
									<td class="px-4 py-2">{{++$i}}</td>
									<td class="px-4 py-2">{{$bin->resident?->name}}</td>
									<td class="px-4 py-2 text-center">
										<p class="w-6 h-6">
											<img src="{{ asset('icons/check.svg') }}" alt="Edit" class="w-full h-full object-contain">
									</td>
									</p>
									<td class="px-4 py-2">{{$bin->schedule?->collector?->name}}</td>
									<td class="px-4 py-2 text-center">
										<div class="flex items-center gap-2 justify-center">
											<a href="{{ route('admin.edit.trash_bin', ['id' => $bin->id]) }}" class="w-6 h-6">
												<img src="{{ asset('icons/edit.svg') }}" alt="Edit" class="w-full h-full object-contain">
											</a>

											<form action="{{ route('trash_bin.delete', ['id' => $bin->id]) }}" method="POST"
												class="inline delete-form">
												@csrf
												@method('DELETE')
												<button type="submit" class="w-6 h-6">
													<img src="{{ asset('icons/delete.svg') }}" alt="Delete" class="w-full h-full object-contain">
												</button>
											</form>
										</div>
									</td>
								</tr>
							@endforeach
							<!-- Add more rows if needed -->
						</tbody>
					</table>

					<!-- Bottom bar -->
					<div class="flex items-center justify-between mt-4">

					</div>
				</x-card>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		var map = L.map('map').setView([51.505, -0.09], 13);

		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);

		// Ganti lokasi default jika perlu
		map.setView([-6.55, 106.72], 13); // Bogor misalnya

		// Ambil data trash bin dari backend
		var trashBins = @json($trashBins);

		// Tambahkan marker ke peta
		trashBins.forEach(function (bin) {
			if (bin.latitude && bin.longitude) {
				L.marker([parseFloat(bin.latitude), parseFloat(bin.longitude)])
					.addTo(map)
					.bindPopup(
						`<strong>${bin.resident?.name ?? 'Tidak diketahui'}</strong><br>
					Jenis: ${bin.bin_type}<br>
					Status: ${bin.status}<br>
					Kapasitas: ${bin.capacity}`
					);
			}
		});


		$(document).ready(function () {
			$('#residentTable').DataTable({
				paging: true,
				pageLength: 7,
				lengthChange: false,
				searching: true,
				ordering: false,
				info: false,
				language: {
					search: "",
					searchPlaceholder: "Cari..."
				},
				dom: 't<"flex justify-between items-center mt-4"p>'
			});

			// Optional: link search box manually
			$('#searchBox').on('keyup', function () {
				$('#residentTable').DataTable().search(this.value).draw();
			});
		});

		document.addEventListener('DOMContentLoaded', function () {
			const deleteForms = document.querySelectorAll('.delete-form');

			deleteForms.forEach(form => {
				form.addEventListener('submit', function (e) {
					const confirmed = confirm('Yakin ingin menghapus data?');

					if (!confirmed) {
						e.preventDefault();
					}
				});
			});
		});
	</script>
@endsection