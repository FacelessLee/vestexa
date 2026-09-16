{{-- resources/views/partials/international/modals-and-scripts.blade.php --}}
<!-- Security Notice -->
<div class="mt-4 mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded-2xl bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-sm">
    <div class="flex items-start">
        <div class="flex-shrink-0 mt-0.5">
            <i class="fa-solid fa-shield-halved text-primary-500 dark:text-primary-400 text-sm"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-xs font-medium text-gray-900 dark:text-white">Secure Transaction</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">All transfers are encrypted and processed securely. Never share your PIN with anyone.</p>
        </div>
    </div>
</div>

<!-- Transfer Preview Modal -->
<div x-show="showPreview" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div 
            x-show="showPreview" 
            x-transition:enter="ease-out duration-300" 
            x-transition:enter-start="opacity-0" 
            x-transition:enter-end="opacity-100" 
            x-transition:leave="ease-in duration-200" 
            x-transition:leave-start="opacity-100" 
            x-transition:leave-end="opacity-0" 
            class="fixed inset-0 transition-opacity" 
            @click="showPreview = false"
        >
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div 
            x-show="showPreview" 
            x-transition:enter="ease-out duration-300" 
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
            x-transition:leave="ease-in duration-200" 
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
            class="inline-block align-bottom bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl text-left overflow-hidden shadow-2xl border border-white/20 dark:border-gray-700/50 transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            @click.away="showPreview = false"
        >
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 dark:bg-primary-900/30 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fa-solid fa-circle-check text-primary-600 dark:text-primary-400 text-lg"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                            Confirm Your Transfer
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Please review your transfer details before confirming. Once submitted, this transaction cannot be reversed.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-5 border-t border-gray-200 dark:border-gray-600 pt-4">
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="font-medium text-gray-500 dark:text-gray-400">Transfer Method</span>
                            <span class="text-gray-900 dark:text-white" x-text="withdrawMethod"></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="font-medium text-gray-500 dark:text-gray-400">Amount</span>
                            <template x-if="withdrawMethod !== 'Cryptocurrency'">
                                <span class="text-gray-900 dark:text-white font-bold" x-text="'{{ Auth::user()->s_curr }}' + parseFloat(amount).toFixed(2)"></span>
                            </template>
                            <template x-if="withdrawMethod === 'Cryptocurrency'">
                                <span class="text-gray-900 dark:text-white font-bold" x-text="parseFloat(amount).toFixed(8) + ' BTC'"></span>
                            </template>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="font-medium text-gray-500 dark:text-gray-400">Source</span>
                            <template x-if="withdrawMethod !== 'Cryptocurrency'">
                                <span class="text-gray-900 dark:text-white">Account Balance</span>
                            </template>
                            <template x-if="withdrawMethod === 'Cryptocurrency'">
                                <span class="text-gray-900 dark:text-white">Bitcoin Balance</span>
                            </template>
                        </div>
                        
                        <!-- Wire Transfer Details -->
                        <template x-if="withdrawMethod === 'Wire Transfer'">
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium text-gray-500 dark:text-gray-400">Recipient</span>
                                    <span class="text-gray-900 dark:text-white" x-text="accountName"></span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium text-gray-500 dark:text-gray-400">Account Number</span>
                                    <span class="text-gray-900 dark:text-white" x-text="accountNumber"></span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium text-gray-500 dark:text-gray-400">Bank</span>
                                    <span class="text-gray-900 dark:text-white" x-text="bankName"></span>
                                </div>
                            </div>
                        </template>
                        
                        <!-- Cryptocurrency Details -->
                        <template x-if="withdrawMethod === 'Cryptocurrency'">
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium text-gray-500 dark:text-gray-400">Cryptocurrency</span>
                                    <span class="text-gray-900 dark:text-white" x-text="cryptoCurrency + ' (' + cryptoNetwork + ')'"></span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium text-gray-500 dark:text-gray-400">Wallet Address</span>
                                    <span class="text-gray-900 dark:text-white truncate max-w-[220px]" x-text="walletAddress"></span>
                                </div>
                            </div>
                        </template>
                        
                        <!-- Common fields -->
                        <div class="pt-3 border-t border-gray-200 dark:border-gray-600">
                            <div class="flex justify-between text-sm">
                                <span class="font-medium text-gray-500 dark:text-gray-400">Total Amount</span>
                                <template x-if="withdrawMethod !== 'Cryptocurrency'">
                                    <span class="text-gray-900 dark:text-white font-bold" x-text="'{{ Auth::user()->s_curr }}' + parseFloat(amount).toFixed(2)"></span>
                                </template>
                                <template x-if="withdrawMethod === 'Cryptocurrency'">
                                    <span class="text-gray-900 dark:text-white font-bold" x-text="parseFloat(amount).toFixed(8) + ' BTC'"></span>
                                </template>
                            </div>
                            <div class="flex justify-between text-sm mt-1">
                                <span class="font-medium text-gray-500 dark:text-gray-400">New Balance</span>
                                <template x-if="withdrawMethod !== 'Cryptocurrency'">
                                    <span class="text-gray-900 dark:text-white" x-text="'{{ Auth::user()->s_curr }}' + ({{ Auth::user()->account_bal }} - parseFloat(amount)).toFixed(2)"></span>
                                </template>
                                <template x-if="withdrawMethod === 'Cryptocurrency'">
                                    <span class="text-gray-900 dark:text-white" x-text="({{ Auth::user()->btc_balance ?? 0 }} - parseFloat(amount)).toFixed(8) + ' BTC'"></span>
                                </template>
                            </div>
                            <div class="flex justify-between text-sm mt-1" x-show="amount && parseFloat(amount) > 0">
                                <span class="font-medium text-gray-500 dark:text-gray-400">Equivalent Value</span>
                                <template x-if="withdrawMethod !== 'Cryptocurrency'">
                                    <span class="text-gray-900 dark:text-white" x-text="'≈ ' + (parseFloat(amount) / {{ $btc_rate }}).toLocaleString('en-US', {minimumFractionDigits: 8, maximumFractionDigits: 8}) + ' BTC'"></span>
                                </template>
                                <template x-if="withdrawMethod === 'Cryptocurrency'">
                                    <span class="text-gray-900 dark:text-white" x-text="'≈ {{ Auth::user()->s_curr }}' + (parseFloat(amount) * {{ $btc_rate }}).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})"></span>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200/50 dark:border-gray-600/50">
                    <button 
                        type="button" 
                        class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-lg px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-base font-semibold text-white hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] sm:ml-3 sm:w-auto sm:text-sm"
                        @click="submitForm()"
                    >
                        <span class="flex items-center">
                            <i class="fa-solid fa-circle-check text-sm mr-2"></i>
                            Confirm Transfer
                        </span>
                    </button>
                    <button 
                        type="button" 
                        class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-3 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm text-base font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        @click="showPreview = false"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Processing Modal (Hidden by default) -->
