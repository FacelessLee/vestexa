@extends('layouts.base')

@section('title', 'statistics')


@inject('content', 'App\Http\Controllers\FrontController')
@section('content')
<article class="main-layout__content">
            <!-- Begin page-->
            <section class="page-intro page-intro-statistic">
              <div class="container container-large"> 
                <div class="page-intro__row">
                  <div class="page-intro__content">
                    <h1 class="page-intro__title">Our clients are already making money                    </h1>
                    <div class="page-intro__description"> 
                  <p><span class="color-primary">GET LIFE INCOME</span></p>
                    </div>
                  </div>
                  <div class="page-intro__button"> <a class="btn btn--primary" href="login">OPEN DEPOSIT</a>
                  </div>
                </div>
              </div>
            </section>
            <!---->
            <section class="statisticts-section">
			
              <div class="container container-large">
			  
                <div class="counters__slider swiper-container swiper-no-swiping js-swiper-counters"style="margin-bottom: 40px;">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="count-item"> 
                        <div class="count-item__icon"style="width: 100%;"> 
                          <svg class="svg-icon">
                            <use href="temp/custom/assets/icons/sprite.svg#icon-002-pie-chart"></use>
                          </svg>
                        </div>
                        <p class="count-item__value"style="width: 100%;text-align: center;"><?php echo date('z')+2000?>                       </p>
                        <div class="count-item__description"style="max-width: 100%;text-align: center;">
                          <p>Days in Work</p>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="count-item"> 
                        <div class="count-item__icon"style="width: 100%;"> 
                          <svg class="svg-icon">
                            <use href="temp/custom/assets/icons/sprite.svg#icon-003-people"></use>
                          </svg>
                        </div>
                        <p class="count-item__value"style="width: 100%;text-align: center;">{{$total_users+89650}}                         </p>
                        <div class="count-item__description"style="max-width: 100%;text-align: center;">
                          <p>Total Members</p>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="count-item"> 
                        <div class="count-item__icon"style="width: 100%;"> 
                          <svg class="svg-icon">
                            <use href="temp/custom/assets/icons/sprite.svg#icon-001-money"></use>
                          </svg>
                        </div>
                        <p class="count-item__value"style="width: 100%;text-align: center;">{{$total_deposits+338400989}}  <sub>USD</sub>
                        </p>
                        <div class="count-item__description"style="max-width: 100%;text-align: center;">
                          <p>Total Invested</p>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="count-item"> 
                        <div class="count-item__icon"style="width: 100%;"> 
                          <svg class="svg-icon">
                            <use href="temp/custom/assets/icons/sprite.svg#icon-004-withdraw"></use>
                          </svg>
                        </div>
                        <p class="count-item__value"style="width: 100%;text-align: center;">{{$total_withdrawals+101689885}}<sub>USD</sub>
                        </p>
                        <div class="count-item__description"style="max-width: 100%;text-align: center;">
                          <p>Total Paid</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				
                
              </div>
            </section>
           
       <div id="button-up">
        <i class="fa fa-chevron-up"></i>	
    </div>    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    </script><script src="" async></script>

  @endsection