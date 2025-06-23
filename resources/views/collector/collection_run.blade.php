@extends('collector.layouts.app')

@section('styles')
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
		integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection

@section('content')
	<div class="content flex flex-col w-full gap-4 py-4 px-4 flex-1">
		<div class="h-1/2">
			<x-map id="map"></x-map>
		</div>
		<x-card class="flex-1 h-auto gap-4" title="Info Jadwal">
			<div class="flex flex-col gap-2 font-helvetica text-secondary-dark">
				<table class="table-auto text-sm font-medium text-left">
					<tbody>
						<tr>
							<th class="w-3/10">Titik Lokasi</th>
							<td class="w-1/10">:</td>
							<td class="">{{ count($schedules) }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div>
				<label for="latitude" class="block text-sm font-medium mb-2">Jam Mulai</label>
				{{ now()->translatedFormat('H.i l, d M Y') }}
			</div>
			<form action="{{ route('collector.collection_run.begin') }}" method="POST">
                @csrf
				<div>
					<label for="latitude" class="block text-sm font-medium mb-2">Plat Nomor Kendaraan</label>
                    <select name="vehicle_id" class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none" required>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->license_plate }}</option>
                    @endforeach
                    </select>
				</div>
				<div class="flex justify-center mt-6">
					<button type="submit"
						class="flex items-center justify-center w-24 h-24 rounded-full bg-grass hover:bg-grass-dark shadow-lg transition duration-200"
						style="font-size: 3rem; color: white;"
						aria-label="Play">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="48" height="48" fill="currentColor">
							<polygon points="26,18 50,32 26,46" fill="white"/>
						</svg>
					</button>
				</div>
			</form>
		</div>
		</x-card>
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
			marker.bindPopup(`<strong>${schedule.trash_bin.resident.name}</strong><br>Alamat: ${schedule.trash_bin.resident.address}`);
			bounds.extend([schedule.trash_bin.latitude, schedule.trash_bin.longitude]);
		});

		map.fitBounds(bounds, { padding: [30, 30] });
	</script>
@endsection