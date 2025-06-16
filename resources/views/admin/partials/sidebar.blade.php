<aside id="sidebar"
	class="w-1/6 bg-secondary-light min-h-screen flex flex-col inner-shadow transition-all duration-300 overflow-hidden overflow-y-auto relative">
	<div class="nav-header flex flex-col justify-center items-center mt-10 py-4 border-b-2 border-grass">
		<img src="{{ asset('images/profile.png') }}" alt="Profile Picture" class="w-30">
		<h1 class="font-helvetica-neue font-bold text-2xl mt-2">Hendra</h2>
			<h3 class="font-avenir text-base text-secondary-dark font-extrabold tracking-wider mb-2">Administrator</h3>
	</div>
	<nav>
		<a href="{{ route('admin.dashboard') }}"
			class="nav-item {{ Route::is('admin.dashboard') ? 'active inner-shadow' : '' }}">Dashboard</a>
		<a href="{{ route('admin.trash_bins') }}"
			class="nav-item {{ Route::is('admin.trash_bins') ? 'active inner-shadow' : '' }}">Sampah Warga</a>
		<a href="{{ route('admin.users') }}"
			class="nav-item {{ Route::is('admin.users') ? 'active inner-shadow' : '' }}">Kelola Pengguna</a>
	</nav>
	<form class="mt-auto w-full font-helvetica font-bold text-xl md:px-5 lg:px-8 mb-4" action="{{ route('logout') }}"
		method="POST">
		@csrf
		<button type="submit" class="btn cursor-pointer flex align-middle justify-center">
			<svg xmlns="http://www.w3.org/2000/svg" class="inline align-middle w-6 h6" fill="none" viewBox="0 0 24 24"
				stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
			</svg> Keluar
		</button>
	</form>
</aside>