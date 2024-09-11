@extends('layouts.layoutadmin')
@section('title')
Permission
@endsection
@section('content')
@include('sweetalert::alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permission Table</h3>
                <div class="card-tools">
                    <a href="{{route('permissioncreate')}}" class="btn btn-primary">Create New Permission</a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                            <th>Date Posted</th>

                        </tr>
                    </thead>
                    @forelse ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>John</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->created_at }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-warning">Edit Permission</a>
                        </td>
                    </tr>
                    @empty
                    <tr>No Result Found</tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
@endsection