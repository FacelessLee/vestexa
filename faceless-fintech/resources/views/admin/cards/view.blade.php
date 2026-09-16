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

                <div class="row">
                    <div class="col-md-5">
                        <div class="card p-3 shadow">
                            <div class="card-header">
                                <h4 class="card-title">Card Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="card mb-4 text-white" style="background-image: linear-gradient(45deg, #7e57c2, #5e35b1); border-radius: 15px;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-4">
                                            <div>
                                                <img src="{{ asset('dash/images/cards/chip.png') }}" alt="Card Chip" height="40">
                                            </div>
                                            <div>
                                                <h5 class="text-white mb-0">{{ ucfirst($card->card_level) }}</h5>
                                            </div>
                                        </div>
                                        <h5 class="text-white mb-3">
                                            **** **** **** {{ substr($card->card_number, -4) }}
                                        </h5>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <small class="text-white-50">CARD HOLDER</small>
                                                <p class="text-white mb-0">{{ $card->user->name }}</p>
                                            </div>
                                            <div>
                                                <small class="text-white-50">EXPIRES</small>
                                                <p class="text-white mb-0">{{ $card->expiry_month }}/{{ $card->expiry_year }}</p>
                                            </div>
                                            <div>
                                                @if ($card->card_type == 'visa' || strpos($card->card_type, 'visa') !== false)
                                                    <img src="{{ asset('dash/images/cards/visa.png') }}" alt="Visa Card" height="30">
                                                @elseif ($card->card_type == 'mastercard' || strpos($card->card_type, 'mastercard') !== false)
                                                    <img src="{{ asset('dash/images/cards/mastercard.png') }}" alt="Mastercard" height="30">
                                                @elseif ($card->card_type == 'amex' || strpos($card->card_type, 'american_express') !== false)
                                                    <img src="{{ asset('dash/images/cards/amex.png') }}" alt="American Express" height="30">
                                                @else
                                                    <img src="{{ asset('dash/images/cards/visa.png') }}" alt="Card" height="30">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="font-weight-bold">Card ID</td>
                                                <td>{{ $card->id }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Card Number</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mr-2">**** **** **** {{ substr($card->card_number, -4) }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Card Type</td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $card->card_type)) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Card Level</td>
                                                <td>{{ ucfirst($card->card_level) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Balance</td>
                                                <td>
                                                    <h4 class="text-primary mb-0">{{ $card->currency }}{{ number_format($card->balance, 2) }}</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Status</td>
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
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Created On</td>
                                                <td>{{ $card->created_at->format('M d, Y h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Last Updated</td>
                                                <td>{{ $card->updated_at->format('M d, Y h:i A') }}</td>
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
                                        @if ($card->status == 'pending')
                                            <a href="{{ route('admin.cards.approve', $card->id) }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-check-circle"></i> Approve
                                            </a>
                                            <a href="{{ route('admin.cards.reject', $card->id) }}" class="btn btn-danger btn-sm">
                                                <i class="fa fa-times-circle"></i> Reject
                                            </a>
                                        @elseif ($card->status == 'active')
                                            <a href="{{ route('admin.cards.block', $card->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-lock"></i> Block Card
                                            </a>
                                        @elseif ($card->status == 'blocked' || $card->status == 'inactive')
                                            <a href="{{ route('admin.cards.unblock', $card->id) }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-unlock"></i> Unblock Card
                                            </a>
                                        @endif
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fa fa-trash"></i> Delete Card
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Information -->
                        <div class="card p-3 shadow mt-4">
                            <div class="card-header">
                                <h4 class="card-title">Cardholder Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    @if ($card->user && $card->user->profile_photo_path)
                                        <img src="{{ asset('storage/app/public/photos/'.$card->user->profile_photo_path) }}" alt="profile" class="mr-3 rounded-circle" style="width: 60px; height: 60px;">
                                    @else
                                        <img src="{{ asset('dash/images/profile/profile.png') }}" alt="profile" class="mr-3 rounded-circle" style="width: 60px; height: 60px;">
                                    @endif
                                    <div>
                                        <h5 class="mb-0">{{ $card->user->name }}</h5>
                                        <p class="text-muted mb-0">{{ $card->user->email }}</p>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="font-weight-bold">Account ID</td>
                                                <td>{{ $card->user->id }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Phone</td>
                                                <td>{{ $card->user->phone ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Address</td>
                                                <td>{{ $card->user->address ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Joined On</td>
                                                <td>{{ $card->user->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="{{ route('viewuser', $card->user->id) }}" class="btn btn-primary btn-block">
                                    <i class="fa fa-user"></i> View User Profile
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-7">
                        <!-- Card Balance Management -->
                        <div class="card p-3 shadow">
                            <div class="card-header">
                                <h4 class="card-title">Balance Management</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card bg-success text-white mb-4">
                                            <div class="card-body">
                                                <h5 class="mb-1">Top Up Card</h5>
                                                <form action="{{ route('admin.cards.topup', $card->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="amount">Amount ({{ $card->currency }})</label>
                                                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" min="1" step="0.01" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Description (Optional)</label>
                                                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
                                                    </div>
                                                    <button type="submit" class="btn btn-light btn-block">
                                                        <i class="fa fa-arrow-up"></i> Top Up
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-danger text-white mb-4">
                                            <div class="card-body">
                                                <h5 class="mb-1">Deduct from Card</h5>
                                                <form action="{{ route('admin.cards.deduct', $card->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="deduct_amount">Amount ({{ $card->currency }})</label>
                                                        <input type="number" class="form-control" id="deduct_amount" name="amount" placeholder="Enter amount" min="1" step="0.01" max="{{ $card->balance }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deduct_description">Description (Optional)</label>
                                                        <input type="text" class="form-control" id="deduct_description" name="description" placeholder="Enter description">
                                                    </div>
                                                    <button type="submit" class="btn btn-light btn-block">
                                                        <i class="fa fa-arrow-down"></i> Deduct
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Transaction History -->
                        <div class="card p-3 shadow mt-4">
                            <div class="card-header">
                                <h4 class="card-title">Transaction History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Reference</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Merchant</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction->transaction_reference }}</td>
                                                    <td>
                                                        @if($transaction->transaction_type == 'purchase')
                                                            <span class="badge badge-info">Purchase</span>
                                                        @elseif($transaction->transaction_type == 'topup')
                                                            <span class="badge badge-success">Top-up</span>
                                                        @elseif($transaction->transaction_type == 'deduction')
                                                            <span class="badge badge-warning">Deduction</span>
                                                        @elseif($transaction->transaction_type == 'refund')
                                                            <span class="badge badge-primary">Refund</span>
                                                        @else
                                                            <span class="badge badge-secondary">{{ ucfirst($transaction->transaction_type) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($transaction->amount > 0)
                                                            <span class="text-success">
                                                                +{{ $transaction->currency }}{{ number_format(abs($transaction->amount), 2) }}
                                                            </span>
                                                        @else
                                                            <span class="text-danger">
                                                                -{{ $transaction->currency }}{{ number_format(abs($transaction->amount), 2) }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $transaction->merchant_name }}</td>
                                                    <td>
                                                        @if($transaction->status == 'completed')
                                                            <span class="badge badge-success">Completed</span>
                                                        @elseif($transaction->status == 'pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                        @elseif($transaction->status == 'failed')
                                                            <span class="badge badge-danger">Failed</span>
                                                        @else
                                                            <span class="badge badge-secondary">{{ ucfirst($transaction->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $transaction->transaction_date->format('M d, Y h:i A') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No transactions found for this card.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $transactions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Card Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this card? This action cannot be undone and will also delete all associated transaction records.</p>
                    <div class="alert alert-danger">
                        <strong>Warning:</strong> This will permanently remove the card and all its transaction history from the system.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="{{ route('admin.cards.delete', $card->id) }}" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Delete Permanently
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection 