@extends('layouts.app')
@section('title','Products and Services')

@section('customStyles')
    <link rel="stylesheet" href="/css/productsAndServices.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('customScripts')
@endsection

@section('content')
    <!-- Default Content -->
    <div class="container">
        <div class="row justify-content-between" style="margin: 10px 0;">
            <div class="col-md-3 controller">
                <h1>Controller X</h1>
                <div class="controllerContent">
                    <span>Serial Number: asdf</span>
                    <span>Registered on: date</span>
                    <span>Project: asdf</span>
                    <span>External address: asdf</span>
                    <span class="serviceNumber">3 Services</span>
                    <button data-toggle="modal" data-target="#detailsModal"><i class="fa fa-eye"></i></button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="dialogTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dialogTitle">Details of Controller X</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="controllerDetails">
                        <span><b>Serial Number:</b> 12</span>
                        <span><b>Registered on:</b> date</span>
                        <span><b>Project:</b> asdf</span>
                        <span><b>External address:</b> asdf</span>

                        <div style="margin-top: 3rem;">
                            <div id="editController" class="btn btn-outline-primary btn-container">
                                Edit
                            </div>
                            <div id="deleteController" class="btn btn-outline-danger btn-container">
                                Delete
                            </div>
                        </div>
                    </div>

                    <div class="controllerServices">
                        <div class="controllerService">
                            <div class="centeredImage">
                                <span class="alignmentHelper"></span>
                                <img src="/images/weather_service.png" alt="Weather Service Icon"/>
                            </div>
                            <div class="serviceDetails">
                                <h5>Weather Service</h5>
                                <span><b>Licence Nr.:</b> 123123123</span>
                                <span><b>Valid until:</b> 24.7.2992</span>
                            </div>
                            <div class="actions">
                                <a href="#"><i class="material-icons">edit</i></a>
                                <a href="#"><i class="material-icons">delete</i></a>
                            </div>
                        </div>
                        <div class="controllerService">
                            <div class="centeredImage">
                                <span class="alignmentHelper"></span>
                                <img src="/images/weather_service.png" alt="Weather Service Icon"/>
                            </div>
                            <div class="serviceDetails">
                                <h5>Weather Service</h5>
                                <span><b>Licence Nr.:</b> 123123123</span>
                                <span><b>Valid until:</b> 24.7.2992</span>
                            </div>
                            <div class="actions">
                                <a href="#"><i class="material-icons">edit</i></a>
                                <a href="#"><i class="material-icons">delete</i></a>
                            </div>
                        </div>
                        <div class="controllerService">
                            <div class="centeredImage">
                                <span class="alignmentHelper"></span>
                                <img src="/images/weather_service.png" alt="Weather Service Icon"/>
                            </div>
                            <div class="serviceDetails">
                                <h5>Weather Service</h5>
                                <span><b>Licence Nr.:</b> 123123123</span>
                                <span><b>Valid until:</b> 24.7.2992</span>
                            </div>
                            <div class="actions">
                                <a href="#"><i class="material-icons">edit</i></a>
                                <a href="#"><i class="material-icons">delete</i></a>
                            </div>
                        </div>
                        <div class="addService controllerService">
                            <h5 style="font-weight: bold;">Add a Service</h5>
                            <form style="height: 14rem;">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label for="licenseNr">License Nr.</label>
                                    <input id="licenseNr" name="licenseNr" type="number"/>
                                </div>
                                <div class="form-group" style="width: 50%; display: inline-block;">
                                    <label for="validUntil">Valid until</label>
                                    <input id="validUntil" name="validUntil" type="date"/>
                                </div>
                                <button class="btn btn-primary">Add ></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
