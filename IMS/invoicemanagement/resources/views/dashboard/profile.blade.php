@extends('layouts.sidebar2')
@extends('auth.layouts')
@section('title')
Profile
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    @include('sweetalert::alert')
    <div style="text-overflow: ellipsis;">
        <div class="row justify-content-center mt-7">
            <div class="col-md-6">
                <div class="card">
                    <p class="card-header" style="text-align: center; font-weight: bold;">{{Auth::user()->name}}'s
                        Profile</p>


                    @foreach ($user as $users)
                    <div class="card-body">
                        <div>
                            <a href="{{route('edituser',['users'=> $users])}}" class="btn btn-success"
                                style="float:right;background-color: #d6c66f;">Edit
                                Profile</a>
                        </div>


                        <br>
                        <br>
                        <p style="font-size: large;">Name: {{ $users->name }}
                        </p>
                        <p style="font-size: large;">Surname: {{ $users->surname }}
                        </p>
                        <p style="font-size: large;">Email: {{ $users->email }}</p>
                        <p style="font-size: large;">Persal: {{ $users->persal }}</p>
                        <div>
                            <a href="{{route('changepassword')}}" class="btn btn-warning float-end">Change Password ?
                            </a>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
    @endsection