<?php

namespace App\Http\Controllers;

use App\Models\FormEntry;
use App\Models\Product;
use App\Models\Service;
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

    public function store(Request $request){
        $service = new Service;
        $service->ServiceName = $request->ServiceName;
        $service->LicenseNumber = $request->LicenseNr;
        $service->MaxDate = $request->ValidUntil;
        $service->Enabled = true;

        try {
            $service->save();
            $service->products()->attach($request->ProductId);
        } catch (QueryException $e) {
            return response()->json([
                'errors' => "Failed processing your request - make sure the format is correct and everything is filled in",
            ], 406);
        }
        return redirect()->route('product.index');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json([], 202);
    }

    public function edit(Service $service, bool $previouslyFailed = false)
    {
        $content = new stdClass();
        $content->title = "Edit a Service";
        $content->method = "PUT";
        $content->url = route('service.update', $service->id);
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
                $service->ServiceName,
                false,
                Service::TYPES
            ),
            new FormEntry(
                "License-Number",
                "licenseNumber",
                "number",
                $service->LicenseNumber,
            ),
            new FormEntry(
                "Expiry Date",
                "maxDate",
                "datetime-local",
                $service->MaxDate,
            ),
            new FormEntry(
                "Enabled",
                "enabled",
                "checkbox",
                $service->Enabled
            )
        );
        return view('manageDataStructure')->with('formStructure', $content);
    }

    public function update(Request $request, Service $service)
    {
        DB::beginTransaction();
        $service->ServiceName = $request->serviceName;
        $service->LicenseNumber = $request->licenseNumber;
        $service->MaxDate = $request->maxDate;
        $service->Enabled = $request->enabled == "on";

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
}
