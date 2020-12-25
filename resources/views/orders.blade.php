@extends('layouts.app')
@section('title','Orders')

@section('customStyles')
    <link rel="stylesheet" href="/css/orders.css"/>
    <link rel="stylesheet" href="/css/responsiveOverview.css"/>
@endsection

@section('customScripts')
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script>
        /***
         * Updates the lower selected item area
         * @param id number
         * @param date string - already formatted
         * @param referenceName string - already formatted
         * @param state string - already formatted
         */
        function setSelectedContent(id, date, referenceName, state) {
            $('#orderId').text(id);
            $('#orderDate').text(date);
            $('#orderRefName').text(referenceName);
            $('#orderState').text(state);

            {{-- The route needs to be prepared on the client --> choose from index --}}
            $('#editOrder').click(() => {
                window.location.replace(`{{route('order.index')}}/${id}/edit`);
            });
            $('#deleteOrder').click(() => {
                deleteEntry('Order', 1, `{{route('order.index')}}/${id}`, '{{route('order.index')}}');
            });
        }

        window.onload = () => {
            if (Cookies.get('hasSeenFirstUsageInfo') == null) {
                $('#firstUsageInfo').querySelector('sl-alert').show();
                Cookies.set('hasSeenFirstUsageInfo', true, {expires: 4000, sameSite: 'strict'}); //Expiry cannot be infinity --> many days in the future
            }
        };
    </script>
@endsection

@php
    //Accept incoming standardized format and then reformat
    function getFormattedDate($order){
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->OrderedDate)->format('jS M Y H:i:s');
    }
@endphp

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
                    @foreach($orderData as $order)
                        <tr onclick="setSelectedContent(
                        {{$order->id}},
                            '{{getFormattedDate($order)}}',
                            '{{$order->ReferenceName}}',
                            '{{$order->State}}'
                            );">
                            <th scope="row">{{$order->id}}</th>
                            <td>{{getFormattedDate($order)}}</td>
                            <td>{{$order->ReferenceName}}</td>
                            <td>{{$order->State}}</td>
                        </tr>
                    @endforeach
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
                    <span class="listingItemValue" id="orderId"></span>
                </div>
                <div class="listingItem col-md-5 col-12 order-2">
                    <span class="listingItemTitle">Ordered on</span><br/>
                    <span class="listingItemValue" id="orderDate"></span>
                </div>
                <div class="col-md-3 col-6 btn btn-outline-primary btn-container order-last order-md-3" id="editOrder">
                    Edit
                </div>
                <div class="col-12 order-4" style="height: 20px;"></div><!--SPACING-->
                <div class="listingItem col-md-3 col-12 order-5">
                    <span class="listingItemTitle">Status</span><br/>
                    <span class="listingItemValue" id="orderState"></span>
                </div>
                <div class="listingItem col-md-5 col-12 order-6">
                    <span class="listingItemTitle">Reference-Name</span><br/>
                    <span class="listingItemValue" id="orderRefName"></span>
                </div>
                <div class="col-md-3 col-6 btn btn-outline-danger btn-container order-7" id="deleteOrder">
                    Delete
                </div>
            </div>
        </div>
    </div>
@endsection
