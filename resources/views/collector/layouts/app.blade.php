<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@yield('styles')
	@stack('styles')
	<style>
		.inner-shadow {
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25) inset;
		}
	</style>
	<title>@yield('title')</title>
</head>

<body class="m-0 p-0 ">
	<div class="container mx-0 px-0 max-w-none flex h-screen overflow-hidden">
		<main class="min-h-screen flex flex-col flex-1 overflow-y-auto relative">
			<!-- Top Navbar for Mobile -->
			<nav class="flex items-center px-4 py-3 bg-white shadow-md z-50">
				<!-- Back Button -->
				<a href="{{ route('collector.index') }}" class="mr-4 text-green-800 hover:text-green-600">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
					</svg>
				</a>
				<!-- Page Title -->
				<span class="text-lg font-semibold text-green-800">@yield('title', 'Pilastik')</span>
				<div class="ml-auto flex items-center">
					<form class="font-helvetica font-bold text-xl md:px-5 lg:px-8"
						action="{{ route('logout') }}" method="POST">
						@csrf
						<button type="submit" class="btn cursor-pointer flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="inline align-middle w-6 h-6" fill="none" viewBox="0 0 24 24"
								stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
							</svg> Keluar
						</button>
					</form>
				</div>
			</nav>

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
			@yield('content')
			<footer class="shrink-0 w-full bg-tennis py-4 text-center text-white text-sm font-medium whitespace-nowrap">
				<p class="font-helvetica font-bold text-center text-white text-sm ">© Universitas Pakuan Bogor 2025</p>
			</footer>
		</main>
	</div>
	@yield('scripts')
	@stack('scripts')
	<script>
		let sidebarOpen = true;
		function toggleSidebar() {
			const sidebar = document.getElementById('sidebar');
			const icon = document.getElementById('toggle-path');

			if (sidebarOpen) {
				sidebar.style.width = '0%';
				icon.setAttribute('d', 'M9 5l7 7-7 7'); // right arrow
			} else {
				sidebar.style.width = '16.666667%'; // 1/6
				icon.setAttribute('d', 'M15 19l-7-7 7-7'); // left arrow
			}

			sidebarOpen = !sidebarOpen;
		}
	</script>
</body>