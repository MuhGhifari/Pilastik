<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<!-- <link rel="stylesheet" href="all.min.css"> -->
	@vite('resources/css/app.css')
	@yield('styles')
	<style>
		.inner-shadow {
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25) inset;
		}
	</style>
	<title>@yield('title')</title>
</head>

<body class="m-0 p-0 ">
	<div class="container mx-0 px-0 max-w-none flex h-screen overflow-hidden">
		@include('admin.partials.sidebar')

		<!-- <main class="min-h-screen flex w-5/6 flex-1 relative items-center justify-center"> -->
		<main class="min-h-screen flex flex-col flex-1 overflow-y-auto relative">
			<button onclick="toggleSidebar()"
				class="top-0 left-4 translate-x-[-50%] bg-grass text-white p-1 hover:bg-grass-dark hover:border-forest transition btn cursor-pointer fixed">
				<svg id="toggle-icon" xmlns="http://www.w3.org/2000/svg" class="w-9 h-8" fill="none" viewBox="0 0 24 24"
					stroke="currentColor">
					<path id="toggle-path" d="M15 19l-7-7 7-7" />
				</svg>
			</button>
			@yield('content')
			<footer class="shrink-0 w-full bg-grass py-4 text-center text-white text-sm font-medium whitespace-nowrap">
				<p class="font-helvetica font-bold text-center text-white text-sm ">© Universitas Pakuan Bogor 2025</p>
			</footer>
		</main>
	</div>
	@yield('scripts')
	@vite('resources/js/dashboard.js')
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