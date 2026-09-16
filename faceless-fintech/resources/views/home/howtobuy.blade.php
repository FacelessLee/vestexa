
@extends('layouts.base')




@inject('content', 'App\Http\Controllers\FrontController')
@section('content')
<article class="main-layout__content">
            <!-- Begin page-->
            <!---->
            <section>
              <div class="container">
                <h1 class="title title--left">HOW TO BUY CRYPTO               </h1>
                <div class="typography">




<p style="margin:auto; width:50%;padding:10px;">
<ul><li><big> <strong>HOW TO BUY CRYPTO</strong></big></li></ul>

1• Copy the address of your desired crypto payment
2•	Visit <a href="https://www.moonpay.com" target="_blank"> www.moonpay.com </a>;<br>
3•	Click on BUY Crypto;<br>
4•	Select the type of Crypto.<br>
6•	Enter and Continue <br>
6•	Enter the company wallet address and Continue <br>
7•	Enter Your Email address and continue <br>
8•	Enter verification code and continue <br>
9•	Please enter your name and date of birth as they appear on official documents. Inaccurate information will delay the completion of your transaction.<br>




</p>





                </div>
              </div>
            </section>
       <div id="button-up">
        <i class="fa fa-chevron-up"></i>	
    </div>    <link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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