<div 
    x-data="statusModal()" 
    x-show="visible" 
    x-init="
    window.addEventListener('show-status-modal', event => {
        const { status, title, message } = event.detail;
        showModal(status, title, message);
    });"
    @keydown.escape.window="hideModal"
    x-cloak
    class="fixed inset-0 bg-gray-900/60 flex items-center justify-center p-4 z-50"
>
    <div 
        x-transition:enter="modal-enter-active" 
        x-transition:leave="modal-leave-active"
        class="bg-white w-full max-w-md mx-auto rounded-2xl shadow-2xl p-8 text-center flex flex-col items-center transform transition-all"
    >
        <!-- Success Icon SVG -->
        <div x-show="status === 'success'">
            <svg class="success-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" width="80" height="80">
                <circle class="success-checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="success-checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
        </div>

        <!-- Fail Icon SVG -->
        <div x-show="status === 'fail'">
            <svg class="error-cross" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" width="80" height="80">
                <circle class="error-cross__circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="error-cross__line error-cross__line--1" fill="none" d="M16,16 l20,20" />
                <path class="error-cross__line error-cross__line--2" fill="none" d="M16,36 l20,-20" />
            </svg>
        </div>

        <!-- Modal Title -->
        <h3 class="text-2xl font-bold text-gray-800 mt-6" x-text="title"></h3>

        <!-- Modal Message -->
        <p class="text-gray-600 mt-2" x-text="message"></p>

        <!-- Close Button -->
        <button 
            @click="hideModal" 
            class="mt-8 w-full bg-grass text-white font-semibold py-3 rounded-lg hover:bg-grass-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-colors"
        >
            Close
        </button>
    </div>
</div>

@push('styles')
<style>
    .success-checkmark__circle,
    .error-cross__circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }
    .success-checkmark__circle { stroke: #4CAF50; }
    .error-cross__circle { stroke: #F44336; }

    .success-checkmark__check,
    .error-cross__line {
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        stroke-width: 2;
        fill: none;
    }
    .success-checkmark__check {
        stroke: #4CAF50;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }
    .error-cross__line {
        stroke: #F44336;
    }
    .error-cross__line--1 {
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }
    .error-cross__line--2 {
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.9s forwards;
    }

    @keyframes stroke {
        100% { stroke-dashoffset: 0; }
    }

    .modal-enter-active {
        opacity: 1;
        transform: scale(1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal-leave-active {
        opacity: 0;
        transform: scale(0.95);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endpush

@push('scripts')
<script>
    function statusModal() {
        return {
            visible: false,
            status: '',
            title: '',
            message: '',
            showModal(status, title, message) {
                this.status = status;
                this.title = title;
                this.message = message;
                this.visible = true;
            },
            hideModal() {
                this.visible = false;
            }
        }
    }

    function showStatus(status, title, message) {
        window.dispatchEvent(new CustomEvent('show-status-modal', {
            detail: { status, title, message }
        }));
    }
</script>
@endpush