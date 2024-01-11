<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Management System</title>
    <style>
    body {
        background-color: #F6F6F6;
        margin: 0;
        padding: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
        padding: 0;
    }

    p {
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin-right: auto;
        margin-left: auto;
    }

    .brand-section {
        background-color: white;
        padding: 10px 40px;
    }

    .logo {
        width: 50%;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .col-6 {
        width: 50%;
        flex: 0 0 auto;
    }

    .text-white {
        color: #fff;
    }

    .company-details {

        text-align: left;

    }

    .body-section {
        padding: 16px;
        border: 1px solid gray;
    }

    .heading {
        font-size: 20px;
        margin-bottom: 08px;
    }

    .sub-heading {
        color: #262626;
        margin-bottom: 05px;
    }

    table {
        background-color: #fff;
        width: 100%;
        border-collapse: collapse;
    }

    table thead tr {
        border: 1px solid #111;
        background-color: #f2f2f2;
    }

    table td {
        vertical-align: middle !important;
        text-align: center;
    }

    table th,
    table td {
        padding-top: 08px;
        padding-bottom: 08px;
    }

    .table-bordered {
        box-shadow: 0px 0px 5px 0.5px gray;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
    }

    .text-right {
        text-align: end;
    }

    .w-20 {
        width: 20%;
    }

    .float-right {
        float: right;
    }
    </style>
</head>

<body>
    <div class="container">
        @foreach ($data as $data)
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-black">{{ $data->supplyname }}</h1>
                    <div class="company-details">
                        <p class="text-black">Company Reg: {{ $data->companyreg }}</p>
                        <p class="text-black">CSD Number: {{ $data->supplycsd }}</p>
                        <p class="text-black">Cell No: {{ $data->cellnumber }}</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <p class="sub-heading" style="font-weight: bold;">Invoice No.: {{ $data->invoicescm }}</p>
                    <p class="sub-heading">Order Number.: {{ $data->orderscm }} </p>
                    <p class="sub-heading">Order Date: {{ $data->orderdate }} </p>
                    <p class="sub-heading">Email Address: {{ $data->email }} </p>
                </div>
                <div class="col-6">
                    <p class="sub-heading">Full Name: {{ $data->namesurname }} </p>
                    <p class="sub-heading">Phone Number: {{ $data->cellnumber }} </p>
                    <p class="sub-heading">Address: {{ $data->streetname }} </p>
                    <p class="sub-heading">City,State,Pincode: {{ $data->town }} {{ $data->zipcode }}</p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Ordered Item</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="w-20">Price</th>
                        <th class="w-20">Quantity</th>
                        <th class="w-20">Grandtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $data->description }}</td>
                        <td>R {{ $data->orderamount }}</td>
                        <td>{{ $data->qty }}</td>
                        <td>R {{ $data->qty*$data->orderamount}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Sub Total</td>
                        <td>R {{$data->qty*$data->orderamount}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Tax Total </td>
                        <td>R {{$data->tax}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Grand Total</td>
                        <td>R {{( $data->qty*$data->orderamount)+$data->tax}}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br> <br>
            </p>
            <div class="row">
                @foreach ($data1 as $paid)
                <table class="table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="w-20">Paid Within 30 Days</th>
                            <th class="w-20">Payment Status</th>
                            <th class="w-20">Amount Paid</th>
                            <th class="w-20" style="width:80%">Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$paid->paidwithin30days}}</td>
                            <td>{{ $paid->fullpaid}}</td>
                            <td>R {{ $paid->paidamount}}</td>
                            <td>{{ $paid->paymentComments}}</td>
                        </tr>
                    </tbody>
                    <br>
                </table>
                <br>
                @endforeach
            </div>
        </div>
        @endforeach
        <div class="body-section">
            <p>&copy; Copyright <?php echo date("Y"); ?> - Department of Transport. All rights reserved.
                <a href="https://www.transport.gov.za/" class="float-right">www.transport.gov.za</a>
            </p>
        </div>
    </div>
</body>

</html>