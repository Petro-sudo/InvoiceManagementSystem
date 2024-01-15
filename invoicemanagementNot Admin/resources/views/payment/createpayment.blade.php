@extends('layouts.sidebar')
@extends('auth.layouts')
@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" style="text-align: center; font-weight:bold; width: 100%;">DLCA REGISTER PAYMENT
            </div>
            <div class="card-body">
                <form action="{{route('store_payment')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="invoice_id">Please Select Invoice Number</label>

                        <div class="col-md-6">
                            <select name="invoice_id" id="invoice_id" class="form-control">
                                <option value="" selected disabled>Select Order Number</option>
                                @foreach ($invoices as $invoices)
                                <option value="{{ $invoices->id }}">{{ $invoices->invoicescm }}</option>
                                @endforeach

                            </select>
                            <span class="text-danger">@error('invoice_id'){{$message}}@enderror</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="paymentreceiver">Payment Recieved by</label>
                        <input type="text" class="form-control" id="paymentreceiver"
                            placeholder="Enter Name and Surname of Payment Receiver" name="paymentreceiver">
                        <span class="text-danger">@error('paymentreceiver'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="invoicedate">Invoice Received Date -Finance</label>
                        <input type="date" class="form-control" id="invoicedate" name="invoicedate">
                        <span class="text-danger">@error('invoicedate'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="paydate">Payment Date</label>
                        <input type="date" class="form-control" id="paydate" name="paydate">
                        <span class="text-danger">@error('paydate'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="paidamount">Amount Paid</label>
                        <input type="text" class="form-control" id="paidamount"
                            placeholder="Enter Order Amount Paid (0.00)" name="paidamount">
                        <span class="text-danger">@error('paidamount'){{$message}}@enderror</span>
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
                        <label for="fullpaid">Full Amount Paid</label>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="fullpaid" name="fullpaid" value="Paid">
                            <label class="form-check-label" for="checkbox">Yes</label>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="fullpaid" name="fullpaid"
                                value="Partial Paid">
                            <label class="form-check-label" for="checkbox">No</label>
                        </div>
                        <span class="text-danger">@error('fullpaid'){{$message}}@enderror</span>
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
<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
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