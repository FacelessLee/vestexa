
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
* Template Name: TheEvent - v4.7.0
* Template URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/
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
  background: #fff url("temp/img/preloader.html") no-repeat center center;
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
  height: 80vh;
  background: url(temp/custom/img/Career1.png) top center;
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
 Contact Section
--------------------------------------------------------------*/
#contact {
  padding: 60px 0;
}
#contact .contact-info {
  margin-bottom: 20px;
  text-align: center;
}
#contact .contact-info i {
  font-size: 48px;
  display: inline-block;
  margin-bottom: 10px;
  color: #f82249;
}
#contact .contact-info address, #contact .contact-info p {
  margin-bottom: 0;
  color: #112363;
}
#contact .contact-info h3 {
  font-size: 18px;
  margin-bottom: 15px;
  font-weight: bold;
  text-transform: uppercase;
  color: #112363;
}
#contact .contact-info a {
  color: #4869df;
}
#contact .contact-info a:hover {
  color: #f82249;
}
#contact .contact-address, #contact .contact-phone, #contact .contact-email {
  margin-bottom: 20px;
}
@media (min-width: 768px) {
  #contact .contact-address, #contact .contact-phone, #contact .contact-email {
    padding: 20px 0;
  }
}
@media (min-width: 768px) {
  #contact .contact-phone {
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
  }
}
#contact .php-email-form .error-message {
  display: none;
  color: #fff;
  background: #ed3c0d;
  text-align: left;
  padding: 15px;
  font-weight: 600;
}
#contact .php-email-form .error-message br + br {
  margin-top: 25px;
}
#contact .php-email-form .sent-message {
  display: none;
  color: #fff;
  background: #18d26e;
  text-align: center;
  padding: 15px;
  font-weight: 600;
}
#contact .php-email-form .loading {
  display: none;
  background: #fff;
  text-align: center;
  padding: 15px;
}
#contact .php-email-form .loading:before {
  content: "";
  display: inline-block;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  margin: 0 10px -6px 0;
  border: 3px solid #18d26e;
  border-top-color: #eee;
  -webkit-animation: animate-loading 1s linear infinite;
  animation: animate-loading 1s linear infinite;
}
#contact .php-email-form input, #contact .php-email-form textarea {
  border-radius: 0;
  box-shadow: none;
  font-size: 14px;
}
#contact .php-email-form input:focus, #contact .php-email-form textarea:focus {
  border-color: #f82249;
}
#contact .php-email-form input {
  padding: 10px 15px;
}
#contact .php-email-form textarea {
  padding: 12px 15px;
}
#contact .php-email-form button[type=submit] {
  background: #f82249;
  border: 0;
  padding: 10px 40px;
  color: #fff;
  transition: 0.4s;
  border-radius: 50px;
  cursor: pointer;
}
#contact .php-email-form button[type=submit]:hover {
  background: #e0072f;
}
@-webkit-keyframes animate-loading {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
@keyframes  animate-loading {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
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



  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      
    </div>
  </section><!-- End Hero Section -->
  
  <br><br>

  <main id="main">
        <div class="body-container container-fluid">

            <div class="row-fluid-wrapper row-depth-1 row-number-1 ">
                <div class="row-fluid ">
                    <div class="span12 widget-span widget-type-widget_container " style="" data-widget-type="widget_container" data-x="0" data-w="12">
                        <span id="hs_cos_wrapper_module_15640568252832100" class="hs_cos_wrapper hs_cos_wrapper_widget_container hs_cos_wrapper_type_widget_container" style="" data-hs-cos-general-type="widget_container" data-hs-cos-type="widget_container">
                            <div id="hs_cos_wrapper_widget_13681966973" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                               
                               
                            </div>
                            <div id="hs_cos_wrapper_widget_13681966972" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="two-col-text  top-space bottom-space">
                                    <div class="container">
                                        <div class="dis-flex inner-container  ">
                                            <div class="left-text" data-aos="fade-up" data-aos-duration="1000">
                                                <div class="inner-content">
                                                    <h2>
                                                        <span>We're always on the lookout for talented people...</span>
                                                    </h2>
                                                </div>
                                            </div>
                                            <div class="right-text">
                                                <div class="detail-content" data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">
                                                    <p>Are you an open-minded, out-of-the-box thinker with bucketloads of enthusiasm and an incredible skillset? Join the {{$settings->site_name}}  family and contribute to our mission.&nbsp;</p>
                                                    <p>At {{$settings->site_name}} , we have a progressive perspective of the world and the issues that impact on human sovereignty and sustainability. With a shared goal of providing the tools and technology to aid a positive change, we pool our talents and skills to bring this about.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="hs_cos_wrapper_widget_1625823594219" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="two-col-text  top-space bottom-space">
                                    <div class="container">
                                        <div class="dis-flex inner-container  ">
                                            <div class="left-text" data-aos="fade-up" data-aos-duration="1000">
                                                <div class="inner-content">
                                                    <h2>
                                                        <span>Currently available roles:</span>
                                                    </h2>
                                                </div>
                                            </div>
                                            <div class="right-text">
                                                <div class="detail-content" data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">
                                             
                                                    <p>
                                                        <a href="#" rel="noopener">
                                                            <strong>
                                                                <span style="color: #599ce8;">Deputy MLRO</span>
                                                            </strong>
                                                        </a>
                                                    </p>
                                                    
                                                    <p>
                                                        <span style="color: #599ce8;">
                                                            <strong>
                                                                <a href="#" rel="noopener" style="color: #599ce8;">Senior UX/UI Designer</a>
                                                            </strong>
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <strong>
                                                            <span style="color: #599ce8;">
                                                                <a href="#" rel="noopener" target="_blank" style="color: #599ce8;">3D Character Artist</a>
                                                            </span>
                                                        </strong>
                                                    </p>
                                                    <p>
                                                        <span style="color: #599ce8;">
                                                            <strong>
                                                                <a href="#" rel="noopener" style="color: #599ce8;">Junior Videographer</a>
                                                            </strong>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="hs_cos_wrapper_widget_1623689987812" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="two-col-form">
                                    <div class="container">
                                        <div class="dis-flex">
                                            <div class="left-text" data-aos="fade-up" data-aos-duration="700">
                                                <div class="inner-text">

                                                    <h2>
                                                        <hr>

                                                                     Send us your CV
                                                                   
                                                    </h2>

                                                    <div class="detail-containt">
                                                        <p>Want to work for {{$settings->site_name}} ? Even if we're not currently advertising for a specific role, we're open to hearing from people who resonate with our mission and would like to be considered for a permanent position.</p>
                                                        <p>&nbsp;</p>
                                                        <p>Be sure to include a cover letter that details your proposed role and why you are interested in working with us.</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="right-form" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">

                                                <span id="hs_cos_wrapper_widget_1623689987812_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_form" style="" data-hs-cos-general-type="widget" data-hs-cos-type="form">
                                                    <div id="hs_form_target_widget_1623689987812"></div>

                                                </span>
                                              <div class="form">
                                  <form action="#" method="post" role="form" class="php-email-form">
                                    <div class="row">
                                      <div class="form-group col-md-6">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                      </div>
                                      <div class="form-group col-md-6 mt-3 mt-md-0">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                      </div>
                                    </div>
                                    <div class="form-group mt-3">
                                      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                    </div>
                                    <div class="form-group mt-3">
                                      <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                                    </div>
                                    
                                    <div class="text-center"><button type="submit">Send Message</button></div>
                                  </form>
                                </div>

                                              
                                     
                          
                          
                          	
                            <div id="hs_cos_wrapper_widget_13681966974" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="benifits-module">
                                    <div class="benifits-module-flex">
                                        <div class="benifits-left" data-aos="zoom-in" data-aos-duration="700">
                                            <div class="benifits-left-content-wrapper">
                                                <h3>Why Work for {{$settings->site_name}} </h3>
                                                <div class="benifits-left-content">
                                                    <p>"{{$settings->site_name}}  is not just a company, it's a mission" - Michael Hudson, Founder and CEO&nbsp;</p>
                                                    <p>Working for {{$settings->site_name}} , you're not just another number. You're a part of a team. A family. A family committed and driven to use the best of our skills and talents to contribute to the collective goal of helping to reimagine, redefine and reengineer humanity and the world. Not only for our generation, but for the generations to come too.&nbsp;</p>
                                                    <p>&nbsp;</p>
                                                    <p>&nbsp;</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="benifits-right">
                                            <div class="benifits-right-flex">

                                                <div class="benifits-items" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="100">
                                                    <h6>We Act with Integrity</h6>
                                                    <p>We're open, honest and transparent in all we do. We value our personal and professional reputations and don't engage in behaviours that would risk either. </p>
                                                </div>

                                                <div class="benifits-items" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="200">
                                                    <h6>We're Inclusive and Diverse</h6>
                                                    <p>We believe in an equal playing field and don't discriminate. We value different views, opinions and backgrounds and believe diversity brings about an opportunity for learning. </p>
                                                </div>

                                                <div class="benifits-items" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="300">
                                                    <h6>We Celebrate Achievements</h6>
                                                    <p>We're proud of each others successes, milestones and accomplishments and honour and commemorate achievements, big or small. </p>
                                                </div>

                                                <div class="benifits-items" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="400">
                                                    <h6>We're Innovative and Determined</h6>
                                                    <p>We pursue our goals with vigour. We question ‘traditional methods’ and seek to learn and create better solutions with a progressive approach. </p>
                                                </div>

                                                <div class="benifits-items" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="500">
                                                    <h6>We're Open-Minded and Curious</h6>
                                                    <p>We're open to exploring new ideas, concepts or opinions, and seek information to broaden our knowledge, understanding and view of the world. </p>
                                                </div>

                                                <div class="benifits-items" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="600">
                                                    <h6>We Promote Health and Wellness</h6>
                                                    <p>We understand that our success depends on the energy, intelligence, and contributions of all, and we encourage balance and development. </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="hs_cos_wrapper_widget_13681966975" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="two-col-image">
                                    <div class="container">
                                        <div class="two-col-image-flex">

                                            <div class="two-col-image-left" style="background-image:url(www.gravity.eco/hubfs/Website%20Assets/Career2.png);" data-aos="zoom-in" data-aos-duration="700"></div>
                                            <div class="two-col-image-right" style="background-image:url(www.gravity.eco/hubfs/Website%20Assets/Career3.png)" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="100"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!--end widget-span -->
                </div>
                <!--end row-->
            </div>
            <!--end row-wrapper -->

        </div>
        <!--end body -->
    </div>
    <!--end body wrapper -->
  

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