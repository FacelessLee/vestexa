@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')


@inject('content', 'App\Http\Controllers\FrontController')
@section('content')

        <article class="main-layout__content">
            <!-- Begin page-->
            <!---->
            <section class="page-intro page-intro-faq">
              <div class="container container-large"> 
                <h1 class="page-intro__title">Frequently Asked Questions (FAQ)                </h1>
              </div>
            </section>
            <section class="faq page-section">
              <div class="container">
                <ul class="accordion">
                  <li class="accordion__item">
                    <div class="accordion__category-item" data-accordion="trigger">
                      <div class="accordion__icon"> 
                        <svg class="svg-icon">
                          <use href="temp/custom/assets/icons/sprite.svg#icon-triangles"></use>
                        </svg>
                      </div>
                      <div class="accordion__item-content">
                        <h4 class="accordion__title">ABOUT US                        </h4>
                      </div>
                    </div>
                    <div data-accordion="content-container">
                      <div class="accordion__content typography" data-accordion="content">
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">WHAT IS {{$settings->site_name}}?                          </div>
                          <div class="answer-item__content typography">
                            <p>{{$settings->site_name}} - Professional team of cryptocurrency industry developers. The main advantage of the company is a unique trading bot that makes a profit at the stage of growth and market decline.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">IS {{$settings->site_name}} the OFFICIALLY REGISTERED COMPANY?                          </div>
                          <div class="answer-item__content typography">
                            <p>Yes, we are legally binding and officially registered in the UK under the company registration number #08683932</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">DO YOU HAVE ANY COUNTRY RESTRICTIONS?                          </div>
                          <div class="answer-item__content typography">
                            <p>Our company doesn't work and doesn't accept deposits from US residents. During the registration process you need to check the box that you are not a US citizen.</p>
                          </div>
                        </div>
                        <!---->
                      </div>
                    </div>
                  </li>
                  <li class="accordion__item">
                    <div class="accordion__category-item" data-accordion="trigger">
                      <div class="accordion__icon"> 
                        <svg class="svg-icon">
                          <use href="temp/custom/assets/icons/sprite.svg#icon-coins"></use>
                        </svg>
                      </div>
                      <div class="accordion__item-content">
                        <h4 class="accordion__title">MY ACCOUNT                        </h4>
                      </div>
                    </div>
                    <div data-accordion="content-container">
                      <div class="accordion__content typography" data-accordion="content">
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">HOW MANY ACCOUNTS CAN I OPEN?                          </div>
                          <div class="answer-item__content typography">
                            <p>Each user can only open and manage one account. Please follow this rule. In case of violation the company has the right to block all your accounts without a refund.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">HOW TO UPLOAD PERSONAL DATA?                          </div>
                          <div class="answer-item__content typography">
                            <p>Please note that we do not require your personal information. To work with our platform, you need to specify your login, your email, come up with a password, and also specify the wallet number to which funds will be withdrawn from the platform.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">HOW MUCH DOES IT COST TO OPEN AN ACCOUNT?                          </div>
                          <div class="answer-item__content typography">
                            <p>Opening an account is absolutely free. We do not charge you any hidden fees or service charges. The commission on operations and additional costs is included in the company's profits from the profits from the development of cryptocurrency robots.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">CAN I REGISTER MY CHILD?                          </div>
                          <div class="answer-item__content typography">
                            <p>Any person who has reached the age of majority in their country of residence can register in {{$settings->site_name}}</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">CAN I LOSE MY FUNDS BY INVESTING IN YOUR COMPANY?                          </div>
                          <div class="answer-item__content typography">
                            <p>Your investment, as well as your loyalty, are our core values. We will work hard to preserve your funds, reduce the risk of loss to zero, and we will do our best to multiply your funds.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">WHAT DOES THE COMPANY DO WITH USERS' PERSONAL DATA?                          </div>
                          <div class="answer-item__content typography">
                            <p>We collect your personal information only for internal use. This data will not be passed to third parties under any circumstances.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">CAN I BE SURE THAT MY DATA IS SECURE?                          </div>
                          <div class="answer-item__content typography">
                            <p>We guarantee your privacy and secured. The site is protected from complex DDoS attacks by multi-layered protection. Any transmitted data is SSL encrypted. We have high quality SSL certificates.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">WHAT TO DO IF I CAN NOT REGISTER?                          </div>
                          <div class="answer-item__content typography">
                            <p>Make sure that the input data is, such as e-mail, password and login, no spaces. If everything is ok, but registration still fails, please contact online support.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">HOW TO BECOME AN INVESTOR?                          </div>
                          <div class="answer-item__content typography">
                            <p>3 steps to get started with our company<br>
