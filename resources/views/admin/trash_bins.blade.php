@extends('admin.layouts.app')

@section('styles')

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
		<div class="flex gap-8 w-full flex-1">
			<div class="w-1/2">
				<x-map class="h-full flex items-center justify-center">
					<h1 class="text-3xl text-gray-800 text-center">Peta</h1>
				</x-map>
			</div>
			<div class="w-1/2">
				<div class="flex flex-col w-full h-full gap-8">
					<x-card class="flex h-40 justify-center items-center">
						<h1 class="text-3xl text-gray-800 text-center">Info Pengguna</h1>
					</x-card>
					<x-card class="flex flex-1 justify-center items-center">
						<h1 class="text-3xl text-gray-800 text-center">Tabel Sampah</h1>
					</x-card>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>

	</script>
@endsection