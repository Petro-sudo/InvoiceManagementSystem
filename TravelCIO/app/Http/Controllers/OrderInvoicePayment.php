<?php

namespace App\Http\Controllers;
use Spatie\Activitylog\Models\Activity;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderInvoicePayment extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::User();
    }

    public function create_order()
    {
        return view('order.createorder');
    }

    //store order
    public function store_order(Request $request)
    {

        $order = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'checkindate' => 'required',
            'checkoutdate' => 'required',
            'order_number' => 'required',
            'reason' => 'required',
            'branch' => 'required',
        ]);
        $newOrder = Order::Create($order);

        $orders = new Order();
        activity('Created Order')->performedOn($orders)
            ->causedBy(Auth::user())
            ->log(Auth::user()->email);
        Alert::success('Success', 'You Have Created a New Order!');
        return redirect('dashboard');
    }
    //display LOGS
    public function activityLogsList()
    {
        $activityLogData = Activity::with('causer')->get();
        return view('admin.activity-logs', compact('activityLogData'));
    }
  
//get all orders
public function list(Request $request)
{
    return view("order.orderlist", ['orders' => Order::all(),
]);

}


    //get orders
    public function edit(Order $orders)
    {
        return view('order.editOrders', ['orders' => $orders]);
    }

    public function updateOrder(Order $orders, Request $request)
    {
        $data = $request->validate([
            'name' => '',
            'surname' => '',
            'checkindate' => '',
            'checkoutdate' => '',
            'reason' => '',
            'branch' =>''

        ]);
        $orders->update($data);
        activity('Order Edited')->performedOn($orders)
            ->causedBy(Auth::user())
            ->log(Auth::user()->email);
        Alert::success('Success', 'You Have Edited the Order!');
        return view("order.orderlist", ['orders' => Order::all(),
    ]);

    }

    public function search()
    {
        $search_row = $_GET['search'];
        $orders = Orders::where('surname', 'LIKE', '%' . $search_row . '%')
            ->orWhere('name', 'LIKE', '%' . $search_row . '%')
            ->orWhere('order_number', 'LIKE', '%' . $search_row . '%')
            ->get();
        return view('search', compact('orders'));
    }
}