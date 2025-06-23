@extends('collector.layouts.app')

@section('styles')
@endsection

@section('content')
<div class="content flex flex-col w-full gap-4 py-4 px-4 flex-1">
	<!-- Kartu Informasi Warga -->
	<div class="p-4 mt-4 bg-white border rounded-lg shadow">
		<div class="flex gap-4 items-center">
			<div class="flex-1 flex-col">
				<div class="w-full flex flex-1 gap-2 mb-2">
					<img src="{{ asset('images/rina-pp.png') }}" class="w-20 h-20 rounded-lg object-cover" alt="Foto Warga">
					<div class="w-2/4">
						<h2 class="text-lg font-bold">{{$resident->name}}</h2>
						<p class="text-gray-600 text-sm">#{{$trashBin->id}}</p>
					</div>
					<div class="w-1/4">
						<span class="px-4 py-1 rounded-full text-sm font-medium bg-tennis-light text-forest">{{ucfirst($trashBin->bin_type)}}</span>
					</div>
				</div>
				<div class="w-full flex items-center text-sm text-gray-700 gap-1 mt-1">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2l3.6 7.59a1 1 0 01-.1.91l-1.35 2.44a1 1 0 00.9 1.5H19" />
					</svg>
					{{$resident->phone}}
				</div>
				<div class="flex items-center text-sm text-gray-700 gap-1">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12l4.243-4.243M6.343 7.343L10.586 12l-4.243 4.243" />
					</svg>
					{{$resident->address}}
				</div>
			</div>
		</div>
	</div>

	<!-- Formulir Penilaian -->
	<form method="POST" action="{{ route('rating.store') }}" class="mt-6 space-y-4">
		@csrf
		<input type="hidden" name="trash_bin_id" value="{{ $trashBin->id }}">
		<div>
			<label class="block mb-1 font-semibold text-gray-700">Berat Sampah</label>
			<div class="relative">
				<input name="weight" type="number" step="0.1" placeholder="Tuliskan berat sampah Anda di sini..." class="w-full px-4 py-2 rounded-xl border border-green-700 text-sm focus:outline-none" required>
				<span class="absolute right-4 top-1/2 -translate-y-1/2 text-green-800 font-bold">kg</span>
			</div>
		</div>

		<div>
			<label class="block mb-1 font-semibold text-gray-700">Nilai untuk hasil pemilahan sampah</label>
			<div class="flex gap-1" id="star-rating">
				@for ($i = 1; $i <= 5; $i++)
				<svg data-value="{{ $i }}" class="w-8 h-8 cursor-pointer text-green-200 hover:text-green-500 transition-colors" fill="currentColor" viewBox="0 0 24 24">
					<path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
				</svg>
				@endfor
			</div>
			<input type="hidden" name="score" id="rating-value" value="0" required>
		</div>

		<div>
			<label class="block mb-1 font-semibold text-gray-700">Catatan</label>
			<textarea name="comments" rows="4" placeholder="Tuliskan catatan Anda di sini..." class="w-full px-4 py-2 rounded-xl border border-green-700 text-sm focus:outline-none"></textarea>
		</div>

		<div>
			<button type="submit" class="w-full py-2 rounded-xl bg-green-900 text-white font-semibold text-lg">Submit</button>
		</div>
	</form>
</div>
@endsection

@section('scripts')
<script>
	document.addEventListener("DOMContentLoaded", function () {
		const stars = document.querySelectorAll("#star-rating svg");
		const ratingInput = document.getElementById("rating-value");

		stars.forEach(star => {
			star.addEventListener("click", () => {
				const rating = parseInt(star.dataset.value);
				ratingInput.value = rating;

				stars.forEach(s => {
					s.classList.remove('text-green-600');
					s.classList.add('text-green-200');
				});
				stars.forEach(s => {
					if (parseInt(s.dataset.value) <= rating) {
						s.classList.remove('text-green-200');
						s.classList.add('text-green-600');
					}
				});
			});
		});
	});
</script>
@endsection