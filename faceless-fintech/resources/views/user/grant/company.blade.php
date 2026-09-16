@extends('layouts.dash2')
@section('title', 'Company Grant Application')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-3 lg:p-4">
    <div class="max-w-8xl mx-auto">
        <!-- Alerts -->
        <x-danger-alert />
        <x-success-alert />
        <x-error-alert />

        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Company Grant',
                'showBackButton' => true,
                'backUrl' => route('grant.index'),
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user()
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <a href="{{ route('grant.index') }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400 border border-gray-200 dark:border-gray-600 transition-colors">
                    <i class="fas fa-arrow-left text-xs"></i>
                </a>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Company Grant Application</h1>
            </div>
        </div>

        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden mb-4">
            <div class="bg-gradient-to-r from-secondary-50/80 to-white/80 dark:from-secondary-900/20 dark:to-gray-800/80 backdrop-blur-sm border-b border-gray-100/50 dark:border-gray-700/50 px-4 py-3">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-building mr-2 text-secondary-500 dark:text-secondary-400 text-sm"></i>
                    Apply as Company
                </h2>
            </div>
            
            <div class="p-4 lg:p-5">
                <form action="{{ route('grant.storeCompany') }}" method="POST">
                    @csrf
                    
                    @if($errors->any())
                        <div class="bg-red-50/90 dark:bg-red-900/20 backdrop-blur-sm border-l-4 border-red-500 dark:border-red-400 p-3 mb-4 rounded-r-xl">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-500 dark:text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800 dark:text-red-300">Please correct the following errors:</h3>
                                    <div class="mt-2 text-sm text-red-700 dark:text-red-400">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="text-gray-700 dark:text-gray-300 mb-4">
                        <p class="text-sm">Please provide the following information about your organization:</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <div>
                            <label for="legal_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Legal Name of Organization <span class="text-red-500">*</span></label>
                            <input type="text" name="legal_name" id="legal_name" value="{{ old('legal_name', $application ? $application->legal_name : '') }}" required
                                   class="mt-1 focus:ring-primary-500 px-2 py-2.5 border focus:border-primary-500 block w-full shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                        </div>
                        
                        <div>
                            <label for="tax_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tax ID / EIN <span class="text-red-500">*</span></label>
                            <input type="text" name="tax_id" id="tax_id" value="{{ old('tax_id', $application ? $application->tax_id : '') }}" required
                                   class="mt-1 focus:ring-primary-500 focus:border-primary-500 px-2 py-2.5 border block w-full shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: XX-XXXXXXX</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <div>
                            <label for="organization_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Organization Type <span class="text-red-500">*</span></label>
                            <select name="organization_type" id="organization_type" required
                                   class="mt-1 focus:ring-primary-500 focus:border-primary-500 px-2 py-2.5 border block w-full shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white">
                                <option value="" disabled {{ old('organization_type', $application ? $application->organization_type : '') ? '' : 'selected' }}>Select an option</option>
                                <option value="nonprofit" {{ old('organization_type', $application ? $application->organization_type : '') == 'nonprofit' ? 'selected' : '' }}>Nonprofit Organization</option>
                                <option value="for-profit" {{ old('organization_type', $application ? $application->organization_type : '') == 'for-profit' ? 'selected' : '' }}>For-Profit Business</option>
                                <option value="government" {{ old('organization_type', $application ? $application->organization_type : '') == 'government' ? 'selected' : '' }}>Government Entity</option>
                                <option value="educational" {{ old('organization_type', $application ? $application->organization_type : '') == 'educational' ? 'selected' : '' }}>Educational Institution</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="founding_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Founding Year <span class="text-red-500">*</span></label>
                            <input type="number" name="founding_year" id="founding_year" min="1900" max="{{ date('Y') }}" value="{{ old('founding_year', $application ? $application->founding_year : '') }}" required
                                   class="mt-1 focus:ring-primary-500 focus:border-primary-500 px-2 py-2.5 border block w-full shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                        </div>
                    </div>
                    
                    <div class="mb-5">
                        <label for="mailing_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Mailing Address <span class="text-red-500">*</span></label>
                        <textarea id="mailing_address" name="mailing_address" rows="3" required
                                  class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full px-2 py-2.5 border shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">{{ old('mailing_address') }}</textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number', $application ? $application->phone_number : '') }}" required
                                  class="mt-1 focus:ring-primary-500 focus:border-primary-500 block px-2 py-2.5 border w-full shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400" placeholder="(555) 123-4567">
                            @error('phone_number')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="contact_person" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Person <span class="text-red-500">*</span></label>
                            <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person', $application ? $application->contact_person : '') }}" required
                                  class="mt-1 focus:ring-primary-500 focus:border-primary-500 block px-2 py-2.5 border w-full shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                            @error('contact_person')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-5">
                        <label for="mission_statement" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mission Statement <span class="text-red-500">*</span></label>
                        <textarea id="mission_statement" name="mission_statement" rows="3" required
                                  class="mt-1 focus:ring-primary-500 focus:border-primary-500 px-2 py-2.5 border block w-full shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">{{ old('mission_statement', $application ? $application->mission_statement : '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Describe your organization's core mission and purpose</p>
                    </div>
                    
                    <div class="mb-5">
                        <label for="incorporation_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Incorporation <span class="text-red-500">*</span></label>
                        <input type="date" name="incorporation_date" id="incorporation_date" value="{{ old('incorporation_date') }}" required
                               class="mt-1 focus:ring-primary-500 focus:border-primary-500 px-2 py-2.5 border block w-full shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white">
                    </div>
                    
                    <div class="mb-5">
                        <label for="project_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Title <span class="text-red-500">*</span></label>
                        <input type="text" name="project_title" id="project_title" value="{{ old('project_title', $application ? $application->project_title : '') }}" required
                              class="mt-1 focus:ring-primary-500 focus:border-primary-500 px-2 py-2.5 border block w-full shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">A concise title for your grant-funded project</p>
                    </div>
                    
                    <div class="mb-5">
                        <label for="project_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Description <span class="text-red-500">*</span></label>
                        <textarea id="project_description" name="project_description" rows="4" required
                                  class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full px-2 py-2.5 border shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">{{ old('project_description', $application ? $application->project_description : '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Detailed description of the project for which funding is requested</p>
                    </div>
                    
                    <div class="mb-5">
                        <label for="expected_outcomes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expected Outcomes <span class="text-red-500">*</span></label>
                        <textarea id="expected_outcomes" name="expected_outcomes" rows="3" required
                                  class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full px-2 py-2.5 border shadow-sm text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">{{ old('expected_outcomes', $application ? $application->expected_outcomes : '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Describe the specific goals and measurable outcomes you expect to achieve</p>
                    </div>
                    
                    <div class="mb-5">
                        <label for="requested_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Requested Amount <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                <span class="text-gray-500 dark:text-gray-400 text-sm">{{ Auth::user()->s_curr }}</span>
                            </div>
                            <input type="number" name="requested_amount" id="requested_amount" min="1" step="0.01" 
                                   value="{{ old('requested_amount', $application ? $application->requested_amount : '5000') }}"
                                   class="focus:ring-primary-500 focus:border-primary-500 block w-full pl-12 px-2 py-2.5 border text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 relative z-0" required>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter the amount you would like to request for your project</p>
                    </div>
                    
                    <div class="bg-gradient-to-r from-blue-50/80 to-indigo-50/80 dark:from-blue-900/20 dark:to-indigo-900/20 backdrop-blur-sm border border-blue-200/50 dark:border-blue-700/50 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                                    <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-1">Important Information</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    By submitting this application, you acknowledge that the final approved amount will be determined during our review process based on your eligibility and requested amount. You'll receive notification once your application has been processed.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('grant.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500 transition-colors">
                            <i class="fas fa-arrow-left mr-2 text-xs"></i>
                            Back
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-secondary-600 to-secondary-700 hover:from-secondary-700 hover:to-secondary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500 transition-all duration-200">
                            Submit Application
                            <i class="fas fa-paper-plane ml-2 text-xs"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection