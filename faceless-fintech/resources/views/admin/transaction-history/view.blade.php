<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
} else {
    $text = 'light';
}
?>
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 d-inline">Transaction History</h1>
                    <div class="d-inline">
                        <div class="float-right btn-group">
                            <a class="btn btn-primary btn-sm" href="{{ route('transaction.form') }}">
                                <i class="fa fa-plus"></i> Generate New Transaction
                            </a>
                        </div>
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="mb-5 row">
                    <div class="col card p-3 shadow ">
                        <div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
                            <span style="margin:3px;">
                                <table id="TransactionTable" class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Transaction ID</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdrawals as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ $transaction->txn_id }}</td>
                                                <td>{{ $transaction->duser->name ?? 'N/A' }}</td>
                                                <td>{{ $transaction->duser->s_curr }}{{ number_format($transaction->amount) }}</td>
                                                <td>
                                                    @if($transaction->type == 'Credit')
                                                        <span class="badge badge-success">Credit</span>
                                                    @else
                                                        <span class="badge badge-danger">Debit</span>
                                                    @endif
                                                </td>
                                                <td>{{ $transaction->payment_mode }}</td>
                                                <td>
                                                    @if ($transaction->status == 'Processed')
                                                        <span class="badge badge-success">{{ $transaction->status }}</span>
                                                    @elseif($transaction->status == 'On-hold')
                                                        <span class="badge badge-warning">{{ $transaction->status }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ $transaction->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->toDayDateTimeString() }}</td>
                                                <td>
                                                    <a href="{{ route('processwithdraw', $transaction->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#TransactionTable').DataTable({
                order: [[7, 'desc']], // Sort by date column (index 7) in descending order
                responsive: true,
                language: {
                    searchPlaceholder: "Search transaction...",
                    search: "",
                },
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            });
        });
    </script>
@endsection