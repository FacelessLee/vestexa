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
    body {
      background: #fff;
      color: #2f3138;
      font-family: "Open Sans", sans-serif;
    }
    
    a {
      color: #f82249;
      text-decoration: none;
      transition: 0.5s;
    }
    
    a:hover, a:active, a:focus {
      color: #f8234a;
      outline: none;
      text-decoration: none;
    }
    
    p {
      padding: 0;
      margin: 0 0 30px 0;
    }
    
    h1, h2, h3, h4, h5, h6 {
      font-family: "Raleway", sans-serif;
      font-weight: 400;
      margin: 0 0 20px 0;
      padding: 0;
      color: #0e1b4d;
    }
    
    .main-page {
      margin-top: 70px;
    }
    
    /* Prelaoder */
    #preloader {
      position: fixed;
      left: 0;
      top: 0;
      z-index: 999;
      width: 100%;
      height: 100%;
      overflow: visible;
      background: #fff url("temp/custom/img/preloader.html") no-repeat center center;
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
      background: #f82249;
      width: 40px;
      height: 40px;
      border-radius: 50px;
      transition: all 0.4s;
    }
    .back-to-top i {
      font-size: 28px;
      color: #fff;
      line-height: 0;
    }
    .back-to-top:hover {
      background: #f94a6a;
      color: #fff;
    }
    .back-to-top.active {
      visibility: visible;
      opacity: 1;
    }
    
    /* Sections Header
    --------------------------------*/
    .section-header {
      margin-bottom: 60px;
      position: relative;
      padding-bottom: 20px;
    }
    .section-header::before {
      content: "";
      position: absolute;
      display: block;
      width: 60px;
      height: 5px;
      background: #f82249;
      bottom: 0;
      left: calc(50% - 25px);
    }
    .section-header h2 {
      font-size: 36px;
      text-transform: uppercase;
      text-align: center;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .section-header p {
      text-align: center;
      padding: 0;
      margin: 0;
      font-size: 18px;
      font-weight: 500;
      color: #9195a2;
    }
    
    .section-with-bg {
      background-color: #f6f7fd;
    }
    
    /*--------------------------------------------------------------
    # Header
    --------------------------------------------------------------*/
    #header {
      height: 90px;
      position: fixed;
      left: 0;
      top: 0;
      right: 0;
      transition: all 0.5s;
      z-index: 997;
    }
    #header.header-scrolled, #header.header-inner {
      background: rgba(6, 12, 34, 0.98);
      height: 70px;
    }
    #header #logo h1 {
      font-size: 36px;
      margin: 0;
      font-family: "Raleway", sans-serif;
      font-weight: 700;
      letter-spacing: 3px;
      text-transform: uppercase;
    }
    #header #logo h1 span {
      color: #f82249;
    }
    #header #logo h1 a, #header #logo h1 a:hover {
      color: #fff;
    }
    #header #logo img {
      padding: 0;
      margin: 0;
      max-height: 40px;
    }
    @media (max-width: 992px) {
      #header #logo img {
        max-height: 30px;
      }
    }
    
    /*--------------------------------------------------------------
    # Buy Tickets
    --------------------------------------------------------------*/
    .buy-tickets {
      color: #fff;
      background: #f82249;
      padding: 7px 22px;
      margin: 0 0 0 15px;
      border-radius: 50px;
      border: 2px solid #f82249;
      transition: all ease-in-out 0.3s;
      font-weight: 500;
      line-height: 1;
      font-size: 13px;
      white-space: nowrap;
    }
    .buy-tickets:hover {
      background: none;
      color: #fff;
    }
    .buy-tickets:focus {
      color: #fff;
    }
    @media (max-width: 992px) {
      .buy-tickets {
        margin: 0 15px 0 0;
      }
    }
    
    /*--------------------------------------------------------------
    # Navigation Menu
    --------------------------------------------------------------*/
    /**
    * Desktop Navigation 
    */
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
    .navbar > ul > li {
      white-space: nowrap;
      padding: 10px 0 10px 12px;
    }
    .navbar a, .navbar a:focus {
      display: flex;
      align-items: center;
      justify-content: space-between;
      color: rgba(202, 206, 221, 0.8);
      font-family: "Raleway", sans-serif;
      font-weight: 600;
      font-size: 14px;
      white-space: nowrap;
      transition: 0.3s;
      position: relative;
      padding: 6px 4px;
    }
    .navbar a i, .navbar a:focus i {
      font-size: 12px;
      line-height: 0;
      margin-left: 5px;
    }
    .navbar > ul > li > a:before {
      content: "";
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -6px;
      left: 0;
      background-color: #f82249;
      visibility: hidden;
      transition: all 0.3s ease-in-out 0s;
    }
    .navbar a:hover:before, .navbar li:hover > a:before, .navbar .active:before {
      visibility: visible;
      width: 100%;
    }
    .navbar a:hover, .navbar .active, .navbar .active:focus, .navbar li:hover > a {
      color: #fff;
    }
    .navbar .dropdown ul {
      display: block;
      position: absolute;
      left: 12px;
      top: calc(100% + 30px);
      margin: 0;
      padding: 10px 0;
      z-index: 99;
      opacity: 0;
      visibility: hidden;
      background: #fff;
      box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
      transition: 0.3s;
    }
    .navbar .dropdown ul li {
      min-width: 200px;
    }
    .navbar .dropdown ul a {
      padding: 10px 20px;
      font-size: 14px;
      text-transform: none;
      color: #060c22;
    }
    .navbar .dropdown ul a i {
      font-size: 12px;
    }
    .navbar .dropdown ul a:hover, .navbar .dropdown ul .active:hover, .navbar .dropdown ul li:hover > a {
      color: #f82249;
    }
    .navbar .dropdown:hover > ul {
      opacity: 1;
      top: 100%;
      visibility: visible;
    }
    .navbar .dropdown .dropdown ul {
      top: 0;
      left: calc(100% - 30px);
      visibility: hidden;
    }
    .navbar .dropdown .dropdown:hover > ul {
      opacity: 1;
      top: 0;
      left: 100%;
      visibility: visible;
    }
    @media (max-width: 1366px) {
      .navbar .dropdown .dropdown ul {
        left: -90%;
      }
      .navbar .dropdown .dropdown:hover > ul {
        left: -100%;
      }
    }
    
    /**
    * Mobile Navigation 
    */
    .mobile-nav-toggle {
      color: #fff;
      font-size: 28px;
      cursor: pointer;
      display: none;
      line-height: 0;
      transition: 0.5s;
    }
    
    @media (max-width: 991px) {
      .mobile-nav-toggle {
        display: block;
      }
    
      .navbar ul {
        display: none;
      }
    }
    .navbar-mobile {
      position: fixed;
      overflow: hidden;
      top: 0;
      right: 0;
      left: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.9);
      transition: 0.3s;
      z-index: 999;
    }
    .navbar-mobile .mobile-nav-toggle {
      position: absolute;
      top: 15px;
      right: 15px;
    }
    .navbar-mobile ul {
      display: block;
      position: absolute;
      top: 55px;
      right: 15px;
      bottom: 15px;
      left: 15px;
      padding: 10px 0;
      background-color: #fff;
      overflow-y: auto;
      transition: 0.3s;
    }
    .navbar-mobile > ul > li {
      padding: 0;
    }
    .navbar-mobile a:hover:before, .navbar-mobile li:hover > a:before, .navbar-mobile .active:before {
      visibility: hidden;
    }
    .navbar-mobile a, .navbar-mobile a:focus {
      padding: 10px 20px;
      font-size: 15px;
      color: #060c22;
    }
    .navbar-mobile a:hover, .navbar-mobile .active, .navbar-mobile li:hover > a {
      color: #f82249;
    }
    .navbar-mobile .getstarted, .navbar-mobile .getstarted:focus {
      margin: 15px;
    }
    .navbar-mobile .dropdown ul {
      position: static;
      display: none;
      margin: 10px 20px;
      padding: 10px 0;
      z-index: 99;
      opacity: 1;
      visibility: visible;
      background: #fff;
      box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
    }
    .navbar-mobile .dropdown ul li {
      min-width: 200px;
    }
    .navbar-mobile .dropdown ul a {
      padding: 10px 20px;
    }
    .navbar-mobile .dropdown ul a i {
      font-size: 12px;
    }
    .navbar-mobile .dropdown ul a:hover, .navbar-mobile .dropdown ul .active:hover, .navbar-mobile .dropdown ul li:hover > a {
      color: #f82249;
    }
    .navbar-mobile .dropdown > .dropdown-active {
      display: block;
    }
    
    /*--------------------------------------------------------------
    # Hero Section
    --------------------------------------------------------------*/
    #hero {
      width: 100%;
      height: 100vh;
      background: url('temp/custom/img/Event_Header.jpg') top center;
      background-size: cover;
      overflow: hidden;
      position: relative;
    }
    @media (min-width: 1024px) {
      #hero {
        background-attachment: fixed;
      }
    }
    #hero:before {
      content: "";
      background: rgba(6, 12, 34, 0.8);
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
    }
    #hero .hero-container {
      position: absolute;
      bottom: 0;
      left: 0;
      top: 90px;
      right: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: center;
      padding: 0 15px;
    }
    @media (max-width: 991px) {
      #hero .hero-container {
        top: 70px;
      }
    }
    #hero h1 {
      color: #fff;
      font-family: "Raleway", sans-serif;
      font-size: 56px;
      font-weight: 600;
      text-transform: uppercase;
    }
    #hero p span {
      color: #f82249;
      font-weight: 700;
      font-size: 20px;
    }
    @media (max-width: 991px) {
      #hero h1 {
        font-size: 34px;
      }
    }
    #hero p {
      color: #ebebeb;
      font-weight: 700;
      font-size: 20px;
    }
    @media (max-width: 991px) {
      #hero p {
        font-size: 16px;
      }
    }
    #hero .play-btn {
      width: 94px;
      height: 94px;
      background: radial-gradient(#f82249 50%, rgba(101, 111, 150, 0.15) 52%);
      border-radius: 50%;
      display: block;
      position: relative;
      overflow: hidden;
    }
    #hero .play-btn::after {
      content: "";
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translateX(-40%) translateY(-50%);
      width: 0;
      height: 0;
      border-top: 10px solid transparent;
      border-bottom: 10px solid transparent;
      border-left: 15px solid #fff;
      z-index: 100;
      transition: all 400ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
    }
    #hero .play-btn:before {
      content: "";
      position: absolute;
      width: 120px;
      height: 120px;
      -webkit-animation-delay: 0s;
      animation-delay: 0s;
      -webkit-animation: pulsate-btn 2s;
      animation: pulsate-btn 2s;
      -webkit-animation-direction: forwards;
      animation-direction: forwards;
      -webkit-animation-iteration-count: infinite;
      animation-iteration-count: infinite;
      -webkit-animation-timing-function: steps;
      animation-timing-function: steps;
      opacity: 1;
      border-radius: 50%;
      border: 2px solid rgba(163, 163, 163, 0.4);
      top: -15%;
      left: -15%;
      background: rgba(198, 16, 0, 0);
    }
    #hero .play-btn:hover::after {
      border-left: 15px solid #f82249;
      transform: scale(20);
    }
    #hero .play-btn:hover::before {
      content: "";
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translateX(-40%) translateY(-50%);
      width: 0;
      height: 0;
      border: none;
      border-top: 10px solid transparent;
      border-bottom: 10px solid transparent;
      border-left: 15px solid #fff;
      z-index: 200;
      -webkit-animation: none;
      animation: none;
      border-radius: 0;
    }
    #hero .about-btn {
      font-family: "Raleway", sans-serif;
      font-weight: 500;
      font-size: 14px;
      letter-spacing: 1px;
      display: inline-block;
      padding: 12px 32px;
      border-radius: 50px;
      transition: 0.5s;
      line-height: 1;
      margin: 10px;
      color: #fff;
      -webkit-animation-delay: 0.8s;
      animation-delay: 0.8s;
      border: 2px solid #f82249;
    }
    #hero .about-btn:hover {
      background: #f82249;
      color: #fff;
    }
    
    @-webkit-keyframes pulsate-btn {
      0% {
        transform: scale(0.6, 0.6);
        opacity: 1;
      }
      100% {
        transform: scale(1, 1);
        opacity: 0;
      }
    }
    
    @keyframes  pulsate-btn {
      0% {
        transform: scale(0.6, 0.6);
        opacity: 1;
      }
      100% {
        transform: scale(1, 1);
        opacity: 0;
      }
    }
    /*--------------------------------------------------------------
    # About Section
    --------------------------------------------------------------*/
    #about {
      background: url("temp/custom/img/about-bg.jpg");
      background-size: cover;
      overflow: hidden;
      position: relative;
      color: #fff;
      padding: 60px 0 40px 0;
    }
    @media (min-width: 1024px) {
      #about {
        background-attachment: fixed;
      }
    }
    #about:before {
      content: "";
      background: rgba(13, 20, 41, 0.8);
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
    }
    #about h2 {
      font-size: 36px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #fff;
    }
    #about h3 {
      font-size: 18px;
      font-weight: bold;
      text-transform: uppercase;
      margin-bottom: 10px;
      color: #fff;
    }
    #about p {
      font-size: 14px;
      margin-bottom: 20px;
      color: #fff;
    }
    
        
        /*--------------------------------------------------------------
    # Hero Section
    --------------------------------------------------------------*/
    #herod {
      width: 100%;
      height: 70vh;
      background: url(temp/custom/img/bsv.jpg) top center;
      background-size: cover;
      overflow: hidden;
      position: relative;
    }
    @media (min-width: 1024px) {
      #herod {
        background-attachment: fixed;
      }
    }
    #herod:before {
      content: "";
      background: rgba(6, 12, 34, 0.8);
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
    }
    #herod .hero-container {
      position: absolute;
      bottom: 0;
      left: 0;
      top: 70px;
      right: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: center;
      padding: 0 15px;
    }
    @media (max-width: 991px) {
      #herod .hero-container {
        top: 50px;
      }
    }
    #herod h1 {
      color: #fff;
      font-family: "Raleway", sans-serif;
      font-size: 56px;
      font-weight: 600;
      
    }
    #herod  span {
      color: #f82249;
      font-weight: 700;
      font-size: 20px;
    }
    @media (max-width: 991px) {
      #herod h1 {
        font-size: 34px;
      }
    }
    #herod p {
      color: #ebebeb;
      font-weight: 700;
      font-size: 20px;
    }
    @media (max-width: 991px) {
      #herod p {
        font-size: 16px;
      }
    }
    
    
    
    #herod .about-btn {
      font-family: "Raleway", sans-serif;
      font-weight: 500;
      font-size: 14px;
      letter-spacing: 1px;
      display: inline-block;
      padding: 12px 32px;
      border-radius: 50px;
      transition: 0.5s;
      line-height: 1;
      margin: 10px;
      color: #fff;
      -webkit-animation-delay: 0.8s;
      animation-delay: 0.8s;
      border: 2px solid #f82249;
    }
    #herod .about-btn:hover {
      background: #f82249;
      color: #fff;
    }
    
    @-webkit-keyframes pulsate-btn {
      0% {
        transform: scale(0.6, 0.6);
        opacity: 1;
      }
      100% {
        transform: scale(1, 1);
        opacity: 0;
      }
    }
    
    @keyframes  pulsate-btn {
      0% {
        transform: scale(0.6, 0.6);
        opacity: 1;
      }
      100% {
        transform: scale(1, 1);
        opacity: 0;
      }
    }
    /*--------------------------------------------------------------
    # Speakers Section
    --------------------------------------------------------------*/
    #speakers {
      padding: 60px 0 30px 0;
    }
    #speakers .speaker {
      position: relative;
      overflow: hidden;
      margin-bottom: 30px;
    }
    #speakers .speaker .details {
      background: rgba(6, 12, 34, 0.76);
      position: absolute;
      left: 0;
      bottom: -40px;
      right: 0;
      text-align: center;
      padding-top: 10px;
      transition: all 300ms cubic-bezier(0.645, 0.045, 0.355, 1);
    }
    #speakers .speaker .details h3 {
      color: #fff;
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 5px;
    }
    #speakers .speaker .details p {
      color: #fff;
      font-size: 15px;
      margin-bottom: 10px;
      font-style: italic;
    }
    #speakers .speaker .details .social {
      height: 40px;
    }
    #speakers .speaker .details .social i {
      line-height: 0;
      margin: 0 2px;
    }
    #speakers .speaker .details a {
      color: #fff;
    }
    #speakers .speaker .details a:hover {
      color: #f82249;
    }
    #speakers .speaker:hover .details {
      bottom: 0;
    }
    
    #speakers-details {
      padding: 60px 0;
    }
    #speakers-details .details h2 {
      color: #112363;
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 10px;
    }
    #speakers-details .details .social {
      margin-bottom: 15px;
    }
    #speakers-details .details .social a {
      background: #e9edfb;
      color: #112363;
      line-height: 1;
      display: inline-block;
      text-align: center;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    #speakers-details .details .social a:hover {
      background: #f82249;
      color: #fff;
    }
    #speakers-details .details .social a i {
      font-size: 16px;
      line-height: 0;
    }
    #speakers-details .details p {
      color: #112363;
      font-size: 15px;
      margin-bottom: 10px;
    }
    
        
       /*--------------------------------------------------------------
    # Schedule Section
    --------------------------------------------------------------*/
    #schedule {
      padding: 60px 0 60px 0;
    }
    #schedule .nav-tabs {
      text-align: center;
      margin: auto;
      display: block;
      border-bottom: 0;
      margin-bottom: 30px;
    }
    #schedule .nav-tabs li {
      display: inline-block;
      margin-bottom: 0;
    }
    #schedule .nav-tabs a {
      border: none;
      border-radius: 50px;
      font-weight: 600;
      background-color: #0e1b4d;
      color: #fff;
      padding: 10px 100px;
    }
    @media (max-width: 991px) {
      #schedule .nav-tabs a {
        padding: 8px 60px;
      }
    }
    @media (max-width: 767px) {
      #schedule .nav-tabs a {
        padding: 8px 50px;
      }
    }
    @media (max-width: 480px) {
      #schedule .nav-tabs a {
        padding: 8px 30px;
      }
    }
    #schedule .nav-tabs a.active {
      background-color: #f82249;
      color: #fff;
    }
    #schedule .sub-heading {
      text-align: center;
      font-size: 18px;
      font-style: italic;
      margin: 0 auto 30px auto;
    }
    @media (min-width: 991px) {
      #schedule .sub-heading {
        width: 75%;
      }
    }
    #schedule .tab-pane {
      transition: ease-in-out 0.2s;
    }
    #schedule .schedule-item {
      border-bottom: 1px solid #cad4f6;
      padding-top: 15px;
      padding-bottom: 15px;
      transition: background-color ease-in-out 0.3s;
    }
    #schedule .schedule-item:hover {
      background-color: #fff;
    }
    #schedule .schedule-item time {
      padding-bottom: 5px;
      display: inline-block;
    }
    #schedule .schedule-item .speaker {
      width: 60px;
      height: 60px;
      overflow: hidden;
      border-radius: 50%;
      float: left;
      margin: 0 10px 10px 0;
    }
    #schedule .schedule-item .speaker img {
      height: 100%;
      transform: translateX(-50%);
      margin-left: 50%;
      transition: all ease-in-out 0.3s;
    }
    #schedule .schedule-item h4 {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 5px;
    }
    #schedule .schedule-item h4 span {
      font-style: italic;
      color: #19328e;
      font-weight: normal;
      font-size: 16px;
    }
    #schedule .schedule-item p {
      font-style: italic;
      color: #152b79;
      margin-bottom: 0;
    }
    
    /*--------------------------------------------------------------
    # Venue Section
    --------------------------------------------------------------*/
    #venue {
      padding: 60px 0;
    }
    #venue .container-fluid {
      margin-bottom: 3px;
    }
    #venue .venue-map iframe {
      width: 100%;
      height: 100%;
      min-height: 300px;
    }
    #venue .venue-info {
      background: url("temp/custom/img/venue-info-bg.html") top center no-repeat;
      background-size: cover;
      position: relative;
      padding-top: 60px;
      padding-bottom: 60px;
    }
    #venue .venue-info:before {
      content: "";
      background: rgba(13, 20, 41, 0.8);
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
    }
    #venue .venue-info h3 {
      font-size: 36px;
      font-weight: 700;
      color: #fff;
    }
    @media (max-width: 574px) {
      #venue .venue-info h3 {
        font-size: 24px;
      }
    }
    #venue .venue-info p {
      color: #fff;
      margin-bottom: 0;
    }
    #venue .venue-gallery-container {
      padding-right: 12px;
    }
    #venue .venue-gallery {
      overflow: hidden;
      border-right: 3px solid #fff;
      border-bottom: 3px solid #fff;
    }
    #venue .venue-gallery img {
      transition: all ease-in-out 0.4s;
    }
    #venue .venue-gallery:hover img {
      transform: scale(1.1);
    }
    
    /*--------------------------------------------------------------
    # Hotels Section
    --------------------------------------------------------------*/
    #hotels {
      padding: 60px 0;
    }
    #hotels .hotel {
      border: 1px solid #e0e5fa;
      background: #fff;
      margin-bottom: 30px;
    }
    #hotels .hotel:hover .hotel-img img {
      transform: scale(1.1);
    }
    #hotels .hotel-img {
      overflow: hidden;
      margin-bottom: 15px;
    }
    #hotels .hotel-img img {
      transition: 0.3s ease-in-out;
    }
    #hotels h3 {
      font-weight: 600;
      font-size: 20px;
      margin-bottom: 5px;
      padding: 0 20px;
    }
    #hotels a {
      color: #152b79;
    }
    #hotels a:hover {
      color: #f82249;
    }
    #hotels .stars {
      padding: 0 20px;
      margin-bottom: 5px;
    }
    #hotels .stars i {
      color: #ffc31d;
    }
    #hotels p {
      padding: 0 20px;
      margin-bottom: 20px;
      color: #060c22;
      font-style: italic;
      font-size: 15px;
    }
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
    
    
    /*--------------------------------------------------------------
    # Buy Tickets Section
    --------------------------------------------------------------*/
    #buy-tickets {
      padding: 60px 0;
    }
    #buy-tickets .card {
      border: none;
      border-radius: 5px;
      transition: all 0.3s ease-in-out;
      box-shadow: 0 10px 25px 0 rgba(6, 12, 34, 0.1);
    }
    #buy-tickets .card:hover {
      box-shadow: 0 10px 35px 0 rgba(6, 12, 34, 0.2);
    }
    #buy-tickets .card hr {
      margin: 25px 0;
    }
    #buy-tickets .card .card-title {
      margin: 10px 0;
      font-size: 14px;
      letter-spacing: 1px;
      font-weight: bold;
    }
    #buy-tickets .card .card-price {
      font-size: 48px;
      margin: 0;
    }
    #buy-tickets .card ul li {
      margin-bottom: 20px;
    }
    #buy-tickets .card .text-muted {
      opacity: 0.7;
    }
    #buy-tickets .card .btn {
      font-size: 15px;
      border-radius: 50px;
      padding: 10px 40px;
      transition: all 0.2s;
      background-color: #f82249;
      border: 0;
      color: #fff;
    }
    #buy-tickets .card .btn:hover {
      background-color: #e0072f;
    }
    #buy-tickets #buy-ticket-modal input, #buy-tickets #buy-ticket-modal select {
      border-radius: 0;
    }
    #buy-tickets #buy-ticket-modal .btn {
      font-size: 15px;
      border-radius: 50px;
      padding: 10px 40px;
      transition: all 0.2s;
      background-color: #f82249;
      border: 0;
      color: #fff;
    }
    #buy-tickets #buy-ticket-modal .btn:hover {
      background-color: #e0072f;
    }
    
    
      </style>
    <script>
      (function() {
      "use strict";
    
      /**
       * Easy selector helper function
       */
      const select = (el, all = false) => {
        el = el.trim()
        if (all) {
          return [...document.querySelectorAll(el)]
        } else {
          return document.querySelector(el)
        }
      }
    
      /**
       * Easy event listener function
       */
      const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all)
        if (selectEl) {
          if (all) {
            selectEl.forEach(e => e.addEventListener(type, listener))
          } else {
            selectEl.addEventListener(type, listener)
          }
        }
      }
    
      /**
       * Easy on scroll event listener 
       */
      const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)
      }
    
      /**
       * Navbar links active state on scroll
       */
      let navbarlinks = select('#navbar .scrollto', true)
      const navbarlinksActive = () => {
        let position = window.scrollY + 200
        navbarlinks.forEach(navbarlink => {
          if (!navbarlink.hash) return
          let section = select(navbarlink.hash)
          if (!section) return
          if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
            navbarlink.classList.add('active')
          } else {
            navbarlink.classList.remove('active')
          }
        })
      }
      window.addEventListener('load', navbarlinksActive)
      onscroll(document, navbarlinksActive)
    
      /**
       * Scrolls to an element with header offset
       */
      const scrollto = (el) => {
        let header = select('#header')
        let offset = header.offsetHeight
    
        if (!header.classList.contains('header-scrolled')) {
          offset -= 20
        }
    
        let elementPos = select(el).offsetTop
        window.scrollTo({
          top: elementPos - offset,
          behavior: 'smooth'
        })
      }
    
      /**
       * Toggle .header-scrolled class to #header when page is scrolled
       */
      let selectHeader = select('#header')
      if (selectHeader) {
        const headerScrolled = () => {
          if (window.scrollY > 100) {
            selectHeader.classList.add('header-scrolled')
          } else {
            selectHeader.classList.remove('header-scrolled')
          }
        }
        window.addEventListener('load', headerScrolled)
        onscroll(document, headerScrolled)
      }
    
      /**
       * Back to top button
       */
      let backtotop = select('.back-to-top')
      if (backtotop) {
        const toggleBacktotop = () => {
          if (window.scrollY > 100) {
            backtotop.classList.add('active')
          } else {
            backtotop.classList.remove('active')
          }
        }
        window.addEventListener('load', toggleBacktotop)
        onscroll(document, toggleBacktotop)
      }
    
      /**
       * Mobile nav toggle
       */
      on('click', '.mobile-nav-toggle', function(e) {
        select('#navbar').classList.toggle('navbar-mobile')
        this.classList.toggle('bi-list')
        this.classList.toggle('bi-x')
      })
    
      /**
       * Mobile nav dropdowns activate
       */
      on('click', '.navbar .dropdown > a', function(e) {
        if (select('#navbar').classList.contains('navbar-mobile')) {
          e.preventDefault()
          this.nextElementSibling.classList.toggle('dropdown-active')
        }
      }, true)
    
      /**
       * Scrool with ofset on links with a class name .scrollto
       */
      on('click', '.scrollto', function(e) {
        if (select(this.hash)) {
          e.preventDefault()
    
          let navbar = select('#navbar')
          if (navbar.classList.contains('navbar-mobile')) {
            navbar.classList.remove('navbar-mobile')
            let navbarToggle = select('.mobile-nav-toggle')
            navbarToggle.classList.toggle('bi-list')
            navbarToggle.classList.toggle('bi-x')
          }
          scrollto(this.hash)
        }
      }, true)
    
      /**
       * Scroll with ofset on page load with hash links in the url
       */
      window.addEventListener('load', () => {
        if (window.location.hash) {
          if (select(window.location.hash)) {
            scrollto(window.location.hash)
          }
        }
      });
    
      /**
       * Initiate glightbox
       */
      const glightbox = GLightbox({
        selector: '.glightbox'
      });
    
      /**
       * Gallery Slider
       */
      new Swiper('.gallery-slider', {
        speed: 400,
        loop: true,
        centeredSlides: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
            spaceBetween: 20
          },
          575: {
            slidesPerView: 2,
            spaceBetween: 20
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 20
          },
          992: {
            slidesPerView: 5,
            spaceBetween: 20
          }
        }
      });
    
      /**
       * Initiate gallery lightbox 
       */
      const galleryLightbox = GLightbox({
        selector: '.gallery-lightbox'
      });
    
      /**
       * Buy tickets select the ticket type on click
       */
      on('show.bs.modal', '#buy-ticket-modal', function(event) {
        select('#buy-ticket-modal #ticket-type').value = event.relatedTarget.getAttribute('data-ticket-type')
      })
    
      /**
       * Animation on scroll
       */
      window.addEventListener('load', () => {
        AOS.init({
          duration: 1000,
          easing: 'ease-in-out',
          once: true,
          mirror: false
        })
      });
    
    })()
      </script>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-4 pb-0">We're on a mission:<br><span></span> </h1>
      <p class="mb-4 pb-0"><span>A mission to harness the power of Bitcoin and technology to enable individual sovereignty and eventually garner the next evolution of humanity.</span></p>
      <a href="https://www.youtube.com/watch?v=SRrHNGzBX4Y" class="glightbox play-btn mb-4"></a>
      <a href="https://bitcoinsv.com/#" class="about-btn scrollto">Get BitcoinSV</a>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6">
            <h2>{{$settings->site_name}} </h2>
            <p>As our understanding of the boundless potential of Bitcoin has developed and deepened, so too has our vision.</p>
            <p>By leveraging Bitcoin and the advanced technologies at our disposal it's possible to reimagine, redefine and reengineer our lives, and our world.
