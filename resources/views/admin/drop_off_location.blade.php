@extends('admin.layouts.app')

@section('styles')
	<style>
		table.dataTable tbody tr:hover {
			background-color: #f0f0f0;
		}
	</style>
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
				<div id="resident-info-wrapper" class="hidden">
					<x-card class="h-auto gap-4">
						<div class="w-35 h-35 bg-secondary rounded-2xl overflow-hidden">
							<img id="resident-photo" src="" alt="Profile Picture" class="w-full h-full object-cover">
						</div>
						<div class="flex-1">
							<div class="relative">
								<h2 id="resident-name" class="text-4xl font-helvetica font-bold"></h2>
								<h3 class="text-secondary-dark text-lg font-helvetica">
									ID #<span id="resident-id" class="font-bold"></span>
								</h3>
								<span id="resident-status"
									class="absolute top-0 right-0 bg-tennis-light px-4 py-1 rounded-full text-forest font-coolvetica font-base text-xl">
								</span>
							</div>
							<div class="mt-3 text-base text-secondary-dark">
								<p class="flex items-center gap-2">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-secondary-dark" fill="none"
										viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M3 5h2l3.6 7.59a1 1 0 01-.1.91l-1.35 2.44a1 1 0 00.9 1.5H19" />
									</svg>
									<span id="resident-phone"></span>
								</p>
								<p class="flex items-center gap-2 mt-1">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-secondary_dark" fill="none"
										viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M17.657 16.657L13.414 12l4.243-4.243M6.343 7.343L10.586 12l-4.243 4.243" />
									</svg>
									<span id="resident-address"></span>
								</p>
							</div>
						</div>
					</x-card>
				</div>
				<x-card class="flex-1 flex-col">
					<table id="trashTable" class="w-full text-sm text-left">
						<thead class="bg-tennis-light text-forest font-helvetica font-semibold">
							<tr>
								<th class="px-4 py-2">No</th>
								<th class="px-4 py-2">Pemilik</th>
								<th class="px-4 py-2">Diambil</th>
								<th class="px-4 py-2">Kolektor</th>
								<th class="px-4 py-2">Aksi</th>
							</tr>
						</thead>
					</table>
				</x-card>
			</div>
		</div>
	</div>
	<x-form-modal id="addTrashBinForm" title="Tambah Tempat Sampah" method="POST" action="{{ route('trash_bins.store') }}"
		openEvent="open-add-trash-bin-form">
		<div class="space-y-4">
			<div>
				<label for="warga" class="block text-sm font-medium text-gray-700 mb-1">Warga</label>
				<select required name="resident_id" id="warga"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
					@foreach($residents as $resident)
						<option value="{{ $resident->id }}" {{ old('resident->id', $resident->name ?? '') == $resident->name ? 'selected' : '' }}>
							{{ ucfirst($resident->name) }}
						</option>
					@endforeach
				</select>
			</div>
			<div>
				<label for="tipe" class="block text-sm font-medium text-gray-700 mb-1">Tipe Tempat Sampah</label>
				<select required name="bin_type" id="tipe"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
					<option value="inorganic">Kering</option>
					<option value="organic">Basah</option>
				</select>
			</div>
			<div>
				<label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas Tempat Sampah
					(Kg)</label>
				<input required type="number" name="capacity" id="capacity"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
					min="0" step="1" placeholder="Enter capacity">
			</div>
			<div class="mb-4">
				<label for="latitude" class="block text-sm font-medium">Latitude</label>
				<input required type="text" id="latitude" name="latitude"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none">
			</div>
			<div class="mb-4">
				<label for="longitude" class="block text-sm font-medium">Longitude</label>
				<input required type="text" id="longitude" name="longitude"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none">
			</div>

			<!-- Map container -->
			<div id="addTrashMap" class="mt-4 rounded border h-64"></div>
		</div>
	</x-form-modal>
	<x-form-modal id="editTrashBinForm" title="Edit Tempat Sampah" openEvent="open-edit-trash-bin-form">
		<div class="space-y-4">
			<div>
				<label for="warga" class="block text-sm font-medium text-gray-700 mb-1">Warga</label>
				<select required name="resident_id" id="edit-resident-id"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none cursor-pointer">
					@foreach($residents as $resident)
						<option value="{{ $resident->id }}" {{ old('resident->id', $resident->name ?? '') == $resident->name ? 'selected' : '' }}>
							{{ ucfirst($resident->name) }}
						</option>
					@endforeach
				</select>
			</div>
			<div>
				<label for="tipe" class="block text-sm font-medium text-gray-700 mb-1">Tipe Tempat Sampah</label>
				<select required name="bin_type" id="edit-bin-type"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none cursor-pointer">
					<option value="inorganic">Kering</option>
					<option value="organic">Basah</option>
				</select>
			</div>
			<div>
				<label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas Tempat Sampah
					(Kg)</label>
				<input required type="number" name="capacity" id="edit-capacity"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none" min="0"
					step="1" placeholder="Enter capacity">
			</div>
			<div class="mb-4">
				<label for="edit-latitude" class="block text-sm font-medium">Latitude</label>
				<input required type="text" id="edit-latitude" name="latitude"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none">
			</div>
			<div class="mb-4">
				<label for="edit-longitude" class="block text-sm font-medium">Longitude</label>
				<input required type="text" id="edit-longitude" name="longitude"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none">
			</div>

			<!-- Map container -->
			<div id="editTrashMap" class="mt-4 rounded border h-64"></div>
		</div>
	</x-form-modal>
	<x-form-modal id="deleteConfirmModal" title="Konfirmasi Hapus" method="DELETE" openEvent="open-delete-trash-bin-form">
		<input type="hidden" id="delete-trash-bin-id" name="trash_bin_id">
		<p class="font-helvetica text-center text-base text-secondary">
			Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.
		</p>
	</x-form-modal>
	<x-status-modal />
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

		const trashBins = @json($trashBins);
		var map = L.map('map')

		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);

		var bounds = L.latLngBounds([]);

		trashBins.forEach(bin => {
			let icon;
			switch (bin.status.toLowerCase()) {
				case 'collected':
					icon = iconGreen;
					break;
				case 'ready':
					icon = iconRed;
					break;
				default:
					icon = iconGrey;
			}

			const marker = L.marker([bin.latitude, bin.longitude], { icon: icon }).addTo(map);
			marker.bindPopup(`<strong>${bin.resident}</strong><br>Status: ${bin.status}`);
			bounds.extend([bin.latitude, bin.longitude]);
			
			marker.on('click', () => {
				// Show the card
				$('#resident-info-wrapper').removeClass('hidden');
	
				// Fill in the info
				$('#resident-name').text(bin.resident);
				$('#resident-id').text(bin.id);
				$('#resident-phone').text(bin.resident_phone);
				$('#resident-address').text(bin.resident_address);
				// $('#resident-photo').attr('src', bin.photo);
				$('#resident-status')
					.text(bin.status)
					.removeClass()
					.addClass(`absolute top-0 right-0 px-4 py-1 rounded-full font-coolvetica font-base text-xl ${bin.status_class}`);
			});
		});

		map.fitBounds(bounds, { padding: [30, 30] });


		function setModalTitle(title) {
			$('#addTrashBinForm .modal-title').text(title);
		}

		$(document).ready(function () {
			$('#trashTable').DataTable({
				processing: true,
				serverSide: true,
				lengthMenu: [5, 10, 15, 25, 50],
				ajax: '{{ route('trash_bins.data') }}',
				columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '5%' },
					{ data: 'resident', name: 'resident', width: '15%' },
					{ data: 'status', name: 'status', width: '5%' },
					{ data: 'collector', name: 'collector', width: '10%' },
					{ data: 'actions', name: 'actions', orderable: false, searchable: false, width: '5%' },
				],
				language: {
					info: "(_START_ - _END_) dari _TOTAL_ Data",
					search: "",
					searchPlaceholder: "Cari...",
					emptyTable: "Tidak ada data tersedia",
					lengthMenu: " _MENU_ Data per Halaman",
				},
				dom: '<"flex justify-between items-center mb-4"l<"flex items-center gap-2 justify-end w-full"<"add-button"><"search-container"f>>>t<"flex justify-between items-center mt-4"ip>'
			});
			// Add button to the left side of the bottom section
			$('.add-button').html(`
																	<button id="addTrashBin"
																		class="bg-grass text-white font-medium px-4 py-2 rounded hover:bg-grass-dark cursor-pointer">
																		Tambah Data
																	</button>
																`);
			$('#trashTable_wrapper .dataTables_length').addClass('flex items-center gap-2 whitespace-nowrap');
		});

		$(document).on('click', '#addTrashBin', function () {
			window.dispatchEvent(new Event('open-add-trash-bin-form'));
			var addTrashMap = L.map('addTrashMap').setView([-6.55, 106.72], 13); // Ganti ke lokasi defaultmu
			L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
				maxZoom: 19,
				attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
			}).addTo(addTrashMap);

			// Panggil invalidateSize jika map ada di modal
			setTimeout(() => {
				addTrashMap.invalidateSize();
			}, 300);

			let addMarker;

			addTrashMap.on('click', function (e) {
				const { lat, lng } = e.latlng;
				$('#latitude').val(lat.toFixed(6));
				$('#longitude').val(lng.toFixed(6));

				if (addMarker) {
					addTrashMap.removeLayer(addMarker);
				}

				// Add new marker
				addMarker = L.marker([lat, lng]).addTo(addTrashMap);
			});
		});


		$(document).on('click', '#editTrashBin', function () {
			const button = $(this);
			const lat = button.data('latitude');
			const long = button.data('longitude')

			console.log(button.data('type'));

			$('#edit-id').val(button.data('id'));
			$('#edit-resident-id').val(parseInt((button.data('resident'))));
			$('#edit-bin-type').val(button.data('type'));
			$('#edit-status').val(button.data('status'));
			$('#edit-latitude').val(button.data('latitude'));
			$('#edit-longitude').val(button.data('longitude'));
			$('#edit-capacity').val(button.data('capacity'));

			$('#editTrashBinForm').attr('action', button.data('url'));

			if (L.DomUtil.get('editTrashMap') != null) {
				const container = L.DomUtil.get('editTrashMap');
				if (container._leaflet_id) {
					container._leaflet_id = null;
				}
			}


			window.dispatchEvent(new Event('open-edit-trash-bin-form'));
			var editTrashMap = L.map('editTrashMap').setView([lat, long], 13);
			var oldMarker = L.marker([lat, long]).addTo(editTrashMap);
			L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
				maxZoom: 19,
				attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
			}).addTo(editTrashMap);

			// Panggil invalidateSize jika map ada di modal
			setTimeout(() => {
				editTrashMap.invalidateSize();
			}, 300);

			let addMarker;

			editTrashMap.on('click', function (e) {
				editTrashMap.removeLayer(oldMarker);
				const { lat, lng } = e.latlng;
				$('#edit-latitude').val(lat.toFixed(6));
				$('#edit-longitude').val(lng.toFixed(6));

				if (addMarker) {
					editTrashMap.removeLayer(addMarker);
				}

				// Add new marker
				addMarker = L.marker([lat, lng]).addTo(editTrashMap);
			});

			window.dispatchEvent(new CustomEvent('open-edit-trash-bin-form'));
		});

		$(document).on('click', '#deleteTrashBin', function () {
			const button = $(this);
			const trashBinId = button.data('id');
			const url = button.data('url');;

			$('#deleteConfirmModal').attr('action', url);
			$('#delete-trash-bin-id').val(trashBinId);

			if (!$('#deleteConfirmModal input[name="_method"]').length) {
				$('#deleteConfirmModal').append('<input type="hidden" name="_method" value="DELETE">');
			}

			window.dispatchEvent(new CustomEvent('open-delete-trash-bin-form'));
		});

		$(document).on('click', '#deleteTrashBin', function () {
			const button = $(this);
			const trashBinId = button.data('id');
			const url = button.data('url');

			$('#deleteConfirmModal').attr('action', url);
			$('#delete-trash-bin-id').val(trashBinId);

			if (!$('#deleteConfirmModal input[name="_method"]').length) {
				$('#deleteConfirmModal').append('<input type="hidden" name="_method" value="DELETE">');
			}

			window.dispatchEvent(new CustomEvent('open-delete-trash-bin-form'));
		});

		$('#addTrashBinForm').on('submit', function (e) {
			e.preventDefault();

			const form = $(this);
			const url = form.attr('action');
			const method = form.attr('method');
			const data = form.serialize();

			$.ajax({
				url: url,
				method: method,
				data: data,
				success: function (response) {
					window.dispatchEvent(new Event('close-modal-form'));
					showStatus(response.status, response.title, response.message);
					$('#trashTable').DataTable().ajax.reload(null, false);
					window.dispatchEvent(new Event('close-modal-form'))
				},
				error: function (xhr) {
					console.error(xhr.responseText);
					window.dispatchEvent(new CustomEvent('show-fail', {
						detail: {
							title: 'Gagal!',
							message: 'Terjadi kesalahan saat menambahkan tempat sampah.'
						}
					}));
				}
			});
		});

		$('#editTrashBinForm').on('submit', function (e) {
			e.preventDefault();

			const form = $(this);
			const url = form.attr('action');
			const method = form.find('input[name="_method"]').val() || 'POST';
			const data = form.serialize();

			$.ajax({
				url: url,
				method: method,
				data: data,
				success: function (response) {
					window.dispatchEvent(new Event('close-modal-form'));
					showStatus(response.status, response.title, response.message);

					// Reload DataTable to reflect updates
					$('#trashTable').DataTable().ajax.reload(null, false);

					form[0].reset();
					window.dispatchEvent(new Event('close-modal-form'))
				},
				error: function (xhr) {
					console.error(xhr.responseText);
					window.dispatchEvent(new CustomEvent('show-fail', {
						detail: {
							title: 'Gagal!',
							message: 'Terjadi kesalahan saat memperbarui data.'
						}
					}));
				}
			});
		});

		$('#deleteConfirmModal').on('submit', function (e) {
			e.preventDefault();

			const form = $(this);
			const url = form.attr('action');
			const data = form.serialize();

			$.ajax({
				url: url,
				method: 'DELETE',
				data: data,
				success: function (response) {
					window.dispatchEvent(new Event('close-modal-form'));
					showStatus(response.status, response.title, response.message);
					$('#trashTable').DataTable().ajax.reload(null, false);
					form[0].reset();
					window.hideModal();
				},
				error: function (xhr) {
					console.error(xhr.responseText);
					window.dispatchEvent(new CustomEvent('show-fail', {
						detail: {
							title: 'Gagal Menghapus',
							message: 'Terjadi kesalahan saat menghapus data.'
						}
					}));
				}
			});
		});

	</script>
@endsection