

@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'About Us')


@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1">
<div class="container">
<div class="breadcrumb-title">
<h2>Currency Chart</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Currency Chart</li>
</ul>
</div>
</div>
</div>


<section class="convert-wrap ptb-100">
<div class="container">
<div class="row">
<div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
<div class="section-title style1 text-center mb-40">
<span>CURRENCY CHART</span>
<h2>The Relaible, Cheap, &amp; Fastest Way To Send Money Abroad</h2>
</div>
</div>
</div>
<div class="convert-box">
<ul class="convert-tablist list-style" role="tablist">
<li class="nav-item">
<a href="#"><i class="ri-exchange-dollar-line"></i>Convert</a>
</li>
 <li class="nav-item">
<a href="send-money"><i class="ri-send-plane-line"></i>Send</a>
</li>
<li class="nav-item">
<a class="active" href="chart"><i class="ri-line-chart-line"></i>Charts</a>
</li>
<li class="nav-item">
<a href="alerts"><i class="ri-notification-3-line"></i>Alerts</a>
</li>
</ul>
<div class="convert-tabcontent">
<form action="#" class="convert-form">
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label for="country_from">Country From</label>
<select name="country_from" id="country_from">
<option value="1">USD - US Dollar</option>
<option value="2">EUR - Euro</option>
<option value="3">CAD - Canadian Dollar</option>
</select>
</div>
</div>
<div class="col-lg-1 text-center">
<span class="convert-icon">
<i class="ri-arrow-left-right-line"></i>
</span>
</div>
<div class="col-lg-5">
<div class="form-group">
<label for="currency_to">Country To</label>
<select name="country_to" id="country_to">
<option value="1">EUR - Euro</option>
<option value="2">USD - US Dollar</option>
<option value="3">CAD - Canadian Dollar</option>
</select>
</div>
</div>
</div>
<div class="row mt-20 align-items-center">
<div class="col-xl-6 col-lg-8">
<div class="converter-alert-text">
<i class="ri-error-warning-line"></i>
<p>We use mid-market rate for our converter. This is for international purpose only. You won't recieve this rate when send money. <a href="chart" class="link style1">Check send rates</a></p>
</div>
</div>
<div class="col-xl-6 col-lg-4 text-lg-end">
<a class="btn style1">VIEW CHARTS<i class="ri-arrow-right-s-line"></i></a>
</div>
</div>
</form>
</div>
</div>
</div>
</section>


<section class="exchange-table-wrap pb-75">
<div class="container">
<div class="row gx-5">
<div class="col-lg-6">
<div class="section-title style1 text-center mb-25">
<h2>Live Currency Rates</h2>
</div>
<div class="exchange-table style2">
<table class="table">
<thead>
<tr>
<th scope="col">Currency</th>
<th scope="col">Rate</th>
<th scope="col">Change(24h)</th>
</tr>
</thead>
<tbody>
<tr>
<td>
Eur/USD
</td>
<td>
1.06430
</td>
<td>
<span class="text-red"><i class="ri-arrow-down-s-fill"></i></span>
</td>
</tr>
<tr>
<td>
GBP/Eur
</td>
<td>
1.406430
</td>
<td>
<span class="text-green"><i class="ri-arrow-up-s-fill"></i></span>
</td>
</tr>
<tr>
<td>
USD/JPY
</td>
<td>
320.06430
</td>
<td>
<span class="text-green"><i class="ri-arrow-up-s-fill"></i></span>
</td>
</tr>
<tr>
<td>
Eur/USD
</td>
<td>
1.06430
</td>
<td>
<span class="text-green"><i class="ri-arrow-down-s-fill"></i></span>
</td>
</tr>
<tr>
<td>
GBP/USD
</td>
<td>
1.45706
</td>
<td>
<span class="text-red"><i class="ri-arrow-down-s-fill"></i></span>
 </td>
</tr>
<tr>
<td>
USD/CAD
</td>
<td>
1.06430
</td>
<td>
<span class="text-red"><i class="ri-arrow-down-s-fill"></i></span>
</td>
</tr>
<tr>
<td>
USD/CHE
</td>
<td>
6.234530
</td>
<td>
<span class="text-red"><i class="ri-arrow-down-s-fill"></i></span>
</td>
</tr>
<tr>
<td>
EUR/JPY
</td>
<td>
120.809
</td>
<td>
<span class="text-green"><i class="ri-arrow-up-s-fill"></i></span>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="col-lg-6">
<div class="section-title style1 text-center mb-25">
<h2>Central Bank Rates</h2>
</div>
<div class="exchange-table style2">
<table class="table">
<thead>
<tr>
<th scope="col">Currency</th>
<th scope="col">Interest Rate</th>
</tr>
</thead>
<tbody>
<tr>
<td>
JPY
</td>
<td>
-0.20%
</td>
</tr>
<tr>
<td>
CHF
</td>
<td>
-0.30%
</td>
</tr>
<tr>
<td>
Eur
 </td>
<td>
0.70%
</td>
</tr>
<tr>
<td>
USD
</td>
<td>
0.32%
</td>
</tr>
<tr>
<td>
CAD
</td>
<td>
0.54%
</td>
</tr>
<tr>
<td>
AUD
</td>
<td>
0.21%
</td>
</tr>
<tr>
<td>
NZD
</td>
<td>
0.43%
</td>
</tr>
<tr>
<td>
GBP
</td>
<td>
0.78%
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</section>

</div>

@endsection