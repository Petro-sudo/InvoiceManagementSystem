@extends('layouts.sidebar')
@extends('auth.layouts')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- Include Bootstrap JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('assets/css/registration.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@include('sweetalert::alert')


<div style="text-overflow: ellipsis;">
    <table class="table table-striped" style="text-align: center;" id="example" class="display nowrap"
        style="width:100%">
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Invoice Date</th>
                <th>Invoice Amount</th>
                <th>Invoice Receiver</th>
                <th>Dispute Invoice</th>
                <th>Comments</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($invoices as $invoices)
            <tr>
                <td class="text-center">{{$invoices->invoice_number}}</td>
                <td class="text-center">{{$invoices->invoicedate}}</td>
                <td class="text-center">{{$invoices->invoiceamount}}</td>
                <td class="text-center">{{$invoices->invoicereceiver}}</td>
                <td class="text-center">{{$invoices->disputedinvoice }}</td>
                <td style="text-align: left;">{{$invoices->invoiceComments }}</td>
            </tr>
            @endforeach
        </tbody>
        <!-- <tfoot>
            <tr>
                <th>Order Number</th>
                <th>Order Number SCM</th>
                <th>Order Date</th>
                <th>Supply Name</th>
                <th>End User Details</th>
                <th>Status</th>
                <th>Print</th>
            </tr>
        </tfoot> -->
    </table>
</div>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js">
</script>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
});
</script>
@endsection