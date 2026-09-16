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
<style>

    /**
* Template Name: Dewi - v4.7.0
* Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/
body {
font-family: "Open Sans", sans-serif;
color: #444444;
}

a {
color: #ff4a17;
text-decoration: none;
}

a:hover {
color: #ff724a;
text-decoration: none;
}

h1, h2, h3, h4, h5, h6 {
font-family: "Raleway", sans-serif;
}

/*--------------------------------------------------------------
# Back to top button
--------------------------------------------------------------*/
.back-to-top {
position: fixed;
visibility: hidden;
opacity: 0;
right: 15px;
bottom: 15px;
z-index: 996;
background: #ff4a17;
width: 40px;
height: 40px;
border-radius: 4px;
transition: all 0.4s;
}
.back-to-top i {
font-size: 24px;
color: #fff;
line-height: 0;
}
.back-to-top:hover {
background: #ff6a40;
color: #fff;
}
.back-to-top.active {
visibility: visible;
opacity: 1;
}

/*--------------------------------------------------------------
# Preloader
--------------------------------------------------------------*/
#preloader {
position: fixed;
top: 0;
left: 0;
right: 0;
bottom: 0;
z-index: 9999;
overflow: hidden;
background: #fff;
}

#preloader:before {
content: "";
position: fixed;
top: calc(50% - 30px);
left: calc(50% - 30px);
border: 6px solid #ff4a17;
border-top-color: #ffe9e3;
border-radius: 50%;
width: 60px;
height: 60px;
-webkit-animation: animate-preloader 1s linear infinite;
animation: animate-preloader 1s linear infinite;
}

@-webkit-keyframes animate-preloader {
0% {
  transform: rotate(0deg);
}
100% {
  transform: rotate(360deg);
}
}

@keyframes  animate-preloader {
0% {
  transform: rotate(0deg);
}
100% {
  transform: rotate(360deg);
}
}
/*--------------------------------------------------------------
# Disable aos animation delay on mobile devices
--------------------------------------------------------------*/
@media  screen and (max-width: 768px) {
[data-aos-delay] {
  transition-delay: 0 !important;
}
}
/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/
.header {
transition: all 0.5s;
z-index: 997;
padding: 30px 0;
}

.header.sticked {
background: rgba(14, 29, 52, 0.9);
padding: 15px 0;
box-shadow: 0px 2px 20px rgba(14, 29, 52, 0.1);
}

.header .logo img {
max-height: 40px;
margin-right: 6px;
}

.header .logo h1 {
font-size: 30px;
margin: 0;
font-weight: 700;
color: #fff;
font-family: var(--font-primary);
}

/*--------------------------------------------------------------
# Desktop Navigation
--------------------------------------------------------------*/
@media (min-width: 1280px) {
.navbar {
  padding: 0;
}

.navbar ul {
  margin: 0;
  padding: 0;
  display: flex;
  list-style: none;
  align-items: center;
}

.navbar li {
  position: relative;
}

.navbar a,
.navbar a:focus {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 0 10px 30px;
  font-family: var(--font-primary);
  font-size: 16px;
  font-weight: 400;
  color: rgba(255, 255, 255, 0.6);
  white-space: nowrap;
  transition: 0.3s;
}

.navbar a i,
.navbar a:focus i {
  font-size: 12px;
  line-height: 0;
  margin-left: 5px;
}

.navbar a:hover,
.navbar .active,
.navbar .active:focus,
.navbar li:hover>a {
  color: #fff;
}

.navbar .get-a-quote,
.navbar .get-a-quote:focus {
  background: var(--color-primary);
  padding: 8px 20px;
  margin-left: 30px;
  border-radius: 4px;
  color: #fff;
}

.navbar .get-a-quote:hover,
.navbar .get-a-quote:focus:hover {
  color: #fff;
  background: #2756ff;
}

.navbar .dropdown ul {
  display: block;
  position: absolute;
  left: 14px;
  top: calc(100% + 30px);
  margin: 0;
  padding: 10px 0;
  z-index: 99;
  opacity: 0;
  visibility: hidden;
  background: #fff;
  box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
  transition: 0.3s;
  border-radius: 4px;
}

.navbar .dropdown ul li {
  min-width: 200px;
}

.navbar .dropdown ul a {
  padding: 10px 20px;
  font-size: 15px;
  text-transform: none;
  font-weight: 400;
  color: var(--color-secondary);
}

.navbar .dropdown ul a i {
  font-size: 12px;
}

.navbar .dropdown ul a:hover,
.navbar .dropdown ul .active:hover,
.navbar .dropdown ul li:hover>a {
  color: var(--color-primary);
}

.navbar .dropdown:hover>ul {
  opacity: 1;
  top: 100%;
  visibility: visible;
}

.navbar .dropdown .dropdown ul {
  top: 0;
  left: calc(100% - 30px);
  visibility: hidden;
}

.navbar .dropdown .dropdown:hover>ul {
  opacity: 1;
  top: 0;
  left: 100%;
  visibility: visible;
}
}

