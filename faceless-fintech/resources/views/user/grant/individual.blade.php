@extends('layouts.dash2')
@section('title', 'Individual Grant Application')

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
                'title' => 'Individual Grant',
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
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Individual Grant Application</h1>
            </div>
        </div>

        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden mb-4">
            <div class="bg-gradient-to-r from-primary-50/80 to-white/80 dark:from-primary-900/20 dark:to-gray-800/80 backdrop-blur-sm border-b border-gray-100/50 dark:border-gray-700/50 px-4 py-3">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-user mr-2 text-primary-500 dark:text-primary-400 text-sm"></i>
                    Apply as Individual
                </h2>
            </div>
            
            <div class="p-4 lg:p-5">
                <form action="{{ route('grant.storeIndividual') }}" method="POST">
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
                    
                    <div class="space-y-5 mb-6">
                        <div>
                            <label for="requested_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Requested Amount <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                    <span class="text-gray-500 dark:text-gray-400 text-sm">{{ Auth::user()->s_curr }}</span>
                                </div>
                                <input type="number" name="requested_amount" id="requested_amount" min="1" value="{{ old('requested_amount', $application ? $application->requested_amount : 5000) }}" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 px-2 py-2.5 pl-12 border block w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 relative z-0" required>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter the amount you would like to request for your grant</p>
                            @error('requested_amount')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="text-gray-700 dark:text-gray-300 mb-4">
                        <p class="text-sm">Please select all funding purposes that apply to your application:</p>
                    </div>
                    
                    <div class="space-y-4 mb-6">
                        <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 transition-all hover:shadow-sm">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="program_funding" name="program_funding" type="checkbox" value="1" {{ old('program_funding') ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary-600 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded focus:ring-primary-500">
                                </div>
                                <div class="ml-3">
                                    <label for="program_funding" class="text-sm font-medium text-gray-900 dark:text-white">Program Funding</label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Support for developing or expanding educational, cultural, or social programs.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 transition-all hover:shadow-sm">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="equipment_funding" name="equipment_funding" type="checkbox" value="1" {{ old('equipment_funding') ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary-600 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded focus:ring-primary-500">
                                </div>
                                <div class="ml-3">
                                    <label for="equipment_funding" class="text-sm font-medium text-gray-900 dark:text-white">Equipment Funding</label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Support for purchasing necessary equipment or technology.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 transition-all hover:shadow-sm">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="research_funding" name="research_funding" type="checkbox" value="1" {{ old('research_funding') ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary-600 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded focus:ring-primary-500">
                                </div>
                                <div class="ml-3">
                                    <label for="research_funding" class="text-sm font-medium text-gray-900 dark:text-white">Research Funding</label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Support for conducting research or studies in your field.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-lg p-3 transition-all hover:shadow-sm">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="community_outreach" name="community_outreach" type="checkbox" value="1" {{ old('community_outreach') ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary-600 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded focus:ring-primary-500">
                                </div>
                                <div class="ml-3">
                                    <label for="community_outreach" class="text-sm font-medium text-gray-900 dark:text-white">Community Outreach</label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Support for activities that benefit local communities or underserved populations.
                                    </p>
                                </div>
                            </div>
                        </div>
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
                        <a href="{{ route('grant.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                            <i class="fas fa-arrow-left mr-2 text-xs"></i>
                            Back
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
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