<div id="processingModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-900/75 backdrop-blur-sm"></div>
        
        <!-- Modal panel -->
        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 sm:align-middle sm:max-w-lg">
            <!-- Processing animation and content -->
            <div class="text-center py-6">
                <!-- Animated bank card with pulse effect -->
                <div class="relative mx-auto w-64 h-40 mb-8 perspective-500">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500 to-primary-700 rounded-xl shadow-lg transform rotate-y-10 rotate-x-5 animate-card-float">
                        <!-- Card chip -->
                        <div class="absolute top-6 left-6 w-10 h-8 bg-yellow-300 bg-opacity-80 rounded-md grid grid-cols-3 grid-rows-3 gap-px p-1">
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                            <div class="bg-yellow-600 rounded-sm"></div>
                        </div>
                        
                        <!-- Animated pulse circles -->
                        <div class="absolute bottom-6 right-8 w-8 h-8 rounded-full bg-blue-400 bg-opacity-70 flex items-center justify-center">
                            <div class="absolute w-full h-full rounded-full bg-blue-400 animate-ping opacity-75"></div>
                            <div class="absolute w-8 h-8 rounded-full border-2 border-white border-opacity-50"></div>
                            <div class="absolute w-6 h-6 rounded-full border-2 border-white border-opacity-50"></div>
                        </div>
                        
                        <!-- Card number dots -->
                        <div class="absolute bottom-14 left-6 right-6 flex justify-between">
                            <div class="w-10 h-2 bg-white bg-opacity-50 rounded-full"></div>
                            <div class="w-10 h-2 bg-white bg-opacity-50 rounded-full"></div>
                            <div class="w-10 h-2 bg-white bg-opacity-50 rounded-full"></div>
                            <div class="w-10 h-2 bg-white bg-opacity-50 rounded-full"></div>
                        </div>
                        
                        <!-- Card holder info -->
                        <div class="absolute bottom-6 left-6 text-white text-opacity-80 text-xs font-medium tracking-wider">
                            <span id="cardHolderName"></span>
                        </div>
                    </div>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" id="processingMessage">Initiating transfer...</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Please do not close this window</p>
                
                <!-- Progress bar with percentage -->
                <div class="mb-6">
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
                        <div id="progressBar" class="bg-gradient-to-r from-primary-500 to-primary-600 h-3 rounded-full transition-all duration-300 ease-out" style="width: 0%"></div>
                    </div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-2"><span id="progressPercentage">0</span>% Complete</p>
                </div>
                
                <!-- Transaction details -->
                <div class="bg-gray-50/80 dark:bg-gray-700/50 backdrop-blur-sm rounded-xl p-4 text-left border border-gray-200/50 dark:border-gray-600/50 mb-4">
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Amount</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}<span id="modalAmount"></span></p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Method</p>
                            <p class="font-medium text-gray-900 dark:text-white" id="modalMethod"></p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Recipient</p>
                            <p class="font-medium text-gray-900 dark:text-white" id="modalRecipient"></p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Country</p>
                            <p class="font-medium text-gray-900 dark:text-white" id="modalCountry"></p>
                        </div>
                    </div>
                </div>
                
                <!-- Security message -->
                <div class="flex items-center justify-center text-sm text-gray-500 dark:text-gray-400">
                    <i class="fa-solid fa-shield-halved h-4 w-4 mr-2 text-primary-500 dark:text-primary-400"></i>
                    <span>Secured by bank-level encryption</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Account Status Modal (Hidden by default) -->
