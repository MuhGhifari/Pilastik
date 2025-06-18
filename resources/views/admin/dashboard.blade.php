@extends('admin.layouts.app')

@section('styles')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
		integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection

@section('content')
	<div class="content flex flex-col w-full gap-8 py-8 px-10 flex-1">
		<div class="flex gap-8 w-full items-center justify-center">
			<div class="w-2/3">
				<x-display>Selamat Datang, {{ auth()->user()->name }}!</x-display>
				<x-breadcrumb>
					Admin &gt; <span class="text-black">Dashboard</span>
				</x-breadcrumb>
			</div>
			<div class="w-1/3">
				<img src="{{ asset('images/logo-fill.png') }}" alt="Pilastik Logo" class="w-auto h-20 ml-auto">
			</div>
		</div>
		<div class="flex flex-1 gap-8 w-full">
			<div class="w-2/3">
				<div class="flex flex-col w-full h-full gap-8">
					<x-card title="Pemasukan Sampah Mingguan" class="flex h-auto gap-4">
						<div class="flex flex-1 gap-4">
							<div class="w-2/3 h-full flex justify-center items-center">
								<canvas id="weeklyChart" class="flex w-full h-full"></canvas>
							</div>
							<div class="w-1/3 flex flex-1 h-full justify-center items-center">
								<canvas id="donutChart" class="flex w-full h-full"></canvas>
							</div>
						</div>
					</x-card>
					<x-card title="Lokasi Tempat Sampah" class="flex h-150 gap-4">
						<div class="flex flex-1 gap-4">
							<div class="w-full h-full flex justify-center items-center">
								<x-map id="map"></x-map>
							</div>
						</div>
					</x-card>
				</div>
			</div>
			<div class="flex flex-col w-1/3 h-full gap-8">
				<x-card title="Progres Pengumpulan Harian" class="h-auto gap-4">
					<div class="w-full flex bg-tennis-light rounded-full h-8">
						<div class="bg-grass h-8 rounded-full text-white text-sm w-[72%] flex justify-center items-center">
							<span class="font-helvetica font-base font-white text-lg">72%</span>
						</div>
					</div>
					<div class="flex flex-1 justify-center items-center">
						<p class="font-helvetica text-base text-secondary-dark">
							<span class="font-bold text-grass">72</span> dari 100 Lokasi Sudah Selesai
						</p>
					</div>
				</x-card>
				<x-card title="Pilahan Warga Terbaik" class="flex h-auto gap-4">
					<div class="flex w-full h-full justify-center items-center">
						<!-- <h1 class="text-3xl text-gray-800">Peringkat Warga</h1> -->
						<table class="w-full text-sm text-left">
							<thead class="text-gray-600 uppercase border-b border-gray-200">
								<tr>
									<th class="py-2 px-1">#</th>
									<th class="py-2 px-1">Nama</th>
									<th class="py-2 px-1">Kg Sampah</th>
								</tr>
							</thead>
							<tbody>
								<tr class="border-b">
									<td class="py-2 px-1 font-bold">🥇</td>
									<td class="py-2 px-1">Dwi Ayu</td>
									<td class="py-2 px-1">45.2</td>
								</tr>
								<tr class="border-b">
									<td class="py-2 px-1 font-bold">🥈</td>
									<td class="py-2 px-1">Budi</td>
									<td class="py-2 px-1">38.9</td>
								</tr>
								<tr class="border-b">
									<td class="py-2 px-1 font-bold">🥉</td>
									<td class="py-2 px-1">Sari</td>
									<td class="py-2 px-1">36.5</td>
								</tr>
								<tr class="border-b">
									<td class="py-2 px-1">4</td>
									<td class="py-2 px-1">Agus</td>
									<td class="py-2 px-1">32.7</td>
								</tr>
								<tr>
									<td class="py-2 px-1">5</td>
									<td class="py-2 px-1">Lina</td>
									<td class="py-2 px-1">30.1</td>
								</tr>
							</tbody>
						</table>
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
	</script>
@endsection