<html>
<head>
    <link href="{{ asset('css/app.css') }}" media="all" rel="stylesheet" type="text/css" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
</head>
<body>
<div class="container">

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
    </table>
</div>


<script type="text/javascript">

    $(document).ready(function () {
        $.ajax({
            type:'GET',
            url:"{{ url('api/users') }}",
            success:function(data) {
                var trHTML = '';
                $.each(data, function (i, item) {
                    $.each(item, function (j, user_data) {
                        if (user_data.role === 0) {

                           trHTML += user_data.role[0] = '';
                        }
                        trHTML += '<tr><td>' + user_data.id + '</td><td>' + user_data.name + '</td><td>' + user_data.email + '</td><td>' +
                            user_data.role + '</td><td>' + user_data.permission +'</td></tr>'

                    });

                });

                $('.container #records_table tbody').append(trHTML);

            }
        });
    });

</script>

</body>
</html>
