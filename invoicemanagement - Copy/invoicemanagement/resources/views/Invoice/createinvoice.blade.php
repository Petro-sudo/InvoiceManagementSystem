@extends('layouts.sidebar')
@extends('auth.layouts')
@section('content')
<div style="text-overflow: ellipsis;">

    <label for="invoice_id">Please Selecting Order Number</label>
    <div class="col-4">
        <div class="input-group mb-3">
            <select class="custom-select form-select" id="select_ord">
                <option value="">Select Order Number</option>
            </select>
        </div>
    </div>
    <div>
        <button id="filter" class="btn btn-sm btn-outline-success">Check Order Details</button>
    </div><br>
    <table id="record_table" class="table table-striped" style="text-align: center;" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Supply Name</th>
                <th>Order Amount</th>
                <th>Order Date</th>
                <th>Total Invoice</th>
            </tr>
        </thead>
    </table>
</div>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">

        <div class="card">
            <div class="card-header" style="text-align: center; font-weight:bold;">DLCA REGISTER AN INVOICE
            </div>
            <div class="card-body">
                <form action="{{route('store_invoice')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="order_id">Please Select Order Number</label>

                        <div class="col-sm-6 mb-3">
                            <select name="order_id" id="order_id" class="form-control">
                                <option value="" selected disabled>Select Order No</option>
                                @foreach ($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->orderscm }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('order_id'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplyname">Supply Name</label>
                        <input type="text" class="form-control" id="supplyname" placeholder="Enter Supply Name"
                            name="supplyname">
                        <span class="text-danger">@error('supplyname'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="invoicedate">Invoice Received Date From Supplier</label>
                        <input type="date" class="form-control" id="invoicedate" name="invoicedate">
                        <span class="text-danger">@error('invoicedate'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="invoicereceiver">Invoice Recieved by</label>
                        <input type="text" class="form-control" id="invoicereceiver"
                            placeholder="Enter Name and Surname of Invoice Receiver" name="invoicereceiver">
                        <span class="text-danger">@error('invoicereceiver'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="invoicescm">Invoice Number Captured By (Finance)</label>
                        <input type="text" class="form-control" id="invoicescm" placeholder="Enter Invoice Number"
                            name="invoicescm">
                        <span class="text-danger">@error('invoicescm'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="typepayment">Type of Payment</label>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="typepayment" name="typepayment"
                                value="Full Payment">
                            <label class="form-check-label" for="checkbox">Full Payment</label>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="typepayment" name="typepayment"
                                value="Partial Payment">
                            <label class="form-check-label" for="checkbox">Partial Payment</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="invoiceamount">Invoice Amount</label>
                        <input type="text" class="form-control" id="invoiceamount"
                            placeholder="Enter Order Amount (0.00)" name="invoiceamount">
                        <span class="text-danger">@error('invoiceamount'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="disputedinvoice">Dispute Invoice</label>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="disputedinvoice" name="disputedinvoice"
                                value="Disputed">
                            <label class="form-check-label" for="checkbox">Yes</label>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="disputedinvoice" name="disputedinvoice"
                                value="Not-Disputed">
                            <label class="form-check-label" for="checkbox">No</label>
                        </div>
                        <span class="text-danger">@error('disputedinvoice'){{$message}}@enderror</span>
                    </div>


                    <div class="form-group">
                        <label for="invoiceComments">Comment</label>
                        <textarea type="text" class="form-control " id="invoiceComments"
                            name="invoiceComments"></textarea>

                    </div>
                    <br>

                    <input type="submit" class="col-md-3 offset-md-5 btn btn-success" value="Save" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Include Bootstrap JS -->
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
function fetch_ord() {
    $.ajax({
        url: "{{ route('getorders') }}",
        type: "GET",
        dataType: "json",
        success: function(data) {
            var stdBody = "";
            for (var key in data) {
                stdBody +=
                    `<option value="${data[key]['orderscm']}">${data[key]['orderscm']}</option>`;
            }
            $("#select_ord").append(stdBody);
        }
    });
}
fetch_ord();
// Fetch Records
function fetch(ord) {
    $.ajax({
        url: "{{ route('orders/records') }}",
        type: "GEt",
        data: {
            ord: ord
        },
        dataType: "json",
        success: function(data) {
            $('#record_table').DataTable({
                searching: false,
                ordering: false,
                paging: false,
                info: false,
                "data": data.orders,
                "responsive": true,
                "columns": [{
                        "data": "supplyname",
                    },
                    {
                        "data": "orderamount"
                    },
                    {
                        "data": "orderdate",
                    },
                    {
                        "data": "orderdate",
                    }

                ]
            });
        }
    });
}
fetch();
// Filter
$(document).on("click", "#filter", function(e) {
    e.preventDefault();
    var ord = $("#select_ord").val();
    if (ord !== "") {
        $('#record_table').DataTable().destroy();
        fetch(ord);
    } else if (ord == "") {
        $('#record_table').DataTable().destroy();
        fetch('');
    } else {
        $('#record_table').DataTable().destroy();
        fetch();
    }
});
</script>

@endsection