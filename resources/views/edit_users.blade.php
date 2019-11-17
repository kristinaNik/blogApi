@extends('layouts/master')

@section('title')
    User Management
@endsection
@section('content')


    <div class="container">
        <form>
            <div class="form-group">

                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Type name" value="{{$user->name}}">
            </div>
            <div class="form-group">

                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Type email" value="{{$user->email}}">
            </div>
            <div class="form-group">

                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Type password">
            </div>
            <div class="form-group">

                <label>User role</label>
                <select class="form-control" id="user_roles">

                    <option value="{{$roleNameId}}" selected="selected">{{$roleName}}</option>

                    @foreach ($allRoles as  $key => $role)

                        <option value="{{$key}}"> {{ $role }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">

                <label>User permission</label>
                <select class="form-control js-example-basic-multiple" id="user_permissions" multiple="multiple">
                    @foreach ($permissionNames as $permissionKey => $permissionName)

                        <option value ="{{$permissionKey}}"> {{ $permissionName }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" id="edit_users" class="btn btn-primary">Update User</button>
            <a href="{{route('users.home')}}"><input type="button"  class="btn btn-default" value="Go Home"></a>
        </form>
        <br/>
        <p class="text-success" id="success_message"></p>
    </div>

    <script src="js/edit_users.js"></script>

@endsection
