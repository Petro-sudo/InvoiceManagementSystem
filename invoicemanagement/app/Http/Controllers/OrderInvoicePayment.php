<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderInvoicePayment extends Controller
{
    public function create_order()
    {
        return view('order.createorder');
    }

public function store_order(Request $request)
    {

        $request->validate([
            'order_number' => 'required',
            'orderdate' => 'required',
            'supplyname' => 'required',
            'orderDetails' => 'required',
            'orderamount' => 'required',
            'enduser' => 'required',
            'orderscm' => 'required',
            'orderComments' => 'required',

            
        ]);
        $order = new Orders();
        $order->name = $request->name;
        $order->surname = $request->surname;
        $order->checkindate = $request->checkindate;
        $order->checkoutdate = $request->checkoutdate;
        $order->order_number = $request->order_number;
        $order->reason = $request->reason;
        $order->branch = $request->branch;
         // $order->reason = json_encode($request->reasons);
        $order->save();
        // Redirect the user to a success page or back to the form
        return redirect('dashboard')->with('message', 'You Have Created a New Order');
    }

}