<?php

namespace App\Http\Controllers;

use App\Models\FormEntry;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use stdClass;

class OrderController extends Controller
{

    const possibleStates = array('Not yet ordered', 'Ordered', 'Finished');

    public function index()
    {
        return view('orders')->with('orderData', Order::all());
    }

    public function create()
    {
        $content = new stdClass();
        $content->title = "Create an Order";
        $content->method = "POST";
        $content->url = route('order.store');


        $possibleProducts = array_map(
            function ($projectNameResult) {
                return $projectNameResult['ProjectName'];
            },
            Product::select('ProjectName')->distinct()->get()->toArray()
        );


        if (count($possibleProducts) == 0)
            $possibleProducts[] = "New unknown product";

        $content->elements = array(
            new FormEntry(
                "Ordered on",
                "orderedOn",
                "datetime-local",
                now()
            ),
            new FormEntry(
                "Reference Name",
                "referenceName",
                "select",
                "",
                false,
                $possibleProducts,
                "Smarthome "
            ),
            new FormEntry(
                "State",
                "orderState",
                "select",
                "",
                false,
                self::possibleStates
            )
        );

        return view('manageDataStructure')->with('formStructure', $content);
    }

    public function store(Request $request)
    {
        $order = new Order;
        $order->OrderedDate = $request->orderedOn;
        $order->ReferenceName = $request->referenceName;

        if(!in_array($request->orderState, self::possibleStates)){
            return response()->json([
                'errors' => "Not a real possibleState",
            ], 406); //Return not acceptable
        }

        $order->State = $request->orderState;
        $order->save();
        return redirect()->route('order.index');
    }

    //TODO: On update check if still exists

    public function destroy(Order $order){
        $order->delete();
        return response()->json([], 202);
    }
}
