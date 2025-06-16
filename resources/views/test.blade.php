@extends('admin.layouts.app')

@section('styles')
	
@endsection

@section('content')
		<main class="min-h-screen flex w-4/5 flex-1 relative items-center justify-center">
			<button onclick="toggleSidebar()"
				class="absolute top-4 left-0 translate-x-[-50%] bg-white border border-green-600 text-green-600 rounded-full p-1 shadow hover:bg-green-50 transition">
				<svg id="toggle-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
					stroke="currentColor">
					<path id="toggle-path" d="M15 19l-7-7 7-7" />
				</svg>
			</button>
			<h1 class="text-7xl font-bold text-gray-800 text-center">Testing Page</h1>
		</main>
@endsection

@section('scripts')
	<script>
		
	</script>
@endsection