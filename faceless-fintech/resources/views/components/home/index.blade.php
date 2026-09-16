
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
      <main id="main">
                <div class="v2" data-styles="bbox">
                    <div class="v2-bbox" style="background-color:#11131B">
                        <div class="v2-bbox__background" data-behavior="bbox" data-instance="bbox__ZXQ753">
                            <video style="min-height: 320px" data-object-fit="none" data-object-position="center 86%" loop="" playsinline="" autoplay="" muted="" src="temp/custom/public/video/hero-frontpages-D.mp4" data-mobilesrc="temp/custom/public/video/hero-frontpages-D.mp4" type="video/mp4" poster="data:image/png;base64,">
                            </video>
                        </div>
                        <div class="v2-bbox__foreground">
                            <div class="v2">
                                <div class="v2-wrapper">
                                    <div class="v2-row v2-xs-align--middle v2-typography--inverted v2-mat100 v2-mab100 v2-sm-max-mat80 v2-sm-max-mab0">
                                        <div class="v2-col-xs-12 v2-col-md-8 v2-clearfix v2-md-align-self--start v2-md-text-align--left v2-text-align--left v2-row-sm-x">
                                            <h3 class="pre-header v2-hide-empty "></h3>
                                            <h2 class="v2-h1" style="padding-left: 20px !important;">
                                                We're on a                                                   
                                                <br>
                                           		Mission                                            
                                            </h2>
                                            <p class="v2-sh1 v2-hide-empty "></p>
                                            <div class="v2-mab30 v2-hide-empty">
                                                <div class="rte--output">
                                                    <p class="v2-sh1" style="padding-left: 20px !important;">
                                                         A mission to harness the power of Bitcoin and technology to enable individual sovereignty and eventually garner the next evolution of humanity.                                                        
                                                                                                              
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="v2-btn-wrapper v2-mab30">
                                                <a href="register" class="v2-btn v2-btn-primary">Open account</a>
                                                <a class="v2-btn v2-btn-secondary--inverted" data-behavior="off-canvas-trigger" data-target="ec42615c-1290-4354-b328-e27faa3cad2f" href="login" data-wide="true" data-scripts-target="[data-ref='off-canvas__content']" data-instance="off-canvas-trigger__8Q63K2"> Login </a>
                                                <div class="v2-hidden "></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="v2">
                                <div class="v2-wrapper">
                                    <div class="v2-row v2-xs-align--middle v2-typography--inverted v2-mat0 v2-mab0 v2-sm-max-mat0 v2-sm-max-mab0">
                                        <div class="v2-col-xs-12 v2-col-md-8 v2-clearfix v2-md-text-align--left v2-text-align--center v2-row-sm-x">
                                            <h3 class="pre-header v2-hide-empty "></h3>
                                            <h2 class="v2-h3">Popular products</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <section class="v2-wrapper v2-mab50 v2-sm-max-mab20n" data-behavior="" data-styles="card-container" data-instance-init="true">
                                <div class="v2-card-container" data-styles="">
                                    <div>
                                        <ul class="v2-row v2-row--gutter-10 v2-stick-boundary--desktop v2-stick-boundary--mobile">
                                            <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                                <div class="v2-card v2-rounded-corner--big v2-typography--inverted" style="background-color:#1A1E2D">
                                                    <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                        <div class="v2-card__header">
                                                            <div class="v2-card__icon v2-card--inline">
                                                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KPHJlY3Qgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIHJ4PSIxNiIgZmlsbD0iI0U2QTAyOCIvPg0KPHBhdGggZD0iTTQzLjI2NDYgNjVIMjcuNjQxNlYzNy44NzNINDMuMjY0NlY0Mi41ODU5SDMzLjM5MzZWNDguNTQySDQyLjU3ODFWNTMuMjU0OUgzMy4zOTM2VjYwLjI1SDQzLjI2NDZWNjVaTTczLjU2NDUgNTEuMzk5NEM3My41NjQ1IDU0LjU5MDggNzIuOTk1NCA1Ny4yNjg5IDcxLjg1NzQgNTkuNDMzNkM3MC43MzE4IDYxLjU4NTkgNjkuMDc0MiA2My4xNjMxIDY2Ljg4NDggNjQuMTY1TDczLjQxNiA3MS40NTdINjYuMDQ5OEw2MS4wNzcxIDY1LjM3MTFINjAuNjUwNEM1Ni40OTQxIDY1LjM3MTEgNTMuMzAyNyA2NC4xNjUgNTEuMDc2MiA2MS43NTI5QzQ4Ljg0OTYgNTkuMzQwOCA0Ny43MzYzIDU1Ljg3NzMgNDcuNzM2MyA1MS4zNjIzQzQ3LjczNjMgNDYuODQ3MyA0OC44NDk2IDQzLjQwMjMgNTEuMDc2MiA0MS4wMjczQzUzLjMxNTEgMzguNjQgNTYuNTE4OSAzNy40NDYzIDYwLjY4NzUgMzcuNDQ2M0M2NC44NTYxIDM3LjQ0NjMgNjguMDQxMyAzOC42NDYyIDcwLjI0MzIgNDEuMDQ1OUM3Mi40NTc0IDQzLjQ0NTYgNzMuNTY0NSA0Ni44OTY4IDczLjU2NDUgNTEuMzk5NFpNNTMuNzY2NiA1MS4zOTk0QzUzLjc2NjYgNTQuNDMgNTQuMzQxOCA1Ni43MTIyIDU1LjQ5MjIgNTguMjQ2MUM1Ni42NDI2IDU5Ljc3OTkgNTguMzYyIDYwLjU0NjkgNjAuNjUwNCA2MC41NDY5QzY1LjIzOTYgNjAuNTQ2OSA2Ny41MzQyIDU3LjQ5NzcgNjcuNTM0MiA1MS4zOTk0QzY3LjUzNDIgNDUuMjg4NyA2NS4yNTIgNDIuMjMzNCA2MC42ODc1IDQyLjIzMzRDNTguMzk5MSA0Mi4yMzM0IDU2LjY3MzUgNDMuMDA2NSA1NS41MTA3IDQ0LjU1MjdDNTQuMzQ4IDQ2LjA4NjYgNTMuNzY2NiA0OC4zNjg4IDUzLjc2NjYgNTEuMzk5NFoiIGZpbGw9IndoaXRlIi8+DQo8L3N2Zz4=">
                                                            </div>
                                                            <h5 class="v2-card__title v2-card--inline">Stocks</h5>
                                                        </div>
                                                        <div class="v2-card__rte">
                                                            <div class="rte--output">
                                                                <p class="text--body">Access 19,000+ stocks across core and emerging markets on 37 exchanges worldwide.</p>
                                                            </div>
                                                        </div>
                                                        <div class="v2-card__cta v2-card__cta--left">
                                                            <div class="v2-card__cta-wrapper">
                                                                <a href="#" data-di-id="8632459c-0bae-4735-8102-2653e9d063ae" class="v2-btn v2-btn--link" id="8632459c-0bae-4735-8102-2653e9d063ae">Read more</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                                <div class="v2-card v2-rounded-corner--big v2-typography--inverted" style="background-color:#1A1E2D">
                                                    <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                        <div class="v2-card__header">
                                                            <div class="v2-card__icon v2-card--inline">
                                                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+DQo8cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgcng9IjE2IiBmaWxsPSIjQTAyRDFFIi8+DQo8cGF0aCBkPSJNMjguMzI4MSA0Mi4yNzA1QzI2LjE2MzQgNDIuMjcwNSAyNC40ODczIDQzLjA4NjkgMjMuMjk5OCA0NC43MTk3QzIyLjExMjMgNDYuMzQwMiAyMS41MTg2IDQ4LjYwMzggMjEuNTE4NiA1MS41MTA3QzIxLjUxODYgNTcuNTU5NiAyMy43ODg0IDYwLjU4NCAyOC4zMjgxIDYwLjU4NEMzMC4yMzMxIDYwLjU4NCAzMi41NCA2MC4xMDc3IDM1LjI0OSA1OS4xNTUzVjYzLjk3OTVDMzMuMDIyNSA2NC45MDcyIDMwLjUzNjEgNjUuMzcxMSAyNy43OSA2NS4zNzExQzIzLjg0NDEgNjUuMzcxMSAyMC44MjU4IDY0LjE3NzQgMTguNzM1NCA2MS43OUMxNi42NDQ5IDU5LjM5MDMgMTUuNTk5NiA1NS45NTE1IDE1LjU5OTYgNTEuNDczNkMxNS41OTk2IDQ4LjY1MzMgMTYuMTEzIDQ2LjE4NTUgMTcuMTM5NiA0NC4wNzAzQzE4LjE2NjMgNDEuOTQyNyAxOS42MzgzIDQwLjMxNjEgMjEuNTU1NyAzOS4xOTA0QzIzLjQ4NTQgMzguMDUyNCAyNS43NDI4IDM3LjQ4MzQgMjguMzI4MSAzNy40ODM0QzMwLjk2MjkgMzcuNDgzNCAzMy42MSAzOC4xMjA0IDM2LjI2OTUgMzkuMzk0NUwzNC40MTQxIDQ0LjA3MDNDMzMuMzk5NyA0My41ODc5IDMyLjM3OTIgNDMuMTY3MyAzMS4zNTI1IDQyLjgwODZDMzAuMzI1OCA0Mi40NDk5IDI5LjMxNzcgNDIuMjcwNSAyOC4zMjgxIDQyLjI3MDVaTTQ2LjY5NzMgNjVINDEuMDM4MVYzNy44NzNINTYuNTg2OVY0Mi41ODU5SDQ2LjY5NzNWNDkuNTgxMUg1NS45MDA0VjU0LjI3NTRINDYuNjk3M1Y2NVpNODQuNDAwNCA1MS4xNzY4Qzg0LjQwMDQgNTUuNjQyMyA4My4xMjYzIDU5LjA2MjUgODAuNTc4MSA2MS40Mzc1Qzc4LjA0MjMgNjMuODEyNSA3NC4zNzQ3IDY1IDY5LjU3NTIgNjVINjEuODkzNlYzNy44NzNINzAuNDEwMkM3NC44Mzg1IDM3Ljg3MyA3OC4yNzczIDM5LjA0MiA4MC43MjY2IDQxLjM3OTlDODMuMTc1OCA0My43MTc4IDg0LjQwMDQgNDYuOTgzNCA4NC40MDA0IDUxLjE3NjhaTTc4LjQyNTggNTEuMzI1MkM3OC40MjU4IDQ1LjQ5OSA3NS44NTI5IDQyLjU4NTkgNzAuNzA3IDQyLjU4NTlINjcuNjQ1NVY2MC4yNUg3MC4xMTMzQzc1LjY1NDkgNjAuMjUgNzguNDI1OCA1Ny4yNzUxIDc4LjQyNTggNTEuMzI1MloiIGZpbGw9IndoaXRlIi8+DQo8L3N2Zz4NCg==">
                                                            </div>
                                                            <h5 class="v2-card__title v2-card--inline">CFDs</h5>
                                                        </div>
                                                        <div class="v2-card__rte">
                                                            <div class="rte--output">
                                                                <p class="text--body">Go long or short on 9,000+ instruments with tight spreads and low commissions.</p>
                                                            </div>
                                                        </div>
                                                        <div class="v2-card__cta v2-card__cta--left">
                                                            <div class="v2-card__cta-wrapper">
                                                                <a href="#" data-di-id="ccece84b-5b93-47c4-b95d-75cb39a22963" class="v2-btn v2-btn--link" id="ccece84b-5b93-47c4-b95d-75cb39a22963">Read more</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                                <div class="v2-card v2-rounded-corner--big v2-typography--inverted" style="background-color:#1A1E2D">
                                                    <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                        <div class="v2-card__header">
                                                            <div class="v2-card__icon v2-card--inline">
                                                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+DQo8cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgcng9IjE2IiBmaWxsPSIjMDA3ODBGIi8+DQo8cGF0aCBkPSJNMzUuOTcyNyA2NUgzMC4zMTM1VjM3Ljg3M0g0NS44NjIzVjQyLjU4NTlIMzUuOTcyN1Y0OS41ODExSDQ1LjE3NThWNTQuMjc1NEgzNS45NzI3VjY1Wk03My4xMDA2IDY1SDY2LjUzMjJMNjAuMjIzNiA1NC43MzkzTDUzLjkxNSA2NUg0Ny43NTQ5TDU2Ljc1MzkgNTEuMDA5OEw0OC4zMzAxIDM3Ljg3M0g1NC42NzU4TDYwLjUyMDUgNDcuNjMyOEw2Ni4yNTM5IDM3Ljg3M0g3Mi40NTEyTDYzLjkzNDYgNTEuMzI1Mkw3My4xMDA2IDY1WiIgZmlsbD0id2hpdGUiLz4NCjwvc3ZnPg0KDQoNCg==">
                                                            </div>
                                                            <h5 class="v2-card__title v2-card--inline">Forex</h5>
                                                        </div>
                                                        <div class="v2-card__rte">
                                                            <div class="rte--output">
                                                                <p class="text--body">Trade 182 FX spot pairs and 140 forwards across majors, minors, exotics and metals.</p>
                                                            </div>
                                                        </div>
                                                        <div class="v2-card__cta v2-card__cta--left">
                                                            <div class="v2-card__cta-wrapper">
                                                                <a href="#" data-di-id="f232e2d0-038f-45a3-83ee-dd0ee1ab1c64" class="v2-btn v2-btn--link" id="f232e2d0-038f-45a3-83ee-dd0ee1ab1c64">Read more</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                                <div class="v2-card v2-rounded-corner--big v2-typography--inverted" style="background-color:#1A1E2D">
                                                    <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                        <div class="v2-card__header">
                                                            <h5 class="v2-card__title v2-card--inline">See all products</h5>
                                                        </div>
                                                        <div class="v2-card__rte">
                                                            <div class="rte--output">
                                                                <p class="text--body">Including futures, ETFs, bonds, mutual funds, forex options and listed options.</p>
                                                            </div>
                                                        </div>
                                                        <div class="v2-card__cta v2-card__cta--left">
                                                            <div class="v2-card__cta-wrapper">
                                                                <a href="#" data-di-id="c588777e-2d6c-4f57-b083-50db2e08cb5f" class="v2-btn v2-btn--link" id="c588777e-2d6c-4f57-b083-50db2e08cb5f">Read more</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div><br><br>
    
        
        		<!-- ======= About Us Section ======= -->
    <section id="about" class="about pt-0">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start order-lg-last order-first">
            <img src="temp/custom/img/Event_Header.jpg" class="img-fluid" alt="">
            <a href="#" class="glightbox play-btn"></a>
          </div>
          <div class="col-lg-6 content order-last  order-lg-first">
            <h3>About Us</h3>
            <p>
              {{$settings->site_name}}  is committed to leading a wave of change; by connecting with, educating and empowering younger generations to reimagine, redefine and reengineer their lives, and the world.
            </p>
            <ul>
              <li data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-diagram-3"></i>
                <div>
                  <h5>Educate</h5>
                  <p>We believe in learning to teach, and teaching to learn. {{$settings->site_name}}  Media is our channel to educate; to connect with the world, to maintain the integrity of our perspective, and to share our intellectual truth.</p>
                </div>
              </li>
              <li data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-fullscreen-exit"></i>
                <div>
                  <h5>Empower</h5>
                  <p>We seek to provide access to tools and information that allows people to empower themselves (both financially and philosophically) as a means towards economic and intellectual sovereignty.</p>
                </div>
              </li>
              <li data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-broadcast"></i>
                <div>
                  <h5>Evolve</h5>
                  <p>We aim to actively contribute to the evolution of humanity through the application and provision of advanced technologies and tools that have a positive impact at both an individual and collective level.</p>
                </div>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

                
        		<div style="padding-top:5px !important" class="v2">
                    <div class="v2-wrapper">
                        <div class="v2-row v2-xs-align--middle v2-mat100 v2-mab40 v2-sm-max-mat50 v2-sm-max-mab40n">
                            <div class="v2-col-xs-12 v2-col-md-8 v2-clearfix v2-md-text-align--left v2-text-align--left v2-row-sm-x">
                                <h3 class="pre-header v2-hide-empty "></h3>
                                <h2 class="v2-h2" style="padding-left: 25px !important;">Explore all products</h2>
                                <p class="v2-sh1 v2-hide-empty" style="padding-left: 20px !important;">Invest in cash products, trade with leveraged products or let the experts manage your money.</p>
                                <div class="v2-mab30 v2-hide-empty "></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="v2">
                    <div class="v2-wrapper">
                        <div class="v2-row v2-xs-align--middle v2-mat0 v2-mab0 v2-sm-max-mat50 v2-sm-max-mab0">
                            <div class="v2-col-xs-12 v2-col-md-8 v2-clearfix v2-md-text-align--left v2-text-align--left v2-row-sm-x">
                                <h3 class="pre-header v2-hide-empty "></h3>
                                <h2 class="v2-h3" style="padding-left: 25px !important;">Investment products</h2>
                                <p class="v2-sh1 v2-hide-empty "></p>
                                <div class="v2-mab30 v2-hide-empty "></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="v2">
                    <section class="v2-wrapper v2-mab40" data-behavior="" data-styles="card-container" data-instance-init="true">
                        <div class="v2-card-container" data-styles="">
                            <div>
                                <ul class="v2-row v2-row--gutter-10 v2-stick-boundary--desktop v2-stick-boundary--mobile">
                                    <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                        <a target="" class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <div class="v2-card__icon v2-card--inline">
                                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KPHJlY3Qgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIHJ4PSIxNiIgZmlsbD0iI0U2QTAyOCIvPg0KPHBhdGggZD0iTTQzLjI2NDYgNjVIMjcuNjQxNlYzNy44NzNINDMuMjY0NlY0Mi41ODU5SDMzLjM5MzZWNDguNTQySDQyLjU3ODFWNTMuMjU0OUgzMy4zOTM2VjYwLjI1SDQzLjI2NDZWNjVaTTczLjU2NDUgNTEuMzk5NEM3My41NjQ1IDU0LjU5MDggNzIuOTk1NCA1Ny4yNjg5IDcxLjg1NzQgNTkuNDMzNkM3MC43MzE4IDYxLjU4NTkgNjkuMDc0MiA2My4xNjMxIDY2Ljg4NDggNjQuMTY1TDczLjQxNiA3MS40NTdINjYuMDQ5OEw2MS4wNzcxIDY1LjM3MTFINjAuNjUwNEM1Ni40OTQxIDY1LjM3MTEgNTMuMzAyNyA2NC4xNjUgNTEuMDc2MiA2MS43NTI5QzQ4Ljg0OTYgNTkuMzQwOCA0Ny43MzYzIDU1Ljg3NzMgNDcuNzM2MyA1MS4zNjIzQzQ3LjczNjMgNDYuODQ3MyA0OC44NDk2IDQzLjQwMjMgNTEuMDc2MiA0MS4wMjczQzUzLjMxNTEgMzguNjQgNTYuNTE4OSAzNy40NDYzIDYwLjY4NzUgMzcuNDQ2M0M2NC44NTYxIDM3LjQ0NjMgNjguMDQxMyAzOC42NDYyIDcwLjI0MzIgNDEuMDQ1OUM3Mi40NTc0IDQzLjQ0NTYgNzMuNTY0NSA0Ni44OTY4IDczLjU2NDUgNTEuMzk5NFpNNTMuNzY2NiA1MS4zOTk0QzUzLjc2NjYgNTQuNDMgNTQuMzQxOCA1Ni43MTIyIDU1LjQ5MjIgNTguMjQ2MUM1Ni42NDI2IDU5Ljc3OTkgNTguMzYyIDYwLjU0NjkgNjAuNjUwNCA2MC41NDY5QzY1LjIzOTYgNjAuNTQ2OSA2Ny41MzQyIDU3LjQ5NzcgNjcuNTM0MiA1MS4zOTk0QzY3LjUzNDIgNDUuMjg4NyA2NS4yNTIgNDIuMjMzNCA2MC42ODc1IDQyLjIzMzRDNTguMzk5MSA0Mi4yMzM0IDU2LjY3MzUgNDMuMDA2NSA1NS41MTA3IDQ0LjU1MjdDNTQuMzQ4IDQ2LjA4NjYgNTMuNzY2NiA0OC4zNjg4IDUzLjc2NjYgNTEuMzk5NFoiIGZpbGw9IndoaXRlIi8+DQo8L3N2Zz4=">
                                                    </div>
                                                    <h5 class="v2-card__title v2-card--inline">Stocks</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                        <a target="" class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <div class="v2-card__icon v2-card--inline">
                                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+DQo8c3ltYm9sIGlkPSJtYWluIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCI+DQo8cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgcng9IjE2IiBmaWxsPSIjMDBDQzk5Ii8+DQo8cGF0aCBkPSJNMzYuOTU2MSA2NUgyMS4zMzNWMzcuODczSDM2Ljk1NjFWNDIuNTg1OUgyNy4wODVWNDguNTQySDM2LjI2OTVWNTMuMjU0OUgyNy4wODVWNjAuMjVIMzYuOTU2MVY2NVpNNTMuMDk4NiA2NUg0Ny4zNDY3VjQyLjY2MDJIMzkuOTgwNVYzNy44NzNINjAuNDY0OFY0Mi42NjAySDUzLjA5ODZWNjVaTTcwLjI5ODggNjVINjQuNjM5NlYzNy44NzNIODAuMTg4NVY0Mi41ODU5SDcwLjI5ODhWNDkuNTgxMUg3OS41MDJWNTQuMjc1NEg3MC4yOTg4VjY1WiIgZmlsbD0id2hpdGUiLz4NCjwvc3ltYm9sPg0KPHVzZSBocmVmPSIjbWFpbiIgLz4NCjwvc3ZnPg0K">
                                                    </div>
                                                    <h5 class="v2-card__title v2-card--inline">ETF</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                        <a target="" class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <div class="v2-card__icon v2-card--inline">
                                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KPHJlY3Qgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIHJ4PSIxNiIgZmlsbD0iIzU1NzhBQSIvPg0KPHBhdGggZD0iTTI1LjUyNjQgMzcuODczSDMzLjk2ODhDMzcuODE1OCAzNy44NzMgNDAuNjA1MSAzOC40MjM1IDQyLjMzNjkgMzkuNTI0NEM0NC4wODExIDQwLjYxMyA0NC45NTMxIDQyLjM1MDkgNDQuOTUzMSA0NC43MzgzQzQ0Ljk1MzEgNDYuMzU4NyA0NC41Njk3IDQ3LjY4ODUgNDMuODAyNyA0OC43Mjc1QzQzLjA0ODIgNDkuNzY2NiA0Mi4wNCA1MC4zOTEzIDQwLjc3ODMgNTAuNjAxNlY1MC43ODcxQzQyLjQ5NzcgNTEuMTcwNiA0My43MzQ3IDUxLjg4OCA0NC40ODkzIDUyLjkzOTVDNDUuMjU2MiA1My45OTA5IDQ1LjYzOTYgNTUuMzg4NyA0NS42Mzk2IDU3LjEzMjhDNDUuNjM5NiA1OS42MDY4IDQ0Ljc0MjggNjEuNTM2NSA0Mi45NDkyIDYyLjkyMTlDNDEuMTY4IDY0LjMwNzMgMzguNzQzNSA2NSAzNS42NzU4IDY1SDI1LjUyNjRWMzcuODczWk0zMS4yNzgzIDQ4LjYxNjJIMzQuNjE4MkMzNi4xNzY4IDQ4LjYxNjIgMzcuMzAyNCA0OC4zNzUgMzcuOTk1MSA0Ny44OTI2QzM4LjcwMDIgNDcuNDEwMiAzOS4wNTI3IDQ2LjYxMjMgMzkuMDUyNyA0NS40OTlDMzkuMDUyNyA0NC40NiAzOC42NjkzIDQzLjcxNzggMzcuOTAyMyA0My4yNzI1QzM3LjE0NzggNDIuODE0OCAzNS45NDc5IDQyLjU4NTkgMzQuMzAyNyA0Mi41ODU5SDMxLjI3ODNWNDguNjE2MlpNMzEuMjc4MyA1My4xODA3VjYwLjI1SDM1LjAyNjRDMzYuNjA5NyA2MC4yNSAzNy43Nzg2IDU5Ljk0NjkgMzguNTMzMiA1OS4zNDA4QzM5LjI4NzggNTguNzM0NyAzOS42NjUgNTcuODA3IDM5LjY2NSA1Ni41NTc2QzM5LjY2NSA1NC4zMDYzIDM4LjA1NyA1My4xODA3IDM0Ljg0MDggNTMuMTgwN0gzMS4yNzgzWk03NS42Nzk3IDUxLjM5OTRDNzUuNjc5NyA1NS44ODk2IDc0LjU2NjQgNTkuMzQwOCA3Mi4zMzk4IDYxLjc1MjlDNzAuMTEzMyA2NC4xNjUgNjYuOTIxOSA2NS4zNzExIDYyLjc2NTYgNjUuMzcxMUM1OC42MDk0IDY1LjM3MTEgNTUuNDE4IDY0LjE2NSA1My4xOTE0IDYxLjc1MjlDNTAuOTY0OCA1OS4zNDA4IDQ5Ljg1MTYgNTUuODc3MyA0OS44NTE2IDUxLjM2MjNDNDkuODUxNiA0Ni44NDczIDUwLjk2NDggNDMuNDAyMyA1My4xOTE0IDQxLjAyNzNDNTUuNDMwMyAzOC42NCA1OC42MzQxIDM3LjQ0NjMgNjIuODAyNyAzNy40NDYzQzY2Ljk3MTQgMzcuNDQ2MyA3MC4xNTY2IDM4LjY0NjIgNzIuMzU4NCA0MS4wNDU5Qzc0LjU3MjYgNDMuNDQ1NiA3NS42Nzk3IDQ2Ljg5NjggNzUuNjc5NyA1MS4zOTk0Wk01NS44ODE4IDUxLjM5OTRDNTUuODgxOCA1NC40MyA1Ni40NTcgNTYuNzEyMiA1Ny42MDc0IDU4LjI0NjFDNTguNzU3OCA1OS43Nzk5IDYwLjQ3NzIgNjAuNTQ2OSA2Mi43NjU2IDYwLjU0NjlDNjcuMzU0OCA2MC41NDY5IDY5LjY0OTQgNTcuNDk3NyA2OS42NDk0IDUxLjM5OTRDNjkuNjQ5NCA0NS4yODg3IDY3LjM2NzIgNDIuMjMzNCA2Mi44MDI3IDQyLjIzMzRDNjAuNTE0MyA0Mi4yMzM0IDU4Ljc4ODcgNDMuMDA2NSA1Ny42MjYgNDQuNTUyN0M1Ni40NjMyIDQ2LjA4NjYgNTUuODgxOCA0OC4zNjg4IDU1Ljg4MTggNTEuMzk5NFoiIGZpbGw9IndoaXRlIi8+DQo8L3N2Zz4NCg==">
                                                    </div>
                                                    <h5 class="v2-card__title v2-card--inline">Bonds</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="v2">
                    <div class="v2-wrapper">
                        <div class="v2-row v2-xs-align--middle v2-mat0 v2-mab0 v2-sm-max-mat0 v2-sm-max-mab0">
                            <div class="v2-col-xs-12 v2-col-md-8 v2-clearfix v2-md-text-align--left v2-text-align--left v2-row-sm-x">
                                <h3 class="pre-header v2-hide-empty "></h3>
                                <h2 class="v2-h3" style="padding-left: 25px !important;">Leveraged products</h2>
                                <p class="v2-sh1 v2-hide-empty "></p>
                                <div class="v2-mab30 v2-hide-empty "></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="v2">
                    <section class="v2-wrapper" data-behavior="" data-styles="card-container" data-instance-init="true">
                        <div class="v2-card-container" data-styles="">
                            <div>
                                <ul class="v2-row v2-row--gutter-10 v2-stick-boundary--desktop v2-stick-boundary--mobile">
                                    <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                        <a target="" class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <div class="v2-card__icon v2-card--inline">
                                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+DQo8cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgcng9IjE2IiBmaWxsPSIjMDA3ODBGIi8+DQo8cGF0aCBkPSJNMzUuOTcyNyA2NUgzMC4zMTM1VjM3Ljg3M0g0NS44NjIzVjQyLjU4NTlIMzUuOTcyN1Y0OS41ODExSDQ1LjE3NThWNTQuMjc1NEgzNS45NzI3VjY1Wk03My4xMDA2IDY1SDY2LjUzMjJMNjAuMjIzNiA1NC43MzkzTDUzLjkxNSA2NUg0Ny43NTQ5TDU2Ljc1MzkgNTEuMDA5OEw0OC4zMzAxIDM3Ljg3M0g1NC42NzU4TDYwLjUyMDUgNDcuNjMyOEw2Ni4yNTM5IDM3Ljg3M0g3Mi40NTEyTDYzLjkzNDYgNTEuMzI1Mkw3My4xMDA2IDY1WiIgZmlsbD0id2hpdGUiLz4NCjwvc3ZnPg0KDQoNCg==">
                                                    </div>
                                                    <h5 class="v2-card__title v2-card--inline">Forex</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                        <a target="" class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <div class="v2-card__icon v2-card--inline">
                                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+DQo8cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgcng9IjE2IiBmaWxsPSIjQTAyRDFFIi8+DQo8cGF0aCBkPSJNMjguMzI4MSA0Mi4yNzA1QzI2LjE2MzQgNDIuMjcwNSAyNC40ODczIDQzLjA4NjkgMjMuMjk5OCA0NC43MTk3QzIyLjExMjMgNDYuMzQwMiAyMS41MTg2IDQ4LjYwMzggMjEuNTE4NiA1MS41MTA3QzIxLjUxODYgNTcuNTU5NiAyMy43ODg0IDYwLjU4NCAyOC4zMjgxIDYwLjU4NEMzMC4yMzMxIDYwLjU4NCAzMi41NCA2MC4xMDc3IDM1LjI0OSA1OS4xNTUzVjYzLjk3OTVDMzMuMDIyNSA2NC45MDcyIDMwLjUzNjEgNjUuMzcxMSAyNy43OSA2NS4zNzExQzIzLjg0NDEgNjUuMzcxMSAyMC44MjU4IDY0LjE3NzQgMTguNzM1NCA2MS43OUMxNi42NDQ5IDU5LjM5MDMgMTUuNTk5NiA1NS45NTE1IDE1LjU5OTYgNTEuNDczNkMxNS41OTk2IDQ4LjY1MzMgMTYuMTEzIDQ2LjE4NTUgMTcuMTM5NiA0NC4wNzAzQzE4LjE2NjMgNDEuOTQyNyAxOS42MzgzIDQwLjMxNjEgMjEuNTU1NyAzOS4xOTA0QzIzLjQ4NTQgMzguMDUyNCAyNS43NDI4IDM3LjQ4MzQgMjguMzI4MSAzNy40ODM0QzMwLjk2MjkgMzcuNDgzNCAzMy42MSAzOC4xMjA0IDM2LjI2OTUgMzkuMzk0NUwzNC40MTQxIDQ0LjA3MDNDMzMuMzk5NyA0My41ODc5IDMyLjM3OTIgNDMuMTY3MyAzMS4zNTI1IDQyLjgwODZDMzAuMzI1OCA0Mi40NDk5IDI5LjMxNzcgNDIuMjcwNSAyOC4zMjgxIDQyLjI3MDVaTTQ2LjY5NzMgNjVINDEuMDM4MVYzNy44NzNINTYuNTg2OVY0Mi41ODU5SDQ2LjY5NzNWNDkuNTgxMUg1NS45MDA0VjU0LjI3NTRINDYuNjk3M1Y2NVpNODQuNDAwNCA1MS4xNzY4Qzg0LjQwMDQgNTUuNjQyMyA4My4xMjYzIDU5LjA2MjUgODAuNTc4MSA2MS40Mzc1Qzc4LjA0MjMgNjMuODEyNSA3NC4zNzQ3IDY1IDY5LjU3NTIgNjVINjEuODkzNlYzNy44NzNINzAuNDEwMkM3NC44Mzg1IDM3Ljg3MyA3OC4yNzczIDM5LjA0MiA4MC43MjY2IDQxLjM3OTlDODMuMTc1OCA0My43MTc4IDg0LjQwMDQgNDYuOTgzNCA4NC40MDA0IDUxLjE3NjhaTTc4LjQyNTggNTEuMzI1MkM3OC40MjU4IDQ1LjQ5OSA3NS44NTI5IDQyLjU4NTkgNzAuNzA3IDQyLjU4NTlINjcuNjQ1NVY2MC4yNUg3MC4xMTMzQzc1LjY1NDkgNjAuMjUgNzguNDI1OCA1Ny4yNzUxIDc4LjQyNTggNTEuMzI1MloiIGZpbGw9IndoaXRlIi8+DQo8L3N2Zz4NCg==">
                                                    </div>
                                                    <h5 class="v2-card__title v2-card--inline">CFDs</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                        <a target="" class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <div class="v2-card__icon v2-card--inline">
                                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiByeD0iMiIgZmlsbD0iIzUwNUY4MiIvPgo8cGF0aCBkPSJNMy4yMjc1NCA2LjQxMTEzQzIuODg1NzQgNi40MTExMyAyLjYyMTA5IDYuNTQwMDQgMi40MzM1OSA2Ljc5Nzg1QzIuMjQ2MDkgNy4wNTM3MSAyLjE1MjM0IDcuNDExMTMgMi4xNTIzNCA3Ljg3MDEyQzIuMTUyMzQgOC44MjUyIDIuNTEwNzQgOS4zMDI3MyAzLjIyNzU0IDkuMzAyNzNDMy41MjgzMiA5LjMwMjczIDMuODkyNTggOS4yMjc1NCA0LjMyMDMxIDkuMDc3MTVWOS44Mzg4N0MzLjk2ODc1IDkuOTg1MzUgMy41NzYxNyAxMC4wNTg2IDMuMTQyNTggMTAuMDU4NkMyLjUxOTUzIDEwLjA1ODYgMi4wNDI5NyA5Ljg3MDEyIDEuNzEyODkgOS40OTMxNkMxLjM4MjgxIDkuMTE0MjYgMS4yMTc3NyA4LjU3MTI5IDEuMjE3NzcgNy44NjQyNkMxLjIxNzc3IDcuNDE4OTUgMS4yOTg4MyA3LjAyOTMgMS40NjA5NCA2LjY5NTMxQzEuNjIzMDUgNi4zNTkzOCAxLjg1NTQ3IDYuMTAyNTQgMi4xNTgyIDUuOTI0OEMyLjQ2Mjg5IDUuNzQ1MTIgMi44MTkzNCA1LjY1NTI3IDMuMjI3NTQgNS42NTUyN0MzLjY0MzU1IDUuNjU1MjcgNC4wNjE1MiA1Ljc1NTg2IDQuNDgxNDUgNS45NTcwM0w0LjE4ODQ4IDYuNjk1MzFDNC4wMjgzMiA2LjYxOTE0IDMuODY3MTkgNi41NTI3MyAzLjcwNTA4IDYuNDk2MDlDMy41NDI5NyA2LjQzOTQ1IDMuMzgzNzkgNi40MTExMyAzLjIyNzU0IDYuNDExMTNaTTkuMTIyMDcgNy44NTI1NEM5LjEyMjA3IDguNTYxNTIgOC45NDYyOSA5LjEwNjQ1IDguNTk0NzMgOS40ODczQzguMjQzMTYgOS44NjgxNiA3LjczOTI2IDEwLjA1ODYgNy4wODMwMSAxMC4wNTg2QzYuNDI2NzYgMTAuMDU4NiA1LjkyMjg1IDkuODY4MTYgNS41NzEyOSA5LjQ4NzNDNS4yMTk3MyA5LjEwNjQ1IDUuMDQzOTUgOC41NTk1NyA1LjA0Mzk1IDcuODQ2NjhDNS4wNDM5NSA3LjEzMzc5IDUuMjE5NzMgNi41ODk4NCA1LjU3MTI5IDYuMjE0ODRDNS45MjQ4IDUuODM3ODkgNi40MzA2NiA1LjY0OTQxIDcuMDg4ODcgNS42NDk0MUM3Ljc0NzA3IDUuNjQ5NDEgOC4yNSA1LjgzODg3IDguNTk3NjYgNi4yMTc3N0M4Ljk0NzI3IDYuNTk2NjggOS4xMjIwNyA3LjE0MTYgOS4xMjIwNyA3Ljg1MjU0Wk01Ljk5NjA5IDcuODUyNTRDNS45OTYwOSA4LjMzMTA1IDYuMDg2OTEgOC42OTE0MSA2LjI2ODU1IDguOTMzNTlDNi40NTAyIDkuMTc1NzggNi43MjE2OCA5LjI5Njg4IDcuMDgzMDEgOS4yOTY4OEM3LjgwNzYyIDkuMjk2ODggOC4xNjk5MiA4LjgxNTQzIDguMTY5OTIgNy44NTI1NEM4LjE2OTkyIDYuODg3NyA3LjgwOTU3IDYuNDA1MjcgNy4wODg4NyA2LjQwNTI3QzYuNzI3NTQgNi40MDUyNyA2LjQ1NTA4IDYuNTI3MzQgNi4yNzE0OCA2Ljc3MTQ4QzYuMDg3ODkgNy4wMTM2NyA1Ljk5NjA5IDcuMzc0MDIgNS45OTYwOSA3Ljg1MjU0Wk0xMS44MjMyIDEwTDEwLjc5MiA2LjYzOTY1SDEwLjc2NTZDMTAuODAyNyA3LjMyMzI0IDEwLjgyMTMgNy43NzkzIDEwLjgyMTMgOC4wMDc4MVYxMEgxMC4wMDk4VjUuNzE2OEgxMS4yNDYxTDEyLjI1OTggOC45OTIxOUgxMi4yNzczTDEzLjM1MjUgNS43MTY4SDE0LjU4ODlWMTBIMTMuNzQyMlY3Ljk3MjY2QzEzLjc0MjIgNy44NzY5NSAxMy43NDMyIDcuNzY2NiAxMy43NDUxIDcuNjQxNkMxMy43NDkgNy41MTY2IDEzLjc2MjcgNy4xODQ1NyAxMy43ODYxIDYuNjQ1NTFIMTMuNzU5OEwxMi42NTUzIDEwSDExLjgyMzJaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4K">
                                                    </div>
                                                    <h5 class="v2-card__title v2-card--inline">Commodities</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                        <a target="" class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <div class="v2-card__icon v2-card--inline">
                                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KPHJlY3Qgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIHJ4PSIxNiIgZmlsbD0iIzUwNUY4MiIvPg0KPHBhdGggZD0iTTM0LjI4NDIgNjVIMjguNjI1VjM3Ljg3M0g0NC4xNzM4VjQyLjU4NTlIMzQuMjg0MlY0OS41ODExSDQzLjQ4NzNWNTQuMjc1NEgzNC4yODQyVjY1Wk03MS41NjA1IDM3Ljg3M1Y1NS40MjU4QzcxLjU2MDUgNTcuNDI5NyA3MS4xMDkgNTkuMTg2MiA3MC4yMDYxIDYwLjY5NTNDNjkuMzE1NCA2Mi4yMDQ0IDY4LjAyMjggNjMuMzYxIDY2LjMyODEgNjQuMTY1QzY0LjYzMzUgNjQuOTY5MSA2Mi42Mjk2IDY1LjM3MTEgNjAuMzE2NCA2NS4zNzExQzU2LjgyODEgNjUuMzcxMSA1NC4xMTkxIDY0LjQ4MDUgNTIuMTg5NSA2Mi42OTkyQzUwLjI1OTggNjAuOTA1NiA0OS4yOTQ5IDU4LjQ1NjQgNDkuMjk0OSA1NS4zNTE2VjM3Ljg3M0g1NS4wMjgzVjU0LjQ3OTVDNTUuMDI4MyA1Ni41NyA1NS40NDg5IDU4LjEwMzggNTYuMjkgNTkuMDgxMUM1Ny4xMzEyIDYwLjA1ODMgNTguNTIyOCA2MC41NDY5IDYwLjQ2NDggNjAuNTQ2OUM2Mi4zNDUxIDYwLjU0NjkgNjMuNzA1NyA2MC4wNTgzIDY0LjU0NjkgNTkuMDgxMUM2NS40MDA0IDU4LjA5MTUgNjUuODI3MSA1Ni41NDUyIDY1LjgyNzEgNTQuNDQyNFYzNy44NzNINzEuNTYwNVoiIGZpbGw9IndoaXRlIi8+DQo8L3N2Zz4NCg==">
                                                    </div>
                                                    <h5 class="v2-card__title v2-card--inline">Staking</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                        <a target="" class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <div class="v2-card__icon v2-card--inline">
                                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KPHJlY3Qgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIHJ4PSIxNiIgZmlsbD0iIzAwNzgwRiIvPg0KPHBhdGggZD0iTTIwLjg1MDYgNjVIMTUuMTkxNFYzNy44NzNIMzAuNzQwMlY0Mi41ODU5SDIwLjg1MDZWNDkuNTgxMUgzMC4wNTM3VjU0LjI3NTRIMjAuODUwNlY2NVpNNTcuOTc4NSA2NUg1MS40MTAyTDQ1LjEwMTYgNTQuNzM5M0wzOC43OTMgNjVIMzIuNjMyOEw0MS42MzE4IDUxLjAwOThMMzMuMjA4IDM3Ljg3M0gzOS41NTM3TDQ1LjM5ODQgNDcuNjMyOEw1MS4xMzE4IDM3Ljg3M0g1Ny4zMjkxTDQ4LjgxMjUgNTEuMzI1Mkw1Ny45Nzg1IDY1Wk04Ni4wMTQ2IDUxLjM5OTRDODYuMDE0NiA1NS44ODk2IDg0LjkwMTQgNTkuMzQwOCA4Mi42NzQ4IDYxLjc1MjlDODAuNDQ4MiA2NC4xNjUgNzcuMjU2OCA2NS4zNzExIDczLjEwMDYgNjUuMzcxMUM2OC45NDQzIDY1LjM3MTEgNjUuNzUyOSA2NC4xNjUgNjMuNTI2NCA2MS43NTI5QzYxLjI5OTggNTkuMzQwOCA2MC4xODY1IDU1Ljg3NzMgNjAuMTg2NSA1MS4zNjIzQzYwLjE4NjUgNDYuODQ3MyA2MS4yOTk4IDQzLjQwMjMgNjMuNTI2NCA0MS4wMjczQzY1Ljc2NTMgMzguNjQgNjguOTY5MSAzNy40NDYzIDczLjEzNzcgMzcuNDQ2M0M3Ny4zMDYzIDM3LjQ0NjMgODAuNDkxNSAzOC42NDYyIDgyLjY5MzQgNDEuMDQ1OUM4NC45MDc2IDQzLjQ0NTYgODYuMDE0NiA0Ni44OTY4IDg2LjAxNDYgNTEuMzk5NFpNNjYuMjE2OCA1MS4zOTk0QzY2LjIxNjggNTQuNDMgNjYuNzkyIDU2LjcxMjIgNjcuOTQyNCA1OC4yNDYxQzY5LjA5MjggNTkuNzc5OSA3MC44MTIyIDYwLjU0NjkgNzMuMTAwNiA2MC41NDY5Qzc3LjY4OTggNjAuNTQ2OSA3OS45ODQ0IDU3LjQ5NzcgNzkuOTg0NCA1MS4zOTk0Qzc5Ljk4NDQgNDUuMjg4NyA3Ny43MDIxIDQyLjIzMzQgNzMuMTM3NyA0Mi4yMzM0QzcwLjg0OTMgNDIuMjMzNCA2OS4xMjM3IDQzLjAwNjUgNjcuOTYwOSA0NC41NTI3QzY2Ljc5ODIgNDYuMDg2NiA2Ni4yMTY4IDQ4LjM2ODggNjYuMjE2OCA1MS4zOTk0WiIgZmlsbD0id2hpdGUiLz4NCjwvc3ZnPg0K">
                                                    </div>
                                                    <h5 class="v2-card__title v2-card--inline">Forex options</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="v2-col-xs-12 v2-col-sm-3 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="4" data-styles="card">
                                        <a target="" class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <div class="v2-card__icon v2-card--inline">
                                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KPHJlY3Qgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIHJ4PSIxNiIgZmlsbD0iI0ZGNjkwNSIvPg0KPHBhdGggZD0iTTI3LjU0ODggNjVWMzcuODczSDMzLjMwMDhWNjAuMjVINDQuMzAzN1Y2NUgyNy41NDg4Wk03My42NTcyIDUxLjM5OTRDNzMuNjU3MiA1NS44ODk2IDcyLjU0MzkgNTkuMzQwOCA3MC4zMTc0IDYxLjc1MjlDNjguMDkwOCA2NC4xNjUgNjQuODk5NCA2NS4zNzExIDYwLjc0MzIgNjUuMzcxMUM1Ni41ODY5IDY1LjM3MTEgNTMuMzk1NSA2NC4xNjUgNTEuMTY4OSA2MS43NTI5QzQ4Ljk0MjQgNTkuMzQwOCA0Ny44MjkxIDU1Ljg3NzMgNDcuODI5MSA1MS4zNjIzQzQ3LjgyOTEgNDYuODQ3MyA0OC45NDI0IDQzLjQwMjMgNTEuMTY4OSA0MS4wMjczQzUzLjQwNzkgMzguNjQgNTYuNjExNyAzNy40NDYzIDYwLjc4MDMgMzcuNDQ2M0M2NC45NDg5IDM3LjQ0NjMgNjguMTM0MSAzOC42NDYyIDcwLjMzNTkgNDEuMDQ1OUM3Mi41NTAxIDQzLjQ0NTYgNzMuNjU3MiA0Ni44OTY4IDczLjY1NzIgNTEuMzk5NFpNNTMuODU5NCA1MS4zOTk0QzUzLjg1OTQgNTQuNDMgNTQuNDM0NiA1Ni43MTIyIDU1LjU4NSA1OC4yNDYxQzU2LjczNTQgNTkuNzc5OSA1OC40NTQ4IDYwLjU0NjkgNjAuNzQzMiA2MC41NDY5QzY1LjMzMjQgNjAuNTQ2OSA2Ny42MjcgNTcuNDk3NyA2Ny42MjcgNTEuMzk5NEM2Ny42MjcgNDUuMjg4NyA2NS4zNDQ3IDQyLjIzMzQgNjAuNzgwMyA0Mi4yMzM0QzU4LjQ5MTkgNDIuMjMzNCA1Ni43NjYzIDQzLjAwNjUgNTUuNjAzNSA0NC41NTI3QzU0LjQ0MDggNDYuMDg2NiA1My44NTk0IDQ4LjM2ODggNTMuODU5NCA1MS4zOTk0WiIgZmlsbD0id2hpdGUiLz4NCgk8L3N2Zz4NCg==">
                                                    </div>
                                                    <h5 class="v2-card__title v2-card--inline">Listed options</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="v2">
                    <section class="v2-wrapper v2-mab50 v2-sm-max-mab0" data-behavior="" data-styles="card-container" data-instance-init="true">
                        <div class="v2-card-container" data-styles="">
                            <div>
                                <ul class="v2-row v2-row--gutter-10 v2-stick-boundary--desktop v2-stick-boundary--mobile">
                                    <li class="v2-col-xs-12 v2-col-sm-6 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="2" data-styles="card">
                                        <div class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-md-text-align--left v2-text-align--left v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <h5 class="v2-card__title v2-card--inline">Investment portfolios</h5>
                                                </div>
                                                <div class="v2-card__rte">
                                                    <div class="rte--output">
                                                        <p class="text--body">Based on the analysis from world-leading asset managers, our managed portfolios are built and rebalanced by inhouse experts to target sustainable, long-term results based on your risk level.</p>
                                                        <img alt="Investment-portfolios-logos" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDMxIiBoZWlnaHQ9IjIwIiB2aWV3Qm94PSIwIDAgNDMxIDIwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cGF0aCBkPSJNMTMuMzM1NyAxNy40NjM5VjMuOTk5OTRIMTYuNjU0N1YxNy40NjM5SDEzLjMzNTdaTTc3Ljg0OTYgMTIuNDMzNkM3Ny44NDk2IDkuMTc5ODkgNzUuMTE3NSA3LjE2MDIgNzEuOTIwMSA3LjE2MDJDNjguNzAyNiA3LjE2MDIgNjUuOTkwOSA5LjE5ODY0IDY1Ljk5MDkgMTIuNDMzNkM2NS45OTA5IDE1LjY4NzIgNjguNzIzIDE3LjcyNTcgNzEuOTIwMSAxNy43MjU3Qzc1LjExNzUgMTcuNzI1NyA3Ny44NDk2IDE1LjY2ODggNzcuODQ5NiAxMi40MzM2Wk03NC41NzEyIDEyLjQzMzZDNzQuNTcxMiAxNC4xMzUyIDczLjMzNjkgMTUuMDg5IDcxLjkgMTUuMDg5QzcwLjQ2MzIgMTUuMDg5IDY5LjIyODkgMTQuMTM1MiA2OS4yMjg5IDEyLjQzMzZDNjkuMjI4OSAxMC43MTMyIDcwLjQ2MzIgOS43OTY4OCA3MS45IDkuNzk2ODhDNzMuMzM2OSA5Ljc5Njg4IDc0LjU3MTIgMTAuNzEzMiA3NC41NzEyIDEyLjQzMzZaTTEyLjAwMDMgMTMuNTkyOUMxMi4wMDAzIDEyLjA3ODQgMTEuMTUwMyAxMC45MTkgOS42MzI0NSAxMC4zOTU1QzExLjA2OTMgOS42NjU5OCAxMS41NzUxIDguNzEyMjEgMTEuNTc1MSA3LjU5MDM5QzExLjU3NTEgNS42MjY5NCAxMC4wMzcyIDMuOTk5OTQgNi41OTcwOCA0LjAxODY5SDBWMTcuNDgyNkg2Ljg4MDM3QzEwLjM0MDggMTcuNDYzOSAxMi4wMDAzIDE1Ljg3NDQgMTIuMDAwMyAxMy41OTI5Wk04LjA1Mzk5IDcuOTgzMDdDOC4wNTM5OSA4Ljg5OTM1IDcuNDI2NzYgOS40MjI5NCA2LjIxMjYgOS40MjI5NEgzLjQ2MDQyVjYuNjE3ODdINi4yMTI2QzcuMzI1NTkgNi42MTc4NyA4LjA1Mzk5IDcuMDY2OCA4LjA1Mzk5IDcuOTgzMDdaTTguMzU3NjMgMTMuMzg3M0M4LjM1NzYzIDE0LjI2NjEgNy42ODk4NSAxNC44NDU5IDYuNDU1NDEgMTQuODQ1OUgzLjQ2MDQyVjExLjkyODdINi40NTU0MUM3LjY0OTM4IDExLjkyODcgOC4zNTc2MyAxMi40ODk4IDguMzU3NjMgMTMuMzg3M1pNNDAuODk4IDkuOTA5MDNDMzkuOTg3IDguMTUxNDcgMzguMjg3NCA3LjE3ODk1IDM1LjcxNzMgNy4xNzg5NUMzMi42ODE5IDcuMTc4OTUgMjkuOTcwMyA4LjkzNjg1IDI5Ljk3MDMgMTIuNDMzNkMyOS45NzAzIDE1LjgzNjkgMzIuMzU3OSAxNy43MjU3IDM1LjY3NjggMTcuNzI1N0MzOC4wMDM5IDE3LjcyNTcgMzkuOTY3IDE2Ljg2NTYgNDAuODk4IDE1LjAxNDNMMzguMjI2NSAxMy43NDI1QzM3Ljc0MTEgMTQuNTY1NCAzNi45OTIyIDE1LjA4OSAzNS43OTg0IDE1LjA4OUMzNC4yNjA0IDE1LjA4OSAzMy4yNjg4IDE0LjA3OTMgMzMuMjY4OCAxMi40MzM2QzMzLjI2ODggMTAuNzg4MSAzNC40MDIgOS43OTY4OCAzNS43Nzc5IDkuNzk2ODhDMzYuODUwNiA5Ljc5Njg4IDM3LjY2IDEwLjI0NTggMzguMTY1OSAxMS4yMThMNDAuODk4IDkuOTA5MDNaTTg5LjgwOTEgOS45MDkwM0M4OC44OTg1IDguMTUxNDcgODcuMTk4OSA3LjE3ODk1IDg0LjYyODggNy4xNzg5NUM4MS41OTM0IDcuMTc4OTUgNzguODgxNCA4LjkzNjg1IDc4Ljg4MTQgMTIuNDMzNkM3OC44ODE0IDE1LjgzNjkgODEuMjY5MyAxNy43MjU3IDg0LjU4ODMgMTcuNzI1N0M4Ni45MTUzIDE3LjcyNTcgODguODc4NCAxNi44NjU2IDg5LjgwOTEgMTUuMDE0M0w4Ny4xMzc5IDEzLjc0MjVDODYuNjUyNSAxNC41NjU0IDg1LjkwMzYgMTUuMDg5IDg0LjcwOTggMTUuMDg5QzgzLjE3MTUgMTUuMDg5IDgyLjE4MDMgMTQuMDc5MyA4Mi4xODAzIDEyLjQzMzZDODIuMTgwMyAxMC43ODgxIDgzLjMxMzUgOS43OTY4OCA4NC42ODk0IDkuNzk2ODhDODUuNzYyIDkuNzk2ODggODYuNTcxNSAxMC4yNDU4IDg3LjA3NzMgMTEuMjE4TDg5LjgwOTEgOS45MDkwM1pNNjEuOTg0IDE3LjQ2MzlMNTkuMjExOCAxMi45Mzg0SDU3LjA4N1YxNy40NjM5SDUzLjY2NjlWMy45OTk5NEg1OS44MzkxQzYzLjE3ODIgMy45OTk5NCA2NS41MDUyIDUuNDc3MjkgNjUuNTA1MiA4LjM3NTc3QzY1LjUwNTIgMTAuMjI3MSA2NC41MTM2IDExLjUzNiA2Mi43NTMgMTIuMzQwMkw2NS45NTA0IDE3LjQ2MzlINjEuOTg0Wk01Ny4xMDcgMTAuMjY0Nkg1OS42NTdDNjEuMjM1NSAxMC4yNjQ2IDYyLjAwNDUgOS40NDE2OSA2Mi4wMDQ1IDguNDY5MTdDNjIuMDA0NSA3LjMwOTg1IDYxLjI3NiA2LjY3NDExIDU5LjY1NyA2LjY3NDExSDU3LjEwN1YxMC4yNjQ2Wk0yOS40MjM2IDE3LjI5NTVWMTUuMTgyNEMyOS4yODIgMTUuMjE5OSAyOS4wNzk4IDE1LjI1NzQgMjguODU3MiAxNS4yNTc0QzI4LjQzMjMgMTUuMjU3NCAyOC4yMDk3IDE1LjA1MTUgMjguMjA5NyAxNC42OTYzVjExLjE5OTJDMjguMjA5NyA4LjU4MTMyIDI2LjMwNzIgNy4xOTc3IDIzLjE3MDcgNy4xOTc3QzIxLjEyNjkgNy4xOTc3IDE5LjM4NjQgNy44ODk2OCAxOC4yOTM3IDguNzg3MkwyMC4xMzUzIDEwLjY5NDRDMjAuODYzOCAxMC4wOTYyIDIxLjgzNDkgOS43MjIyMyAyMi43ODY0IDkuNzIyMjNDMjQuMjQzMyA5LjcyMjIzIDI0LjkzMTMgMTAuMzk1NSAyNC45MzEzIDExLjQ5ODVWMTEuODE2NkMyNC4yNDMzIDExLjY2NjkgMjMuMzcyOSAxMS41MTczIDIyLjMyMDcgMTEuNTE3M0MxOS42NyAxMS41MTczIDE3Ljk0OTYgMTIuNjk1NCAxNy45NDk2IDE0LjY0MDFDMTcuOTQ5NiAxNi42NDEgMTkuMzg2NCAxNy42ODgyIDIxLjYxMjcgMTcuNjg4MkMyMy4xMzAyIDE3LjY4ODIgMjQuNDg2IDE3LjEwODcgMjUuMTk0NCAxNi4zNjA1QzI1LjYxOTIgMTcuMzUxNyAyNi41NTAyIDE3LjYxMzUgMjcuNDYwOCAxNy42MTM1QzI4LjA4ODIgMTcuNjMyMyAyOC44MTY3IDE3LjUzODUgMjkuNDIzNiAxNy4yOTU1Wk0yNC45NTE0IDE0LjEzNTJDMjQuOTUxNCAxNS4wNTE1IDI0LjAwMDMgMTUuNjUwMSAyMi45MDc2IDE1LjY1MDFDMjEuODc1NSAxNS42NTAxIDIxLjM2OTYgMTUuMTYzNiAyMS4zNjk2IDE0LjQ5MDdDMjEuMzY5NiAxMy43OCAyMS45MzY0IDEzLjI1NjQgMjMuMDg5NyAxMy4yNTY0QzIzLjc5ODEgMTMuMjU2NCAyNC40MjU0IDEzLjM2ODYgMjQuOTUxNCAxMy40ODA3VjE0LjEzNTJaTTEwMS42NjggMTcuNDYzOUw5Ny43NjIzIDExLjE5OTJMMTAxLjQyNSA3LjUxNTRIOTcuNzQxOUw5My44NzY2IDExLjQ3OThWNC4wMTg2OUg5MC41NzgxVjE3LjQ4MjZIOTMuODc2NlYxNS4wNTE1TDk1LjQ1NSAxMy40OTk1TDk3LjkyNCAxNy40ODI2SDEwMS42NjhWMTcuNDYzOVpNNTIuNzk2OCAxNy40NjM5TDQ4Ljg5MSAxMS4xOTkyTDUyLjU1NDEgNy41MTU0SDQ4LjgzMDRMNDUuMDA1NiAxMS40Nzk4VjQuMDE4NjlINDEuNzA3MVYxNy40ODI2SDQ1LjAwNTZWMTUuMDUxNUw0Ni41ODQxIDEzLjQ5OTVMNDkuMDUzMSAxNy40ODI2SDUyLjc5NjhWMTcuNDYzOVpNMTAzLjY5MSAxNS41OTM4QzEwNC4zNzkgMTUuNTkzOCAxMDQuNzg0IDE1Ljk4NjUgMTA0Ljc4NCAxNi41ODUxQzEwNC43ODQgMTcuMTgzMyAxMDQuMzc5IDE3LjU3NiAxMDMuNjkxIDE3LjU3NkMxMDMuMDA0IDE3LjU3NiAxMDIuNTk5IDE3LjE4MzMgMTAyLjU5OSAxNi41ODUxQzEwMi41OTkgMTUuOTg2NSAxMDMuMDA0IDE1LjU5MzggMTAzLjY5MSAxNS41OTM4Wk0xMDMuNjkxIDE3LjQ0NTFDMTA0LjIzOCAxNy40NDUxIDEwNC42MDIgMTcuMTQ1OCAxMDQuNjAyIDE2LjU4NTFDMTA0LjYwMiAxNi4wMjQgMTA0LjIxNyAxNS43MjQ3IDEwMy42OTEgMTUuNzI0N0MxMDMuMTQ1IDE1LjcyNDcgMTAyLjc4MSAxNi4wMjQgMTAyLjc4MSAxNi41ODUxQzEwMi43NiAxNy4xNjQ2IDEwMy4xNDUgMTcuNDQ1MSAxMDMuNjkxIDE3LjQ0NTFaTTEwMy4yNjYgMTYuMDc5OUgxMDMuNzEyQzEwMy45NzUgMTYuMDc5OSAxMDQuMTE2IDE2LjIxMDggMTA0LjExNiAxNi4zOTc5QzEwNC4xMTYgMTYuNTY2MyAxMDQuMDM1IDE2LjY1OTcgMTAzLjg5NCAxNi43MTZMMTA0LjA5NiAxNy4wNzEySDEwMy44OTRMMTAzLjcxMiAxNi43NTMxSDEwMy40NjlWMTcuMDcxMkgxMDMuMjY2VjE2LjA3OTlaTTEwMy40NjkgMTYuMjI5NlYxNi41ODUxSDEwMy42OTFDMTAzLjgzMyAxNi41ODUxIDEwMy45MTQgMTYuNTQ3NiAxMDMuOTE0IDE2LjQxNjdDMTAzLjkxNCAxNi4zMDQ1IDEwMy44NTMgMTYuMjQ4MyAxMDMuNzEyIDE2LjI0ODNIMTAzLjQ2OVYxNi4yMjk2WiIgZmlsbD0iYmxhY2siLz4KPHBhdGggZD0iTTE2Ny43MzMgMS40NzI0NkgxNjYuMjE2VjE4LjQwMzZIMTY3LjczM1YxLjQ3MjQ2WiIgZmlsbD0iI0ZGMDAwMCIvPgo8cGF0aCBkPSJNMTg3LjA4OCAxLjQ3MjQ2SDE5MS45MjdWMi44ODIzN0gxOTAuMjg0VjE4LjQwMzZIMTg4Ljc1OFYyLjg4MjM3SDE4Ny4wODhWMS40NzI0NloiIGZpbGw9IiNGRjAwMDAiLz4KPHBhdGggZD0iTTE2NC44MzUgMS40NzI0NlYxOC40MDM2SDE2My4yNDdMMTYwLjk3NSA4LjExOTIxVjE4LjQwMzZIMTU5LjQ4NVYxLjQ3MjQ2SDE2MC44NTZMMTYzLjM0NSAxMi42ODY2VjEuNDcyNDZIMTY0LjgzNVoiIGZpbGw9IiNGRjAwMDAiLz4KPHBhdGggZD0iTTEzMS44ODEgMS40NzI0NlYxOC40MDM2SDEzMC4zOVYzLjg5MDY4TDEyOC41NTEgMTguNDAzNkgxMjcuMzExTDEyNS41IDMuODkwNjhWMTguNDAzNkgxMjRWMS40NzI0NkgxMjYuNTM4TDEyNy45OTIgMTEuNjc4TDEyOS4zNjIgMS40NzI0NkgxMzEuODgxWiIgZmlsbD0iI0ZGMDAwMCIvPgo8cGF0aCBkPSJNMTUwLjMzNCAxOC4zOTZDMTUxLjUxMyAxNi43NzI2IDE1Mi4yMSAxNC43NjU5IDE1Mi4yMSAxMi41OTM5QzE1Mi4yMSA3LjE4NDcyIDE0Ny44OTIgMi44MDA4NyAxNDIuNTY3IDIuODAwODdDMTM3LjI0MSAyLjgwMDg3IDEzMi45MjQgNy4xODU2NCAxMzIuOTI0IDEyLjU5MzlDMTMyLjkyNCAxNC43NjUzIDEzMy42MiAxNi43NzI2IDEzNC43OTcgMTguMzk2SDEzNi44MDNDMTM1LjM0NyAxNi45MDU3IDEzNC40NDggMTQuODU3OCAxMzQuNDQ4IDEyLjU5MzlDMTM0LjQ0OCA4LjAzOTQgMTM4LjA4NCA0LjM0Njk2IDE0Mi41NjggNC4zNDY5NkMxNDcuMDUyIDQuMzQ2OTYgMTUwLjY4OSA4LjA0MDMyIDE1MC42ODkgMTIuNTkzOUMxNTAuNjg5IDE0Ljg1NjIgMTQ5Ljc5IDE2LjkwNjYgMTQ4LjMzNyAxOC4zOTZIMTUwLjMzNFoiIGZpbGw9IiNGRjAwMDAiLz4KPHBhdGggZD0iTTE5Ny40MTYgMTguNDAzNkgxOTUuOTMzTDE5NS41NDEgMTQuNTg4OUgxOTMuMzIyTDE5Mi45NiAxOC40MDM2SDE5MS40NDdMMTkzLjE1OCAxLjQ3MjQ2SDE5NS40N0wxOTcuNDE2IDE4LjQwMzZaTTE5NS40MDMgMTMuMDYwNUwxOTQuMzk0IDMuNzI0MTdMMTkzLjQ2MyAxMy4wNjA1SDE5NS40MDNaIiBmaWxsPSIjRkYwMDAwIi8+CjxwYXRoIGQ9Ik0xNzkuMzA2IDE2LjI3NUMxNzkuMzA2IDE3LjAzNjMgMTc4Ljg2NCAxNy40MjYxIDE3OC4zNTkgMTcuNDI2MUMxNzcuODU0IDE3LjQyNjEgMTc3LjQxMiAxNy4wMzYzIDE3Ny40MTIgMTYuMjc1VjMuNDk3MDlDMTc3LjQxMiAyLjczNDc5IDE3Ny44NTQgMi4zNDQ1IDE3OC4zNTkgMi4zNDQ1QzE3OC44NjQgMi4zNDQ1IDE3OS4zMDYgMi43MzUxOSAxNzkuMzA2IDMuNDk3MDlMMTc5LjMwMyA0LjEwODAyVjcuMjk3MjNIMTgwLjgyNlY0LjgzODg5TDE4MC44MjIgNC4xMjgzQzE4MC44MTIgMi4wMjAzIDE3OS45OTkgMS4wMTU0MyAxNzguMzA1IDEuMDE1NDNDMTc2Ljc5NiAxLjAxNTQzIDE3NS44MTQgMi4xMDI4MiAxNzUuODE0IDMuNzcwMzlMMTc1LjgxNiA0LjM5MTg5VjE0Ljk4MDdMMTc1LjgxNCAxNS42NjY0QzE3NS44MTQgMTcuODM0NCAxNzYuNjQyIDE4Ljg5MTYgMTc4LjM0MSAxOC44OTE2QzE4MC4wMzYgMTguODkxNiAxODAuODI2IDE3Ljg1MjYgMTgwLjgyNiAxNS42MjA5VjkuNDY3MUgxNzguMDI3VjEwLjk0ODVIMTc5LjMwM1YxNS43MTRMMTc5LjMwNiAxNi4yNzVaIiBmaWxsPSIjRkYwMDAwIi8+CjxwYXRoIGQ9Ik0xODUuNTUyIDE1Ljg3MDRWMTEuNDY5NkwxODIuMDc5IDguODM3MDNWMy45MjA2NEMxODIuMDc5IDEuOTg4MjggMTgyLjkzNyAwLjk5OTkzOSAxODQuNjEzIDAuOTk5OTM5QzE4Ni4zMTYgMC45OTk5MzkgMTg3LjA4OSAxLjk4MTUgMTg3LjEwMyA0LjE1MjlMMTg3LjEwNSA0LjgyNzU1VjcuMzIxNTNIMTg1LjU1M1YzLjk3NTk0TDE4NS41NDkgMy40OTY0MUMxODUuNTQ5IDIuNzMzNjUgMTg1LjExMSAyLjM0MzgzIDE4NC42MTEgMi4zNDM4M0MxODQuMTEyIDIuMzQzODMgMTgzLjY3NCAyLjczNDUxIDE4My42NzQgMy40OTY0MVYzLjk5MTNWOC4xMDI0N0wxODcuMTA0IDEwLjczMzVWMTUuODIwNEMxODcuMTA0IDE3LjgxMDggMTg2LjIzMyAxOC44NzYyIDE4NC42MDIgMTguODc2MkMxODIuOTUzIDE4Ljg3NjIgMTgyLjA5MyAxNy44NzA3IDE4Mi4wODMgMTUuOTMwNkwxODIuMDc4IDE1LjI2MDZWMTEuOTQ5N0gxODMuNjcxVjE1LjgyOFYxNi4yNzZDMTgzLjY3MSAxNy4wMzY5IDE4NC4xMSAxNy40Mjc0IDE4NC42MDkgMTcuNDI3NEMxODUuMTEgMTcuNDI3NCAxODUuNTQ3IDE3LjAzNjkgMTg1LjU0NyAxNi4yNzZMMTg1LjU1MiAxNS44NzA0WiIgZmlsbD0iI0ZGMDAwMCIvPgo8cGF0aCBkPSJNMTU4LjU2OSAxOC40MDI3SDE1Ny4wNDhDMTU2Ljg0MSAxNy44MzI4IDE1Ni43NSAxNy4yOTY3IDE1Ni43MzkgMTYuNTgxMkwxNTYuNzI4IDE1LjcxNDhMMTU2LjcyMSAxNS4yNzY3VjExLjk3MDVDMTU2LjcyMSAxMS4yNzc3IDE1Ni4zMDYgMTAuOTYxOSAxNTUuODI1IDEwLjk2MTlIMTU0Ljc0M1YxOC40MDM2SDE1My4yNTVWMS40NzI0NkgxNTUuMTk2QzE1Ny4zNzcgMS40NzI0NiAxNTguMjE4IDIuMjgyMTYgMTU4LjIxOCA0LjQ0Nzk3VjcuNjI2MTNDMTU4LjIxOCA5LjA1MTYxIDE1Ny45ODMgOS42NDc5MiAxNTYuODg0IDEwLjA1OTZDMTU2LjkgMTAuMDY1NCAxNTYuOTE1IDEwLjA3IDE1Ni45MjkgMTAuMDc1OUMxNTcuOTY3IDEwLjM4MTkgMTU4LjE5OSAxMC43ODE5IDE1OC4yMTIgMTIuMTE4NUwxNTguMjE3IDEyLjczMTFWMTUuODIzM0MxNTguMjE4IDE2Ljk0OTggMTU4LjMgMTcuNTYwMyAxNTguNTY5IDE4LjQwMjdaTTE1NC43NDMgMi44MDQ0OVY5LjUwOTY3SDE1NS4yNzhDMTU2LjI2IDkuNTA5NjcgMTU2LjcyMiA5LjA1MTYxIDE1Ni43MjIgOC4wNzk4OFY0LjYyOTU0QzE1Ni43MjIgMy4yMzg3NyAxNTYuNDA0IDIuODA0MDYgMTU1LjM5MSAyLjgwNDA2TDE1NC43NDMgMi44MDQ0OVpNMjAzLjEyMSAxOC40MDI3SDIwMS42QzIwMS4zOTMgMTcuODMyOCAyMDEuMzAyIDE3LjI5NjcgMjAxLjI5MyAxNi41ODEyTDIwMS4yOCAxNS43MTQ4TDIwMS4yNzUgMTUuMjc2N1YxMS45NzA1QzIwMS4yNzUgMTEuMjc3NyAyMDAuODU5IDEwLjk2MTkgMjAwLjM3OSAxMC45NjE5SDE5OS4yOTZWMTguNDAzNkgxOTcuODA3VjEuNDcyNDZIMTk5Ljc0OUMyMDEuOTMgMS40NzI0NiAyMDIuNzY5IDIuMjgyMTYgMjAyLjc2OSA0LjQ0Nzk3VjcuNjI2MTNDMjAyLjc2OSA5LjA1MTYxIDIwMi41MzUgOS42NDc5MiAyMDEuNDM3IDEwLjA1OTZDMjAxLjQ1MyAxMC4wNjU0IDIwMS40NjggMTAuMDcgMjAxLjQ4MyAxMC4wNzU5QzIwMi41MiAxMC4zODE5IDIwMi43NTMgMTAuNzgxOSAyMDIuNzY0IDEyLjExODVMMjAyLjc2OSAxMi43MzExVjE1LjgyMzNDMjAyLjc3IDE2Ljk0OTggMjAyLjg1MiAxNy41NjAzIDIwMy4xMjEgMTguNDAyN1pNMTk5LjI5NiAyLjgwNDQ5VjkuNTA5NjdIMTk5LjgzQzIwMC44MTMgOS41MDk2NyAyMDEuMjc1IDkuMDUxNjEgMjAxLjI3NSA4LjA3OTg4VjQuNjI5NTRDMjAxLjI3NSAzLjIzODc3IDIwMC45NTggMi44MDQwNiAxOTkuOTQzIDIuODA0MDZMMTk5LjI5NiAyLjgwNDQ5WiIgZmlsbD0iI0ZGMDAwMCIvPgo8cGF0aCBkPSJNMTc0LjQ0NSAxLjQ3MjQ2VjE4LjQwMzZIMTcyLjg1N0wxNzAuNTg0IDguMTE5MjFWMTguNDAzNkgxNjkuMDk1VjEuNDcyNDZIMTcwLjQ2NEwxNzIuOTU0IDEyLjY4NjZWMS40NzI0NkgxNzQuNDQ1WiIgZmlsbD0iI0ZGMDAwMCIvPgo8cGF0aCBkPSJNMjAzLjY3MiAyLjkyNDQzQzIwMy42NzIgMy43NjQ1NCAyMDQuMzQ0IDQuNDQ3NzkgMjA1LjE3MSA0LjQ0Nzc5QzIwNS45OTkgNC40NDc3OSAyMDYuNjcyIDMuNzY1MTYgMjA2LjY3MiAyLjkyNDQzQzIwNi42NzIgMi4wODM3OSAyMDUuOTk5IDEuNDAwNjMgMjA1LjE3MSAxLjQwMDYzQzIwNC4zNDQgMS40MDA2MyAyMDMuNjcyIDIuMDgzNzkgMjAzLjY3MiAyLjkyNDQzWk0yMDMuODI1IDIuOTI0NDNDMjAzLjgyNSAyLjE3MDU1IDIwNC40MyAxLjU1NjgyIDIwNS4xNzEgMS41NTY4MkMyMDUuOTE1IDEuNTU2ODIgMjA2LjUxOSAyLjE3MDk4IDIwNi41MTkgMi45MjQ0M0MyMDYuNTE5IDMuNjc4NzEgMjA1LjkxNSA0LjI5MTcyIDIwNS4xNzEgNC4yOTE3MkMyMDQuNDMgNC4yOTA4IDIwMy44MjUgMy42NzgyOCAyMDMuODI1IDIuOTI0NDNaTTIwNC42NDggMi4xODA3MkgyMDUuMzE3QzIwNS41NSAyLjE4MDcyIDIwNS43OTMgMi4yNzE3MSAyMDUuNzkzIDIuNjEzMzFDMjA1Ljc5MyAyLjgwNTkgMjA1LjcwNyAyLjk5MDg4IDIwNS40NSAzLjAzNDA0TDIwNS44NTcgMy42ODQySDIwNS42MkwyMDUuMjIxIDMuMDQ2MzNIMjA0Ljg0M1YzLjY4NDJIMjA0LjY0OFYyLjE4MDcySDIwNC42NDhaTTIwNC44NDMgMi44NzMxOEgyMDUuMjg2QzIwNS40NjggMi44NzMxOCAyMDUuNTk5IDIuODEzNTIgMjA1LjU5OSAyLjYxMzMxQzIwNS41OTkgMi40MTQ3OSAyMDUuNDY5IDIuMzUzODMgMjA1LjI4NiAyLjM1MzgzSDIwNC44NDNWMi44NzMxOFoiIGZpbGw9IiNGRjAwMDAiLz4KPHBhdGggZD0iTTI4Ny42NzcgMTQuOTM2NEMyODQuNzg1IDE0LjkzNjQgMjgyLjk4OCAxMy41NjE3IDI4Mi45ODggMTEuMzQ1OEMyODIuOTg4IDkuMDQ2MTIgMjg0LjY0NiA3LjYxNTM2IDI4Ny4zMTcgNy42MTUzNkgyODcuNTQxQzI4Ny44NzYgNy42MTUzNiAyODguMzM3IDcuNjI0MzMgMjg4Ljk2NyA3LjY4ODg4VjQuOTEzMDJIMjkwLjg1M1YxNC42ODYyQzI5MC44NTMgMTQuNjg2MiAyODkuMDYxIDE0LjkzNjQgMjg3LjY3NyAxNC45MzY0Wk0yODcuNjYgOC44MzQwMkMyODUuODMzIDguODM0MDIgMjg0Ljk0NCA5LjY0MzMzIDI4NC45NDQgMTEuMzA3M0MyODQuOTQ0IDEyLjgwMTIgMjg2LjAxNyAxMy43Mjk4IDI4Ny43MzkgMTMuNzI5OEMyODguMDcgMTMuNzI5OCAyODguNDQ5IDEzLjcxMTkgMjg4Ljk2NiAxMy42NzU1VjguOTMzNTZDMjg4LjQ1IDguODY1NDEgMjg4LjAzNCA4LjgzNDAyIDI4Ny42NiA4LjgzNDAyWk0yNjEuODM4IDE0LjcxMjJMMjU2Ljc0MyA3LjQxNTg0TDI1Ni43NDEgMTQuNzEyMkgyNTQuOTY1VjUuNDc1MjhIMjU3LjQ1MUwyNjIuNTQ3IDEyLjcwNjZMMjYyLjU0NSA1LjQ3NTI4SDI2NC4zNDRWMTQuNzEyMkgyNjEuODM4Wk0yNzguMDY5IDE0Ljg1NDNDMjc3LjIxMiAxNC44NTQzIDI3Ni4zMTcgMTQuNzc1NCAyNzUuMjUyIDE0LjYwNzNMMjc1LjEzNyAxNC41ODkzVjEzLjI5ODlMMjc1LjMwNSAxMy4zMjg1QzI3Ni4yNDQgMTMuNDkzMSAyNzcuMDU1IDEzLjYzMzQgMjc3Ljg2NyAxMy42MzM0QzI3OC41MjIgMTMuNjMzNCAyODAuMDQ4IDEzLjU0OTEgMjgwLjA0OCAxMi43NTc3QzI4MC4wNDggMTIuMDk0MiAyNzguOTk0IDExLjkyNzQgMjc4LjE0NyAxMS43OTQyTDI3OC4wOTMgMTEuNzg1MkMyNzcuOTM1IDExLjc2MSAyNzcuNzg1IDExLjczNjQgMjc3LjY2IDExLjcxMDNDMjc2LjQxNyAxMS40NDU4IDI3NS4wOTEgMTEuMDQ4MSAyNzUuMDkxIDkuNjgxOUMyNzUuMDkxIDguMzQ5MzQgMjc2LjM3NyA3LjU4NTc3IDI3OC42MTggNy41ODU3N0MyNzkuNjk0IDcuNTg1NzcgMjgwLjQ3NSA3LjY3OTkxIDI4MS4xMDMgNy43NTcwNEwyODEuNDA4IDcuNzkzODFWOS4wNDYxMkwyODEuMjQ1IDkuMDIxODlDMjgwLjUzNSA4LjkxNDczIDI3OS43MDIgOC44MDQ0MyAyNzguOTAyIDguODA0NDNDMjc4LjAxMiA4LjgwNDQzIDI3Ni45NTUgOC45NDExOSAyNzYuOTU1IDkuNTkwODhDMjc2Ljk1NSAxMC4xMzAzIDI3Ny44MiAxMC4yODQ1IDI3OC44MjEgMTAuNDYzNEMyODAuMjIxIDEwLjcxMTggMjgxLjk1NiAxMS4wMjM5IDI4MS45NTYgMTIuNTkxNEMyODEuOTU2IDE0LjAyOTMgMjgwLjU0MSAxNC44NTQzIDI3OC4wNjkgMTQuODU0M1pNMjk2LjE0OSAxNC44NTQzQzI5NC4xOTYgMTQuODU0MyAyOTIuMzg4IDE0LjU3MTggMjkyLjM4OCAxMi41MjY0QzI5Mi4zODggMTAuMzAwMiAyOTUuMTg0IDEwLjMwMDIgMjk2Ljg1NiAxMC4zMDAyQzI5Ny4wMjIgMTAuMzAwMiAyOTcuODA4IDEwLjMzMDMgMjk4LjA0OSAxMC4zMzg4QzI5OC4wNDcgOS4wOTAwNSAyOTguMDI4IDguNzkyMzMgMjk1LjgyMSA4Ljc5MjMzQzI5NC45NDYgOC43OTIzMyAyOTMuOTc0IDguOTM0MDEgMjkzLjExNiA5LjA2MDQ1TDI5Mi45NTIgOS4wODQ2OFY3Ljg1MTY2TDI5My4wNjMgNy44MzIzOEMyOTQuMDU3IDcuNjY2NDcgMjk1LjAxNiA3LjU4NTc3IDI5NS45OTQgNy41ODU3N0MyOTguMTMzIDcuNTg1NzcgMjk5Ljk0NSA3Ljc2MjQzIDI5OS45NDUgOS45Mzk3MVYxNC42ODhMMjk5LjgxNSAxNC43MDAxQzI5OC4zMzMgMTQuODM2NCAyOTcuMTU3IDE0Ljg1NDMgMjk2LjE1IDE0Ljg1NDNIMjk2LjE0OVpNMjk2LjgwOSAxMS40MDE5QzI5NS4xOTcgMTEuNDAxOSAyOTQuMTk4IDExLjU5NjQgMjk0LjE5OCAxMi41NjQ5QzI5NC4xOTggMTMuNjg1OSAyOTUuNDczIDEzLjc3ODcgMjk2LjY2OCAxMy43Nzg3QzI5Ny4xMTQgMTMuNzc4NyAyOTcuOTE3IDEzLjczMTYgMjk4LjE2MiAxMy43MTcyVjExLjQ0MDRDMjk3LjgxNyAxMS40MjgzIDI5Ni45MTggMTEuNDAxOSAyOTYuODA5IDExLjQwMTlaTTI2OS42OCAxNC44NTQzQzI2Ny43MjUgMTQuODU0MyAyNjUuOTE4IDE0LjU3MTggMjY1LjkxOCAxMi41MjY0QzI2NS45MTggMTAuMzAwMiAyNjguNzE0IDEwLjMwMDIgMjcwLjM4NSAxMC4zMDAyQzI3MC41NTEgMTAuMzAwMiAyNzEuMzM5IDEwLjMzMDMgMjcxLjU4IDEwLjMzODhDMjcxLjU3OCA5LjA5MDA1IDI3MS41NTcgOC43OTIzMyAyNjkuMzUgOC43OTIzM0MyNjguNDc0IDguNzkyMzMgMjY3LjUwMyA4LjkzNDAxIDI2Ni42NDUgOS4wNjA0NUwyNjYuNDgxIDkuMDg0NjhWNy44NTE2NkwyNjYuNTk0IDcuODMyMzhDMjY3LjU1OCA3LjY2ODg5IDI2OC41MzkgNy41ODYyNCAyNjkuNTIzIDcuNTg1NzdDMjcxLjY2MSA3LjU4NTc3IDI3My40NzQgNy43NjI0MyAyNzMuNDc0IDkuOTM5NzFWMTQuNjg4TDI3My4zNDMgMTQuNzAwMUMyNzEuODYyIDE0LjgzNjQgMjcwLjY4NiAxNC44NTQzIDI2OS42OCAxNC44NTQzWk0yNzAuMzM4IDExLjQwMTlDMjY4LjcyNiAxMS40MDE5IDI2Ny43MjkgMTEuNTk2NCAyNjcuNzI5IDEyLjU2NDlDMjY3LjcyOSAxMy42ODU5IDI2OS4wMDIgMTMuNzc4NyAyNzAuMTk3IDEzLjc3ODdDMjcwLjY0NiAxMy43Nzg3IDI3MS40NDggMTMuNzMxNiAyNzEuNjk0IDEzLjcxNzJWMTEuNDQwNEMyNzEuMzQ2IDExLjQyODMgMjcwLjQ0NyAxMS40MDE5IDI3MC4zMzggMTEuNDAxOSIgZmlsbD0iIzMxMzEzMSIvPgo8bWFzayBpZD0ibWFzazAiIG1hc2stdHlwZT0iYWxwaGEiIG1hc2tVbml0cz0idXNlclNwYWNlT25Vc2UiIHg9IjMwMSIgeT0iNyIgd2lkdGg9IjkiIGhlaWdodD0iMTEiPgo8cGF0aCBkPSJNMzAxLjE3NiA3LjE2NjkzSDMwOS4zODhWMTcuOTI3OUgzMDEuMTc2VjcuMTY2OTNaIiBmaWxsPSJ3aGl0ZSIvPgo8L21hc2s+CjxnIG1hc2s9InVybCgjbWFzazApIj4KPHBhdGggZD0iTTMwNy40NTYgMTcuODUxM1YxNC44MjEyQzMwNi43MiAxNC45MDU1IDMwNi4zMjkgMTQuOTA1NSAzMDYuMDEzIDE0LjkwNTVDMzA1LjI2NiAxNC45MDU1IDMwNC40MzYgMTQuNzcyMyAzMDMuNzkzIDE0LjU0OTlDMzAyLjM1NCAxNC4wNTg5IDMwMS40OTYgMTIuODEyNSAzMDEuNDk2IDExLjIxMzFDMzAxLjQ5NiAxMC40MTUgMzAxLjczMyA4Ljk1NTU2IDMwMy4zMTkgOC4xNjkxMUMzMDQuMTE2IDcuNzc5MDQgMzA1LjA1NSA3LjYxMjI0IDMwNi40NjggNy42MTIyNEMzMDYuOTczIDcuNjEyMjQgMzA3LjY1NiA3LjY0MzYyIDMwOC4zMTYgNy42NzUwMUwzMDkuMzg4IDcuNzIwNzVWMTcuMTQ5MUwzMDcuNDU2IDE3Ljg1MTNaTTMwNi4zMjcgOC44MzEzNUMzMDQuNDEgOC44MzA5MSAzMDMuNDM5IDkuNjMzNTEgMzAzLjQzOSAxMS4yMTMxQzMwMy40MzkgMTMuMjQ2OSAzMDQuODg4IDEzLjY3NDIgMzA2LjEwNiAxMy42NzQyQzMwNi40MDMgMTMuNjc0MiAzMDYuNzM2IDEzLjY3NDIgMzA3LjQ3NCAxMy41OTcxVjguODc1MzFDMzA2Ljg5NyA4Ljg0MzkzIDMwNi42MjkgOC44MzEzNSAzMDYuMzI2IDguODMxMzVIMzA2LjMyN1oiIGZpbGw9IiMzMTMxMzEiLz4KPC9nPgo8bWFzayBpZD0ibWFzazEiIG1hc2stdHlwZT0iYWxwaGEiIG1hc2tVbml0cz0idXNlclNwYWNlT25Vc2UiIHg9IjIzOCIgeT0iMCIgd2lkdGg9IjE2IiBoZWlnaHQ9IjE1Ij4KPHBhdGggZD0iTTIzOC44ODEgLTYuMTAzNTJlLTA1SDI1My42MzVWMTQuNzg5SDIzOC44ODFWLTYuMTAzNTJlLTA1WiIgZmlsbD0id2hpdGUiLz4KPC9tYXNrPgo8ZyBtYXNrPSJ1cmwoI21hc2sxKSI+CjxwYXRoIGQ9Ik0yNDYuNTM4IC02LjEwMzUyZS0wNUwyNDAuMjk4IDE0LjA2NTRDMjQwLjIyMSAxNC4yMzg2IDI0MC4wODYgMTQuMzkwNCAyMzkuOTA5IDE0LjUwMzZDMjM5LjczMSAxNC42MTY3IDIzOS41MTkgMTQuNjg2NiAyMzkuMjk1IDE0LjcwNTJWMTQuNzExOUgyNDUuODkxQzI0Ni40MDcgMTQuNzExOSAyNDYuODQ5IDE0LjQ0MjUgMjQ3LjAxNCAxNC4wNjU4TDI1My4yNTUgLTYuMTAzNTJlLTA1SDI0Ni41MzhaIiBmaWxsPSIjMDk5NkM3Ii8+CjxwYXRoIGQ9Ik0yMzguNzU2IDE0LjQ5ODdDMjM5LjEzOSAxNC40OTg3IDIzOS40NzQgMTQuMzQyNyAyMzkuNjc5IDE0LjEwNjRDMjM5LjcgMTQuMDgxNyAyMzkuNzc1IDEzLjk5NTcgMjM5LjgyOCAxMy44Nzg2TDI0Mi4xMTcgOC43MTY5OUwyNDAuNzc4IDUuNzAyNThDMjQwLjcgNS41NDk5MyAyNDAuNTczIDUuNDE3MTcgMjQwLjQxMiA1LjMxODA2QzI0MC4yNSA1LjIxODk0IDI0MC4wNTkgNS4xNTcwNyAyMzkuODU5IDUuMTM4ODdDMjM5LjY1OCA1LjEyMDY3IDIzOS40NTYgNS4xNDY3OSAyMzkuMjcyIDUuMjE0NTJDMjM5LjA4OCA1LjI4MjI2IDIzOC45MjkgNS4zODkxNiAyMzguODEyIDUuNTI0MTNDMjM4Ljc5IDUuNTQ4NzcgMjM4LjcwMSA1LjY1ODYyIDIzOC42NjMgNS43NTE5TDIzNi4zNzQgMTAuOTExOEwyMzcuNzE5IDEzLjkzODNDMjM3LjgwNyAxNC4xMDQ2IDIzNy45NTEgMTQuMjQ2NCAyMzguMTM2IDE0LjM0NkMyMzguMzIgMTQuNDQ1NiAyMzguNTM2IDE0LjQ5ODcgMjM4Ljc1NiAxNC40OTg3WiIgZmlsbD0iIzA5OTZDNyIvPgo8L2c+CjxtYXNrIGlkPSJtYXNrMiIgbWFzay10eXBlPSJhbHBoYSIgbWFza1VuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeD0iMjI0IiB5PSI0IiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiPgo8cGF0aCBkPSJNMjI0LjY3MiA0LjQ3NjVIMjM5LjQyN1YxOS42MzAxSDIyNC42NzJWNC40NzY1WiIgZmlsbD0id2hpdGUiLz4KPC9tYXNrPgo8ZyBtYXNrPSJ1cmwoI21hc2syKSI+CjxwYXRoIGQ9Ik0yMzkuMjQ1IDQuOTE3NDJIMjMyLjU3N0MyMzIuMDYgNC45MTc0MiAyMzEuNjE4IDUuMTg1NTQgMjMxLjQ1MiA1LjU2Mzk4TDIyNS4yMTIgMTkuNjI5NEgyMzEuOTNMMjM4LjE3IDUuNTY0NDNDMjM4LjI1MSA1LjM4MTQzIDIzOC4zOTYgNS4yMjIzNyAyMzguNTg4IDUuMTA3NDdDMjM4Ljc3OSA0Ljk5MjU1IDIzOS4wMDggNC45MjcwMiAyMzkuMjQ1IDQuOTE5MjFWNC45MTc0MloiIGZpbGw9IiMwOTk2QzciLz4KPC9nPgo8cGF0aCBkPSJNMzQyLjA2MiAxMy44ODgxQzMzNy43MDggMTMuODg4MSAzMzMuMzYyIDEzLjg4ODEgMzI5IDEzLjg4ODFDMzI5IDkuNTk1OTYgMzI5IDUuMzEyMDEgMzI5IDEuMDE2MDRDMzMzLjM1NCAxLjAxNjA0IDMzNy43IDEuMDE2MDQgMzQyLjA2MiAxLjAxNjA0QzM0Mi4wNjIgNS4yOTYxNyAzNDIuMDYyIDkuNTgwNDIgMzQyLjA2MiAxMy44ODgxWk0zMjkuOTk0IDEyLjg4OTZDMzMxLjY3IDEyLjg2OTkgMzMzLjMxNCAxMi44NTgyIDMzNC45NTUgMTIuODMwNkMzMzUuNzY1IDEyLjgxNTEgMzM2LjU2MyAxMi42ODU0IDMzNy4zMjUgMTIuMzk0NEMzMzguMzYzIDExLjk5NzUgMzM5LjIyNSAxMS4zODA0IDMzOS42ODggMTAuMzM5QzM0MC4wMDMgOS42Mjc2NSAzNDAuMDcxIDguODk2MzQgMzM5LjY4NCA4LjE4OTFDMzM5LjM4OCA3LjY1MDUzIDMzOC44OSA3LjM0Mzk4IDMzOC4zMjMgNy4xMzk1M0MzMzguMTIzIDcuMDY4ODMgMzM3LjkyIDcuMDE3NzkgMzM3LjY2NCA2LjkzOTE4QzMzNy43MzYgNi45MTU0MiAzMzcuNzYgNi45MDc3OSAzMzcuNzg0IDYuODk5ODdDMzM4LjIxOSA2Ljc2NjExIDMzOC42NyA2LjY3MTk0IDMzOS4wODEgNi40OTUwNkMzNDAuMDkxIDYuMDY2NDkgMzQwLjc0MiA1LjM1MTMyIDM0MC44NjkgNC4yMTkzMkMzNDAuOTYxIDMuMzg1OTQgMzQwLjU0NiAyLjY1OTA0IDMzOS43MzYgMi4zMzY2NkMzMzkuMTY1IDIuMTEyNTUgMzM4LjU2NiAyLjAzMzk0IDMzNy45NjQgMi4wMjYwMkMzMzYuNTM1IDIuMDEwNDcgMzM1LjEwMiAyLjAyMjIgMzMzLjY3NCAyLjAyMjJDMzMzLjYwMiAyLjAyMjIgMzMzLjUyNiAyLjAxODM4IDMzMy40NTQgMi4wMzM5M0MzMzMuNDE0IDIuMDQxODUgMzMzLjM1OCAyLjA4NDk4IDMzMy4zNDYgMi4xMjA0N0MzMzMuMzA2IDIuMjUwMTMgMzMzLjI4MiAyLjM4Mzg5IDMzMy4yNTEgMi41MzMyQzMzMy4zNDYgMi41NDQ5NCAzMzMuNDUgMi41NTI4NSAzMzMuNTUgMi41NzI1QzMzMy43MjkgMi42MDc3IDMzMy45MTcgMi42MzE0NyAzMzQuMDg5IDIuNjkwNDNDMzM0LjM0IDIuNzY5MDQgMzM0LjQyOCAyLjkwMjUxIDMzNC40MTYgMy4xNTgwMUMzMzQuNDA4IDMuMzA3MzIgMzM0LjM4OCAzLjQ1NjkzIDMzNC4zNDQgMy41OTgzMkMzMzQuMDk2IDQuNDAwMDIgMzMzLjg0MSA1LjE5NzkxIDMzMy41ODUgNS45OTU3OUMzMzMuMTI3IDcuNDM4MTUgMzMyLjY2OCA4Ljg4NDYyIDMzMi4xOTcgMTAuMzIzMkMzMzIuMDUzIDEwLjc2NzMgMzMxLjg4OSAxMS4yMDc2IDMzMS43MDYgMTEuNjRDMzMxLjU2NiAxMS45NzQxIDMzMS4zMDMgMTIuMTgyNCAzMzAuOTMyIDEyLjI0NTFDMzMwLjY4IDEyLjI4ODMgMzMwLjQyNSAxMi4zMzE3IDMzMC4xNjkgMTIuMzc0OEMzMzAuMTE0IDEyLjUzNjEgMzMwLjA1NyAxMi42OTM0IDMyOS45OTQgMTIuODg5NloiIGZpbGw9IiMwQjNCNjIiLz4KPHBhdGggZD0iTTM4MC4zMzcgMTAuMDU2MkMzODAuNTM2IDEwLjA0MDQgMzgwLjcxMiAxMC4wMzI3IDM4MC44OTIgMTAuMDA5QzM4MS4xNDcgOS45Njk2NiAzODEuMjUxIDkuODcxMzkgMzgxLjI4NyA5LjYyQzM4MS4zMSA5LjQzOTAxIDM4MS4zMTkgOS4yNTQ0OSAzODEuMzE5IDkuMDczNUMzODEuMzE5IDguMTAyODQgMzgxLjMyMiA3LjEzNTk5IDM4MS4zMDcgNi4xNjUwM0MzODEuMzAzIDUuOTA5NTMgMzgxLjI1MSA1LjY0NjQxIDM4MS4xNzkgNS4zOTQ3M0MzODEuMDU5IDQuOTY2NDUgMzgwLjcxNiA0Ljc0MjMzIDM4MC4yNjEgNC43MjY0OUMzNzkuOTI2IDQuNzE0NzYgMzc5LjYwMiA0Ljc1Nzg4IDM3OS4zMDcgNC45MjcxM0MzNzguODggNS4xNzA2MSAzNzguNzI4IDUuNTY3NzkgMzc4LjcyNCA2LjAxNTcyQzM3OC43MTIgNy4xNTU2NCAzNzguNzIxIDguMjk1MjcgMzc4LjcyMSA5LjQzNTE5QzM3OC43MjEgOS41MzM0NiAzNzguNzM2IDkuNjMxNzMgMzc4Ljc2NCA5LjcyNTg5QzM3OC44MDggOS44NzkzMSAzNzguOSA5Ljk5MzQyIDM3OS4wODQgMTAuMDAxMUMzNzkuMjIzIDEwLjAwOSAzNzkuMzYzIDEwLjAzNjUgMzc5LjQ5OSAxMC4wMzI3QzM3OS42NzggMTAuMDI0OCAzNzkuNzQyIDEwLjA5OTMgMzc5LjcxOCAxMC4yNjQ1QzM3OS43MTQgMTAuMjkyIDM3OS43MTQgMTAuMzE1NSAzNzkuNzE4IDEwLjM0MzFDMzc5LjczOCAxMC41MDQxIDM3OS42NSAxMC41NTE0IDM3OS41MDcgMTAuNTQzNEMzNzkuMTI0IDEwLjUyIDM3OC43MzYgMTAuNDg0NSAzNzguMzUzIDEwLjQ4NDVDMzc3LjcwMyAxMC40ODQ1IDM3Ny4wNTIgMTAuNTEyIDM3Ni40MDIgMTAuNTI3OUMzNzYuMzgyIDEwLjUyNzkgMzc2LjM2MiAxMC41MzE3IDM3Ni4zNDIgMTAuNTMxN0MzNzYuMDM5IDEwLjU1OTMgMzc1LjkxMSAxMC4zOTQxIDM3Ni4wMjcgMTAuMTE5QzM3Ni4wNDMgMTAuMDc1OCAzNzYuMTI2IDEwLjA0NDUgMzc2LjE4MiAxMC4wNDA0QzM3Ni4zNzQgMTAuMDIwNyAzNzYuNTY1IDEwLjAyMDcgMzc2Ljc1NyAxMC4wMDExQzM3Ni45NDggOS45ODU1IDM3Ny4wNiA5Ljg3MTM5IDM3Ny4wODQgOS42OTA2OUMzNzcuMTEyIDkuNDgyNDIgMzc3LjEzMiA5LjI3NDE1IDM3Ny4xMzIgOS4wNjU1OEMzNzcuMTMyIDcuNzg4MzggMzc3LjEyOCA2LjUxMDg4IDM3Ny4xMjggNS4yMzM2OEMzNzcuMTI4IDUuMjAyMjkgMzc3LjEyOCA1LjE2NjggMzc3LjEyOCA1LjEzNTQxQzM3Ny4xMDQgNC42OTg5MiAzNzYuOTY0IDQuNTc3MTggMzc2LjUyMSA0LjU2OTI2QzM3Ni4zNjYgNC41NjU0NCAzNzYuMjA2IDQuNTI2MTQgMzc2LjA1MSA0LjUzNzg3QzM3NS43OTkgNC41NTc1MyAzNzUuNjA4IDQuNzA2ODQgMzc1LjUwOCA0LjkxOTIyQzM3NS4zMiA1LjMxMjMgMzc1LjE0OSA1LjcxMyAzNzUuMDA1IDYuMTIxOTJDMzc0LjU5OCA3LjMwMDg1IDM3NC4yMDcgOC40ODggMzczLjgwOCA5LjY3MTA0QzM3My43MzIgOS44OTEwNSAzNzMuNjY0IDEwLjExNTIgMzczLjU5NiAxMC4zMzkzQzM3My41NiAxMC40NjEgMzczLjQ5NiAxMC41MTYxIDM3My4zNTcgMTAuNTA4MkMzNzMuMDczIDEwLjQ5MjQgMzcyLjc4NiAxMC40ODQ1IDM3Mi41MDYgMTAuNTEyQzM3Mi4zMDMgMTAuNTMxNyAzNzIuMjM1IDEwLjQzMzQgMzcyLjE4NyAxMC4yNzYyQzM3Mi4wMjggOS43NjEzOSAzNzEuODY0IDkuMjQ2NTcgMzcxLjcwOCA4LjczMTc2QzM3MS40MTMgNy43Njg3MiAzNzEuMTIyIDYuODA1NjkgMzcwLjgyNiA1Ljg0Mjk0QzM3MC44MTQgNS44MDc0NSAzNzAuNzk4IDUuNzcxOTYgMzcwLjc3IDUuNzA1MzdDMzcwLjU5OSA2LjIyMDE4IDM3MC40MzUgNi43MDM2MSAzNzAuMjcxIDcuMTkwODRDMzY5LjkyOCA4LjIyMDc2IDM2OS41NzcgOS4yNDY1OCAzNjkuMjQyIDEwLjI4MDNDMzY5LjE4MiAxMC40NTcyIDM2OS4xMDIgMTAuNTMxNyAzNjguOTA3IDEwLjUxNjJDMzY4LjY1NSAxMC40OTY1IDM2OC40MDQgMTAuNTA4MiAzNjguMTQ4IDEwLjUxMkMzNjcuOTMzIDEwLjUxMiAzNjcuODY5IDEwLjQ2ODkgMzY3LjgwNSAxMC4yNjQ1QzM2Ny41OSA5LjU2NDg1IDM2Ny4zNzggOC44NjE0MiAzNjcuMTU5IDguMTYxOEMzNjYuODU5IDcuMjA2NjggMzY2LjU1MiA2LjI1MTU3IDM2Ni4yNDUgNS4yOTY0NUMzNjYuMjEzIDUuMTk4MTggMzY2LjE2OSA1LjEwNDAyIDM2Ni4xMjUgNS4wMDk1NkMzNjUuOTg5IDQuNzE4NTcgMzY1Ljc3OCA0LjU0NTggMzY1LjQzOCA0LjUyNjE0QzM2NS4xNzEgNC41MTAzIDM2NS4wNjcgNC4zMzM0MiAzNjUuMTc1IDQuMDgyMDJDMzY1LjE5NSA0LjAzMDk4IDM2NS4zMTUgMy45OTk1OSAzNjUuMzg3IDMuOTk5NTlDMzY1LjgzOCA0LjAwMzQxIDM2Ni4yODggNC4wMzQ3OSAzNjYuNzQgNC4wMzA5OEMzNjcuMzQyIDQuMDMwOTggMzY3Ljk0OSA0LjAwNzIyIDM2OC41NTEgMy45OTE2N0MzNjguNzYzIDMuOTg3NTcgMzY4Ljc5MSA0LjAwNzIyIDM2OC43OTEgNC4yMTU0OUMzNjguNzkxIDQuMjk4MjEgMzY4Ljc5MSA0LjM4NDc1IDM2OC43OTEgNC40Nzg5MUMzNjguNjI3IDQuNDk4NTcgMzY4LjQ3NiA0LjUxNDQgMzY4LjMyOCA0LjUzNzg3QzM2OC4wMjkgNC41ODUxIDM2Ny44NjUgNC43NTc4OCAzNjcuOTEzIDUuMDUyNjlDMzY3Ljk3NyA1LjQzNDAzIDM2OC4wOCA1LjgxMTI3IDM2OC4xODggNi4xODQ2OUMzNjguNDY0IDcuMTM5ODEgMzY4Ljc1MSA4LjA5MTExIDM2OS4wNDYgOS4wODkzNUMzNjkuMTM4IDguODAyNDYgMzY5LjIyMiA4LjU1ODY5IDM2OS4zMDIgOC4zMDdDMzY5LjczNyA2LjkzOTQ1IDM3MC4xNzIgNS41NzE2MSAzNzAuNTk5IDQuMTk5OTVDMzcwLjY0MyA0LjA2NjE5IDM3MC43MDMgNC4wMTUxNCAzNzAuODUgNC4wMTkyNEMzNzEuMTUgNC4wMzA5OCAzNzEuNDQ5IDQuMDM0NzkgMzcxLjc0OCA0LjAxOTI0QzM3MS45MDggNC4wMTEzMiAzNzEuOTYgNC4wNzAyOSAzNzIuMDA0IDQuMjExNjhDMzcyLjQ3NCA1LjgyNzEgMzcyLjk1MyA3LjQzODQzIDM3My40MjggOS4wNTM4NUMzNzMuNDI4IDkuMDU3OTYgMzczLjQzNiA5LjA2MTc3IDM3My40NjggOS4wODkzNUMzNzMuNTEyIDguOTMyMTIgMzczLjU1MiA4Ljc4NjYyIDM3My41OTIgOC42NDUyM0MzNzMuOTA3IDcuNDcwMTEgMzc0LjIzMSA2LjI5ODggMzc0LjU0MiA1LjEyMzY4QzM3NC42MjYgNC44MDUxMSAzNzQuNDg2IDQuNjA0NzUgMzc0LjE2MyA0LjUzNzg3QzM3NC4wODMgNC41MjIzMiAzNzQuMDAzIDQuNTE4MjIgMzczLjkyNyA0LjQ5ODU2QzM3My44NTEgNC40Nzg5MSAzNzMuNzE2IDQuNDYzMzYgMzczLjcxMiA0LjQyNDA2QzM3My42ODggNC4yOTgyMSAzNzMuNjk2IDQuMTY0NDUgMzczLjcyIDQuMDM4OUMzNzMuNzI0IDQuMDExMzMgMzczLjg1MSAzLjk5NTQ5IDM3My45MTkgMy45OTU0OUMzNzQuNTAyIDQuMDAzNDEgMzc1LjA4OSA0LjAxOTI0IDM3NS42NzEgNC4wMjY4N0MzNzUuODAzIDQuMDI2ODcgMzc1LjkzOSA0LjAwMzQxIDM3Ni4wNzEgNC4wMTEzM0MzNzYuMjk4IDQuMDIzMDYgMzc2LjUyNSA0LjA2NjE4IDM3Ni43NTMgNC4wNjIzN0MzNzcuMzE2IDQuMDUwNjMgMzc3Ljg4MiA0LjAxMTMzIDM3OC40NDUgMy45OTE2N0MzNzguNzAxIDMuOTc5OTQgMzc4LjcwNCAzLjk4NzU3IDM3OC43MDQgNC4yMzUxNUMzNzguNzA0IDQuNDA0NDEgMzc4LjcwNCA0LjU3MzM3IDM3OC43MDQgNC43NjU4QzM3OC43NjQgNC43MjY0OSAzNzguODA0IDQuNzA2ODMgMzc4LjgzMiA0LjY3OTI2QzM3OS40OTUgNC4wMjY4NyAzODAuMzIxIDMuODM4MjYgMzgxLjIyMyAzLjkwMTMzQzM4MS40NjIgMy45MTY4OCAzODEuNzA2IDMuOTc1ODQgMzgxLjkzMyA0LjA1NDQ1QzM4Mi41MzYgNC4yNzA2NCAzODIuODMxIDQuNzM0NDEgMzgyLjg3MSA1LjMzOTU3QzM4Mi45MTEgNS45NDA5MiAzODIuOTExIDYuNTQyMjcgMzgyLjkxNSA3LjE0MzYxQzM4Mi45MjMgNy44NTkwNyAzODIuOTE1IDguNTcwNDIgMzgyLjkxOSA5LjI4NTg4QzM4Mi45MTkgOS40MjM0NiAzODIuOTM1IDkuNTYxMDQgMzgyLjk2MyA5LjY5NDUxQzM4Mi45OTkgOS44Njc1OCAzODMuMTAyIDkuOTg5MzEgMzgzLjI5NCAxMC4wMDUyQzM4My40ODYgMTAuMDE2OSAzODMuNjc3IDEwLjAzNjUgMzgzLjg2OSAxMC4wMzY1QzM4My45OTIgMTAuMDM2NSAzODQuMDQgMTAuMDgzOCAzODQuMDI5IDEwLjE5NzZDMzg0LjAyNCAxMC4yMTcyIDM4NC4wMjkgMTAuMjM2OSAzODQuMDI5IDEwLjI1NjVDMzg0LjAyOSAxMC41NDM0IDM4NCAxMC41NDc1IDM4My43MDUgMTAuNTM5NkMzODIuOTUxIDEwLjUxNjIgMzgyLjE5MyAxMC41MDQxIDM4MS40MzQgMTAuNTAwM0MzODEuMTU1IDEwLjQ5NjUgMzgwLjg3NSAxMC41Mjc5IDM4MC42IDEwLjUzOTZDMzgwLjM1NyAxMC41NTE0IDM4MC4zMjkgMTAuNTI3OSAzODAuMzI5IDEwLjI4MDNDMzgwLjMyMSAxMC4yMDU1IDM4MC4zMjkgMTAuMTMwNyAzODAuMzM3IDEwLjA1NjJaIiBmaWxsPSIjMDQwNDA0Ii8+CjxwYXRoIGQ9Ik0zNDUuNTM1IDEuNDk1NDlDMzQ1LjUzNSAxLjM2NTU0IDM0NS41MzUgMS4yMzk5OSAzNDUuNTM1IDEuMTEwMzRDMzQ1LjUzNSAwLjk5MjQxNCAzNDUuNjIzIDEuMDAwMDQgMzQ1LjcwNyAxLjAwMDA0QzM0Ni4wMzQgMS4wMDc5NiAzNDYuMzU3IDEuMDE5NjkgMzQ2LjY4NCAxLjAxOTY5QzM0Ny42MjIgMS4wMjM4IDM0OC41NTYgMS4wMTk2OSAzNDkuNDk0IDEuMDIzOEMzNTAuMTM2IDEuMDI3NjEgMzUwLjc4NyAwLjk4ODMwMiAzNTEuNDIxIDEuMDUxMzdDMzUyLjU0NyAxLjE2MTM3IDM1My4yNjkgMS44MDIwMyAzNTMuMjk3IDMuMDI4MTlDMzUzLjMxMyAzLjY3Njc3IDM1My4xNzggNC4yNzQwMSAzNTIuNjcxIDQuNzMzOTdDMzUyLjMyIDUuMDU2MzUgMzUxLjg4NSA1LjIyOTEzIDM1MS40MjYgNS4zNTQ5N0MzNTEuMjg2IDUuMzk0MjggMzUxLjE0NiA1LjQyMTg1IDM1MC45ODYgNS40NTcwNUMzNTEuMzU4IDUuNTMxODUgMzUxLjcxNyA1LjU4NyAzNTIuMDY4IDUuNjc3MzVDMzUzLjA1OCA1LjkzNjY2IDM1My41MTcgNi42MjgzNiAzNTMuNTY5IDcuNTcxNzVDMzUzLjU5MyA3Ljk4MDM3IDM1My41ODUgOC4zOTMxIDM1My40NjkgOC43OTc5MUMzNTMuMjQxIDkuNTgwMjQgMzUyLjcwNyAxMC4wNTk2IDM1MS45NCAxMC4zMTUxQzM1MS4zNTQgMTAuNTA3OCAzNTAuNzQ3IDEwLjU1NSAzNTAuMTM2IDEwLjU0M0MzNDkuNDg2IDEwLjUzNTQgMzQ4LjgzNSAxMC40OTYxIDM0OC4xODUgMTAuNDk2MUMzNDcuMzgzIDEwLjQ5NjEgMzQ2LjU4IDEwLjUyMzMgMzQ1Ljc3OCAxMC41NDNDMzQ1LjU2MyAxMC41NDcxIDM0NS41MzkgMTAuNTI3NCAzNDUuNTM1IDEwLjMyM0MzNDUuNTM1IDEwLjI3NTggMzQ1LjUzNSAxMC4yMzI2IDM0NS41MzEgMTAuMTg1NEMzNDUuNTE5IDEwLjA1MTkgMzQ1LjU4MyAxMC4wMDA2IDM0NS43MTggMTAuMDAwNkMzNDUuODgyIDEwLjAwMDYgMzQ2LjA1IDkuOTg4ODYgMzQ2LjIxMyA5Ljk2NTM5QzM0Ni41OTIgOS45MTAyNSAzNDYuNzE2IDkuNzg0NDEgMzQ2Ljc0NCA5LjQwMzM2QzM0Ni43NjggOS4xMDQ0NCAzNDYuNzg4IDguODAyMDEgMzQ2Ljc5MiA4LjUwMzFDMzQ2Ljc5NiA2LjY3NTU5IDM0Ni43OTYgNC44NDgwOCAzNDYuNzkyIDMuMDI0MzhDMzQ2Ljc5MiAyLjc0NTEyIDM0Ni43OCAyLjQ2MjM0IDM0Ni43NDggMi4xODMwOEMzNDYuNjg0IDEuNjQ4NjEgMzQ2LjYwNCAxLjYzNjg4IDM0Ni4xMTMgMS41NTQ0NkMzNDUuOTQyIDEuNTIyNzggMzQ1Ljc2MiAxLjUxNTE0IDM0NS41MzUgMS40OTU0OVpNMzQ4LjU4IDkuODc4ODZDMzQ5LjEzOSA5LjkzNzgzIDM0OS42NyA5Ljk1MzY3IDM1MC4yIDkuODc4ODZDMzUwLjg2MyA5Ljc4NDQxIDM1MS4zNTQgOS40NTQ0IDM1MS41MjkgOC43OTAyOEMzNTEuNjg1IDguMjAwNjYgMzUxLjY4NSA3LjYwMzEzIDM1MS41NDkgNy4wMDU4OUMzNTEuNDAxIDYuMzY5MDUgMzUwLjk3OCA2LjAxMTQ2IDM1MC4zNDggNS44Nzc3QzM0OS43NTcgNS43NTE4NiAzNDkuMTYzIDUuNzgzNTQgMzQ4LjU4IDUuODM0NThDMzQ4LjU4IDcuMTg2NTggMzQ4LjU4IDguNTMwNjcgMzQ4LjU4IDkuODc4ODZaTTM0OC41NjggNS4yMzMyM0MzNDkuMTgzIDUuMjU2NyAzNDkuODA1IDUuMjg4MDkgMzUwLjQwNCA1LjA3MTlDMzUwLjg3MSA0LjkwMjkzIDM1MS4xNzQgNC41ODA4NCAzNTEuMjk4IDQuMTA1MDRDMzUxLjQxOCAzLjY0OTE5IDM1MS40MTggMy4xODkyNCAzNTEuMzQyIDIuNzI5NTdDMzUxLjIzOCAyLjEyNDEyIDM1MC44NzUgMS43NDY4OCAzNTAuMjY0IDEuNjM2ODhDMzQ5LjcwNSAxLjUzNDggMzQ5LjE0NyAxLjYyMTA0IDM0OC41NjQgMS42MzY4OEMzNDguNTY4IDIuODM5NTcgMzQ4LjU2OCA0LjAzMDU0IDM0OC41NjggNS4yMzMyM1oiIGZpbGw9IiMwNDA0MDQiLz4KPHBhdGggZD0iTTM5MS4wNTkgMy45NTYwOUMzOTEuNTE5IDMuOTU2MDkgMzkxLjk2NSAzLjk2MDE5IDM5Mi40MDkgMy45NTYwOUMzOTMuMjY3IDMuOTQ0MzUgMzk0LjEyNSAzLjkxNjc4IDM5NC45NzggMy45MjA4OUMzOTUuNjE3IDMuOTI0NyAzOTYuMjA4IDQuMDkzNjcgMzk2LjY1OSA0LjU4NTAxQzM5Ni45ODYgNC45NDY3IDM5Ny4xNzQgNS4zNzQ5OCAzOTcuMjYxIDUuODQyODZDMzk3LjM3MyA2LjQzNjI5IDM5Ny40MDkgNy4wMjk3MiAzOTcuMzYxIDcuNjM0ODhDMzk3LjMyNSA4LjEwNjU3IDM5Ny4yNjUgOC41NjY1MyAzOTcuMTEgOS4wMTQ0NkMzOTYuNzk1IDkuOTM0MzggMzk2LjA2OCAxMC40NjQ3IDM5NS4wODYgMTAuNDkyM0MzOTQuMTUyIDEwLjUxOTkgMzkzLjIxNSAxMC40NzI3IDM5Mi4yODEgMTAuNDY4OUMzOTEuODA2IDEwLjQ2ODkgMzkxLjMyNyAxMC40OTY0IDM5MC44NTIgMTAuNTAwMkMzOTAuNjEyIDEwLjUwMDIgMzkwLjM3MyAxMC40Njg5IDM5MC4xMzggMTAuNDY4OUMzODkuNzI3IDEwLjQ3MjcgMzg5LjMxNSAxMC40OTIzIDM4OC45MDQgMTAuNTA0MUMzODguODQgMTAuNTA0MSAzODguNzc3IDEwLjUwNDEgMzg4LjY5NyAxMC41MDQxQzM4OC42ODkgMTAuNDAyIDM4OC42ODEgMTAuMzIzMyAzODguNjczIDEwLjIyNTFDMzg4LjgzMiAxMC4yMDE2IDM4OC45OCAxMC4xNzc5IDM4OS4xMjggMTAuMTYyM0MzODkuNDIzIDEwLjEyNjggMzg5LjU2MyA5Ljk0OTkzIDM4OS40NjcgOS42NzQ3OEMzODkuMjUyIDkuMDYxNjkgMzg5LjAxNiA4LjQ1MjQyIDM4OC43OTMgNy44NDM0NUMzODguNzczIDcuNzg4MyAzODguNzUzIDcuNzMzMTUgMzg4LjcyOSA3LjY3ODNDMzg4LjcwMSA3LjY3NDE5IDM4OC42NzMgNy42NzAzOCAzODguNjQ5IDcuNjcwMzhDMzg3Ljg5MSA3LjY3MDM4IDM4Ny4xMzIgNy42NzAzOCAzODYuMzM4IDcuNjcwMzhDMzg2LjEyNyA4LjI4NzU3IDM4NS44OTEgOC45MDQ0NiAzODUuNyA5LjUzMzM4QzM4NS41NzIgOS45NTQwMyAzODUuNzQ3IDEwLjE2MjMgMzg2LjE5NCAxMC4yMDE2QzM4Ni4yODYgMTAuMjA5NSAzODYuMzc4IDEwLjIwMTYgMzg2LjQ4NiAxMC4yMDE2QzM4Ni40ODYgMTAuMjk5OSAzODYuNDg2IDEwLjM4NjQgMzg2LjQ4NiAxMC40ODQ0QzM4NS43MjcgMTAuNDg0NCAzODQuOTc3IDEwLjQ4NDQgMzg0LjIxMSAxMC40ODQ0QzM4NC4yMTEgMTAuMzk4MSAzODQuMjExIDEwLjMxOTUgMzg0LjIxMSAxMC4yMzNDMzg0LjIyMyAxMC4yMjUxIDM4NC4yNDMgMTAuMjEzMyAzODQuMjU5IDEwLjIwOTVDMzg0LjcwMiAxMC4xODk5IDM4NC45NjUgOS45NTQwMyAzODUuMTMzIDkuNTU2ODVDMzg1LjQ0OCA4Ljc5NDQ2IDM4NS43ODcgOC4wMzk5OSAzODYuMTExIDcuMjc3M0MzODYuNTA2IDYuMzMzOTIgMzg2Ljg5MyA1LjM4NjcyIDM4Ny4yOCA0LjQ0MzYzQzM4Ny4zMzYgNC4zMTM5NyAzODcuMzk2IDQuMTgwMiAzODcuNDMyIDQuMDQyNjNDMzg3LjQ3MiAzLjg4NTQgMzg3LjU2NyAzLjg0NjA4IDM4Ny43MTkgMy44NDYwOEMzODguMjI2IDMuODUwMTkgMzg4LjE4MiAzLjc4NzEzIDM4OC4zNjUgNC4yOTgxM0MzODguNjE3IDQuOTkzOTMgMzg4Ljg4NCA1LjY4NTYyIDM4OS4xNTIgNi4zNzczMkMzODkuNTI3IDcuMzQ3OTkgMzg5LjkxIDguMzE0ODQgMzkwLjI4OSA5LjI4MTY5QzM5MC4zNTcgOS40NTQ3NiAzOTAuNDI5IDkuNjMxNjUgMzkwLjUxMyA5LjgwMDYyQzM5MC42NzIgMTAuMTE1MSAzOTEuMDIgMTAuMjUyNyAzOTEuNDY3IDEwLjE5MzdDMzkxLjg0MiAxMC4xNDI3IDM5MS45MSAxMC4wNzU4IDM5MS45NDIgOS42OTg1NEMzOTEuOTYxIDkuNDkwMjYgMzkxLjk3NCA5LjI4MTY5IDM5MS45NzQgOS4wNzM0MkMzOTEuOTc3IDcuNzg4MyAzOTEuOTc3IDYuNTA2OTggMzkxLjk3NCA1LjIyMTg1QzM5MS45NzQgNC45OTM5MyAzOTEuOTQ5IDQuNzY1NzEgMzkxLjkxIDQuNTQxODlDMzkxLjg3IDQuMzI1NyAzOTEuNzcgNC4yNjI2MyAzOTEuNTUgNC4yNTA5QzM5MS40NTggNC4yNDcwOCAzOTEuMzY3IDQuMjQyOTcgMzkxLjI3MSA0LjIzOTE2QzM5MS4wMjggNC4yMzEyNCAzOTEgNC4xOTYwNCAzOTEuMDU5IDMuOTU2MDlaTTM5Mi44MjMgMTAuMTIzQzM5My40ODIgMTAuMTIzIDM5NC4xMDggMTAuMTc0IDM5NC43MjMgMTAuMTExM0MzOTUuNTAyIDEwLjAzMjYgMzk2LjA1NiA5LjYxOTkyIDM5Ni4yMDggOC44MTc5MkMzOTYuMjkxIDguMzc3OTEgMzk2LjM1NSA3LjkyOTY5IDM5Ni4zODcgNy40ODU1N0MzOTYuNDMxIDYuODI5MzcgMzk2LjQwMyA2LjE2OTA2IDM5Ni4yMDQgNS41MzIyMUMzOTYuMDIgNC45NTA1MiAzOTUuNjgxIDQuNDk4NDggMzk1LjA1NCA0LjM1NzA5QzM5NC42NzkgNC4yNzQ2NiAzOTQuMjggNC4yNTg4MiAzOTMuODkzIDQuMjUwOUMzOTMuNTQyIDQuMjQ3MDggMzkzLjE4NyA0LjI5NDMxIDM5Mi44MjMgNC4zMjE1OUMzOTIuODIzIDYuMjc0OTUgMzkyLjgyMyA4LjE4NTE5IDM5Mi44MjMgMTAuMTIzWk0zODguNjA5IDcuMzI0NTJDMzg4LjI1IDYuNDQ0MjEgMzg3LjkwMyA1LjU5MTE4IDM4Ny41NTYgNC43NDIyNUMzODcuNTM5IDQuNzQ2MDYgMzg3LjUyNCA0Ljc1MDE2IDM4Ny41MDcgNC43NTM5N0MzODcuMTc2IDUuNjAyOSAzODYuODQ1IDYuNDUxODMgMzg2LjUwMiA3LjMyNDUyQzM4Ny4yMTIgNy4zMjQ1MiAzODcuODg3IDcuMzI0NTIgMzg4LjYwOSA3LjMyNDUyWiIgZmlsbD0iIzBCM0I2MiIvPgo8cGF0aCBkPSJNMzQyLjA3IDE1LjgzN0MzNDIuMDcgMTYuNDg5NyAzNDIuMDcgMTcuMTMwNCAzNDIuMDcgMTcuNzgyOEMzMzcuNzEyIDE3Ljc4MjggMzMzLjM2MiAxNy43ODI4IDMyOSAxNy43ODI4QzMyOSAxNy4xMzggMzI5IDE2LjQ5MzUgMzI5IDE1LjgzN0MzMzMuMzUgMTUuODM3IDMzNy43IDE1LjgzNyAzNDIuMDcgMTUuODM3WiIgZmlsbD0iIzBCM0I2MiIvPgo8cGF0aCBkPSJNMzYyLjY1MiAzLjg0OTE1QzM2My4wNDcgMy45Mjc3NyAzNjMuNDk0IDMuOTgyOTIgMzYzLjkyNSA0LjEwODc2QzM2NC42NjggNC4zMjA4NSAzNjUuMTcxIDQuODIwMTEgMzY1LjQxOCA1LjUzNTI4QzM2NS43ODkgNi42MTI0MyAzNjUuODA5IDcuNzE2ODUgMzY1LjQ5NCA4LjgwOTI1QzM2NS4yMjMgOS43NDQ3MiAzNjQuNTcyIDEwLjMwMjkgMzYzLjYxNCAxMC41MTkxQzM2Mi43OCAxMC43MTE2IDM2MS45NDIgMTAuNzE1NyAzNjEuMTE2IDEwLjUwMzNDMzYwLjE2MiAxMC4yNTk4IDM1OS41NjcgOS42MzQ3MSAzNTkuMzI4IDguNjk5MjVDMzU5LjA4IDcuNzMyNCAzNTkuMDkyIDYuNzU3NjMgMzU5LjMzMiA1Ljc5MDc4QzM1OS41OTEgNC43NDk0MiAzNjAuMzMgNC4xOTUgMzYxLjM1OSAzLjk5NDY1QzM2MS43NjIgMy45MTYwMyAzNjIuMTgxIDMuOTAwNDkgMzYyLjY1MiAzLjg0OTE1Wk0zNjQuMDAxIDcuNDE3OTRDMzYzLjk1MyA2Ljc3NzI4IDM2My45MjUgNi4yMzEwOCAzNjMuODY2IDUuNjg0ODhDMzYzLjgzIDUuMzYyNSAzNjMuNzMgNS4wNDgwNCAzNjMuNDg2IDQuODA0MjdDMzYzLjA5MSA0LjQwMzU3IDM2Mi41ODggNC4zNTYzNCAzNjIuMDY2IDQuNDM4NzdDMzYxLjY5IDQuNDk3NzMgMzYxLjM2MyA0LjY2NjcgMzYxLjIgNS4wMTY2NUMzNjEuMDg0IDUuMjYwMTIgMzYwLjk4NCA1LjUzMTQ2IDM2MC45NjQgNS43OTQ4OEMzNjAuOTA4IDYuNDYyODIgMzYwLjg4NCA3LjEzODk3IDM2MC44ODQgNy44MTEwMkMzNjAuODg0IDguMTkyMzYgMzYwLjk0IDguNTc3NTEgMzYxIDguOTU4ODZDMzYxLjA0OCA5LjI2OTIxIDM2MS4xNjQgOS41Njc4NCAzNjEuNDExIDkuNzg0MDNDMzYyLjI0NSAxMC41MDc0IDM2My41OTQgMTAuMDk4NSAzNjMuODIyIDkuMDM3NDhDMzYzLjkzNyA4LjQ3OTI1IDM2My45NDkgNy45MDEzNyAzNjQuMDAxIDcuNDE3OTRaIiBmaWxsPSIjMDQwNDA0Ii8+CjxwYXRoIGQ9Ik00MDEuNTI0IDQuMjIzMjVDNDAxLjUyNCA0LjExNzA2IDQwMS41MjQgNC4wMzA4MiA0MDEuNTI0IDMuOTM2MzdDNDAzLjA5NyAzLjkzNjM3IDQwNC42NTMgMy45MzYzNyA0MDYuMjM0IDMuOTM2MzdDNDA2LjIzOCA0LjAxNDk4IDQwNi4yNDIgNC4xMDE1MSA0MDYuMjQ2IDQuMjExNTJDNDA2LjA3OCA0LjIyNzM2IDQwNS45MTggNC4yNTA4MiA0MDUuNzYzIDQuMjUwODJDNDA1LjUzMSA0LjI1MDgyIDQwNS40MDggNC4zNTI5MSA0MDUuMzY4IDQuNjI0MjVDNDA1LjM0IDQuODEyODcgNDA1LjMyOCA1LjAwMTQ4IDQwNS4zMjggNS4xOTAxQzQwNS4zMjQgNi41NTc5NSA0MDUuMzI0IDcuOTI5NjEgNDA1LjMyOCA5LjI5NzQ2QzQwNS4zMjggOS41MDU3MyA0MDUuMzY4IDkuNzEwMTkgNDA1LjM5MSA5LjkxODQ2QzQwNS40MTIgMTAuMDgzNiA0MDUuNTI3IDEwLjE0NjQgNDA1LjY3OSAxMC4xNjZDNDA1Ljg1NSAxMC4xODU3IDQwNi4wMzQgMTAuMjAxNSA0MDYuMjI2IDEwLjIyMTJDNDA2LjIyNiAxMC4zMDM2IDQwNi4yMjYgMTAuMzkwMiA0MDYuMjI2IDEwLjQ4ODRDNDA1LjM0NCAxMC40ODg0IDQwNC40NjYgMTAuNDg4NCA0MDMuNTcyIDEwLjQ4ODRDNDAzLjU3MiAxMC40MDU3IDQwMy41NzIgMTAuMzE5NSA0MDMuNTcyIDEwLjIyNUM0MDMuNzU5IDEwLjIwOTIgNDAzLjkzNSAxMC4xODU3IDQwNC4xMSAxMC4xNzc4QzQwNC4yOSAxMC4xNjYgNDA0LjM5NCAxMC4wNzU3IDQwNC40MjIgOS45MDI2MkM0MDQuNDQ2IDkuNzI5ODQgNDA0LjQ3NCA5LjU1Mjk2IDQwNC40NzQgOS4zNzYwN0M0MDQuNDc4IDcuOTUzMzcgNDA0LjQ3OCA2LjUzNDQ5IDQwNC40NyA1LjExMTQ5QzQwNC40NyA0Ljg5OTQxIDQwNC40NDIgNC42ODMyMSA0MDQuNDAyIDQuNDc0OTRDNDA0LjM3NCA0LjMyNTYzIDQwNC4yNDYgNC4yNTQ2NCA0MDQuMDkxIDQuMjU4NzVDNDAzLjg1OSA0LjI1ODc1IDQwMy42MjggNC4yNTg3NCA0MDMuMzk2IDQuMjU0NjRDNDAzLjIxMyA0LjI1MDgyIDQwMy4wODkgNC4zNDkwOSA0MDMuMDE3IDQuNDk0NTlDNDAyLjg0MSA0Ljg1NTk4IDQwMi42NyA1LjIyNTYgNDAyLjUyMiA1LjU5OTAyQzQwMi4yMzEgNi4zMjYyMSA0MDEuOTQ3IDcuMDYxMDMgNDAxLjY2OCA3Ljc5NjE0QzQwMS4zMzMgOC42NzY0NSA0MDEuMDA1IDkuNTYwODcgNDAwLjY3IDEwLjQ0NUM0MDAuNjU4IDEwLjQ3NjcgNDAwLjY0MiAxMC41MDQgNDAwLjYyMiAxMC41NDMzQzQwMC40NDcgMTAuNTQzMyA0MDAuMjcxIDEwLjUzOTUgNDAwLjA5MiAxMC41NDMzQzM5OS45NjggMTAuNTQ3NCAzOTkuOTM2IDEwLjQ1NyAzOTkuOTA4IDEwLjM3NDNDMzk5LjgwOCAxMC4wOTkyIDM5OS43MiA5LjgyMDE5IDM5OS42MjEgOS41NDUwM0MzOTkuMzAxIDguNjY0NzIgMzk4Ljk4MiA3Ljc4NDExIDM5OC42NTEgNi45MDc5MUMzOTguMzg3IDYuMjA4MjkgMzk4LjEwNCA1LjUxNjI5IDM5Ny44MjkgNC44MjA3OEMzOTcuNjc3IDQuNDM5NDQgMzk3LjQzOCA0LjE2ODQgMzk2Ljk2NyA0LjIxNTMzQzM5Ni45NjcgNC4xMTMyNSAzOTYuOTY3IDQuMDMwODIgMzk2Ljk2NyAzLjkyNDYzQzM5Ny4xMTggMy45MjQ2MyAzOTcuMjYyIDMuOTI0NjMgMzk3LjQwNiAzLjkyNDYzQzM5OC4wNzYgMy45MjQ2MyAzOTguNzQ3IDMuOTIwODIgMzk5LjQxNyAzLjkyMDgyQzM5OS41MTMgMy45MjA4MiAzOTkuNjI1IDMuODc3NCAzOTkuNjQxIDQuMDM0NjNDMzk5LjY1NyA0LjE3NjAyIDM5OS41ODUgNC4yMzExNyAzOTkuNDUzIDQuMjQ3MDFDMzk5LjMzMyA0LjI1ODc0IDM5OS4yMTggNC4yNzg0IDM5OS4xMDIgNC4zMDU5OEMzOTguODMgNC4zNjg3NSAzOTguNzE5IDQuNTM3NzEgMzk4LjgwMiA0Ljc5NzAyQzM5OC45NjIgNS4yOTYyOSAzOTkuMTM0IDUuNzk1NTYgMzk5LjMxNyA2LjI4NjlDMzk5LjcgNy4zMjAzNCA0MDAuMDkyIDguMzU0MDcgNDAwLjQ4MyA5LjM4Mzk5QzQwMC41MTEgOS40NTQ2OCA0MDAuNTQzIDkuNTIxNTcgNDAwLjYxOSA5LjU5NjA4QzQwMC43MTggOS4zNDA1OCA0MDAuODI2IDkuMDg1MDggNDAwLjkxOCA4LjgyNTc3QzQwMS4zMjEgNy42NzgyMiA0MDEuNzI0IDYuNTMwMzggNDAyLjExOSA1LjM4MjgzQzQwMi4xOTEgNS4xNzQ1NiA0MDIuMjUxIDQuOTU4MzcgNDAyLjI2NyA0Ljc0MjE4QzQwMi4yOTEgNC40NTUyOSA0MDIuMTM1IDQuMjk4MDUgNDAxLjg0NCA0LjI1NDY0QzQwMS43NCA0LjI0MjkgNDAxLjYzMiA0LjIzNDk5IDQwMS41MjQgNC4yMjMyNVoiIGZpbGw9IiMwQjNCNjIiLz4KPHBhdGggZD0iTTM1My42MTMgNC4wODU0NkMzNTMuNjY5IDQuMDc3ODMgMzUzLjcwMSA0LjA2NTggMzUzLjcyOSA0LjA2NThDMzU0LjQ4NyA0LjAzODUyIDM1NS4yNDEgNC4wMTQ3NiAzNTUuOTk5IDMuOTkxMjlDMzU2LjI1OSAzLjk4MzM3IDM1Ni4yNzkgNC4wMDY4NCAzNTYuMjgzIDQuMjY2NDVDMzU2LjI4MyA0LjQxNTc2IDM1Ni4yODMgNC41Njg4OCAzNTYuMjgzIDQuNzQ1NzdDMzU2LjQxNCA0LjU5MjY0IDM1Ni41MjIgNC40NTA5NiAzNTYuNjUgNC4zMjkyMkMzNTcuMDk3IDMuOTAwOTQgMzU3LjY0IDMuNzc4OTEgMzU4LjIzMSAzLjkyODIyQzM1OC43MjEgNC4wNTAyNSAzNTguOTYxIDQuNDE5NTcgMzU5LjAzNyA0Ljg5MTI2QzM1OS4wNjUgNS4wNTIzMSAzNTkuMDYxIDUuMjE3NDYgMzU5LjA0OSA1LjM3ODc5QzM1OS4wMjEgNS43MTY3MiAzNTguODg5IDUuODQyNTcgMzU4LjU1IDUuODY5ODVDMzU4LjQxIDUuODgxODggMzU4LjI3IDUuODgxODggMzU4LjEzMSA1Ljg2NjAzQzM1Ny44NzUgNS44NDI1NyAzNTcuNzg3IDUuNzQ0MyAzNTcuNzY0IDUuNDkyNjFDMzU3Ljc1MiA1LjM2Mjk1IDM1Ny43NDcgNS4yMjkxOSAzNTcuNzE2IDUuMTAzNjRDMzU3LjYxNiA0LjcxODQ5IDM1Ny4yMzMgNC41ODA5MSAzNTYuODg5IDQuNzk3MUMzNTYuNTc0IDUuMDAxMjYgMzU2LjQ2MyA1LjMyNzQ2IDM1Ni40MDcgNS42NjE1N0MzNTYuMzQ3IDYuMDM5MSAzNTYuMzExIDYuNDI4MDcgMzU2LjMwMyA2LjgwOTQxQzM1Ni4yOTEgNy43MjExMSAzNTYuMzAzIDguNjI5IDM1Ni4zMTUgOS41NDFDMzU2LjMxOSA5Ljg2NzE5IDM1Ni40NTEgOS45ODEwMiAzNTYuNzc4IDEwLjAwMDdDMzU2Ljk3NyAxMC4wMTI3IDM1Ny4xNzcgMTAuMDI4MiAzNTcuMzc2IDEwLjAzMjNDMzU3LjQ4NCAxMC4wMzIzIDM1Ny41MzYgMTAuMDc1NSAzNTcuNTM2IDEwLjE4MTdDMzU3LjUzNiAxMC4xOTM0IDM1Ny41MzYgMTAuMjA5MiAzNTcuNTM2IDEwLjIyMUMzNTcuNTQgMTAuNTM1NCAzNTcuNTEyIDEwLjU2MjcgMzU3LjE4OSAxMC41MzkyQzM1Ni4wNzkgMTAuNDYwNiAzNTQuOTc0IDEwLjQ0ODkgMzUzLjg2NCAxMC41MzkyQzM1My42MzcgMTAuNTU4OSAzNTMuNjA1IDEwLjUyNzUgMzUzLjYwNSAxMC4yOTU1QzM1My42MDUgMTAuMjE2OSAzNTMuNjA1IDEwLjE0MjMgMzUzLjYwNSAxMC4wNTU4QzM1My44NTIgMTAuMDQgMzU0LjA3NiAxMC4wMzIzIDM1NC4yOTUgMTAuMDA0OEMzNTQuNTU1IDkuOTczMzggMzU0LjY1NCA5Ljg3MTAxIDM1NC42ODMgOS42MTk2MkMzNTQuNzAzIDkuNDExMzUgMzU0LjcyMyA5LjIwMjc4IDM1NC43MjMgOC45OTQ1QzM1NC43MjYgNy44NjY2MSAzNTQuNzI2IDYuNzQyNTQgMzU0LjcyMyA1LjYxNDM1QzM1NC43MjMgNS40MTAxOCAzNTQuNzA2IDUuMjA5NTMgMzU0LjY4NiA1LjAwOTE4QzM1NC42NTkgNC43MzAyMSAzNTQuNTI3IDQuNjAwNTYgMzU0LjIzOSA0LjU4NDcyQzM1NC4wODggNC41NzI5OSAzNTMuOTMyIDQuNTgwOTEgMzUzLjc4MSA0LjU4MDkxQzM1My42NjEgNC41ODA5MSAzNTMuNTkzIDQuNTM3NDkgMzUzLjYwNSA0LjQwNDAyQzM1My42MTcgNC4yOTc4MyAzNTMuNjEzIDQuMTkxNjQgMzUzLjYxMyA0LjA4NTQ2WiIgZmlsbD0iIzA0MDQwNCIvPgo8cGF0aCBkPSJNNDE4LjgwNSA3LjEzOTZDNDE4Ljc4OSA3LjcyNTExIDQxOC43MzMgOC4yOTkxOCA0MTguNTUgOC44NTcxMUM0MTguMjM1IDkuODA0MzEgNDE3LjU1MiAxMC4zMjcgNDE2LjU4NiAxMC41MzE1QzQxNS45MDggMTAuNjc3IDQxNS4yMTcgMTAuNzA0NiA0MTQuNTMxIDEwLjYxMDFDNDEzLjkzNiAxMC41Mjc3IDQxMy4zNyAxMC4zNDY3IDQxMi45NDcgOS44OTA4NUM0MTIuNjU5IDkuNTg0MzEgNDEyLjQ3MiA5LjIxODggNDEyLjM1NiA4LjgxNzhDNDEyLjA4IDcuODU1MDYgNDEyLjA1MyA2Ljg4MDMgNDEyLjI3MiA1LjkwMTQyQzQxMi41MiA0Ljc4NTI2IDQxMy4yMzQgNC4xMTcwMiA0MTQuMzU1IDMuODg1MjhDNDE1LjIxMyAzLjcwODQgNDE2LjA3NSAzLjcwNDU5IDQxNi45MyAzLjk0ODA3QzQxNy45MDcgNC4yMjMyMiA0MTguNTgyIDUuMDAxNDUgNDE4LjY5OCA1Ljk4Nzk1QzQxOC43NDEgNi4zNzMxIDQxOC43NjkgNi43NTgyNiA0MTguODA1IDcuMTM5NlpNNDE3Ljc5NiA3LjE5ODU3QzQxNy44MTEgNy4xOTg1NyA0MTcuODIzIDcuMTk0NzYgNDE3Ljg0IDcuMTk0NzZDNDE3Ljc4OCA2LjczNDggNDE3Ljc2NCA2LjI3MTAzIDQxNy42OCA1LjgxODk5QzQxNy41NTYgNS4xNDY5NSA0MTcuMjIxIDQuNTkyODMgNDE2LjU1NCA0LjMwOTc1QzQxNi4wOCA0LjEwOTQgNDE1LjU4MSA0LjA2NTk4IDQxNS4wNTggNC4xMjkwNUM0MTQuMSA0LjIzOTA1IDQxMy41NjEgNC44MDQ5MSA0MTMuMzEgNS42NTAwM0M0MTMuMTI2IDYuMjYzMTEgNDEzLjA5NCA2Ljg5NTg0IDQxMy4xMjIgNy41Mjg4N0M0MTMuMTQyIDguMDI3ODQgNDEzLjE5OCA4LjUyNzExIDQxMy4zNTggOS4wMTA1M0M0MTMuNTQ5IDkuNTg4MTIgNDEzLjkyNCA5Ljk4MTE5IDQxNC41MDcgMTAuMTg5NUM0MTUuMDE0IDEwLjM2NjMgNDE1LjUzNyAxMC4zNzg0IDQxNi4wNTEgMTAuMjc2QzQxNi43OTggMTAuMTMwNSA0MTcuMzIxIDkuNzEzOTYgNDE3LjU2NCA4Ljk3NTA0QzQxNy43NTIgOC4zOTMzNCA0MTcuODE2IDcuODAzNzMgNDE3Ljc5NiA3LjE5ODU3WiIgZmlsbD0iIzBCM0I2MiIvPgo8cGF0aCBkPSJNNDIxLjQ4OCAxMC4yMDUzQzQyMS40ODggMTAuMzE5NSA0MjEuNDg4IDEwLjQwMTkgNDIxLjQ4OCAxMC40ODg0QzQyMC42MDYgMTAuNDg4NCA0MTkuNzMxIDEwLjQ4ODQgNDE4Ljg0NiAxMC40ODg0QzQxOC44NDYgMTAuNDA1NyA0MTguODQ2IDEwLjMxOTUgNDE4Ljg0NiAxMC4yMjg4QzQxOS4wMTMgMTAuMjA5MiA0MTkuMTc3IDEwLjE4NTcgNDE5LjM0IDEwLjE3NEM0MTkuNTY4IDEwLjE2MjIgNDE5LjY5MiAxMC4wNjc4IDQxOS43MDggOS43NTc0MUM0MTkuNzMxIDkuMzI1MDMgNDE5Ljc0NCA4Ljg5NjQ2IDQxOS43NDQgOC40NjQwN0M0MTkuNzQ4IDcuNDIyNzEgNDE5Ljc1MSA2LjM4MTA2IDQxOS43NDQgNS4zMzk0MUM0MTkuNzQgNS4wNjgzNiA0MTkuNzA0IDQuNzk3MDMgNDE5LjY3NiA0LjUyMjE3QzQxOS42NTYgNC4zMjk0NCA0MTkuNTIgNC4yNjY2NiA0MTkuMzQ1IDQuMjU0NjNDNDE5LjE4MSA0LjI0MjkgNDE5LjAxMyA0LjIzMTE3IDQxOC44MzggNC4yMTk0M0M0MTguODM4IDQuMTI0OTggNDE4LjgzOCA0LjA0MjU1IDQxOC44MzggMy45MjQ2M0M0MTguOTQ5IDMuOTI0NjMgNDE5LjA2NSAzLjkyNDYzIDQxOS4xODEgMy45MjQ2M0M0MTkuOTQzIDMuOTI0NjMgNDIwLjcwOSAzLjkyMDgxIDQyMS40NzIgMy45MzI1NUM0MjEuOTgzIDMuOTQwNDcgNDIyLjQ5MyAzLjk0NDI4IDQyMyA0LjAwMzI0QzQyMy41OTUgNC4wNzM5NCA0MjMuODgyIDQuNDI3NzEgNDIzLjk5OCA0Ljk4OTc1QzQyNC4wNSA1LjIzNzMzIDQyNC4wMjYgNS41MDQ1NiA0MjQuMDE0IDUuNzY0MTZDNDIzLjk4NiA2LjI4Mjc5IDQyMy40NDMgNi44MjkyOSA0MjIuNzQxIDYuOTcwNjhDNDIyLjYyMSA2Ljk5NDE0IDQyMi41MDEgNy4wMjE3MiA0MjIuMzU0IDcuMDUzMTFDNDIyLjU3MyA3LjM4NzIyIDQyMi43NzcgNy42ODk5NSA0MjIuOTc2IDcuOTkyNjhDNDIzLjMyMyA4LjUwNzQ5IDQyMy42NzEgOS4wMjIzIDQyNC4wMjIgOS41MzcxMUM0MjQuMTIyIDkuNjgyNjEgNDI0LjIzOCA5LjgyMDE5IDQyNC4zNTcgOS45NDk4NUM0MjQuNTM3IDEwLjE0MjYgNDI0Ljc3NiAxMC4yMTMzIDQyNS4wMzkgMTAuMjEzM0M0MjUuMDM5IDEwLjMxNTQgNDI1LjAzOSAxMC4zOTgxIDQyNS4wMzkgMTAuNTA4MUM0MjQuODkyIDEwLjUwMDEgNDI0Ljc0OCAxMC40ODg0IDQyNC42MDQgMTAuNDg4NEM0MjQuMzE3IDEwLjQ4ODQgNDI0LjAzNCAxMC40OTIyIDQyMy43NTEgMTAuNTA0QzQyMy42NTUgMTAuNTA4MSA0MjMuNTk1IDEwLjQ4MDUgNDIzLjU0MyAxMC4zOTgxQzQyMi45NzIgOS41MTM2NCA0MjIuMzk0IDguNjMzMzQgNDIxLjgxNSA3Ljc1MjczQzQyMS42NzEgNy41MzI3MiA0MjEuNTIgNy4yOTY4NyA0MjEuMjM2IDcuMjUzNzVDNDIxLjAyOSA3LjIyMjA3IDQyMC44MTcgNy4yNDU4MyA0MjAuNTgyIDcuMjQ1ODNDNDIwLjU4MiA3LjMyMDMzIDQyMC41ODIgNy4zOTg5NSA0MjAuNTgyIDcuNDgxNjhDNDIwLjU5NCA4LjIyMDYgNDIwLjYwMiA4Ljk1OTUzIDQyMC42MTggOS42OTg0NUM0MjAuNjIxIDkuOTY5NSA0MjAuNzA5IDEwLjExODggNDIwLjg3NyAxMC4xNTAyQzQyMS4wMTMgMTAuMTc3OCA0MjEuMTUyIDEwLjE4NTcgNDIxLjI5MiAxMC4xOTc0QzQyMS4zNDggMTAuMjA5MiA0MjEuNDA4IDEwLjIwNTMgNDIxLjQ4OCAxMC4yMDUzWk00MjAuNjAyIDYuOTExNzJDNDIxLjE4OCA2Ljg5MjA2IDQyMS43OTEgNi45OTQxNCA0MjIuMzcgNi43NTgzQzQyMi42MjUgNi42NTI0IDQyMi44MjkgNi40ODcyNSA0MjIuOTQ0IDYuMjQzNDhDNDIzLjE0OCA1LjgxOTAyIDQyMy4xNzYgNS4zNzQ5IDQyMy4wMjQgNC45MzA3OEM0MjIuOTA4IDQuNTkyODUgNDIyLjY2OSA0LjM2MDgzIDQyMi4zMDYgNC4zMDE4NkM0MjEuNzQ3IDQuMjA3NyA0MjEuMTg0IDQuMjU0NjMgNDIwLjYwMiA0LjI3ODM5QzQyMC42MDIgNS4xNTg3MSA0MjAuNjAyIDYuMDE5MzggNDIwLjYwMiA2LjkxMTcyWiIgZmlsbD0iIzBCM0I2MiIvPgo8cGF0aCBkPSJNNDExLjIyNyA0LjEwOTM0QzQxMS4yMjcgNC42NDc2MiA0MTEuMjI3IDUuMTY2NTQgNDExLjIyNyA1LjcwMUM0MTEuMDU1IDUuNzAxIDQxMC44OTEgNS43MDEgNDEwLjcxMiA1LjcwMUM0MTAuNjkyIDUuNTI4MjMgNDEwLjY3NiA1LjM1NTE1IDQxMC42NTYgNS4xODIzN0M0MTAuNjQ4IDUuMTAzNzYgNDEwLjYyOCA1LjAyODk2IDQxMC42MTYgNC45NTAzNUM0MTAuNTYgNC40Nzg2NiA0MTAuMjUzIDQuMjQyODEgNDA5LjgxNCA0LjE1NjU3QzQwOS4zNjMgNC4wNjU5MyA0MDguOTIgNC4wNzM4NCA0MDguNDk3IDQuMjgyMTFDNDA4LjA2NiA0LjQ5NDQ5IDQwNy44NSA0Ljg0NDE2IDQwNy44NTQgNS4zMDQxMUM0MDcuODU0IDUuNzUyMDUgNDA4LjA1IDYuMTIxNjUgNDA4LjQ4MSA2LjMxMDI3QzQwOC44ODggNi40ODcxNSA0MDkuMzExIDYuNjI4NTUgNDA5LjczIDYuNzg5ODlDNDEwLjE2MSA2Ljk1NDc0IDQxMC41OTIgNy4xMTk4OSA0MTAuOTU5IDcuNDA2NzhDNDExLjU5NCA3LjkwMTk0IDQxMS42NTMgOC43MzE1MSA0MTEuMzgyIDkuNDAzNTVDNDExLjEwMyAxMC4wOTkxIDQxMC41MTYgMTAuNDM3MyA0MDkuODEgMTAuNTc4N0M0MDguODI0IDEwLjc3OSA0MDcuODY2IDEwLjYzNzYgNDA2LjkzNiAxMC4yNjhDNDA2LjgyOSAxMC4yMjQ5IDQwNi43NzMgMTAuMTY1OSA0MDYuNzggMTAuMDM2M0M0MDYuODAxIDkuNTcyNTEgNDA2LjgwOSA5LjEwODc0IDQwNi44MjQgOC42NDQ5N0M0MDYuODI0IDguNjAxNTYgNDA2Ljg1NiA4LjUxOTEyIDQwNi44NzYgOC41MTkxMkM0MDcuMDMyIDguNTExMiA0MDcuMTkyIDguNTExMiA0MDcuMzQ3IDguNTIyOTRDNDA3LjM3MSA4LjUyNzA1IDQwNy4zOTUgOC42MTM1OCA0MDcuNDAzIDguNjY0NjJDNDA3LjQ0NyA4Ljk3NDk4IDQwNy40NzkgOS4yODU2MyA0MDcuNTM1IDkuNTkyMTdDNDA3LjU4MyA5Ljg0MzU2IDQwNy43NTEgMTAuMDM2MyA0MDcuOTg2IDEwLjEzNDZDNDA4LjcxMiAxMC40MzczIDQwOS40MjcgMTAuNDI5NCA0MTAuMTEzIDEwLjAxNjZDNDEwLjg3OSA5LjU0OTA1IDQxMC45MTkgOC4yNzk0NyA0MDkuOTg1IDcuODQyOThDNDA5LjUxNCA3LjYyNzA4IDQwOS4wMTUgNy40Njk4NSA0MDguNTMzIDcuMjg1MDRDNDA4LjA3OCA3LjExMTk3IDQwNy42MzEgNi45Mjc0NiA0MDcuMzUxIDYuNTA2ODFDNDA2Ljc0NSA1LjYwMjc0IDQwNy4wMDggNC4yNDY5MSA0MDguNDA5IDMuODg5MDRDNDA5LjI5MSAzLjY2MTExIDQxMC4zNCAzLjc4MzE0IDQxMS4yMjcgNC4xMDkzNFoiIGZpbGw9IiMwQjNCNjIiLz4KPHBhdGggZD0iTTQyNy4wNzEgMy45MzYzMUM0MjcuMDcxIDQuMDIyODQgNDI3LjA3MSA0LjEwOTM4IDQyNy4wNzEgNC4xOTE4MUM0MjYuODgzIDQuMjM5MDMgNDI2LjY5NiA0LjI3MDQyIDQyNi41MiA0LjMzNzNDNDI2LjI3NyA0LjQzMTc2IDQyNi4yMDUgNC41OTI4IDQyNi4zMjggNC44MjA3MkM0MjYuNTIgNS4xNzgzMSA0MjYuNzM2IDUuNTIwMzUgNDI2Ljk0NyA1Ljg2NjJDNDI3LjIzNCA2LjMzMzc4IDQyNy41MjYgNi44MDE2NiA0MjcuODE3IDcuMjY1NDNDNDI3LjgzMyA3LjI5MyA0MjcuODU3IDcuMzEyNjYgNDI3Ljg5MyA3LjM1OTg4QzQyOC4wOTIgNy4wMDk5MyA0MjguMjg0IDYuNjc1ODEgNDI4LjQ3MiA2LjM0NThDNDI4LjcyMyA1LjkwMTY5IDQyOC45NzEgNS40NTc1NyA0MjkuMjE4IDUuMDEzNDVDNDI5LjI2NiA0LjkyNjkyIDQyOS4zMTQgNC44NDAzOCA0MjkuMzUgNC43NTAwM0M0MjkuNDQ5IDQuNDc4NjkgNDI5LjMzOCA0LjI5Nzk5IDQyOS4wNSA0LjI1ODY5QzQyOC45MzkgNC4yNDI4NSA0MjguODI3IDQuMjMxMTEgNDI4LjcwNyA0LjIxNTU2QzQyOC43MDcgNC4xMjExMSA0MjguNzA3IDQuMDI2NjYgNDI4LjcwNyAzLjk0MDQxQzQyOS40MDUgMy45NDA0MSA0MzAuMDg4IDMuOTQwNDEgNDMwLjc2NiAzLjk0MDQxQzQzMC44MTQgNC4yMDc2NSA0MzAuODA2IDQuMTgwMDcgNDMwLjU3NSA0LjI2MjVDNDMwLjM5MSA0LjMyOTM4IDQzMC4yIDQuNDQ3MzEgNDMwLjA3NiA0LjU5MjhDNDI5LjgyIDQuOTA3MjcgNDI5LjU5NyA1LjI0OSA0MjkuMzc3IDUuNTkxMDRDNDI4Ljk2MiA2LjIzOTYyIDQyOC41NTkgNi44OTk5MyA0MjguMTQ0IDcuNTUyMzJDNDI4LjA0OSA3LjcwNTczIDQyNy45ODkgNy44NTg4NiA0MjcuOTkzIDguMDQ3NDdDNDI4LjAwNSA4LjUzODgyIDQyNy45OTMgOS4wMzAxNyA0MjcuOTk3IDkuNTIxNTJDNDI3Ljk5NyA5LjY1MTE4IDQyOC4wMiA5Ljc4MDgzIDQyOC4wNDQgOS45MDY2N0M0MjguMDcyIDEwLjA2NzcgNDI4LjE4IDEwLjE1NDMgNDI4LjM0NCAxMC4xNjZDNDI4LjU1NSAxMC4xODU2IDQyOC43NjMgMTAuMjAxNSA0MjguOTk0IDEwLjIyNDlDNDI4Ljk5OCAxMC4zMTE1IDQyOS4wMDIgMTAuNDAxOCA0MjkuMDA2IDEwLjQ4ODRDNDI4LjAyIDEwLjQ4ODQgNDI3LjA2NyAxMC40ODg0IDQyNi4xMDEgMTAuNDg4NEM0MjYuMTAxIDEwLjQwMTggNDI2LjEwMSAxMC4zMTE1IDQyNi4xMDEgMTAuMjI0OUM0MjYuMzI4IDEwLjIwNTMgNDI2LjU1MiAxMC4xODU2IDQyNi43NzUgMTAuMTYyMkM0MjYuOTg3IDEwLjE0MjUgNDI3LjA2MyAxMC4wNzU2IDQyNy4wODcgOS44NzUyOUM0MjcuMTEgOS42ODI1NiA0MjcuMTI3IDkuNDg2MDIgNDI3LjEzMSA5LjI4OTQ4QzQyNy4xMzkgOC44NzY3NSA0MjcuMTIyIDguNDY0MzEgNDI3LjEzOSA4LjA1MTU4QzQyNy4xNDcgNy44MDQgNDI3LjA4NyA3LjU4MzcxIDQyNi45NTEgNy4zODcxN0M0MjYuMzI0IDYuNDU5NjMgNDI1LjY5OCA1LjUzMjA4IDQyNS4wNjMgNC42MDgzNUM0MjQuOTIgNC40MDAwNyA0MjQuNzA4IDQuMjg2MjYgNDI0LjQ1NyA0LjI0Njk1QzQyNC4yMDUgNC4yMTE0NiA0MjQuMTkzIDQuMTkxOCA0MjQuMjQ5IDMuOTI4MzhDNDI1LjE4NyAzLjkzNjMgNDI2LjEyNSAzLjkzNjMxIDQyNy4wNzEgMy45MzYzMVoiIGZpbGw9IiMwQjNCNjIiLz4KPHBhdGggZD0iTTM0Ny4zNzIgMTMuNjQwOEMzNDcuMDY0IDEzLjY1NjMgMzQ2Ljc3MyAxMy42NzIyIDM0Ni40ODIgMTMuNjg3N0MzNDYuMjc4IDEzLjY5NTYgMzQ2LjE1IDEzLjgwOTcgMzQ2LjA3NCAxMy45ODI1QzM0Ni4wMTEgMTQuMTMxOCAzNDUuOTU5IDE0LjI4NTMgMzQ1Ljg5NSAxNC40NTA0QzM0NS44MzEgMTQuNDUwNCAzNDUuNzYzIDE0LjQ1MDQgMzQ1LjY3MSAxNC40NTA0QzM0NS42OTkgMTQuMDQ1NiAzNDUuNzMxIDEzLjY0NDYgMzQ1Ljc1OSAxMy4yMTYzQzM0NS44MjMgMTMuMjMxOSAzNDUuOTAzIDEzLjIyMzkgMzQ1LjkzNSAxMy4yNTk0QzM0Ni4wNTEgMTMuMzgxMiAzNDYuMTkgMTMuMzgxMiAzNDYuMzM4IDEzLjM4MTJDMzQ3LjM1NSAxMy4zNzc0IDM0OC4zNzMgMTMuMzgxMiAzNDkuMzkxIDEzLjM3NzRDMzQ5LjUwMyAxMy4zNzc0IDM0OS42MTQgMTMuMzU3NyAzNDkuNzI2IDEzLjMzOEMzNDkuNzYyIDEzLjMzMDEgMzQ5LjgxOCAxMy4yOTQ2IDM0OS44MTggMTMuMjc1M0MzNDkuODAyIDEzLjA4NjQgMzQ5Ljk1NCAxMy4xMDIyIDM1MC4wNjUgMTMuMDY2N0MzNTAuMTY1IDEzLjAzNTMgMzUwLjI2NSAxMy4wMDc3IDM1MC4zODUgMTIuOTcyNUMzNTAuMzg1IDEzLjcwNzQgMzUwLjM4NSAxNC40MjI4IDM1MC4zODUgMTUuMTczNUMzNTAuNTA5IDE1LjA4MzEgMzUwLjYwNCAxNS4wMDgzIDM1MC43MDQgMTQuOTQ1NkMzNTAuOTcxIDE0Ljc3MjUgMzUxLjI1OSAxNC42NzgzIDM1MS41ODYgMTQuNzMzMkMzNTIuMTEzIDE0LjgyMzggMzUyLjMxNiAxNS4yMzYzIDM1Mi4zMzYgMTUuN0MzNTIuMzU2IDE2LjE0NDQgMzUyLjM0IDE2LjU5MjQgMzUyLjM0IDE3LjAzNjVDMzUyLjM0IDE3LjQ1MyAzNTIuMzkyIDE3LjUxMiAzNTIuODExIDE3LjU1OTJDMzUyLjgxNSAxNy42MjIgMzUyLjgxOSAxNy42ODUxIDM1Mi44MTkgMTcuNzYzN0MzNTIuMzI0IDE3Ljc2MzcgMzUxLjgzNyAxNy43NjM3IDM1MS4zMzUgMTcuNzYzN0MzNTEuMzM1IDE3LjcwMDYgMzUxLjMzNSAxNy42Mzc4IDM1MS4zMzUgMTcuNTc4OUMzNTEuMzUgMTcuNTY3MSAzNTEuMzU5IDE3LjU1NTQgMzUxLjM3IDE3LjU1NTRDMzUxLjczNCAxNy41MDgyIDM1MS43ODIgMTcuNDU3MSAzNTEuNzgyIDE3LjA5MTZDMzUxLjc4MiAxNi42OTA2IDM1MS43ODIgMTYuMjkzOCAzNTEuNzgyIDE1Ljg5MjhDMzUxLjc4MiAxNS44MTQxIDM1MS43NzMgMTUuNzM1NSAzNTEuNzU4IDE1LjY2MUMzNTEuNjY2IDE1LjE4OTMgMzUxLjMzNSAxNS4wNTk3IDM1MC44NTYgMTUuMTg1MkMzNTAuNzE2IDE1LjIyMDcgMzUwLjU5MiAxNS4zMjY5IDM1MC40NzIgMTUuNDE3MkMzNTAuNDI5IDE1LjQ0ODYgMzUwLjM4OSAxNS41MjM0IDM1MC4zODkgMTUuNTgyNEMzNTAuMzg5IDE2LjEwMSAzNTAuMzgxIDE2LjYxNTggMzUwLjQwMSAxNy4xMzQ4QzM1MC40MTcgMTcuNDk2NSAzNTAuNDUzIDE3LjUxNjEgMzUwLjgzNiAxNy41NjNDMzUwLjg0IDE3LjU5ODUgMzUwLjg1MiAxNy42MzQgMzUwLjg1MiAxNy42NjkyQzM1MC44NTIgMTcuNzAwNiAzNTAuODQ0IDE3LjczMjMgMzUwLjg0IDE3Ljc3MTZDMzUwLjM0MSAxNy43NzE2IDM0OS44NTQgMTcuNzcxNiAzNDkuMzUxIDE3Ljc3MTZDMzQ5LjM1MSAxNy43MDA2IDM0OS4zNTEgMTcuNjM3OCAzNDkuMzUxIDE3LjU3NTFDMzQ5LjM2MyAxNy41NjcxIDM0OS4zNzEgMTcuNTU1NCAzNDkuMzgzIDE3LjU1NTRDMzQ5Ljc3NCAxNy41MTYxIDM0OS44MjYgMTcuNDY0OCAzNDkuODI2IDE3LjA4NzVDMzQ5LjgyNiAxNS45Njc2IDM0OS44MjYgMTQuODQ3MyAzNDkuODI2IDEzLjY5NTZDMzQ5LjIxMSAxMy42OTU2IDM0OC42MDUgMTMuNjk1NiAzNDcuOTc4IDEzLjY5NTZDMzQ3Ljk3OCAxMy43MzExIDM0Ny45NzggMTMuNzkzOSAzNDcuOTc4IDEzLjg1N0MzNDcuOTc4IDE0Ljg3MDggMzQ3Ljk4MiAxNS44ODg5IDM0Ny45NzggMTYuOTAyN0MzNDcuOTc0IDE3LjUwMDMgMzQ4LjA3OCAxNy40ODQ0IDM0OC41NDEgMTcuNTQ3NUMzNDguNTc3IDE3LjU1MTMgMzQ4LjYxNyAxNy41NTU0IDM0OC42NjEgMTcuNTU5MkMzNDguNjYxIDE3LjYzNCAzNDguNjYxIDE3LjY5NjggMzQ4LjY2MSAxNy43NzE2QzM0OC4wMSAxNy43NzE2IDM0Ny4zNiAxNy43NzE2IDM0Ni43MDEgMTcuNzcxNkMzNDYuNjk3IDE3LjcwNDcgMzQ2LjY5MyAxNy42NDE3IDM0Ni42ODkgMTcuNTY3MUMzNDYuODA1IDE3LjU1MTMgMzQ2LjkxMiAxNy41MzE2IDM0Ny4wMjQgMTcuNTE2MUMzNDcuMjQ0IDE3LjQ4NDQgMzQ3LjMyOCAxNy40MDk5IDM0Ny4zNTUgMTcuMTkzN0MzNDcuMzY0IDE3LjEzMDkgMzQ3LjM3MiAxNy4wNjQxIDM0Ny4zNzIgMTYuOTk3MkMzNDcuMzcyIDE1Ljg4ODkgMzQ3LjM3MiAxNC43ODA0IDM0Ny4zNzIgMTMuNjQwOFoiIGZpbGw9IiMwNDA0MDQiLz4KPHBhdGggZD0iTTQwMS45NjggMTcuODM3NUM0MDEuODE2IDE3LjcwNDEgNDAxLjY1MyAxNy41OSA0MDEuNTI5IDE3LjQ0NDhDNDAxLjM5MyAxNy4yODM0IDQwMS40NDEgMTcuMTc3NSA0MDEuNjIxIDE3LjA2NzJDNDAxLjc2NCAxNi45ODEgNDAxLjg5NiAxNi44NzA3IDQwMi4wMiAxNi43NzY1QzQwMS44NzYgMTYuNjM4OSA0MDEuNzI4IDE2LjUzNjkgNDAxLjYyOSAxNi4zOTkzQzQwMS4zMTMgMTUuOTU5IDQwMS40MjUgMTUuMzI2MiA0MDEuODY0IDE1LjAwMzlDNDAyLjI1MSAxNC43MjA4IDQwMi42ODIgMTQuNjIyNSA0MDMuMTM3IDE0Ljc5OTRDNDAzLjM4MSAxNC44OTc3IDQwMy42MTYgMTQuODc4IDQwMy44NTkgMTQuODU4NEM0MDQuMDExIDE0Ljg0MjggNDA0LjE1OSAxNC44MjMyIDQwNC4zMTEgMTQuODA3M0M0MDQuMzQyIDE1LjA4MjUgNDA0LjEwNyAxNS4yMzE4IDQwMy43MTYgMTUuMjAwNEM0MDMuNzY0IDE1LjM2OTQgNDAzLjgzOSAxNS41MzQ1IDQwMy44NTEgMTUuNzA3M0M0MDMuOTE1IDE2LjQ2MjEgNDAzLjI3NyAxNi44MTU4IDQwMi43NzggMTYuODM5M0M0MDIuNjQ2IDE2Ljg0NzIgNDAyLjUxMSAxNi44MzU1IDQwMi4zNzkgMTYuODM1NUM0MDIuMjMxIDE2LjgzNTUgNDAyLjEgMTYuOTM3NiA0MDIuMDg4IDE3LjA3MTNDNDAyLjA3NiAxNy4yMjA2IDQwMi4xNzkgMTcuMjk5MyA0MDIuMjk5IDE3LjMxMUM0MDIuNTcgMTcuMzM0NSA0MDIuODQyIDE3LjMyNjggNDAzLjExMyAxNy4zMzg2QzQwMy4zMTcgMTcuMzUwMyA0MDMuNTI4IDE3LjM1MDMgNDAzLjcyIDE3LjQwNTRDNDA0LjI0MyAxNy41NjI3IDQwNC4zNjIgMTguMDg1NCA0MDQuMTM5IDE4LjU1NjhDNDAzLjc2OCAxOS4zMzkxIDQwMi41MzUgMTkuNzIwMiA0MDEuNzY4IDE5LjI5OThDNDAxLjY5MiAxOS4yNjA1IDQwMS42MjUgMTkuMjA1NCA0MDEuNTYxIDE5LjE1MDVDNDAxLjIwNiAxOC44MzYxIDQwMS4yMSAxOC40NjI2IDQwMS41NzcgMTguMTUyQzQwMS43MTIgMTguMDM4MiA0MDEuODUyIDE3LjkzMiA0MDEuOTY4IDE3LjgzNzVaTTQwMy43NDggMTguMzY4MkM0MDMuNzQ0IDE4LjEzMjQgNDAzLjY0IDE3Ljk3OTIgNDAzLjQwMSAxNy45MDQ0QzQwMy4wNTcgMTcuNzk4MiA0MDIuNzA2IDE3Ljc5NDQgNDAyLjM1OSAxNy44NzY4QzQwMi4xMzUgMTcuOTI4MiA0MDEuODg4IDE4LjIzNDcgNDAxLjg2NCAxOC40NDY4QzQwMS44NDQgMTguNjU5MiA0MDEuOTk2IDE4Ljg4NzEgNDAyLjI2MyAxOS4wMDA5QzQwMi42NDYgMTkuMTYyMyA0MDMuMDM3IDE5LjE1MDUgNDAzLjQwOSAxOC45NTRDNDAzLjYzMiAxOC44MjgxIDQwMy43NDggMTguNjIzNyA0MDMuNzQ4IDE4LjM2ODJaTTQwMy4yNjkgMTUuODE3NkM0MDMuMjczIDE1LjU0NjMgNDAzLjIwOSAxNS4zMDI1IDQwMy4wMDUgMTUuMTA2QzQwMi43OTggMTQuOTA1NiA0MDIuNDc5IDE0LjkwNTYgNDAyLjI3OSAxNS4xMTM5QzQwMS45NiAxNS40NDAxIDQwMS45OTYgMTYuMTc1MiA0MDIuMzQzIDE2LjQ3MzhDNDAyLjU2NiAxNi42NjY1IDQwMi44NDIgMTYuNjU0NSA0MDMuMDUzIDE2LjQ1MDNDNDAzLjIyOSAxNi4yNzM0IDQwMy4yNjkgMTYuMDUzMiA0MDMuMjY5IDE1LjgxNzZaIiBmaWxsPSIjMDQwNDA0Ii8+CjxwYXRoIGQ9Ik0zNjMuMjA3IDE0LjgwMzdDMzYzLjA0MyAxNS4xNzcyIDM2Mi45NiAxNS4yMjQ0IDM2Mi41MzIgMTUuMjAwOUMzNjIuNTY0IDE1LjI3MTYgMzYyLjU5NiAxNS4zMzA2IDM2Mi42MjQgMTUuMzkzNEMzNjIuODk2IDE2LjA4NTEgMzYyLjQwOSAxNi44MDQzIDM2MS42NSAxNi44MzZDMzYxLjUxMSAxNi44Mzk4IDM2MS4zNzEgMTYuODM2IDM2MS4yMzEgMTYuODM2QzM2MS4wODQgMTYuODMxOSAzNjAuOTI0IDE2Ljk0NiAzNjAuOTI0IDE3LjA3NTdDMzYwLjkyNCAxNy4yMTMyIDM2MS4wMiAxNy4yOTk4IDM2MS4xNDggMTcuMzA3NEMzNjEuNDExIDE3LjMyNzEgMzYxLjY3NCAxNy4zMjMyIDM2MS45MzggMTcuMzM5MUMzNjIuMTIxIDE3LjM0NjcgMzYyLjMwOSAxNy4zNTQ2IDM2Mi40ODggMTcuMzkwMUMzNjMuMDE5IDE3LjQ5NjMgMzYzLjE2NyAxNy45MzYzIDM2My4wMzkgMTguMzk2M0MzNjIuOTAzIDE4Ljg4MzUgMzYyLjUyNCAxOS4xNTg3IDM2Mi4wNyAxOS4zMzE4QzM2MS41NjMgMTkuNTI0MiAzNjEuMDQ0IDE5LjU1OTcgMzYwLjU2NSAxOS4yNjExQzM2MC40MTMgMTkuMTY2NiAzNjAuMjg1IDE5LjAwNTYgMzYwLjE5OCAxOC44NDQyQzM2MC4wODYgMTguNjQgMzYwLjEzIDE4LjQyMzkgMzYwLjMwOSAxOC4yNTQ5QzM2MC40NzMgMTguMTAxNSAzNjAuNjQ1IDE3Ljk2MzkgMzYwLjgxMiAxNy44MTg0QzM2MC42ODEgMTcuNzE2MyAzNjAuNTUzIDE3LjYyMTkgMzYwLjQzMyAxNy41MTZDMzYwLjM4MSAxNy40Njg3IDM2MC4zNTMgMTcuMzk4IDM2MC4zMjEgMTcuMzM1QzM2MC4yNTMgMTcuMjEzMiAzNjAuMjkgMTcuMTQ2NCAzNjAuNDE3IDE3LjA3NTdDMzYwLjU4NSAxNi45ODkxIDM2MC43MjggMTYuODYzMyAzNjAuOSAxNi43NDU0QzM2MC40MDEgMTYuNDk0IDM2MC4yNTMgMTYuMTAwOSAzNjAuMzAyIDE1LjcxOTZDMzYwLjM2OSAxNS4xOTY4IDM2MC43MDggMTQuODU4OSAzNjEuMjIzIDE0Ljc0MUMzNjEuNDgzIDE0LjY4MiAzNjEuNzQyIDE0LjY3NDEgMzYxLjk4MiAxNC43ODQxQzM2Mi4yMzcgMTQuOTAyIDM2Mi40OTMgMTQuODYyNyAzNjIuNzU2IDE0LjgzOTJDMzYyLjg5NiAxNC44MzkyIDM2My4wMzUgMTQuODIzNCAzNjMuMjA3IDE0LjgwMzdaTTM2MS42NzggMTcuODE0NkMzNjEuMzU1IDE3LjgxMDUgMzYxLjA2IDE3Ljg2NTYgMzYwLjg0NCAxOC4xNDA4QzM2MC42NDUgMTguMzkyMiAzNjAuNjczIDE4LjY5OSAzNjAuOTMyIDE4Ljg5NTNDMzYxLjMwMyAxOS4xNzgzIDM2MS45ODEgMTkuMTc4MyAzNjIuMzQxIDE4Ljg4MzVDMzYyLjUzNiAxOC43MjI1IDM2Mi42MjggMTguNTE0MiAzNjIuNTc2IDE4LjI1ODdDMzYyLjUyOCAxOC4wMjI5IDM2Mi4zNDkgMTcuOTE2NyAzNjIuMTI5IDE3Ljg2OTRDMzYxLjk4MiAxNy44MzgxIDM2MS44MyAxNy44MzAxIDM2MS42NzggMTcuODE0NlpNMzYyLjEzMyAxNS44MjE5QzM2Mi4xMDEgMTUuNjc2NCAzNjIuMDgyIDE1LjUxOTIgMzYyLjAzIDE1LjM3MzdDMzYxLjk0NiAxNS4xMjYxIDM2MS43MDYgMTQuOTQ5MiAzNjEuNDg3IDE0Ljk1NzJDMzYxLjIzMSAxNC45NjUxIDM2MS4wNjggMTUuMTEwNiAzNjAuOTg0IDE1LjMzNDRDMzYwLjg2IDE1LjY2MDYgMzYwLjg3MiAxNS45OTA5IDM2MS4wNDQgMTYuMjk3NEMzNjEuMTYgMTYuNTAxOSAzNjEuMzM5IDE2LjYzNTQgMzYxLjU5OCAxNi42MDRDMzYxLjg0MiAxNi41NzI2IDM2MS45ODYgMTYuNDE1NCAzNjIuMDU3IDE2LjE5NTNDMzYyLjA4OSAxNi4wNzc0IDM2Mi4xMDUgMTUuOTU1NCAzNjIuMTMzIDE1LjgyMTlaIiBmaWxsPSIjMDQwNDA0Ii8+CjxwYXRoIGQ9Ik0zNjQuMzg0IDE1LjEzNEMzNjQuNjU5IDE1LjAwMDIgMzY0LjkwMyAxNC44NDcxIDM2NS4xNyAxNC43NTY3QzM2NS41NTMgMTQuNjI3MSAzNjYuMTA0IDE0LjgwMzcgMzY2LjI2IDE1LjM1MDJDMzY2LjMxMiAxNS41MzA5IDM2Ni4zMzIgMTUuNzIzNiAzNjYuMzQgMTUuOTA4MUMzNjYuMzUyIDE2LjI4NTYgMzY2LjM0NCAxNi42NjY3IDM2Ni4zNDQgMTcuMDQ4QzM2Ni4zNDQgMTcuNDcyNSAzNjYuMzY3IDE3LjUgMzY2Ljc5NCAxNy41NjY5QzM2Ni43OTkgMTcuNjI1OSAzNjYuODAyIDE3LjY4ODcgMzY2LjgwNyAxNy43NjM1QzM2Ni4zMTIgMTcuNzYzNSAzNjUuODM3IDE3Ljc2MzUgMzY1LjM0NiAxNy43NjM1QzM2NS4zNDYgMTcuNzAwNCAzNjUuMzQ2IDE3LjYzMzggMzY1LjM0NiAxNy41NjY5QzM2NS43NjEgMTcuNDg0MiAzNjUuNzkzIDE3LjQ1MjggMzY1Ljc4OSAxNy4wNDAxQzM2NS43ODUgMTYuNTk2IDM2NS43OTMgMTYuMTQ4IDM2NS43NTcgMTUuNzA3N0MzNjUuNzE3IDE1LjIyMDUgMzY1LjM0MiAxNS4wNzEyIDM2NC44OTUgMTUuMTY5NUMzNjQuNzk5IDE1LjE4OTEgMzY0LjcxMSAxNS4yNDAyIDM2NC42MjcgMTUuMjg3MUMzNjQuNDY4IDE1LjM3NzcgMzY0LjM4NCAxNS40OTE1IDM2NC4zOTIgMTUuNjk2QzM2NC40MTIgMTYuMTUxOCAzNjQuMzk2IDE2LjYxMTggMzY0LjM5NiAxNy4wNzE1QzM2NC4zOTYgMTcuNDYwNyAzNjQuNDQgMTcuNTA4IDM2NC44MzkgMTcuNTYyOEMzNjQuODQzIDE3LjYyMTggMzY0Ljg0NyAxNy42ODQ4IDM2NC44NTEgMTcuNzYzNUMzNjQuMzQ4IDE3Ljc2MzUgMzYzLjg2MSAxNy43NjM1IDM2My4zNyAxNy43NjM1QzM2My4zNyAxNy42OTI1IDM2My4zNyAxNy42Mjk3IDM2My4zNyAxNy41NTlDMzYzLjQxIDE3LjU1NTIgMzYzLjQ0MiAxNy41NTExIDM2My40NzQgMTcuNTQ3M0MzNjMuNzczIDE3LjUwOCAzNjMuODMzIDE3LjQ0NDkgMzYzLjgzNyAxNy4xNDYzQzM2My44MzcgMTYuMDYxNSAzNjMuODM3IDE0Ljk3MjkgMzYzLjgzNyAxMy44ODgxQzM2My44MzcgMTMuNDgzIDM2My44MDUgMTMuNDUxNyAzNjMuMzc0IDEzLjQxMjNDMzYzLjM3IDEzLjM1MzQgMzYzLjM2NiAxMy4yOTQ0IDM2My4zNjIgMTMuMjMxNkMzNjMuNzA5IDEzLjE1MyAzNjQuMDQxIDEzLjA3NDQgMzY0LjM5MiAxMi45OTU4QzM2NC4zODQgMTMuNzExMyAzNjQuMzg0IDE0LjQzMDUgMzY0LjM4NCAxNS4xMzRaIiBmaWxsPSIjMDQwNDA0Ii8+CjxwYXRoIGQ9Ik0zODIuMTI4IDE0LjcyODZDMzgyLjEyOCAxNC44ODIxIDM4Mi4xMjggMTUuMDMxNCAzODIuMTI4IDE1LjIxMjFDMzgyLjMwOCAxNS4wOTggMzgyLjQ2OCAxNSAzODIuNjIzIDE0Ljg5NzZDMzgyLjkzNCAxNC42OTMxIDM4My4yNjIgMTQuNjQ2MiAzODMuNTk3IDE0LjgyNjlDMzgzLjkzNiAxNS4wMDc2IDM4NC4wNDQgMTUuMzI2MiAzODQuMDUyIDE1LjY3OTZDMzg0LjA2NCAxNi4xNTEzIDM4NC4wNTIgMTYuNjIzIDM4NC4wNiAxNy4wOTQ3QzM4NC4wNjQgMTcuNDc5OSAzODQuMDk2IDE3LjUwNzQgMzg0LjQ5MSAxNy41NjIzQzM4NC40OTUgMTcuNjI1NCAzODQuNDk5IDE3LjY4ODEgMzg0LjUwMyAxNy43NjI5QzM4NC4wMiAxNy43NjI5IDM4My41NDUgMTcuNzYyOSAzODMuMDU0IDE3Ljc2MjlDMzgzLjA1NCAxNy42OTk5IDM4My4wNTQgMTcuNjM3MSAzODMuMDU0IDE3LjU2MjNDMzgzLjA4NiAxNy41NTg1IDM4My4xMTQgMTcuNTUwNiAzODMuMTQ2IDE3LjU0NjdDMzgzLjQwNSAxNy41MDc0IDM4My40ODUgMTcuNDUyMyAzODMuNDg5IDE3LjIwMDlDMzgzLjUwMSAxNi43MDU3IDM4My40ODkgMTYuMjA2NSAzODMuNDczIDE1LjcxMTNDMzgzLjQ1NyAxNS4yMTIxIDM4My4wMTQgMTUuMDM1MiAzODIuNTcxIDE1LjIxMjFDMzgyLjUzNSAxNS4yMjc5IDM4Mi40OTkgMTUuMjQ3NiAzODIuNDY0IDE1LjI1OTNDMzgyLjIyNCAxNS4zNjE0IDM4Mi4xIDE1LjUxMDcgMzgyLjEyIDE1Ljc5NzZDMzgyLjE0OCAxNi4yMjIzIDM4Mi4xMjQgMTYuNjQ2OCAzODIuMTI4IDE3LjA3NTFDMzgyLjEzMiAxNy40NzE5IDM4Mi4xNzIgMTcuNTExMyAzODIuNTY3IDE3LjU1ODVDMzgyLjU3MSAxNy42MTc0IDM4Mi41NzUgMTcuNjgwMiAzODIuNTgzIDE3Ljc1ODhDMzgyLjA3NiAxNy43NTg4IDM4MS41ODYgMTcuNzU4OCAzODEuMDc5IDE3Ljc1ODhDMzgxLjA3NSAxNy42OTYxIDM4MS4wNzUgMTcuNjMzMyAzODEuMDcxIDE3LjU3ODFDMzgxLjA5MSAxNy41NjIzIDM4MS4wOTkgMTcuNTUwNiAzODEuMTExIDE3LjU1MDZDMzgxLjUxNCAxNy41MTU0IDM4MS41NTQgMTcuNDgzNyAzODEuNTY2IDE3LjA5NDdDMzgxLjU3OCAxNi42MDM0IDM4MS41NzggMTYuMTEyIDM4MS41NjYgMTUuNjIxQzM4MS41NTggMTUuMjQ3NiAzODEuNTM4IDE1LjIzNTUgMzgxLjE2MyAxNS4xNTY5QzM4MS4xNTggMTUuMTA1OSAzODEuMTU1IDE1LjA0NjkgMzgxLjE1NSAxNC45OTIxQzM4MS40NzQgMTQuOTA5MyAzODEuNzg5IDE0LjgyMzEgMzgyLjEyOCAxNC43Mjg2WiIgZmlsbD0iIzA0MDQwNCIvPgo8cGF0aCBkPSJNMzk3LjU0NSAxNy43Njc1QzM5Ny41NDEgMTcuNjk2OCAzOTcuNTM3IDE3LjYzNzggMzk3LjUzMyAxNy41ODI3QzM5Ny41NjEgMTcuNTY3MSAzOTcuNTY5IDE3LjU1NTQgMzk3LjU4MSAxNy41NTEzQzM5Ny45OTIgMTcuNTA4MiAzOTguMDMxIDE3LjQ2NDcgMzk4LjAzMSAxNy4wNTIzQzM5OC4wMzEgMTYuNTY4NiAzOTguMDMxIDE2LjA4NTIgMzk4LjAzMSAxNS41OTc5QzM5OC4wMzEgMTUuMjkxNCAzOTguMDA3IDE1LjI3MTcgMzk3LjcwOCAxNS4xODE0QzM5Ny42NjggMTUuMTY5NiAzOTcuNjE2IDE1LjEwMjggMzk3LjYyMSAxNS4wNjczQzM5Ny42MjQgMTUuMDI4IDM5Ny42NzYgMTQuOTY5IDM5Ny43MiAxNC45NTczQzM5OC4wMDQgMTQuODc4NyAzOTguMjkxIDE0LjgxMTggMzk4LjU4NiAxNC43MzczQzM5OC41ODYgMTQuODgyNSAzOTguNTg2IDE1LjAzNTkgMzk4LjU4NiAxNS4yMjQ1QzM5OC43OTQgMTUuMDk0OCAzOTguOTczIDE0Ljk3MzEgMzk5LjE2MSAxNC44NTlDMzk5LjY2IDE0LjU2MDQgNDAwLjM0NiAxNC43MzczIDQwMC40OTQgMTUuNDI5QzQwMC41MjIgMTUuNTYyNCA0MDAuNTI2IDE1LjcgNDAwLjUyNiAxNS44Mzc2QzQwMC41MyAxNi4yNTgyIDQwMC41MjYgMTYuNjc0OCA0MDAuNTI2IDE3LjA5NTRDNDAwLjUyNiAxNy40NjQ3IDQwMC41NjYgMTcuNTEyIDQwMC45NDkgMTcuNTU5MkM0MDAuOTQ5IDE3LjYyMiA0MDAuOTQ5IDE3LjY4ODkgNDAwLjk0OSAxNy43NzU0QzQwMC43MDYgMTcuNzc1NCA0MDAuNDY2IDE3Ljc3NTQgNDAwLjIzMSAxNy43NzU0QzM5OS45OTkgMTcuNzc1NCAzOTkuNzY3IDE3Ljc3NTQgMzk5LjUyNCAxNy43NzU0QzM5OS41MjQgMTcuNzAwNiAzOTkuNTI0IDE3LjYzNzggMzk5LjUyNCAxNy41NTkyQzM5OS41NzYgMTcuNTUxMyAzOTkuNjI0IDE3LjU0NzUgMzk5LjY3NiAxNy41Mzk1QzM5OS44NzkgMTcuNTAwMiAzOTkuOTQ3IDE3LjQyNTQgMzk5Ljk1MSAxNy4yMjEzQzM5OS45NTUgMTYuNzI5OSAzOTkuOTU5IDE2LjIzODYgMzk5Ljk0NyAxNS43NDcyQzM5OS45MzUgMTUuMjkxNCAzOTkuNTkyIDE1LjA1NTUgMzk5LjE0NSAxNS4xODE0QzM5OS4wOTMgMTUuMTk2OSAzOTkuMDQ1IDE1LjIxMjggMzk4Ljk5NyAxNS4yMzI0QzM5OC43MjIgMTUuMzQ2MiAzOTguNTUgMTUuNDk5NyAzOTguNTgyIDE1Ljg0MTdDMzk4LjYyMiAxNi4yNTAzIDM5OC41OSAxNi42NjY5IDM5OC41OSAxNy4wNzk2QzM5OC41OSAxNy40NzI3IDM5OC42MyAxNy41MTYxIDM5OS4wMzcgMTcuNTYzQzM5OS4wMzcgMTcuNjI2MSAzOTkuMDM3IDE3LjY5MyAzOTkuMDM3IDE3Ljc3MTNDMzk4LjUzNCAxNy43Njc1IDM5OC4wNDcgMTcuNzY3NSAzOTcuNTQ1IDE3Ljc2NzVaIiBmaWxsPSIjMDQwNDA0Ii8+CjxwYXRoIGQ9Ik0zNTYuNDE1IDE1LjA1MTNDMzU2LjQxNSAxNC45ODQ0IDM1Ni40MTUgMTQuOTMzNCAzNTYuNDE1IDE0Ljg3NDRDMzU2Ljc0MiAxNC44MzkgMzU3LjA2MSAxNC44MDM4IDM1Ny40MDEgMTQuNzY4M0MzNTcuNDAxIDE0LjkwMiAzNTcuNDAxIDE1LjA0MzQgMzU3LjQwMSAxNS4xODQ4QzM1Ny40MDEgMTUuNzE1NCAzNTcuMzkzIDE2LjI0NjEgMzU3LjQwNSAxNi43NzI3QzM1Ny40MTcgMTcuMjQ4NSAzNTcuNzY0IDE3LjQ4ODEgMzU4LjIyNyAxNy4zNTg0QzM1OC4zMzUgMTcuMzI3MSAzNTguNDM0IDE3LjI3OTggMzU4LjUzNCAxNy4yMjg4QzM1OC42NyAxNy4xNTQgMzU4LjczNCAxNy4wNTE5IDM1OC43MyAxNi44ODI5QzM1OC43MTQgMTYuNDI2OCAzNTguNzI2IDE1Ljk2NzEgMzU4LjcyNiAxNS41MDcyQzM1OC43MjYgMTUuMTY1MSAzNTguNzIyIDE1LjE1NzUgMzU4LjM3NCAxNS4wODY1QzM1OC4zMjMgMTUuMDc0OCAzNTguMjcxIDE1LjA2NjkgMzU4LjIwNyAxNS4wNTUxQzM1OC4yMDMgMTUuMDAwMyAzNTguMjAzIDE0Ljk0NTEgMzU4LjE5OSAxNC45MDJDMzU4LjIxMSAxNC44ODYyIDM1OC4yMTUgMTQuODc0NCAzNTguMjE5IDE0Ljg3NDRDMzU4LjU2NiAxNC44MzkgMzU4LjkxNyAxNC44MDM4IDM1OS4yOTIgMTQuNzY4M0MzNTkuMjkyIDE0LjgxOTMgMzU5LjI5MiAxNC44NzQ0IDM1OS4yOTIgMTQuOTI5M0MzNTkuMjkyIDE1LjYyMTMgMzU5LjI5MiAxNi4zMTY4IDM1OS4yOTIgMTcuMDA4NUMzNTkuMjkyIDE3LjMyNzEgMzU5LjM1MiAxNy4zODE5IDM1OS42NzYgMTcuMzg2QzM1OS43MTYgMTcuMzg2IDM1OS43NTEgMTcuMzg5OCAzNTkuODAzIDE3LjM5MzZDMzU5LjgwMyAxNy40NjQ2IDM1OS44MDMgMTcuNTI3NCAzNTkuODAzIDE3LjU4NjRDMzU5LjQ2IDE3LjY2ODggMzU5LjEyMSAxNy43NTE1IDM1OC43NDYgMTcuODQxOUMzNTguNzQ2IDE3LjY4MDUgMzU4Ljc0NiAxNy41MjM2IDM1OC43NDYgMTcuMzQyNkMzNTguNTIyIDE3LjQ4NDMgMzU4LjMzOSAxNy42MDk4IDM1OC4xNDMgMTcuNzEyMkMzNTcuNDg0IDE4LjA1ODEgMzU2Ljg1IDE3LjY4MDUgMzU2LjgzOCAxNi45NDE5QzM1Ni44MzQgMTYuNTIxMyAzNTYuODM4IDE2LjEwNDcgMzU2LjgzOCAxNS42ODQxQzM1Ni44MzggMTUuNjQ0OCAzNTYuODM4IDE1LjYwNTUgMzU2LjgzOCAxNS41NjYxQzM1Ni44MzQgMTUuMTY5MyAzNTYuODE4IDE1LjE0NTUgMzU2LjQxNSAxNS4wNTEzWiIgZmlsbD0iIzA0MDQwNCIvPgo8cGF0aCBkPSJNMzcxLjQyMSAxNS4wNTExQzM3MS40MjEgMTQuOTk1OSAzNzEuNDIxIDE0Ljk0MDggMzcxLjQyMSAxNC44NzQyQzM3MS43NDggMTQuODM4NyAzNzIuMDcyIDE0LjgwMzIgMzcyLjQxMSAxNC43NjhDMzcyLjQxMSAxNC45ODAxIDM3Mi40MTEgMTUuMjAwNCAzNzIuNDExIDE1LjQyMDRDMzcyLjQxMSAxNS44NTI4IDM3Mi40MTEgMTYuMjg1MiAzNzIuNDExIDE2LjcxNzZDMzcyLjQxNSAxNy4yNTk5IDM3Mi44MDYgMTcuNTI3MiAzNzMuMzIxIDE3LjM0MjRDMzczLjY1NiAxNy4yMjA2IDM3My43NDggMTcuMDk0OCAzNzMuNzQ0IDE2Ljc0NDhDMzczLjc0IDE2LjMwMDcgMzczLjc0IDE1Ljg1NjYgMzczLjcyOCAxNS40MDg3QzM3My43MjQgMTUuMTYxMSAzNzMuNyAxNS4xNDUzIDM3My40NDEgMTUuMDk4QzM3My4zNjkgMTUuMDg2MyAzNzMuMjk3IDE1LjA3MDcgMzczLjIxMyAxNS4wNTExQzM3My4yMDkgMTUuMDAzOSAzNzMuMjA1IDE0Ljk0ODcgMzczLjIwMSAxNC44NzQyQzM3My41NjggMTQuODM4NyAzNzMuOTI3IDE0LjgwMzIgMzc0LjI5OSAxNC43NjM5QzM3NC4yOTkgMTUuMjU1MyAzNzQuMjk5IDE1Ljc0NjYgMzc0LjI5OSAxNi4yMzc5QzM3NC4yOTkgMTYuNTIxIDM3NC4yOTEgMTYuOCAzNzQuMzA2IDE3LjA4MzFDMzc0LjMyMiAxNy4zMzg2IDM3NC4zODIgMTcuMzgxNyAzNzQuNjQyIDE3LjM4NTVDMzc0LjY5NCAxNy4zODU1IDM3NC43NDYgMTcuMzg5NiAzNzQuODA5IDE3LjM5MzRDMzc0LjgwOSAxNy40NjQxIDM3NC44MDkgMTcuNTI3MiAzNzQuODA5IDE3LjU5QzM3NC40NjIgMTcuNjcyNyAzNzQuMTIzIDE3Ljc1NTEgMzczLjc2IDE3Ljg0MTZDMzczLjc1MiAxNy42ODgyIDM3My43NDQgMTcuNTM1MSAzNzMuNzM2IDE3LjM1MDNDMzczLjY3NiAxNy4zOTM0IDM3My42MzIgMTcuNDI0OCAzNzMuNTg4IDE3LjQ1MjRDMzczLjM3NyAxNy41NzQ0IDM3My4xNzcgMTcuNzMxMyAzNzIuOTU0IDE3LjgwNjFDMzcyLjM3NSAxNy45OTEgMzcxLjg2NCAxNy41OTc5IDM3MS44NTIgMTYuOTgwN0MzNzEuODQ0IDE2LjUxNjkgMzcxLjg0OCAxNi4wNDkzIDM3MS44NDggMTUuNTg1NkMzNzEuODQ4IDE1LjE2NDkgMzcxLjg0IDE1LjE1MzIgMzcxLjQyMSAxNS4wNTExWiIgZmlsbD0iIzA0MDQwNCIvPgo8cGF0aCBkPSJNMzU0LjcxNCAxNC43MTc0QzM1NS41NDggMTQuNzUyNiAzNTYuMjExIDE1LjM1MzkgMzU2LjE5NSAxNi4yNjU5QzM1Ni4xNzkgMTcuMjk5NyAzNTUuNDY4IDE3Ljg0MiAzNTQuNjU4IDE3Ljg0OTdDMzUzLjggMTcuODU3NiAzNTMuMTQ2IDE3LjE3NzYgMzUzLjE1NCAxNi4zMzI4QzM1My4xNjYgMTUuMjQzOSAzNTMuOTg4IDE0LjcyOTEgMzU0LjcxNCAxNC43MTc0Wk0zNTUuNTUyIDE2LjQyMzJDMzU1LjUyOCAxNi4wNTc3IDM1NS40ODUgMTUuNjk5OCAzNTUuMjg1IDE1LjM4NTNDMzU1LjEyMSAxNS4xMjYgMzU0Ljg5OCAxNC45NjUgMzU0LjU2NiAxNC45ODg0QzM1NC4yNjMgMTUuMDA4MSAzNTQuMDggMTUuMTg5MSAzNTMuOTcyIDE1LjQ0MDVDMzUzLjcwNSAxNi4wNTM1IDM1My43NzIgMTYuNjU0OSAzNTQuMTA4IDE3LjIyMUMzNTQuMjc1IDE3LjUwMzggMzU0LjU2MyAxNy42NDkzIDM1NC45MDYgMTcuNTgyNEMzNTUuMjIxIDE3LjUyMzUgMzU1LjM4MSAxNy4yOTE3IDM1NS40NTMgMTcuMDAwN0MzNTUuNDkzIDE2LjgwODMgMzU1LjUxNiAxNi42MTU2IDM1NS41NTIgMTYuNDIzMloiIGZpbGw9IiMwNDA0MDQiLz4KPHBhdGggZD0iTTM2OS43NCAxNC43OTY1QzM2OS43MzYgMTQuMTY3NiAzNjkuOTM1IDEzLjY0ODYgMzcwLjQzOCAxMy4yNzE0QzM3MC43MTggMTMuMDYzMSAzNzEuMDIxIDEyLjkwMjEgMzcxLjM5MiAxMy4wMjc2QzM3MS40NzIgMTMuMDU1MiAzNzEuNTUyIDEzLjA5NDUgMzcxLjYxNiAxMy4xNDU2QzM3MS43ODMgMTMuMjc1NSAzNzEuNzUxIDEzLjU1ODMgMzcxLjU2IDEzLjYzMzFDMzcxLjUwNCAxMy42NTY2IDM3MS40MTIgMTMuNjIxNCAzNzEuMzQ4IDEzLjU4OTdDMzcxLjI0OCAxMy41NDI3IDM3MS4xNjUgMTMuNDYgMzcxLjA2MSAxMy40MTY5QzM3MC43NTggMTMuMjg3MiAzNzAuNDgyIDEzLjM5MzQgMzcwLjQxIDEzLjcwNzZDMzcwLjMzIDE0LjA1MzcgMzcwLjMxNSAxNC40MTUxIDM3MC4yNzEgMTQuNzkyNEMzNzAuNTc4IDE0Ljc5MjQgMzcwLjg0MSAxNC43OTI0IDM3MS4xMDEgMTQuNzkyNEMzNzEuMTU3IDE1LjA2NzUgMzcxLjEyOSAxNS4xMDMgMzcwLjg3NyAxNS4xMDNDMzcwLjY5NCAxNS4xMDMgMzcwLjUxIDE1LjEwMyAzNzAuMzE1IDE1LjEwM0MzNzAuMzE1IDE1LjgxODUgMzcwLjMxNSAxNi41MTc4IDM3MC4zMTUgMTcuMjEzNkMzNzAuMzE1IDE3LjQwMjIgMzcwLjQxOCAxNy41MDA1IDM3MC42MDIgMTcuNTI0M0MzNzAuNjk0IDE3LjUzNiAzNzAuNzg1IDE3LjU0NzcgMzcwLjg5MyAxNy41NTk1QzM3MC44OTcgMTcuNjE4NCAzNzAuOTAxIDE3LjY4MTIgMzcwLjkwNSAxNy43NTk4QzM3MC4zNSAxNy43NTk4IDM2OS44MTIgMTcuNzU5OCAzNjkuMjYxIDE3Ljc1OThDMzY5LjI2MSAxNy42OTcgMzY5LjI2MSAxNy42MzQzIDM2OS4yNjEgMTcuNTY3NEMzNjkuMjczIDE3LjU1OTUgMzY5LjI4MSAxNy41NDc3IDM2OS4yOTMgMTcuNTQ3N0MzNjkuNjk2IDE3LjUxNjMgMzY5Ljc0IDE3LjQ3MjkgMzY5Ljc0IDE3LjA2ODFDMzY5Ljc0IDE2LjQxOTggMzY5Ljc0IDE1Ljc3NTEgMzY5Ljc0IDE1LjA5OTJDMzY5LjYxNiAxNS4wOTkyIDM2OS41IDE1LjEwMyAzNjkuMzg1IDE1LjA5NTFDMzY5LjM0MSAxNS4wOTEzIDM2OS4yOTcgMTUuMDYzNyAzNjkuMjUzIDE1LjA0NDFDMzY5LjI2OSAxNS4wMDQ4IDM2OS4yODUgMTQuOTY1NCAzNjkuMzAxIDE0LjkzQzM2OS4zOTcgMTQuNzU3MiAzNjkuNTcyIDE0LjgxMiAzNjkuNzQgMTQuNzk2NVoiIGZpbGw9IiMwNDA0MDQiLz4KPHBhdGggZD0iTTM4OC4zMTggMTYuMTI4MUMzODguMzMgMTYuNTkxOSAzODguNDQyIDE2Ljk5NjcgMzg4Ljg2OSAxNy4yMzI1QzM4OS4zMjggMTcuNDg4IDM4OS43MzEgMTcuMzQyNSAzOTAuMTAyIDE3LjAzNkMzOTAuMjQyIDE3LjEzNDMgMzkwLjI0NiAxNy4yMjQ2IDM5MC4xMjIgMTcuMzM4N0MzODkuODkxIDE3LjU1ODcgMzg5LjYzOSAxNy43NDczIDM4OS4zMiAxNy44MjIxQzM4OC43MjEgMTcuOTU5NyAzODguMTM1IDE3LjYzNzMgMzg3Ljg3OSAxNy4wNDc3QzM4Ny41MTIgMTYuMTk4OCAzODcuOTI3IDE1LjE2NTEgMzg4Ljc2OSAxNC44MTU0QzM4OS40ODggMTQuNTE2NSAzOTAuMjc0IDE1LjAyMzcgMzkwLjI2NiAxNS43NzQzQzM5MC4yNjYgMTUuOTQzMyAzOTAuMTk0IDE2LjAwNjEgMzkwLjAzIDE2LjAxODFDMzg5LjQ3MiAxNi4wNDk1IDM4OC45MDkgMTYuMDg4OCAzODguMzE4IDE2LjEyODFaTTM4OC4zNjIgMTUuNzc4MkMzODguNzYxIDE1Ljc3ODIgMzg5LjE1MyAxNS43ODIzIDM4OS41NDQgMTUuNzc0M0MzODkuNTgzIDE1Ljc3NDMgMzg5LjY0MyAxNS43MTU0IDM4OS42NTEgMTUuNjc2MUMzODkuNjk1IDE1LjQ2NzggMzg5LjU0NyAxNS4xODQ3IDM4OS4zNDQgMTUuMDY2OEMzODkuMTQ4IDE0Ljk1NjggMzg4LjkyMSAxNC45Njg1IDM4OC43MzMgMTUuMTE0QzM4OC41MSAxNS4yOTA5IDM4OC4zOTggMTUuNTI2OCAzODguMzYyIDE1Ljc3ODJaIiBmaWxsPSIjMDQwNDA0Ii8+CjxwYXRoIGQ9Ik0zNzguODQ0IDEzLjYwMTZDMzc4Ljg0NCAxMy41MzA2IDM3OC44NDQgMTMuNDcxNiAzNzguODQ0IDEzLjM5NzFDMzc5LjQ1IDEzLjM5NzEgMzgwLjA1NyAxMy4zOTcxIDM4MC42OCAxMy4zOTcxQzM4MC42OCAxMy40NTYxIDM4MC42OCAxMy41MjY4IDM4MC42OCAxMy42MDE2QzM4MC41OTYgMTMuNjEzMyAzODAuNTEyIDEzLjYyNSAzODAuNDI4IDEzLjYzNjhDMzgwLjE0OSAxMy42ODAyIDM4MC4wNzcgMTMuNzcwNSAzODAuMDczIDE0LjA2MTJDMzgwLjA2OSAxNS4wNzUzIDM4MC4wNjkgMTYuMDg5NCAzODAuMDczIDE3LjEwMzRDMzgwLjA3MyAxNy4zODI0IDM4MC4xNjkgMTcuNDc2OSAzODAuNDQ4IDE3LjUwODNDMzgwLjUyIDE3LjUxNjIgMzgwLjU5MiAxNy41MzE3IDM4MC42ODQgMTcuNTQ3NkMzODAuNjg4IDE3LjYxNDQgMzgwLjY5MiAxNy42ODEgMzgwLjY5NiAxNy43NjM4QzM4MC4wNzMgMTcuNzYzOCAzNzkuNDc0IDE3Ljc2MzggMzc4Ljg1MiAxNy43NjM4QzM3OC44NDggMTcuNjk2OSAzNzguODQ0IDE3LjYzIDM3OC44NCAxNy41NDc2QzM3OC45NTIgMTcuNTMxNyAzNzkuMDQ3IDE3LjUyIDM3OS4xNDMgMTcuNTA4M0MzNzkuMzExIDE3LjQ4NDUgMzc5LjQzIDE3LjQxIDM3OS40NDcgMTcuMjI5M0MzNzkuNDU0IDE3LjEzODYgMzc5LjQ3IDE3LjA0ODMgMzc5LjQ3IDE2Ljk1NzlDMzc5LjQ3IDE2LjAyMjUgMzc5LjQ3IDE1LjA4NyAzNzkuNDcgMTQuMTUxNkMzNzkuNDcgMTQuMTAwNSAzNzkuNDcgMTQuMDQ1NyAzNzkuNDYyIDEzLjk5NDNDMzc5LjQxOSAxMy43MzUgMzc5LjM3NSAxMy42OTU3IDM3OS4xMTUgMTMuNjQwOUMzNzkuMDMxIDEzLjYyMTIgMzc4Ljk0OCAxMy42MTcxIDM3OC44NDQgMTMuNjAxNloiIGZpbGw9IiMwNDA0MDQiLz4KPHBhdGggZD0iTTM5MC43ODEgMTYuODE5N0MzOTAuODY1IDE2LjggMzkwLjkyNCAxNi43ODQ1IDM5MC45NzYgMTYuNzY4NkMzOTEuMDkyIDE2Ljk2NTIgMzkxLjE5MiAxNy4xNjE3IDM5MS4zMiAxNy4zMzg2QzM5MS40MzkgMTcuNTAzNyAzOTEuNjE1IDE3LjU5NDEgMzkxLjgzIDE3LjU5NDFDMzkyLjA0NiAxNy41OTQxIDM5Mi4xOTMgMTcuNDk1OCAzOTIuMjg1IDE3LjMwNzJDMzkyLjM3MyAxNy4xMjYyIDM5Mi4zMjUgMTYuOTU3MiAzOTIuMTk4IDE2LjgyMzhDMzkyLjEwNiAxNi43MjU1IDM5MS45ODIgMTYuNjU0NSAzOTEuODYyIDE2LjU4NzlDMzkxLjcwNiAxNi41MDE0IDM5MS41NDMgMTYuNDM0NSAzOTEuMzg3IDE2LjM0OEMzOTEuMDY0IDE2LjE2MzUgMzkwLjg2OCAxNS45MDM5IDM5MC45MTYgMTUuNTE0OUMzOTAuOTY0IDE1LjExOCAzOTEuMjIgMTQuODg5OCAzOTEuNTg3IDE0Ljc3NkMzOTEuODcgMTQuNjg1NiAzOTIuMTU4IDE0LjcwOTEgMzkyLjQ0NSAxNC43OTE1QzM5Mi41NjQgMTQuODI3IDM5Mi42MTYgMTQuODkzOSAzOTIuNjQgMTUuMDAzOUMzOTIuNjc2IDE1LjE4ODcgMzkyLjcxMiAxNS4zNzMyIDM5Mi43NTIgMTUuNTY1OUMzOTIuNjggMTUuNTg5NCAzOTIuNjIxIDE1LjYxMzIgMzkyLjU1MyAxNS42MzY2QzM5Mi40OTMgMTUuNTE4NyAzOTIuNDQ1IDE1LjQwODcgMzkyLjM4MSAxNS4zMDI1QzM5Mi4yODUgMTUuMTM3NiAzOTIuMTQ5IDE1LjAxOTcgMzkxLjk1NCAxNC45ODQyQzM5MS43MzUgMTQuOTQ0OSAzOTEuNTQ3IDE1LjAyMzUgMzkxLjQ1NSAxNS4yMDgzQzM5MS4zNjMgMTUuMzkyOSAzOTEuMzk1IDE1LjYwOSAzOTEuNTY3IDE1LjczOUMzOTEuNzE1IDE1Ljg0OSAzOTEuODgyIDE1LjkyMzUgMzkyLjA0NiAxNi4wMUMzOTIuMTg1IDE2LjA4NDkgMzkyLjMzNyAxNi4xMzk3IDM5Mi40NjUgMTYuMjI2MkMzOTMuMDM5IDE2LjYwMzUgMzkzLjAwOCAxNy4zNjIxIDM5Mi4zOTcgMTcuNjg0NEMzOTEuOTM4IDE3LjkyNDEgMzkxLjQ2NyAxNy45MTI0IDM5MS4wMDggMTcuNjc2NUMzOTAuOTQ4IDE3LjY0NTEgMzkwLjg5MiAxNy41NjY1IDM5MC44OCAxNy41MDM3QzM5MC44MzYgMTcuMjc5NiAzOTAuODEzIDE3LjA1MTcgMzkwLjc4MSAxNi44MTk3WiIgZmlsbD0iIzA0MDQwNCIvPgo8cGF0aCBkPSJNMzc2LjY3MyAxNy41NTlDMzc2LjY3MyAxNy42MzM4IDM3Ni42NzMgMTcuNjk2NiAzNzYuNjczIDE3Ljc2NzNDMzc2LjE2MiAxNy43NjczIDM3NS42NTEgMTcuNzY3MyAzNzUuMTMyIDE3Ljc2NzNDMzc1LjEzMiAxNy42OTY2IDM3NS4xMzIgMTcuNjMzOCAzNzUuMTMyIDE3LjU3NDhDMzc1LjE0OCAxNy41NjY5IDM3NS4xNTYgMTcuNTU1MiAzNzUuMTY4IDE3LjU1MTFDMzc1LjU0MyAxNy41MTU5IDM3NS42MDMgMTcuNDY0NSAzNzUuNjAzIDE3LjA5NTJDMzc1LjYxMSAxNi4wMzM5IDM3NS42MDcgMTQuOTcyOSAzNzUuNjA3IDEzLjkxMTZDMzc1LjYwNyAxMy40NzkyIDM3NS41NzkgMTMuNDUxNyAzNzUuMTM2IDEzLjQwNDdDMzc1LjEzNiAxMy4zNDU4IDM3NS4xMzYgMTMuMjgyNyAzNzUuMTM2IDEzLjIyNzhDMzc1LjQ3NSAxMy4xNTMgMzc1LjgxMSAxMy4wNzgyIDM3Ni4xNjYgMTIuOTk1OEMzNzYuMTY2IDEzLjA3MDYgMzc2LjE2NiAxMy4xNDUxIDM3Ni4xNjYgMTMuMjE5OUMzNzYuMTY2IDE0LjQ3NzUgMzc2LjE2NiAxNS43MzUzIDM3Ni4xNjYgMTYuOTkzMUMzNzYuMTY2IDE3LjAwNDkgMzc2LjE2NiAxNy4wMjA0IDM3Ni4xNjYgMTcuMDMyNUMzNzYuMTY2IDE3LjQ1MjggMzc2LjIzIDE3LjUxOTcgMzc2LjY3MyAxNy41NTlaIiBmaWxsPSIjMDQwNDA0Ii8+CjxwYXRoIGQ9Ik0zODYuMTMxIDE3LjgxODFDMzg2LjA1OSAxNy44MTgxIDM4NS45ODcgMTcuODE4MSAzODUuOTE1IDE3LjgxODFDMzg1LjYxNiAxNy4wODMzIDM4NS4zMTcgMTYuMzU2MSAzODUuMDE3IDE1LjYyODlDMzg0Ljk5NCAxNS41NzQgMzg0Ljk3IDE1LjUyMjcgMzg0Ljk1IDE1LjQ2NzhDMzg0Ljg1OCAxNS4yMDgyIDM4NC43MDIgMTUuMDIzNyAzODQuMzkxIDE1LjAyMzdDMzg0LjM5MSAxNC45NDUxIDM4NC4zOTEgMTQuODg2MSAzODQuMzkxIDE0LjgxMTNDMzg0Ljg2MiAxNC44MTEzIDM4NS4zMjUgMTQuODExMyAzODUuODAzIDE0LjgxMTNDMzg1LjgwMyAxNC44NzQ0IDM4NS44MDMgMTQuOTM3MiAzODUuODAzIDE0Ljk5MjNDMzg1Ljc4NCAxNS4wMDQxIDM4NS43NzYgMTUuMDE5NiAzODUuNzY0IDE1LjAxOTZDMzg1LjQ0NCAxNS4wNjY4IDM4NS40MjkgMTUuMDg2NSAzODUuNTQgMTUuMzg5MkMzODUuNzQgMTUuOTE1OCAzODUuOTQ3IDE2LjQ0MjYgMzg2LjE3MSAxNy4wMTIzQzM4Ni4yMjcgMTYuODc1IDM4Ni4yNyAxNi43NzY3IDM4Ni4zMSAxNi42Nzg0QzM4Ni40NTggMTYuMjg5MiAzODYuNjEgMTUuOTAwMiAzODYuNzUzIDE1LjUwNzFDMzg2Ljg4OSAxNS4xMjU4IDM4Ni44NjUgMTUuMDg2NSAzODYuNDcgMTUuMDA0MUMzODYuNDcgMTQuOTQ1MSAzODYuNDcgMTQuODgyIDM4Ni40NyAxNC44MDc1QzM4Ni44NzcgMTQuODA3NSAzODcuMjg0IDE0LjgwNzUgMzg3LjcwMyAxNC44MDc1QzM4Ny43MDMgMTQuODcwMyAzODcuNzAzIDE0Ljk0MSAzODcuNzAzIDE1LjAxOTZDMzg3LjQgMTUuMDEyIDM4Ny4yNDQgMTUuMTg4NiAzODcuMTQxIDE1LjQzNjRDMzg2LjgyMSAxNi4xOTA5IDM4Ni41MDIgMTYuOTQ5NSAzODYuMTc5IDE3LjcwNDNDMzg2LjE2MyAxNy43NDM2IDM4Ni4xNDcgMTcuNzc4OCAzODYuMTMxIDE3LjgxODFaIiBmaWxsPSIjMDQwNDA0Ii8+CjxwYXRoIGQ9Ik0zNjcuNDIxIDE1LjA4MjVDMzY3LjI0MSAxNS4wODI1IDM2Ny4wNzggMTUuMDgyNSAzNjYuODk4IDE1LjA4MjVDMzY3LjAzNCAxNC44MjMyIDM2Ny4wNTggMTQuODExMSAzNjcuNDMzIDE0Ljc5NTZDMzY3LjI5NyAxNC4zOTA4IDM2Ny41NjEgMTQuMTUwOCAzNjcuODI0IDEzLjkxOTFDMzY3Ljg1NiAxMy44OTE1IDM2Ny45MTIgMTMuODkxNSAzNjcuOTc2IDEzLjg3MTlDMzY3Ljk3NiAxNC4xOTAxIDM2Ny45NzYgMTQuNDg0OSAzNjcuOTc2IDE0Ljc5MTVDMzY4LjIzOSAxNC43OTE1IDM2OC40OTUgMTQuNzkxNSAzNjguNzQ2IDE0Ljc5MTVDMzY4Ljg0MiAxNS4wMjM1IDM2OC43OTQgMTUuMTAyMSAzNjguNTc0IDE1LjEwMjFDMzY4LjM4MyAxNS4xMDIxIDM2OC4xOTEgMTUuMTAyMSAzNjcuOTggMTUuMTAyMUMzNjcuOTggMTUuNDE2NiAzNjcuOTggMTUuNzIzMSAzNjcuOTggMTYuMDI1OUMzNjcuOTggMTYuMjkzMSAzNjcuOTc2IDE2LjU2NDEgMzY3Ljk4IDE2LjgzMTRDMzY3Ljk4IDE2LjkyMiAzNjcuOTkyIDE3LjAxMjQgMzY4LjAxNiAxNy4xMDI3QzM2OC4wOTIgMTcuMzg5NiAzNjguMjU5IDE3LjQ3OTkgMzY4LjU1IDE3LjQwMTNDMzY4LjYyNiAxNy4zODE3IDM2OC43MDIgMTcuMzU0MSAzNjguNzkgMTcuMzI2OEMzNjguODE0IDE3LjM4MTcgMzY4LjgzOCAxNy40MzY4IDM2OC44NyAxNy41MTEzQzM2OC42NzQgMTcuNjEzNyAzNjguNDkgMTcuNzM1NCAzNjguMjkxIDE3LjgwNjFDMzY3Ljg4IDE3Ljk0NzggMzY3LjQzMyAxNy43Mjc1IDM2Ny40MjEgMTcuMTQ5OUMzNjcuNDA5IDE2LjUwOTMgMzY3LjQxNyAxNS44Njg2IDM2Ny40MTcgMTUuMjI4QzM2Ny40MjEgMTUuMTkyNSAzNjcuNDIxIDE1LjE1MzIgMzY3LjQyMSAxNS4wODI1WiIgZmlsbD0iIzA0MDQwNCIvPgo8cGF0aCBkPSJNMzk1LjE3NSAxNy4zMTg4QzM5NS4xOTkgMTcuMzgxNiAzOTUuMjE5IDE3LjQzNjcgMzk1LjI1NSAxNy41MjcxQzM5NS4wMDcgMTcuNjMzIDM5NC43NzUgMTcuNzcwNiAzOTQuNTIgMTcuODM3NEMzOTQuMTUzIDE3LjkzMTkgMzkzLjgxIDE3LjU5NzggMzkzLjgwNiAxNy4xNjU0QzM5My43OTggMTYuNTY0MSAzOTMuODAyIDE1Ljk2MjcgMzkzLjgwMiAxNS4zNTc1QzM5My44MDIgMTUuMjc4OSAzOTMuODAyIDE1LjIwMDMgMzkzLjgwMiAxNS4xMTM4QzM5My42MyAxNS4xMDIgMzkzLjQ1OSAxNS4wODYyIDM5My4yNzUgMTUuMDc0NUMzOTMuMzgzIDE0LjgxOSAzOTMuNTU0IDE0Ljc2IDM5My44MTQgMTQuODExMUMzOTMuNjk0IDE0LjMyMzggMzkzLjk2MSAxNC4wNzIxIDM5NC4zMDEgMTMuODYzOUMzOTQuMzIxIDEzLjg3MTggMzk0LjM0IDEzLjg3OTcgMzk0LjM2IDEzLjg4NzZDMzk0LjM2IDE0LjE4NjIgMzk0LjM2IDE0LjQ4NDkgMzk0LjM2IDE0Ljc5MTRDMzk0LjYyOCAxNC43OTE0IDM5NC44NzkgMTQuNzkxNCAzOTUuMTIzIDE0Ljc5MTRDMzk1LjIxOSAxNS4wMTkzIDM5NS4xNzEgMTUuMDk3OSAzOTQuOTM5IDE1LjA5NzlDMzk0Ljc1NiAxNS4wOTc5IDM5NC41NjggMTUuMDk3OSAzOTQuMzY1IDE1LjA5NzlDMzk0LjM2NSAxNS40OTg5IDM5NC4zNjUgMTUuODg3OSAzOTQuMzY1IDE2LjI3NzJDMzk0LjM2NSAxNi40OTM0IDM5NC4zNiAxNi43MDk1IDM5NC4zNjUgMTYuOTI1N0MzOTQuMzc3IDE3LjMzNDQgMzk0LjYyNCAxNy41MDc0IDM5NS4wMTEgMTcuMzc3OEMzOTUuMDYzIDE3LjM2NTggMzk1LjExNSAxNy4zNDIzIDM5NS4xNzUgMTcuMzE4OFoiIGZpbGw9IiMwNDA0MDQiLz4KPHBhdGggZD0iTTM5Ny4xNDYgMTcuNTY2OEMzOTcuMTQ2IDE3LjYyOTYgMzk3LjE0NiAxNy42OTI2IDM5Ny4xNDYgMTcuNzY3MUMzOTYuNjM1IDE3Ljc2NzEgMzk2LjEyOCAxNy43NjcxIDM5NS42MTMgMTcuNzY3MUMzOTUuNjEzIDE3LjY5NjQgMzk1LjYxMyAxNy42MzM3IDM5NS42MTMgMTcuNTcwNkMzOTUuNjQxIDE3LjU2MjcgMzk1LjY1NyAxNy41NTA5IDM5NS42NzcgMTcuNTUwOUMzOTYuMDMzIDE3LjUxOTUgMzk2LjA5MiAxNy40NTY4IDM5Ni4wOTYgMTcuMDk4OUMzOTYuMSAxNi41OTU4IDM5Ni4xIDE2LjA5MjcgMzk2LjEgMTUuNTg1OEMzOTYuMSAxNS4yNzUyIDM5Ni4wNjQgMTUuMjQzOCAzOTUuNjczIDE1LjE2MTRDMzk1LjY3MyAxNS4xMDI0IDM5NS42NzMgMTUuMDM5NCAzOTUuNjczIDE0Ljk4ODNDMzk2LjAwNCAxNC45MDE4IDM5Ni4zMjggMTQuODE5MyAzOTYuNjYzIDE0LjcyOUMzOTYuNjY3IDE0Ljc3NjIgMzk2LjY3MSAxNC44MjczIDM5Ni42NzEgMTQuODc0NUMzOTYuNjcxIDE1LjU4NTggMzk2LjY3MSAxNi4zMDEgMzk2LjY3MSAxNy4wMTI3QzM5Ni42NjcgMTcuNDcyMyAzOTYuNjg3IDE3LjQ5NjEgMzk3LjE0NiAxNy41NjY4WiIgZmlsbD0iIzA0MDQwNCIvPgo8cGF0aCBkPSJNNDA1LjM3NSAxNy40NDQ0QzQwNS4zNzEgMTcuNjcyMyA0MDUuMTg4IDE3Ljg1MzMgNDA0Ljk2IDE3Ljg1NzFDNDA0LjcyOSAxNy44NjEyIDQwNC41MzcgMTcuNjY0NyA0MDQuNTQxIDE3LjQyODhDNDA0LjU0NSAxNy4yMDA5IDQwNC43MjkgMTcuMDE5OSA0MDQuOTU2IDE3LjAxOTlDNDA1LjE5NiAxNy4wMTYxIDQwNS4zNzkgMTcuMjA0NyA0MDUuMzc1IDE3LjQ0NDRaIiBmaWxsPSIjMDQwNDA0Ii8+CjxwYXRoIGQ9Ik0zOTYuMzQgMTQuMDg4M0MzOTYuMTM3IDE0LjA4ODMgMzk1Ljk2OSAxMy45MzQ5IDM5NS45NjUgMTMuNzM4NkMzOTUuOTYxIDEzLjU0NTkgMzk2LjE0OSAxMy4zNDE0IDM5Ni4zMzIgMTMuMzQ1NUMzOTYuNTI4IDEzLjM0NTUgMzk2LjcwNyAxMy41MyAzOTYuNzExIDEzLjczMDdDMzk2LjcxMSAxMy45MjMxIDM5Ni41NCAxNC4wODgzIDM5Ni4zNCAxNC4wODgzWiIgZmlsbD0iIzA0MDQwNCIvPgo8cGF0aCBkPSJNMzM1LjU3MyA3LjM1NTg2QzMzNi4wMjggNy4zNTIwNCAzMzYuNDcxIDcuNDExMDEgMzM2Ljg4NiA3LjU5OTYzQzMzNy40NjEgNy44NjMwNSAzMzcuNzY0IDguMzE0NzkgMzM3LjggOC45MjAyNUMzMzcuODcyIDEwLjE0NjQgMzM3LjIzOCAxMS40MjM5IDMzNS45NzYgMTEuOTg5OEMzMzUuNDU4IDEyLjIyMTggMzM0LjkxNSAxMi4zMDA0IDMzNC4zNDggMTIuMTk4QzMzNC4wMTcgMTIuMTM5MSAzMzMuNzczIDExLjg5OTQgMzMzLjc4NSAxMS41NjUzQzMzMy43OTcgMTEuMjkwMSAzMzMuODQxIDExLjAwNzEgMzMzLjkyMSAxMC43Mzk4QzMzNC4yNTIgOS42NTkxNyAzMzQuNjAzIDguNTgyMDIgMzM0Ljk0NyA3LjUwMTM2QzMzNC45NzkgNy4zOTg5OCAzMzUuMDE0IDcuMzI4MjkgMzM1LjE1IDcuMzQ3OTRDMzM1LjI5IDcuMzcxNzEgMzM1LjQzMyA3LjM1NTg2IDMzNS41NzMgNy4zNTU4NloiIGZpbGw9IiMwQjNCNjIiLz4KPHBhdGggZD0iTTMzNS4yMTkgNi43MTg2OEMzMzUuMzE4IDYuMzk2NTkgMzM1LjQwNiA2LjExMzUyIDMzNS40OTQgNS44MjY2NEMzMzUuNzM3IDUuMDQ0NTkgMzM1Ljk3MyA0LjI2MjI1IDMzNi4yMjQgMy40ODAyQzMzNi40NTIgMi43NzI2NiAzMzYuNzM5IDIuNTkxOTcgMzM3LjQ4OSAyLjY1ODg1QzMzNy45OCAyLjcwMTk3IDMzOC40MTEgMi44NTkyIDMzOC42NzEgMy4zMDMzMkMzMzguODU0IDMuNjEzNjcgMzM4Ljg3OCAzLjk2MzYzIDMzOC44MzggNC4zMDk0OEMzMzguNzY3IDQuOTY5NzkgMzM4LjUyMyA1LjU1OTQgMzM4IDYuMDA3MzNDMzM3LjU1NyA2LjM4ODY4IDMzNy4wMzQgNi41OTY5NSAzMzYuNDU2IDYuNjU1OTFDMzM2LjA1NyA2LjY5OTAzIDMzNS42NTQgNi42OTkwMyAzMzUuMjE5IDYuNzE4NjhaIiBmaWxsPSIjMEIzQjYyIi8+Cjwvc3ZnPgo=">
                                                    </div>
                                                </div>
                                                <div class="v2-card__cta v2-card__cta--left">
                                                    <div class="v2-card__cta-wrapper">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="v2-col-xs-12 v2-col-sm-6 v2-mab16 v2-slider__slide" data-columns-mobile="1" data-columns-desktop="2" data-styles="card">
                                        <div class="v2-card v2-rounded-corner--big" style="background-color:#fff">
                                            <div class="v2-card__text-content v2-row-sm-x v2-paa30 v2-md-max-pah15 v2-md-max-pav20">
                                                <div class="v2-card__header">
                                                    <h5 class="v2-card__title v2-card--inline">Trading Strategies</h5>
                                                </div>
                                                <div class="v2-card__rte">
                                                    <div class="rte--output">
                                                        <p class="text--body">Let seasoned traders find short-term, speculative opportunities and make decisions on your behalf directly in your account. Categorised as very high risk.</p>
                                                        <img alt="Trading-Strategies-logos" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTEwIiBoZWlnaHQ9IjQxIiB2aWV3Qm94PSIwIDAgMTEwIDQxIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cGF0aCBkPSJNMC4wNjY1ODk4IDIwLjc1ODNMMS41NjY0NSAyMS40NDgxVjIxLjQ3N0wwLjAyMjE5NjYgMjIuMDUxM0wwIDIyLjYxMjhMMi4yNTQ1NCAyMi42OTk0TDIuMjcwMzkgMjIuMjU2NkwwLjc2NDE5NyAyMi4xOTg5VjIyLjE3MzJMMi4xNzIxIDIxLjY0MzhMMi4xODQ3OCAyMS4zMjYyTDAuODE4MTAzIDIwLjY5NDFWMjAuNjY4NUwyLjMyNzQ3IDIwLjcyM0wyLjM0MzMzIDIwLjI4MDNMMC4wODg3ODY0IDIwLjE5NjhMMC4wNjY1ODk4IDIwLjc1ODNaIiBmaWxsPSJibGFjayIvPgo8cGF0aCBkPSJNMC4zNDU3OTUgMTguNDM1NEwyLjQyMjc0IDE5LjYzMjFMMi41MDgzNiAxOS4xNjA1TDIuMDEwNTQgMTguODg3OEwyLjE1NjM5IDE4LjA5ODVMMi43MTc2NSAxOC4wMjc5TDIuODA5NTggMTcuNTIxTDAuNDQ3MjQ4IDE3Ljg4MzZMMC4zNDU3OTUgMTguNDM1NFpNMC44NTYzMTIgMTguMjQ2MUwxLjc3OTAzIDE4LjEzMDZMMS42NzEyMyAxOC43MjFMMC44NTMxMzggMTguMjc1TDAuODU2MzEyIDE4LjI0NjFaIiBmaWxsPSJibGFjayIvPgo8cGF0aCBkPSJNMi44MjIwMyAxNC44NjQ1TDIuNjc5MzUgMTUuMzA3MkMyLjc4Njc1IDE1LjM2NDkgMi44NjkzNyAxNS40NjA2IDIuOTExNDggMTUuNTc2QzIuOTUzNiAxNS42OTE0IDIuOTUyMjQgMTUuODE4NCAyLjkwNzY1IDE1LjkzMjlDMi43OTk4NCAxNi4yNzYyIDIuNDUxMDQgMTYuMzk0OSAyLjAwMDc3IDE2LjI1MzdDMS41NTA0OSAxNi4xMTI1IDEuMzM0ODcgMTUuODA0NSAxLjQ0NTg1IDE1LjQ2NDRDMS40NzkzNCAxNS4zNDM1IDEuNTU1NzkgMTUuMjM5MiAxLjY2MDUzIDE1LjE3MTdDMS43NjUyNyAxNS4xMDQyIDEuODkwOSAxNS4wNzgyIDIuMDEzNDIgMTUuMDk4N0wyLjE1Mjk3IDE0LjY1NTlDMS45MTgxOSAxNC42MDIxIDEuNjcxOTQgMTQuNjQyNyAxLjQ2NjEgMTQuNzY4OUMxLjI2MDI2IDE0Ljg5NTIgMS4xMTA5MSAxNS4wOTc0IDEuMDQ5NDggMTUuMzMyOUMwLjg0OTcxNSAxNS45NzQ2IDEuMTU0MTMgMTYuNDkxMSAxLjg1MTc0IDE2LjcxODlDMi41NDkzNSAxNi45NDY3IDMuMTIwMTEgMTYuNjk2NSAzLjMwNDAyIDE2LjA3NzJDMy4zOTgyNiAxNS44NTE3IDMuNDAwNDggMTUuNTk3NSAzLjMxMDE4IDE1LjM3MDNDMy4yMTk4NyAxNS4xNDMxIDMuMDQ0MzggMTQuOTYxMiAyLjgyMjAzIDE0Ljg2NDVaIiBmaWxsPSJibGFjayIvPgo8cGF0aCBkPSJNNC4wMjcxOSAxNC4wMDQ2TDMuMjg4MzMgMTMuNjUxN0wzLjQ1MzIzIDEzLjI5NTZMNC4zNzU5OCAxMy4yNjk5TDQuNjA0MjggMTIuNzc5TDMuNTk1OTQgMTIuODI3MUMzLjU5OTE1IDEyLjY5MTkgMy41NjI1OCAxMi41NTg3IDMuNDkwODkgMTIuNDQ0NEMzLjQxOTIgMTIuMzMwMiAzLjMxNTYgMTIuMjQwMSAzLjE5MzIzIDEyLjE4NTVDMy4xMDE4OCAxMi4xMzc2IDMuMDAxMyAxMi4xMTA0IDIuODk4NTEgMTIuMTA1OUMyLjc5NTcxIDEyLjEwMTQgMi42OTMxNiAxMi4xMTk2IDIuNTk4MDYgMTIuMTU5M0MyLjUwMjk1IDEyLjE5OSAyLjQxNzU3IDEyLjI1OTMgMi4zNDc4NSAxMi4zMzU4QzIuMjc4MTIgMTIuNDEyNCAyLjIyNTc0IDEyLjUwMzQgMi4xOTQzNyAxMi42MDI2TDEuNzg1MzEgMTMuNDY4OEwzLjgyNDI0IDE0LjQ1MDZMNC4wMjcxOSAxNC4wMDQ2Wk0zLjEzOTMxIDEzLjExMjdMMi45NjE3NiAxMy40OTEzTDIuMzI3NTcgMTMuMTg5N0wyLjUwMTk1IDEyLjgxNDNDMi41MTgzIDEyLjc2NzQgMi41NDQzNSAxMi43MjQ2IDIuNTc4MzUgMTIuNjg4N0MyLjYxMjM2IDEyLjY1MjggMi42NTM1NSAxMi42MjQ2IDIuNjk5MTYgMTIuNjA2MUMyLjc0NDc4IDEyLjU4NzYgMi43OTM3OCAxMi41NzkxIDIuODQyODggMTIuNTgxM0MyLjg5MTk5IDEyLjU4MzQgMi45NDAwOCAxMi41OTYxIDIuOTgzOTMgMTIuNjE4NkMzLjAyOTI5IDEyLjYzNzIgMy4wNzAwMiAxMi42NjU2IDMuMTAzMjcgMTIuNzAxOUMzLjEzNjUyIDEyLjczODMgMy4xNjE0NCAxMi43ODE1IDMuMTc2MjcgMTIuODI4N0MzLjE5MTExIDEyLjg3NTkgMy4xOTU1MiAxMi45MjU4IDMuMTg5MTIgMTIuOTc0OUMzLjE4MjczIDEzLjAyNCAzLjE2NTcxIDEzLjA3MSAzLjEzOTMxIDEzLjExMjdaIiBmaWxsPSJibGFjayIvPgo8cGF0aCBkPSJNMy45MzUwMiAxMS42NEM0LjU0NzAxIDEyLjA0NDMgNS4xNTU4MyAxMS45NDE2IDUuNTIwNDkgMTEuMzcwNUM1Ljg4NTE1IDEwLjc5OTQgNS43Mjk3NyAxMC4xOTk1IDUuMTE3NzcgOS43OTg0MkM0LjUwNTc4IDkuMzk3MzcgMy44OTM3OSA5LjUwMDA1IDMuNTMyMyAxMC4wNjQ3QzMuMTcwODIgMTAuNjI5NCAzLjMxOTg2IDExLjIzNTggMy45MzUwMiAxMS42NFpNMy44ODExIDEwLjI5MjVDNC4wNzc3IDkuOTcxNjggNC40NTgyMyA5Ljk0NjAxIDQuODU0NiAxMC4yMDU5QzUuMjUwOTcgMTAuNDY1OCA1LjM3NDYzIDEwLjgzMTUgNS4xNzE2OSAxMS4xNDI3QzQuOTY4NzUgMTEuNDUzOSA0LjU4ODIyIDExLjQ4OTIgNC4xOTUwMiAxMS4yMjk0QzMuODAxODIgMTAuOTY5NSAzLjY4MTMzIDEwLjYwMzcgMy44ODExIDEwLjI5MjVaIiBmaWxsPSJibGFjayIvPgo8cGF0aCBkPSJNNy44NjcyNyA4LjMxOTMyQzguMzM5NzUgNy44MzE2NSA4LjMxNDM4IDcuMjYzNzYgNy43ODggNi43NDRDNy4yNjE2MiA2LjIyNDI0IDYuNzIyNTQgNi4yMzcwNyA2LjI1MzI0IDYuNzIxNTRMNS42MTkwNSA3LjM2MzIyTDcuMjI5OTEgOC45Njc0MUw3Ljg2NzI3IDguMzE5MzJaTTYuNDkxMDYgNy4wNjE2M0M2LjU1MzAxIDYuOTk1NSA2LjYyODIxIDYuOTQzNDggNi43MTE1OCA2LjkwOTAyQzYuNzk0OTUgNi44NzQ1NyA2Ljg4NDYgNi44NTg0NyA2Ljk3NDYgNi44NjE4MUM3LjA2NDU5IDYuODY1MTUgNy4xNTI4NiA2Ljg4Nzg0IDcuMjMzNTEgNi45MjgzOEM3LjMxNDE3IDYuOTY4OTIgNy4zODUzNCA3LjAyNjM4IDcuNDQyMzQgNy4wOTY5M0M3Ljc4NDggNy40MTc3NyA3LjgwMzg2IDcuNzg2NzMgNy41MTIxMyA4LjA4ODMyTDcuMjcxMTQgOC4zMzUzNkw2LjIzNzQxIDcuMzA4NjhMNi40OTEwNiA3LjA2MTYzWiIgZmlsbD0iYmxhY2siLz4KPHBhdGggZD0iTTguMDkxMTUgNS4wMjAzOUw3LjcyODQyIDUuMzI2NzFMOS4xNzMwOSA3LjA3ODAyTDkuNTM1ODIgNi43NzE3TDguMDkxMTUgNS4wMjAzOVoiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik0xMC4xMDI4IDUuMTA3NzFMMTAuMzc4NyA0Ljk5MjIxQzEwLjY0MTkgNC44ODMxMyAxMC43ODE0IDQuODg5NTQgMTAuODYwNyA0Ljk5MjIxQzEwLjk0IDUuMDk0ODggMTAuODgyOSA1LjMzMjMgMTAuNjggNS40NzM0N0MxMC40NzcgNS42MTQ2NCAxMC4yNDI0IDUuNjMzODkgMTAuMTIxOSA1LjQ5MjcyTDkuNzQ3NjkgNS43NTU4MUM5Ljk5ODE5IDYuMDk1OSAxMC40MzU4IDYuMTE1MTUgMTAuODc2NiA1LjgwNzE0QzExLjMxNzMgNS40OTkxNCAxMS40NzI3IDUuMDUzMTcgMTEuMjE1OCA0LjY3MTM3QzExLjAxNjEgNC4zODI2MiAxMC43NDY2IDQuMzMxMjggMTAuMzE4NSA0LjUxMDk1TDEwLjA2MTYgNC42MjAwNEM5LjgxMTEgNC43MjI3MSA5LjY3Nzk0IDQuNzE5NSA5LjU5ODY2IDQuNjA0QzkuNTE5MzkgNC40ODg1IDkuNTcwMTMgNC4yODMxNiA5Ljc2MzU2IDQuMTQxOTlDOS44MzM1MiA0LjA3Nzk2IDkuOTI0NDcgNC4wNDI1IDEwLjAxODggNC4wNDI1QzEwLjExMzEgNC4wNDI1IDEwLjIwNDEgNC4wNzc5NiAxMC4yNzQxIDQuMTQxOTlMMTAuNjM4NyAzLjg4ODUyQzEwLjQwMDkgMy41Njc2OSA5Ljk1MzggMy41MzIzOSA5LjU0NDc0IDMuODE3OTRDOS4xMzU2OSA0LjEwMzQ5IDguOTkzIDQuNTQzMDMgOS4yMjc2NSA0Ljg5OTE3QzkuMjcxNDMgNC45NzExNiA5LjMyODg3IDUuMDMzNyA5LjM5NjYxIDUuMDgzMThDOS40NjQzNSA1LjEzMjY2IDkuNTQxMTEgNS4xNjgxMSA5LjYyMjQzIDUuMTg3NDlDOS43MDM3NiA1LjIwNjg3IDkuNzg4MDYgNS4yMDk3OSA5Ljg3MDUxIDUuMTk2MUM5Ljk1Mjk2IDUuMTgyNDEgMTAuMDMxOSA1LjE1MjM3IDEwLjEwMjggNS4xMDc3MVoiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik0xMy4xMDIzIDQuNDg4NTJDMTMuMzI0IDQuMzk2MDMgMTMuNTAwNSA0LjIxODc5IDEzLjU5MzggMy45OTUzMkMxMy42ODcgMy43NzE4NCAxMy42ODkzIDMuNTIwMTggMTMuNjAwMiAzLjI5NUwxMy4xOTExIDMuNTA2NzVDMTMuMjI2IDMuNjI0ODcgMTMuMjE2OSAzLjc1MTgyIDEzLjE2NTQgMy44NjM1N0MxMy4xMTQgMy45NzUzMyAxMy4wMjM4IDQuMDY0MTIgMTIuOTEyIDQuMTEzMTNDMTIuNTk0OSA0LjI3Njc2IDEyLjI3NzkgNC4xMTMxMyAxMi4wNDk2IDMuNjgzMjFDMTEuODIxMiAzLjI1MzI5IDExLjg5NDIgMi44ODc1MyAxMi4yMTEzIDIuNzIwNjlDMTIuMzE5OCAyLjY1ODM2IDEyLjQ0NzMgMi42Mzg5NCAxMi41NjkxIDIuNjY2MjFDMTIuNjkwOSAyLjY5MzQ3IDEyLjc5ODUgMi43NjU0NyAxMi44NzA5IDIuODY4MjlMMTMuMjc5OSAyLjY1NjUzQzEzLjE1MjkgMi40NDQ3NiAxMi45NDg0IDIuMjkyMjUgMTIuNzEwOSAyLjIzMjE3QzEyLjQ3MzQgMi4xNzIwOSAxMi4yMjIxIDIuMjA5MyAxMi4wMTE1IDIuMzM1NjlDMTEuNDI4MSAyLjYzNzI4IDExLjI3NTggMy4yMjc2MyAxMS42MDg4IDMuODkxNzZDMTEuOTQxNyA0LjU1NTkgMTIuNTE4OSA0Ljc5MDExIDEzLjEwMjMgNC40ODg1MloiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik0xNS4wNTIzIDMuNTQ4NDhMMTQuNzc5NiAyLjc3MjA1TDE1LjE0NDMgMi42NDA1TDE1LjgxMzQgMy4yODIxOEwxNi4zMTQ0IDMuMTAyNTFMMTUuNTY5MiAyLjQxNTkyQzE1LjY3MSAyLjMyNDA1IDE1Ljc0MjEgMi4yMDI1MiAxNS43NzI3IDIuMDY4MDdDMTUuODAzNCAxLjkzMzYyIDE1Ljc5MjEgMS43OTI4NiAxNS43NDA1IDEuNjY1MTZDMTUuNzA5NCAxLjU2NjU1IDE1LjY1NzUgMS40NzU5NyAxNS41ODgzIDEuMzk5NzRDMTUuNTE5MSAxLjMyMzUxIDE1LjQzNDMgMS4yNjM0NSAxNS4zMzk4IDEuMjIzNzVDMTUuMjQ1MyAxLjE4NDA1IDE1LjE0MzQgMS4xNjU2NiAxNS4wNDEyIDEuMTY5ODZDMTQuOTM5IDEuMTc0MDYgMTQuODM4OSAxLjIwMDc0IDE0Ljc0NzkgMS4yNDgwNkwxMy44NTY5IDEuNTY4OUwxNC42MDg0IDMuNzE1MzFMMTUuMDUyMyAzLjU0ODQ4Wk0xNC44MTE0IDEuNjIzNDVDMTQuODU1MiAxLjYwMTE1IDE0LjkwMzIgMS41ODg3MyAxNC45NTIyIDEuNTg3MDNDMTUuMDAxMyAxLjU4NTM0IDE1LjA1IDEuNTk0NDEgMTUuMDk1MiAxLjYxMzYyQzE1LjE0MDQgMS42MzI4MyAxNS4xODEgMS42NjE3MiAxNS4yMTQxIDEuNjk4MzFDMTUuMjQ3MiAxLjczNDkgMTUuMjcyMSAxLjc3ODMyIDE1LjI4NyAxLjgyNTU4QzE1LjMwOSAxLjg3MDg5IDE1LjMyMDEgMS45MjA4MSAxNS4zMTk1IDEuOTcxMjhDMTUuMzE4OCAyLjAyMTc2IDE1LjMwNjQgMi4wNzEzNiAxNS4yODMyIDIuMTE2MDZDMTUuMjYwMSAyLjE2MDc3IDE1LjIyNjggMi4xOTkzMSAxNS4xODYxIDIuMjI4NTZDMTUuMTQ1NSAyLjI1NzggMTUuMDk4NiAyLjI3NjkzIDE1LjA0OTIgMi4yODQzOEwxNC42NTkyIDIuNDIyMzNMMTQuNDI3NyAxLjc2MTQxTDE0LjgxMTQgMS42MjM0NVoiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik0xOC40Mzk0IDIuNTkyMzdMMTguMzUzNyAyLjE5NDUzTDE3LjM1NDkgMi40MTkxMUwxNy4yMzc2IDEuODc2OUwxOC4xNzkzIDEuNjY1MTRMMTguMDk2OSAxLjI5NjE4TDE3LjE1NTEgMS41MDc5M0wxNy4wNDEgMC45ODgxNzNMMTguMDM5OCAwLjc2MzU4NkwxNy45NTEgMC4zNjU3NDZMMTYuNDk1NiAwLjY5NjIxTDE2Ljk4MzkgMi45MTk2MkwxOC40Mzk0IDIuNTkyMzdaIiBmaWxsPSJibGFjayIvPgo8cGF0aCBkPSJNMTkuNTcxMyAwLjU0ODY1OUwxOS43NTUyIDIuNDA5NTJMMjAuMjI0NSAyLjM2NDYxTDIwLjA0MDUgMC41MDA1MzNMMjAuNzEyOCAwLjQzMzE1N0wyMC42NzE2IDAuMDI4OTAwMUwxOC44NTc4IDAuMjExNzc4TDE4Ljg5OSAwLjYxNjAzNUwxOS41NzEzIDAuNTQ4NjU5WiIgZmlsbD0iYmxhY2siLz4KPHBhdGggZD0iTTIyLjA0NzUgMC4wMDczNzQ1MkwyMS41NzUxIDAuMDE0NzE3MUwyMS42MDk3IDIuMjk1NjJMMjIuMDgyMSAyLjI4ODI3TDIyLjA0NzUgMC4wMDczNzQ1MloiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik0yMy44OTkzIDIuNDM1MTNDMjQuNTY1MiAyLjQ5OTMgMjUuMDI1IDIuMDgyMjEgMjUuMDk0NyAxLjM0NDI4QzI1LjE2NDUgMC42MDYzNDkgMjQuNzc3NiAwLjEwOTA0MyAyNC4xNDM0IDAuMDQ0ODc1M0MyMy41MDkyIC0wLjAxOTI5MjQgMjMuMDE3NyAwLjM5NDU5NCAyMi45NDggMS4xMzI1MkMyMi44NzgyIDEuODcwNDUgMjMuMjMzNCAyLjM3MDk2IDIzLjg5OTMgMi40MzUxM1pNMjMuNDE0MSAxLjE4MDY1QzIzLjQ1ODUgMC43MDI1OTggMjMuNzMxMiAwLjQyNjY3OSAyNC4wODk1IDAuNDYxOTcyQzI0LjQ0NzggMC40OTcyNjQgMjQuNjYwMyAwLjgyMTMwMyAyNC42MTI3IDEuMjk2MTRDMjQuNTY1MiAxLjc3MDk5IDI0LjI5NTYgMi4wNTMzMiAyMy45NDA1IDIuMDE4MDNDMjMuNTg1MyAxLjk4Mjc0IDIzLjM2NjYgMS42NTU0OSAyMy40MTQxIDEuMTgwNjVaIiBmaWxsPSJibGFjayIvPgo8cGF0aCBkPSJNMjYuNDU4NSAxLjMzMTVMMjYuNDg3IDEuMzM3OTFMMjcuMTY1NiAyLjk3NDE5TDI3LjU0NjEgMy4wNjcyM0wyOC4wNzg4IDAuODUwMjM3TDI3LjYzODEgMC43NDExNTJMMjcuMzA4MyAyLjEyMzk3TDI3LjI3OTggMi4xMTc1NUwyNi42MDEyIDAuNDg3Njg5TDI2LjIyMDcgMC4zOTQ2NDZMMjUuNjg4IDIuNjExNjRMMjYuMTI4NyAyLjcyMDczTDI2LjQ1ODUgMS4zMzE1WiIgZmlsbD0iYmxhY2siLz4KPHBhdGggZD0iTTI4Ljk4NTggMi45OTAxOEwyOS43MjQ2IDMuMjg1MzVMMjkuNjg2NiAzLjg1MzIzTDMwLjE2MjIgNC4wNDI1NEwzMC4yNTc0IDEuNjI2NjFMMjkuNzQwNSAxLjQyMTI4TDI4LjE4NjcgMy4yNTk2OUwyOC42Mjc1IDMuNDMyOTRMMjguOTg1OCAyLjk5MDE4Wk0yOS44MDA3IDEuOTU3MDlIMjkuODI2MUwyOS43NjI3IDIuODkzOTNMMjkuMjE0MSAyLjY3NTc2TDI5LjgwMDcgMS45NTcwOVoiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik0zMS41NjA2IDMuODQzNjFMMzEuODk5OSA0LjAzMjlMMzEuODc0NSA0Ljk2MzM0TDMyLjM0MDcgNS4yMjMyMlY0LjIwMjk2QzMyLjQ3NTcgNC4yMTgzNiAzMi42MTIxIDQuMTkxMTggMzIuNzMxMyA0LjEyNTE0QzMyLjg1MDUgNC4wNTkwOSAzMi45NDY3IDMuOTU3NCAzMy4wMDY2IDMuODMzOThDMzMuMDU5MiAzLjc0NDYgMzMuMDkxOSAzLjY0NDY4IDMzLjEwMjQgMy41NDEyQzMzLjExMjkgMy40Mzc3MSAzMy4xMDEgMy4zMzMxNSAzMy4wNjc1IDMuMjM0OEMzMy4wMzQgMy4xMzY0NSAzMi45Nzk3IDMuMDQ2NjggMzIuOTA4NCAyLjk3MTc0QzMyLjgzNzEgMi44OTY4IDMyLjc1MDQgMi44Mzg0OSAzMi42NTQ2IDIuODAwODhMMzEuODI3IDIuMzM4ODdMMzAuNzM2MiA0LjMzNzdMMzEuMTUxNSA0LjU2ODcxTDMxLjU2MDYgMy44NDM2MVpNMzIuMDcxMSAyLjkwNjc3TDMyLjQyOTUgMy4xMDg5QzMyLjQ3NDggMy4xMjc1IDMyLjUxNTcgMy4xNTU3MiAzMi41NDk0IDMuMTkxNjZDMzIuNTgzIDMuMjI3NiAzMi42MDg3IDMuMjcwNDIgMzIuNjI0NiAzLjMxNzI0QzMyLjY0MDUgMy4zNjQwNiAzMi42NDY0IDMuNDEzNzkgMzIuNjQxNyAzLjQ2MzA4QzMyLjYzNyAzLjUxMjM3IDMyLjYyMTkgMy41NjAwOCAzMi41OTc1IDMuNjAyOThDMzIuNTc2IDMuNjQ3NCAzMi41NDUxIDMuNjg2NDkgMzIuNTA2OSAzLjcxNzQ2QzMyLjQ2ODggMy43NDg0MiAzMi40MjQ0IDMuNzcwNSAzMi4zNzY5IDMuNzgyMTRDMzIuMzI5NCAzLjc5Mzc4IDMyLjI3OTkgMy43OTQ2OSAzMi4yMzIgMy43ODQ3OUMzMi4xODQxIDMuNzc0OSAzMi4xMzg5IDMuNzU0NDUgMzIuMDk5NyAzLjcyNDlMMzEuNzM1IDMuNTIyNzdMMzIuMDcxMSAyLjkwNjc3WiIgZmlsbD0iYmxhY2siLz4KPHBhdGggZD0iTTM0LjIzMDMgNS41NDA4NUwzNS43MDE3IDQuODQxNDJMMzUuMjg5NCA0LjUzNjYyTDM0LjMzNSA1LjAxNDY3TDM0LjMwOTYgNC45OTg2M0wzNC40NjUgMy45MzAyNEwzNC4wNTI4IDMuNjI1NDRMMzMuODQ5OCA1LjI1ODUxTDMzLjM2MTUgNS45Mzg2OUwzMy43NDIgNi4yMTc4MkwzNC4yMzAzIDUuNTQwODVaIiBmaWxsPSJibGFjayIvPgo8cGF0aCBkPSJNMzYuNDI4IDguNjQ5NzhMMzcuNzY5NCA3LjM1NjhMMzguMjM1NSA3Ljg1NDFMMzguNTI3MiA3LjU3MTc2TDM3LjI2ODMgNi4yMzM4NkwzNi45NzM1IDYuNTEyOTlMMzcuNDQyOCA3LjAxMDI5TDM2LjEwMTQgOC4zMDMyN0wzNi40MjggOC42NDk3OFoiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik0zNy42MiAxMC4wNzQzTDM4LjI3NjUgOS41ODM0NkwzOC41MDQ4IDkuOTA0M0wzOC4wOTg5IDEwLjczODVMMzguNDE2IDExLjE3NDhMMzguODUwNCAxMC4yNTRDMzguOTY3MSAxMC4zMjQyIDM5LjEwMjMgMTAuMzU2NiAzOS4yMzc4IDEwLjM0NjhDMzkuMzczMiAxMC4zMzcxIDM5LjUwMjUgMTAuMjg1NyAzOS42MDgyIDEwLjE5OTVDMzkuNjkzIDEwLjE0MDkgMzkuNzY0IDEwLjA2NDMgMzkuODE2NCA5Ljk3NTAyQzM5Ljg2ODggOS44ODU3NCAzOS45MDEzIDkuNzg1OTUgMzkuOTExNSA5LjY4MjY0QzM5LjkyMTggOS41NzkzMyAzOS45MDk2IDkuNDc1IDM5Ljg3NTkgOS4zNzY5NUMzOS44NDIxIDkuMjc4OSAzOS43ODc1IDkuMTg5NTIgMzkuNzE2IDkuMTE1MDRMMzkuMTU0OCA4LjM0MTgyTDM3LjMzNzggOS42OTg5NkwzNy42MiAxMC4wNzQzWk0zOS4xMjYyIDguOTQ1TDM5LjM3MDQgOS4yNjU4NEMzOS40MDM4IDkuMzAyMzYgMzkuNDI5MSA5LjM0NTY4IDM5LjQ0NDcgOS4zOTI5MUMzOS40NjAyIDkuNDQwMTMgMzkuNDY1NiA5LjQ5MDE2IDM5LjQ2MDUgOS41Mzk2N0MzOS40NTU0IDkuNTg5MTcgMzkuNDQgOS42MzcgMzkuNDE1MSA5LjY3OTk3QzM5LjM5MDMgOS43MjI5MyAzOS4zNTY2IDkuNzYwMDMgMzkuMzE2NSA5Ljc4ODhDMzkuMjc5OSA5LjgyMjc3IDM5LjIzNTkgOS44NDc1NiAzOS4xODgxIDkuODYxMTdDMzkuMTQwMiA5Ljg3NDc4IDM5LjA4OTkgOS44NzY4MiAzOS4wNDEyIDkuODY3MTVDMzguOTkyNCA5Ljg1NzQ3IDM4Ljk0NjYgOS44MzYzNCAzOC45MDc0IDkuODA1NDVDMzguODY4MiA5Ljc3NDU3IDM4LjgzNjcgOS43MzQ3OSAzOC44MTU1IDkuNjg5MzRMMzguNTY4MiA5LjM2ODVMMzkuMTI2MiA4Ljk0NVoiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik0zOC45Mzk1IDEyLjAxODdMMzkuNDkxMiAxMS45MDY0TDM5Ljg3ODEgMTIuNjA1OEwzOS40OTEyIDEzLjAxOTdMMzkuNzM4NiAxMy40NzIxTDQxLjMyNCAxMS42NzIxTDQxLjA1NDUgMTEuMTgxM0wzOC43MDQ4IDExLjU5ODRMMzguOTM5NSAxMi4wMTg3Wk00MC43NjkxIDExLjYzMDRWMTEuNjU2MUw0MC4xMzQ5IDEyLjMzOTVMMzkuODQ2NCAxMS44MTY1TDQwLjc2OTEgMTEuNjMwNFoiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik00MC4zMzQxIDE0LjkyODdDNDAuNTgxNSAxNS41NzAzIDQxLjEwNDYgMTUuNzcyNSA0MS43ODY0IDE1LjUwM0M0Mi40NjgxIDE1LjIzMzQgNDIuNjgwNiAxNC43MjY1IDQyLjQyMDYgMTQuMDk0NUw0Mi4xMDM1IDEzLjI1NzFMNDAuMDAxMiAxNC4wOTEzTDQwLjMzNDEgMTQuOTI4N1pNNDEuOTE5NiAxMy44NTA2TDQyLjA0MzMgMTQuMTcxNUM0Mi4wODAxIDE0LjI1NzIgNDIuMDk3OSAxNC4zNTAxIDQyLjA5NTYgMTQuNDQzNUM0Mi4wOTMyIDE0LjUzNyA0Mi4wNzA3IDE0LjYyODggNDIuMDI5NiAxNC43MTI1QzQxLjk4ODYgMTQuNzk2MiA0MS45Mjk5IDE0Ljg2OTkgNDEuODU3OCAxNC45MjgzQzQxLjc4NTYgMTQuOTg2NyA0MS43MDE3IDE1LjAyODQgNDEuNjEyIDE1LjA1MDZDNDEuMTY4IDE1LjIyNyA0MC44NDQ2IDE1LjEwMTkgNDAuNjkyNCAxNC43MDczTDQwLjU2ODggMTQuMzg2NEw0MS45MTk2IDEzLjg1MDZaIiBmaWxsPSJibGFjayIvPgo8cGF0aCBkPSJNNDMuMDg1MSAxNi4wMTc1TDQwLjkxNTIgMTYuNjI0N0w0MS4wNDExIDE3LjA4NTVMNDMuMjExIDE2LjQ3ODJMNDMuMDg1MSAxNi4wMTc1WiIgZmlsbD0iYmxhY2siLz4KPHBhdGggZD0iTTQzLjczMDIgMTlMNDIuMzQxNCAxOS4yMzc1TDQyLjMzODIgMTkuMjExOEw0My41NDk1IDE3LjkzNDlMNDMuNDg2MSAxNy41NDAyTDQxLjI1NjkgMTcuOTIyTDQxLjMzMyAxOC4zNzQ0TDQyLjcyODIgMTguMTM3TDQyLjczMTQgMTguMTYyN0w0MS41MTA2IDE5LjQ0MjhMNDEuNTc3MiAxOS44MzQyTDQzLjgwNjMgMTkuNDUyNEw0My43MzAyIDE5WiIgZmlsbD0iYmxhY2siLz4KPHBhdGggZD0iTTQyLjc4MjYgMjAuNTIwOUM0Mi4wNDcgMjAuNTQzMyA0MS42MDk0IDIwLjk3MzIgNDEuNjI4NCAyMS42NTAyQzQxLjYyMDMgMjEuNzg0OSA0MS42NDEzIDIxLjkxOTcgNDEuNjg5OSAyMi4wNDU0QzQxLjczODUgMjIuMTcxIDQxLjgxMzUgMjIuMjg0NCA0MS45MDk3IDIyLjM3NzhDNDIuMDA1OSAyMi40NzEyIDQyLjEyMTEgMjIuNTQyMyA0Mi4yNDcyIDIyLjU4NjJDNDIuMzczMyAyMi42MzAxIDQyLjUwNzMgMjIuNjQ1NyA0Mi42Mzk5IDIyLjYzMkg0Mi45MjUzTDQyLjg5NjggMjEuNjY5NUg0Mi41NDE2VjIyLjE2MzZINDIuNTAwNEM0Mi40MzQ5IDIyLjE2MjQgNDIuMzcwMiAyMi4xNDc4IDQyLjMxMDUgMjIuMTIwNUM0Mi4yNTA3IDIyLjA5MzIgNDIuMTk3MSAyMi4wNTM5IDQyLjE1MjkgMjIuMDA1QzQyLjEwODcgMjEuOTU2IDQyLjA3NDggMjEuODk4NSA0Mi4wNTMzIDIxLjgzNThDNDIuMDMxOCAyMS43NzMyIDQyLjAyMzIgMjEuNzA2NyA0Mi4wMjc5IDIxLjY0MDZDNDIuMDI3OSAyMS4yNjIgNDIuMzAzOCAyMS4wMTgyIDQyLjc4OSAyMC45OTg5QzQzLjI3NDEgMjAuOTc5NyA0My41NTYzIDIxLjIwMSA0My41NjkgMjEuNTdDNDMuNTc5NCAyMS42ODYgNDMuNTUxMSAyMS44MDIzIDQzLjQ4ODQgMjEuOUM0My40MjU3IDIxLjk5NzggNDMuMzMyNCAyMi4wNzE0IDQzLjIyMzQgMjIuMTA5TDQzLjIzOTIgMjIuNTgzOUM0My40NjgxIDIyLjUzODYgNDMuNjcxOCAyMi40MDc5IDQzLjgwOTkgMjIuMjE3N0M0My45NDc5IDIyLjAyNzUgNDQuMDEwMiAyMS43OTE3IDQzLjk4NDQgMjEuNTU3MkM0My45NzgxIDIwLjkwMjcgNDMuNTA4OCAyMC40OTUyIDQyLjc4MjYgMjAuNTIwOVoiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik0zMy45NjQxIDcuODE4ODVDMzAuODc2OCA1LjIwMzc3IDI3LjAzMjYgMy42NzU2NCAyMy4wMTE3IDMuNDY1MDdDMjIuNjk0NiAzLjQ2NTA3IDIyLjM3NzUgMy40NDI2IDIyLjA2MDQgMy40NDI2QzIxLjg4NiAzLjQ0MjYgMjEuNzExNiAzLjQ0MjYgMjEuNTM3MiAzLjQ0MjZDMjAuMDM2MSAzLjQ4MTg3IDE4LjU0NTQgMy43MDU5NyAxNy4wOTc5IDQuMTA5OTVDMTYuOTI2NiA0LjE1ODA4IDE2Ljc1NTQgNC4yMDYyMSAxNi41ODczIDQuMjYwNzVDMTYuMDI5MyA0LjQzODI4IDE1LjQ4MjggNC42MzgyNyAxNC45NDggNC44NjA3MkMxMy4yMDY2IDUuNTg4ODcgMTEuNTg1NSA2LjU4MjExIDEwLjE0MDggNy44MDYwMUM5LjczMTc0IDguMTQ5MzEgOS4zMzUzOCA4LjUxMTg2IDguOTU4MDQgOC44OTM2NkM3LjIyMzQ4IDEwLjYzODUgNS44NDY5OSAxMi43MTMxIDQuOTA3NjkgMTQuOTk4MkMzLjk2ODM5IDE3LjI4MzMgMy40ODQ4MyAxOS43MzM3IDMuNDg0ODMgMjIuMjA4NUMzLjQ4NDgzIDI0LjY4MzMgMy45NjgzOSAyNy4xMzM3IDQuOTA3NjkgMjkuNDE4N0M1Ljg0Njk5IDMxLjcwMzggNy4yMjM0OCAzMy43Nzg0IDguOTU4MDQgMzUuNTIzM0M5LjIxODA2IDM1Ljc4MzIgOS40ODc1OSAzNi4wMzM0IDkuNzYwMyAzNi4yNzczQzkuODg3MTMgMzYuMzg5NSAxMC4wMTA4IDM2LjUwMTggMTAuMTQwOCAzNi41OTgxQzEzLjExMTcgMzkuMTI2NSAxNi43OTg4IDQwLjYzNjMgMjAuNjcxNSA0MC45MTAyQzIwLjk1MzcgNDAuOTMyNiAyMS4yMzU5IDQwLjk1MTkgMjEuNTIxMyA0MC45NjE1QzIxLjY5NTcgNDAuOTYxNSAyMS44NzAxIDQwLjk2MTUgMjIuMDQ0NSA0MC45NjE1QzIyLjM2MTYgNDAuOTYxNSAyMi42Nzg3IDQwLjk2MTUgMjIuOTk1OCA0MC45MzU4QzI3LjAxNzEgNDAuNzI5NCAzMC44NjIyIDM5LjIwMiAzMy45NDgzIDM2LjU4NTNDMzQuMzU3MyAzNi4yMzg4IDM0Ljc1MzcgMzUuODc2MiAzNS4xMzEgMzUuNDk3NkMzNi44NjU2IDMzLjc1MjggMzguMjQyMSAzMS42NzgxIDM5LjE4MTQgMjkuMzkzMUM0MC4xMjA3IDI3LjEwOCA0MC42MDQzIDI0LjY1NzYgNDAuNjA0MyAyMi4xODI4QzQwLjYwNDMgMTkuNzA4IDQwLjEyMDcgMTcuMjU3NiAzOS4xODE0IDE0Ljk3MjVDMzguMjQyMSAxMi42ODc1IDM2Ljg2NTYgMTAuNjEyOSAzNS4xMzEgOC44Njc5OUMzNC43Njk1IDguNTI0NjkgMzQuMzczMSA4LjE2ODU3IDMzLjk2NDEgNy44MTg4NVpNMzIuNzY1NSA4LjkwNjQ5QzMyLjE3MTYgOS4zOTY5NyAzMS41NDU1IDkuODQ2MTEgMzAuODkxNSAxMC4yNTA4QzI5LjQ1NzggOC4zNDM1NCAyNy42OTYyIDYuNzEzMjkgMjUuNjkxMSA1LjQzODIyQzI4LjI4NTUgNi4wMTY2OCAzMC43MDkgNy4yMDQ3OSAzMi43NjU1IDguOTA2NDlaTTE4LjgxMzQgNS4zNzcyNkMxOC45MDIxIDUuMzU4MDEgMTguOTg3NyA1LjMzNTU2IDE5LjA3MzQgNS4zMjI3MkwxOC45MDUzIDUuNDMxODFDMTguNTM3NSA1LjY2NjAyIDE4LjE3NiA1LjkxMzA2IDE3LjgyMDggNi4xNjk3M0wxNy4yMzQyIDUuNzY4NjlDMTcuNzU4NSA1LjYxMDQxIDE4LjI4OCA1LjQ3NzggMTguODIyOCA1LjM3MDg1TDE4LjgxMzQgNS4zNzcyNlpNMTkuNDAzMSAxNS42NzYyQzE5LjQwMzEgMTUuNjc2MiAxOS44NDM5IDE1Ljk5NyAyMC42NzE1IDE1LjQ1MTZDMjEuNDk5MSAxNC45MDYyIDIxLjgyMjYgMTYuMzQ2NyAyMi41Mjk3IDE2LjY2MTJDMjMuMjM2OCAxNi45NzU2IDIzLjU0NzYgMTcuMzMxNyAyNC41MjEgMTcuNjAxMkMyNS40OTQ1IDE3Ljg3MDcgMjQuMTI0NyAxOC40MDY1IDIzLjE1MTIgMTguMTM3QzIyLjE3NzcgMTcuODY3NSAyMS40MjMgMTcuOTYwNiAyMS41NjU3IDE4LjQ1NzlDMjEuNzA4NCAxOC45NTUyIDIyLjA5ODQgMTkuNTMyNyAyMS4zMDI1IDIwLjQ3MjdDMjAuNjkwNyAyMS4yMDc3IDIwLjI4MTUgMjIuMDkzMSAyMC4xMTY2IDIzLjAzOTRDMjAuMDcyMyAyMy4zMDExIDIwLjA1NDIgMjMuNTY2NiAyMC4wNjI3IDIzLjgzMTlDMjAuMTA3MSAyNC45NTE2IDE5Ljc0NTYgMjYuMjUxIDE5LjAwMDQgMjYuOTY2NUMxOC4yNTUzIDI3LjY4MiAxNy44MDUgMjcuNTUwNCAxNy4wNTM1IDI3LjAxMTRDMTYuMzAyIDI2LjQ3MjQgMTUuMjM5NyAyNi4xNjEyIDE1LjE1MDkgMjQuODYxOEMxNS4wNjIxIDIzLjU2MjQgMTUuMzI4NSAyMy42MTA1IDE0Ljc5NTggMjMuMjU3NkMxNC42OTk0IDIzLjE5MzEgMTQuNjA3MiAyMy4xMjI0IDE0LjUxOTkgMjMuMDQ1OUMxNC4yNTM1IDIyLjgxNDkgMTQuMjIxOCAyMi42NzY5IDE0LjIyMTggMjIuNjc2OUMxNC4yMDY4IDIyLjc5OTMgMTQuMTk5NCAyMi45MjI1IDE0LjE5OTYgMjMuMDQ1OUMxNC4xOTYzIDIzLjI1NjYgMTQuMjM0IDIzLjQ2NTkgMTQuMzEwNiAyMy42NjE5QzE0LjQ4ODIgMjQuMDYyOSAxNC4zNTUgMjQuNjAxOSAxNC4xMzMgMjUuNzYzNEMxMy45MTExIDI2LjkyNDggMTQuMDg4NiAyNy4yNDI0IDE1Ljk5MTIgMjcuODY4MUMxNy41MTg3IDI4LjQ2NjkgMTguOTcyMyAyOS4yNDMyIDIwLjMyMjcgMzAuMTgxM0MyMS4wMDA4IDMwLjYxNTUgMjEuNjI4NCAzMS4xMjU3IDIyLjE5MzYgMzEuNzAyMUMyMi4yNzQ3IDMxLjc4OSAyMi4zNDU5IDMxLjg4NDcgMjIuNDA2IDMxLjk4NzZDMjMuMDQwMiAzMy4wNjI0IDIyLjI3NiAzMi44ODI4IDIyLjY3MjQgMzMuMjQyMUMyMy4wNjg3IDMzLjYwMTUgMjQuMDg5OCAzNC41MjU1IDI0LjA0NTQgMzUuMzQzNkMyNC4wMDEgMzYuMTYxOCAyMy43MjgzIDM2LjE1MjEgMjIuNTgzNiAzNi4yODM3QzIxLjQzODkgMzYuNDE1MiAyMC41MDM1IDM2LjU1MzIgMjAuMjQwMyAzNS43MDNDMTkuOTc3MSAzNC44NTI3IDE5LjY2MzEgMzQuOTg3NSAxOS4xNzggMzQuOTQyNkMxOC42OTI4IDM0Ljg5NzcgMTguNjg5NyAzNC45NDI2IDE4LjU0MzggMzMuOTEyN0MxOC4zOTc5IDMyLjg4MjggMTguMzY5NCAzMi43OTI5IDE4LjA1ODcgMzIuNTY4NEMxNy45Nzk0IDMyLjUxMzggMTcuODQzIDMyLjQwMTUgMTcuNjQ2NCAzMi4yODZDMTcuMDU5OCAzMS45Mzk1IDE1LjkzNDEgMzEuNTM1MyAxNC4xOTk2IDMyLjI4NkwxNC4wMzE1IDMxLjkyNjdDMTIuMzY0MSAyOS4yNiAxMS40MTUyIDI2LjE5ODQgMTEuMjc5MiAyMy4wNDU5VjIxLjQ0MTdDMTEuNDA3IDE4LjQ1OTYgMTIuMjYzMyAxNS41NTYxIDEzLjc3MTUgMTIuOTkwOEMxNS43NTcyIDEzLjYzNjYgMTcuNjUyOSAxNC41MzY5IDE5LjQxMjYgMTUuNjY5OEwxOS40MDMxIDE1LjY3NjJaTTguMzA0ODQgMTIuMTg1NUM5LjYxNiAxMi4xMDAxIDEwLjkzMjMgMTIuMjE4IDEyLjIwODMgMTIuNTM1MkMxMC42OTM0IDE1LjI1NyA5Ljg0MDE5IDE4LjMwNDMgOS43MTkwNyAyMS40MjU2SDUuMTA1MzNDNS4yNTQ5OSAxOC4wOTMxIDYuMzY3NDMgMTQuODc4MiA4LjMwNDg0IDEyLjE3OTFWMTIuMTg1NVpNMTAuMTUzNSAzNC40NTQ5TDEwLjEwOTEgMzQuNDA2OEM3LjA4ODg2IDMxLjM4NDQgNS4zMDI2NyAyNy4zMjMyIDUuMTA1MzMgMjMuMDI5OEg5LjcxOTA3QzkuODUwNDkgMjYuNDQ2NyAxMC44NjA0IDI5Ljc2OTggMTIuNjQ5IDMyLjY3MUMxMS43OTMgMzMuMTgyIDEwLjk3ODYgMzMuNzYxNCAxMC4yMTM4IDM0LjQwMzZMMTAuMTUzNSAzNC40NTQ5Wk0xMS4zNTIxIDM1LjU0MjVDMTIuMDQxMyAzNC45NzM2IDEyLjc3NCAzNC40NjA4IDEzLjU0MzIgMzQuMDA4OUMxNS4wNDcgMzYuMDY0IDE2LjkyNzggMzcuODA2OSAxOS4wODI5IDM5LjE0MjRDMTYuMjQ0MiAzOC42MjY5IDEzLjU4MyAzNy4zODU1IDExLjM1MjEgMzUuNTM2MVYzNS41NDI1Wk0yMi4yODg3IDM4Ljk5MTZDMTkuMjM5MiAzNy42MjQgMTYuNTY1OCAzNS41MjM3IDE0LjUwMDggMzIuODczMkMxNi4yMjkgMzIuNDAxNSAxOC4wODQgMzIuNTUyMyAxNy45MTYgMzQuMTM0MUMxNy43NDc5IDM1LjcxNTggMTkuMjE2IDM1LjY1OCAyMC4wOTc2IDM2LjYwNDVDMjAuOTc5MSAzNy41NTEgMjIuODAyNCAzNi42NTkxIDIzLjkwMjcgMzYuNzY0OUMyNS4wMDMgMzYuODcwOCAyNS40MDg5IDM0LjkyMzMgMjQuNTM2OSAzNC4xOTgyQzI0LjI0NzggMzMuOTQzIDI0LjAxMjIgMzMuNjMxOSAyMy44NDM5IDMzLjI4MzFDMjMuNjc1NiAzMi45MzQyIDIzLjU3ODEgMzIuNTU0OSAyMy41NTcxIDMyLjE2NzNDMjMuNDI3NCAzMS4zNzU4IDIzLjA0MDEgMzAuNjUwOSAyMi40NTY4IDMwLjEwNzVDMjEuOTI3IDI5LjQ2OTkgMjEuMzU0OSAyOC44Njk2IDIwLjc0NDQgMjguMzEwOEMxOS43OTMyIDI3LjQ3MDIgMTkuOTY0NCAyNy4wNDk5IDIwLjI3NTIgMjYuNDE3OUMyMC40NjI3IDI2LjEwMTggMjAuNTE5NiAyNS43MjM4IDIwLjQzMzcgMjUuMzY1NUMyMC45MDYxIDI1LjQ1MTEgMjEuMzkyOCAyNS4zOTY1IDIxLjgzNTIgMjUuMjA4M0MyMi40NDQgMjQuOTE4NiAyMi45NyAyNC40NzcgMjMuMzYzNiAyMy45MjVDMjMuNTgzNSAyMy42NDM4IDIzLjc4MjggMjMuMzQ2OCAyMy45NTk4IDIzLjAzNjJMMjQuNzY4NCAyMS40MzJMMjQuOTUyMyAyMS4wNDA2QzI1LjA1OTggMjAuODMyMiAyNS4xNzg0IDIwLjYyOTggMjUuMzA3NCAyMC40MzQyQzI1Ljc0NzYgMTkuNzA5NSAyNi4zNTc1IDE5LjEwNTYgMjcuMDgzMiAxOC42NzZDMjcuNzYxNyAxOC4zNTUyIDI4LjA3MjUgMTcuOTkyNiAyNy44NjMyIDE3LjgzMjJDMjcuNjUzOSAxNy42NzE4IDI3LjUwMTcgMTcuNTY5MSAyNy45Njc5IDE2LjgzNDRDMjguNDM0IDE2LjA5OTcgMjkuODg5NCAxNy42MjM3IDMwLjY2OTUgMTguMjAxMkMzMC45MDEzIDE4LjM2MTIgMzEuMTc3NCAxOC40NDI1IDMxLjQ1NzggMTguNDMzM0MzMS43MzgzIDE4LjQyNDEgMzIuMDA4NiAxOC4zMjQ4IDMyLjIyOTYgMTguMTQ5OUMzMi4yMjk2IDE4LjE0OTkgMzAuNjY5NSAxNi42MjI3IDI5Ljc4OCAxNS43ODIxQzI4LjkwNjUgMTQuOTQxNSAyOS44Mzg3IDE1LjIwNDYgMjkuMzcyNiAxNC40MTUzQzI4Ljk5NzUgMTQuMDI0MiAyOC41MTY1IDEzLjc1NCAyNy45OSAxMy42Mzg5QzI3Ljg0MDMgMTMuNjE4NSAyNy42OTIgMTMuNTg4NSAyNy41NDYxIDEzLjU0OUMyNi42NTgyIDEzLjMxNDggMjUuNjY4OSAxMi4zODc2IDI1LjY2ODkgMTIuMzg3NkMyNC4zNjI1IDEwLjg5MjUgMjEuNDA0IDguNjgxOSAxOS4yNDc4IDcuMTUxNUMxOS42NDEgNi44ODUyIDIwLjA0MzcgNi42MzgxNiAyMC40NTI3IDYuNDAwNzRDMjEuMDUzNyA2LjA1NDI0IDIxLjY3NDEgNS43NDM1NyAyMi4zMTA5IDUuNDcwMzFDMjUuMTM0NiA2LjY4Mzg5IDI3LjYwNzIgOC42MDM4MSAyOS40OTYyIDExLjA0OTdDMjguNjQzMSAxMS40Njg1IDI3Ljc1NjMgMTEuODEzIDI2Ljg0NTMgMTIuMDc5NkMyNy4zNjU0IDEyLjU3MDUgMjcuNDc5NSAxMi41NDggMjguMDYzIDEyLjU0OEMyOC41MDY2IDEyLjU1NjggMjguOTQxNiAxMi42NzM0IDI5LjMzMTMgMTIuODg4MUMyOS43MDU1IDEyLjcyNzcgMzAuMDczMyAxMi41NjczIDMwLjQzNDggMTIuMzc0OEMzMS4zODggMTMuODYzMSAzMi4xMjA4IDE1LjQ4NDQgMzIuNjEwMSAxNy4xODczQzMyLjk4MzUgMTcuNjA1OCAzMy40MjE1IDE3Ljk2MDEgMzMuOTA3IDE4LjIzNjVDMzQuNjY4MSAxOC42NjMyIDMzLjk0NTEgMTkuMDU0NiAzMy4wNjY3IDE5LjIyNDdDMzMuMTg5MiAxOS45NTU5IDMzLjI2NjUgMjAuNjk0MiAzMy4yOTgyIDIxLjQzNTNIMjYuMjIwN0MyNS45Nzk3IDIxLjkxMDEgMjUuNjkxMSAyMi40NTg3IDI1LjMyOTYgMjMuMDM5NEgzMy4yOTgyQzMzLjE2MzcgMjYuMjYyMyAzMi4xNzgzIDI5LjM4OTggMzAuNDQ0MyAzMi4wOTY3QzI5LjA3NDkgMzEuMzk3NiAyNy42MjM5IDMwLjg3NTkgMjYuMTI1NSAzMC41NDM5QzI1LjQwNDYgMzAuMzg0NSAyNC42NzUxIDMwLjI2NzcgMjMuOTQwNyAzMC4xOTQyQzI0LjI0NjUgMzAuNzIzMiAyNC40NzMxIDMxLjI5NTEgMjQuNjEzIDMxLjg5MTRDMjUuMjU0MiAzMS45ODcxIDI1Ljg4OTQgMzIuMTE5OSAyNi41MTU1IDMyLjI4OTJDMjcuNTQ4OCAzMi41Njc5IDI4LjU1MzMgMzIuOTQ2MSAyOS41MTUzIDMzLjQxODZDMjcuODg1IDM1LjUxMDMgMjUuODIzNSAzNy4yMTcyIDIzLjQ3NDYgMzguNDIwNUMyMy4wODQ2IDM4LjYyMjYgMjIuNjkxNCAzOC44MTE5IDIyLjI4ODcgMzguOTg1MVYzOC45OTE2Wk0yNS42OTExIDM4Ljk5MTZDMjcuNjk2OSAzNy43MTc0IDI5LjQ1ODcgMzYuMDg3IDMwLjg5MTUgMzQuMTc5QzMxLjU0NTUgMzQuNTg0OCAzMi4xNzE2IDM1LjAzNSAzMi43NjU1IDM1LjUyNjVDMzAuNzEgMzcuMjI3OSAyOC4yODc3IDM4LjQxNjEgMjUuNjk0MyAzOC45OTQ4TDI1LjY5MTEgMzguOTkxNlpNMzMuOTY0MSAzNC40NDUzQzMzLjI4MTMgMzMuODY2NyAzMi41NTg2IDMzLjMzODEgMzEuODAxNSAzMi44NjM1QzMzLjY2NjIgMjkuOTE1MyAzNC43MjEzIDI2LjUxNzcgMzQuODU4MyAyMy4wMjAySDM5LjAxMjJDMzguODE2IDI3LjMzNzkgMzcuMDEyNSAzMS40MjA2IDMzLjk2NDEgMzQuNDQ4NVYzNC40NDUzWk0zNC44NjE1IDIxLjQxNkMzNC43MjUgMTcuOTE4NCAzMy42Njk4IDE0LjUyMDcgMzEuODA0NyAxMS41NzI3QzMyLjU2MTggMTEuMDk4MSAzMy4yODQ1IDEwLjU2OTUgMzMuOTY3MyA5Ljk5MDkzQzM3LjAxNSAxMy4wMTkgMzguODE3NCAxNy4xMDE4IDM5LjAxMjIgMjEuNDE5MkwzNC44NjE1IDIxLjQxNloiIGZpbGw9ImJsYWNrIi8+CjxwYXRoIGQ9Ik0yMS4zMDI0IDI3LjIyNjNDMjEuOTEyMiAyNy43NDExIDIyLjQ5MjMgMjguMjkwNiAyMy4wNDAxIDI4Ljg3MjNWMjUuNjg2M0MyMy4wNDAxIDI1LjY4NjMgMjIuMzE3MSAyNi4zNjk3IDIxLjY2MDggMjYuMzUzN0MyMS4yNzM5IDI2LjM0NCAyMS4wOTYzIDI3LjA0NjcgMjEuMzAyNCAyNy4yMjYzWiIgZmlsbD0iYmxhY2siLz4KPHBhdGggZD0iTTc1LjAwNzggMTUuOTc2MVY0MC45NzYxSDgwLjAwNzhWMjkuOTc2MUg4OS4wMDc4TDg2LjAwNzggMjUuOTc2MUg4MC4wMDc4VjE5Ljk3NjFIOTIuMDA3OFYxNS45NzYxSDc1LjAwNzhaIiBmaWxsPSIjMTU5RDRDIi8+CjxwYXRoIGQ9Ik05Mi41MDc4IDMyLjk3NjFMODcuMDA3OCAyNS45NzYxSDkxLjAwNzhMOTYuNTA3OCAzMi45NzYxTDkxLjAwNzggNDAuNDc2MUg4Ny4wMDc4TDkyLjUwNzggMzIuOTc2MVoiIGZpbGw9IiMxNTlENEMiLz4KPHBhdGggZD0iTTk2LjUwNzggMzIuOTc2MUwxMDIuMDA4IDI1Ljk3NjFIOTguMDA3OEw5Mi41MDc4IDMyLjk3NjFMOTguMDA3OCA0MC40NzYxSDEwMi4wMDhMOTYuNTA3OCAzMi45NzYxWiIgZmlsbD0iIzE1OUQ0QyIvPgo8cGF0aCBkPSJNNzMuMzk0NSAxMi45NzYxTDcxLjExNzIgNi40MTc5N0g3MS4wNzQyQzcxLjEzNTEgNy4zOTE5MyA3MS4xNjU1IDguMzA1MDEgNzEuMTY1NSA5LjE1NzIzVjEyLjk3NjFINzBWNS4xMjM1NEg3MS44MTAxTDczLjk5MDcgMTEuMzcwMUg3NC4wMjI5TDc2LjI2ODEgNS4xMjM1NEg3OC4wODM1VjEyLjk3NjFINzYuODQ4MVY5LjA5Mjc3Qzc2Ljg0ODEgOC43MDI0NyA3Ni44NTcxIDguMTk0MDEgNzYuODc1IDcuNTY3MzhDNzYuODk2NSA2Ljk0MDc2IDc2LjkxNDQgNi41NjEyIDc2LjkyODcgNi40Mjg3MUg3Ni44ODU3TDc0LjUyNzggMTIuOTc2MUg3My4zOTQ1WiIgZmlsbD0iIzg5ODk4OSIvPgo8cGF0aCBkPSJNODUuMDIyOSAxMi45NzYxTDg0LjIzODggMTAuNzk1NEg4MS4yMzYzTDgwLjQ2ODMgMTIuOTc2MUg3OS4xMTQ3TDgyLjA1MjcgNS4wOTEzMUg4My40NDkyTDg2LjM4NzIgMTIuOTc2MUg4NS4wMjI5Wk04My45MDA0IDkuNjg4OTZMODMuMTY0NiA3LjU1MTI3QzgzLjExMDggNy40MDgwNCA4My4wMzU2IDcuMTgyNDUgODIuOTM5IDYuODc0NTFDODIuODQ1OSA2LjU2NjU3IDgyLjc4MTQgNi4zNDA5OCA4Mi43NDU2IDYuMTk3NzVDODIuNjQ4OSA2LjYzODE4IDgyLjUwNzUgNy4xMTk3OSA4Mi4zMjEzIDcuNjQyNThMODEuNjEyMyA5LjY4ODk2SDgzLjkwMDRaIiBmaWxsPSIjODk4OTg5Ii8+CjxwYXRoIGQ9Ik05MC43NjQ2IDYuMTExODJDOTAuMDI3IDYuMTExODIgODkuNDQ2OSA2LjM3MzIxIDg5LjAyNDQgNi44OTZDODguNjAxOSA3LjQxODc4IDg4LjM5MDYgOC4xNDAzIDg4LjM5MDYgOS4wNjA1NUM4OC4zOTA2IDEwLjAyMzggODguNTkyOSAxMC43NTI0IDg4Ljk5NzYgMTEuMjQ2NkM4OS40MDU4IDExLjc0MDcgODkuOTk0OCAxMS45ODc4IDkwLjc2NDYgMTEuOTg3OEM5MS4wOTc3IDExLjk4NzggOTEuNDE5OSAxMS45NTU2IDkxLjczMTQgMTEuODkxMUM5Mi4wNDMgMTEuODIzMSA5Mi4zNjcgMTEuNzM3MSA5Mi43MDM2IDExLjYzMzNWMTIuNzM0NEM5Mi4wODc3IDEyLjk2NzEgOTEuMzg5NSAxMy4wODM1IDkwLjYwODkgMTMuMDgzNUM4OS40NTk1IDEzLjA4MzUgODguNTc2OCAxMi43MzYyIDg3Ljk2MDkgMTIuMDQxNUM4Ny4zNDUxIDExLjM0MzMgODcuMDM3MSAxMC4zNDYgODcuMDM3MSA5LjA0OThDODcuMDM3MSA4LjIzMzQgODcuMTg1NyA3LjUxOTA0IDg3LjQ4MjkgNi45MDY3NEM4Ny43ODM3IDYuMjk0NDMgODguMjE3IDUuODI1MzYgODguNzgyNyA1LjQ5OTUxQzg5LjM0ODUgNS4xNzM2NyA5MC4wMTI3IDUuMDEwNzQgOTAuNzc1NCA1LjAxMDc0QzkxLjU3NzUgNS4wMTA3NCA5Mi4zMTg3IDUuMTc5MDQgOTIuOTk5IDUuNTE1NjJMOTIuNTM3MSA2LjU4NDQ3QzkyLjI3MjEgNi40NTkxNSA5MS45OTEgNi4zNDk5MyA5MS42OTM4IDYuMjU2ODRDOTEuNDAwMiA2LjE2MDE2IDkxLjA5MDUgNi4xMTE4MiA5MC43NjQ2IDYuMTExODJaIiBmaWxsPSIjODk4OTg5Ii8+CjxwYXRoIGQ9Ik05NS42NzkyIDguNzc1ODhIOTYuNTcwOEM5Ny4xNjg4IDguNzc1ODggOTcuNjAyMSA4LjY2NDg4IDk3Ljg3MDYgOC40NDI4N0M5OC4xMzkyIDguMjIwODcgOTguMjczNCA3Ljg5MTQ0IDk4LjI3MzQgNy40NTQ1OUM5OC4yNzM0IDcuMDEwNTggOTguMTI4NCA2LjY5MTg5IDk3LjgzODQgNi40OTg1NEM5Ny41NDgzIDYuMzA1MTggOTcuMTExNSA2LjIwODUgOTYuNTI3OCA2LjIwODVIOTUuNjc5MlY4Ljc3NTg4Wk05NS42NzkyIDkuODM5MzZWMTIuOTc2MUg5NC4zOTU1VjUuMTIzNTRIOTYuNjEzOEM5Ny42MjcxIDUuMTIzNTQgOTguMzc3MyA1LjMxMzMxIDk4Ljg2NDMgNS42OTI4N0M5OS4zNTEyIDYuMDcyNDMgOTkuNTk0NyA2LjY0NTM0IDk5LjU5NDcgNy40MTE2MkM5OS41OTQ3IDguMzg5MTYgOTkuMDg2MyA5LjA4NTYxIDk4LjA2OTMgOS41MDA5OEwxMDAuMjg4IDEyLjk3NjFIOTguODI2N0w5Ni45NDY4IDkuODM5MzZIOTUuNjc5MloiIGZpbGw9IiM4OTg5ODkiLz4KPHBhdGggZD0iTTEwOC40MDMgOS4wMzkwNkMxMDguNDAzIDEwLjMxNzQgMTA4LjA4MyAxMS4zMTEgMTA3LjQ0MiAxMi4wMkMxMDYuODA1IDEyLjcyOSAxMDUuOSAxMy4wODM1IDEwNC43MjkgMTMuMDgzNUMxMDMuNTQ0IDEzLjA4MzUgMTAyLjYzMyAxMi43MzI2IDEwMS45OTYgMTIuMDMwOEMxMDEuMzYyIDExLjMyNTQgMTAxLjA0NSAxMC4zMjQ1IDEwMS4wNDUgOS4wMjgzMkMxMDEuMDQ1IDcuNzMyMSAxMDEuMzY0IDYuNzM2NjUgMTAyLjAwMSA2LjA0MTk5QzEwMi42NDIgNS4zNDczMyAxMDMuNTU1IDUgMTA0Ljc0IDVDMTA1LjkwOCA1IDEwNi44MSA1LjM1MjcgMTA3LjQ0NyA2LjA1ODExQzEwOC4wODUgNi43NjM1MSAxMDguNDAzIDcuNzU3MTYgMTA4LjQwMyA5LjAzOTA2Wk0xMDIuNDA5IDkuMDM5MDZDMTAyLjQwOSAxMC4wMDU5IDEwMi42MDQgMTAuNzM5OSAxMDIuOTk1IDExLjI0MTJDMTAzLjM4NSAxMS43Mzg5IDEwMy45NjMgMTEuOTg3OCAxMDQuNzI5IDExLjk4NzhDMTA1LjQ5MiAxMS45ODc4IDEwNi4wNjcgMTEuNzQwNyAxMDYuNDU0IDExLjI0NjZDMTA2Ljg0NCAxMC43NTI0IDEwNy4wMzkgMTAuMDE2NiAxMDcuMDM5IDkuMDM5MDZDMTA3LjAzOSA4LjA3NTg1IDEwNi44NDYgNy4zNDUzOCAxMDYuNDU5IDYuODQ3NjZDMTA2LjA3NiA2LjM0OTkzIDEwNS41MDMgNi4xMDEwNyAxMDQuNzQgNi4xMDEwN0MxMDMuOTcgNi4xMDEwNyAxMDMuMzg5IDYuMzQ5OTMgMTAyLjk5NSA2Ljg0NzY2QzEwMi42MDQgNy4zNDUzOCAxMDIuNDA5IDguMDc1ODUgMTAyLjQwOSA5LjAzOTA2WiIgZmlsbD0iIzg5ODk4OSIvPgo8L3N2Zz4K">
                                                    </div>
                                                </div>
                                                <div class="v2-card__cta v2-card__cta--left">
                                                    <div class="v2-card__cta-wrapper">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
        
        									
        											  <!-- ======= Call To Action Section ======= -->
                                    <section id="call-to-action" class="call-to-action">
                                      <div class="container" data-aos="zoom-out">

                                        <div class="row justify-content-center">
                                          <div class="col-lg-8 text-center">
                                            <h3>Call To Action</h3>
                                            <p>Join more than 1 million users worldwide investing with {{$settings->site_name}}  Trading Limited.</p>
                                            <a class="cta-btn" href="register">Register</a>
                                            </div>
                                          </div>
                                        </div>
                                    </section><!-- End Call To Action Section -->
        
                                          		<div class="cryptohopper-web-widget" data-id="1" data-table_style="dark" data-realtime="on" data-table_length="7"></div> 
        						 
                           
                <div class="v2" data-styles="bbox">
                    <div class="v2-bbox">
                        <div class="v2-bbox__background v2-bbox__background--bg-bottom-center" data-behavior="bbox" data-instance="bbox__DWXWX3">
                            <picture class="v2-picture v2-picture--background">
                                <img alt="" class="" loading="lazy" data-object-fit="cover" data-object-position="bottom center" data-src="img/testimonials-bg.jpg" src="temp/custom/img/testimonials-bg.jpg"/>
                          </picture>
                        </div>
                      
                        <div class="v2-bbox__foreground">
                            <div class="v2">
                                <div class="v2-wrapper">
                                    <div class="v2-row v2-xs-align--middle v2-typography--inverted v2-mat80 v2-mab0 v2-sm-max-mab0">
                                        <div class="v2-col-xs-12 v2-col-md-8 v2-clearfix v2-md-align-self--start v2-md-text-align--left v2-text-align--left v2-row-sm-x">
                                            <h3 class="pre-header v2-hide-empty "></h3>
                                            <h2 class="v2-h2" style="padding-left: 20px !important;">Why choose {{$settings->site_name}}  Trading Limited?</h2>
                                            <p class="v2-sh1 v2-hide-empty "></p>
                                            <div class="v2-mab30 v2-hide-empty "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="v2" data-styles="media-element">
                                <div data-qa="uvp" class="v2-bbox v2-mat0 v2-mab30n v2-sm-max-mab150" data-styles="bbox">
                                    <div class="v2-bbox__background" data-behavior="bbox" data-instance="bbox__AMXZ75"></div>
                                    <div class="v2-bbox__foreground">
                                        <div class="v2-wrapper">
                                            <div data-styles="show-more" class="v2-mab25 v2-show-more">
                                                <div class="v2-row v2-show-more__wrap v2-row-sm-6 v2-row-md-3">
                                                    <div class="v2-col v2-align--top v2-media-element v2-show-more__item v2-borderless" data-styles="media-element show-more">
                                                        <div class="v2-media-element__media v2-hide-empty "></div>
                                                        <div class="v2-media-element__text v2-align-self--top">
                                                            <div class="v2-media-element__title">
                                                                <h2 class="v2-h5"></h2>
                                                            </div>
                                                            <p class="v2-media-element__body"></p>
                                                            <h2 class="v2-h4" style="color:#fff; padding-left: 20px !important; margin-bottom:-15px">Focused on the Client</h2>
                                                          	<p></p>
                                                            <p class="text--body" style="color:#fff; padding-left: 20px !important;">Size does not matter. At {{$settings->site_name}}  Trading Limited the client comes first regardless of net capital worth, account type or size of investment. All our clients receive the same quality services, the same execution, and the same level of support. {{$settings->site_name}}  Trading Limited was founded on these values, and that will not change. </p>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="v2-col v2-align--top v2-media-element v2-show-more__item v2-borderless" data-styles="media-element show-more">
                                                        <div class="v2-media-element__media v2-hide-empty "></div>
                                                        <div class="v2-media-element__text v2-align-self--top">
                                                            <div class="v2-media-element__title">
                                                                <h2 class="v2-h5"></h2>
                                                          </div>
                                                            <p class="v2-media-element__body"></p>
                                                            <h2 class="v2-h4" style="color:#fff; padding-left: 20px !important; margin-bottom:-15px">Range of Trading Instruments</h2>
                                                            <p></p>
                                                            <p class="text--body" style="color:#fff; padding-left: 20px !important; margin-bottom:-50px"> Our clients can choose to trade forex and CFDs on stock indices, commodities, stocks, metals and energies from the same trading account. With a wide range of trading instruments available from a single multi asset platform {{$settings->site_name}}  Trading Limited makes trading easier and efficient. </p>
                                                        </div>
                                                    </div>
                                                    <div class="v2-col v2-align--top v2-media-element v2-show-more__item v2-borderless" data-styles="media-element show-more">
                                                        <div class="v2-media-element__media v2-hide-empty "></div>
                                                        <div class="v2-media-element__text v2-align-self--top">
                                                            <div class="v2-media-element__title">
                                                                <h2 class="v2-h5"></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="v2-col v2-align--top v2-media-element v2-show-more__item v2-borderless" data-styles="media-element show-more">
                                                        <div class="v2-media-element__media v2-hide-empty "></div>
                                                        <div class="v2-media-element__text v2-align-self--top">
                                                            <div class="v2-media-element__title">
                                                                <h2 class="v2-h5"></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="v2-col v2-align--top v2-media-element v2-show-more__item v2-borderless" data-styles="media-element show-more">
                                                        <div class="v2-media-element__media v2-hide-empty "></div>
                                                        <div class="v2-media-element__text v2-align-self--top">
                                                            <div class="v2-media-element__title">
                                                                <h2 class="v2-h5"></h2>
                                                            </div>
                                                            <p class="v2-media-element__body"></p>
                                                            <h2 class="v2-h4" style="color:#fff; padding-left: 20px !important; margin-bottom:-15px">Easy and Convenient</h2>
                                                            <p></p>
                                                            <p class="text--body" style="color:#fff; padding-left: 20px !important;">All our systems are built and updated with the client in mind. Starting from our account opening procedure, to managing your account, depositing or withdrawing funds and finally trading, its all straightforward simple and easy to use for all our clients.</p>
                                                        </div>
                                                    </div>
                                                    <div class="v2-col v2-align--top v2-media-element v2-show-more__item v2-borderless" data-styles="media-element show-more">
                                                        <div class="v2-media-element__media v2-hide-empty "></div>
                                                        <div class="v2-media-element__text v2-align-self--top">
                                                            <div class="v2-media-element__title">
                                                                <h2 class="v2-h5"></h2>
                                                            </div>
                                                            <p class="v2-media-element__body"></p>
                                                            <h2 class="v2-h4" style="color:#fff; padding-left: 20px !important; margin-bottom:-15px">Transparent and Fair</h2>
                                                            <p></p>
                                                            <p class="text--body" style="color:#fff; padding-left: 20px !important;">At {{$settings->site_name}}  Trading Limited what you see is what you get, with no hidden terms. Be that pricing, execution or promotions. What we advertise is what we give our clients, regardless of the size of their investment.</p>
                                                        </div>
                                                    </div>
                                                    <div class="v2-col v2-align--top v2-media-element v2-show-more__item v2-borderless" data-styles="media-element show-more">
                                                        <div class="v2-media-element__media v2-hide-empty "></div>
                                                        <div class="v2-media-element__text v2-align-self--top">
                                                            <div class="v2-media-element__title">
                                                                <h2 class="v2-h5"></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="v2-col v2-align--top v2-media-element v2-show-more__item v2-borderless" data-styles="media-element show-more">
                                                        <div class="v2-media-element__media v2-hide-empty "></div>
                                                        <div class="v2-media-element__text v2-align-self--top">
                                                            <div class="v2-media-element__title">
                                                                <h2 class="v2-h5"></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="v2-btn-wrapper v2-btn-wrapper--center v2-pat20"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="v2">
                                <div class="v2-bbox v2-mat20n v2-mab100" data-styles="bbox">
                                    <div class="v2-bbox__background" data-behavior="bbox" data-instance="bbox__GX6JBZ"></div>
                                    <div class="v2-bbox__foreground">
                                        <div class="v2-wrapper">
                                            <div class="v2-row v2-align--center v2-md-align--start">
                                                <div class="v2-show-md" style="height:0;width:0"></div>
                                                <div class="v2-show-sm" style="height:0;width:0"></div>
                                                <div class="v2-hide-sm " style="height:0;width:0"></div>
                                                <div class="v2-hero v2-col-xs-12 v2-md-align--start v2-col-md-6" data-styles="hero">
                                                    <div class="v2-hero__content v2-md-text-align--left v2-text-align--left v2-row-sm-x">
                                                        <div class="v2-row v2-pab15">
                                                            <div class="v2-col-xs-12">
                                                                <h3 class="pre-header v2-hide-empty "></h3>
                                                                <h1 class="v2-hide-empty v2-h1 "></h1>
                                                                <p class="v2-hero__content__papagraph v2-sh1 v2-hide-empty "></p>
                                                                <div class="v2-mab30 v2-hide-empty "></div>
                                                                <div class="v2-btn-wrapper v2-show-sm v2-show-md">
                                                                    <a href="register" class="v2-btn v2-btn-secondary--inverted" style="padding-left: 30px !important;">Find out more</a>
                                                                </div>
                                                                <div class="v2-product-grid v2-align--start v2-md-align--start" data-styles="products" data-behavior="adjust-grid-item-height" data-instance="adjust-grid-item-height__RYBGZQ"></div>
                                                                <small class="v2-hide-empty "></small>
                                                            </div>
                                                        </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                          </div>
        
       <div id="stamped-reviews-widget" data-widget-type="reviews-popup" data-layout="horizontal" data-effect="jelly" data-delay-seconds="5" data-show-seconds="15" data-position="bottomleft" data-color-background="#240101" data-color-star="#e8cd05"></div>
         <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>FAQs</h2>

        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-10">

            <div class="accordion accordion-flush" id="faqlist">

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                    <i class="bi bi-question-circle question-icon"></i>
                   Is {{$settings->site_name}}  a safe cryptocurrency trading platform?
                  </button>
                </h3>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                  	{{$settings->site_name}}  Trading Limited controls one of the world's most sophisticated security technology and maintenance team, and is constantly upgrading our security systems to ensure the safety of user assets and accounts.
                  </div>
                </div>
              </div><!-- # Faq item-->

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                    <i class="bi bi-question-circle question-icon"></i>
                    What is Forex Trading?
                  </button>
                </h3>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
					Forex trading is the buying and selling of currencies on the foreign exchange market. When you trade forex online, you are counting on the value of the currency changing in your favor in the future.

                  </div>
                </div>
              </div><!-- # Faq item-->

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                    <i class="bi bi-question-circle question-icon"></i>
                    What moves the forex market?
                  </button>
                </h3>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
					There are several key factors that move the forex market: interest rates, inflation, economic stability, central banks and global events. 
                  </div>
                </div>
              </div><!-- # Faq item-->

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                    <i class="bi bi-question-circle question-icon"></i>            
					What is commodity trading?
                  </button>
                </h3>
                <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    <i class="bi bi-question-circle question-icon"></i>
					Commodity trading is the buying and selling of raw materials, such as precious metals and oil, that are important to the global economy.                   </div>
                </div>
              </div><!-- # Faq item-->

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-5">
                    <i class="bi bi-question-circle question-icon"></i>
                    How do CFDs work?
                  </button>
                </h3>
                <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
						Contract for Difference (CFD) is a popular format for online trading. Its main feature is the ability to profit from price movements of the underlying instrument in any direction. In this case, you do not need to own this asset physically.
                  </div>
                </div>
              </div><!-- # Faq item-->

            </div>

          </div>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->
        
        
        
        
     
                      
                            
        </main>
      
         <style>
        @media (min-width: 768px) {
            .v2 .v2-accordion-list__item__header {
                font-size: .875rem;
                line-height:1.0625rem
            }
        }

        .v2 .v2-accordion-list {
            overflow: hidden;
            padding:1px 0
        }

        @media (min-width: 768px) {
            .v2 .v2-accordion-list {
                padding:0
            }
        }

        @media (min-width: 768px) {
            .v2 .v2-accordion-list__item {
                padding-top:40px
            }
        }

        .v2 .v2-accordion-list__item:before {
            background: #e6e6e8;
            content: "";
            display: block;
            height: 1px;
            left: 0;
            position: absolute;
            top: -1px;
            width:400%
        }

        .v2 .v2-accordion-list__item:last-child:after {
            background: #e6e6e8;
            content: "";
            display: block;
            height: 1px;
            left: 0;
            position: absolute;
            bottom: -1px;
            width:100%
        }

        @media (min-width: 768px) {
            .v2 .v2-accordion-list__item:last-child:after {
                width:400%
            }
        }

        .v2 .v2-accordion-list__item__header {
            display:none
        }

        @media (min-width: 768px) {
            .v2 .v2-accordion-list__item__header {
                display:block
            }
        }

        .v2 .v2-accordion-list__item__content {
            display: none;
            margin-bottom:30px
        }

        @media (min-width: 768px) {
            .v2 .v2-accordion-list__item__content {
                display: block;
                margin-bottom:40px
            }
        }

        .v2 .v2-accordion-list__item input[type=checkbox]:checked ~ .v2-accordion-list__item__content {
            display:block
        }

        .v2 .v2-accordion-list .v2-accordion-list__item.v2-accordion-list__item--no-border-top:before {
            display:none
        }

        .v2 .v2-accordion-list--border-gray .v2-accordion-list__item:before, .v2 .v2-accordion-list--border-gray .v2-accordion-list__item:last-child:after {
            background:#313131
        }

        @media (min-width: 768px) {
            .v2 .v2-accordion-list--no-border-desktop .v2-accordion-list__item:before, .v2 .v2-accordion-list--no-border-desktop .v2-accordion-list__item:last-child:after {
                display: none
            }
        }
        </style>
        <style>
        .v2 .v2-bbox {
            width: 100%;
            overflow: hidden;
            position:relative
        }

        .v2 .v2-bbox__background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            bottom: 0;
            z-index: 1;
            overflow:hidden
        }

        .v2 .v2-bbox__background img, .v2 .v2-bbox__background picture, .v2 .v2-bbox__background video {
            -o-object-fit: cover;
            object-fit: cover;
            -o-object-position: center;
            object-position: center;
            position: absolute;
            top: 0;
            left: 0;
            width:100%
        }

        .v2 .v2-bbox__background img, .v2 .v2-bbox__background picture {
            height:100%
        }

        @media (min-width: 1024px) {
            .v2 .v2-bbox__background video {
                height:100%
            }
        }

        .v2 .v2-bbox__background--bg-bottom-center img {
            -o-object-position: bottom center;
            object-position:bottom center
        }

        .v2 .v2-bbox__foreground {
            width: 100%;
            position: relative;
            z-index: 2
        }
        </style>
        <style>
        .v2 .v2-card__rte {
            font-size: .875rem;
            line-height:1.25rem
        }

        .v2 .v2-card {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: transparent;
            position:relative
        }

        .v2 .v2-card__header {
            line-height: 1.25rem;
            margin-bottom:15px
        }

        .v2 .v2-card__header .v2-card--inline {
            margin-bottom:0
        }

        .v2 .v2-card--inline {
            display:inline-block
        }

        .v2 .v2-card.v2-typography--inverted .v2-card__rte {
            color:#aaa
        }

        .v2 .v2-card__text-content {
            direction: ltr;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            margin: 0;
            -ms-flex: 1 1 auto;
            flex:1 1 auto
        }

        .v2 .v2-card__text-content > :first-child {
            margin-top:0
        }

        .v2 .v2-card__text-content > :last-child {
            margin-bottom:0
        }

        .v2 .v2-card__rte {
            margin-bottom:15px
        }

        @media (min-width: 768px) {
            .v2 .v2-card__rte {
                margin-bottom:20px
            }
        }

        .v2 .v2-card__rte .rte--output > :last-child {
            margin-bottom:0
        }

        .v2 .v2-card .v2-md-text-align--left .v2-card__rte {
            margin-left: 0;
            margin-right:auto
        }

        .v2 .v2-card .v2-md-text-align--center .v2-card__rte {
            margin-left: auto;
            margin-right:auto
        }

        .v2 .v2-card__cta {
            display: -ms-flexbox;
            display: flex;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            -ms-flex-align: end;
            align-items: flex-end;
            -ms-flex-pack:center
        }

        .v2 .v2-card__cta-wrapper {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction:column
        }

        .v2 .v2-card__cta-wrapper .v2-btn:not(:first-child) {
            margin:5px 0 0
        }

        .v2 .v2-card__cta--left {
            -ms-flex-pack: start;
            justify-content:flex-start
        }

        .v2 .v2-card__icon {
            width: 18px;
            height: 18px;
            margin-right: 5px;
            vertical-align:top
        }

        .v2 .v2-card__icon img {
            width: 100%;
            vertical-align:top
        }

        .v2 a.v2-card .v2-card__text-content .v2-card__title {
            color: #0076ff;
            text-decoration: none;
            transition: color .15s cubic-bezier(.645, .045, .355, 1);
            font-weight:700
        }

        .v2 a.v2-card .v2-card__text-content .v2-card__title:hover {
            color: #005ecc;
            text-decoration:underline
        }

        .v2 .v2-typography--inverted .v2-card__text-content .v2-btn.v2-btn--link {
            color: #0076ff;
            text-decoration:none
        }

        .v2 .v2-typography--inverted .v2-card__text-content .v2-btn.v2-btn--link:hover {
            text-decoration: underline
        }
        </style>
        <style>
        .v2 .v2-card-container ul li[class^=v2-col-] {
            padding-left: 8px;
            padding-right:8px
        }

        @media (min-width: 768px) {
            .v2 .v2-card-container ul li[class^=v2-col-] {
                padding-left: 12px;
                padding-right:12px
            }
        }

        @media (min-width: 768px) {
            .v2 .v2-card-container .v2-stick-boundary--desktop {
                margin-left: -12px;
                margin-right:-12px
            }
        }

        @media (max-width: 767px) {
            .v2 .v2-card-container .v2-stick-boundary--mobile {
                margin-left: -8px;
                margin-right:-8px
            }
        }

        .v2 .v2-card-container .v2-slider__slide {
            -webkit-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text;
            user-select: text
        }
        </style>
        <style>
        .feature-popup {
            position: fixed;
            z-index: 10000;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden
        }
        </style>
        <style>
        .v2 .v2-footer__title {
            font-size: .875rem;
            line-height: 1.125rem;
            font-weight:700
        }

        @media (min-width: 768px) {
            .v2 .v2-footer__title {
                font-size: .875rem;
                line-height:1.0625rem
            }
        }

        .v2 .v2-footer {
            font-size: .875rem;
            line-height: 1.25rem;
            background: #313131;
            color: #aaa;
            padding-bottom: 3.125rem;
            padding-top:1.875rem
        }

        @media (min-width: 768px) {
            .v2 .v2-footer {
                padding:2.5rem 4.6875rem 3.75rem
            }
        }

        @media (min-width: 1024px) {
            .v2 .v2-footer {
                padding-left: 0;
                padding-right:0
            }
        }

        .v2 .v2-footer a {
            color:#fff
        }

        .v2 .v2-footer__information {
            padding-bottom:2.5rem
        }

        @media (min-width: 768px) {
            .v2 .v2-footer__information {
                -ms-flex-order: 1;
                order:1
            }
        }

        .v2 .v2-footer__utility-links {
            padding-top:0
        }

        @media (min-width: 768px) {
            .v2 .v2-footer__utility-links {
                -ms-flex-order: 2;
                order:2
            }
        }

        @media (min-width: 768px) {
            .v2 .v2-footer__logo {
                height: 53px;
                width:72px
            }
        }

        .v2 .v2-footer__title {
            color:#aaa
        }

        .v2 .v2-footer__title {
            margin-bottom:1.25rem
        }

        .v2 .v2-footer__links {
            line-height:1.7
        }

        @media (min-width: 768px) {
            .v2 .v2-footer__links {
                padding-left: 0;
                padding-right:15px
            }
        }

        .v2 .v2-footer__links li {
            margin-bottom:1.25rem
        }

        @media (min-width: 768px) {
            .v2 .v2-footer__links--horizontal-desktop {
                border-bottom: 1px solid #313131;
                border-top: 1px solid #313131;
                padding-top:15px
            }
        }

        @media (min-width: 768px) {
            .v2 .v2-footer__links--horizontal-desktop li {
                display: inline-block;
                margin-bottom: 15px;
                margin-left: 0;
                margin-right:8px
            }
        }

        @media (min-width: 768px) {
            .v2 .v2-footer__links--horizontal-desktop li:before {
                content: "\2022";
                padding-left: 0;
                padding-right:12px
            }
        }

        @media (min-width: 768px) {
            .v2 .v2-footer__links--horizontal-desktop li:first-child:before {
                display:none
            }
        }

        @media (min-width: 768px) {
            .v2 .v2-footer__links--horizontal-desktop li a {
                color:#ccc
            }
        }

        .v2 .v2-footer__social {
            margin:0 -.625rem 1.875rem
        }

        .v2 .v2-footer__social .v2-icon {
            margin-left: .625rem;
            margin-right: .625rem;
            width:1.25rem
        }

        .v2 .v2-footer__warning-icon {
            display: inline;
            margin-left: 0;
            margin-right: 30px;
            vertical-align:sub
        }

        .v2 .v2-footer__warning-icon svg {
            fill:#ff6f28
        }

        .v2 .v2-footer__warning-text {
            display: inline;
            font-weight: 700
        }
        </style>
        <style>
        .v2 .v2-framed-icon {
            display: -ms-inline-flexbox;
            display: inline-flex;
            -ms-flex-pack: center;
            justify-content: center;
            -ms-flex-align: center;
            align-items: center;
            position: relative;
            background: #0076ff;
            color: #fff;
            border: 0;
            outline:none
        }

        .v2 .v2-framed-icon--md {
            width: 65px;
            height:65px
        }

        .v2 .v2-framed-icon--md svg {
            width: 33px;
            height: 33px
        }
        </style>
        <style>
        .v2 .v2-hero {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items:center
        }

        @media (max-width: 1023px) {
            .v2 .v2-hero {
                -ms-flex-pack: center;
                justify-content:center
            }
        }

        .v2 .v2-hero__content {
            -ms-flex: 0 0 100%;
            flex:0 0 100%
        }

        .v2 .v2-hero__content > :last-child {
            margin-bottom:30px
        }

        @media (min-width: 1024px) {
            .v2 .v2-hero__content > :last-child {
                margin-bottom:0
            }
        }

        .v2 .v2-hero .v2-btn-wrapper {
            margin-top: 0;
            margin-bottom:20px
        }

        .v2 .v2-hero .v2-btn {
            margin-bottom:0
        }

        @media (max-width: 767px) {
            .v2 .v2-hero .v2-btn {
                margin-bottom: .625rem
            }
        }
        </style>
        <style>
        .v2 .v2-lightbox {
            -ms-flex-align: center;
            align-items: center;
            display: -ms-flexbox !important;
            display: flex !important;
            height: 100%;
            -ms-flex-pack: center;
            justify-content: center;
            left: 0;
            position: fixed;
            top: 0;
            transition: visibility 222ms cubic-bezier(.645, .045, .355, 1);
            visibility: hidden;
            width: 100%;
            z-index:10000
        }

        .v2 .v2-lightbox__overlay {
            cursor: pointer;
            background: rgba(0, 0, 0, .6);
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            transition: opacity 222ms cubic-bezier(.645, .045, .355, 1);
            width:100%
        }

        .v2 .v2-lightbox__wrapper {
            background: #fff;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            margin: 0 .9375rem;
            max-height: calc(100% - 1.875rem);
            max-width: calc(100% - 1.875rem);
            padding-bottom: 1.875rem;
            opacity: 0;
            position: relative;
            transition:opacity 222ms cubic-bezier(.645, .045, .355, 1)
        }

        .v2 .v2-lightbox__content {
            padding: 0 1.875rem;
            overflow-y: auto;
            text-align: center;
            max-width:100%
        }

        .v2 .v2-lightbox__controls {
            -ms-flex-negative: 0;
            flex-shrink: 0;
            -ms-flex-align: center;
            align-items: center;
            display: -ms-flexbox;
            display: flex;
            min-height: 2.5rem;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding-right: 12px;
            position:relative
        }

        .v2 .v2-lightbox__title {
            padding:.5rem 1.875rem
        }

        .v2 .v2-lightbox__close {
            display: block !important;
            cursor: pointer;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            width:1.25rem
        }

        .v2 .v2-lightbox__close img {
            width: 100%
        }
        </style>
        <style>
        @-webkit-keyframes spin {
            to {
                -webkit-transform: rotate(1turn);
                transform:rotate(1turn)
            }
        }

        @keyframes  spin {
            to {
                -webkit-transform: rotate(1turn);
                transform: rotate(1turn)
            }
        }
        </style>
        <style>
        .v2 .v2-media-element__title {
            font-size: .875rem;
            line-height: 1.125rem;
            font-weight:700
        }

        @media (min-width: 768px) {
            .v2 .v2-media-element__title {
                font-size: .875rem;
                line-height:1.0625rem
            }
        }

        .v2 .v2-media-element__body {
            font-size: .875rem;
            line-height:1.25rem
        }

        .v2 .v2-media-element {
            display: -ms-flexbox;
            display: flex;
            padding-top: 15px;
            padding-bottom:15px
        }

        @media (max-width: 767px) {
            .v2 .v2-media-element:not(:first-child) {
                border-top:1px solid #e6e6e8
            }
        }

        .v2 .v2-media-element__media {
            line-height:0
        }

        @media (min-width: 1024px) {
            .v2 .v2-media-element__media {
                padding-right:20px
            }
        }

        .v2 .v2-media-element__text {
            position: relative;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width:100%
        }

        .v2 .v2-media-element__body, .v2 .v2-media-element__title {
            margin-bottom:.5rem
        }

        .v2 .v2-media-element-row .v2-media-element {
            display:block
        }

        .v2 .v2-media-element-row .v2-media-element .v2-media-element__media {
            padding-right: 0;
            margin-bottom:20px
        }

        .v2 .v2-media-element-row--centered .v2-media-element .v2-media-element__media, .v2 .v2-media-element-row--centered .v2-media-element .v2-media-element__text {
            text-align: center
        }
        </style>
        <style>
        .v2 .v2-off-canvas {
            display: block !important;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            visibility:hidden
        }

        .v2 .v2-off-canvas-ph {
            display: -ms-flexbox;
            display: flex;
            width: calc(100vw + 300px);
            height: 100%;
            -webkit-transform: translateX(0);
            transform:translateX(0)
        }

        .v2 .v2-off-canvas__overlay {
            -ms-flex: 1;
            flex: 1;
            background-color: #000;
            opacity:0
        }

        .v2 .v2-off-canvas__content {
            background: #fff;
            height: 100%;
            -ms-flex: 0 0 300px;
            flex: 0 0 300px;
            overflow-y: auto;
            cursor: pointer;
            position: relative;
            -webkit-overflow-scrolling:touch
        }

        .v2 .v2-off-canvas__close {
            cursor: pointer;
            box-sizing: content-box;
            padding: 14px 20px 14px 14px;
            position: absolute;
            right: 0;
            top: 0
        }
        </style>
        <style>
        .grid-container {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-flow: row wrap;
            flex-flow:row wrap
        }

        @supports (display: grid) {
            .grid-container {
                display: grid;
                grid-gap: 15px;
                grid-template-columns: auto auto;
                grid-template-rows:auto auto
            }

            @media (min-width: 768px) {
                .grid-container {
                    grid-template-columns: auto auto auto auto;
                    grid-gap:24px
                }
            }

            @media (min-width: 768px) {
                .grid-container--row {
                    row-gap:0
                }
            }
        }

        @supports (display: grid) {
            .grid-item {
                width: auto;
                -ms-flex-order: 2;
                order:2
            }
        }

        .grid-item-content {
            border-radius: 6px;
            height: 196px;
            overflow:hidden
        }

        @media (min-width: 768px) {
            .grid-item-content {
                height:300px
            }
        }

        @supports (display: grid) {
            .grid-item-content {
                margin:0 !important
            }
        }

        @supports (display: grid) {
            .grid-item--col-start-1, .grid-item--col-start-3 {
                grid-column-start:1
            }
        }

        @media (min-width: 768px) {
            @supports (display: grid) {
                .grid-item--col-start-3 {
                    grid-column-start:3
                }
            }
        }

        @supports (display: grid) {
            .grid-item--row-start-1 {
                grid-row-start:1
            }
        }

        .grid-item--col-span-2 {
            width:50%
        }

        @supports (display: grid) {
            .grid-item--col-span-2 {
                grid-column-end: span 2;
                width: auto;
                -ms-flex-order: 1;
                order:1
            }

            @media (min-width: 768px) {
                .grid-item--col-span-2 {
                    -ms-flex-order: 2;
                    order:2
                }
            }
        }

        @supports (display: grid) {
            .grid-item--row-span-2 {
                grid-row-end:span 2
            }
        }

        @supports (display: grid) {
            @media (min-width: 768px) {
                .mixed-grid-container .mixed-grid-item .grid-container {
                    grid-template-columns:auto auto
                }
            }
        }

        @supports (display: grid) {
            .mixed-grid-container .mixed-grid-item .grid-container .grid-item {
                width:auto
            }
        }

        .gutter--l {
            margin-left:12px
        }

        .gutter--r {
            margin-right:12px
        }

        .grid-container .v2-typography--inverted .headline {
            color:#fff
        }

        .grid-container .v2-picture-hover--scaled {
            transition: -webkit-transform 1s;
            transition:transform 1s, -webkit-transform 1s
        }

        .grid-container .v2-picture-hover--scaled:hover, .mixed-grid-container .v2-picture-hover--scaled:hover {
            -webkit-transform: scale(1.2);
            transform:scale(1.2)
        }

        .v2 .grid-item-content .tile-item {
            height: inherit
        }
        </style>
        <style>
        .v2 .tile-item {
            overflow: hidden;
            position:relative
        }

        .v2 .tile-item .v2-picture-hover--scaled {
            transition: -webkit-transform 1s;
            transition: transform 1s;
            transition:transform 1s, -webkit-transform 1s
        }

        .v2 .tile-item .v2-picture-hover--scaled:hover {
            -webkit-transform: scale(1.2);
            transform:scale(1.2)
        }

        .v2 .tile-item .headline {
            position: absolute;
            bottom: 0;
            padding: 30px;
            margin-bottom: 0
        }
        </style>     

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
   <div class="container pt-5">
       <div class="row">
           <div class="col-xs-12 col-sm-6 col-md-4 footers-one">
    		    <div class="footers-logo">
                  <a href="/">
    		        <img src="{{ asset('storage/app/public/'.$settings->logo)}}" class="img-fluid" alt="Logo">
                  </a>
    		    </div>
    		   <div class="footers-info mt-3">
    		        <p>"{{$settings->site_name}}  is not just a company, it's a mission"<br> - Michael Hudson, Founder and CEO </p>
    		    </div>
    		    <div class="social-icons"> 
                 <a href="https://www.facebook.com/{{$settings->site_name}} ltdlondon?mibextid=ZbWKwL"><i id="social-fb" class="fa fa-facebook fa-2x social"></i></a>
                <a href="https://instagram.com/_{{$settings->site_name}} ?igshid=YWJhMjlhZTc="><i id="social-yb" class="fa fa-instagram fa-2x social"></i></a>
				<a href="https://t.me/+_P6-DNLLFFkyNjc0"><i id="social-tm" class="fa fa-telegram fa-2x social"></i></a>
                <a href="https://twitter.com/{{$settings->site_name}} l?s=21&amp;t=vIEtY_QC54HL4qdcbARweA"><i id="social-tw" class="fa fa-twitter fa-2x social"></i></a>
	            <a href="https://cdn-cgi/l/email-protection.html#20535550504f52546045434f0d475241564954590e434f4d"><i id="social-em" class="fa fa-envelope-square fa-2x social"></i></a>

	        </div>
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 footers-two">
    		    <h5>Company </h5>
    		    <ul class="list-unstyled">
    			 <li><a href="about">About</a></li>
    			 <li><a href="careers">Careers</a></li>
    			 <li><a href="pricing">Pricing</a></li>
                 <li><a href="#">Meet the team</a></li>
    			</ul>
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 footers-three">
    		    <h5>Information</h5>
    		    <ul class="list-unstyled">
    			 <li><a href="register">Register Now</a></li>
    			 <li><a href="spot">Spot Trading</a></li>
    			 <li><a href="margin">Margin Trading</a></li>
    			 <li><a href="tradebots">Bot Trading</a></li>
                 
    			</ul>
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 footers-four">
    		    <h5>Explore </h5>
    		    <ul class="list-unstyled">
    			 <li><a href="forex">Forex</a></li>
    			 <li><a href="crypto">Cryptocurrency</a></li>
    			 <li><a href="staking">Staking</a></li>
    			 <li><a href="comm">Commodities</a></li>
    			</ul>
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 footers-five">
    		    <h5>Legal </h5>
    		     <ul class="list-unstyled">
    			 <li><a href="doc/Certificate-of-Inc.pdf">Certificate of Incorporation</a></li>
    			 <li><a href="doc/Tax-insurance.pdf">Tax & Insurance </a></li>
    			 <li><a href="doc/Anti-laundering.pdf">Guide to Anti Laundering</a></li>
    			 <li><a href="doc/Brochure.pdf">Company Brochure</a></li>
    			 <li><a href="doc/Fin-statement-2021.pdf">Financial Statement 2021</a></li>
    			</ul>
    		</div>
    		
       </div>
   </div>
</section>
      <hr>
<section class="disclaimer" style="background-color: var(--color-secondary);">
    <div class="container">
        <div class="row ">
            <div class="col-md-12 py-2">
                <small class="disc">
                          </small>
              <small class="disc">
                {{$settings->site_name}}  of {{$settings->site_name}}  Trading Limited is authorised and regulated by the Financial Conduct Authority, {{$settings->site_name}}  Registered Number 12890756.
              </small><br>
              <small class="disc">
                This information should not be relied upon as research, investment advice, or a recommendation regarding any products, strategies, or any security in particular. This material is strictly for illustrative, educational, or informational purposes and is subject to change.
              </small><br><br>
              <p style="font-size:11px; color:#fff;">It is important that you understand that with investments, your capital is at risk. Past performance is not a guide to future performance. It is your responsibility to ensure that you make an informed decision about whether or not to invest with us. If you are still unsure if investing is right for you, please seek independent advice. {{$settings->site_name}}  Trading Limited assumes no liability for any loss sustained from trading in accordance with a recommendation.</p>
            </div>
        </div>
    </div>
</section> 
@endsection