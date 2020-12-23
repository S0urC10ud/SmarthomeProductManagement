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
            background-color: rgba(57, 41, 1, 0.7);
        }

        #productsContainer, #ordersContainer {
            background-size: cover;
            overflow: hidden;
            justify-content: center;
            align-items: center;
        }

        #productsContainer img, #ordersContainer img {
            /*Don't blur at the edges: https://stackoverflow.com/questions/12224320/defined-edges-with-css3-filter-blur*/
            height: 50vw;
            filter: blur(.3em);
            flex-shrink: 0;
            position: absolute;
            top: -10vw;
            left: -10%;
            z-index: -1;
        }


        h1, h2 {
            color: white;
            margin-bottom: 0;
        }

        h1 {
            font-size: min(5vmin, 3rem);
        }

        h2 {
            font-size: min(4vmin,2rem);
            color: #e3e3e3;
        }

        .statistics {
            margin-top: 5vh;
            margin-left: 2vw;
        }

        .fancyButton {
            position: absolute;
            width: min(20vmin,10rem);
            height: min(8vmin,4rem);
            display: inline-block;
            color: white;
            cursor: pointer;
            font-weight: bold;
            line-height: min(8vmin,4rem);
            vertical-align: center;
            font-size: min(5vmin,2rem);
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
            overflow-x: auto;
            overflow-y: hidden;
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

        .container {
            background-color: white;
            color: dimgrey;
            padding: 4vh;
        }
        .btn{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="height: 100%">
        <div class="row" style="min-height: 40% !important;">
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
                        <div class="fancyButton" style="background-color: #e7a505">
                            View
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row" style="height: 60%; display: grid; place-items: center;">
            <div class="container">
                <div style="width: 100%; border-bottom: 1px dimgrey solid;">
                    <h3 style="color: dimgrey">Your Company</h3>
                </div>

                <div class="row justify-content-between" style="margin: 10px 0;">

                    <div class="listingItem col-md-3 col-12 order-1">
                        <span class="listingItemTitle">Company Name</span><br/>
                        <span class="listingItemValue">MyGreatCompany</span>
                    </div>
                    <div class="listingItem col-md-5 col-12 order-2">
                        <span class="listingItemTitle">Company E-Mail</span><br/>
                        <span class="listingItemValue">mygreatcompany@gmail.com</span>
                    </div>
                    <div class="col-md-3 col-6 btn btn-outline-primary btn-container order-last order-md-3">
                        Edit
                    </div>

                    <div class="col-12 order-4" style="height: 20px;"></div><!--SPACING-->

                    <div class="listingItem col-md-3 col-12 order-5">
                        <span class="listingItemTitle">Contact Name</span><br/>
                        <span class="listingItemValue">My great Contact</span>
                    </div>
                    <div class="listingItem col-md-5 col-12 order-6">
                        <span class="listingItemTitle">Contact E-Mail</span><br/>
                        <span class="listingItemValue">mygreatcontact@gmail.com</span>
                    </div>
                    <div class="col-md-3 col-6 btn btn-outline-danger btn-container order-7">
                        Delete
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
