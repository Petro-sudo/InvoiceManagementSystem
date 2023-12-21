@extends('layouts.sidebar')
@extends('auth.layouts')
@section('content')




<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" style="text-align: center; font-weight:bold;">DLCA REGISTER AN ORDER
            </div>
            <div class="card-body">
                <form action="{{route('store_order')}}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="order_number">Order Number</label>
                            <input type="text" id="number-input" class="form-control" placeholder="Order Number" name="order_number">
                            <span class="text-danger">@error('order_number'){{$message}}@enderror</span>

                        </div>

                        <div class="col-sm-6 mb-3">
                            <br>
                            <button type="button" id="generate-btn" class="btn btn-primary">Generate
                                Number</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="orderscm">Order Number Captured By (SCM)</label>
                        <input type="text" class="form-control" id="orderscm" placeholder="Enter Order Capture" name="orderscm">
                        <span class="text-danger">@error('orderscm'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="orderdate">Order Date</label>
                        <input type="date" class="form-control" id="orderdate" name="orderdate">
                        <span class="text-danger">@error('orderdate'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="supplyname">Supply Details</label>
                        <input type="text" class="form-control" id="supplyname" placeholder="Enter Supply Name" name="supplyname">
                        <input type="text" class="form-control" id="companyreg" placeholder="Enter Company Reg" name="companyreg">
                        <input type="text" class="form-control" id="supplycsd" placeholder="Enter CSD Supplier Number" name="supplycsd">
                        <span class="text-danger">@error('supplyname'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="streetname">Enter Address</label>
                        <input type="text" class="form-control" id="streetname" placeholder="Enter Street Number and Name" name="streetname">
                        <input type="text" class="form-control" id="town" placeholder="Enter Town" name="town">
                        <input type="text" class="form-control" id="zipcode" placeholder="Enter Zipcode/Postcode" name="zipcode">
                        <span class="text-danger">@error('streetname'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="namesurname">End User Details</label>
                        <input type="text" class="form-control" id="namesurname" placeholder="Name and Surname" name="namesurname">
                        <input type="text" class="form-control" id="email" placeholder="Enter Email Address" name="email">
                        <input type="text" class="form-control" id="cellnumber" placeholder="Enter Cell Number" name="cellnumber">
                        <span class="text-danger">@error('enduser'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="orderDetails">Details of Order</label>
                        <div class="row">
                            <div class="form-group col-xl-10 col-md-10 col-sm-10 child-repeater-table">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <!-- <th><a href="javascript:void(0)" class="btn btn-success addRow">+</a></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" id="description" name="description" class="form-control"></td>
                                            <td><input type="number" id="qty" name="qty" class="form-control"></td>
                                            <!-- <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th> -->
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="orderamount">Order Amount</label>
                        <input type="text" class="form-control" id="orderamount" placeholder="Enter Order Amount (R0.00)" name="orderamount">
                        <span class="text-danger">@error('orderamount'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="orderComments">Comment</label>
                        <textarea type="text" class="form-control " id="orderComments" name="orderComments"></textarea>
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

        var orderNumber = 'OR' + '-' + date + randomNumber;

        document.getElementById('number-input').value = orderNumber;
    });

    $('thead').on('click', '.addRow', function() {
        var tr = "<tr>" +
            "<td><input type = 'text' name = 'description[]' class = 'form-control'></td>" +
            "<td><input type = 'number' name = 'qty[]' class = 'form-control'></td>" +
            "<th><a href = 'javascript:void(0)'class = 'btn btn-danger deleteRow'>-</a></th>" +
            "</tr>"
        $('tbody').append(tr);
    });

    $('tbody').on('click', '.deleteRow', function() {
        $(this).parent().parent().remove();
    });
</script>

@endsection