@extends('layouts.app')
@section('title','Products and Services')

@section('customStyles')
    <link rel="stylesheet" href="/css/productsAndServices.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/loader.css">
@endsection

@section('customScripts')
    <script>
        function resetLoadingSpinner() {
            $("#modalContent").html("<div style=\"display: grid; place-items: center;\">\n" +
                "<div class=\"lds-ring\"><div></div><div></div><div></div><div></div></div>\n" + //pure html spinner with css effects
                "</div>");
        }

        function setModalContents(productId) {
            axios.get(`{{route('product.index')}}/${productId}/service`)
                .then((response) => {
                    $("#modalContent").html(response.data);
                }).catch((err) => {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong fetching the API!',
                }).then(() => {
                    $("#detailsModal").modal("hide");
                });
            });
        }

        $(document).on('hide.bs.modal', "#detailsModal", function () {
            setTimeout(() => {
                resetLoadingSpinner();
            }, 500);
        });

        window.onload = () => {
            resetLoadingSpinner();
        }
    </script>
@endsection

@php
    //Accept incoming standardized format and then reformat
    function getFormattedDate($product){
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->registered_on)->format('jS M. Y H:i:s');
    }
@endphp

@section('content')
    <!-- Default Content -->
    <div class="container">
        <div class="row justify-content-between" style="margin: 10px 0;">
            @foreach($productData as $product)
                <div class="col-md-3 controller">
                    <h3>{{$product->controller_name}}</h3>
                    <div class="controllerContent">
                        <span>Serial Number: {{$product->serial_number}}</span>
                        <span>Registered on: {{getFormattedDate($product)}}</span>
                        <span>Project: {{$product->project_name}}</span>
                        <span>External address: {{$product->external_address}}</span>
                        <span class="serviceNumber">{{count($product->services)}} Services</span>
                        <button onclick="setModalContents({{$product->id}})" data-toggle="modal"
                                data-target="#detailsModal"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
            @endforeach
            <div class="col-md-3 controller" style="display: grid; place-items: center; height:18rem;">
                <a class="btn btn-outline-primary btn-container" href="{{route('product.create')}}">
                    Add a new product
                </a>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="dialogTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modalContent"></div>
        </div>
    </div>
@endsection
