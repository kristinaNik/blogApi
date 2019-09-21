@extends('layouts/master')

@section('title')
    User Management
@endsection
@section('content')


    <div class="container">
        <form>
            <div class="form-group">

                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Type name">
            </div>
            <div class="form-group">

                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Type email">
            </div>
            <div class="form-group">

                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Type password">
            </div>
                <div class="form-group">

                    <label>User role</label>
                    <select class="form-control" id="user_roles">

                            <option value="">Choose</option>

                    </select>
                </div>
            <div class="form-group">

                <label>User permission</label>
                <select class="form-control js-example-basic-multiple" id="user_permissions" multiple="multiple">



                </select>
            </div>


                <button type="submit" id="add_users" class="btn btn-primary">Save User</button>
                <a href="{{route('users.home')}}"><input type="button"  class="btn btn-default" value="Go Home"></a>
        </form>

    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script src="js/get_roles.js"></script>
    <script src="js/get_permissions.js"></script>
    <script src="js/store_users.js"></script>
@endsection