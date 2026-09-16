@extends('layouts.base')

@section('title', 'Investments')


@inject('content', 'App\Http\Controllers\FrontController')
@section('content')
<article class="main-layout__content">
            <!-- Begin page-->
            <!---->
            <section class="page-intro page-intro-investments">
              <div class="container container-large"> 
                <h1 class="page-intro__title">RELIABLE INVESTMENT WITH {{$settings->site_name}}<br></h1><br><br>
                <h1 class="page-intro__title"style="color: #69e2b0;">Investments</h1>
                <div class="page-intro__description"> 
                  <p><span class="color-primary">GET LIFE INCOME</span></p>
                </div>		
				<style>
			#class {
    max-width: 100%;
	font-size: 20px;
	text-align: center;
			}
			#classs {
    max-width: 100%;
	font-size: 30px;
	text-align: center;
			}
			</style>
                <div class="page-intro__text"> 
                <h1 class="page-intro__title" id="class"style="color: #fff;	font-size: 20px;">{{$settings->site_name}} MARKETING PLAN</h1>
                  <div class="typography"> 
                    <p>{{$settings->site_name}} developers have created a unique cryptocurrency robot. It predicts the value of Bitcoin while generating daily profit on trades. The {{$settings->site_name}} robot is able to benefit at any stage of the market: both growth and decline.</p>
<p>{{$settings->site_name}} CFO has developed a unique marketing plan for the platform to function fully. The Investors of our company have an excellent opportunity to receive financial benefits on stable terms. You can also use the profitability calculator. It will calculate the exact return on your investment.</p>
                  </div>
                </div>
              </div>
            </section>
            <!---->
            <!---->
            <section class="deposits">
              <div class="container container-large">
                <div class="section-intro"> 
                  <h3 class="title">Investment Proposals                  </h3>
                  <div class="section-intro__description"> 
                    <p style="margin-top: -20px;">{{$settings->site_name}} employees ensure that every investor in our company can earn money</p>
                  </div>
                </div>
                <div class="deposits__block"> 
                  <div class="deposits__slider swiper-container swiper-no-swiping js-swiper-deposits">
                    <div class="swiper-wrapper">
                        @foreach ($plans as $plan)
                      <div class="swiper-slide">
                        <div class="deposits-item is-active" deposit="Starting">
                          <div class="deposits-item__content">
                            <div class="deposits-item__count"style="margin: 0;"> 
                              <div class="deposits-item__count-number">1.8                              </div>
                              <div class="deposits-item__count-content"> 
                                <p class="deposits-item__count-sub">%
                                </p>
                                <p class="deposits-item__count-desc">{{ $plan->name }}                                </p>
                              </div>
                            </div>
                            <div class="deposits-item__item deposits-item__item--earn">
                              <p class="deposits-item__item-title">Daily</p>
                            </div>
                            <div class="deposits-item__item"> 
                              <p class="deposits-item__item-title">Deposit: 
                              </p>
                              <p class="deposits-item__item-value">1000  - 5000 USD
                              </p>
                            </div>
                            <div class="deposits-item__item deposits-item__item--earn">
                              <p class="deposits-item__item-title">every day</p>
                            </div>
                          </div>
                        </div>
                      </div>
					     @endforeach       
		           </div>
                    </div>
                  <div class="deposits__row"> 
                    <div class="deposits__col-sidebar"> 
                      <div class="limits-warning"> 
                        <div class="limits-warning__top">
                          <h4 class="limits-warning__title">GENERAL COMMISSIONS 
                          </h4>
                        </div>
                        <div class="limits-warning__content">
                          <p>These commissions are charged by {{$settings->site_name}} for the platform to work. They are not related to the profit received by our investors</p>
                        </div>
                      </div>
                    </div>
                    <div class="deposits__col-content">
                      
 <div data-deposit="Starting" style="display:block">
                        <div class="typography"> 
                          <ul>
                            <li> 
                              <h4>COMPANY COMMISSION</h4>
                              <p><span class="color-primary">0.5%</span> from the received profit by the robot. This commission shows the earnings of the entire {{$settings->site_name}} structure, namely, each employee.</p>
                            </li>
                            <li> 
                              <h4>ADMINISTRATIVE COMMISSION</h4>
                              <p><span class="color-primary">0.5%</span> for technical support of the robot and the company as a whole. This commission includes the development and marketing costs of the company.</p>
                            </li>
                          </ul>
                        </div>
