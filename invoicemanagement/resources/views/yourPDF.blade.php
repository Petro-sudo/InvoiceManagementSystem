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
        color: #111;
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
                <div class="col-6" style="color: #111;">
                    <h1 class="text-white">{{ $data->supplyname }}</h1>
                    <br>
                    <div class="company-details">
                        <p class="text-white">Company Reg: {{ $data->companyreg }}</p>
                        <p class="text-white">CSD Number: {{ $data->supplycsd }}</p>
                        <p class="text-white">Cell No: {{ $data->cellnumber }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Invoice No.: {{ $data->invoicescm }}</h2>
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
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="w-20">Amount</th>
                        <th class="w-20">Quantity</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $data->description }}</td>
                        <td>R {{ $data->orderamount }}</td>
                        <td>{{ $data->qty }}</td>
                        <td>{{ $data->orderdate}}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3 class="heading">Invoice Captured</h3>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Order Date</th>
                        <th>Amount</th>
                        <th>Product</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $data->orderdate}}</td>
                        <td>R {{ $data->orderamount }}</td>
                        <td>{{ $data->description }}</td>
                        <td>{{ $data->qty }}</td>

                    </tr>
                </tbody>
            </table>
            <br>
            <br>
            <h3 class="heading">Payment Authorisation</h3>
            @foreach ($data1 as $data2)
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Payment No.: {{ $data2->paymentnumber }}
                    </h2>
                    <p class="heading">Payment Date: {{ $data2->paydate }} </p>
                    <p class="heading">Paid Within 30 days: {{ $data2->paidwithin30days }}</p>
                    <p class="heading">Authorized by: {{ $data2->authorizedby }}</p>

                </div>
            </div>
            @endforeach
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