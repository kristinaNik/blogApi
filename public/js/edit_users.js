$(document).ready(function() {
    $('.js-example-basic-multiple').select2();

    $('#edit_users').on('click', function (e) {
        e.preventDefault();
        var url = window.location.pathname;
        var id = url.substring(url.lastIndexOf('/') + 1);
        var name = $("input[name=name]").val();
        var email = $("input[name=email]").val();
        var password = $("input[name=password]").val();

        var addPermissions = [];

        $("#user_roles option:selected").each(function(index2,elementRole) {
            var role = elementRole.value;
            $("#user_permissions option:selected").each(function (index, elementPermission) {

                var permission = elementPermission.value;
                addPermissions.push(permission);
                $.ajax({
                    type: 'PUT',
                    url: 'api/users/' + id,
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        role: role,
                        permissions: addPermissions
                    },
                    success: function (data) {
                        $('#success_message').append("Successfully updated a user");
                        //$( location ).attr("href", "/");
                    },
                    error: function (data, err) {
                        alert("error in updating the user.");
                    },
                });
            });
        });
    });


});
