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
    <script>
        function refreshDateTime(elementId) {
            let expiryDate = new Date($(`#${elementId}Date`).val());
            let expiryTime = $(`#${elementId}Time`).val();
            $(`#${elementId}`).val(`${expiryDate.getFullYear()}-${expiryDate.getMonth() + 1}-${expiryDate.getDate()}T${expiryTime}`);
        }
    </script>
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
                               @if($formEntry->getType() == "datetime-local")
                               style="display: none !important;"
                            @endif
                            {{$formEntry->getIsReadOnly() ? "readonly" : ""}}
                            {{$formEntry->getType() == "checkbox" && $formEntry->getCurrentValue()==1 ? "checked" : ""}}
                        />
                        @if($formEntry->getType() == "datetime-local")
                            <input type="date"
                                   class='form-control'
                                   onchange="refreshDateTime('{{$formEntry->getRequestName()}}')"
                                   id="{{$formEntry->getRequestName()}}Date"/>
                            <script>
                                    $("#{{$formEntry->getRequestName()}}Date").val('{{$formEntry->getCurrentValue() != null ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $formEntry->getCurrentValue())->format('Y-m-d') :''}}');
                                    //would glitch in Firefox with directly setting the date-value
                            </script>
                            <input type="time"
                                   min="0:00"
                                   max="24:00"
                                   step="any"
                                   class='form-control'
                                   value="{{$formEntry->getCurrentValue() != null ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $formEntry->getCurrentValue())->format('H:i:s') :''}}"
                                   onchange="refreshDateTime('{{$formEntry->getRequestName()}}')"
                                   id="{{$formEntry->getRequestName()}}Time"/>
                        @endif
                    @endif
                </div>
            @endforeach
            <div class="row justify-content-between" style="margin:0;">
                <div
                    class="btn btn-danger"
                    style="cursor:pointer;"
                    onclick="document.referrer.includes('product') || document.referrer.includes('service') ?
                        window.location.href='{{route('product.index')}}'
                        : window.location.href='{{route('order.index')}}'">
                    Cancel
                </div> <!--A button would send the form-->
                <button type="submit" class="btn btn-primary">
                    {{$formStructure->method == "PUT" ? "Edit" : "Create"}}
                </button>
            </div>
        </form>
    </div>
@endsection
