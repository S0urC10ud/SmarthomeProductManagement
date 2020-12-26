<?php

namespace App\Http\Controllers;

use App\Models\FormEntry;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class OrderController extends Controller
{

    const possibleStates = array('Not yet ordered', 'Ordered', 'Finished');

    private function getPossibleProducts()
    {
        $possibleProducts = array_map(
            function ($projectNameResult) {
                return $projectNameResult['ProjectName'];
            },
            Product::select('ProjectName')->distinct()->get()->toArray()
        );

        if (count($possibleProducts) == 0)
            $possibleProducts[] = "New unknown product";
        return $possibleProducts;
    }

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

        $possibleProducts = $this->getPossibleProducts();

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

        if (!in_array($request->orderState, self::possibleStates)) {
            return response()->json([
                'errors' => "Not a real possibleState",
            ], 406); //Return not acceptable
        }

        $order->State = $request->orderState;
        $order->save();
        return redirect()->route('order.index');
    }

    public function edit(Order $order)
    {
        $content = new stdClass();
        $content->title = "Edit an Order";
        $content->method = "PUT";
        $content->url = route('order.update', $order->id);
        $possibleProducts = $this->getPossibleProducts();
        $content->elements = array(
            new FormEntry(
                "Order-Number",
                "id",
                "number",
                $order->id,
                true
            ),
            new FormEntry(
                "Ordered on",
                "orderedOn",
                "datetime-local",
                $order->OrderedDate,
            ),
            new FormEntry(
                "Reference Name",
                "referenceName",
                "select",
                $order->ReferenceName,
                false,
                $possibleProducts,
                "Smarthome "
            ),
            new FormEntry(
                "State",
                "orderState",
                "select",
                $order->State,
                false,
                self::possibleStates
            )
        );
        return view('manageDataStructure')->with('formStructure', $content);
    }

    public function update(Request $request, Order $order)
    {
        DB::beginTransaction();
        $order->OrderedDate = $request->orderedOn;
        $order->ReferenceName = $request->referenceName;
        $order->State = $request->orderState;

        if (Order::where("id", $order->id)->exists()) {
            $order->save();
            DB::commit();
        } else {
            DB::rollBack();
        }
        return redirect()->route('order.index');
    }

    //TODO: On update check if still exists

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json([], 202);
    }
}
