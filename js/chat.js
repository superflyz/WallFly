



function SendMessage(username,propertyID){

    var theMessage = $("#btn-input").val();
    var theUser = username;
    var thePID = propertyID;
    if((theMessage == "") || (thePID =="")){

        return;

    }else{

        jQuery.ajax({
            url:'chat_send_ajax.php',
            type: "POST",
            data: {
            	message:theMessage,
            	user:theUser,
                pID:thePID
            	},
            success: function(result){
            $("#btn-input").val('');
            LoadChatBox(propertyID,username);

            }

        });

    }
}

function LoadChatBox(propertyID,username){

    if(propertyID == ""){

        return;

    }else{

        jQuery.ajax({
            url:'loadChatBox.php',
            type: "POST",
            data: {
                pID:propertyID
            },
            success: function(response) {
                $('#chatlist').empty();
                var obj = eval("(" + response + ')');
                for(var i = 0; i < obj.length; i++) {
                var parseobj = obj[i];
                    if(parseobj.username == username){$("#chatbox ul").append("<li class='left clearfix'>"+
                        "<span class='chat-img pull-left'><img src='http://placehold.it/50/55C1E7/fff&text=ME' alt='User Avatar' class='img-circle' /></span>"+
                        "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>"+username+"</strong> <small class='pull-right text-muted'>"+
                        "<span class='glyphicon glyphicon-time'></span>"+parseobj.chatdate+"</small></div><p>"+parseobj.msg+"</p></div></li>");



                    }else{
                        $("#chatbox ul").append("<li class='right clearfix'>"+
                        "<span class='chat-img pull-right'><img src='http://placehold.it/50/55C1E7/fff&text=YOU' alt='User Avatar' class='img-circle' /></span>"+
                        "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>"+parseobj.username+"</strong> <small class='pull-right text-muted'>"+
                        "<span class='glyphicon glyphicon-time'></span>"+parseobj.chatdate+"</small></div><p>"+parseobj.msg+"</p></div></li>");


                    }

                 }
            }

        });

    }
}
