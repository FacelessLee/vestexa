{{-- Quick Transfer Beneficiaries Component --}}
<div class="mb-6" x-show="!showBeneficiaryForm">
    <div class="flex justify-between items-center mb-3">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Quick Transfer</h3>
        <button 
            @click="loadBeneficiaries()"
            class="text-xs text-primary-600 dark:text-primary-400 font-medium flex items-center hover:text-primary-700 dark:hover:text-primary-300 transition-colors"
        >
            <i class="fa-solid fa-refresh mr-1 text-xs" :class="{'fa-spin': loading}"></i>
            Refresh
        </button>
    </div>
    
    <div class="flex space-x-3 overflow-x-auto pb-2" x-show="!loading">
        <!-- Add New Beneficiary -->
        <button 
            @click="showBeneficiaryForm = true"
            class="flex-shrink-0 flex flex-col items-center justify-center group"
        >
            <div class="w-14 h-14 rounded-full border-2 border-dashed border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 flex items-center justify-center mb-1 group-hover:bg-gray-100 dark:group-hover:bg-gray-700 group-hover:border-primary-400 dark:group-hover:border-primary-500 transition-all duration-200">
                <i class="fa-solid fa-plus text-gray-400 dark:text-gray-500 text-base group-hover:text-primary-500 dark:group-hover:text-primary-400 transition-colors"></i>
            </div>
            <span class="text-xs text-gray-500 dark:text-gray-400 text-center group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Add New</span>
        </button>

        <!-- Beneficiaries List -->
        <template x-for="beneficiary in beneficiaries" :key="beneficiary.id">
            <div class="flex-shrink-0 flex flex-col items-center justify-center group relative">
                <button 
                    @click="selectBeneficiary(beneficiary)"
                    class="relative w-14 h-14 rounded-full flex items-center justify-center mb-1 border-2 border-white dark:border-gray-800 shadow-sm dark:shadow-gray-900/25 hover:scale-105 transition-all duration-200"
                    :class="beneficiary.color"
                >
                    <span class="text-white font-semibold text-sm" x-text="beneficiary.initials"></span>
                    
                    <!-- Favorite Star -->
                    <div 
                        x-show="beneficiary.is_favorite" 
                        class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-400 rounded-full flex items-center justify-center"
                    >
                        <i class="fa-solid fa-star text-white text-xs"></i>
                    </div>
                </button>
                
                <span class="text-xs text-gray-700 dark:text-gray-300 text-center max-w-16 truncate" x-text="beneficiary.name"></span>
                
                <!-- Quick Actions on Hover -->
                <div class="absolute -top-2 -right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-10">
                    <div class="flex flex-col space-y-1">
                        <button 
                            @click.stop="toggleFavorite(beneficiary)"
                            class="w-6 h-6 rounded-full bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-600 flex items-center justify-center hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-colors"
                            :class="beneficiary.is_favorite ? 'text-yellow-500' : 'text-gray-400'"
                        >
                            <i class="fa-solid fa-star text-xs"></i>
                        </button>
                        <button 
                            @click.stop="deleteBeneficiary(beneficiary)"
                            class="w-6 h-6 rounded-full bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-600 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                        >
                            <i class="fa-solid fa-trash text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <!-- Loading State -->
        <template x-if="loading">
            <div class="flex space-x-3">
                <template x-for="i in 4">
                    <div class="flex-shrink-0 flex flex-col items-center justify-center">
                        <div class="w-14 h-14 rounded-full bg-gray-200 dark:bg-gray-700 animate-pulse mb-1"></div>
                        <div class="w-12 h-2 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                    </div>
                </template>
            </div>
        </template>

        <!-- Empty State -->
        <template x-if="!loading && beneficiaries.length === 0">
            <div class="flex-shrink-0 flex flex-col items-center justify-center py-8 px-4">
                <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-3">
                    <i class="fa-solid fa-users text-gray-400 dark:text-gray-500 text-xl"></i>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center">No saved beneficiaries yet</p>
                <p class="text-xs text-gray-400 dark:text-gray-500 text-center mt-1">Add one to get started</p>
            </div>
        </template>
    </div>
</div>

<!-- Add/Save Beneficiary Form -->
<div x-show="showBeneficiaryForm" x-cloak class="mb-6">
    <div class="bg-gradient-to-br from-blue-50/80 to-indigo-50/80 dark:from-blue-900/20 dark:to-indigo-900/20 backdrop-blur-sm rounded-xl border border-blue-200/50 dark:border-blue-700/50 p-4">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-bookmark text-white text-xs"></i>
                </div>
                <h3 class="text-base font-semibold text-gray-900 dark:text-white">Save as Beneficiary</h3>
            </div>
            <button 
                @click="showBeneficiaryForm = false; resetBeneficiaryForm()"
                class="text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 transition-colors"
            >
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="space-y-3">
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Beneficiary Name</label>
                <input 
                    type="text" 
                    x-model="beneficiaryName"
                    class="block w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                    placeholder="Enter a name for this beneficiary"
                />
            </div>

            <div class="flex items-center space-x-3">
                <label class="flex items-center">
                    <input 
                        type="checkbox" 
                        x-model="beneficiaryIsFavorite"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    />
                    <span class="ml-2 text-xs text-gray-700 dark:text-gray-300">Mark as favorite</span>
                </label>
            </div>

            <div class="flex space-x-2">
                <button 
                    @click="saveBeneficiary()"
                    :disabled="!beneficiaryName.trim() || savingBeneficiary"
                    class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <template x-if="!savingBeneficiary">
                        <div class="flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Save Beneficiary
                        </div>
                    </template>
                    <template x-if="savingBeneficiary">
                        <div class="flex items-center">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Saving...
                        </div>
                    </template>
                </button>
                <button 
                    @click="showBeneficiaryForm = false; resetBeneficiaryForm()"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>