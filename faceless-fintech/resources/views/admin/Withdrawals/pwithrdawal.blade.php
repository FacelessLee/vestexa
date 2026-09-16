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
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-5">
                    <h1 class="title1 d-inline ">Process {{ $withdrawal->payment_mode }} Request</h1>
                    <div class="d-inline">
                        <div class="float-right btn-group">
                            <a class="btn btn-primary btn-sm" href="{{ route('mwithdrawals') }}"> <i
                                    class="fa fa-arrow-left"></i> back</a>
                        </div>
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="mb-5 row">
                    <div class="col-lg-8 offset-lg-2 card p-md-4 p-2 shadow">
                        <div class="mb-3">
                            <!-- Common fields for all payment methods -->
                            <div class="mb-3 form-group">
                                <h5 class="">Amount</h5>
                                <input type="text" class="form-control readonly" value="{{ $settings->currency }}{{ $withdrawal->amount }}" readonly>
                            </div>
                            
                            <div class="mb-3 form-group">
                                <h5 class="">Payment Method</h5>
                                <input type="text" class="form-control readonly" value="{{ $withdrawal->payment_mode }}" readonly>
                            </div>

                            <div class="mb-3 form-group">
                                <h5 class="">Description</h5>
                                <input type="text" class="form-control readonly" value="{{ $withdrawal->Description ?? 'N/A' }}" readonly>
                            </div>
                            
                            <!-- International Wire Transfer Fields -->
                            @if($withdrawal->payment_mode == 'International Wire Transfer')
                                <div class="mb-3 form-group">
                                    <h5 class="">Bank Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->bankname ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Account Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->accountname ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Account Number</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->accountnumber ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Account Type</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->Accounttype ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Bank Address</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->bankaddress ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Country</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->country ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Swift Code</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->swiftcode ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">IBAN</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->iban ?? 'N/A' }}" readonly>
                                </div>
                            
                            <!-- Cryptocurrency Fields -->
                            @elseif($withdrawal->payment_mode == 'Cryptocurrency')
                                <div class="mb-3 form-group">
                                    <h5 class="">Cryptocurrency</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->crypto_currency ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Network</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->crypto_network ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Wallet Address</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->wallet_address ?? 'N/A' }}" readonly>
                                </div>
                            
                            <!-- PayPal Fields -->
                            @elseif($withdrawal->payment_mode == 'PayPal')
                                <div class="mb-3 form-group">
                                    <h5 class="">PayPal Email</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->paypal_email ?? 'N/A' }}" readonly>
                                </div>
                            
                            <!-- Wise Transfer Fields -->
                            @elseif($withdrawal->payment_mode == 'Wise Transfer')
                                <div class="mb-3 form-group">
                                    <h5 class="">Full Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->wise_fullname ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Email</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->wise_email ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Country</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->wise_country ?? 'N/A' }}" readonly>
                                </div>
                            
                            <!-- Skrill Fields -->
                            @elseif($withdrawal->payment_mode == 'Skrill')
                                <div class="mb-3 form-group">
                                    <h5 class="">Full Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->skrill_fullname ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Email</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->skrill_email ?? 'N/A' }}" readonly>
                                </div>
                            
                            <!-- Venmo Fields -->
                            @elseif($withdrawal->payment_mode == 'Venmo')
                                <div class="mb-3 form-group">
                                    <h5 class="">Username</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->venmo_username ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Phone Number</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->venmo_phone ?? 'N/A' }}" readonly>
                                </div>
                            
                            <!-- Zelle Fields -->
                            @elseif($withdrawal->payment_mode == 'Zelle')
                                <div class="mb-3 form-group">
                                    <h5 class="">Full Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->zelle_name ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Email</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->zelle_email ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Phone Number</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->zelle_phone ?? 'N/A' }}" readonly>
                                </div>
                            
                            <!-- Cash App Fields -->
                            @elseif($withdrawal->payment_mode == 'Cash App')
                                <div class="mb-3 form-group">
                                    <h5 class="">${{ $withdrawal->cash_app_tag ?? 'N/A' }}</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->cash_app_tag ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Full Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->cash_app_fullname ?? 'N/A' }}" readonly>
                                </div>
                            
                            <!-- Revolut Fields -->
                            @elseif($withdrawal->payment_mode == 'Revolut')
                                <div class="mb-3 form-group">
                                    <h5 class="">Full Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->revolut_fullname ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Email</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->revolut_email ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Phone Number</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->revolut_phone ?? 'N/A' }}" readonly>
                                </div>
                            
                            <!-- Alipay Fields -->
                            @elseif($withdrawal->payment_mode == 'Alipay')
                                <div class="mb-3 form-group">
                                    <h5 class="">Alipay ID</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->alipay_id ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Full Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->alipay_fullname ?? 'N/A' }}" readonly>
                                </div>
                            
                            <!-- WeChat Pay Fields -->
                            @elseif($withdrawal->payment_mode == 'WeChat Pay')
                                <div class="mb-3 form-group">
                                    <h5 class="">WeChat ID</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->wechat_id ?? 'N/A' }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Full Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $withdrawal->wechat_name ?? 'N/A' }}" readonly>
                                </div>
                            @endif
                            
                            <!-- Transaction ID field -->
                            <div class="mb-3 form-group">
                                <h5 class="">Transaction ID</h5>
                                <input type="text" class="form-control readonly" value="{{ $withdrawal->txn_id ?? 'N/A' }}" readonly>
                            </div>
                        </div>

                        <div class="mt-1">
                            <form action="{{ route('pwithdrawal') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h6 class="">Action</h6>
                                        <select name="action" id="action" class="mb-2 form-control">
                                            <option value="Paid">Paid</option>
                                            <option value="Reject">Reject</option>
                                            <option value="On-hold">On-hold</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <h6 class="">Date</h6>
                                        <input name="date" type='datetime-local' id="action" class="mb-2 form-control">
                                    </div>
                                </div>
                                <div class="form-row d-none" id="emailcheck">
                                    <div class="col-md-12 form-group">
                                        <div class="selectgroup">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="emailsend" id="dontsend" value="false"
                                                    class="selectgroup-input" checked="">
                                                <span class="selectgroup-button">Don't Send Email</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="emailsend" id="sendemail" value="true"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Send Email</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row d-none" id="emailtext">
                                    <div class="form-group col-md-12">
                                        <h6 class="">Subject</h6>
                                        <input type="text" name="subject" id="subject" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="">Enter Reasons for rejecting this withdrawal request</h6>
                                        <textarea class="form-control" row="3" placeholder="Type in here" name="reason" id="message"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $withdrawal->id }}">
                                    <input type="submit" class="px-3 btn btn-primary" value="Process">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#action').change(function() {
                    if ($(this).val() === "Reject") {
                        document.getElementById('emailcheck').classList.remove('d-none');
                    } else {
                        document.getElementById('emailcheck').classList.add('d-none');
                        document.getElementById('emailtext').classList.add('d-none');
                        document.getElementById('dontsend').checked = true;
                        document.getElementById('subject').removeAttribute('required');
                        document.getElementById('message').removeAttribute('required');
                    }
                });

                $('#sendemail').click(function() {
                    document.getElementById('emailtext').classList.remove('d-none');
                    document.getElementById('subject').setAttribute('required', '');
                    document.getElementById('message').setAttribute('required', '');
                });

                $('#dontsend').click(function() {
                    document.getElementById('emailtext').classList.add('d-none');
                    document.getElementById('subject').removeAttribute('required');
                    document.getElementById('message').removeAttribute('required');
                });
            });
        </script>
    @endsection