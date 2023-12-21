<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'order_number' => 'required|unique:orders',
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
        return redirect('dashboard');
    }

    //get orders
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
        $newInvoice = Invoice::Create($invoice);
        Alert::success('Congrats', 'You Have Registered a New Invoice!');
        return redirect('dashboard');
    }

    //get invoice
    public function create_payment(Invoice $invoices)
    {
        $invoices = Invoice::All();
        return view('payment.createpayment')->with('invoices', $invoices);
    }
    public function store_payment(Request $request)
    {
        $payment = $request->validate([

            'invoice_id' => 'required',
            'paymentreceiver' => 'required',
            'invoicedate' => 'required|unique:invoices',
            'paydate' => 'required',
            'paidamount' => 'required',
            'paidwithin30days' => '',
            'paymentComments' => '',
        ]);
        $newPayment = Payment::Create($payment);
        Alert::success('Congrats', 'You Have Registered a New Payment!');
        return redirect('dashboard');
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

    public function viewReport()
    {
        $users = Auth::user();
        //$user = User::join('reports','reports.user_id', '=', 'users.id')->where('reports.user_id','=','users.id')->where('reports.mentor_id','=',$users->id)->get();
        // $user = User::join('reports','reports.user_id', '=', 'users.id')->where('reports.mentor_id','=',$users->id)->get();
        // dd($user)  ;      // $user = User::where('id',$users->id)->get();//GET ONE USER INFO
        // return view('mentor.view')->with('user',$user);

        // $users = User::all()->where('role','=','1');
        // $data  = User::all()->where('role','=','3');
        // return view('intern.createreport', ['users'=>$users, 'data'=>$data,]);
    }
}
