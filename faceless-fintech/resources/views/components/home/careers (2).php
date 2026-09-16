@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'Contact us')

@inject('content', 'App\Http\Controllers\FrontController')
@section('content')



            <!---->
            <section class="page-intro page-intro-contacts">
              <div class="container container-large"> 
                <h1 class="page-intro__title">Our<br> contacts                </h1>
              </div>
            </section>
            <section class="contacts page-section">
              <div class="container">
                <div class="contacts__top"> 
                  <h3 class="contacts__title">Send Message                  </h3>
                  <div class="contacts__description"> 
                    <p>Send us a message and we will reply to you within 24 hours!</p>
                  </div>
                </div>
                <div class="contacts__row"> 
                  <div class="contacts__col"> 
                    <div class="contacts-form block-form">
					
            <form id="formPos" action="" method="post" enctype="text/plain">
                      <div class="field field--error">
                        <label>Your Login</label>
                        <input type="text" name="loginq">
                      </div>
                      <div class="field">
                        <label>E-mail</label>
                        <input type="text" name="email">
                      </div>
                      <div class="field">
                        <label>Messages</label>
                        <textarea class="js-textarea" name="text"></textarea>
                      </div>
                      <button type="button"id="button" class="btn btn--primary btn--large">Send                      </button>
                  </form>
                    </div>
                  </div>
                  <div class="contacts__col"> 
                    <ul class="social-links"> 
                      
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </section>

   
    <script src="temp/custom/js/jquery.min.js"></script>
	<script type="text/javascript">
$(document).ready(function(){
	
function butt(){
loginq = $("input[name=loginq]").val().trim();
email = $("input[name=email]").val().trim();
message = $("textarea[name=text]").val().trim();
		
		 if(!email){
			$("#inf").text("Email entered incorrectly");
	window.Modal.openModal('error');
			return;
		}else if(!message){
			$("#inf").text("The message field is empty, please fill it in and repeat the procedure");
	window.Modal.openModal('error');
			return;
		}
			
			$.ajax({
				url:'/ajax/php/support.php',
				type:'POST',
				cache:false,
				data:{'loginq':loginq,'email':email,'message':message},
				dataType: ',
				beforeSend:function(){ 
				$("#button").prop("disabled", true);
				},
				success:function(data){					
				$("#button").prop("disabled", false);
				//$("#formPos").trigger("reset");
            dat = data.substr(1);
				if(data[0]==0){			
		    $("#inf").text(dat);
	window.Modal.openModal('error');
				}else if(data[0]==1){
					$("#formPos").trigger("reset");
			$("#infs").text(dat);
	window.Modal.openModal('success');
				}
				}			
				
			});
	}
	
   
   
   $("#button").click(function(){
		butt();
	});
	
	  $('input[name=loginq],input[name=email],textarea[name=text]').keydown(function(e) {
		 if(e.keyCode === 13) {
			 butt();		 
 }
 
  });
  
	});
</script>
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