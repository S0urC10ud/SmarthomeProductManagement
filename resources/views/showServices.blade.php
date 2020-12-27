@php
    //Accept incoming standardized format and then reformat
    function getFormattedDate($date){
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('jS M. Y H:i:s');
    }
@endphp
<script>
    function refreshDateTime() {
        let expiryDate = new Date($("#validUntilDate").val());
        let expiryTime = $("#validUntilTime").val();
        $("#validUntil").val(`${expiryDate.getFullYear()}-${expiryDate.getMonth()+1}-${expiryDate.getDate()}T${expiryTime}`);
    }
</script>


<div class="modal-header">
    <h5 class="modal-title" id="dialogTitle">Details
        of {{$productData->controller_name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="controllerDetails">
        <span><b>Serial Number:</b> {{$productData->serial_number}}</span>
        <span><b>Registered on:</b> {{getFormattedDate($productData->registered_on)}}</span>
        <span><b>Project:</b> {{$productData->project_name}}</span>
        <span><b>External address:</b> {{$productData->external_address}}</span>

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
                 @if(!$service->enabled)
                 style="background-color: darkgrey !important;"
                @endif>

                @php
                    switch($service->service_name){
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
                <div class="serviceDetails" style="width: calc(100% - min(10vw, 3em) - 2em);">
                    <div class="serviceHeaderLine">
                        <h5 style="display:inline-block">{{$service->service_name}}</h5>
                        <a href="{{route('product.service.edit',[$productData->id,$service->id])}}" style="float: right; display: inline-block;"><i
                                class="material-icons">edit</i></a>
                        <div
                            onclick="deleteEntry('Service',{{$service->id}},'{{route('product.service.destroy',[$productData->id,$service->id])}}',
                                '{{route('product.index')}}');"
                            class="deleteServiceIcon">
                            <i class="material-icons">delete</i>
                        </div>
                    </div>
                    <span><b>Enabled:</b> {{$service->enabled ? 'true' : 'false'}}</span>
                    <span><b>Licence Nr.:</b> {{$service->licence_number}}</span>
                    <span><b>Valid until:</b> {{getFormattedDate($service->max_date)}}</span>
                </div>

            </div>
        @endforeach
        <div class="addService controllerService">
            <h5>Add a Service</h5>
            <form style="height: 22rem;" action="{{route('product.service.store', $productData->id)}}" method="POST">
                @csrf
                <input type="hidden" name="productId" value="{{$productData->id}}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <select name="serviceName" id="name" class="form-control">
                        <option value="Weather Service">Weather Service</option>
                        <option value="Air Conditioning Service">Air Conditioning Service</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="licenceNr">License Nr.</label>
                    <input id="licenceNr" name="licenceNr" type="number" class="form-control"/>
                </div>
                <div class="form-group" style="width: 50%; display: inline-block;">
                    <label for="validUntilDate">Valid until</label>
                    <input id="validUntilDate" onchange="refreshDateTime()" type="date" class="form-control"/>
                    <input id="validUntilTime" onchange="refreshDateTime()" type="time" value="00:00" class="form-control"/>
                    <input id="validUntil" name="validUntil" type="datetime-local" class="form-control" style="display: none;"/>
                </div>
                <button class="btn btn-primary">Add ></button>
            </form>
            <h5>Associate a Service</h5>
            <form action="{{route('product.addService')}}" method="POST">
                @csrf
                <input type="hidden" name="productId" value="{{$productData->id}}">
                <div class="form-group">
                    <label for="name">Licence Number</label>
                    <select name="licenceNumber" id="name" class="form-control">
                        @foreach(\App\Models\Service::all()->filter(function ($service) use ($productData) {return !$service->products->contains($productData->id);}) as $service)
                            <option
                                value="{{$service->licence_number}}">{{$service->licence_number . ' - ' . $service->service_name}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary" style="width: 8rem;">Associate ></button>
            </form>
        </div>
    </div>
</div>
