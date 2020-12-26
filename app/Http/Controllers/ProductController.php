<?php

namespace App\Http\Controllers;

use App\Models\FormEntry;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProductController extends Controller
{

    private function requestToOProduct(Request $request, Product $product = null): Product{
        if($product===null)
            $product = new Product;
        $product->ControllerName = $request->controllerName;
        $product->SerialNumber = $request->serialNumber;
        $product->RegisteredOn = $request->registeredOn;
        $product->ProjectName = $request->projectName;
        $product->ExternalAddress = $request->externalAddress;
        return $product;
    }

    public function index(){
        return view('productsAndServices')->with('productData',Product::all());
    }

    public function addService(Request $request){
        $serviceToAdd = Service::where('LicenseNumber',$request->licenceNumber)->first();

        if($serviceToAdd==null || $serviceToAdd->id == null)
            return response()->json([
                'errors' => "Service to add not found",
            ], 404);

        $serviceToAdd->products()->attach($request->productId);

        return redirect()->route('product.index');
    }


    public function create(bool $previouslyFailed = false)
    {
        $content = new stdClass();
        $content->title = "Create a Product/Controller-Association";
        $content->method = "POST";
        $content->url = route('product.store');
        $content->previouslyFailed = $previouslyFailed;

        $content->elements = array(
            new FormEntry(
                "Controller Name",
                "controllerName",
                "text"
            ),
            new FormEntry(
                "Serial Number",
                "serialNumber",
                "number"
            ),
            new FormEntry(
                "Registered on",
                "registeredOn",
                "datetime-local",
                now(),
            ),
            new FormEntry(
                "Project Name",
                "projectName",
                "text"
            ),
            new FormEntry(
                "External IP Address",
                "externalAddress",
                "text"
            )
        );

        return view('manageDataStructure')->with('formStructure', $content);
    }

    public function store(Request $request)
    {
        $product = $this->requestToOProduct($request);

        try {
            $product->save();
        } catch (QueryException $e) {
            return $this->create(true);
        }

        return redirect()->route('product.index');
    }

    public function edit(Product $product, bool $previouslyFailed = false)
    {
        $content = new stdClass();
        $content->title = "Edit a Product";
        $content->method = "PUT";
        $content->url = route('product.update', $product->id);
        $content->previouslyFailed = $previouslyFailed;

        $content->elements = array(
            new FormEntry(
                "Controller Name",
                "controllerName",
                "text",
                $product->ControllerName
            ),
            new FormEntry(
                "Serial Number",
                "serialNumber",
                "number",
                $product->SerialNumber
            ),
            new FormEntry(
                "Registered on",
                "registeredOn",
                "datetime-local",
                $product->RegisteredOn,
            ),
            new FormEntry(
                "Project Name",
                "projectName",
                "text",
                $product->ProjectName
            ),
            new FormEntry(
                "External IP Address",
                "externalAddress",
                "text",
                $product->ExternalAddress
            )
        );
        return view('manageDataStructure')->with('formStructure', $content);
    }

    public function update(Request $request, Product $product)
    {
        DB::beginTransaction();
        $product = $this->requestToOProduct($request, $product);

        if (Product::where("id", $product->id)->exists()) {
            try {
                $product->save();
            } catch (QueryException $e) {
                return $this->edit($product, true);
            }
            DB::commit();
        } else {
            DB::rollBack();
            return $this->edit($product, true);
        }
        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([], 202);
    }
}