@media (min-width: 1280px) and (max-width: 1366px) {
.navbar .dropdown .dropdown ul {
  left: -90%;
}

.navbar .dropdown .dropdown:hover>ul {
  left: -100%;
}
}

@media (min-width: 1280px) {

.mobile-nav-show,
.mobile-nav-hide {
  display: none;
}
}

/*--------------------------------------------------------------
# Mobile Navigation
--------------------------------------------------------------*/
@media (max-width: 1279px) {
.navbar {
  position: fixed;
  top: 0;
  right: -100%;
  width: 100%;
  max-width: 400px;
  bottom: 0;
  transition: 0.3s;
  z-index: 9997;
}

.navbar ul {
  position: absolute;
  inset: 0;
  padding: 50px 0 10px 0;
  margin: 0;
  background: rgba(14, 29, 52, 0.9);
  overflow-y: auto;
  transition: 0.3s;
  z-index: 9998;
}

.navbar a,
.navbar a:focus {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 20px;
  font-family: var(--font-primary);
  font-size: 16px;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.7);
  white-space: nowrap;
  transition: 0.3s;
}

.navbar a i,
.navbar a:focus i {
  font-size: 12px;
  line-height: 0;
  margin-left: 5px;
}

.navbar a:hover,
.navbar .active,
.navbar .active:focus,
.navbar li:hover>a {
  color: #fff;
}

.navbar .get-a-quote,
.navbar .get-a-quote:focus {
  background: var(--color-primary);
  padding: 8px 20px;
  border-radius: 4px;
  margin: 15px;
  color: #fff;
}

.navbar .get-a-quote:hover,
.navbar .get-a-quote:focus:hover {
  color: #fff;
  background: rgba(13, 66, 255, 0.8);
}

.navbar .dropdown ul,
.navbar .dropdown .dropdown ul {
  position: static;
  display: none;
  padding: 10px 0;
  margin: 10px 20px;
  transition: all 0.5s ease-in-out;
  border: 1px solid #19335c;
}

.navbar .dropdown>.dropdown-active,
.navbar .dropdown .dropdown>.dropdown-active {
  display: block;
}

.mobile-nav-show {
  color: #fff;
  font-size: 28px;
  cursor: pointer;
  line-height: 0;
  transition: 0.5s;
  z-index: 9999;
  margin-right: 10px;
}

.mobile-nav-hide {
  color: #fff;
  font-size: 32px;
  cursor: pointer;
  line-height: 0;
  transition: 0.5s;
  position: fixed;
  right: 20px;
  top: 20px;
  z-index: 9999;
}

.mobile-nav-active {
  overflow: hidden;
}

.mobile-nav-active .navbar {
  right: 0;
}

