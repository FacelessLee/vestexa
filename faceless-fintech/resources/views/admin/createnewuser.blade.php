@php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $text = 'light';
    $bg = 'dark';
}
@endphp
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-{{ $text }} text-center">Create A New User</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="mb-5 row d-flex justify-content-center">
                    <div class="col-md-7">
                        <div class="card p-2 shadow ">
                            <div class="card-body">
                                <div>
                                    	<form method="POST" action="{{ route('createuser')}}" enctype="multipart/form-data">
													@csrf
													<div class="form-row">
                                                          
                                                        <div class="form-group col-md-12">
															<h6 class="text-{{$text}}">Firstname</h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="name" required>
														</div>

                                                        <div class="form-group col-md-12">
                                                            <h6 class="text-{{ $text }}">Middle Name</h6>
                                                            <input type="text" class="form-control  text-{{ $text }}"
                                                                name="middlename"  required>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <h6 class="text-{{ $text }}">Last Name</h6>
                                                            <input type="text" class="form-control  text-{{ $text }}"
                                                                name="lastname"  required>

														<div class="form-group col-md-12">
															<h6 class="text-{{$text}}">Username</h6>
															<input type="text" id="input1" class="form-control bg-{{$bg}} text-{{$text}}" name="username" required>
														</div>
														
														<div class="form-group col-md-12">
															<h6 class="text-{{$text}}">Email</h6>
															<input type="email" class="form-control bg-{{$bg}} text-{{$text}}" name="email" required>
														</div>
                                                        <div class="form-group col-md-12">
															<h6 class="text-{{$text}}">Phone Number</h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="phone" required>
														</div>
                                                        <div class="form-group col-md-12">
															<h6 class="text-{{$text}}">Date of birth</h6>
															<input type="date" class="form-control bg-{{$bg}} text-{{$text}}" name="dob" required>
														</div>
														
														 <div class="form-group">
                         <h5 class=" "> Address </h5>
                         <input class="form-control  " value="{{ $user->address }}" type="text" name="address"
                             required>
                     </div>

                                                        <div class="form-group col-md-12">
															<h6 class="text-{{$text}}">Nationality</h6>
															<select type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="country" required>
                                                                @include('auth.countries')

                                                            </select>
														</div>
                                                        <div class="form-group col-md-12">
                                                            <h6 class="text-{{ $text }}">Account Type</h6>
                                                            <select type="text" class="form-control  text-{{ $text }}"
                                                                name="accounttype"  required>
                                                                <option value="">Please select Account Type</option> 
                                                                <option value="Checking Account">Checking Account</option>
                                                                <option value="Savings Account">Saving Account</option>
                                                                <option value="Fixed Deposit Account">Fixed Deposit Account</option>
                                                                <option value="Current Account">Current Account</option>
                                                                <option value="Crypto Currency Account">Crypto Currency Account</option>
                                                                <option value="Business Account">Business Account</option>
                                                                <option value="Non Resident Account">Non Resident Account</option>
                                                                <option value="Cooperate Business Account">Cooperate Business Account</option>
                                                                <option value="Investment Account">Investment Account</option>
                                                        </select>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <h6 class="text-{{ $text }}">Account Number</h6>
                                                            <input type="text" class="form-control  text-{{ $text }}"
                                                                name="usernumber" value='{{$usernumber}}'  required>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-12">
    <h6 class="text-{{ $text }}">Initial Account Balance</h6>
    <input type="number" step="0.01" class="form-control text-{{ $text }}"
        name="balance" placeholder="0.00" min="0" required>
</div>
                                                        

                                                        <div class="form-group col-md-12">
                                                            <h6 class="text-{{ $text }}">{{ $settings->code1 }}</h6>
                                                            <input type="text" class="form-control  text-{{ $text }}"
                                                                name="code1" value='{{$code1}}'  required>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <h6 class="text-{{ $text }}">{{ $settings->code2 }}</h6>
                                                            <input type="text" class="form-control  text-{{ $text }}"
                                                                name="code2" value='{{$code2 }}'  required>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <h6 class="text-{{ $text }}">{{ $settings->code3 }}</h6>
                                                            <input type="text" class="form-control  text-{{ $text }}"
                                                                name="code3" value='{{$code3 }}'  required>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <h6 class="text-{{ $text }}">4 Digit Transaction pin</h6>
                                                            <input type="text" class="form-control  text-{{ $text }}"
                                                                name='pin' value="{{ $pin }}"  required>
                                                        </div>
                                                             <div class="form-group col-md-12">
                                                <h6 class="text-{{ $text }}">Upload Profile photo</h6>
                                                <input type="file" class="form-control  text-{{ $text }}"
                                                    name="photo"  required>
                                            </div>
														<div class="form-group col-md-12">
															<h6 class="text-{{$text}}">Password</h6>
															<input type="password" class="form-control bg-{{$bg}} text-{{$text}}" name="password" required>
														</div>
														<div class="form-group col-md-12">
															<h6 class="text-{{$text}}">Confirm Password</h6>
															<input type="password" class="form-control bg-{{$bg}} text-{{$text}}" name="password_confirmation" required>
														</div>
													</div>
													<button type="submit" class="px-4 btn btn-primary">Add User</button>
												</form>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
