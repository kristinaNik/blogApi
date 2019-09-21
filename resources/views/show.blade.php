@extends('layouts/master')

@section('title')
    User Management
@endsection
@section('content')
<div class="container">
    <div class="filters">
        <h2>Users </h2>
        <form>
            <div class="form-group">

                <div class="form-group">

                    <label>Search users</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search by name or email">
                </div>


                <button id="search_users" class="btn btn-primary">Search</button>
                <a href="{{route('users.add')}}"><input type="button" id="add_users" class="btn btn-success" value="Add users"></a>
            </div>
        </form>

    </div>
    <table class="table" id="records_table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Permission</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    </table>

</div>

<script src="js/get_users.js"></script>


@endsection