<div id="accountStatusModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-900/75 backdrop-blur-sm"></div>
        
        <!-- Modal panel -->
        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 sm:align-middle sm:max-w-lg">
            <div class="text-center py-6">
                <div class="mx-auto w-16 h-16 mb-6 flex items-center justify-center rounded-2xl bg-amber-100 dark:bg-amber-900/50">
                    <i class="fa-solid fa-triangle-exclamation text-2xl text-amber-600 dark:text-amber-400"></i>
                </div>
                
                <h3 id="accountStatusTitle" class="text-xl font-bold text-gray-900 dark:text-white mb-2">Account Status</h3>
                <p id="accountStatusMessage" class="text-gray-500 dark:text-gray-400 mb-6">Your account status requires attention.</p>
                
                <div class="mt-6">
                    <button type="button" onclick="window.location.href='{{ route('dashboard') }}'" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-semibold rounded-xl shadow-lg text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]">
                        <i class="fa-solid fa-home mr-2"></i>
                        Return to Dashboard
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    
    .perspective-500 {
        perspective: 500px;
    }
    
    .rotate-y-10 {
        transform: rotateY(10deg);
    }
    
    .rotate-x-5 {
        transform: rotateX(5deg);
    }
    
    @keyframes card-float {
        0%, 100% { transform: translateY(0) rotateY(10deg) rotateX(5deg); }
        50% { transform: translateY(-10px) rotateY(15deg) rotateX(5deg); }
    }
    
    .animate-card-float {
        animation: card-float 3s ease-in-out infinite;
    }
</style>

