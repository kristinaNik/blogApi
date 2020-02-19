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
                            '</td><td><a href="/' + user_data.id +'"><button class="edit-modal btn btn-info"><span class=\'glyphicon glyphicon-edit\'></span> Edit </button></a></td>' +
                            '</td><td><a href="/delete/' + user_data.id +'"><button class="edit-modal btn btn-danger"><span class=\'glyphicon glyphicon-edit\'></span> Delete user </button></a></td>' +
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


function edit() {

   var editButton = document.querySelector('.edit-modal');
   var id =editButton.getAttribute('data-id');
   console.log(id);
    $.ajax({
        type:'GET',
        url:'api/users/' + id,
        success:function(data) {
         //  location.href = "/edit/" + id;
           // window.location= "/edit/" + id;
            console.log(data);
            $.each(data, function (i, item) {

                $.each(item, function (j, user_data) {

                });

            });



        }
    });
}

