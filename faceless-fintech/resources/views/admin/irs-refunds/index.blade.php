@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-center">IRS Refund Management</h1>
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
                                    <h4 class="card-title">All IRS Refund Requests</h4>
                                    <a href="{{ route('admin.irs-refunds.pending') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-clock"></i> Pending Requests
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
                                                <th>Status</th>
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
                                                                
                                                                @if ($refund->status == 'pending')
                                                                    <a class="dropdown-item text-success" href="{{ route('admin.irs-refunds.approve', $refund->id) }}">
                                                                        <i class="fa fa-check-circle"></i> Approve
                                                                    </a>
                                                                    <a class="dropdown-item text-danger" href="{{ route('admin.irs-refunds.reject', $refund->id) }}">
                                                                        <i class="fa fa-times-circle"></i> Reject
                                                                    </a>
                                                                @endif
                                                                
                                                                @if ($refund->status == 'approved')
                                                                    <a class="dropdown-item text-info" href="{{ route('admin.irs-refunds.process', $refund->id) }}">
                                                                        <i class="fa fa-cog"></i> Process Refund
                                                                    </a>
                                                                @endif
                                                                
                                                                <div class="dropdown-divider"></div>
                                                                
                                                                <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#deleteModal{{ $refund->id }}">
                                                                    <i class="fa fa-trash"></i> Delete Request
                                                                </a>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $refund->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $refund->id }}" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteModalLabel{{ $refund->id }}">Confirm Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this refund request? This action cannot be undone.
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <a href="{{ route('admin.irs-refunds.delete', $refund->id) }}" class="btn btn-danger">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No refund requests found.</td>
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