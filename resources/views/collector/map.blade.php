@extends('collector.layouts.app')

@section('styles')
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
		integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection

@section('content')
	@if(session('status'))
		<script>
			window.addEventListener('DOMContentLoaded', () => {
				showStatus(
					"{{ session('status') }}",
					"{{ session('title') }}",
					"{{ session('message') }}"
				);
			});
		</script>
	@endif
	<div class="content flex flex-col w-full gap-4 py-4 px-4 flex-1">
		<div class="h-full">
			<x-map id="map"></x-map>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		const iconGreen = new L.Icon({
			iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
			shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
			iconSize: [25, 41],
			iconAnchor: [12, 41],
			popupAnchor: [1, -34],
			shadowSize: [41, 41]
		});

		const iconRed = new L.Icon({
			iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
			shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
			iconSize: [25, 41],
			iconAnchor: [12, 41],
			popupAnchor: [1, -34],
			shadowSize: [41, 41]
		});

		const iconGrey = new L.Icon({
			iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-grey.png',
			shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
			iconSize: [25, 41],
			iconAnchor: [12, 41],
			popupAnchor: [1, -34],
			shadowSize: [41, 41]
		});

		const schedules = @json($schedules);
		var map = L.map('map')

		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);

		var bounds = L.latLngBounds([]);

		schedules.forEach(schedule => {
			let icon;
			switch (schedule.trash_bin.status.toLowerCase()) {
				case 'collected':
					icon = iconGreen;
					break;
				default:
					icon = iconGrey;
			}

			const marker = L.marker([schedule.trash_bin.latitude, schedule.trash_bin.longitude], { icon: icon }).addTo(map);
			marker.bindPopup(`
					<strong>${schedule.trash_bin.resident.name} - ID #${schedule.trash_bin.id}</strong><br>
					Alamat: ${schedule.trash_bin.resident.address}<br>
					<a href="https://www.google.com/maps/dir/?api=1&destination=${schedule.trash_bin.latitude},${schedule.trash_bin.longitude}" 
					target="_blank" class="text-blue-500 underline">
						Lihat Arah di Google Maps
					</a>
				`);
			bounds.extend([schedule.trash_bin.latitude, schedule.trash_bin.longitude]);
		});

		map.fitBounds(bounds, { padding: [30, 30] });
	</script>
@endsection