/**
 * Created by UltraKapes on 9/19/2015.
 */
$(document).ready(function () {

    //$("#login")[0].reset();
    //$('#username').val('');
    //$('#passwrd').val('');


    $('#setEvent').validate({ // initialize the plugin
        rules: {
            eventName: {
                required: true
            },
            date: {
                required: true
            }

        }
    });


    $('#hidden').bind("DOMSubtreeModified", function () {
        var date = $('#hidden').html();
        var dateArray = date.split("-")
        var dateString = dateArray[1] + "/" + dateArray[0] + "/" + dateArray[2];
        $('#date').val(dateString);

    });

    $("#propertyHolder").hide();
    $(".show-properties").click(function () {
        $("#propertyHolder").toggle();
    });


    $('.navList li a').on('click', function () {

        var propertyAdd = $(this).text();

        jQuery.ajax({
            url: '../chatsys/setselectedchatpropery.php',
            type: "POST",
            data: {
                selected: propertyAdd
            },
            success: function (result) {

                $("#propertyHolder").hide();
                window.location.reload();
            }
        });
    });
});

$('#box').keyup(function () {
    var valThis = this.value.toLowerCase(),
        lenght = this.value.length;

    $('.navList>li>a').each(function () {
        var text = $(this).text(),
            textL = text.toLowerCase(),
            htmlR = '<b>' + text.substr(0, lenght) + '</b>' + text.substr(lenght);
        (textL.indexOf(valThis) == 0) ? $(this).html(htmlR).show() : $(this).hide();
    });
});


//function openEveemtModal() {
//    $('#setEvent').modal('show');
//}
//
//function clearForm() {
//    $('#usrname').val('');
//    $('#psswrd').val('');
//    $('#fname').val('');
//    $('#lname').val('');
//    $('#email').val('');
//}
//
//function newPage() {
//
//    window.location = 'index.php';
//}
