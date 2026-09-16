@extends('layouts.app')
@section('title', 'Virtual Card Settings')

@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-center">{{ $title }}</h1>
                </div>
                
                @if (session('message'))
                    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                        <strong>{{ session('type') == 'success' ? 'Success!' : 'Error!' }}</strong> {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-5">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title">Feature Status</h4>
                            </div>
                            <div class="card-body">
                                <!-- Feature Status Card -->
                                <div class="card mb-4 text-white" style="background-image: linear-gradient(45deg, #2196F3, #1565C0); border-radius: 15px;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-4">
                                            <div>
                                                <i class="fa fa-credit-card fa-2x"></i>
                                            </div>
                                            <div>
                                                <h5 class="text-white mb-0">Virtual Card System</h5>
                                            </div>
                                        </div>
                                        <h5 class="text-white mb-3">
                                            System Status: {{ $cardSettings->is_enabled ? 'ACTIVE' : 'DISABLED' }}
                                        </h5>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <small class="text-white-50">LAST UPDATED</small>
                                                <p class="text-white mb-0">{{ $cardSettings->updated_at->format('M d, Y h:i A') }}</p>
                                            </div>
                                            <div>
                                                <small class="text-white-50">CREATED</small>
                                                <p class="text-white mb-0">{{ $cardSettings->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="font-weight-bold">Status</td>
                                                <td>
                                                    @if ($cardSettings->is_enabled)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Disabled</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Standard Card Fee</td>
                                                <td>${{ number_format($cardSettings->standard_fee, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Gold Card Fee</td>
                                                <td>${{ number_format($cardSettings->gold_fee, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Platinum Card Fee</td>
                                                <td>${{ number_format($cardSettings->platinum_fee, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Black Card Fee</td>
                                                <td>${{ number_format($cardSettings->black_fee, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Monthly Fee</td>
                                                <td>${{ number_format($cardSettings->monthly_fee, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Top-up Fee</td>
                                                <td>{{ number_format($cardSettings->topup_fee_percentage, 2) }}%</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Daily Limit Range</td>
                                                <td>${{ number_format($cardSettings->min_daily_limit, 2) }} - ${{ number_format($cardSettings->max_daily_limit, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="d-flex justify-content-between mt-3">
                                    <div>
                                        <a href="{{ route('admin.cards') }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-arrow-left"></i> Back to Cards
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('admin.cards.toggle') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn {{ $cardSettings->is_enabled ? 'btn-danger' : 'btn-success' }} btn-sm">
                                                <i class="fa {{ $cardSettings->is_enabled ? 'fa-toggle-off' : 'fa-toggle-on' }}"></i> 
                                                {{ $cardSettings->is_enabled ? 'Disable Feature' : 'Enable Feature' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Information Card -->
                        <div class="card shadow mt-4">
                            <div class="card-header">
                                <h4 class="card-title">Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <h5><i class="fa fa-info-circle mr-2"></i> Important Information</h5>
                                    <p class="mb-2">The card settings configured here affect the following aspects of virtual cards:</p>
                                    <ul class="pl-3">
                                        <li>Issuance fees charged to users when they apply for a new card</li>
                                        <li>Monthly maintenance fees automatically deducted from user accounts</li>
                                        <li>Top-up fees applied when users add funds to their card</li>
                                        <li>Daily spending limits that users can set for their cards</li>
                                    </ul>
                                    <p class="mt-2 mb-0">Changes to these settings will apply to new card applications and transactions.</p>
                                </div>
                                
                                <div class="mt-3">
                                    <h5>Admin Notes</h5>
                                    <p class="text-muted">{{ $cardSettings->description ?: 'No admin notes available.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-7">
                        <!-- Card Settings Form -->
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title">Edit Card Settings</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.cards.settings.update') }}" method="POST">
                                    @csrf
                                    <!-- Card Issuance Fees -->
                                    <div class="card bg-light mb-4">
                                        <div class="card-body">
                                            <h5 class="mb-3">Card Issuance Fees</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="standard_fee">Standard Card Fee ($)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input type="number" class="form-control" id="standard_fee" name="standard_fee" value="{{ $cardSettings->standard_fee }}" step="0.01" min="0" required>
                                                        </div>
                                                        <small class="text-muted">Fee for standard virtual card</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gold_fee">Gold Card Fee ($)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input type="number" class="form-control" id="gold_fee" name="gold_fee" value="{{ $cardSettings->gold_fee }}" step="0.01" min="0" required>
                                                        </div>
                                                        <small class="text-muted">Fee for gold virtual card</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="platinum_fee">Platinum Card Fee ($)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input type="number" class="form-control" id="platinum_fee" name="platinum_fee" value="{{ $cardSettings->platinum_fee }}" step="0.01" min="0" required>
                                                        </div>
                                                        <small class="text-muted">Fee for platinum virtual card</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="black_fee">Black Card Fee ($)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input type="number" class="form-control" id="black_fee" name="black_fee" value="{{ $cardSettings->black_fee }}" step="0.01" min="0" required>
                                                        </div>
                                                        <small class="text-muted">Fee for black virtual card</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Operating Fees -->
                                            <div class="card bg-light mb-4">
                                                <div class="card-body">
                                                    <h5 class="mb-3">Operating Fees</h5>
                                                    <div class="form-group">
                                                        <label for="monthly_fee">Monthly Fee ($)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input type="number" class="form-control" id="monthly_fee" name="monthly_fee" value="{{ $cardSettings->monthly_fee }}" step="0.01" min="0" required>
                                                        </div>
                                                        <small class="text-muted">Monthly maintenance fee</small>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <label for="topup_fee_percentage">Top-up Fee (%)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-percent"></i></span>
                                                            </div>
                                                            <input type="number" class="form-control" id="topup_fee_percentage" name="topup_fee_percentage" value="{{ $cardSettings->topup_fee_percentage }}" step="0.01" min="0" max="100" required>
                                                        </div>
                                                        <small class="text-muted">Percentage fee for card top-ups</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Spending Limits -->
                                            <div class="card bg-light mb-4">
                                                <div class="card-body">
                                                    <h5 class="mb-3">Spending Limits</h5>
                                                    <div class="form-group">
                                                        <label for="min_daily_limit">Minimum Daily Limit ($)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input type="number" class="form-control" id="min_daily_limit" name="min_daily_limit" value="{{ $cardSettings->min_daily_limit }}" step="0.01" min="0" required>
                                                        </div>
                                                        <small class="text-muted">Minimum daily spending limit</small>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <label for="max_daily_limit">Maximum Daily Limit ($)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input type="number" class="form-control" id="max_daily_limit" name="max_daily_limit" value="{{ $cardSettings->max_daily_limit }}" step="0.01" min="0" required>
                                                        </div>
                                                        <small class="text-muted">Maximum daily spending limit</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Admin Notes -->
                                    <div class="card bg-light mb-4">
                                        <div class="card-body">
                                            <h5 class="mb-3">Admin Notes</h5>
                                            <div class="form-group mb-0">
                                                <textarea class="form-control" name="description" rows="3" placeholder="Add notes about current configuration (only visible to admins)">{{ $cardSettings->description }}</textarea>
                                                <small class="text-muted">These notes are only visible to administrators</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fa fa-save mr-1"></i> Save Settings
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 