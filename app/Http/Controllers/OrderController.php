<?php

namespace App\Http\Controllers;

use App\Models\FormEntry;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\QueryException;
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
                return $projectNameResult['project_name'];
            },
            Product::select('project_name')->distinct()->get()->toArray()
        );

        if (count($possibleProducts) == 0)
            $possibleProducts[] = "New unknown product";
        return $possibleProducts;
    }

    public function index()
    {
        return view('orders')->with('orderData', Order::all());
    }

    public function create(bool $previouslyFailed = false)
    {
        $content = new stdClass();
        $content->title = "Create an Order";
        $content->method = "POST";
        $content->url = route('order.store');
        $content->previouslyFailed = $previouslyFailed;

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
        $order->date_ordered = $request->orderedOn;
        $order->reference_name = $request->referenceName;

        if (!in_array($request->orderState, self::possibleStates)) {
            return response()->json([
                'errors' => "Not a real possibleState",
            ], 406); //Return not acceptable
        }

        $order->state = $request->orderState;
        try {
            $order->save();
        } catch (QueryException $e) {
            return $this->create(true);
        }

        return redirect()->route('order.index');
    }

    public function edit(Order $order, bool $previouslyFailed = false)
    {
        $content = new stdClass();
        $content->title = "Edit an Order";
        $content->method = "PUT";
        $content->url = route('order.update', $order->id);
        $possibleProducts = $this->getPossibleProducts();
        $content->previouslyFailed = $previouslyFailed;

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
                $order->date_ordered,
            ),
            new FormEntry(
                "Reference Name",
                "referenceName",
                "select",
                $order->reference_name,
                false,
                $possibleProducts,
                "Smarthome "
            ),
            new FormEntry(
                "State",
                "orderState",
                "select",
                $order->state,
                false,
                self::possibleStates
            )
        );
        return view('manageDataStructure')->with('formStructure', $content);
    }

    public function update(Request $request, Order $order)
    {
        DB::beginTransaction();
        $order->date_ordered = $request->orderedOn;
        $order->reference_name = $request->referenceName;
        $order->state = $request->orderState;

        if (Order::where("id", $order->id)->exists()) {
            try {
                $order->save();
            } catch (QueryException $e) {
                return $this->edit($order, true);
            }
            DB::commit();
        } else {
            DB::rollBack();
        }
        return redirect()->route('order.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json([], 202);
    }
}
