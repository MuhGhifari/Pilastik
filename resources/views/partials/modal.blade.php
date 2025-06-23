<div class="space-x-4">
  <button id="show-success-btn"
    class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75 transition-colors">
    Show Success Modal
  </button>
  <button id="show-fail-btn"
    class="px-6 py-3 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75 transition-colors">
    Show Fail Modal
  </button>
</div>

<!-- Modal Container -->
<div id="statusModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center p-4 z-50 hidden">
  <!-- FIXED: Added flex, flex-col, and items-center to center the content -->
  <div id="modal-content"
    class="bg-white w-full max-w-md mx-auto rounded-2xl shadow-2xl p-8 text-center flex flex-col items-center transform transition-all">

    <!-- Success Icon SVG -->
    <div id="success-icon">
      <svg class="success-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" width="80" height="80">
        <circle class="success-checkmark__circle" cx="26" cy="26" r="25" fill="none" />
        <path class="success-checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
      </svg>
    </div>

    <!-- Fail Icon SVG -->
    <div id="fail-icon">
      <svg class="error-cross" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" width="80" height="80">
        <circle class="error-cross__circle" cx="26" cy="26" r="25" fill="none" />
        <path class="error-cross__line error-cross__line--1" fill="none" d="M16,16 l20,20" />
        <path class="error-cross__line error-cross__line--2" fill="none" d="M16,36 l20,-20" />
      </svg>
    </div>

    <!-- Modal Title -->
    <h3 id="modal-title" class="text-2xl font-bold text-gray-800 mt-6"></h3>

    <!-- Modal Message -->
    <p id="modal-message" class="text-gray-600 mt-2"></p>

    <!-- Close Button -->
    <button id="close-modal-btn"
      class="mt-8 w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-colors">
      Close
    </button>
  </div>
</div>