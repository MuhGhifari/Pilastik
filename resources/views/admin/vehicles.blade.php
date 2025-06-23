@extends('admin.layouts.app')

@section('styles')
	<!-- DataTables CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

	<!-- DataTables + jQuery -->
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
	@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif
	<div class="content flex flex-col w-full gap-8 py-8 px-10 flex-1">
		<div class="flex gap-8 w-full items-center justify-center">
			<div class="w-2/3">
				<x-display>Data Kendaraan</x-display>
				<x-breadcrumb>
					Admin &gt; <span class="text-black">Kelola Data Kendaraan</span>
				</x-breadcrumb>
			</div>
			<div class="w-1/3">
				<img src="{{ asset('images/logo-fill.png') }}" alt="Pilastik Logo" class="w-auto h-20 ml-auto">
			</div>
		</div>
		<div class="flex flex-1 gap-8 w-full">
			<x-card class="w-full flex-col">
				<!-- Table -->
				<table id="vehicleTable" class="w-full text-sm text-left">
					<thead class="bg-tennis-light text-forest font-helvetica font-semibold">
						<tr class="">
							<th class="px-4 py-2 text-center">No</th>
							<th class="px-4 py-2">Plat Nomor</th>
							<th class="px-4 py-2">Tipe Kendaraan</th>
							<th class="px-4 py-2">Model</th>
							<th class="px-4 py-2">Status</th>
							<th class="px-4 py-2 text-center">Kapasistas</th>
						</tr>
					</thead>
				</table>
			</x-card>
		</div>
	</div>
	<x-form-modal id="addVehicleForm" title="Tambah Kendaraan" method="POST" action="{{ route('vehicle.store') }}"
		openEvent="open-add-user-form">
		<div class="space-y-4">
			<div>
				<label for="input-name" class="block mb-1 font-semibold text-gray-700">Nama</label>
				<input id="input-name" name="name" type="text" placeholder="Nama" autocomplete="name"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none" required>
			</div>
			<div>
				<label for="input-email" class="block mb-1 font-semibold text-gray-700">Email</label>
				<input id="input-email" name="email" type="email" placeholder="Email" autocomplete="email"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none" required>
			</div>
			<div class="w-full flex gap-x-4">
				<div class="w-1/2">
					<label for="input-dob" class="block mb-1 font-semibold text-gray-700">Tanggal Lahir</label>
					<input id="input-dob" name="date_of_birth" type="date" placeholder="Tanggal lahir"
						class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none"
						required>
				</div>
				<div class="w-1/2">
					<label for="input-role" class="block mb-1 font-semibold text-gray-700">Posisi</label>
					<select id="input-role" name="role" placeholder="Posisi"
						class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none cursor-pointer"
						required>
						<option value="resident">Warga</option>
						<option value="collector">Kolektor</option>
						<option value="admin">Administrator</option>
					</select>
				</div>
			</div>
			<div>
				<label for="input-phone" class="block mb-1 font-semibold text-gray-700">No. Telpon</label>
				<input id="input-phone" name="phone" type="text" placeholder="No. Telpon" autocomplete="phone"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none" required>
			</div>
		</div>
	</x-form-modal>
	<x-form-modal id="editVehicleForm" title="Edit Kendaraan" openEvent="open-edit-vehicle-form">
		<div class="space-y-4">
			<input id="vehicle-id" type="hidden" name="vehicle_id">
			<div>
				<label for="user-name" class="block mb-1 font-semibold text-gray-700">Nama</label>
				<input id="user-name" name="name" type="text" placeholder="Nama" autocomplete="name"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none" required>
			</div>
			<div>
				<label for="user-email" class="block mb-1 font-semibold text-gray-700">Email</label>
				<input id="user-email" name="email" type="email" placeholder="Email" autocomplete="email"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none" required>
			</div>
			<div class="w-full flex gap-x-4">
				<div class="w-1/2">
					<label for="user-dob" class="block mb-1 font-semibold text-gray-700">Tanggal Lahir</label>
					<input id="user-dob" name="date_of_birth" type="date" placeholder="Tanggal lahir"
						class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none"
						required>
				</div>
				<div class="w-1/2">
					<label for="user-role" class="block mb-1 font-semibold text-gray-700">Posisi</label>
					<select id="user-role" name="role" placeholder="Posisi"
						class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none cursor-pointer" required>
						<option value="resident">Warga</option>
						<option value="collector">Kolektor</option>
						<option value="admin">Administrator</option>
					</select>
				</div>
			</div>
			<div>
				<label for="user-phone" class="block mb-1 font-semibold text-gray-700">No. Telpon</label>
				<input id="user-phone" name="phone" type="text" placeholder="No. Telpon" autocomplete="phone"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none" required>
			</div>
			<div>
				<label for="user-password" class="block mb-1 font-semibold text-gray-700">Password Baru</label>
				<input name="password" id="user-password" type="password" placeholder="Kosongkan jika tidak ingin mengubah"
					class="w-full px-4 py-2 rounded-xl bg-secondary-light text-sm placeholder-gray-500 focus:outline-none">
			</div>
		</div>
	</x-form-modal>
	<x-form-modal id="deleteConfirmModal" title="Konfirmasi Hapus" method="DELETE" openEvent="open-delete-user-form">
		<input type="hidden" id="delete-user-id" name="vehicle_id">
		<p class="font-helvetica text-center text-base text-secondary">
			Apakah Anda yakin ingin menghapus Kendaraan ini? Tindakan ini tidak dapat dibatalkan.
		</p>
	</x-form-modal>
	<x-status-modal />
