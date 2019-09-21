$(document).ready(function () {
    $.ajax({
        type:'GET',
        url:'api/permissions',
        success:function(data) {
            var optionHTML = '';

            $.each(data, function (i, item) {
                var counter = 1;
                $.each(item, function (j, permission_data) {
                    dataNum = item.length;
                    if (counter <= dataNum) {
                        optionHTML += '<option value="' + permission_data.id + '">' + permission_data.name + '</option>';
                    }
                    counter++;
                });

            });

            $(' #user_permissions').append(optionHTML);

        }
    });
});