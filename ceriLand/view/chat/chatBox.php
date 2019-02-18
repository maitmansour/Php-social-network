<!-- Author : BELGHARBI Meryem / Reflexion et débogage en binôme-->
<!-- start live-chat -->
<div id="live-chat" class="draggable">
    <header class="clearfix" data-target="#chatDiv">
        <h4>Group Chat</h4>
        <span class="chat-message-counter"></span>
    </header>
    <div class="chat" id="chatDiv">
        <div class="chat-history" id="chat_content">
            <!-- This will contains messages -->
        </div>
        <form id="send_message_form">
            <div class="input-group">
                <input type="text" name="message" id="sendie" placeholder="Type your message…" class="form-control" autofocus>
                <span class="input-group-btn">
            <input type="submit" name="Send"  id="goBtn" value="Go!" class="btn btn-default">
            </span>
            </div>
        </form>
    </div>
</div>
<!-- end live-chat -->