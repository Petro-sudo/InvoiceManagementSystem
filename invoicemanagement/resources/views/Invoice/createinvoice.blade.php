@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" style="text-align: center; font-weight:bold;">DLCA REGISTER AN INVOICE
            </div>
            <div class="card-body">
                <form action="{{route('store_invoice')}}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="invoice_number">Invoice Number</label>
                            <input type="text" id="invoice_number" class="form-control" placeholder="Invoice Number" name="invoice_number">
                            <span class="text-danger">@error('invoice_number'){{$message}}@enderror</span>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <br>
                            <button type="button" id="generate-btn" class="btn btn-primary">Generate
                                Number</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_id">Please Select Order Number</label>
                        <br>
                        <div class="col-md-6">
                            <select name="order_id" id="order_id" class="form-control">
                                <option value="" selected disabled>Select Order Number</option>
                                @foreach ($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->orderscm }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('order_id'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="invoicedate">Invoice Received Date From Supplier</label>
                        <input type="date" class="form-control" id="invoicedate" name="invoicedate">
                        <span class="text-danger">@error('invoicedate'){{$message}}@enderror</span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="invoicescm">Invoice Number Captured By (SCM)</label>
                        <input type="text" class="form-control" id="invoicescm" placeholder="Enter Invoice Number" name="invoicescm">
                        <span class="text-danger">@error('invoicescm'){{$message}}@enderror</span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="invoiceamount">Invoice Amount</label>
                        <input type="text" class="form-control" id="invoiceamount" placeholder="Enter Order Amount (R0.00)" name="invoiceamount">
                        <span class="text-danger">@error('invoiceamount'){{$message}}@enderror</span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="invoicereceiver">Invoice Recieved by</label>
                        <input type="text" class="form-control" id="invoicereceiver" placeholder="Enter Name and Surname of Invoice Receiver" name="invoicereceiver">
                        <span class="text-danger">@error('invoicereceiver'){{$message}}@enderror</span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="disputedinvoice">Dispute Invoice </label>

                        <input type="checkbox" class="form-check-input" id="disputedinvoice" name="disputedinvoice" value="Disputed">

                    </div>
                    <br>
                    <div class="form-group">
                        <label for="invoiceComments">Comment</label>
                        <textarea type="text" class="form-control " id="invoiceComments" name="invoiceComments"></textarea>
                    </div>
                    <br>

                    <input type="submit" class="col-md-3 offset-md-5 btn btn-success" value="Save" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<script>
    // Event listener for the generate button
    document.getElementById('generate-btn').addEventListener('click', function() {
        var today = new Date();
        var date = today.getFullYear().toString() +
            (today.getMonth() + 1).toString().padStart(2, '0') +
            today.getDate().toString().padStart(2, '0');

        // Generate a random five-digit order number
        var randomNumber = Math.floor(Math.random() * (999 - 100 + 1)) + 100;

        var invoiceNumber = 'IN' + '-' + date + randomNumber;

        document.getElementById('invoice_number').value = invoiceNumber;
    });
</script>

@endsection