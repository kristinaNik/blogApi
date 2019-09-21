window.addEventListener('load', function () {

$("#add_users").on('click', function(e) {
    e.preventDefault();

    var name = $("input[name=name]").val();
    var email = $("input[name=email]").val();
    var password = $("input[name=password]").val();

    var addPermissions = [];
    $("#user_roles option:selected").each(function(index,elementRole) {
        $("#user_permissions option:selected").each(function(index,elementPermission) {

        var role = elementRole.value;
        var permission = elementPermission.value;
        addPermissions.push(permission);

        $.ajax({
            type: 'POST',
            url: "api/users",
            data: {
                name: name,
                email: email,
                password: password,
                role: role,
                permissions: addPermissions
            },
            success: function (data) {

              alert('Successfuly created user')
            }
        });
        });
    });
    })
  //  var token = document.getElementsByName('_token')[0].value;


});