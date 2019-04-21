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
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>


</div>


<script type="text/javascript">

    $(document).ready(function () {
        $.ajax({
            type:'GET',
            url:"{{ url('api/users') }}",
            success:function(data) {
                var trHTML = '';

                $.each(data, function (i, item) {
                    var counter = 1;
                        $.each(item, function (j, user_data) {
                            dataNum = item.length;
                            if (counter <= dataNum) {
                                trHTML += '<tr><td>' + user_data.id + '</td><td>' + user_data.name + '</td><td>' + user_data.email + '</td><td>' +
                                    user_data.role + '</td><td>' + user_data.permission + '</td></tr>';
                            }
                            counter++;
                        });

                });

                $('.container #records_table tbody').append(trHTML);

            }
        });


        $('body').on('click', '.pagination a', function(e) {

            e.preventDefault();

            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

            $.ajax({
                type:'GET',
                url:"{{ url('api/users') }}",
                success:function(data) {
                    url = getArticles(data.links.next);
                    window.history.pushState("", "", url);

                }
            });
            // url = getArticles();
            // window.history.pushState("", "", url);

        });

        function getArticles(url) {
            $.ajax({
                type : 'GET',
                url:"http://localhost:8000/api/users?page=2",
            }).done(function (data) {
                var trHTML = '';

                $.each(data, function (i, item) {
                    var counter = 1;
                    $.each(item, function (j, user_data) {
                        dataNum = item.length;
                        if (counter <= dataNum) {
                            trHTML += '<tr><td>' + user_data.id + '</td><td>' + user_data.name + '</td><td>' + user_data.email + '</td><td>' +
                                user_data.role + '</td><td>' + user_data.permission + '</td></tr>';
                        }
                        counter++;
                    });

                    $('.container #records_table tbody').append(trHTML);
                });


            }).fail(function () {
                alert('Users could;t be loaded');
            });
        }
    });




</script>

</body>
</html>
