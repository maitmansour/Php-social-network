//Author : BELGHARBI Meryem / Reflexion et débogage en binôme

    // Start Update Status Button toggle 
    $("#edit_status").click(function() {
        var $user_status = $('#user_status'),
            isEditable = $user_status.is('.editable');
        if ($('#edit_status').hasClass('fa-check')) {
            $('#edit_status').removeClass('fa-check').addClass('fa-pencil');
            $.ajax({
                type: "POST",
                url: "ajaxDispatcher.php",
                data: {
                    'info': $('#user_status').html(),
                    'type': 'statut',
                    'action': 'updateUser'
                },
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {
                    console.log(data);
                },
            });
        } else if ($('#edit_status').hasClass('fa-pencil')) {
            $('#edit_status').removeClass('fa-pencil').addClass('fa-check');
        }
        $('#user_status').prop('contenteditable', !isEditable).toggleClass('editable');
        $('#user_status').fadeTo(100, 0.3, function() {
            $('#user_status').fadeTo(500, 1.0);
        });
    });


    // End of Update Status Button toggle 

    // Start Update picture Button toggle 


    $("#edit_avatar").click(function() {
        var $user_status = $('#user_avatar'),
            isEditable = $user_status.is('.editable');
        if ($('#edit_avatar').hasClass('fa-check')) {
            $('#edit_avatar').removeClass('fa-check').addClass('fa-pencil');
            $.ajax({
                type: "POST",
                url: "ajaxDispatcher.php",
                data: {
                    'info': $('#user_avatar').html(),
                    'type': 'avatar',
                    'action': 'updateUser'
                },
                success: function(data) {
                    console.log(data);
                    $('#profile-image').attr('src', $('#user_avatar').html());

                },
                error: function(data) {
                    console.log(data);
                },
            });
        } else if ($('#edit_avatar').hasClass('fa-pencil')) {
            $('#edit_avatar').removeClass('fa-pencil').addClass('fa-check');
        }
        $('#user_avatar').prop('contenteditable', !isEditable).toggleClass('editable');
        $('#user_avatar').fadeTo(100, 0.3, function() {
            $('#user_avatar').fadeTo(500, 1.0);
        });
    });


    // End of Update Status Button toggle