</p>
            
			<p>Global leaders of the past and present have ransomed our future in the pursuit of profits. We have been manipulated, influenced and controlled by a global pyramid of power that infiltrates just about every aspect of our lives; our education, our entertainment, our societal beliefs and our finances.</p>
            <p>But we are the new generation.</p>
            <p>We are conscious and choose to fight with ‘light, harnessing the tools of humanity; the incredible technologies available to us to steer the evolution of humankind and create a new world.</p>
            <p>A world where everyone has a role.</p>
            <p>{{$settings->site_name}}  Trading Limited is committed to leading this wave of change; by connecting with, educating and empowering younger generations to reimagine, redefine and reengineer their lives, and the world.</p>


          </div>
          <div class="col-lg-3">
            <h3>Office</h3>
            <p>Queen Elizabeth olympic Park Plexal, London E20 3BS England</p>
          </div>
          <div class="col-lg-3">
            <h3>Phone</h3>
            <p>{{$settings->whatsapp}}</p>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->
    
    <!-- ======= Schedule Section ======= -->
    <section id="schedule" class="section-with-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Our Principles</h2>
          <p>One day, everyone will become involved with crypto</p>
        </div>

        <ul class="nav nav-tabs" role="tablist" data-aos="fade-up" data-aos-delay="100">
          <li class="nav-item">
            <a class="nav-link active" href="#day-1" role="tab" data-bs-toggle="tab">Educate</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#day-2" role="tab" data-bs-toggle="tab">Empower</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#day-3" role="tab" data-bs-toggle="tab">Evolve</a>
          </li>
        </ul>


        <div class="tab-content row justify-content-center" data-aos="fade-up" data-aos-delay="200">

          <!-- Schdule Day 1 -->
          <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">

            <div class="row schedule-item">
              <div class="col-md-2"><time></time></div>
              <div class="col-md-10">
                <h4 style="color:red;">We believe in learning to teach, and teaching to learn. {{$settings->site_name}}  Media is our channel to educate; to connect with the world, to maintain the integrity of our perspective, and to share our intellectual truth.</h4>
                <p></p>
              </div>
            </div>
          </div>
          <!-- End Schdule Day 1 -->

          <!-- Schdule Day 2 -->
          <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-2">

            <div class="row schedule-item">
              <div class="col-md-2"><time></time></div>
              <div class="col-md-10">
                
                <h4 style="color:red;">We seek to provide access to tools and information that allows people to empower themselves (both financially and philosophically) as a means towards economic and intellectual sovereignty. </h4>
                <p></p>
              </div>
            </div>    

          </div>
          <!-- End Schdule Day 2 -->

          <!-- Schdule Day 3 -->
          <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-3">

            <div class="row schedule-item">
              <div class="col-md-2"><time></time></div>
              <div class="col-md-10">
                
                <h4 style="color:red;">We aim to actively contribute to the evolution of humanity through the application and provision of advanced technologies and tools that have a positive impact at both an individual and collective level.</h4>
                <p></p>
              </div>
            </div>
          </div>
          <!-- End Schdule Day 2 -->
        </div>
      </div>
    </section><!-- End Schedule Section -->
    
    
    <!-- ======= Hero Section ======= -->
  <section id="herod">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-4 pb-0">Bitcoin Satoshi's Vision<br><span></span> </h1>
      <p class="mb-4 pb-0">The traditional financial system is built on debt and designed to strip individuals of their financial sovereignty. We never truly own the money we earn and save. It remains the property of the banks and can be seized at any time.</p>
      <p class="mb-4 pb-0">By combining the power of Bitcoin and the Internet, we're building {{$settings->site_name}}  Trading Limited, an alternative ecosystem. One that has sovereignty embedded in its blueprint and allows us to, finally, take ownership of our money.</p>
      <a href="#" class="about-btn scrollto">More</a>
    </div>
  </section><!-- End Hero Section -->
    
    <!-- ======= Speakers Section ======= -->
    <section id="speakers">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
         <p>Meet The Team</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="100">
              <img src="temp/custom/img/micheal.jpg" alt="Speaker 1" class="img-fluid">
              <div class="details">
                <h3><a href="#">Michael Hudson</a></h3>
                <p>CEO {{$settings->site_name}} </p>
                <div class="social">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="200">
              <img src="temp/custom/img/david.jpg" alt="Speaker 2" class="img-fluid">
              <div class="details">
                <h3><a href="#">David Arakelian</a></h3>
                <p>CTO</p>
                <div class="social">
                  
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="300">
              <img src="temp/custom/img/nicola.jpg" alt="Speaker 3" class="img-fluid">
              <div class="details">
                <h3><a href="#">Nichola Shillingford</a></h3>
                <p>Head of Marketing</p>
                <div class="social">
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="100">
              <img src="temp/custom/img/lara.jpg" alt="Speaker 4" class="img-fluid">
              <div class="details">
                <h3><a href="#">Lara Port </a></h3>
                <p>Careers & Wellbeing</p>
                <div class="social">
                
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="200">
              <img src="temp/custom/img/damien.jpg" alt="Speaker 5" class="img-fluid">
              <div class="details">
                <h3><a href="#">Damien Hartley</a></h3>
                <p>Head of Brand & Design</p>
                <div class="social">
                
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="300">
              <img src="temp/custom/img/james.jpg" alt="Speaker 6" class="img-fluid">
              <div class="details">
                <h3><a href="#">James Coughlan</a></h3>
                <p>Relationship Manager</p>
                <div class="social">
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section><!-- End Speakers Section -->
   


  </main><!-- End #main -->

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
      


@endsection