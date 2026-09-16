@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 ">Requested Loans</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="col-12 card shadow p-4 ">
                    <div class="table-responsive" data-example-id="hoverable-table">
                        <table id="ShipTable" class="table table-hover ">
                            <thead>
                                <tr>
                                    <th>Client name</th>
                
                                    <th>Amount Requested</th>
                                    <th>Duration</th>
                                    <th>Purpose</th>
                                    <th>Credit facility</th>
                                    <th>status</th>
                                    <th> Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->duser->name }}</td>
                                        
                                        <td>{{ $settings->currency }}{{ number_format($plan->amount) }}</td>
                                        <td>{{ $plan->duration }} Weeks</td>
                                        <td>
                                            {{ $plan->purpose }}
                                        </td>
                                        <td>
                                            {{ $plan->facility }}
                                        </td>
                                        @if($plan->active=='Pending')
                                        <td class='bg-warning'>
                                            {{ $plan->active }}
                                        </td>

                                        @else
                                        <td>
                                            {{ $plan->active }}
                                        </td>
                                        @endif
                                        <td>{{ $plan->created_at->toDayDateTimeString() }}</td>
                                        
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item text-danger"
                                                        href="{{ route('deleteplan', $plan->id) }}">Delete</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.plans', $plan->duser->id) }}">More actions</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
