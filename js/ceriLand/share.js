   $(document).ready(function () {
       
       $("#field").autocomplete({
           delay: 100,
           source: function (request, response) {
               
               // Suggest URL
               var suggestURL = "ajaxDispatcher.php?action=users&pattern=%PATTERN";
               suggestURL = suggestURL.replace('%PATTERN', request.term);
               
               // JSONP Request
               $.ajax({
                   method: 'GET',
                   dataType: 'json',
                   url: suggestURL
               })
               .success(function(data){
                   response(data);
               });
           },
           select: function(event, ui) {
               // feed hidden id field
               $("#message_tag").val(ui.item.id);
               // update number of returned rows
           },
   
           // mustMatch implementation
           change: function (event, ui) {
               if (ui.item === null) {
                   $(this).val('');
                   $('#message_tag').val('');
               }
           }
       });
   
   });



   // start post new message on wall
      var frm = $('#post_message_form');
   frm.submit(function (e) {
       e.preventDefault();
       $.ajax({
           type: "POST",
      url: "ajaxDispatcher.php",
        data: { 'message_txt' : $('#message_txt').val(),
            'message_tag' : $('#message_tag').val(),
            'message_img' : $('#message_img').val(),
              'action':'newMessage' }, 
        dataType: "json",
           success: function (data) {
            $("#post_message_form")[0].reset();
            alert(data.id);
            var content = createNewItem(data);
             $("#messages_content").prepend(content);
                console.log(data.sender_avatar);
           },
           error: function (data) {
               console.log(data);
           },
       });
   });
   // end post new message on wall
