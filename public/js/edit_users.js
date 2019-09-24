window.addEventListener('load', function () {
    var url = window.location.pathname;
    var id = url.substring(url.lastIndexOf('/') + 1);
    console.log(id);
    $.ajax({
        type:'GET',
        url:'api/users/' + id,
        success:function(data) {

            $.each(data, function (i, item) {

                $.each(item, function (j, user_data) {
                   console.log(user_data);
                });

            });



        }
    });


});