var previousChatRows = 0;
var numChatRows = 0;

function chatLoad(propertyID, username) {
    if (propertyID != "") {
        jQuery.ajax({
            url: 'loadChatBox.php',
            type: "POST",
            data: {
                pID: propertyID
            },
            success: function (response) {
                $('#chatlist').empty();
                var obj = eval("(" + response + ')');
                for (var i = 0; i < obj.length; i++) {
                    var parseobj = obj[i];
                    if (parseobj.username == username) {
                        $("#chatbox ul").append("<li class='left clearfix'>" +
                            "<span class='chat-img pull-left'><img src='../img/me.png' alt='User Avatar' class='img-circle' /></span>" +
                            "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + username + "</strong> <small class='pull-right text-muted'>" +
                            "<span class='glyphicon glyphicon-time'></span>" + parseobj.chatdate + "</small></div><p>" + nl2br(parseobj.msg) + "</p></div></li>");
                    } else {
                        $("#chatbox ul").append("<li class='left clearfix'>" +
                            "<span class='chat-img pull-left'><img src='../img/you.png' alt='User Avatar' class='img-circle' /></span>" +
                            "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + parseobj.username + "</strong> <small class='pull-right text-muted'>" +
                            "<span class='glyphicon glyphicon-time'></span>" + parseobj.chatdate + "</small></div><p>" + nl2br(parseobj.msg) + "</p></div></li>");
                    }

                }
            }

        });
        setInterval(chatRefresh, 2000);
        setTimeout(function () {
            $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
        }, 200);
    }

    function chatRefresh() {
        if (propertyID == "") {
            return;
        }
        numRowCheck(propertyID);
        if (numChatRows > previousChatRows) {

            //alert(previousChatRows);
            jQuery.ajax({
                url: 'loadChatBox.php',
                type: "POST",
                data: {
                    pID: propertyID
                },
                success: function (response) {

                    var currentHeight = $("#chatbox").scrollTop() + $("#chatbox").innerHeight()
                    var totalHeight = $("#chatbox")[0].scrollHeight;

                    $('#chatlist').empty();
                    var obj = eval("(" + response + ')');
                    for (var i = 0; i < obj.length; i++) {
                        var parseobj = obj[i];
                        if (parseobj.username == username) {
                            $("#chatbox ul").append("<li class='left clearfix'>" +
                                "<span class='chat-img pull-left'><img src='../img/me.png' alt='User Avatar' class='img-circle' /></span>" +
                                "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + username + "</strong> <small class='pull-right text-muted'>" +
                                "<span class='glyphicon glyphicon-time'></span>" + parseobj.chatdate + "</small></div><p>" + nl2br(parseobj.msg) + "</p></div></li>");
                        } else {
                            $("#chatbox ul").append("<li class='left clearfix'>" +
                                "<span class='chat-img pull-left'><img src='../img/you.png' alt='User Avatar' class='img-circle' /></span>" +
                                "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + parseobj.username + "</strong> <small class='pull-right text-muted'>" +
                                "<span class='glyphicon glyphicon-time'></span>" + parseobj.chatdate + "</small></div><p>" + nl2br(parseobj.msg) + "</p></div></li>");
                        }
                    }
                    if (previousChatRows != 0) {
                        play_single_sound();
                    }
                    if (currentHeight >= totalHeight) {
                        $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
                    }
                    previousChatRows = numChatRows;
                }
            });
        }
    }


}


function SendMessage(username, propertyID, userType) {
    var theType = userType;
    var theMessage = $("#btn-input").val();
    var theUser = username;
    var thePID = propertyID;
    if ((theMessage == "") || (thePID == "")) {

        return;

    } else {

        jQuery.ajax({
            url: 'chat_send_ajax.php',
            type: "POST",
            data: {
                message: theMessage,
                user: theUser,
                pID: thePID,
                type: theType
            },
            success: function (result) {
                $("#btn-input").val('');

                $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
                //LoadChatBox(propertyID, username);
                //setTimeout(function () {
                //    $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
                //}, 500);

            }

        });

    }
}

function nl2br(str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function numRowCheck(pid) {

    jQuery.ajax({
        url: 'getrows.php',
        type: "POST",
        data: {
            propertyID: pid
        },
        success: function (result) {
            numChatRows = result;

        }
    });

}

