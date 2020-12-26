<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index($productId)
    {
        return view('showServices')
            ->with(['productData' => Product::find($productId), 'serviceData' => Product::find($productId)->services]);
    }
}
