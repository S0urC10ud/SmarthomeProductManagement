@extends('layouts.app')
@section('title','Orders')

@section('customStyles')
    <link rel="stylesheet" href="/css/manageDataStructure.css"/>
@endsection

@section('customScripts')
@endsection

@section('content')
    <div class="container">
        <div class="title">
            <h3 style="color: dimgrey">{{$formStructure->title}}</h3>
        </div>

        <form method="POST" action="{{$formStructure->url}}">
            @csrf
            @if($formStructure->method == "PUT")
                @method('PUT')
            @endif

            @foreach($formStructure->elements as $formEntry)
                <div class="form-group">
                    <label for="{{$formEntry->getRequestName()}}">{{$formEntry->getDisplayName()}}</label>
                    <input type="{{$formEntry->getType()}}" name="{{$formEntry->getRequestName()}}" value="{{$formEntry->getCurrentValue()}}" class="form-control" id="{{$formEntry->getRequestName()}}">
                </div>
            @endforeach
            <div class="row justify-content-between" style="margin:0;">
                <button type="submit" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-primary">{{$formStructure->method == "PUT" ? "Edit" : "Create"}}</button>
            </div>
        </form>
    </div>
@endsection
