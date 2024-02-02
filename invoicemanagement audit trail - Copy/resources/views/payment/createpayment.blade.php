@extends('layouts.sidebar')
@extends('auth.layouts')
@section('content')
<div style="text-overflow: ellipsis;">

    <label for="invoice_id">Please Verify Order Details By Selecting Invoice Number</label>
    <div class="col-4">
        <div class="input-group mb-3">
            <select class="custom-select form-select" id="select_res">
                <option value="">Select Invoice Number</option>
            </select>
        </div>
    </div>
    <div>
        <button id="filter" class="btn btn-sm btn-outline-success">Check Invoice Details</button>
    </div><br>
    <table id="record_table" class="table table-striped" style="text-align: center;" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Supply Name</th>
                <th>Invoice Amount</th>
                <th>Invoice Receiver</th>
                <th>Invoice Date</th>
            </tr>
        </thead>
    </table>
</div>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header" style="text-align: center; font-weight:bold; width: 100%;">DLCA REGISTER PAYMENT
            </div>
            <div class="card-body">
                <form action="{{route('store_payment')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="invoice_id">Please Select Invoice Number</label>
                        <div class="col-md-6">
                            <select name="invoice_id" id="invoice_id" class="form-control custom-select form-select">
                                <option value="" selected disabled>Select Invoice No</option>
                                @foreach ($invoices as $invoice)
                                <option value="{{ $invoice->id }}">{{ $invoice->invoicescm }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('invoice_id'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="paymentnumber">Payment Number</label>
                        <input type="text" class="form-control" id="paymentnumber" placeholder="Enter Payment Number"
                            name="paymentnumber">
                        <span class="text-danger">@error('paymentnumber'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="authorizedby">Authorize By</label>
                        <input type="text" class="form-control" id="authorizedby"
                            placeholder="Enter Your Name and Surname" name="authorizedby">
                        <span class="text-danger">@error('authorizedby'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="paydate">Payment Date</label>
                        <input type="date" class="form-control" id="paydate" name="paydate">
                        <span class="text-danger">@error('paydate'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="paidwithin30days">Amount Paid Within 30 Day</label>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="paidwithin30days"
                                name="paidwithin30days" value="Yes">
                            <label class="form-check-label" for="checkbox">Yes</label>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="paidwithin30days"
                                name="paidwithin30days" value="No">
                            <label class="form-check-label" for="checkbox">No</label>
                        </div>
                        <span class="text-danger">@error('paidwithin30days'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="paymentComments">Comment</label>
                        <textarea type="text" class="form-control " id="paymentComments"
                            name="paymentComments"></textarea>

                    </div>


                    <input type="submit" class="col-md-3 offset-md-5 btn btn-success" value="Save" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Include Bootstrap JS  -->
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
function fetch_res() {
    $.ajax({
        url: "{{ route('getinvoice') }}",
        type: "GET",
        dataType: "json",
        success: function(data) {
            var resBody = "";
            for (var key in data) {
                resBody +=
                    `<option value="${data[key]['invoicescm']}">${data[key]['invoicescm']}</option>`;
            }
            $("#select_res").append(resBody);
        }
    });
}
fetch_res();

// Fetch Records
function fetch(res) {
    $.ajax({
        url: "{{ route('students/records') }}",
        type: "GEt",
        data: {
            res: res
        },
        dataType: "json",
        success: function(data) {
            $('#record_table').DataTable({
                searching: false,
                ordering: false,
                paging: false,
                info: false,
                "data": data.invoices,
                "responsive": true,
                "columns": [{
                        "data": "supplyname"
                    },
                    {
                        "data": "invoiceamount"
                    },
                    {
                        "data": "invoicereceiver"
                    },
                    {
                        "data": "invoicedate"
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
    var res = $("#select_res").val();
    if (res !== "") {
        $('#record_table').DataTable().destroy();
        fetch(res);
    } else if (res == "") {
        $('#record_table').DataTable().destroy();
        fetch('');
    } else {
        $('#record_table').DataTable().destroy();
        fetch();
    }
});
</script>

@endsection