



function SendMessage(username){


        var theMessage = $("#btn-input").val();
        var theUser = username;

        jQuery.ajax({
                        url:'chat_send_ajax.php',
                        type: "POST",
                        data: {
                        	message:theMessage,
                        	user:theUser
                        	}
                        
                    });



}
