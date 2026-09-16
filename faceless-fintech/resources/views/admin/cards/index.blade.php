@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-center">{{ $title }}</h1>
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
                                    <h4 class="card-title">All Virtual Cards</h4>
                                    <a href="{{ route('admin.cards.pending') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-clock"></i> Pending Applications
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Card Number</th>
                                                <th>User</th>
                                                <th>Card Type</th>
                                                <th>Level</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cards as $card)
                                                <tr>
                                                    <td>
                                                        <span class="mask-card-number">
                                                            **** **** **** {{ substr($card->card_number, -4) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($card->user && $card->user->profile_photo_path)
                                                                <img src="{{ asset('storage/app/public/photos/'.$card->user->profile_photo_path) }}" alt="profile" class="mr-2 rounded-circle" style="width: 30px; height: 30px;">
                                                            @else
                                                                <img src="{{ asset('dash/images/profile/profile.png') }}" alt="profile" class="mr-2 rounded-circle" style="width: 30px; height: 30px;">
                                                            @endif
                                                            <div>
                                                                {{ $card->user ? $card->user->name : 'N/A' }}
                                                                <div class="small text-muted">{{ $card->user ? $card->user->email : 'N/A' }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ ucfirst(str_replace('_', ' ', $card->card_type)) }}</td>
                                                    <td>{{ ucfirst($card->card_level) }}</td>
                                                    <td>{{ $card->currency }}{{ number_format($card->balance, 2) }}</td>
                                                    <td>
                                                        @if ($card->status == 'active')
                                                            <span class="badge badge-success">Active</span>
                                                        @elseif ($card->status == 'inactive')
                                                            <span class="badge badge-warning">Inactive</span>
                                                        @elseif ($card->status == 'pending')
                                                            <span class="badge badge-info">Pending</span>
                                                        @elseif ($card->status == 'blocked')
                                                            <span class="badge badge-danger">Blocked</span>
                                                        @elseif ($card->status == 'rejected')
                                                            <span class="badge badge-danger">Rejected</span>
                                                        @else
                                                            <span class="badge badge-secondary">{{ $card->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $card->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton{{ $card->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $card->id }}">
                                                                <a class="dropdown-item" href="{{ route('admin.cards.view', $card->id) }}">
                                                                    <i class="fa fa-eye"></i> View Details
                                                                </a>
                                                                
                                                                @if ($card->status == 'pending')
                                                                    <a class="dropdown-item text-success" href="{{ route('admin.cards.approve', $card->id) }}">
                                                                        <i class="fa fa-check-circle"></i> Approve
                                                                    </a>
                                                                    <a class="dropdown-item text-danger" href="{{ route('admin.cards.reject', $card->id) }}">
                                                                        <i class="fa fa-times-circle"></i> Reject
                                                                    </a>
                                                                @endif
                                                                
                                                                @if ($card->status == 'active')
                                                                    <a class="dropdown-item text-warning" href="{{ route('admin.cards.block', $card->id) }}">
                                                                        <i class="fa fa-lock"></i> Block Card
                                                                    </a>
                                                                @endif
                                                                
                                                                @if ($card->status == 'blocked' || $card->status == 'inactive')
                                                                    <a class="dropdown-item text-success" href="{{ route('admin.cards.unblock', $card->id) }}">
                                                                        <i class="fa fa-unlock"></i> Unblock Card
                                                                    </a>
                                                                @endif
                                                                
                                                                <div class="dropdown-divider"></div>
                                                                
                                                                <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#deleteModal{{ $card->id }}">
                                                                    <i class="fa fa-trash"></i> Delete Card
                                                                </a>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $card->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $card->id }}" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteModalLabel{{ $card->id }}">Confirm Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this card? This action cannot be undone.
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <a href="{{ route('admin.cards.delete', $card->id) }}" class="btn btn-danger">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">No virtual cards found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $cards->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 