.mobile-nav-active .navbar:before {
  content: "";
  position: fixed;
  inset: 0;
  background: rgba(14, 29, 52, 0.8);
  z-index: 9996;
}
}


    /*--------------------------------------------------------------
# Hero Section
--------------------------------------------------------------*/
#hero {
width: 100%;
height: 70vh;
background: url("img/bot.jpg") top center;
background-size: cover;
position: relative;
padding: 0;
}
#hero:before {
content: "";
background: rgba(13, 20, 26, 0.7);
position: absolute;
bottom: 0;
top: 0;
left: 0;
right: 0;
}
#hero .hero-container {
position: absolute;
bottom: 0;
top: 0;
left: 0;
right: 0;
display: flex;
justify-content: center;
align-items: center;
flex-direction: column;
text-align: center;
}
#hero h1 {
margin: 0 0 10px 0;
font-size: 48px;
font-weight: 700;
line-height: 56px;
text-transform: uppercase;
color: #fff;
}
#hero h2 {
color: #eee;
margin-bottom: 50px;
font-size: 24px;
}
#hero .btn-get-started {
font-family: "Open Sans", sans-serif;
text-transform: uppercase;
font-weight: 500;
font-size: 14px;
display: inline-block;
padding: 10px 35px 10px 35px;
border-radius: 4px;
transition: 0.5s;
color: #fff;
background: #ff4a17;
border: 2px solid #ff4a17;
}
#hero .btn-get-started:hover {
border-color: #fff;
background: rgba(255, 255, 255, 0.1);
}
#hero .btn-watch-video {
font-size: 16px;
display: inline-block;
transition: 0.5s;
margin-left: 25px;
color: #fff;
display: inline-flex;
align-items: center;
justify-content: center;
}
#hero .btn-watch-video i {
line-height: 0;
color: #fff;
font-size: 32px;
transition: 0.3s;
margin-right: 8px;
}
#hero .btn-watch-video:hover i {
color: #ff4a17;
}
@media (min-width: 1024px) {
#hero {
  background-attachment: fixed;
}
}
@media (max-width: 768px) {
#hero h1 {
  font-size: 28px;
  line-height: 36px;
}
#hero h2 {
  font-size: 18px;
  line-height: 24px;
  margin-bottom: 30px;
}
}
</style>

  
    
    <style>
/*--------------------------------------------------------------
# F.A.Q Section
--------------------------------------------------------------*/
#faq {
padding: 60px 0;
}
#faq .faq-list {
padding: 0;
list-style: none;
}
#faq .faq-list li {
border-bottom: 1px solid #e9eaed;
margin-bottom: 20px;
padding-bottom: 20px;
}
#faq .faq-list .question {
display: block;
position: relative;
font-family: #f82249;
font-size: 18px;
line-height: 24px;
font-weight: 400;
padding-left: 25px;
cursor: pointer;
color: #e0072f;
transition: 0.3s;
}
#faq .faq-list i {
font-size: 16px;
position: absolute;
left: 0;
top: -2px;
}
#faq .faq-list p {
margin-bottom: 0;
padding: 10px 0 0 25px;
}
#faq .faq-list .icon-show {
display: none;
}
#faq .faq-list .collapsed {
color: black;
}
#faq .faq-list .collapsed:hover {
color: #f82249;
}
#faq .faq-list .collapsed .icon-show {
display: inline-block;
transition: 0.6s;
}
#faq .faq-list .collapsed .icon-close {
display: none;
transition: 0.6s;
}
</style>
<div class="cover hide"></div>    
    
<div class="padding-50 mobile-padding-none"></div>
<!-- ======= Hero Section ======= -->
<section id="hero">
  <div class="hero-container" data-aos="fade-up" data-aos-delay="150">
    <h1>Bot Trading</h1>
    
    <div class="d-flex">
      <a href="register" class="btn-get-started scrollto">Get Started</a>
     
    </div>
  </div>