1. REGISTRATION BUTTON<br>
Click the Register button. Enter your details to quickly create a FREE {{$settings->site_name}} account.<br>
2. OPEN A DEPOSIT<br>
We offer different investment plans. You need to choose a plan that suits your financial goals. Make a deposit after reading.<br>
3. START EARNING<br>
After depositing, watch your capital grow by accumulating daily profit in real time.<br></p>
                          </div>
                        </div>
                        <!---->
                      </div>
                    </div>
                  </li>
                  <li class="accordion__item">
                    <div class="accordion__category-item" data-accordion="trigger">
                      <div class="accordion__icon"> 
                        <svg class="svg-icon">
                          <use href="temp/custom/assets/icons/sprite.svg#icon-percent"></use>
                        </svg>
                      </div>
                      <div class="accordion__item-content">
                        <h4 class="accordion__title">DEPOSIT                        </h4>
                      </div>
                    </div>
                    <div data-accordion="content-container">
                      <div class="accordion__content typography" data-accordion="content">
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">WHAT WAYS TO OBTAIN INCOME IN {{$settings->site_name}} ARE?                          </div>
                          <div class="answer-item__content typography">
                            <p>Users have the opportunity to earn in two ways: by opening a deposit for the chosen investment plan, as well as by receiving partner rewards for attracting new members.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">TELL DETAILS HOW TO OPEN A DEPOSIT IN YOUR SYSTEM?                          </div>
                          <div class="answer-item__content typography">
                            <p>Using the username and password you entered during registration, log into your account. Click the "Create Deposit" button. Choose the tariff plan that suits you and enter the amount you plan to invest. After confirming the amount and choosing an electronic payment system, you will be redirected to the electronic payment system. Follow her instructions to pay for the transaction. Then you will be redirected back to your Personal Account again. Funds will be credited automatically to the previously selected investment plan.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">WHAT PAYMENT METHODS CAN I USE TO DEPOSIT?                          </div>
                          <div class="answer-item__content typography">
                            <p>We work with payment systems <b>PerfectMoney</b>, <b>BitCoin</b>, <b>Ethereum</b>, <b>LiteCoin</b>, <b>DogeCoin</b>, <b>TRON</b>, <b>Tether TRC20</b>, <b>Tether ERC20</b></p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">ARE THERE ANY RESTRICTIONS ON THE AMOUNT OF INVESTMENT?                          </div>
                          <div class="answer-item__content typography">
                            <p>The tariff plans set the following restrictions on the minimum and maximum amount of the deposit.<br>