<script>
    // Function to show account status modal
    function showAccountStatusModal(status, message) {
        // Get modal element
        const statusModal = document.getElementById('accountStatusModal');
        
        // Set modal content based on status
        const statusColor = status === 'on-hold' ? 'amber' : 'red';
        const statusIcon = status === 'on-hold' ? 'fa-triangle-exclamation' : 'fa-shield-xmark';
        const statusTitle = status === 'on-hold' ? 'Account On Hold' : 'Account Suspended';
        
        // Update icon container color
        const iconContainer = statusModal.querySelector('.rounded-full');
        if (status === 'on-hold') {
            iconContainer.className = 'mx-auto w-16 h-16 mb-6 flex items-center justify-center rounded-full bg-amber-100';
        } else {
            iconContainer.className = 'mx-auto w-16 h-16 mb-6 flex items-center justify-center rounded-full bg-red-100';
        }
        
        // Update icon
        const icon = statusModal.querySelector('i');
        icon.className = `fa-solid ${statusIcon} h-8 w-8 ${status === 'on-hold' ? 'text-amber-600' : 'text-red-600'}`;
        
        // Update text content
        statusModal.querySelector('#accountStatusTitle').textContent = statusTitle;
        statusModal.querySelector('#accountStatusMessage').textContent = message;
        
        // Show modal
        statusModal.classList.remove('hidden');
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Processing modal functionality
        window.showProcessingModal = showProcessingModalFunction = function() {
            const processingModal = document.getElementById('processingModal');
            const progressBar = document.getElementById('progressBar');
            const processingMessage = document.getElementById('processingMessage');
            const form = document.getElementById('internationalTransferForm');
            
            // Get form data for display in modal
            const amountInput = document.querySelector('[name="amount"]');
            const methodElement = document.querySelector('[x-model="withdrawMethod"]') || { value: document.querySelector('[x-text="withdrawMethod"]')?.textContent || 'International Transfer' };
            const recipientInput = document.querySelector('[name="accountName"]') || document.querySelector('[name="paypalEmail"]') || document.querySelector('[name="walletAddress"]');
            const countryInput = document.querySelector('[name="country"]');
            
            // Update modal with form data
            document.getElementById('modalAmount').textContent = parseFloat(amountInput?.value || 0).toFixed(2);
            document.getElementById('modalMethod').textContent = methodElement.value || 'International Transfer';
            document.getElementById('modalRecipient').textContent = recipientInput?.value || 'Recipient';
            document.getElementById('modalCountry').textContent = countryInput?.value || '';
            document.getElementById('cardHolderName').textContent = recipientInput?.value?.substring(0, 20) || 'Recipient';
            
            // Processing messages for different stages
            const processingMessages = [
                'Initiating transfer...',
                'Verifying account details...',
                'Processing transaction...',
                'Confirming with bank...',
                'Finalizing transfer...'
            ];
            
            // Show processing modal
            processingModal.classList.remove('hidden');
            
            // Reset progress
            let progress = 0;
            let currentStage = 0;
            progressBar.style.width = '0%';
            processingMessage.textContent = processingMessages[0];
            
            // Simulate processing with progress updates
            const totalDuration = 5000; // 5 seconds minimum
            const interval = 50; // Update every 50ms for smooth animation
            const steps = totalDuration / interval;
            const progressIncrement = 100 / steps;
            
            const progressInterval = setInterval(function() {
                progress += progressIncrement;
                progressBar.style.width = progress + '%';
                document.getElementById('progressPercentage').textContent = Math.min(Math.round(progress), 100);
                
                // Update message at certain progress points
                if (progress >= 20 && currentStage < 1) {
                    currentStage = 1;
                    processingMessage.textContent = processingMessages[1];
                } else if (progress >= 40 && currentStage < 2) {
                    currentStage = 2;
                    processingMessage.textContent = processingMessages[2];
                } else if (progress >= 60 && currentStage < 3) {
                    currentStage = 3;
                    processingMessage.textContent = processingMessages[3];
                } else if (progress >= 80 && currentStage < 4) {
                    currentStage = 4;
                    processingMessage.textContent = processingMessages[4];
                }
                
                // When progress is complete
                if (progress >= 100) {
                    clearInterval(progressInterval);
                    
                    // Check account status before submitting the form
                    fetch('{{ route("check.account.status") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ check_status: true }),
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'on-hold' || data.status === 'suspended') {
                            // Hide processing modal
                            processingModal.classList.add('hidden');
                            
                            // Show account status modal
                            showAccountStatusModal(data.status, data.message);
                        } else {
                            // Account is active, proceed with form submission
                            setTimeout(function() {
                                // Ensure form is submitted as POST
                                form.method = 'post';
                                form.submit();
                            }, 200);
                        }
                    })
                    .catch(error => {
                        console.error('Error checking account status:', error);
                        // Proceed with form submission anyway if there's an error checking status
                        setTimeout(function() {
                            form.method = 'post';
                            form.submit();
                        }, 200);
                    });
                }
            }, interval);
        };
    });
</script>

<!-- Script to auto-select cryptocurrency when directed from dashboard -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if cryptocurrency was pre-selected via URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const method = urlParams.get('method');
        
        if (method === 'cryptocurrency') {
            // Scroll to the form section after Alpine.js has initialized
            setTimeout(function() {
                const formSection = document.querySelector('.max-w-4xl.mx-auto');
                if (formSection) {
                    window.scrollTo({
                        top: formSection.offsetTop - 50,
                        behavior: 'smooth'
                    });
                }
            }, 500);
        }
    });
</script>