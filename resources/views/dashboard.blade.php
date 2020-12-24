@extends('layouts.app')

@section('title','Dashboard')

@section('customStyles')
    <link rel="stylesheet" href="/css/dashboard.css"/>
    <link rel="stylesheet" href="/css/responsiveOverview.css"/>
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
                        <div id="productsAndServicesViewButton">
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
                        <div id="ordersViewButton">
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
