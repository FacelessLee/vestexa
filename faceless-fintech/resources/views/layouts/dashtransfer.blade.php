
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $settings->site_name }} | @yield('title')</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Swift and Secure Money Transfer to any UK bank account will become a breeze with {{$settings->site_name}}." />
  <meta name="csrf_token" content="{{ csrf_token() }}" id="csrf_token" data-turbolinks-permanent>
  <link rel="shortcut icon" href="{{ asset('storage/app/public/' . $settings->favicon) }}" />
  <link rel="stylesheet" href="{{ asset('dash2/libs/%40fortawesome/fontawesome-pro/css/all.min.css') }}">
  <link href="{{ asset('dash2/konanauth/public/asset/fonts/fontawesome/css/all.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('dash2/public/dashboard/plugins/custom/leaflet/leaflet.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('dash2/konanauth/public/dashboard/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('dash2/konanauth/public/dashboard/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
  <link rel="stylesheet" href="{{ asset('dash2/konanauth/public/vendor/megaphone/css/megaphone.css') }}">
  <style >[wire\:loading], [wire\:loading\.delay], [wire\:loading\.inline-block], [wire\:loading\.inline], [wire\:loading\.block], [wire\:loading\.flex], [wire\:loading\.table], [wire\:loading\.grid], [wire\:loading\.inline-flex] {display: none;}[wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short], [wire\:loading\.delay\.long], [wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest] {display:none;}[wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {animation-duration: 50000s;animation-name: livewireautofill;}@keyframes livewireautofill { from {} }</style>
    
    <style>
        @font-face {
        font-family: Graphik;
        font-weight: 400;
        src: url("{{ asset('dash2/konanauth/public/public/asset/fonts/Graphik/GraphikRegular.otf') }}");
    }

    @font-face {
        font-family: Graphik;
        font-weight: 500;
        src: url("{{ asset('dash2/konanauth/public/https://nothingdevelopers.xyz/konan/public/asset/fonts/Graphik/GraphikRegular.otf') }}");
    }

    @font-face {
        font-family: Graphik;
        font-weight: 700;
        src: url("{{ asset('dash2/konanauth/public/asset/fonts/Graphik/GraphikMedium.otf') }}");
    }

    @font-face {
        font-family: Graphik;
        font-weight: 800;
        src: url("{{ asset('dash2/konanauth/public/asset/fonts/Graphik/GraphikBold.otf ') }}");
    }

    @font-face {
        font-family: Graphik;
        font-weight: 900;
        src: url("{{ asset('dash2/konanauth/public/asset/fonts/Graphik/GraphikMedium.otf') }}");
    }
</style>

<style>

.iti {
    position: relative;
    display: block;
}

body
{
    font-family: "Graphik", sans-serif;
}
pre,code,kbd,samp
{
    font-family: "Graphik", Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
}
.tooltip
{
    font-family: "Graphik", sans-serif;
}
.popover
{
    font-family: "Graphik", sans-serif;
}
.text-monospace
{
    font-family: "Graphik", Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace !important;
}
.btn-group-colors > .btn:before
{
    font-family: "Graphik", sans-serif;
}
.has-danger:after
{
    font-family: 'Graphik';
}
.fc-icon
{
    font-family: "Graphik", sans-serif;
}
.ql-container
{
    font-family: "Graphik", sans-serif;
}
</style>

<style>
    .page-loading {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -webkit-transition: all .4s .2s ease-in-out;
        transition: all .4s .2s ease-in-out;
        background-color:#ffffff;
        visibility: hidden;
        z-index: 9999;
    }

    .page-loading.active {
        opacity: 1;
        visibility: visible;
    }

    .page-loading-inner {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        text-align: center;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        -webkit-transition: opacity .2s ease-in-out;
        transition: opacity .2s ease-in-out;
        opacity: 0;
    }

    .page-loading.active>.page-loading-inner {
        opacity: 1;
    }

    .page-loading-inner>span {
        display: block;
        font-size: 1rem;
        font-weight: normal;
        color: #9397ad;
    }

    .page-spinner {
        display: inline-block;
        width: 4.75rem;
        height: 4.75rem;
        margin-bottom: .75rem;
        vertical-align: text-bottom;
        border: .15em solid #0a24f4;
        border-right-color: transparent;
        border-radius: 50%;
        -webkit-animation: spinner .75s linear infinite;
        animation: spinner .75s linear infinite;
    }

    @-webkit-keyframes spinner {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spinner {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
</style></head>
<div class='text-center'>
    
    <div id="google_translate_element"></div>
</div>

@yield('content')


<script src="{{ asset('dash2/konanauth/public/dashboard/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('dash2/konanauth/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('dash2/konanauth/public/dashboard/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('dash2/konanauth/public/asset/fonts/fontawesome/js/all.js') }}"></script>
<script src="{{ asset('dash2/konanauth/public/dashboard/js/custom/general.js') }}"></script>


<script src="{{ asset('dash2/konanauth/public/asset/fonts/fontawesome/js/all.js') }}"></script>
<script src="{{ asset('dash2/konanauth/public/vendor/livewire/livewire.js?id=90730a3b0e7144480175') }}" data-turbo-eval="false" data-turbolinks-eval="false" >
</script><script data-turbo-eval="false" data-turbolinks-eval="false" >window.livewire = new Livewire();window.Livewire = window.livewire;window.livewire_app_url = '{{ $settings->site_url}}';window.livewire_token = 'XBojR3fhO5iYl8wefukaV6n5mCsjqnBSdc4GbFMk';window.deferLoadingAlpine = function (callback) {window.addEventListener('livewire:load', function () {callback();});};let started = false;window.addEventListener('alpine:initializing', function () {if (! started) {window.livewire.start();started = true;}});document.addEventListener("DOMContentLoaded", function () {if (! started) {window.livewire.start();started = true;}});</script>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>
<script src="{{ asset('dash2/konanauth/public/vendor/livewire/livewire.js?id=90730a3b0e7144480175') }}" data-turbo-eval="false" data-turbolinks-eval="false" ></script>


  @if($settings->tido)
    <script src="//code.tidio.co/{{$settings->tido}}" async></script>
    @endif
<script>
  (function() {
    window.onload = function() {
      const preloader = document.querySelector('.page-loading');
      preloader.classList.remove('active');
      setTimeout(function() {
        preloader.remove();
      }, 1000);
    };
  })();
</script>