</div>
<div data-deposit="Standart" >
                        <div class="typography"> 
                          <ul>
                            <li> 
                              <h4>COMPANY COMMISSION</h4>
                              <p><span class="color-primary">0.5%</span> from the received profit by the robot. This commission shows the earnings of the entire {{$settings->site_name}} structure, namely, each employee.</p>
                            </li>
                            <li> 
                              <h4>ADMINISTRATIVE COMMISSION</h4>
                              <p><span class="color-primary">0.5%</span> for technical support of the robot and the company as a whole. This commission includes the development and marketing costs of the company.</p>
                            </li>
                          </ul>
                        </div>
</div>
<div data-deposit="Premium" >
                        <div class="typography"> 
                          <ul>
                            <li> 
                              <h4>COMPANY COMMISSION</h4>
                              <p><span class="color-primary">0.5%</span> from the received profit by the robot. This commission shows the earnings of the entire {{$settings->site_name}} structure, namely, each employee.</p>
                            </li>
                            <li> 
                              <h4>ADMINISTRATIVE COMMISSION</h4>
                              <p><span class="color-primary">0.5%</span> for technical support of the robot and the company as a whole. This commission includes the development and marketing costs of the company.</p>
                            </li>
                          </ul>
                        </div>
</div>
					  
					  
                    </div>
                  </div>
                  <div class="deposits__calculate">
                    <div class="calculate-profit"><a class="btn btn--line-primary js-open-calculate-form"> <span>Calculate Profit</span></a>
                      <form>
                        <div class="calculate-profit__block"> 
                          <div class="calculate-profit__block-row">
                            <div class="field"> 
                              <label>Tariff Plan</label>
                              <div class="select-deposit"> 
                                <div class="select-deposit__trigger">
								<p class="select-deposit__value"><span class="select-deposit__val">Starting</span> <strong><span class="select-deposit__percent">1.8</span><sup>%</sup></strong></p>
                                </div>
                                <select name="" id="selectid">
                                  <option value="2" data-percent="1.8">Starting</option>
                                  <option value="3" data-percent="2.5">Standart</option>
                                  <option value="4" data-percent="3.3">Premium</option>
                                </select>
                              </div>
                            </div>
                            <div class="field"> 
                              <label>Deposit Amount</label>
							  <b id="eror"style="color: red;"></b>
                              <div class="field-group"> 
                                <input class="field-gray field-counter" type="number" name="amount" id="sum" value="100">
                                <div class="field-group__currency">USD</div>
                              </div>
                            </div>
                            <ul class="calculate-stats"> 
                              <li>
                                <p class="calculate-stats__value" id="daily">-</p>
                                <p class="calculate-stats__desc">Daily Income                                </p>
                              </li>
                              <li class="calculate-stats__separate-li">
                                <div class="calculate-stats__separate">
                                </div>
                              </li>
                              <li>
                                <p class="calculate-stats__value"id="weekly">-</p>
                                <p class="calculate-stats__desc">Weekly Income</p>
                              </li>
                              <li class="calculate-stats__separate-li">
                                <div class="calculate-stats__separate">
                                </div>
                              </li>
                              <li>
                                <p class="calculate-stats__value"id="mountly">-</p>
                                <p class="calculate-stats__desc">Monthly Income</p>
                              </li>
                            </ul>
                         	
					  <a class="btn btn--primary" href="login">Deposit</a>
				                             </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>
			
    <script src="temp/custom/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
