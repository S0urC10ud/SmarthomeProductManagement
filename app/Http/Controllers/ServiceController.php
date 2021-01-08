<?php

namespace App\Http\Controllers;

use App\Models\FormEntry;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ServiceController extends Controller
{
    public function index($productId)
    {
        return view('showServices')
            ->with(['productData' => Product::find($productId), 'serviceData' => Product::find($productId)->services]);
    }

    public function store(Request $request)
    {
        $service = new Service;
        $service->service_name = $request->serviceName;
        if (Product::find($request->productId)->services->where('licence_number',$request->licenceNr)->count()!=0)
            return response()->json([
                'errors' => "A service with the same licence-number already exists on the desired controller",
            ], 406);

        if($request->validUntil==null)
            return response()->json([
                'errors' => "Expiry date/time may not be null",
            ], 406);

        $service->licence_number = $request->licenceNr;
        $service->max_date = $request->validUntil;
        $service->enabled = true;

        try {
            $service->save();
            $service->products()->attach($request->productId);
        } catch (QueryException $e) {
            return response()->json([
                'errors' => "Failed processing your request - make sure the format is correct and everything is filled in",
            ], 406);
        }
        return redirect()->route('product.index');
    }

    public function edit(string $productId, Service $service, bool $previouslyFailed = false)
    {
        $content = new stdClass();
        $content->title = "Edit a Service";
        $content->method = "PUT";
        $content->url = route('product.service.update', [(int)$productId, $service->id]);
        $content->previouslyFailed = $previouslyFailed;

        $content->elements = array(
            new FormEntry(
                "Service Id",
                "id",
                "number",
                $service->id,
                true
            ),
            new FormEntry(
                "Service Name",
                "serviceName",
                "select",
                $service->service_name,
                false,
                Service::TYPES
            ),
            new FormEntry(
                "License-Number",
                "licenseNumber",
                "number",
                $service->licence_number,
            ),
            new FormEntry(
                "Expiry Date",
                "maxDate",
                "datetime-local",
                $service->max_date,
            ),
            new FormEntry(
                "Enabled",
                "enabled",
                "checkbox",
                $service->enabled
            )
        );
        return view('manageDataStructure')->with('formStructure', $content);
    }

    public function update(string $productId, Request $request, Service $service)
    {
        DB::beginTransaction();
        $service->service_name = $request->serviceName;
        $service->licence_number = $request->licenseNumber;
        $service->max_date = $request->maxDate;
        $service->enabled = $request->enabled == "on";

        if (Service::where("id", $service->id)->exists()) {
            try {
                $service->save();
            } catch (QueryException $e) {
                return $this->edit($service, true);
            }
            DB::commit();
        } else {
            DB::rollBack();
        }
        return redirect()->route('product.index');
    }

    public function destroy(string $productId, Service $service)
    {
        if (count($service->products) == 1)
            $service->delete();
        else
            $service->products()->detach($productId);
        return response()->json([], 202);
    }
}