Minimum Amount: <b>10</b> usd, <b>0.005</b> btc, <b>0.02</b> eth, <b>0.3</b> ltc, <b>50</b> doge, <b>100</b> trx, <b>10</b> usdt,   <br>
Maximum Amount: <b>75000</b> usd, <b>1.5</b> btc, <b>20</b> eth, <b>300</b> ltc, <b>350000</b> doge, <b>750000</b> trx, <b>75000</b> usdt,   </p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">ARE THERE ANY INVESTMENT LIMITS?                          </div>
                          <div class="answer-item__content typography">
                            <p>Investments are processed in strict accordance with the terms of the tariff plan.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">IS IT POSSIBLE TO INCREASE THE AMOUNT OF THE WORKING DEPOSIT?                          </div>
                          <div class="answer-item__content typography">
                            <p>No, you cannot increase the amount of a deposit that has already been created. However, you can create other unlimited deposits.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">CAN I MAKE MULTIPLE DEPOSITS AT THE SAME TIME?                          </div>
                          <div class="answer-item__content typography">
                            <p>Yes, you can have an unlimited number of deposits, and you can also invest in different tariff plans at the same time.</p>
                          </div>
                        </div>
                        <!---->
                      </div>
                    </div>
                  </li>
                  <li class="accordion__item">
                    <div class="accordion__category-item" data-accordion="trigger">
                      <div class="accordion__icon"> 
                        <svg class="svg-icon">
                          <use href="temp/custom/assets/icons/sprite.svg#icon-shield"></use>
                        </svg>
                      </div>
                      <div class="accordion__item-content">
                        <h4 class="accordion__title">WITHDRAWAL OF FUNDS                        </h4>
                      </div>
                    </div>
                    <div data-accordion="content-container">
                      <div class="accordion__content typography" data-accordion="content">
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">HOW OFTEN WILL I RECEIVE ACCRUALS ON MY DEPOSITS?                          </div>
                          <div class="answer-item__content typography">
                            <p>Interest on deposits is accrued in accordance with the terms of the investment plan. The countdown starts from the moment you open a deposit in the system.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">HOW LONG DOES IT TAKE TO PROCESS A WITHDRAWAL REQUEST?                          </div>
                          <div class="answer-item__content typography">
                            <p>Withdrawal requests will be processed instantly. For payment systems <b>PerfectMoney</b>,  - funds reach the wallet instantly, after ordering the payment in your account. Waiting time for funds to a wallet for payment systems <b>BitCoin</b>, <b>Ethereum</b>, <b>LiteCoin</b>, <b>DogeCoin</b>, <b>TRON</b>, <b>Tether TRC20</b>, <b>Tether ERC20</b> - At least 3 network confirmations are required and this can take from 20 minutes to several hours.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">CAN I CHOOSE ANOTHER PAYMENT SYSTEM FOR WITHDRAWAL?                          </div>
                          <div class="answer-item__content typography">
                            <p>No, payments are made in the same currency that was used to create the deposit.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">WHAT IS THE WITHDRAWAL OF FUNDS FROM A PERSONAL WALLET?                          </div>
                          <div class="answer-item__content typography">
                            <p>Before withdrawing funds, be sure to check if you have indicated the correct address of your payment wallet to which you will be withdrawing. If you have not registered a wallet, do it by going to the "Wallets" section of your account. In the same section you can always edit your payment details.<br>
