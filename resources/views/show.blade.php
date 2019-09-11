<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="{{URL::to('src/css/app.css')}}">--}}
    @yield('styles')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
</head>
<body>


<div class="container">
    <div class="filters">
        <h2>Users </h2>
        <form>
            <div class="form-group">

                <div class="form-group">

                    <label>Search users</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search by name or email">
                </div>




                <button type="submit" id="search_users" class="btn btn-primary">Search</button>
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
</body>

<script src="js/get_users.js"></script>
</html>
