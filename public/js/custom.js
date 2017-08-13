$(function(){
    $('#submit').on('click',function () {
        var dataString = {
            name : $("#name").val(),
            email : $("#email").val(),
            subject : $("#subject").val(),
            message : $("#message").val(),
            _token : $('meta[name=csrf-token]').attr('content')
        };

        $.ajax({
            type: "POST",
            url: "/",
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){ // data here is from controller. a.k.a. controller response.
                $("#name").val('');
                $("#email").val('');
                $("#subject").val('');
                $("#message").val('');

                alert(data.success);
                if(data.success)
                {
                    var socket = io.connect( 'http://'+window.location.hostname+':3000' );

                    // send to server, update message count since there is new message added.
                    socket.emit('new_msgcount', {
                        msgcount: data.msgcount
                    });

                    // send to server new message content directly.
                    socket.emit('new_message', {
                        name: data.name,
                        email: data.email,
                        subject: data.subject,
                        created_at: data.created_at
                    });

                }
                else
                {
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("#subject").val(data.subject);
                    $("#message").val(data.message);
                }
            },
            error: function(xhr, status, error) {
                alert("error"+error);
            }
        });
    });


    $('.detail-message').on('click', function () {
        var dataString = {
            id : $(this).attr('id'),
            _token :  $('meta[name=csrf-token]').attr('content')
        };

        $.ajax({
            type: "POST",
            url: "{{ URL::to('message') }}",
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){

                $( "#load" ).hide();

                if(data){

                    $("#show_name").html(data.name);
                    $("#show_email").html(data.email);
                    $("#show_subject").html(data.subject);
                    $("#show_message").html(data.message);

                    var socket = io.connect( 'http://'+window.location.hostname+':3000' );

                    socket.emit('update_count_message', {
                        update_count_message: data.update_count_message
                    });

                }

            } ,error: function(xhr, status, error) {
                alert(error);
            }

        });
    });
});