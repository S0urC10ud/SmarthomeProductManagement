@extends('layouts.app')

@section('title','Dashboard')

@section('customStyles')
    <style>
        #main {
            height: calc(100vh - 2em) !important;
        }

        .mainContainer {
            height: 100% !important;
        }

        #productsContainer {
            background-color: rgba(17, 38, 38, 0.7);
        }

        #ordersContainer {
            background-color: rgba(18, 40, 19, 0.7);
        }

        #productsContainer, #ordersContainer {
            height: 100%;
            background-size: cover;
            overflow: hidden;
            justify-content: center;
            align-items: center;
        }

        #productsContainer img, #ordersContainer img {
            /*Don't blur at the edges: https://stackoverflow.com/questions/12224320/defined-edges-with-css3-filter-blur*/
            min-width: 120%;
            min-height: 110%;
            filter: blur(.3em);
            flex-shrink: 0;
            position: absolute;
            top: -5%;
            left: -20%;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

        h1, h2 {
            color: white;
            margin-bottom: 0;
        }

        h2 {
            color: #e3e3e3;
        }

        .statistics {
            margin-top: 5vh;
            margin-left: 2vw;
        }

        .fancyButton {
            position: absolute;
            width: 10rem;
            height: 3.5rem;
            display: inline-block;
            color: white;
            cursor: pointer;
            font-weight: bold;
            font-size: 2rem;
            border: 3px solid black;
            transform: skewX(-10deg);
            right: 5vw;
            bottom: 5vh;
            text-align: center;
            padding-right: 10px;
        }

        .listingItem {
            width: 15rem;
            height: 4.5rem;
            background-color: #EDEDED;
            color: #393939;
            border: black solid 1px;
            overflow: auto;
            padding-top: 5px;
        }

        .listingItemTitle {
            margin-left: .2rem;
            font-weight: lighter;
        }

        .listingItemValue {
            font-size: 1.5rem;
            margin-left: .5rem;
        }

        .btn-container {
            vertical-align: center;
            font-size: 1.5rem;
            line-height: 3.5rem;
            border-radius: 0 !important;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid" style="height: 100%">
        <div class="row" style="height: 40% !important;">
            <div class="col-6" id="productsContainer">
                <img src="/images/products_and_services.jpg" alt="products_and_services image"/>
                <div class="statistics">
                    <h1 style="font-weight: bold;">12 Products</h1>
                    <h2><b>25</b> Services</h2>
                    <h2><b>25</b> Enabled</h2>

                    <a href="#">
                        <div class="fancyButton" style="background: rgb(0,135,254)">
                            View
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-6" id="ordersContainer">
                <img src="/images/orders.jpg" alt="orders image"/>

                <div class="statistics">
                    <h1 style="font-weight: bold;">7 Orders</h1>
                    <h2><b>2</b> Finished</h2>

                    <a href="#">
                        <div class="fancyButton" style="background-color: #217103">
                            View
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row" style="background-color: #EDEDED; padding: 3vh; height: 60%">
            <div class="container" style="background-color: white; color: dimgrey; padding: 4vh">
                <div style="width: 100%; border-bottom: 1px dimgrey solid;">
                    <h3 style="color: dimgrey">Your Company</h3>
                </div>

                <div class="row justify-content-between" style="margin: 10px 0;">

                    <div class="listingItem col-lg-3">
                        <span class="listingItemTitle">Company Name</span><br/>
                        <span class="listingItemValue">MyGreatCompany</span>
                    </div>
                    <div class="listingItem col-lg-5">
                        <span class="listingItemTitle">Company E-Mail</span><br/>
                        <span class="listingItemValue">mygreatcompany@gmail.com</span>
                    </div>
                    <div class="col-lg-3 btn btn-outline-primary btn-container">
                        Edit
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
