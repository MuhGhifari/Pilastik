<div x-show="{{ $trigger }}" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" x-transition
	@click.away="{{ $trigger }} = false">
	<div @click.stop class="bg-white w-full max-w-md p-6 rounded-2xl shadow-lg"
		x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
		x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
		x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
		<div class="flex justify-between items-center mb-4">
			<h2 class="text-xl font-coolvetica text-forest m-0 p-0">{{ $title }}</h2>
			<button @click="{{ $trigger }} = false"
				class="text-gray-500 hover:text-black text-xl btn cursor-pointer">&times;</button>
		</div>
		{{ $slot }}
	</div>
</div>

{{-- resources/views/components/modal-form.blade.php --}}
@props(['id' => 'form-modal', 'title' => 'Form'])

<!-- 
  Alpine.js State:
  - show: Controls the visibility of the modal.
  - isEdit: A boolean to track if we are in "edit" or "add" mode.
  - formAction: The URL the form will be submitted to.
  - formTitle: The dynamic title for the modal.
-->
<div x-data="{ show: false, isEdit: false, formAction: '', formTitle: 'Add New Data' }" x-on:open-form-modal.window="
        show = true;
        isEdit = $event.detail.isEdit;
        formAction = $event.detail.action;
        formTitle = isEdit ? 'Edit Data' : 'Add New Data';
        // If it's an edit modal, you would pre-fill the form here using event data
        if (isEdit) {
            // This requires your JS to fetch and set the values
            document.getElementById('form-field-name').value = $event.detail.data.name;
            document.getElementById('form-field-email').value = $event.detail.data.email;
        }
    " x-on:close-modal.window="
        show = false;
        document.getElementById('main-form').reset();
    " x-show="show" x-on:keydown.escape.window="show = false"
	class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center p-4 z-50" style="display: none;" {{--
	Hide by default, Alpine controls it --}}>
	<div @click.away="show = false"
		class="bg-white w-full max-w-lg mx-auto rounded-2xl shadow-2xl p-8 transform transition-all">
		<!-- Modal Header -->
		<div class="flex justify-between items-center mb-6">
			<h3 x-text="formTitle" class="text-2xl font-bold text-gray-800"></h3>
			<button @click="show = false" class="text-gray-400 hover:text-gray-600">&times;</button>
		</div>

		<!-- Form -->
		<form :action="formAction" method="POST" id="main-form">
			@csrf
			<!-- Method spoofing for Edit -->
			<template x-if="isEdit">
				@method('PATCH')
			</template>

			<div class="space-y-4">
				<!-- Name Field -->
				<div>
					<label for="form-field-name" class="block text-sm font-medium text-gray-700">Name</label>
					<input type="text" name="name" id="form-field-name"
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
						required>
				</div>
				<!-- Email Field -->
				<div>
					<label for="form-field-email" class="block text-sm font-medium text-gray-700">Email</label>
					<input type="email" name="email" id="form-field-email"
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
						required>
				</div>
			</div>

			<!-- Modal Footer -->
			<div class="mt-8 flex justify-end space-x-4">
				<button type="button" @click="show = false"
					class="px-6 py-2 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300">
					Cancel
				</button>
				<button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700">
					Save Changes
				</button>
			</div>
		</form>
	</div>
</div>