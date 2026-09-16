@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Grant Applications</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Grant Applications</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">All Grant Applications</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card card-stats card-primary card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Processing</p>
                                                <h4 class="card-title">{{ $applications->where('status', 'processing')->count() }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.grants.pending') }}" class="card-footer text-center text-white">
                                    <span>View All</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-stats card-success card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Approved</p>
                                                <h4 class="card-title">{{ $applications->where('status', 'approved')->count() }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.grants.approved') }}" class="card-footer text-center text-white">
                                    <span>View All</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-stats card-danger card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-times-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Rejected</p>
                                                <h4 class="card-title">{{ $applications->where('status', 'rejected')->count() }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.grants.rejected') }}" class="card-footer text-center text-white">
                                    <span>View All</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-stats card-secondary card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Disbursed</p>
                                                <h4 class="card-title">{{ $applications->where('status', 'disbursed')->count() }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.grants.disbursed') }}" class="card-footer text-center text-white">
                                    <span>View All</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="grant-applications" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Requested</th>
                                    <th>Approved</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $application)
                                <tr>
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application->user->name }} {{ $application->user->lastname }}</td>
                                    <td>{{ ucfirst($application->application_type) }}</td>
                                    <td>
                                        @if($application->status == 'processing')
                                            <span class="badge badge-primary">Processing</span>
                                        @elseif($application->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($application->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @elseif($application->status == 'disbursed')
                                            <span class="badge badge-secondary">Disbursed</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($application->requested_amount, 2) }}</td>
                                    <td>
                                        @if($application->approved_amount)
                                            ${{ number_format($application->approved_amount, 2) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.grants.view', $application->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $application->id }})">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        $('#grant-applications').DataTable({
            "pageLength": 25,
            "order": [[ 0, "desc" ]],
            "searching": true,
            "paging": false
        });
    });
    
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this application? This action cannot be undone.')) {
            window.location.href = "{{ url('admin/grants/delete') }}/" + id;
        }
    }
</script>
@endsection
