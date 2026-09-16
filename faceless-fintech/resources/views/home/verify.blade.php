@extends('layouts.guest')

@section('title', 'User Login')

@section('styles')
@parent

@endsection

@section('content')
 <section style="height: 100vh;" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="pb-3 row justify-content-center">

                <div class="col-12 col-md-6 col-lg-6 col-sm-10 col-xl-6">
                    <a href="/"><img src="{{ asset('storage/app/public/photos/'.$settings->logo)}}" alt="" class="mb-3 img-fluid auth__logo"></a>
                    
                   
                     <div id="google_translate_element" class='text-dark'></div>
                  
                   

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    
                    @if(Session::has('success'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i> {{ Session::get('success') }}
            </div>
        </div>
    </div>
    @endif
                    <div class=" shadow card bg-black border login-page roundedd border-1 ">
                        <div class="card-body">
                            <h6 class='text-center text-white'>Please confirm you are not a Robot by verifying the auto-generated code below, this will enable you have access to Register. </h6>
                            <form method="POST" action="{{ route('codeverify') }}"  class="mt-4 login-form">
                                 @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            
                                            <div class="position-relative">
                                                
                                                <input type="text" class=" form-control text-center text-white btn-primary" name ="email" value="{{$captcha}}"  readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label style="color:#fff !important">Enter code<span class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="number" class="pl-5 form-control" name="code" id="password" placeholder="Enter Code" tabindex="1"
                                     autofocus required>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        
                                    <!--end col-->

                                    <div class="mb-0 col-lg-12">
                                        <button class="btn btn-primary btn-block pad " type="submit">Verify Code</button>
                                    </div>
                                    <!--end col-->

                                    
                                    <!--end col-->
                                    
                                    
                                <!--end row-->
                            </form>
                        </div>
                    </div>
                    <!---->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            
        </div>
        <!--end container-->
       
    </section>
    <!--end section-->



@endsection

@section('scripts')
@parent

@endsection