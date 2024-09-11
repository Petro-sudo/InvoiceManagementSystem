@extends('layouts.sidebar')
@extends('auth.layouts')
@section('title')
Edit User Order
@endsection
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

<div class="row justify-content-center mt-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header" style="text-align: center">
                Edit Order
            </div>
            <div class="card-body">
                <form method="post" action="{{route('updateorders',['orders'=> $orders])}}">
                    @csrf
                    @method('put')
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name:</label>
                        <div class="col-md-6">
                            <label for="name" class="col-md-4 col-form-label">{{$orders->name}}</label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="surname" class="col-md-4 col-form-label text-md-end text-start">Surname:</label>
                        <div class="col-md-6">
                            <label for="surname" class="col-md-4 col-form-label">{{$orders->surname}}</label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="checkindate" class="col-md-4 col-form-label text-md-end text-start">Check-in
                            Date
                        </label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('checkindate') is-invalid @enderror"
                                id="checkindate" name="checkindate" value="{{ $orders->checkindate }}">
                            @if ($errors->has('checkindate'))
                            <span class="text-danger">{{$errors->first('checkindate')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="checkoutdate" class="col-md-4 col-form-label text-md-end text-start">Check-out
                            Date
                        </label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('checkoutdate') is-invalid @enderror"
                                id="checkoutdate" name="checkoutdate" value="{{ $orders->checkoutdate }}">
                            @if ($errors->has('checkoutdate'))
                            <span class="text-danger">{{ $errors->first('checkoutdate') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="order_number" class="col-md-4 col-form-label text-md-end text-start">Order
                            Number
                        </label>
                        <div class="col-md-6">
                            <label for="order_number"
                                class="col-md-4 col-form-label text-md-end text-start">{{ $orders->order_number }}
                            </label>
                        </div>
                    </div>
                    <div class="3 rmb-ow">
                        <label for="ordernumber">Reason For Travelling</label>
                        <div class="form-group form-check col-md-6 ">
                            <input type="checkbox" class="form-check-input" id="accomodation" name="reason"
                                value="Accomodation ">
                            <label class="form-check-label" for="checkbox">Accomodation</label>
                        </div>

                        <div class="form-group form-check col-md-6">
                            <input type="checkbox" class="form-check-input" id="carHire" name="reason" value="Car Hire">
                            <label class="form-check-label" for="checkbox">Car Hire</label>
                        </div>
                        <div class="form-group form-check col-md-6">
                            <input type="checkbox" class="form-check-input" id="flight" name="reason" value="Flight">
                            <label class="form-check-label" for="checkbox">Flight</label>
                        </div>

                        <div class="form-group form-check col-md-6">
                            <input type="checkbox" class="form-check-input" id="conference" name="reason"
                                value="Conference">
                            <label class="form-check-label" for="checkbox">Conference</label>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary"
                            style="background-color: #85603d;" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>