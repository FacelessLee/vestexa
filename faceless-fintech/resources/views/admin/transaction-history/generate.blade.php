<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $text = 'light';
    $bg = 'dark';
}   
?>
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1">Bulk Generate Transaction History</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="mb-5 row">
                    <div class="col-lg-12 card p-4 shadow">
                        <form method="POST" action="{{ route('transaction.generate') }}" id="transaction-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_id">Select User</label>
                                        <select name="user_id" id="user_id" class="form-control" required>
                                            <option value="">Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="num_transactions">Number of Transactions</label>
                                        <input type="number" class="form-control" name="num_transactions" id="num_transactions" min="1" max="50" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="min_amount">Minimum Amount ({{ $settings->currency }})</label>
                                        <input type="number" class="form-control" name="min_amount" id="min_amount" step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="max_amount">Maximum Amount ({{ $settings->currency }})</label>
                                        <input type="number" class="form-control" name="max_amount" id="max_amount" step="0.01" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transaction_type">Transaction Type</label>
                                        <select name="transaction_type" id="transaction_type" class="form-control" required>
                                            <option value="Credit">Credit</option>
                                            <option value="Debit">Debit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="Processed">Processed</option>
                                            <option value="Pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="payment_mode">Payment Method</label>
                                        <select name="payment_mode" id="payment_mode" class="form-control" required>
                                            <option value="International Wire Transfer">International Wire Transfer</option>
                                            <option value="Domestic Transfer">Domestic Transfer</option>
                                            <option value="Cryptocurrency">Cryptocurrency</option>
                                            <option value="PayPal">PayPal</option>
                                            <option value="Wise Transfer">Wise Transfer</option>
                                            <option value="Skrill">Skrill</option>
                                            <option value="Venmo">Venmo</option>
                                            <option value="Zelle">Zelle</option>
                                            <option value="Cash App">Cash App</option>
                                            <option value="Revolut">Revolut</option>
                                            <option value="Alipay">Alipay</option>
                                            <option value="WeChat Pay">WeChat Pay</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date & Time</label>
                                        <input type="datetime-local" class="form-control" name="start_date" id="start_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date & Time</label>
                                        <input type="datetime-local" class="form-control" name="end_date" id="end_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Generate Transaction History</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Set current date and time as default for start date
            var now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            document.getElementById('start_date').value = now.toISOString().slice(0, 16);
            
            // Set date 7 days from now as default for end date
            var endDate = new Date();
            endDate.setDate(endDate.getDate() + 7);
            endDate.setMinutes(endDate.getMinutes() - endDate.getTimezoneOffset());
            document.getElementById('end_date').value = endDate.toISOString().slice(0, 16);
        });
    </script>
@endsection