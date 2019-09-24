$(document).ready(function () {
    fetch_customer_data();
    function fetch_customer_data(query='') {
        $.ajax({
            url: "search",
            method: 'GET',
            data:{query:query},
            dataType: 'json',
            success: function (data) {

                var trHTML = '';
                var size = '';

                $.each(data, function (i, item) {
                    size = Object.keys(item).length;
                    $.each(item, function (j, user_data) {

                        trHTML += '<tr><td>' + user_data.id + '</td><td>' + user_data.name + '</td><td>' + user_data.email + '</td><td>' +
                            user_data.role + '</td><td>' + user_data.permission +
                            '</td><td><a href="edit/' + user_data.id +'"><input type="button" id="edit_users" class="btn btn-primary" value="Edit user"></a></td>' +
                            '</td><td><input type="button" class="btn btn-danger" id="delete_user"  value="Delete User"></td>' +
                            '</td></tr>';

                    });

                    $('tbody').html(trHTML);
                    $('#size').html(size);


                });
            }
        })
    }
    window.addEventListener('load', function () {
        $('#search_users').on('click', function (e) {
            e.preventDefault();
            var query = $('#search').val();
            fetch_customer_data(query);

        });
    });
});




