@extends('layouts.app')
@section('title','Products and Services')

@section('customStyles')
    <link rel="stylesheet" href="/css/productsAndServices.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@php
    //Accept incoming standardized format and then reformat
    function getFormattedDate($product){
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->RegisteredOn)->format('jS M. Y H:i:s');
    }
@endphp

@section('content')
    <!-- Default Content -->
    <div class="container">
        <div class="row justify-content-between" style="margin: 10px 0;">
            @foreach($productData as $product)
                <div class="col-md-3 controller">
                    <h3>{{$product->ControllerName}}</h3>
                    <div class="controllerContent">
                        <span>Serial Number: {{$product->SerialNumber}}</span>
                        <span>Registered on: {{getFormattedDate($product)}}</span>
                        <span>Project: {{$product->ProjectName}}</span>
                        <span>External address: {{$product->ExternalAddress}}</span>
                        <span class="serviceNumber">{{count($product->services)}} Services</span>
                        <button data-toggle="modal" data-target="#detailsModal"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="dialogTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>

@endsection
