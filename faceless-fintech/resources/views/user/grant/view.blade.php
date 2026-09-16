@extends('layouts.dash2')
@section('title', 'View Grant Application')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-3 lg:p-4">
    <div class="max-w-7xl mx-auto">
        <!-- Alerts -->
        <x-danger-alert />
        <x-success-alert />
        <x-error-alert />

        <!-- Mobile Header -->
        <div class="lg:hidden mb-2">
            @include('partials._mobile_header', [
                'title' => 'Application #' . $application->id,
                'showBackButton' => true,
                'backUrl' => route('grant.myApplications'),
                'showNotifications' => true,
                'showDarkMode' => true,
                'financeUser' => Auth::user(),
                'actionButton' => ($application->status == 'pending' || $application->status == 'processing') ? [
                    'text' => 'Edit',
                    'icon' => 'edit',
                    'url' => route('grant.edit', $application->id)
                ] : null
            ])
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:flex items-center justify-between mb-4">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Application #{{ $application->id }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Submitted on {{ $application->created_at->format('F d, Y \a\t h:ia') }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('grant.myApplications') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                    <i class="fas fa-arrow-left mr-2 text-xs"></i>
                    Back to Applications
                </a>
                @if($application->status == 'pending' || $application->status == 'processing')
                    <a href="{{ route('grant.edit', $application->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-edit mr-2 text-xs"></i>
                        Edit Application
                    </a>
                @endif
            </div>
        </div>

        <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden mb-4">
            <div class="bg-gradient-to-r from-primary-50/80 to-white/80 dark:from-primary-900/20 dark:to-gray-800/80 backdrop-blur-sm border-b border-gray-100/50 dark:border-gray-700/50 px-4 py-3 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Application Details</h2>
                <div>
                    @if($application->status == 'disbursed')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300">
                            <span class="h-2 w-2 mr-1.5 rounded-full bg-green-400"></span>
                            Funds Disbursed
                        </span>
                    @elseif($application->status == 'approved')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300">
                            <span class="h-2 w-2 mr-1.5 rounded-full bg-green-400"></span>
                            Approved
                        </span>
                    @elseif($application->status == 'processing')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300">
                            <span class="h-2 w-2 mr-1.5 rounded-full bg-yellow-400"></span>
                            Processing
                        </span>
                    @elseif($application->status == 'pending')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                            <span class="h-2 w-2 mr-1.5 rounded-full bg-blue-400"></span>
                            Pending
                        </span>
                    @elseif($application->status == 'rejected')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300">
                            <span class="h-2 w-2 mr-1.5 rounded-full bg-red-400"></span>
                            Not Approved
                        </span>
                    @endif
                </div>
            </div>
            <div class="p-4 lg:p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-5">
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Basic Information</h3>
                        <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg p-3 space-y-3">
                            <div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Application Type</div>
                                <div class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst($application->application_type) }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount Requested</div>
                                <div class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->s_curr }}{{ number_format($application->requested_amount, 2, '.', ',') }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Reference Number</div>
                                <div class="mt-1 text-sm text-gray-900 dark:text-white">{{ $application->reference_number }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Applicant Information</h3>
                        <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg p-3 space-y-3">
                            <div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</div>
                                <div class="mt-1 text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</div>
                                <div class="mt-1 text-sm text-gray-900 dark:text-white">{{ Auth::user()->email }}</div>
                            </div>
                            @if($application->type == 'individual')
                                <div>
                                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Phone Number</div>
                                    <div class="mt-1 text-sm text-gray-900 dark:text-white">{{ $application->phone_number }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($application->type == 'individual')
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Funding Purposes</h3>
                        <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg p-3">
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                @if($application->program_funding)
                                    <li class="flex items-center text-sm text-gray-800 dark:text-gray-200">
                                        <i class="fas fa-check-circle text-green-500 dark:text-green-400 mr-2 text-xs"></i>
                                        Program Funding
                                    </li>
                                @endif
                                @if($application->research_funding)
                                    <li class="flex items-center text-sm text-gray-800 dark:text-gray-200">
                                        <i class="fas fa-check-circle text-green-500 dark:text-green-400 mr-2 text-xs"></i>
                                        Research & Development
                                    </li>
                                @endif
                                @if($application->operations_funding)
                                    <li class="flex items-center text-sm text-gray-800 dark:text-gray-200">
                                        <i class="fas fa-check-circle text-green-500 dark:text-green-400 mr-2 text-xs"></i>
                                        Operational Expenses
                                    </li>
                                @endif
                                @if($application->capacity_funding)
                                    <li class="flex items-center text-sm text-gray-800 dark:text-gray-200">
                                        <i class="fas fa-check-circle text-green-500 dark:text-green-400 mr-2 text-xs"></i>
                                        Capacity Building
                                    </li>
                                @endif
                                @if($application->other_funding)
                                    <li class="flex items-center text-sm text-gray-800 dark:text-gray-200">
                                        <i class="fas fa-check-circle text-green-500 dark:text-green-400 mr-2 text-xs"></i>
                                        Other Purposes
                                    </li>
                                @endif
                            </ul>
                            
                            @if($application->funding_details)
                                <div class="mt-3 border-t border-gray-200/50 dark:border-gray-600/50 pt-3">
                                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Additional Details</div>
                                    <p class="text-sm text-gray-800 dark:text-gray-200">{{ $application->funding_details }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                
                @if($application->type == 'company')
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Organization Information</h3>
                        <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg p-3 space-y-3">
                            <div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Legal Name</div>
                                <div class="mt-1 text-sm text-gray-900 dark:text-white">{{ $application->legal_name }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tax ID / EIN</div>
                                <div class="mt-1 text-sm text-gray-900 dark:text-white">{{ $application->tax_id }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Organization Type</div>
                                <div class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst($application->organization_type) }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Founding Year</div>
                                <div class="mt-1 text-sm text-gray-900 dark:text-white">{{ $application->founding_year }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Mission Statement</div>
                                <div class="mt-1 text-sm text-gray-800 dark:text-gray-200">{{ $application->mission_statement }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Project Information</h3>
                        <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg p-3">
                            <div class="space-y-3">
                                <div>
                                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Project Title</div>
                                    <div class="mt-1 text-sm text-gray-900 dark:text-white">{{ $application->project_title }}</div>
                                </div>
                                <div>
                                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Project Description</div>
                                    <div class="mt-1 text-sm text-gray-800 dark:text-gray-200">{{ $application->project_description }}</div>
                                </div>
                                <div>
                                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Expected Outcomes</div>
                                    <div class="mt-1 text-sm text-gray-800 dark:text-gray-200">{{ $application->expected_outcomes }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="mt-6">
                    <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Application Timeline</h3>
                    <div class="bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg p-3">
                        <div class="space-y-3">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center">
                                        <i class="fas fa-file-plus text-primary-600 dark:text-primary-400 text-xs"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Application Submitted</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $application->created_at->format('F d, Y \a\t h:ia') }}</div>
                                </div>
                            </div>
                            
                            @if($application->status != 'pending')
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                                            <i class="fas fa-clock text-blue-600 dark:text-blue-400 text-xs"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Review Started</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Application is being reviewed by our team</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if(in_array($application->status, ['approved', 'rejected', 'disbursed']))
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full {{ $application->status == 'approved' || $application->status == 'disbursed' ? 'bg-green-100 dark:bg-green-900/50' : 'bg-red-100 dark:bg-red-900/50' }} flex items-center justify-center">
                                            <i class="fas {{ $application->status == 'approved' || $application->status == 'disbursed' ? 'fa-check' : 'fa-times' }} {{ $application->status == 'approved' || $application->status == 'disbursed' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} text-xs"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $application->status == 'approved' ? 'Application Approved' : ($application->status == 'disbursed' ? 'Funds Disbursed' : 'Application Not Approved') }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            @if($application->status == 'approved')
                                                Your application has been approved for funding
                                            @elseif($application->status == 'disbursed')
                                                Funds have been successfully disbursed to your account
                                            @else
                                                Your application was not approved at this time
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($application->admin_notes)
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Administrative Notes</h3>
                        <div class="bg-blue-50/80 dark:bg-blue-900/20 backdrop-blur-sm border border-blue-200/50 dark:border-blue-700/50 rounded-lg p-3">
                            <p class="text-sm text-blue-800 dark:text-blue-300">{{ $application->admin_notes }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        @if($application->status == 'approved' || $application->status == 'disbursed')
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-xl shadow-sm border border-white/20 dark:border-gray-700/50 overflow-hidden">
                <div class="bg-gradient-to-r from-green-50/80 to-emerald-50/80 dark:from-green-900/20 dark:to-emerald-900/20 backdrop-blur-sm border-b border-green-100/50 dark:border-green-700/50 px-4 py-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400 mr-2"></i>
                        Grant Award Information
                    </h2>
                </div>
                <div class="p-4 lg:p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Approved Amount</div>
                            <div class="mt-1 text-lg font-semibold text-green-600 dark:text-green-400">
                                {{ Auth::user()->s_curr }}{{ number_format($application->approved_amount ?? $application->requested_amount, 2, '.', ',') }}
                            </div>
                        </div>
                        <div>
                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Award Date</div>
                            <div class="mt-1 text-sm text-gray-900 dark:text-white">
                                {{ $application->approved_at ? $application->approved_at->format('F d, Y') : 'Pending' }}
                            </div>
                        </div>
                    </div>
                    
                    @if($application->status == 'disbursed')
                        <div class="mt-4 p-3 bg-green-50/80 dark:bg-green-900/20 backdrop-blur-sm border border-green-200/50 dark:border-green-700/50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-600 dark:text-green-400 mr-2"></i>
                                <span class="text-sm font-medium text-green-800 dark:text-green-300">
                                    Funds have been successfully disbursed to your account.
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