//Calculator
function calc(n){

select = document.getElementById("selectid");
tar = select.value;

alert;
var okrs	= [2];


 minMoneyur2 = 10;
 
 minMoneyu2 = (10);
 maxMoneyu2 = (500);
 
valut = "USD";


 minMoneyur3 = 500;
 
 minMoneyu3 = (500);
 maxMoneyu3 = (25000);
 
valut = "USD";


 minMoneyur4 = 2000;
 
 minMoneyu4 = (2000);
 maxMoneyu4 = (75000);
 
valut = "USD";




		

	if(tar == 2){
		
var percent 	= [0.018];
		

		minMoneyr = minMoneyur2;
		minMoney = minMoneyu2;
		maxMoney = maxMoneyu2;
	
	}
	if(tar == 3){
		
var percent 	= [0.025];
		

		minMoneyr = minMoneyur3;
		minMoney = minMoneyu3;
		maxMoney = maxMoneyu3;
	
	}
	if(tar == 4){
		
var percent 	= [0.033];
		

		minMoneyr = minMoneyur4;
		minMoney = minMoneyu4;
		maxMoney = maxMoneyu4;
	
	}

	
	
		if(!n){
			document.getElementById("sum").value = minMoneyr; 
		}
		
		if(parseFloat($("#sum").val())<minMoney){
	$("#eror").text("Min: " + minMoney +"");
		}else if(parseFloat($("#sum").val())>maxMoney){
	$("#eror").text("Max: " + maxMoney +"");
		}else if(parseFloat($("#sum").val())<=maxMoney){
	$("#eror").text("");
		}
			


	amount = parseFloat($("#sum").val());
		
			daily = amount * percent;
			daily = daily.toFixed(okrs);
			weekly = daily * 7;
			weekly = weekly.toFixed(okrs);
			mountly = daily * 30;
			mountly = mountly.toFixed(okrs);

			if(amount < minMoney || isNaN(amount) == true){
				$("#daily").text("-");
				$("#weekly").text("-");
				$("#mountly").text("-");
				
			} else {			
				$("#daily").html(daily +'<sub> '+ valut +' </sub>');
				$("#weekly").html(weekly +'<sub> '+ valut +' </sub>');
				$("#mountly").html(mountly +'<sub> '+ valut +' </sub>');
			}

			

	}
	

	
	if($("#sum, #selectid").change){
		calc(false);
	}
	$("#sum").keyup(function(){
		calc(true);
	});
	$("#selectid").click(function(){
		calc(false);
	});
	$("#selectid").change(function(){
		calc(false);
	});
}); 
</script>            <!---->

