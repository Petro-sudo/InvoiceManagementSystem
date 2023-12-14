<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Order;
use RealRashid\SweetAlert\Facades\Alert;

class OrderInvoicePayment extends Controller
{
    public function create_order()
    {
        return view('order.createorder');
    }

    //store order
    public function store_order(Request $request)
    {

        $request->validate([
            'order_number' => 'required|unique:orders',
            'orderdate' => 'required',
            'supplyname' => 'required',
            'orderDetails' => 'required',
            'orderamount' => 'required',
            'enduser' => 'required',
            'orderscm' => 'required|unique:orders',
            'orderComments' => '',
        ]);
        $order = new Order();
        $order->order_number = $request->order_number;
        $order->orderdate = $request->orderdate;
        $order->supplyname = $request->supplyname;
        $order->orderDetails = $request->orderDetails;
        $order->orderamount = $request->orderamount;
        $order->enduser = $request->enduser;
        $order->orderscm = $request->orderscm;
        $order->orderComments = $request->orderComments;
        // $order->reason = json_encode($request->reasons);
        $order->save();
        // Redirect the user to a success page or back to the form
        Alert::success('Success', 'You Have Registered a New Order!');
        return redirect('dashboard');
    }

    public function create_invoice(Order $orders)
    {
        $orders = Order::All();
        return view('invoice.createinvoice')->with('orders', $orders);
    }

    //store invoice


    public function store_invoice(Request $request)
    {
        $invoice = $request->validate([
            'invoice_number' => 'required|unique:invoices',
            'order_id' => 'required',
            'invoicedate' => 'required',
            'invoicescm' => 'required|unique:invoices',
            'invoiceamount' => 'required',
            'invoicereceiver' => 'required',
            'disputedinvoice' => '',
            'invoiceComments' => '',
        ]);

        // Invoice::create([
        //     'invoice_number' => $request->invoice_number,
        //     'order_id' => $request->order_id,
        //     'invoicedate' => $request->invoicedate,
        //     'invoicescm' => $request->invoicescm,
        //     'invoiceamount' => $request->invoiceamount,
        //     'invoicereceiver' => $request->invoicereceiver,
        //     'disputedinvoice' => $request->disputedinvoice,
        //     'invoiceComments' => $request->invoiceComments,
        // ]);

        $newInvoice = Invoice::Create($invoice);
        Alert::success('Congrats', 'You Have Registered a New Invoice!');
        return redirect('dashboard');
    }
    public function create_payment(Invoice $invoice)
    {
        $invoice = Invoice::All();
        return view('payment.createpayment')->with('invoices', $invoice);
    }
}
