<html lang="en">

<head>
    <title>IMRS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<br><br>

<body>
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <a href="{{route('viewusers')}}">BACK</a>
            <br>
            <div class="card">

                <div class="card-header" style="text-align: center">
                    Edit Your Profile
                </div>
                <form method="post" action="{{route('updateuser', ['users'=>$users])}}">
                    @csrf
                    @method('put')
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email
                            Address</label>
                        <div class="col-md-8">
                            <label for="email" class="col-md-8 col-form-label text-md-start text-start">
                                {{ $users->email}}</label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-8">
                            <label for="email" class="col-md-4 col-form-label text-md-start text-start">
                                {{ $users->name}}</label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="surname" class="col-md-4 col-form-label text-md-end text-start">Surname</label>
                        <div class="col-md-8">
                            <label for="email" class="col-md-4 col-form-label text-md-start text-start">
                                {{ $users->surname}}</label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="persal" class="col-md-4 col-form-label text-md-end text-start">Persal
                            Number</label>
                        <div class="col-md-8">
                            <label for="email" class="col-md-4 col-form-label text-md-start text-start">
                                {{ $users->persal}}</label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="role" class="col-md-4 col-form-label text-md-end text-start">Select Role</label>
                        <div class="col-md-6">
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                <option>Select User Role</option>
                                <option value="{{$users->role}}">Order Register</option>
                                <option value="{{$users->role}}">Invoice Capture</option>
                                <option value="{{$users->role}}">Payment Authorizer</option>
                                @if ($errors->has('role'))
                                <span class="text-danger">{{ $errors->first('role')}}</span>
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" value="{{$users->password}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password_confirmation"
                            class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" value="{{$users->password}}">
                        </div>
                    </div> -->
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>