// $(document).ready(function () {
//     $.ajax({
//         type:'GET',
//         url:'api/users',
//         success:function(data) {
//             var trHTML = '';
//
//             $.each(data, function (i, item) {
//                 var counter = 1;
//                 $.each(item, function (j, user_data) {
//                     dataNum = item.length;
//                     if (counter <= dataNum) {
//                         trHTML += '<tr><td>' + user_data.id + '</td><td>' + user_data.name + '</td><td>' + user_data.email + '</td><td>' +
//                             user_data.role + '</td><td>' + user_data.permission + '</td></tr>';
//                     }
//                     counter++;
//                 });
//
//             });
//
//             $('.container #records_table tbody').append(trHTML);
//
//         }
//     });
// });

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
                            user_data.role + '</td><td>' + user_data.permission + '</td></tr>';

                    });

                    $('tbody').html(trHTML);

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
