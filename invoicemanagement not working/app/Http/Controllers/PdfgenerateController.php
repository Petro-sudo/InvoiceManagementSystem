<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PdfgenerateController extends Controller
{
    //

    public function generatePDF($id)
    {
        $orders = Order::All();
        $invoices = Invoice::All();
        $data = Order::join('invoices', 'invoices.order_id', '=', 'orders.id')->where('invoices.order_id', '=', $id)->get();

        $data1 = Invoice::join('payments', 'payments.invoice_id', '=', 'invoices.id')->where('payments.invoice_id', '=', $invoices[0]->id)->get();

        //return view('invoice.viewinvoice', ['data' => $data, 'data1' => $data1,]);

        $pdf = Pdf::loadView('yourPDF',  ['data' => $data, 'data1' => $data1,])->setPaper('a4', 'landscape');

        return $pdf->download('DepartmentRecipe.pdf');
    }
}