<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $bg = 'light';
    $text = 'dark';
    $gradient = 'primary';
} else {
    $bg = 'dark';
    $text = 'light';
    $gradient = 'dark';
}

?>
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content ">
            <div class="panel-header bg-{{ $gradient }}-gradient">
                <div class="py-5 page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="pb-2 text-white fw-bold">Dashboard</h2>
                            <h5 class="mb-2 text-white op-7">Welcome, {{ Auth('admin')->User()->firstName }}
                                {{ Auth('admin')->User()->lastName }}!</h5>
                        </div>
                        @if (Auth('admin')->User()->type == 'Super Admin' || Auth('admin')->User()->type == 'Admin')
                            <div class="py-2 ml-md-auto py-md-0">
                                <a href="{{ route('mdeposits') }}" class="mr-2 btn btn-success ">Deposits</a>
                                <a href="{{ route('mwithdrawals') }}"
                                    class="mr-2 btn btn-info ">Transfers</a>
                                <a href="{{ route('manageusers') }}" class="btn btn-secondary ">Users</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <x-danger-alert />
            <x-success-alert />
            <div class="page-inner mt--5">
                <!-- Beginning of  Dashboard Stats  -->
                <div class="row row-card-no-pd  shadow-lg mt--2">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round  full-height">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-download text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Deposit</p>
                                            @foreach ($total_deposited as $deposited)
                                                @if (!empty($deposited->count))
                                                    {{ $settings->currency }}{{ number_format($deposited->count) }}
                                                @else
                                                    {{ $settings->currency }}0.00
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round  full-height">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-download text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Pending Deposit(s)</p>
                                            @foreach ($pending_deposited as $deposited)
                                                @if (!empty($deposited->count))
                                                    {{ $settings->currency }}{{ number_format($deposited->count) }}
                                                @else
                                                    {{ $settings->currency }}0.00
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round  full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-arrows-1 text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Transfers</p>
                                            @foreach ($total_withdrawn as $deposited)
                                                @if (!empty($deposited->count))
                                                    {{ $settings->currency }}{{ number_format($deposited->count) }}
                                                @else
                                                    {{ $settings->currency }}0.00
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round  full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-arrow text-secondary"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Pending Transfers</p>
                                            @foreach ($pending_withdrawn as $deposited)
                                                @if (!empty($deposited->count))
                                                    {{ $settings->currency }}{{ number_format($deposited->count) }}
                                                @else
                                                    {{ $settings->currency }}0.00
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round ">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-users text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Users</p>
                                            <h4 class="card-title ">{{ number_format($user_count) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round ">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-remove-user text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Block Users</p>
                                            <h4 class="card-title ">{{ $blockeusers }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round ">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-user-2 text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Active Users</p>
                                            <h4 class="card-title ">{{ $activeusers }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round ">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-diagram text-warning"></i>
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