<style>
.steps .steps-item {text-align: center;
}
</style>
            <section class="steps">
              <div class="container">
                <div class="section-intro"> 
                  <h3 class="title">3 STEPS TO START                  </h3>
                </div>
                <div class="steps__slider swiper-container swiper-no-swiping js-swiper-steps">
                  <div class="steps__hearts"> <img src="temp/custom/assets/images/steps/1.png" alt=""><img src="temp/custom/assets/images/steps/2.png" alt="">
                  </div>
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="steps-item"> 
                        <p class="steps-item__count"><span>#</span>1
                        </p>
                        <h4 class="steps-item__title">REGISTRATION                        </h4>
                        <div class="steps-item__description"> 
                          <p>Click the Register button. Fill in your details to create a FREE {{$settings->site_name}} account in seconds</p>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="steps-item"> 
                        <p class="steps-item__count"><span>#</span>2
                        </p>
                        <h4 class="steps-item__title">CHOOSE INVESTMENT PLAN                        </h4>
                        <div class="steps-item__description"> 
                          <p>We offer a variety of investment plans to suit your financial goals. After reading, make a deposit</p>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="steps-item"> 
                        <p class="steps-item__count"><span>#</span>3
                        </p>
                        <h4 class="steps-item__title">START EARNING                        </h4>
                        <div class="steps-item__description"> 
                          <p>After making a deposit, watch your capital grow by accumulating daily profit in real time</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>            <!---->	
            <section class="text-columns">
              <div class="container">
                <h1 class="page-intro__title" id="classs"style="color: #69e2b0;">UNIQUE TRADING ROBOT FOR TRADING</h1>
                <div class="typography"> 
                  <p>UNIQUE TRADING ROBOT FOR TRADING{{$settings->site_name}} robot is a unique trading tool for getting profit at the stages of growth and fall of the cryptocurrency market. Operations are managed without user intervention. The work of the robot is fully automated and cannot include usage errors. The robot generates the Bitcoin exchange rate, thereby benefiting the company. The main condition for cooperation with {{$settings->site_name}} is the availability of an active deposit to obtain an investment profit in the future.</p>
                </div>
              </div>
            </section>

            <section class="funds">
              <div class="container">
                <div class="section-intro"> 
                  <h3 class="title">BEST {{$settings->site_name}} TRADERS</h3>
                  <div class="section-intro__description"> 
                    <p>The best cryptocurrency developers works in our company. They have a wealth of experience and understanding of the crypto market behind them. They brought {{$settings->site_name}} to the world level of development</p>
                  </div>
                </div>
                <div class="funds__slider swiper-container swiper-no-swiping js-swiper-funds">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="funds-item"> 
                        <div class="funds-item__icon"> <img src="temp/custom/assets/images/funds/1.png" alt="">
                        </div>
                        <h4 class="funds-item__title">UNIQUE TRADING BOT                        </h4>
                        <div class="funds-item__description"> 
                          <p>{{$settings->site_name}} team of professionals has created a unique trading robot that makes profit at any stage of the market: rise or fall</p>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="funds-item is-active">
                        <div class="funds-item__icon"> <img src="temp/custom/assets/images/funds/2.png" alt="">
                        </div>
                        <h4 class="funds-item__title">STABLE AND AUTOMATED INVESTMENT                        </h4>
                        <div class="funds-item__description"> 
                          <p>The robot is not human-related. And that is why all investments are reliable and completely safe</p>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="funds-item"> 
                        <div class="funds-item__icon"> <img src="temp/custom/assets/images/funds/3.png" alt="">
                        </div>
                        <h4 class="funds-item__title">THE EXPERTS WILL DO EVERYTHING FOR YOU                        </h4>
                        <div class="funds-item__description"> 
                          <p>The highly professional {{$settings->site_name}} team controls all the processes of the trading robot around the clock. After investing, you will observe the growth of your capital in real time</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="funds__bottom"> 
				           	
					  <a class="btn btn--line-primary" href="login"><span>INVEST WITH US AND GET STABLE INCOME</span></a>
				                   </div>
              </div>
            </section>

				<div class="payments-and-footer-wrapper">
              <div class="payments-and-footer-wrapper__inner"style="padding-top: 70px;">
					  <section class="payments"style="margin-bottom: 20px;">
                  <div class="container">
                    <div class="payments__row"> 
                      <div class="payments__col"> <img src="temp/custom/assets/images/payments/payment.png" alt="">
                      </div>
                      <div class="payments__col">
                        <div class="payments__content">
                          <div class="section-intro"> 
                            <h3 class="title">PAYMENT SYSTEMS                            </h3>
                            <div class="section-intro__description"> 
                              <p>{{$settings->site_name}} supports a big number of payment systems</p>
                            </div>
                          </div>
                          <div class="typography"> 
                            <p>Our company does not charge commissions for opening a deposit, as well as withdrawing funds from the platform</p>
                          </div>
                          <div class="payments__buttons"> 
           	
					  <a class="btn btn--line-primary" href="login"><span>INVEST</span></a>
				                             </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                  </div>
                  </div>

				
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
    $('body, html').animate({
    scrollTop: 0
    }, 800);
    return false;
    });		 
    });
    </script><script ></script>

 @endsection