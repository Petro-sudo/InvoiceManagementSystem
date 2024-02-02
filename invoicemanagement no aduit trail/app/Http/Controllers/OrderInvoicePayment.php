<?php

namespace App\Http\Controllers;

//use App\Models\Student;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
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

        $order = $request->validate([
            'orderscm' => 'required|unique:orders',
            'orderdate' => 'required',
            'supplyname' => 'required',
            'companyreg' => 'required',
            'supplycsd' => 'required',
            'streetname' => 'required',
            'town' => 'required',
            'zipcode' => 'required',
            'namesurname' => 'required',
            'email' => 'required',
            'cellnumber' => 'required',
            'description' => 'required',
            'qty' => 'required',
            'orderamount' => 'required',
            'orderComments' => '',
        ]);
        $newOrder = Order::Create($order);

        // $description = $request->description;
        // $qty = $request->qty;
        // for ($i = 0; $i < $description; $i++) {
        //     $order = [
        //         'description' => $description,
        //         'qty' => $qty,
        //     ];

        //     DB::table('orders')->insert($order);
        // }
        // Redirect the user to a success page or back to the form
        Alert::success('Success', 'You Have Registered a New Order!');
        return redirect('view_orders');
    }

    //get orders
    public function create_invoice(Order $orders)
    {
        $orders = Order::All();
        $invoices = Order::All();
        // return view('invoice.createinvoice')->with('orders', $orders);
        return view('invoice.createinvoice', ['orders' => $orders, 'invoices' => $invoices,]);
    }
    public function getOrders(Request $request)
    {
        if ($request->ajax()) {
            $orderscm = Order::select('orderscm')->get();
            return response()->json($orderscm);
        }
    }

    public function Orderrecords(Request $request)
    {
        if ($request->ajax()) {

            if (request('ord')) {
                $orders = Order::where('orderscm', '=', request('ord'))->get();
            } else {
                $orders = Order::when(request('ord'), function ($query) {
                    $query->where('orderscm', '=', request('ord'));
                })->get();
            }

            return response()->json([
                'orders' => $orders
            ]);
        } else {
            abort(403);
        }
    }


    //store invoice
    public function store_invoice(Request $request)
    {
        $invoice = $request->validate([
            'order_id' => 'required',
            'invoicedate' => 'required',
            'supplyname' => 'required',
            'invoicescm' => 'required|unique:invoices',
            'invoiceamount' => 'required',
            'invoicereceiver' => 'required',
            'disputedinvoice' => 'required',
            'typepayment' => 'required',
            'invoiceComments' => '',
        ]);
        $newInvoice = Invoice::Create($invoice);
        Alert::success('Congrats', 'You Have Captured a New Invoice!');
        return redirect('list_invoice');
    }

    //get invoice

    public function store_payment(Request $request)
    {
        $payment = $request->validate([

            'invoice_id' => 'required',
            'paydate' => 'required',
            'paidwithin30days' => 'required',
            'paymentnumber' => 'required',
            'paymentComments' => '',
        ]);
        $newPayment = Payment::Create($payment);
        Alert::success('Congrats', 'You Have Authorized a Payment!');
        return redirect('list_payment');
    }

    public function view_invoice($id)
    {
        $orders = Order::All();
        $invoices = Invoice::All();
        // $data = DB::select('select * FROM orders
        // INNER JOIN invoices
        // WHERE orders.id=invoices.order_id');
        // dd($data);
        // $data = Order::join('invoices', 'invoices.order_id', '=', 'orders.id')->where('invoices.order_id', '=', $orders[0]->id)->get();
        $data = Order::join('invoices', 'invoices.order_id', '=', 'orders.id')->where('invoices.order_id', '=', $id)->get();

        $data1 = Invoice::join('payments', 'payments.invoice_id', '=', 'invoices.id')->where('payments.invoice_id', '=', $invoices[0]->id)->get();

        return view('invoice.viewinvoice', ['data' => $data, 'data1' => $data1,]);
    }

    public function view_orders(Order $orders)
    {
        $orders = Order::All();
        return view('order.orderlist')->with('orders', $orders);
    }

    public function list_invoice(Invoice $invoices)
    {
        $invoices = Invoice::All();
        return view('invoice.invoicelist')->with('invoices', $invoices);
    }

    public function list_payment(Payment $payments)
    {
        $payments = Payment::All();
        return view('payment.paymentlist')->with('payments', $payments);
    }

    public function create_payment()
    {
        $invoices = Invoice::All();
        //$invoices = Order::join('invoices', 'invoices.order_id', '=', 'orders.orderscm')->get();
        return view('payment.createpayment')->with('invoices', $invoices);
    }

    public function getInvoice(Request $request)
    {
        if ($request->ajax()) {
            $invoicescm = Invoice::select('invoicescm')->get();
            return response()->json($invoicescm);
        }
    }

    public function records(Request $request)
    {
        if ($request->ajax()) {

            if (request('res')) {
                $invoices = Invoice::where('invoicescm', '=', request('res'))->get();
            } else {
                $invoices = Invoice::when(request('res'), function ($query) {
                    $query->where('invoicescm', '=', request('res'));
                })->get();
            }

            return response()->json([
                'invoices' => $invoices
            ]);
        } else {
            abort(403);
        }
    }
}