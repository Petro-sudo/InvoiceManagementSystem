<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;
//use App\Models\Student;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;


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

        $orders = new Order();
        activity('Created Order')->performedOn($orders) // Entry add in table. model name(subject_type) & id(su& id(subject_id)
            // Entry add in table. model name(subject_type) & id(subject_id)
            ->causedBy(Auth::user()) //causer_id = admin id, causer type = admin model
            ->log(Auth::user()->email);
        Alert::success('Success', 'You Have Created a New Order!');
        return redirect('view_orders');
    }
    //display LOGS
    public function activityLogsList()
    {
        $activityLogData = Activity::with('causer')->get(); //causer_id = admin id, causer type = admin model
        return view('admin.activity-logs', compact('activityLogData'));
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
        $request->validate([
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
        $invoice = new Invoice();
        $invoice->order_id = $request->order_id;
        $invoice->invoicedate = $request->invoicedate;
        $invoice->supplyname = $request->supplyname;
        $invoice->invoicescm = $request->invoicescm;
        $invoice->invoiceamount = $request->invoiceamount;
        $invoice->invoicereceiver = $request->invoicereceiver;
        $invoice->disputedinvoice = $request->disputedinvoice;
        $invoice->typepayment = $request->typepayment;
        $invoice->invoiceComments = $request->invoiceComments;

        $invoices = DB::table('orders')
            ->join('invoices', 'invoices.order_id', '=', 'orders.id')
            ->where('invoices.order_id', $invoice->order_id)
            ->select('invoices.order_id')
            ->sum('invoices.invoiceamount') + $invoice->invoiceamount;

        $orders = DB::table('orders')
            ->where('orders.id',  $invoice->order_id)
            ->select('orderamount')
            ->where('orders.id',  $invoice->order_id)
            ->value('orders.orderamount');

        $Pmt = $orders - $invoices;
        //dd($result);

        if ($Pmt == 0.0 || $Pmt == 0 || $Pmt == 0.00) {
            Alert::success('Congrats', 'Total Invoice Amount is Paid');
            activity('Captured Invoice')->performedOn($invoice) // Entry add in table. model name(subject_type) & id(su& id(subject_id)
                // Entry add in table. model name(subject_type) & id(subject_id)
                ->causedBy(Auth::user()) //causer_id = admin id, causer type = admin model
                ->log(Auth::user()->email);
            $invoice->save();
        } else if ($Pmt > 0) {
            Alert::warning('Warning', 'The Invoice is Still Owning!');
            activity('Captured Invoice')->performedOn($invoice) // Entry add in table. model name(subject_type) & id(su& id(subject_id)
                // Entry add in table. model name(subject_type) & id(subject_id)
                ->causedBy(Auth::user()) //causer_id = admin id, causer type = admin model
                ->log(Auth::user()->email);
            $invoice->save();
        } else if ($Pmt <= -0) {
            Alert::error('Error', 'The Invoice Amount is Overpaid!');
        }

        activity('Captured Invoice')->performedOn($invoice) // Entry add in table. model name(subject_type) & id(su& id(subject_id)
            // Entry add in table. model name(subject_type) & id(subject_id)
            ->causedBy(Auth::user()) //causer_id = admin id, causer type = admin model
            ->log(Auth::user()->email);
        //Alert::success('Congrats', 'You Have Captured a New Invoice!');
        // $invoice->save();
        return redirect('list_invoice');
    }

    //get invoice
    public function store_payment(Request $request)
    {
        $payment = $request->validate([

            'invoice_id' => 'required',
            'paydate' => 'required',
            'paidwithin30days' => 'required',
            'paymentnumber' => 'required|unique:payments',
            'paymentComments' => '',
            'authorizedby' => ''
        ]);
        $newPayment = Payment::Create($payment);

        $payment = new Payment();
        activity('Authorised Payment')->performedOn($payment) // Entry add in table. model name(subject_type) & id(su& id(subject_id)
            // Entry add in table. model name(subject_type) & id(subject_id)
            ->causedBy(Auth::user()) //causer_id = admin id, causer type = admin model
            ->log(Auth::user()->email);
        Alert::success('Congrats', 'You Have Authorized a Payment!');
        return redirect('list_payment');
    }
    public function view_invoice($id)
    {
        $orders = Order::All();
        $invoices = Invoice::All();
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
        $invoices = Order::join('invoices', 'invoices.order_id', '=', 'orders.id')->get();;
        return view('invoice.invoicelist')->with('invoices', $invoices);
    }

    public function list_payment(Payment $payments)
    {
        $payments = Invoice::join('payments', 'payments.invoice_id', '=', 'invoices.id')->get();
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
//adding
 //$orders = Order::find($id)->orderamount;
        // dd($orders);
        // $result = DB::table('orders')
        //     ->join('invoices', 'invoices.order_id', '=', 'orders.id')
        //     ->where('invoices.order_id', $id)
        //     ->select('invoices.order_id')
        //     ->sum('invoices.invoiceamount');
        //$data = Order::join('invoices', 'invoices.order_id', '=', 'orders.id')->get();

        // $result += $request->invoiceamount;
        //$balance = $result;
        //$Pmt = $orders - $balance;