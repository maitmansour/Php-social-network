// start ajax query post new message on chat 
var frm = $('#send_message_form');
frm.submit(function(e) {
    e.preventDefault();
    $('#goBtn').disabled = true;
    $('#sendie').disabled = true;
    $.ajax({
        type: "POST",
        url: "ajaxDispatcher.php",
        data: {
            'message': $('#sendie').val(),
            'action': 'newChatMessage'
        },
        success: function(data) {
            console.log(data);
            $("#send_message_form")[0].reset();
        },
        error: function(data) {
            console.log(data);
        },
    });
});


// end ajax query post new message on chat 

//start ajax query get new message on chat
function getMessages(id) {
    $.ajax({
        type: "POST",
        url: "ajaxDispatcher.php",
        data: {
            "action": "getLastChat",
            "id": id
        },
        dataType: "json",
        success: function(data) {
            if (data.ok == 1) {
                var content = '<div class="chat-message clearfix">';
                content += '<a href="ceriLand.php?action=profile&id=' + data.sender_id + '"><img src="' + data.sender_avatar + '" alt="" width="32" height="32"></a><div class="chat-message-content clearfix">';
                content += '<span class="chat-time">' + data.chat_time + '</span><h5>' + data.sender_name + '</h5> <p>' + data.text + '</p></div></div> <hr>';
                $("#chat_content").append(content);
                $('#chat_content').animate({
                    scrollTop: $('#chat_content').prop("scrollHeight")
                }, 500);
                var newCounterVal = parseInt($('.chat-message-counter').text()) + 1;
                var counter = $('.chat-message-counter').html(newCounterVal);

            }
            setTimeout('getMessages(' + data.id + ')', 3000);
        },
        error: function(data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });

}
$(document).ready(function() {
    setTimeout(getMessages(0), 1000);
});
// end  ajax query get new message on chat



// start drag chatbox limits 
$(".draggable").draggable({
    obstacle: "#butNotHere",
    preventCollision: true,
    containment: "#moveInHere"
});
//end drag chatbox limits -->


// start update messages number 
(function() {
    $('#live-chat header').on('click', function() {
        $('.chat').slideToggle(300, 'swing');
        $('.chat-message-counter').fadeToggle(300, 'swing');
        $('.chat-message-counter').html("0");
        $('#chat_content').animate({
            scrollBottom: $('#chat_content').prop("scrollHeight")
        }, 500);
    });
})();
// end update messages number -->

// start draggable
$('.chat').draggable({
    handle: 'header'
});
//end draggable