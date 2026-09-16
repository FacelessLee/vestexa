
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



        .v2 {
            box-sizing: border-box;
            color: #313131;
            line-height: 1.7;
            font-family: Open Sans, sans-serif;
            font-size:16px
        }
    
        .v2 *, .v2 :after, .v2 :before {
            box-sizing:inherit
        }
    
        .v2 footer, .v2 section {
            display:block
        }
    
        
        .v2 a {
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
            cursor:pointer
        }
    
        .v2 video {
            display:inline-block
        }
    
        .v2 img {
            border-style:none
        }
    
        .v2 svg:not(:root) {
            overflow:hidden
        }
    
        .v2 ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font:inherit
        }
    
        .v2 template {
            display:none
        }
    
        .v2 h2, .v2 h4, .v2 h5, .v2 p, .v2 ul {
            margin: 0;
            padding:0
        }
    
        .v2 p, .v2 ul {
            margin-bottom:1.875rem
        }
    
        .v2 img {
            max-width: 100%;
            height: auto;
            font-style: italic;
            vertical-align:middle
        }
    
        .v2 ul {
            list-style-type: none;
            margin-left:0
        }
    
        .v2 strong {
            font-weight:700
        }
    
        .v2 a {
            color: inherit;
            text-decoration:none
        }
    
        .v2 video {
            max-width: 100%;
            vertical-align:middle
        }
    
        .v2 .v2-btn {
            cursor: pointer;
            display: inline-block;
            font-size: .875rem;
            line-height: 1.25rem;
            text-align: center;
            font-weight: 700;
            padding: 10px 30px;
            text-decoration: none;
            transition: background-color .15s cubic-bezier(.645, .045, .355, 1);
            -webkit-appearance: none;
            border-radius: 6px;
            border-width:0
        }
    
        .v2 .v2-btn.v2-btn-primary {
            color: #fff;
            background-color:#0076ff
        }
    
        
    
        .v2 .v2-btn.v2-btn-primary:disabled {
            color: #fff;
            background-color:#d9d9dc
        }
    
        .v2 .v2-btn.v2-btn-secondary {
            border: 1px solid #0076ff;
            line-height: 1.125rem;
            color: #0076ff;
            background-color:transparent
        }
    
       
    
        .v2 .v2-btn.v2-btn-secondary:disabled {
            color: #d9d9dc;
            background-color: transparent;
            border:1px solid #d9d9dc
        }
    
        .v2 .v2-btn.v2-btn-secondary--inverted {
            border: 1px solid #fff;
            line-height: 1.125rem;
            color: #fff;
            background-color:transparent
        }
    
       
    
        .v2 .v2-btn.v2-btn-secondary--inverted:disabled {
            color: #459afc;
            background-color: transparent;
            border:1px solid #459afc
        }
    
        .v2 .v2-btn.v2-btn--link {
            color: #0076ff;
            text-decoration: none;
            transition: color .15s cubic-bezier(.645, .045, .355, 1);
            font-weight: 700;
            -ms-flex-item-align: center;
            align-self: center;
            padding: 0;
            background-color:transparent
        }
    
        
    
        .v2 .v2-btn-wrapper {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column-reverse;
            flex-direction:column-reverse
        }
    
        @media (min-width: 768px) {
            .v2 .v2-btn-wrapper {
                display: -ms-inline-flexbox;
                display: inline-flex;
                -ms-flex-negative: 0;
                flex-shrink: 0;
                margin-left: -.5rem;
                margin-right:-.5rem
            }
    
            .v2 .v2-btn-wrapper {
                -ms-flex-direction: row;
                flex-direction:row
            }
        }
    
        .v2 .v2-btn-wrapper .v2-btn {
            margin-bottom: .625rem;
            margin-left: 0;
            margin-right: 0;
            width:100%
        }
    
        @media (min-width: 768px) {
            .v2 .v2-btn-wrapper .v2-btn {
                width: auto;
                margin:0 .5rem
            }
        }
    
        .v2 .v2-btn-wrapper--center {
            text-align: center;
            display:block
        }
    
        .v2 .v2-icon {
            display:inline-block
        }
    
        .v2 .v2-icon--fill-lightblue {
            fill:#0076ff
        }
    
        .v2 .v2-picture {
            max-width:100%
        }
    
        .v2 .v2-picture--background {
            height: 100%;
            width: 100%;
            display: block;
            overflow: hidden;
            position:relative
        }
    
        .v2 .v2-picture--background img {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left:0
        }
    
        .v2 .v2-picture--fit-cover img {
            -o-object-fit: cover;
            object-fit:cover
        }
    
        .v2 .v2-section {
            background-color:#f2f2f5
        }
    
        .v2 .v2-h1 {
            font-size: 2.125rem;
            line-height: 2.625rem;
            font-weight:700
        }
    
        @media (min-width: 768px) {
            .v2 .v2-h1 {
                font-size: 2.75rem;
                line-height:3.375rem
            }
        }
    
        .v2 .v2-h2 {
            font-size: 1.75rem;
            line-height: 2.125rem;
            font-weight:700
        }
    
        @media (min-width: 768px) {
            .v2 .v2-h2, .v2 h2 {
                font-size: 2.125rem;
                line-height:2.75rem
            }
        }
    
        .v2 .v2-h1, .v2 .v2-h2 {
            margin-bottom:35px
        }
    
        .v2 .v2-h3 {
            font-size: 1.5rem;
            line-height: 1.8125rem;
            font-weight: 700;
            margin-bottom:25px
        }
    
        @media (min-width: 768px) {
            .v2 .v2-h3 {
                font-size: 1.5rem;
                line-height:1.9375rem
            }
        }
    
        .v2 .v2-h4 {
            font-size: 1rem;
            line-height: 1.3125rem;
            font-weight:700
        }
    
        @media (min-width: 768px) {
            .v2 .v2-h4, .v2 h4 {
                font-size: 1rem;
                line-height:1.1875rem
            }
        }
    
        .v2 .v2-h5, .v2 h5 {
            font-size: .875rem;
            line-height: 1.125rem;
            font-weight:700
        }
    
        @media (min-width: 768px) {
            .v2 .v2-h5, .v2 h5 {
                font-size: .875rem;
                line-height:1.0625rem
            }
        }
    
        .v2 .v2-h4, .v2 .v2-h5 {
            margin-bottom:15px
        }
    
        .v2 .v2-sh1 {
            font-size: 1.1875rem;
            line-height: 1.5rem;
            font-weight:400
        }
    
        @media (min-width: 768px) {
            .v2 .v2-sh1 {
                font-size: 1.1875rem;
                line-height:1.6875rem
            }
        }
    
        .v2 .v2-sh1 {
            margin-bottom:30px
        }
    
        .v2 p {
            font-size: .875rem;
            line-height:1.25rem
        }
    
        .v2 .v2-text-align--center {
            text-align:center
        }
    
        .v2 .v2-text-align--left {
            text-align:left
        }
    
        @media (min-width: 1024px) {
            .v2 .v2-md-text-align--center {
                text-align:center
            }
        }
    
        @media (min-width: 1024px) {
            .v2 .v2-md-text-align--left {
                text-align:left
            }
        }
    
        .v2 .v2-typography--inverted {
            color:#fff
        }
    
        .v2 .v2-wrapper {
            margin-left: auto;
            margin-right: auto;
            max-width: 1120px;
            width: 100%;
            padding-left: 15px;
            padding-right:15px
        }
    
        @media (min-width: 768px) {
            .v2 .v2-wrapper {
                padding-left: 20px;
                padding-right:20px
            }
        }
    
        .v2-anchor-link {
            position: relative;
            height: 0;
            width: 0;
            top:0
        }
    
        @media (min-width: 540px) {
            .v2-anchor-link {
                top:0
            }
        }
    
        @media (min-width: 1200px) {
            .v2-anchor-link {
                top: 0
            }
        }
        </style>
        <style>
        .v2 .v2-row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
            margin-left: -15px;
            margin-right:-15px
        }
    
        .v2 .v2-row > [class * =v2-col] {
            padding-left: 15px;
            padding-right:15px
        }
    
        .v2 .v2-col, .v2 [class * =v2-col-] {
            position: relative;
            min-height: 1px;
            min-width: 1px;
            margin-left: 0;
            margin-right: 0;
            -ms-flex-preferred-size: 100%;
            flex-basis: 100%;
            max-width:100%
        }
    
        .v2 .v2-col-xs-12 {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 100%;
            max-width:100%
        }
    
        @media (min-width: 768px) {
            .v2 .v2-col-sm-3 {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 25%;
                max-width:25%
            }
    
            .v2 .v2-col-sm-4, .v2 .v2-row-sm-4 > [class * =v2-col] {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 33.33333%;
                max-width:33.33333%
            }
    
            .v2 .v2-col-sm-6, .v2 .v2-row-sm-6 > [class * =v2-col] {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 50%;
                max-width:50%
            }
    
            .v2 .v2-row-sm-x {
                -ms-flex-flow: nowrap;
                flex-flow:nowrap
            }
        }
    
        @media (min-width: 1024px) {
            .v2 .v2-col-md-3, .v2 .v2-row-md-3 > [class * =v2-col] {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 25%;
                max-width:25%
            }
    
            .v2 .v2-col-md-6 {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 50%;
                max-width:50%
            }
    
            .v2 .v2-col-md-8 {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 66.66667%;
                max-width:66.66667%
            }
        }
    
        .v2 .v2-row--gutter-0 {
            margin-left: 0;
            margin-right:0
        }
    
        .v2 .v2-row--gutter-0 > [class * =v2-col] {
            padding-left: 0;
            padding-right:0
        }
    
        .v2 .v2-row--gutter-10 {
            margin-left: -5px;
            margin-right:-5px
        }
    
        .v2 .v2-clearfix:after {
            clear: both;
            content: "";
            display:table
        }
    
        .v2 .v2-flexbox {
            display: -ms-flexbox;
            display:flex
        }
    
        .v2 .v2-align--top {
            -ms-flex-align: start;
            align-items:flex-start
        }
    
        .v2 .v2-align--middle {
            -ms-flex-align: center;
            align-items:center
        }
    
        .v2 .v2-align--start {
            -ms-flex-pack: start;
            justify-content: flex-start;
            text-align:start
        }
    
        .v2 .v2-align--center {
            -ms-flex-pack: center;
            justify-content: center;
            text-align:center
        }
    
        .v2 .v2-align-self--top {
            -ms-flex-item-align: start;
            align-self:flex-start
        }
    
        .v2 .v2-align-self--end {
            margin-right: 0;
            margin-left:auto
        }
    
        .v2 .v2-xs-align--middle {
            -ms-flex-align: center;
            align-items:center
        }
    
        .v2 .v2-h100p {
            height:100%
        }
          
        .v2 .v2-hide-empty:empty {
            display:none
        }
    
        .v2 .v2-mat0 {
            margin-top:0
        }
    
        .v2 .v2-mat30 {
            margin-top:30px
        }
    
        .v2 .v2-mat80 {
            margin-top:80px
        }
    
        .v2 .v2-mat100 {
            margin-top:100px
        }
    
        .v2 .v2-mat5n {
            margin-top:-5px
        }
    
        .v2 .v2-mat20n {
            margin-top:-20px
        }
    
        .v2 .v2-mab0 {
            margin-bottom:0
        }
    
        .v2 .v2-mab10 {
            margin-bottom:10px
        }
    
        .v2 .v2-mab20 {
            margin-bottom:20px
        }
    
        .v2 .v2-mab30 {
            margin-bottom:30px
        }
    
        .v2 .v2-mab40 {
            margin-bottom:40px
        }
    
        .v2 .v2-mab50 {
            margin-bottom:50px
        }
    
        .v2 .v2-mab60 {
            margin-bottom:60px
        }
    
        .v2 .v2-mab80 {
            margin-bottom:80px
        }
    
        .v2 .v2-mab100 {
            margin-bottom:100px
        }
    
        .v2 .v2-mab30n {
            margin-bottom:-30px
        }
    
        .v2 .v2-mab16 {
            margin-bottom:16px
        }
    
        .v2 .v2-mab25 {
            margin-bottom:25px
        }
    
        .v2 .v2-mal10 {
            margin-left:10px
        }
    
        .v2 .v2-paa30 {
            padding:30px
        }
    
        .v2 .v2-pah15 {
            padding-left: 15px;
            padding-right:15px
        }
    
        .v2 .v2-pav10 {
            padding-top: 10px;
            padding-bottom:10px
        }
    
        .v2 .v2-pat20 {
            padding-top:20px
        }
    
        .v2 .v2-pab15 {
            padding-bottom:15px
        }
    
        @media (max-width: 767px) {
            .v2 .v2-sm-max-mat0 {
                margin-top:0
            }
    
            .v2 .v2-sm-max-mat50 {
                margin-top:50px
            }
    
            .v2 .v2-sm-max-mat80 {
                margin-top:80px
            }
    
            .v2 .v2-sm-max-mab0 {
                margin-bottom:0
            }
    
            .v2 .v2-sm-max-mab20 {
                margin-bottom:20px
            }
    
            .v2 .v2-sm-max-mab40 {
                margin-bottom:40px
            }
    
            .v2 .v2-sm-max-mab50 {
                margin-bottom:50px
            }
    
            .v2 .v2-sm-max-mab150 {
                margin-bottom:150px
            }
    
            .v2 .v2-sm-max-mab20n {
                margin-bottom:-20px
            }
    
            .v2 .v2-sm-max-mab40n {
                margin-bottom:-40px
            }
        }
    
        @media (max-width: 1023px) {
            .v2 .v2-md-max-pah15 {
                padding-left: 15px;
                padding-right:15px
            }
    
            .v2 .v2-md-max-pav20 {
                padding-top: 20px;
                padding-bottom:20px
            }
        }
    
        @media (min-width: 768px) {
            .v2 .v2-sm-mab0 {
                margin-bottom:0
            }
        }
    
        .v2 .v2-rounded-corner--big {
            border-radius:6px
        }
    
        .v2 .v2-borderless {
            border:0 !important
        }
    
        .v2 .v2-bg--transparent {
            background-color:transparent !important
        }
    
        .v2-overflow-hidden {
            overflow: hidden
        }
        </style>
          <style>
          /**
    * Template Name: Dewi - v4.7.0
    * Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    */
    
    /*--------------------------------------------------------------
    # General
    --------------------------------------------------------------*/
    body {
      font-family: "Open Sans", sans-serif;
      color: #444444;
    }
    
    a {
      color: #ff4a17;
      text-decoration: none;
    }
    
    a:hover {
      color: #ff724a;
      text-decoration: none;
    }
    
    h1, h2, h3, h4, h5, h6 {
      font-family: "Raleway", sans-serif;
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
      background: #ff4a17;
      width: 40px;
      height: 40px;
      border-radius: 4px;
      transition: all 0.4s;
    }
    .back-to-top i {
      font-size: 24px;
      color: #fff;
      line-height: 0;
    }
    .back-to-top:hover {
      background: #ff6a40;
      color: #fff;
    }
    .back-to-top.active {
      visibility: visible;
      opacity: 1;
    }
    
    /*--------------------------------------------------------------
    # Preloader
    --------------------------------------------------------------*/
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 9999;
      overflow: hidden;
      background: #fff;
    }
    
    #preloader:before {
      content: "";
      position: fixed;
      top: calc(50% - 30px);
      left: calc(50% - 30px);
      border: 6px solid #ff4a17;
      border-top-color: #ffe9e3;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      -webkit-animation: animate-preloader 1s linear infinite;
      animation: animate-preloader 1s linear infinite;
    }
    
    @-webkit-keyframes animate-preloader {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
    
    @keyframes  animate-preloader {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
    /*--------------------------------------------------------------
    # Disable aos animation delay on mobile devices
    --------------------------------------------------------------*/
    @media  screen and (max-width: 768px) {
      [data-aos-delay] {
        transition-delay: 0 !important;
      }
    }
    /*--------------------------------------------------------------
    # Header
    --------------------------------------------------------------*/
    .header {
      transition: all 0.5s;
      z-index: 997;
      padding: 30px 0;
    }
    
    .header.sticked {
      background: rgba(14, 29, 52, 0.9);
      padding: 15px 0;
      box-shadow: 0px 2px 20px rgba(14, 29, 52, 0.1);
    }
    
    .header .logo img {
      max-height: 60px;
      margin-right: 6px;
    }
    
    .header .logo h1 {
      font-size: 30px;
      margin: 0;
      font-weight: 700;
      color: #fff;
      font-family: var(--font-primary);
    }
    
    /*--------------------------------------------------------------
    # Desktop Navigation
    --------------------------------------------------------------*/
    @media (min-width: 1280px) {
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
    
      .navbar a,
      .navbar a:focus {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0 10px 30px;
        font-family: var(--font-primary);
        font-size: 16px;
        font-weight: 400;
        color: rgba(255, 255, 255, 0.6);
        white-space: nowrap;
        transition: 0.3s;
      }
    
      .navbar a i,
      .navbar a:focus i {
        font-size: 12px;
        line-height: 0;
        margin-left: 5px;
      }
    
      .navbar a:hover,
      .navbar .active,
      .navbar .active:focus,
      .navbar li:hover>a {
        color: #fff;
      }
    
      .navbar .get-a-quote,
      .navbar .get-a-quote:focus {
        background: var(--color-primary);
        padding: 8px 20px;
        margin-left: 30px;
        border-radius: 4px;
        color: #fff;
      }
    
      .navbar .get-a-quote:hover,
      .navbar .get-a-quote:focus:hover {
        color: #fff;
        background: #2756ff;
      }
    
      .navbar .dropdown ul {
        display: block;
        position: absolute;
        left: 14px;
        top: calc(100% + 30px);
        margin: 0;
        padding: 10px 0;
        z-index: 99;
        opacity: 0;
        visibility: hidden;
        background: #fff;
        box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
        transition: 0.3s;
        border-radius: 4px;
      }
    
      .navbar .dropdown ul li {
        min-width: 200px;
      }
    
      .navbar .dropdown ul a {
        padding: 10px 20px;
        font-size: 15px;
        text-transform: none;
        font-weight: 400;
        color: var(--color-secondary);
      }
    
      .navbar .dropdown ul a i {
        font-size: 12px;
      }
    
      .navbar .dropdown ul a:hover,
      .navbar .dropdown ul .active:hover,
      .navbar .dropdown ul li:hover>a {
        color: var(--color-primary);
      }
    
      .navbar .dropdown:hover>ul {
        opacity: 1;
        top: 100%;
        visibility: visible;
      }
    
      .navbar .dropdown .dropdown ul {
        top: 0;
        left: calc(100% - 30px);
        visibility: hidden;
      }
    
      .navbar .dropdown .dropdown:hover>ul {
        opacity: 1;
        top: 0;
        left: 100%;
        visibility: visible;
      }
    }
    
    @media (min-width: 1280px) and (max-width: 1366px) {
      .navbar .dropdown .dropdown ul {
        left: -90%;
      }
    
      .navbar .dropdown .dropdown:hover>ul {
        left: -100%;
      }
    }
    
    @media (min-width: 1280px) {
    
      .mobile-nav-show,
      .mobile-nav-hide {
        display: none;
      }
    }
    
    /*--------------------------------------------------------------
    # Mobile Navigation
    --------------------------------------------------------------*/
    @media (max-width: 1279px) {
      .navbar {
        position: fixed;
        top: 0;
        right: -100%;
        width: 100%;
        max-width: 400px;
        bottom: 0;
        transition: 0.3s;
        z-index: 9997;
      }
    
      .navbar ul {
        position: absolute;
        inset: 0;
        padding: 50px 0 10px 0;
        margin: 0;
        background: rgba(14, 29, 52, 0.9);
        overflow-y: auto;
        transition: 0.3s;
        z-index: 9998;
      }
    
      .navbar a,
      .navbar a:focus {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 20px;
        font-family: var(--font-primary);
        font-size: 16px;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.7);
        white-space: nowrap;
        transition: 0.3s;
      }
    
      .navbar a i,
      .navbar a:focus i {
        font-size: 12px;
        line-height: 0;
        margin-left: 5px;
      }
    
      .navbar a:hover,
      .navbar .active,
      .navbar .active:focus,
      .navbar li:hover>a {
        color: #fff;
      }
    
      .navbar .get-a-quote,
      .navbar .get-a-quote:focus {
        background: var(--color-primary);
        padding: 8px 20px;
        border-radius: 4px;
        margin: 15px;
        color: #fff;
      }
    
      .navbar .get-a-quote:hover,
      .navbar .get-a-quote:focus:hover {
        color: #fff;
        background: rgba(13, 66, 255, 0.8);
      }
    
      .navbar .dropdown ul,
      .navbar .dropdown .dropdown ul {
        position: static;
        display: none;
        padding: 10px 0;
        margin: 10px 20px;
        transition: all 0.5s ease-in-out;
        border: 1px solid #19335c;
      }
    
      .navbar .dropdown>.dropdown-active,
      .navbar .dropdown .dropdown>.dropdown-active {
        display: block;
      }
    
      .mobile-nav-show {
        color: #fff;
        font-size: 28px;
        cursor: pointer;
        line-height: 0;
        transition: 0.5s;
        z-index: 9999;
        margin-right: 10px;
      }
    
      .mobile-nav-hide {
        color: #fff;
        font-size: 32px;
        cursor: pointer;
        line-height: 0;
        transition: 0.5s;
        position: fixed;
        right: 20px;
        top: 20px;
        z-index: 9999;
      }
    
      .mobile-nav-active {
        overflow: hidden;
      }
    
      .mobile-nav-active .navbar {
        right: 0;
      }
    
      .mobile-nav-active .navbar:before {
        content: "";
        position: fixed;
        inset: 0;
        background: rgba(14, 29, 52, 0.8);
        z-index: 9996;
      }
    }
    
    
          /*--------------------------------------------------------------
    # Hero Section
    --------------------------------------------------------------*/
    #hero {
      width: 100%;
      height: 70vh;
      background: url("temp/custom/img/black.jpg") top center;
      background-size: cover;
      position: relative;
      padding: 0;
    }
    #hero:before {
      content: "";
      background: rgba(13, 20, 26, 0.7);
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
    }
    #hero .hero-container {
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: center;
    }
    #hero h1 {
      margin: 0 0 10px 0;
      font-size: 48px;
      font-weight: 700;
      line-height: 56px;
      text-transform: uppercase;
      color: #fff;
    }
    #hero h2 {
      color: #eee;
      margin-bottom: 50px;
      font-size: 24px;
    }
    #hero .btn-get-started {
      font-family: "Open Sans", sans-serif;
      text-transform: uppercase;
      font-weight: 500;
      font-size: 14px;
      display: inline-block;
      padding: 10px 35px 10px 35px;
      border-radius: 4px;
      transition: 0.5s;
      color: #fff;
      background: #ff4a17;
      border: 2px solid #ff4a17;
    }
    #hero .btn-get-started:hover {
      border-color: #fff;
      background: rgba(255, 255, 255, 0.1);
    }
    #hero .btn-watch-video {
      font-size: 16px;
      display: inline-block;
      transition: 0.5s;
      margin-left: 25px;
      color: #fff;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    #hero .btn-watch-video i {
      line-height: 0;
      color: #fff;
      font-size: 32px;
      transition: 0.3s;
      margin-right: 8px;
    }
    #hero .btn-watch-video:hover i {
      color: #ff4a17;
    }
    @media (min-width: 1024px) {
      #hero {
        background-attachment: fixed;
      }
    }
    @media (max-width: 768px) {
      #hero h1 {
        font-size: 28px;
        line-height: 36px;
      }
      #hero h2 {
        font-size: 18px;
        line-height: 24px;
        margin-bottom: 30px;
      }
    }
      </style>
    
        
    
    
    
    <div class="cover hide"></div>       
          <style>
    
            /*--------------------------------------------------------------
    # Service Details
    --------------------------------------------------------------*/
    .service-details {
      padding-bottom: 10px;
    }
    .service-details .card {
      border: 0;
      padding: 0 30px;
      margin-bottom: 60px;
      position: relative;
    }
    .service-details .card-img {
      width: calc(100% + 60px);
      margin-left: -30px;
      overflow: hidden;
      z-index: 9;
      border-radius: 0;
    }
    .service-details .card-img img {
      max-width: 100%;
      transition: all 0.3s ease-in-out;
    }
    .service-details .card-body {
      z-index: 10;
      background: #fff;
      border-top: 4px solid #fff;
      padding: 30px;
      box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
      margin-top: -60px;
      transition: 0.3s;
    }
    .service-details .card-title {
      font-weight: 700;
      text-align: center;
      margin-bottom: 20px;
    }
    .service-details .card-title a {
      color: #1e4356;
      transition: 0.3s;
    }
    .service-details .card-text {
      color: #5e5e5e;
    }
    .service-details .read-more a {
      color: #777777;
      text-transform: uppercase;
      font-weight: 600;
      font-size: 12px;
      transition: 0.3s;
    }
    .service-details .read-more a:hover {
      color: #68A4C4;
    }
    .service-details .card:hover img {
      transform: scale(1.1);
    }
    .service-details .card:hover .card-body {
      border-color: #68A4C4;
    }
    .service-details .card:hover .card-body .card-title a {
      color: #68A4C4;
    }
    
    
    
    
            </style>
          <style>
    
            </style>
               <!-- ======= Hero Section ======= -->
      <section id="hero">
        <div class="hero-container" data-aos="fade-up" data-aos-delay="150">
          <h1>Pricing</h1>
          
          
        </div>
      </section><!-- End Hero --><br><br>
    
            <div class="main-content" >
              
              <!-- ======= Service Details Section ======= -->
        <section class="service-details">
          <div class="container">
    
            <div class="row">
              <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <div class="card">
                  <div class="card-img">
                    <img src="temp/custom/img/foreximg.jpg" alt="...">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><a href="#">Forex Pricing</a></h5>
                    <p class="card-text">Forex, also known as foreign exchange or FX trading, is the conversion of one currency into another. It is one of the most actively traded markets in the world, with an average daily trading volume of $5 trillion. Take a closer look at everything you’ll need to know about forex, including what it is, how you trade it and how leverage in forex works.</p>
                    <div class="read-more"><button class="btn-btn-primary" ><a href="#"><i class="bi bi-arrow-right"></i> View Pricing</a></button></div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <div class="card">
                  <div class="card-img">
                    <img src="temp/custom/img/cryptoimg.jpg" alt="...">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><a href="#">Cryptocurrency Pricing</a></h5>
                    <p class="card-text">Cryptocurrency trading involves speculating on price movements via a CFD trading account, or buying and selling the underlying coins via an exchange. Here youll find more information about cryptocurrency trading, how it works and what moves the markets.</p>
                    <div class="read-more"><button class="btn-btn-primary" ><a href="#"><i class="bi bi-arrow-right"></i> View Pricing</a></button></div>
                  </div>
                </div>
    
              </div>
              <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <div class="card">
                  <div class="card-img">
                    <img src="img/93977F00-9549-4CAD-84FF-A923FF812267_1_201_a.jpg" alt="...">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><a href="#">Stocks & ETFs Pricing</a></h5>
                    <p class="card-text">A stock, also known as equity, is a security that represents the ownership of a fraction of the issuing corporation also An exchange-traded fund (ETF) is a type of pooled investment security that operates much like a mutual fund. Typically, ETFs will track a particular index, sector, commodity, or other asset, but unlike mutual funds, ETFs can be purchased or sold on a stock exchange the same way that a regular stock can. </p>
                    <div class="read-more"><button class="btn-btn-primary" ><a href="#"><i class="bi bi-arrow-right"></i> View Pricing</a></button></div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <div class="card">
                  <div class="card-img">
                    <img src="temp/custom/img/oilgas.jpg" alt="...">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><a href="#">Commodities Pricing</a></h5>
                    <p class="card-text">The oil and gas industry is one of the largest sectors in the world in terms of dollar value, generating an estimated $5 trillion in global revenue as of 2022.
                      Oil is crucial to the global economic framework, impacting everything from transportation to heating & electricity to industrial production & manufacturing.</p>
                    <div class="read-more"><button class="btn-btn-primary" ><a href="#"><i class="bi bi-arrow-right"></i>View Pricing</a></button></div>
                  </div>
                </div>
              </div>
            </div>
    
          </div>
        </section>
              
            
                </div>
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
    
    <script type="text/javascript" src="https://translate.google.com/translate_a/elementa0d8a0d8.js?cb=googleTranslateElementInit"></script>
    @endsection
       