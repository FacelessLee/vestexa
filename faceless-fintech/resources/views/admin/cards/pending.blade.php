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
                                    <h4 class="card-title">Pending Card Applications</h4>
                                    <a href="{{ route('admin.cards') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-credit-card"></i> All Cards
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Application ID</th>
                                                <th>User</th>
                                                <th>Card Type</th>
                                                <th>Level</th>
                                                <th>Applied On</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cards as $card)
                                                <tr>
                                                    <td>#{{ $card->id }}</td>
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
                                                    <td>{{ $card->created_at->format('M d, Y h:i A') }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('admin.cards.view', $card->id) }}" class="btn btn-primary btn-sm">
                                                                <i class="fa fa-eye"></i> View
                                                            </a>
                                                            <a href="{{ route('admin.cards.approve', $card->id) }}" class="btn btn-success btn-sm">
                                                                <i class="fa fa-check-circle"></i> Approve
                                                            </a>
                                                            <a href="{{ route('admin.cards.reject', $card->id) }}" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-times-circle"></i> Reject
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No pending card applications found.</td>
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