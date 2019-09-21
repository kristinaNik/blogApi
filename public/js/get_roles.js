$(document).ready(function () {
    $.ajax({
        type:'GET',
        url:'api/roles',
        success:function(data) {
            var optionHTML = '';

            $.each(data, function (i, item) {
                var counter = 1;
                $.each(item, function (j, role_data) {
                    dataNum = item.length;
                    if (counter <= dataNum) {
                        optionHTML += '<option value="' + role_data.id + '">' + role_data.name + '</option>';
                    }
                    counter++;
                });

            });

            $(' #user_roles').append(optionHTML);

        }
    });
});