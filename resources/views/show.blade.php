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
               $('.container').html(data.html);
                var trHTML = '';
                $.each(data, function (i, item) {
                    // console.log(data.links.prev);
                    $.each(item, function (j, user_data) {
                        if (user_data != 'undefined') {
                            console.log(user_data.id);
                        }

                        trHTML += '<tr><td>' + user_data.id + '</td><td>' + user_data.name + '</td><td>' + user_data.email + '</td></tr>';
                    });

                });
                $('.container #records_table tbody').append(trHTML);

            }
        });
    });

</script>

</body>
</html>