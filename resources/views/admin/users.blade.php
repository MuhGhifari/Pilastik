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
				<x-display>Data Pengguna</x-display>
				<x-breadcrumb>
					Admin &gt; <span class="text-black">Kelola Data Pengguna</span>
				</x-breadcrumb>
			</div>
			<div class="w-1/3">
				<img src="{{ asset('images/logo-fill.png') }}" alt="Pilastik Logo" class="w-auto h-20 ml-auto">
			</div>
		</div>
		<div class="flex flex-1 gap-8 w-full">
			<x-card class="w-full flex-col">
				<!-- Filter & Search -->
				<div class="flex items-center gap-4 mb-4">
					<div x-data="{ showModal: false }" @close-modal.window="showModal = false">
						<a href="{{ route('admin.add.user') }}"
							class="btn cursor-pointer bg-green-700 text-white px-6 py-2 rounded-full font-semibold">+ Tambah</a>

						<x-modal title="Tambah Pengguna" trigger="showModal">
							<form class="space-y-4" id="userForm">
								@csrf
								<div>
									<input name="name" type="text" placeholder="Nama"
										class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none">
								</div>
								<div>
									<input name="email" type="email" placeholder="Email"
										class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none">
								</div>
								<div>
									<input name="password" type="password" placeholder="Password"
										class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none">
								</div>
								<div>
									<input name="role" type="text" placeholder="Posisi"
										class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none">
								</div>
								<div>
									<input name="phone" type="text" placeholder="No. Telpon"
										class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none">
								</div>
								<div class="flex justify-end gap-2">
									<button type="button" @click="showModal = false" class="bg-gray-300 px-4 py-2 rounded-md">Batal</button>
									<button type="submit" class="bg-grass text-white px-4 py-2 rounded-md">Simpan</button>
								</div>
							</form>
						</x-modal>
					</div>
				</div>
				<!-- Table -->
				<table id="userTable" class="w-full text-sm text-left">
					<thead class="bg-green-200 text-green-900 font-semibold">
						<tr>
							<th class="px-4 py-2">No</th>
							<th class="px-4 py-2">Nama</th>
							<th class="px-4 py-2">Email</th>
							<th class="px-4 py-2">Tipe Pengguna</th>
							<th class="px-4 py-2">No. Telpon</th>
							<th class="px-4 py-2">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@php
							$i = 0;
						@endphp
						@foreach ($users as $user)
							<tr class="hover:bg-gray-100">
								<td class="px-4 py-2">{{ ++$i }}</td>
								<td class="px-4 py-2">{{ $user->name }}</td>
								<td class="px-4 py-2">{{ $user->email }}</td>
								<td class="px-4 py-2">{{ ucfirst($user->role) }}</td>
								<td class="px-4 py-2">{{  $user->phone }}</td>
								<td class="px-4 py-2 text-center">
									<div class="flex items-center gap-2 justify-center">
										<a href="{{ route('admin.edit.user', ['id' => $user->id]) }}" class="w-6 h-6">
											<img src="{{ asset('icons/edit.svg') }}" alt="Edit" class="w-full h-full object-contain">
										</a>

										<form action="{{ route('user.delete', ['id' => $user->id]) }}" method="POST" class="inline delete-form">
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
					</tbody>
				</table>
			</x-card>
		</div>
	</div>

@endsection

@section('scripts')
	<script>
		$(document).ready(function () {
			$('#userTable').DataTable({
				paging: true,
				pageLength: 10,
				lengthMenu: [5, 8, 10, 25, 50, 100],
				lengthChange: true,
				searching: true,
				ordering: true,
				info: true,
				language: {
					info: "_START_ dari _TOTAL_ Data",
					search: "",
					searchPlaceholder: "Cari...",
					emptyTable: "Tidak ada data tersedia",
					lengthMenu: "Tampilkan _MENU_ data per halaman",
				},
				dom: '<"flex justify-between items-center mb-4"lf>t<"flex justify-between items-center mt-4"ip>'
			});
		});

		document.addEventListener('DOMContentLoaded', function () {
			const deleteForms = document.querySelectorAll('.delete-form');

			deleteForms.forEach(form => {
				form.addEventListener('submit', function (e) {
					const confirmed = confirm('Yakin ingin menghapus data ini?');

					if (!confirmed) {
						e.preventDefault();
					}
				});
			});
		});
	</script>
@endsection