</section><!-- End Hero --><br><br>
    
   <div class="container-fluid end-divider">
  <div id="section1" class="container default-wd mobile-padding-top1">
      <div class="title">
      <h2><p class="hidden-xs" style="padding-bottom:5px;font-size:28px; text-align:center;font-weight:600;">{{$settings->site_name}}  Trading Bot</p></h2>
      </div>
      <div class="sub-title mobile-subtitle-1 text-center">
      </div>
      <div class="padding-70"></div>
      <div class="row fb-cus-row">
          
          <div class="col-sm-6 text-content-1" style="paddding-left:0px;padding-right:30px;">
          <div class="text-block1"><p>Cryptocurrencies are known for being incredibly volatile, with prices fluctuating dramatically even in the space of minutes. Investors also have the opportunity to take part in cryptocurrency trading around the world and at any hour of the day. Combined, these factors limit the effectiveness of human cryptocurrency trading in several ways.</p>
          </div>
          <div class="text-block2 padding-30"><p>Investors can simply not dedicate as much time to the cryptocurrency markets as necessary to always achieve the best trades. Doing so would require round-the-clock monitoring of cryptocurrency exchanges all over the globe.</p>
          </div>
          <div class="text-block3 padding-30"><p> Fortunately for many investors, there are solutions to these issues. One of the primary solutions is bots, or automated tools that conduct trades and execute transactions on the behalf of human investors. </p>
          </div>
             
          </div>
          <div class="col-sm-6 text_content-1 padding-left-40" style="padding-left:40px;">
          <div class="text-block1"><h3 class="para-cent trade-commodities-cont-subhead-padding" style="font-size:23px!important;">What are the benefits of Bot trading?</h3>
                  <div class="inner_text padding-default trade-commodities-cont-full-div-padding">
                      <ul style="padding-left: 0px;margin-left:0px!important;"><p></p>
                          <li class="list-item-default cs-209-pl-regin-al-level list-item-trade-commodities91">
<p>Bots are used by traders to take advantage of the cryptocurrency markets that trade 24/7 all over the world.</p>
</li>
<div class="padding-15"></div>
<li class="list-item-default list-item-trade-commodities91">
<p>The advantage bots have over investors is they can react quicker.</p>
</li>
<div class="padding-15"></div>
<li class="list-item-default list-item-trade-commodities91">
<p>Meanwhile, most investors also don't have the time to dedicate to always get the best trade—something that bots can do.</p>
</li>
<div class="padding-15"></div>
<li class="list-item-default list-item-trade-commodities91">
<p>One key type of bot is the arbitrage bot, which looks to take advantage of price discrepancies across exchanges.</p>
</li>
                      </ul>
                  </div>

              </div>
      </div>
  </div>
</div>
</div>
    <section>
     <h2><p style="padding-bottom:5px;font-size:28px; text-align:center;font-weight:600;">Bots</p></h2>
        <div class="container">
      <div class="row">
          <div class="col-lg-6 mb-4">
              <div class="card">
                  <img class="card-img-top" src="#" alt="">

                  <div class="card-body">
                      <h5 class="card-title">Spot Grid</h5>
                      <p class="card-text">
                          Kill volatility, Buy Low and Sell High.
                      </p>
                   
                    <ul class="list-inline list-inline-dotted mb-0">
                     <li class="list-inline-item">APY <a href="#" data-abc="true">16,547%</a></li>
                    </ul><br>
                    <a href="register" class="btn btn-outline-primary">
                          Trade
                      </a>
                  </div>
              </div>
          </div>
           <div class="col-lg-6 mb-4">
              <div class="card">
                  <img class="card-img-top" src="#" alt="">

                  <div class="card-body">
                      <h5 class="card-title">Infinity Grid</h5>
                      <p class="card-text">
                       An Investment Portfolio Spread risk across long term.
                      </p>
                   
                    <ul class="list-inline list-inline-dotted mb-0">
                     <li class="list-inline-item">APY <a href="#" data-abc="true">4,282%</a></li>
                    </ul><br>
                    <a href="register" class="btn btn-outline-primary">
                          Trade
                      </a>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 mb-4">
              <div class="card">
                  <img class="card-img-top" src="#" alt="">

                  <div class="card-body">
                      <h5 class="card-title">Arbitrage Trader</h5>
                      <p class="card-text">
                        Spread risk across long or short term to profit from market trends.
                      </p>
                   
                    <ul class="list-inline list-inline-dotted mb-0">
                     <li class="list-inline-item">APY <a href="#" data-abc="true">1,900%</a></li>
                    </ul><br>
                    <a href="register" class="btn btn-outline-primary">
                          Trade
                      </a>
                  </div>
              </div>
          </div>
        <div class="col-lg-6 mb-4">
              <div class="card">
                  <img class="card-img-top" src="#" alt="">

                  <div class="card-body">
                      <h5 class="card-title">ECA</h5>
                      <p class="card-text">
                        An Investment Portfolio makes profit from margin trading.
                      </p>
                   
                    <ul class="list-inline list-inline-dotted mb-0">
                     <li class="list-inline-item">APY <a href="#" data-abc="true">7,110%</a></li>
                    </ul><br>
                    <a href="register" class="btn btn-outline-primary">
                          Trade
                      </a>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 mb-4">
              <div class="card">
                  <img class="card-img-top" src="#" alt="">

                  <div class="card-body">
                      <h5 class="card-title">Smart Rebalance</h5>
                      <p class="card-text">
                        Spread risk across long or short term to profit from price descripancies.
                      </p>
                   
                    <ul class="list-inline list-inline-dotted mb-0">
                     <li class="list-inline-item">APY <a href="#" data-abc="true">3,420%</a></li>
                    </ul><br>
                    <a href="register" class="btn btn-outline-primary">
                          Trade
                      </a>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 mb-4">
              <div class="card">
                  <img class="card-img-top" src="#" alt="">

                  <div class="card-body">
                      <h5 class="card-title">IJA</h5>
                      <p class="card-text">
                          Make profit from regular investments.
                      </p>
                   
                    <ul class="list-inline list-inline-dotted mb-0">
                     <li class="list-inline-item">APY <a href="#" data-abc="true">2,560%</a></li>
                    </ul><br>
                    <a href="register" class="btn btn-outline-primary">
                          Trade
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </div>
    </section>



        <!-- =======  F.A.Q Section ======= -->
  <section id="faq">

    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>F.A.Q </h2>
      </div>

      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-9">

          <ul class="faq-list">

            <li>
              <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">What is {{$settings->site_name}}  Trading Bot? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
              <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                <p>
                  {{$settings->site_name}}  Trading Bot are free to use software that users can use to automate their crypto trading.
                </p>
              </div>
            </li>

            <li>
              <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">What is Spot Bot trader? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
              <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  The Spot trading bot is a great {{$settings->site_name}}  Trading strategy, it allows users to buy low and sell high in specific price changes. 
                </p>
              </div>
            </li>

            <li>
              <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Can you make money with {{$settings->site_name}}  Trading Bot? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
              <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Countless users have earned passive stable income using {{$settings->site_name}}  Trading Bot at no cost. That said, all trading involves risk. Every investor and trader should trade cryptocurrency responsibly and avoid emotional decisions.
                </p>
              </div>
            </li>

          </ul>

        </div>
      </div>

    </div>

  </section><!-- End  F.A.Q Section -->

