@extends('auth.layouts')

@section('content')

@include('sweetalert::alert')
<div class="card-header" style="text-align: center;font-weight: bold;">Customers Orders</div>

<table class="table table-striped" style="text-align: center;" id="example" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Order Number</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Branch</th>
            <th>Check In Date</th>
            <th>Check Out Date</th>
            <th>Travel Reason</th>
            <th>EDIT</th>


        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
        <tr>
            <th>Order Number</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Branch</th>
            <th>Check In Date</th>
            <th>Check Out Date</th>
            <th>Travel Reason</th>
            <th>EDIT</th>
        </tr>
    </tfoot>
</table>
</div>



@endsection