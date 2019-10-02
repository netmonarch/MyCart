<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function create (Request $request)
    {
        $newreq = str_replace ( "+", "", $request->cartJSON);
        $order = json_decode ($newreq);

        $quantity = array_slice ($order, -2, 1);
        $total = array_slice ($order, -1, 1);

        array_pop($order);
        array_pop($order);
       
        return view ("shop", ["order" => $order, "quantity"=> $quantity, "total"=> $total]);
    }
}
