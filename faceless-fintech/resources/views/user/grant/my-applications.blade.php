@extends('layouts.dash2')
@section('title', 'My Grant Applications')

@section('content')
    <div class="container px-4 py-6 mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">My Grant Applications</h1>
            <a href="{{ route('grant.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
                New Application
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            @if(count($applications) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Application ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date Submitted
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Requested Amount
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($applications as $application)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $application->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ ucfirst($application->type) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $application->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ Auth::user()->s_curr }}{{ number_format($application->requested_amount, 2, '.', ',') }}
                                    </td>
                                   <td class="px-6 py-4 whitespace-nowrap">
                                        @if($application->status == 'approved')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Approved
                                            </span>
                                        @elseif($application->status == 'processing')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Processing
                                            </span>
                                        @elseif($application->status == 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Pending
                                            </span>
                                        @elseif($application->status == 'rejected')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Not Approved
                                            </span>
                                        @elseif($application->status == 'disbursed')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                Disbursed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('grant.view', $application->id) }}" class="text-primary-600 hover:text-primary-900 mr-3">
                                            <i data-lucide="eye" class="h-4 w-4 inline"></i>
                                            View
                                        </a>
                                        @if($application->status == 'pending' || $application->status == 'processing')
                                            <a href="{{ route('grant.edit', $application->id) }}" class="text-blue-600 hover:text-blue-900">
                                                <i data-lucide="edit" class="h-4 w-4 inline"></i>
                                                Edit
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $applications->links() }}
                </div>
            @else
                <div class="p-8 text-center">
                    <div class="mb-6">
                        <div class="h-16 w-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto">
                            <i data-lucide="file-text" class="h-8 w-8 text-gray-400"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Applications Yet</h3>
                    <p class="text-gray-500 mb-6">You haven't submitted any grant applications yet.</p>
                    <a href="{{ route('grant.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
                        Start New Application
                    </a>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-primary-50 to-white border-b border-gray-100 px-6 py-4">
                <h2 class="text-lg font-medium text-gray-900">Grant Application FAQ</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-base font-medium text-gray-900">How long does the application review process take?</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Applications are typically reviewed within 3-5 business days. You will be notified by email once a decision has been made.
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-base font-medium text-gray-900">Can I edit my application after submission?</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            You may edit your application while it is still in "Processing" status. Once the status changes, no further edits can be made.
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-base font-medium text-gray-900">How soon can I reapply if my application is not approved?</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            You may submit a new application 30 days after receiving a decision on your previous application.
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-base font-medium text-gray-900">Need more help?</h3>
                      <p class="mt-1 text-sm text-gray-500">
                            Contact our support team at <a href="mailto:{{ $contact_email }}" class="text-primary-600 hover:text-primary-700">{{ $contact_email }}</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
