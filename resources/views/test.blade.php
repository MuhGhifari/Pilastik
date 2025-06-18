<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Status Modal (Fixed)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        /* Base font family */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Animation for the SVG checkmark */
        .success-checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #4CAF50; /* Green */
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .success-checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            stroke-width: 2;
            stroke: #4CAF50; /* Green */
            fill: none;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        /* Animation for the SVG cross */
        .error-cross__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #F44336; /* Red */
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .error-cross__line {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            stroke-width: 2;
            stroke: #F44336; /* Red */
            fill: none;
        }

        .error-cross__line--1 {
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }
        
        .error-cross__line--2 {
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.9s forwards;
        }


        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        /* Modal transition */
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
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <!-- Buttons to trigger the modal -->
    <div class="space-x-4">
        <button id="show-success-btn" class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75 transition-colors">
            Show Success Modal
        </button>
        <button id="show-fail-btn" class="px-6 py-3 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75 transition-colors">
            Show Fail Modal
        </button>
    </div>

    <!-- Modal Container -->
    <div id="statusModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center p-4 z-50 hidden">
        <!-- FIXED: Added flex, flex-col, and items-center to center the content -->
        <div id="modal-content" class="bg-white w-full max-w-md mx-auto rounded-2xl shadow-2xl p-8 text-center flex flex-col items-center transform transition-all">
            
            <!-- Success Icon SVG -->
            <div id="success-icon">
                <svg class="success-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" width="80" height="80">
                    <circle class="success-checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="success-checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            
            <!-- Fail Icon SVG -->
            <div id="fail-icon">
                 <svg class="error-cross" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" width="80" height="80">
                    <circle class="error-cross__circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="error-cross__line error-cross__line--1" fill="none" d="M16,16 l20,20" />
                    <path class="error-cross__line error-cross__line--2" fill="none" d="M16,36 l20,-20" />
                </svg>
            </div>

            <!-- Modal Title -->
            <h3 id="modal-title" class="text-2xl font-bold text-gray-800 mt-6"></h3>
            
            <!-- Modal Message -->
            <p id="modal-message" class="text-gray-600 mt-2"></p>
            
            <!-- Close Button -->
            <button id="close-modal-btn" class="mt-8 w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-colors">
                Close
            </button>
        </div>
    </div>

    <script>
        // Get all the DOM elements we need to interact with
        const statusModal = document.getElementById('statusModal');
        const modalContent = document.getElementById('modal-content');
        const modalTitle = document.getElementById('modal-title');
        const modalMessage = document.getElementById('modal-message');
        const closeModalBtn = document.getElementById('close-modal-btn');
        const showSuccessBtn = document.getElementById('show-success-btn');
        const showFailBtn = document.getElementById('show-fail-btn');
        
        // FIXED: Use 'let' to allow re-assignment after cloning
        let successIcon = document.getElementById('success-icon');
        let failIcon = document.getElementById('fail-icon');

        /**
         * Shows the modal with a specific status and content.
         * @param {('success'|'fail')} status - The status to display.
         * @param {string} title - The main title for the modal.
         * @param {string} message - The detailed message for the modal.
         */
        function showModal(status, title, message) {
            // FIXED: Hide both icons at the start to prevent overlap
            successIcon.classList.add('hidden');
            failIcon.classList.add('hidden');

            // Set content
            modalTitle.textContent = title;
            modalMessage.textContent = message;

            // Configure based on status
            if (status === 'success') {
                // To restart the animation, we clone the node and replace it.
                const newSuccessIcon = successIcon.cloneNode(true);
                newSuccessIcon.classList.remove('hidden'); // Show the clone
                successIcon.parentNode.replaceChild(newSuccessIcon, successIcon);
                // Update our variable to point to the new, active element
                successIcon = newSuccessIcon;
            } else if (status === 'fail') {
                // Same logic for the fail icon
                const newFailIcon = failIcon.cloneNode(true);
                newFailIcon.classList.remove('hidden');
                failIcon.parentNode.replaceChild(newFailIcon, failIcon);
                failIcon = newFailIcon;
            }

            // Show the modal
            statusModal.classList.remove('hidden');
            
            // Add animation classes
            modalContent.classList.remove('modal-leave-active');
            modalContent.classList.add('modal-enter-active');
        }

        /**
         * Hides the modal with an animation.
         */
        function hideModal() {
            modalContent.classList.remove('modal-enter-active');
            modalContent.classList.add('modal-leave-active');
            
            // Wait for the animation to finish before hiding the modal completely
            setTimeout(() => {
                statusModal.classList.add('hidden');
            }, 300); // Should match the transition duration
        }

        // --- Event Listeners ---

        showSuccessBtn.addEventListener('click', () => {
            const fakeJsonResponse = { status: 'success', data: { message: 'Your payment was processed successfully.' } };
            
            if (fakeJsonResponse.status === 'success') {
                showModal('success', 'Payment Successful!', fakeJsonResponse.data.message);
            }
        });

        showFailBtn.addEventListener('click', () => {
             const fakeJsonResponse = { status: 'error', error: { code: 'E401', message: 'There was an issue with your credit card.' } };
             
             if(fakeJsonResponse.status === 'error'){
                showModal('fail', 'Payment Failed', fakeJsonResponse.error.message);
             }
        });

        closeModalBtn.addEventListener('click', hideModal);

        statusModal.addEventListener('click', (event) => {
            if (event.target === statusModal) {
                hideModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !statusModal.classList.contains('hidden')) {
                hideModal();
            }
        });
    </script>

</body>
</html>
