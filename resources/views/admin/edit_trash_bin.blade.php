@extends('admin.layouts.app')

@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection

@section('content')
	<div class="content flex flex-col w-full gap-8 py-8 px-10 flex-1">
		<div class="flex gap-8 w-full items-center justify-center">
			<div class="w-2/3">
				<x-display>Edit Tempat Sampah</x-display>
				<x-breadcrumb>
					Admin &gt; <a href="{{ route('admin.trash_bins') }}" class="text-green-700 hover:underline">Kelola Data Tempat
						Sampah</a>
					&gt; <span class="text-black">Edit Tempat Sampah</span>
				</x-breadcrumb>
			</div>
			<div class="w-1/3">
				<img src="{{ asset('images/logo-fill.png') }}" alt="Pilastik Logo" class="w-auto h-20 ml-auto">
			</div>
		</div>
		<div class="flex flex-1 gap-8 w-full">
			<x-card class="w-full flex-col">
				<form action="{{ route('trash_bin.update', ['id' => $trashBin->id]) }}" method="POST" class="space-y-6 w-full max-w-lg mx-auto">
					@csrf
					<div>
						<label for="warga" class="block text-sm font-medium text-gray-700 mb-1">Warga</label>
						<select required name="resident_id" id="warga"
							class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
							<option value="{{ $trashBin->resident_id }}">{{ $trashBin->resident?->name }}</option>
							@foreach($residents as $resident)
								<option value="{{ $resident->id }}">
									{{ ucfirst($resident->name) }}
								</option>
							@endforeach
						</select>
					</div>
					<div>
						<label for="tipe" class="block text-sm font-medium text-gray-700 mb-1">Tipe Tempat Sampah</label>
						<select required value="{{ $trashBin->bin_type }}" name="bin_type" id="tipe"
							class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
							<option value="inorganic">Kering</option>
							<option value="organic">Basah</option>
						</select>
					</div>
					<div>
						<label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas Tempat Sampah
							(Kg)</label>
						<input required value="{{ $trashBin->capacity }}" type="number" name="capacity" id="capacity"
							class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
							min="0" step="1" placeholder="Enter capacity">
					</div>
					<div class="mb-4">
						<label for="latitude" class="block text-sm font-medium">Latitude</label>
						<input required value="{{ $trashBin->latitude }}" type="text" id="latitude" name="latitude"
							class="mt-1 block w-full border-gray-300 rounded-md">
					</div>
					<div class="mb-4">
						<label for="longitude" class="block text-sm font-medium">Longitude</label>
						<input required value="{{ $trashBin->longitude }}" type="text" id="longitude" name="longitude"
							class="mt-1 block w-full border-gray-300 rounded-md">
					</div>

					<!-- Map container -->
					<div id="map" class="mt-4 rounded border h-64"></div>

					<div class="flex justify-end gap-2">
						<a href="{{ route('admin.trash_bins') }}" class="bg-gray-300 px-4 py-2 rounded-md">Batal</a>
						<button type="submit" class="bg-grass text-white px-4 py-2 rounded-md">Simpan</button>
					</div>
				</form>
			</x-card>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// Center of the map by default (can be changed)
			const defaultLat = -6.2;
			const defaultLng = 106.8;

			const map = L.map('map').setView([defaultLat, defaultLng], 13);

			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: '© OpenStreetMap contributors'
			}).addTo(map);

			let marker;

			// When the user clicks on the map
			map.on('click', function (e) {
				const { lat, lng } = e.latlng;

				// Update the form fields
				document.getElementById('latitude').value = lat.toFixed(6);
				document.getElementById('longitude').value = lng.toFixed(6);

				// Add or move the marker
				if (marker) {
					marker.setLatLng([{lat}, lng]);
				} else {
					marker = L.marker([lat, lng]).addTo(map);
				}
			});
		});
	</script>
@endsection