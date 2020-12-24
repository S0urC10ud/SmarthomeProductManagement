@extends('layouts.app')
@section('title','Orders')

@section('customStyles')
    <link rel="stylesheet" href="/css/orders.css"/>
    <link rel="stylesheet" href="/css/responsiveOverview.css"/>
@endsection

@section('customScripts')
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script>
        window.onload = () => {
            if (Cookies.get('hasSeenFirstUsageInfo') == null) {
                document.querySelector('#firstUsageInfo').querySelector('sl-alert').show();
                Cookies.set('hasSeenFirstUsageInfo', true, {expires: 4000, sameSite: 'strict'}); //Expiry cannot be infinity --> many days in the future
            }
        };
    </script>
@endsection

@section('content')
    <div id="firstUsageInfo">
        <sl-alert type="primary" duration="8000" closable>
            <sl-icon slot="icon" name="info-circle"></sl-icon>
            Click on rows of the table to see details/actions about them!
        </sl-alert>
    </div>

    <div class="row contentSection" style="margin-bottom: 10px !important; margin-top: 10px !important;">


        <div class="container">
            <div id="orderButtonContainer">
                <div class="btn btn-outline-primary btn-container" id="addOrderButton">Add new order</div>
            </div>
            <div class="constrainedTable">
                <table class="table table-hover">
                    <thead style="background-color: #007afe; color: white">
                    <tr>
                        <th scope="col">Order-Number</th>
                        <th scope="col">Ordered on</th>
                        <th scope="col">Reference-Name</th>
                        <th scope="col">State</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>14th December 2020</td>
                        <td>Otto Jaus</td>
                        <td>Done</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="row contentSection" style="min-height: 0 !important;">
        <div class="container">
            <div style="width: 100%; border-bottom: 1px dimgrey solid;">
                <h3 style="color: dimgrey">Details/Actions</h3>
            </div>

            <div class="row justify-content-between" style="margin: 10px 0;">
                <div class="listingItem col-md-3 col-12 order-1">
                    <span class="listingItemTitle">Order-Nr.</span><br/>
                    <span class="listingItemValue">123</span>
                </div>
                <div class="listingItem col-md-5 col-12 order-2">
                    <span class="listingItemTitle">Date</span><br/>
                    <span class="listingItemValue">4.December 2002</span>
                </div>
                <div class="col-md-3 col-6 btn btn-outline-primary btn-container order-last order-md-3">
                    Edit
                </div>
                <div class="col-12 order-4" style="height: 20px;"></div><!--SPACING-->
                <div class="listingItem col-md-3 col-12 order-5">
                    <span class="listingItemTitle">Status</span><br/>
                    <span class="listingItemValue">Delivered</span>
                </div>
                <div class="listingItem col-md-5 col-12 order-6">
                    <span class="listingItemTitle">Reference-Name</span><br/>
                    <span class="listingItemValue">My great ref. Name</span>
                </div>
                <div class="col-md-3 col-6 btn btn-outline-danger btn-container order-7">
                    Delete
                </div>
            </div>
        </div>
    </div>
@endsection
