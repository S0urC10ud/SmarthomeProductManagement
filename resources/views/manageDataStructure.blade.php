@extends('layouts.app')
@section('title','Orders')

@section('customStyles')
    <link rel="stylesheet" href="/css/manageDataStructure.css"/>
@endsection

@section('customScripts')
    @if($formStructure->previouslyFailed)
        <script>
            window.onload = () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Make sure all values are specified and correctly formatted!'
                });
            }
        </script>
    @endif
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
                    @if($formEntry->getType()=="select")
                        <select name="{{$formEntry->getRequestName()}}"
                                id="{{$formEntry->getRequestName()}}"
                                class="form-control"
                            {{$formEntry->getIsReadOnly() ? "readonly" : ""}}>
                            @foreach($formEntry->getPossibleValues() as $textValue)
                                <option
                                    value="{{$textValue}}"
                                    {{$textValue == $formEntry->getCurrentValue() ? "selected" : "" }}>
                                    {{$formEntry->getPrefix() . $textValue}}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <input type="{{$formEntry->getType()}}"
                               name="{{$formEntry->getRequestName()}}"
                               id="{{$formEntry->getRequestName()}}"
                               @if($formEntry->getType() != "checkbox")
                                value="{{$formEntry->getCurrentValue()}}"
                                class='form-control'
                               @endif
                            {{$formEntry->getIsReadOnly() ? "readonly" : ""}}
                            {{$formEntry->getType() == "checkbox" && $formEntry->getCurrentValue()==1 ? "checked" : ""}}
                        />
                        @if($formEntry->getType() == "datetime-local")
                            <small class="form-text text-muted">Hint: Chrome provides the best interactive
                                datetime-chooser!</small>
                        @endif
                    @endif
                </div>
            @endforeach
            <div class="row justify-content-between" style="margin:0;">
                <button
                    class="btn btn-danger"
                    onclick="window.history.go(-1); return false;">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    {{$formStructure->method == "PUT" ? "Edit" : "Create"}}
                </button>
            </div>
        </form>
    </div>
@endsection