@endsection

@section('scripts')
	<script>
		function setModalTitle(title) {
			$('#addVehicleForm .modal-title').text(title);
		}

		$(document).ready(function () {
			$('#vehicleTable').DataTable({
				processing: true,
				serverSide: true,
				lengthMenu: [5,10,15,25,50],
				ajax: '{{ route('vehicle.data') }}',
				columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '5%' },
					{ data: 'name', name: 'name', width: '15%' },
					{ data: 'email', name: 'email', width: '15%' },
					{ data: 'role', name: 'role', width: '10%' },
					{ data: 'phone', name: 'phone', width: '10%' },
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
											<button id="addUser"
												class="bg-grass text-white font-medium px-4 py-2 rounded hover:bg-grass-dark cursor-pointer" 
												onclick="window.dispatchEvent(new Event('open-add-user-form'))">
												Tambah Data
											</button>
										`);
			$('#vehicleTable_wrapper .dataTables_length').addClass('flex items-center gap-2 whitespace-nowrap');
		});

		$(document).on('click', '#editUser', function () {
			const button = $(this);

			$('#user-id').val(button.data('id'));
			$('#user-name').val(button.data('name'));
			$('#user-email').val(button.data('email'));
			$('#user-dob').val(button.data('dob'));
			$('#user-role').val(button.data('role'));
			$('#user-phone').val(button.data('phone'));

			$('#editVehicleForm').attr('action', button.data('url'));

			if (!$('#editVehicleForm input[name="_method"]').length) {
				$('#editVehicleForm').append('<input type="hidden" name="_method" value="PUT">');
			}

			window.dispatchEvent(new CustomEvent('open-edit-vehicle-form'));
		});

		$(document).on('click', '#deleteUser', function () {
			const button = $(this);
			const userId = button.data('id');
			const url = button.data('url');

			$('#deleteConfirmModal').attr('action', url);
			$('#delete-user-id').val(userId);

			if (!$('#deleteConfirmModal input[name="_method"]').length) {
				$('#deleteConfirmModal').append('<input type="hidden" name="_method" value="DELETE">');
			}

			window.dispatchEvent(new CustomEvent('open-delete-user-form'));
		});

		$('#addVehicleForm').on('submit', function (e) {
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
					$('#vehicleTable').DataTable().ajax.reload(null, false);
					window.dispatchEvent(new Event('close-modal-form'))
				},
				error: function (xhr) {
					console.error(xhr.responseText);
					window.dispatchEvent(new CustomEvent('show-fail', {
						detail: {
							title: 'Gagal!',
							message: 'Terjadi kesalahan saat menambahkan Kendaraan.'
						}
					}));
				}
			});
		});

		$('#editVehicleForm').on('submit', function (e) {
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
					$('#vehicleTable').DataTable().ajax.reload(null, false);

					form[0].reset();
					window.dispatchEvent(new Event('close-modal-form'))
				},
				error: function (xhr) {
					console.error(xhr.responseText);
					window.dispatchEvent(new CustomEvent('show-fail', {
						detail: {
							title: 'Gagal!',
							message: 'Terjadi kesalahan saat memperbarui Kendaraan.'
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
					$('#vehicleTable').DataTable().ajax.reload(null, false);
					form[0].reset();
					window.hideModal();
				},
				error: function (xhr) {
					console.error(xhr.responseText);
					window.dispatchEvent(new CustomEvent('show-fail', {
						detail: {
							title: 'Gagal Menghapus',
							message: 'Terjadi kesalahan saat menghapus Kendaraan.'
						}
					}));
				}
			});
		});
	</script>
@endsection