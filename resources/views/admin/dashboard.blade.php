@extends('admin.layouts.app')

@section('styles')

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
					<x-card class="flex h-120 gap-8 justify-center items-center">
						<div class="w-1/2 h-full">
							<x-map class="flex h-full justify-center items-center">
								<h1 class="text-3xl text-gray-800 text-center">Peta</h1>
							</x-map>
						</div>
						<div class="w-1/2 h-full">
							<div class="flex h-full justify-center items-center border border-grass">
								<h1 class="text-3xl text-gray-800 text-center">Grafik</h1>
							</div>
						</div>
						</h1>
					</x-card>
					<x-card class="flex flex-1 gap-8 justify-center items-center">
								<h1 class="text-3xl text-gray-800 text-center">Pemasukan Sampah Mingguan</h1>
					</x-card>
				</div>
			</div>
			<div class="flex flex-col w-1/3 h-full gap-8">
				<x-card class="h-1/3 flex justify-center items-center">
					<h1 class="text-3xl text-gray-800 text-center">Progress Pengangkutan</h1>
				</x-card>
				<x-card class="flex flex-1 justify-center items-center">
					<h1 class="text-3xl text-gray-800 text-center">Peringkat Resident</h1>
				</x-card>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>

	</script>
@endsection