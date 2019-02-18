 //create new Item 
  function createNewItem(value) {
      var content = ' <div class="item" id="'+value.id+'">';
                content+=     ' <div class="feed d-flex justify-content-between">';
                content+=         '<div class="feed-body d-flex justify-content-between">';
                content+=           ' <a href="#"';
                content+=               'class="feed-profile">';
                content+=              ' <div class="avatar">';
                content+=                 ' <img ';
                content+=               ' src="'+value.sender_avatar+'"';
                content+=               'alt="person" class="img-fluid rounded-circle" style="height: 50px;">';
                content+=                '</div>';
                content+=              '</a>';
                content+=            '<div class="content">';
                content+=              ' <h5> ';
                content+=               '<a href="?action=profile&id='+value.sender_id+'">'+value.sender_name+' </a>';
                if (value.via_id != null){
                content+=                '<span> shared (<a href="?action=profile&id='+value.via_id+'">'+value.via_name+'</a> )  message !</span>';
   	}                
   				if (value.to_id != null){
                content+=                '<span>  to (<a href="?action=profile&id='+value.to_id+'">'+value.to_name+'</a> ) </span>';
   	}
                content+=              ' </h5>';
                content+=               '<span>';
                content+=                value.text;
                if (value.image != null){
                content+=                '<img src="'+value.image+'" alt="person" class="img-fluid">';
   	}
                content+=              ' </span>';
                content+=               '<div class="full-date">';
                content+=                 '<small>'+value.date+' at '+value.hour+'</small>';
                content+=              '</div>';
                content+=               '<div class="CTAs">';
                content+= ' <a href="ajaxDispatcher.php?action=AddLike&id='+value.id+'" class="increase_likes btn btn-xs btn-secondary" value="'+value.id+'">';
                content+=' <i class="fa fa-thumbs-up"> </i>Like (<span id="likes_counter_'+value.id+'">'+value.likes+'</span>)</a>';
                content+=' <a href="ajaxDispatcher.php?action=ShareMessage&id='+value.id+'" class="increase_shares btn btn-xs btn-secondary"><i  class="fa fa-share"> </i>Share (<span id="shares_counter_'+value.id+'">'+value.shares+'</span>)</a></div>   </div>   </div>    <div class="date text-right"> ';
                content+= '<small>'+value.time_ago+'</small></div>                     </div>                  </div>';
   
      return content;
    }
   //end of new item create




   //start of increase shares
   $('.increase_shares').click(function(e) {
      e.preventDefault();
      id_v = $(this).attr('value');
             $.ajax({
             type: "GET",
       url: $(this).attr('href'),
             success: function (data) {
             name ="#shares_counter_"+id_v;
              var likes_counter_new = parseInt($(name).text()) + 1;
              $(name).html(likes_counter_new);                   },
   
             error: function (data) {
             },
         });
   });
//end of increase shares



//start of increase likes
   $('.increase_likes').click(function(e) {
      e.preventDefault();
      id_v = $(this).attr('value');
             $.ajax({
             type: "GET",
       url: $(this).attr('href'),
             success: function (data) {
             name ="#likes_counter_"+id_v;
              var likes_counter_new = parseInt($(name).text()) + 1;
              $(name).html(likes_counter_new);
                   },
   
             error: function (data) {
             },
         });
   });
//end of increase likes


// start of load more wall messages on scroll
   $(window).scroll(function() {
     if($(window).scrollTop() == $(document).height() - $(window).height()) {
   
       getWallMessages(0);
     }
   });
   
    function getWallMessages(id) {
                 $.ajax({
       type: "GET",
       url: "ajaxDispatcher.php",
       data: {"action":"loadMoreMessages",
           "first":$('#messages_content').children().last().attr('id') },
       dataType: "json",
       success: function(data) {
   
   $.each(data, function (index, value) {
             if (value.ok == 1) {
                   var content = createNewItem(value);
   
               $("#messages_content").append(content);
                $('#messages_content').animate({scrollTop: $('#messages_content').prop("scrollHeight")}, 500);
           }
   });
   
       },
       error: function (data) {
           console.log('An error occurred.');
           console.log(data);
       },
    });
   }
   //end of load more wall messages on scroll