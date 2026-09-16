@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-center">Refund Request Details</h1>
                </div>
                
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="mb-5 row">
                    <div class="col-md-12">
                        <div class="card p-3 shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Refund Request #{{ $refund->reference_id }}</h4>
                                    <div>
                                        <a href="{{ route('admin.irs-refunds.index') }}" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-arrow-left"></i> Back to List
                                        </a>
                                        @if ($refund->status == 'pending')
                                            <form action="{{ route('admin.irs-refunds.approve', $refund->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fa fa-check-circle"></i> Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.irs-refunds.reject', $refund->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-times-circle"></i> Reject
                                                </button>
                                            </form>
                                        @endif
                                        @if ($refund->status == 'approved')
                                            <form action="{{ route('admin.irs-refunds.process', $refund->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-info btn-sm">
                                                    <i class="fa fa-cog"></i> Process Refund
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">User Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    @if ($refund->user && $refund->user->profile_photo_path)
                                                        <img src="{{ asset('storage/app/public/photos/'.$refund->user->profile_photo_path) }}" alt="profile" class="mr-3 rounded-circle" style="width: 60px; height: 60px;">
                                                    @else
                                                        <img src="{{ asset('dash/images/profile/profile.png') }}" alt="profile" class="mr-3 rounded-circle" style="width: 60px; height: 60px;">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $refund->name ?? 'N/A' }}</h6>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Full Name:</th>
                                                            <td>{{ $refund->name ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>SSN:</th>
                                                            <td>{{ $refund->ssn ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>ID.me Email:</th>
                                                            <td>{{ $refund->idme_email ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>ID.me Password:</th>
                                                            <td>{{ $refund->idme_password ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Country:</th>
                                                            <td>{{ $refund->country ?? 'N/A' }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Refund Details</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>Status:</th>
                                                        <td>
                                                            @if ($refund->status == 'pending')
                                                                <span class="badge badge-warning">Pending</span>
                                                            @elseif ($refund->status == 'approved')
                                                                <span class="badge badge-success">Approved</span>
                                                            @elseif ($refund->status == 'rejected')
                                                                <span class="badge badge-danger">Rejected</span>
                                                            @elseif ($refund->status == 'processed')
                                                                <span class="badge badge-info">Processed</span>
                                                            @else
                                                                <span class="badge badge-secondary">{{ $refund->status }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Amount:</th>
                                                        <td>${{ number_format($refund->amount, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Filing ID:</th>
                                                        <td>{{ $refund->filing_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Created:</th>
                                                        <td>{{ $refund->created_at->format('M d, Y H:i:s') }}</td>
                                                    </tr>
                                                    @if ($refund->updated_at != $refund->created_at)
                                                        <tr>
                                                            <th>Last Updated:</th>
                                                            <td>{{ $refund->updated_at->format('M d, Y H:i:s') }}</td>
                                                        </tr>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Timeline</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="timeline">
                                                    <div class="timeline-item">
                                                        <div class="timeline-date">{{ $refund->created_at->format('M d, Y H:i:s') }}</div>
                                                        <div class="timeline-content">
                                                            <h6>Refund Request Submitted</h6>
                                                            <p>User submitted a refund request for ${{ number_format($refund->amount, 2) }}</p>
                                                        </div>
                                                    </div>
                                                    @if ($refund->status != 'pending')
                                                        <div class="timeline-item">
                                                            <div class="timeline-date">{{ $refund->updated_at->format('M d, Y H:i:s') }}</div>
                                                            <div class="timeline-content">
                                                                <h6>Status Updated</h6>
                                                                <p>Request was {{ $refund->status }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 