<style>
        
        .footers{
        font-size: 14px;
background-color: var(--color-secondary);
padding: 50px 0;
color: white;
        }        
.footers a {color:#f5f5f5;        }
.footers a:hover {color:#e3612d;}
.footers p {color:#f5f5f5;}
.footers ul {
line-height:30px;
   }
      
.footers h5{
color:#fff;
font-family: "Raleway", sans-serif;
font-size: 20px;
font-weight: 500;
line-height: 26px;
}
.footers .bg-dark {
background-color: #010c2b;
}
#social-fb:hover {
   color: #3B5998;
   transition:all .001s;
}
#social-tw:hover {
   color: #4099FF;
   transition:all .001s;
}
#social-gp:hover {
   color: #d34836;
   transition:all .001s;
}
#social-em:hover {
   color: #f39c12;
   transition:all .001s;
}
#social-yb:hover {
   color: #f50a0a;
   transition:all .001s;
}
#social-tm:hover {
   color: #02103b;
   transition:all .001s;
}      
hr{
 width: 50%;
 margin: 0;
 border: none;
}
.disc{
 font-size: 12px;
 line-height: 20px;
 color: #fff;
}
ul#footermenu li {
display:inline;
float: left;
}
.footer {
padding: 10px 0;
}

.footer .copyright {
margin: 0;
}
.footer .footer-social-links {
text-align: right;
}
.footer .footer-social-links a {
display: inline-block;
padding: 0 6px;
color: #fff;
}
.footer .footer-social-links a:hover {
color: #e3612d;
      }
.bg-dark a {
color: #aaa;
}
.font-alt {
font-family: "Raleway", sans-serif;
color: #fff;          
} 
    </style>
  <section class="footers pt-5 pb-3">
      <div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/elementa0d8a0d8.js?cb=googleTranslateElementInit"></script>
@endsection