After you have made sure that the entered data is correct, you need to go to the 'Withdrawal' section located in your investor's personal account, select the payment system to which you want to withdraw, enter the withdrawal amount and click the withdrawal button funds.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">WHAT IS THE MINIMUM WITHDRAWAL AMOUNT? AND IS THERE A LIMITATION ON THE NUMBER OF WITHDRAWALS OR AMOUNTS PER DAY?                          </div>
                          <div class="answer-item__content typography">
                            <p>The minimum withdrawal amount is: <b>0.1</b> usd, <b>0.002</b> btc, <b>0.03</b> eth, <b>0.1</b> ltc, <b>60</b> doge, <b>60</b> trx, <b>10</b> usdt (trc20), <b>150</b> usdt (erc20). There are no restrictions on the maximum withdrawal amount, as well as the number of withdrawal operations per day.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">HOW DO I FIND MY ACCOUNT TRANSACTION HISTORY?                          </div>
                          <div class="answer-item__content typography">
                            <p>Go to the investor's panel, select 'Transactions' from the menu and there you will see the history of account deposits, incomes and withdrawals.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">WHAT TO DO IF I CANNOT WITHDRAW THE FUNDS? THE SYSTEM CONSTANTLY PRODUCES AN ERROR.                          </div>
                          <div class="answer-item__content typography">
                            <p>If the wallet is registered correctly, the amount is entered correctly and corresponds to the one that is available for withdrawal, but the payment is still rejected by the system, check the correspondence between the currency requested for withdrawal and the electronic payment system selected for payment. If you have a withdrawable dollar amount in the TETHER USDT electronic payment system, you will not be able to withdraw Bitcoin to this wallet.</p>
                          </div>
                        </div>
                        <!---->
                      </div>
                    </div>
                  </li>
                  <li class="accordion__item">
                    <div class="accordion__category-item" data-accordion="trigger">
                      <div class="accordion__icon"> 
                        <svg class="svg-icon">
                          <use href="temp/custom/assets/icons/sprite.svg#icon-question"></use>
                        </svg>
                      </div>
                      <div class="accordion__item-content">
                        <h4 class="accordion__title">REFERRAL PROGRAM                        </h4>
                      </div>
                    </div>
                    <div data-accordion="content-container">
                      <div class="accordion__content typography" data-accordion="content">
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">DO YOU OFFER A REFERRAL PROGRAM?                          </div>
                          <div class="answer-item__content typography">
                            <p>We offer an affiliate program for additional income for our investors. Anyone can take part in the development of the company by inviting new members and receiving a generous reward for this.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">HOW DOES THE AFFILIATE PROGRAM WORK?                          </div>
                          <div class="answer-item__content typography">
                            <p>{{$settings->site_name}} offers a unique investment and referral program that rewards you not only for partners who came from you to the platform, but also for partners from levels 2,3 and 4. This unique affiliate program brings you passive referral income. First, you earn by inviting friends to {{$settings->site_name}}, and then you earn when people in your structure refer new investors to the company. Affiliate system level: 7% - 3% - 2% - 1%</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">DO I NEED TO INVEST IN ORDER TO PARTICIPATE IN THE AFFILIATE PROGRAM?                          </div>
                          <div class="answer-item__content typography">
                            <p>You do not need to apply for participation, own an industry web resource with a large audience of investors or meet other abstract requirements to participate in the referral program. We assign each user a unique referral link immediately after registration, which you can already use to attract other investors, simply by inviting them to the {{$settings->site_name}} website using the referral link.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">DO YOU PROVIDE ADVERTISING MATERIALS?                          </div>
                          <div class="answer-item__content typography">
                            <p>Yes, we have prepared a number of effective banners in various formats for partners that fit harmoniously into any site. You can find them in your personal account</p>
                          </div>
                        </div>
                        <!---->
                      </div>
                    </div>
                  </li>
                  <li class="accordion__item">
                    <div class="accordion__category-item" data-accordion="trigger">
                      <div class="accordion__icon"> 
                        <svg class="svg-icon">
                          <use href="temp/custom/assets/icons/sprite.svg#icon-settings"></use>
                        </svg>
                      </div>
                      <div class="accordion__item-content">
                        <h4 class="accordion__title">ADDITIONAL QUESTIONS                        </h4>
                      </div>
                    </div>
                    <div data-accordion="content-container">
                      <div class="accordion__content typography" data-accordion="content">
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">WHERE CAN I EXCHANGE ONE CURRENCY FOR ANOTHER?                          </div>
                          <div class="answer-item__content typography">
                            <p>You can use monitoring with trusted exchange offices - bestchange. Choose the exchanger with the best rate and follow the instructions.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">HOW TO BE IF I DIDN'T FIND ANSWER TO MY QUESTION?                          </div>
                          <div class="answer-item__content typography">
                            <p>Please contact us through any communication channel. Do not duplicate your message across multiple communication channels. This will not speed up the response, but rather the opposite.</p>
                          </div>
                        </div>
                        <!---->
                        <div class="answer-item"> 
                          <div class="answer-item__trigger">WHAT TO DO IF I FORGOT MY PASSWORD?                          </div>
                          <div class="answer-item__content typography">
                            <p>Click on the reset password link on the main page of the site in the login section. Enter your username and email address and follow the instructions. You will receive information on how to reset your {{$settings->site_name}} account password.</p>
                          </div>
                        </div>
                        <!---->
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </section>
       <div id="button-up">
        <i class="fa fa-chevron-up"></i>	
    </div>    <link rel="stylesheet" href="https:/cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	    #button-up{
display: none;
position: fixed;
right: 20px;
bottom: 60px;
color: #000;
background-color: white;
text-align: center;
font-size: 30px;
padding: 3px 10px 10px 10px;
transition: .3s;
border-radius: 50px;
width: 50px;
height: 50px;
z-index: 9999;
    }
     
    #button-up:hover{
      cursor: pointer;
      background-color: #E8E8E8;
      transition: .3s;
    }
	</style>
	    <script>
    $(document).ready(function() { 
      var button = $('#button-up');	
      $(window).scroll (function () {
        if ($(this).scrollTop () > 300) {
          button.fadeIn();
        } else {
          button.fadeOut();
        }
    });	 
    button.on('click', function(){
    $('body,').animate({
    scrollTop: 0
    }, 800);
    return false;
    });		 
    });
    </script><script ></script>


@endsection