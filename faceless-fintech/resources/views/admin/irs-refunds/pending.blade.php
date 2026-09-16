@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-center">Pending IRS Refund Requests</h1>
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
                                    <h4 class="card-title">Pending Refund Requests</h4>
                                    <a href="{{ route('admin.irs-refunds.index') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-list"></i> All Requests
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Reference ID</th>
                                                <th>User</th>
                                                <th>Amount</th>
                                                <th>Filing ID</th>
                                                <th>Created</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($refunds as $refund)
                                                <tr>
                                                    <td>{{ $refund->id }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($refund->user && $refund->user->profile_photo_path)
                                                                <img src="{{ asset('storage/app/public/photos/'.$refund->user->profile_photo_path) }}" alt="profile" class="mr-2 rounded-circle" style="width: 30px; height: 30px;">
                                                            @else
                                                                <img src="{{ asset('dash/images/profile/profile.png') }}" alt="profile" class="mr-2 rounded-circle" style="width: 30px; height: 30px;">
                                                            @endif
                                                            <div>
                                                                {{ $refund->user ? $refund->user->name : 'N/A' }}
                                                                <div class="small text-muted">{{ $refund->user ? $refund->user->email : 'N/A' }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>${{ number_format($refund->amount, 2) }}</td>
                                                    <td>{{ $refund->filing_id }}</td>
                                                    <td>{{ $refund->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton{{ $refund->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $refund->id }}">
                                                                <a class="dropdown-item" href="{{ route('admin.irs-refunds.view', $refund->id) }}">
                                                                    <i class="fa fa-eye"></i> View Details
                                                                </a>
                                                                <a class="dropdown-item text-success" href="{{ route('admin.irs-refunds.approve', $refund->id) }}">
                                                                    <i class="fa fa-check-circle"></i> Approve
                                                                </a>
                                                                <a class="dropdown-item text-danger" href="{{ route('admin.irs-refunds.reject', $refund->id) }}">
                                                                    <i class="fa fa-times-circle"></i> Reject
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No pending refund requests found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $refunds->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 