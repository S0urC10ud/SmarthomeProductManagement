@php
    //Accept incoming standardized format and then reformat
    function getFormattedDate($product){
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->RegisteredOn)->format('jS M. Y H:i:s');
    }
@endphp

<div class="modal-header">
    <h5 class="modal-title" id="dialogTitle">Details
        of {{$productData->ControllerName}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="controllerDetails">
        <span><b>Serial Number:</b> {{$productData->SerialNumber}}</span>
        <span><b>Registered on:</b> {{getFormattedDate($productData)}}</span>
        <span><b>Project:</b> {{$productData->ProjectName}}</span>
        <span><b>External address:</b> {{$productData->ExternalAddress}}</span>

        <div style="margin-top: 3rem;">
            <a id="editController" class="btn btn-outline-primary btn-container"
               href="{{route('product.edit',$productData->id)}}">
                Edit
            </a>
            <div id="deleteController"
                 class="btn btn-outline-danger btn-container"
                 onclick="deleteEntry('Product',{{$productData->id}},'{{route('product.destroy',$productData->id)}}','{{route('product.index')}}');">
                Delete
            </div>
        </div>
    </div>

    <div id="controllerServices">
        @foreach($serviceData as $service)
            <div class="controllerService"
                @php
                    if($service->Enabled){echo "style=\"background-color: darkgrey !important;\"";} //could not use {{}}-Syntax because of special character encodings
                @endphp>

                @php
                    switch($service->ServiceName){
                        case "Weather Service":
                            $imagePath = "/images/weather_service.png";
                            break;
                        case "Air Conditioning Service":
                            $imagePath = "/images/air_conditioning_service.png";
                            break;
                        default:
                            $imagePath = "#";
}
                @endphp

                <div class="centeredImage">
                    <span class="alignmentHelper"></span>
                    <img src="{{$imagePath}}" alt="Weather Service Icon"/>
                </div>
                <div class="serviceDetails">
                    <h5>{{$service->ServiceName}}</h5>
                    <span><b>Enabled:</b> {{$service->Enabled ? "false" : "true"}}</span>
                    <span><b>Licence Nr.:</b> {{$service->LicenseNumber}}</span>
                    <span><b>Valid until:</b> {{$service->MaxDate}}</span>
                </div>
                <div class="actions">
                    <a href="{{route('service.edit',$service->id)}}"><i class="material-icons">edit</i></a>
                    <a href="{{route('service.destroy',$service->id)}}"><i class="material-icons">delete</i></a>
                </div>
            </div>
        @endforeach
        <div class="addService controllerService">
            <h5 style="font-weight: bold;">Add a Service</h5>
            <form style="height: 14rem;">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="licenseNr">License Nr.</label>
                    <input id="licenseNr" name="licenseNr" type="number" class="form-control"/>
                </div>
                <div class="form-group" style="width: 50%; display: inline-block;">
                    <label for="validUntil">Valid until</label>
                    <input id="validUntil" name="validUntil" type="date" class="form-control"/>
                </div>
                <button class="btn btn-primary">Add ></button>
            </form>
        </div>
    </div>
</div>