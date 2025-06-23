@props(['title' => null, 'method' => 'POST', 'action' => '#', 'id' => null, 'openEvent' => 'open-modal-form'])
<div x-data="{ visible: false }" x-show="visible" x-cloak x-init="
        window.addEventListener('{{ $openEvent }}', () => visible = true);
        window.addEventListener('close-modal-form', () => visible = false);
    " @keydown.escape.window="visible = false" x-cloak
	class="fixed inset-0 bg-gray-900/60 flex items-center justify-center p-4 z-50">
	<div x-transition:enter="modal-enter-active" x-transition:leave="modal-leave-active"
		class="bg-white max-w-lg w-full rounded-2xl shadow-2xl p-6 space-y-6">
		<!-- Modal Title -->
		@if(!empty($title))
			<h2 class="text-2xl font-coolvetica font-bold text-forest">{{ $title }}</h2>
		@endif

		<!-- Form Content -->
		<form id="{{ $id }}" method="{{ $method ?? 'POST' }}" action="{{ $action ?? '#' }}">
			@csrf
			@method($method ?? 'POST')

			{{ $slot }}

			<!-- Modal Actions -->
			<div class="flex justify-end space-x-4 pt-6">
				<button type="button" onclick="window.dispatchEvent(new Event('close-modal-form'))"
					class="px-4 py-2 bg-secondary-light text-black rounded hover:bg-secondary cursor-pointer">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-grass hover:bg-grass-dark text-white rounded hover:bg-grass cursor-pointer">Submit</button>
			</div>
		</form>
	</div>
</div>

@push('styles')
	<style>
		.modal-enter-active {
			opacity: 1;
			transform: scale(1);
			transition: all 0.3s ease;
		}

		.modal-leave-active {
			opacity: 0;
			transform: scale(0.95);
			transition: all 0.3s ease;
		}

		[x-cloak] {
			display: none !important;
		}
	</style>
@endpush