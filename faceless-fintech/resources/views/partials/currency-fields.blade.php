<!-- Currency -->
<div>
    <label for="curr" class="block text-sm font-medium text-gray-700 mb-2">Currency *</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
            <i data-lucide="banknote" class="h-5 w-5 text-gray-400"></i>
        </div>
        <select 
            id="curr" 
            name="curr" 
            x-model="formData.curr"
            @change="formData.s_curr = $event.target.options[$event.target.selectedIndex].dataset.symbol"
            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 appearance-none"
            required>
            <option value="" disabled selected>Select your currency</option>
            @include('partials.currencies')
        </select>
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
            <i data-lucide="chevron-down" class="h-5 w-5 text-gray-400"></i>
        </div>
    </div>
</div>

<!-- Currency Symbol (Hidden, will be automatically populated) -->
<input type="hidden" name="s_curr" id="s_curr" x-model="formData.s_curr">