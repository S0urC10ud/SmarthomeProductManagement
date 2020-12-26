@extends('layouts.app')

@section('title','Dashboard')

@section('customStyles')
    <link rel="stylesheet" href="/css/dashboard.css"/>
    <link rel="stylesheet" href="/css/responsiveOverview.css"/>
@endsection

@section('content')
    @if($companyData!=null)
        <div class="container-fluid" style="height: 100%">
            <div class="row" style="min-height: 40% !important;">
                <div class="col-6" id="productsContainer">
                    <img src="/images/products_and_services.jpg" alt="products_and_services image"/>
                    <div class="statistics">
                        <h1 style="font-weight: bold;">{{\App\Models\Product::count()}} Products</h1>
                        <h2><b>{{\App\Models\Service::count()}}</b> Services</h2>
                        <h2><b>{{\App\Models\Service::where('Enabled',true)->count()}}</b> Enabled</h2>

                        <a href="{{route('product.index')}}">
                            <div id="productsAndServicesViewButton">
                                View
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6" id="ordersContainer">
                    <img src="/images/orders.jpg" alt="orders image"/>

                    <div class="statistics">
                        <h1 style="font-weight: bold;">{{\App\Models\Order::count()}} Orders</h1>
                        <h2><b>{{\App\Models\Order::where('State','Not yet ordered')->count()}}</b> Not yet ordered</h2>
                        <h2><b>{{\App\Models\Order::where('State','Ordered')->count()}}</b> Ordered</h2>
                        <h2><b>{{\App\Models\Order::where('State','Finished')->count()}}</b> Finished</h2>

                        <a href="{{route('order.index')}}">
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
                            <span class="listingItemValue">{{$companyData->Name}}</span>
                        </div>
                        <div class="listingItem col-md-5 col-12 order-2">
                            <span class="listingItemTitle">Company E-Mail</span><br/>
                            <span class="listingItemValue">{{$companyData->EMailAddress}}</span>
                        </div>
                        <a href="{{route('company.edit',$companyData->id)}}" class="col-md-3 col-6 btn btn-outline-primary btn-container order-last order-md-3">
                            Edit
                        </a>

                        <div class="col-12 order-4" style="height: 20px;"></div><!--SPACING-->

                        <div class="listingItem col-md-3 col-12 order-5">
                            <span class="listingItemTitle">Contact Firstname</span><br/>
                            <span class="listingItemValue">{{$companyData->ContactFirstname}}</span>
                        </div>
                        <div class="listingItem col-md-5 col-12 order-6">
                            <span class="listingItemTitle">Contact Lastname</span><br/>
                            <span class="listingItemValue">{{$companyData->ContactLastname}}</span>
                        </div>
                        <div class="col-md-3 col-6 btn btn-outline-danger btn-container order-7"
                             onclick="deleteEntry('your Company information','','{{route('company.destroy',$companyData->id)}}','{{route('dashboard')}}');">
                            Delete
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="h-100 row align-items-center firstSetupContainer">
            <div class="col container centeredContent">
                <h3>To continue, you first need to specify relevant company data</h3>
                <span>After having entered a few details, you can check out all functionalities of the Smarthome Management software!</span>
                <div class="row justify-content-center">
                    <a href="{{route('company.create')}}" class="btn btn-outline-primary col-12 col-md-3">Get started ></a>
                </div>
            </div>
        </div>
    @endif
@endsection
