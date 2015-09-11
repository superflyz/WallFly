$(document).ready(function () {

    $('#usrname').val('');
    $('#psswrd').val('');


    $('#timeout_form').validate({ // initialize the plugin
        rules: {
            username: {
                required: true,
                minlength: 5,
                alphanumeric: true,
                nowhitespace: true

            },
            password: {
                required: true,
                minlength: 6,
                alphanumeric: true,
                nowhitespace: true
            }
        }
    });
    $('#reset').click();
    openTimeoutModal();


});


function openTimeoutModal() {
    $('#timeout').modal('show');
}

function clearForm() {
    $('#usrname').val('');
    $('#psswrd').val('');
}

function logout() {

    window.location.replace("logout.php");

}