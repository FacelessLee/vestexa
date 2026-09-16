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
                    <h1 class="title1  d-inline"> {{ $user->name }} Loans</h1>
                    <div class="d-inline">
                        <div class="float-right btn-group">
                            <a class="btn btn-primary btn-sm" href="{{ route('viewuser', $user->id) }}"> <i
                                    class="fa fa-arrow-left"></i> back</a>
                        </div>
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="mb-5 row">
                    <div class="col card p-3 shadow ">
                        <div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
                            <span style="margin:3px;">
                                <table id="ShipTable" class="table table-hover ">
                                    <thead>
                                        <tr>
                                            {{-- <th>Client name</th> --}}
                                            
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Duration</th>
                                            <th>Created on</th>
        
                                            <th>Purpose</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($plans as $plan)
                                            <tr>
                                                {{-- <td>{{$plan->duser->name}}</td> --}}
                                                
                                                <td>{{ $settings->currency }}{{ number_format($plan->amount) }}</td>
                                                <td>
                                                    @if ($plan->active != 'Pending')
                                                        <span class="badge badge-success">{{ $plan->active }}</span>
                                                    @else
                                                        <span class="badge badge-warning">{{ $plan->active }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $plan->inv_duration }}</td>
                                                <td>{{ \Carbon\Carbon::parse($plan->created_at)->toDayDateTimeString() }}
                                                </td>
                                                
                                                </td>
                                                <td>
                                                    <a href="{{ route('deleteplan', $plan->id) }}"
                                                        class="m-1 btn btn-info btn-sm"> Delete Plan</a>
                                                    @if ($plan->active == 'Processed')
                                                        <a href="{{ route('markas', ['id' => $plan->id, 'status' => 'Pending']) }}"
                                                            class="m-1 btn btn-danger btn-sm">Mark as Pending</a>
                                                    @else
                                                        <a href="{{ route('markas', ['id' => $plan->id, 'status' => 'Processed']) }}"
                                                            class="m-1 btn btn-success btn-sm">Mark as Processed</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
