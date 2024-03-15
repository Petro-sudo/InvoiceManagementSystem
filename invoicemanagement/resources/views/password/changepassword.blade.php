@extends('layouts.sidebar2')
@extends('auth.layouts')
@section('title')
Change Password
@endsection

@section('content')

<!-- Main content -->
<section class="content">
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

    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('js/profile.js')}}"></script>

    @include('sweetalert::alert')
    <div style="text-overflow: ellipsis;">
        <div class="row justify-content-center mt-7">

            <div class="col-md-8">
                <a href="{{route('dashboard')}}">BACK</a>
                <br>
                <div class="card">
                    <p class="card-header" style="text-align: center; font-weight: bold;">{{Auth::user()->name}}'s
                        Change Password</p>
                    <div class="card-body">
                        <form action="{{route('updatepassword')}}" id="change_password_form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input type="password" name="old_password" class="form-control" id="old_password">

                                @if($errors->any('old_password'))
                                <span class="text-danger">{{$errors->first('old_password')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="new_password">
                                @if($errors->any('new_password'))
                                <span class="text-danger">{{$errors->first('new_password')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control"
                                    id="confirm_password">
                                @if($errors->any('confirm_password'))
                                <span class="text-danger">{{$errors->first('confirm_password')}}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

    @endsection