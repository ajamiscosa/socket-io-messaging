<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="css/app.css">
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top " role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('message') }}">Simple Realtime Message</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav nav-pills pull-right" role="tablist">
                <li role="presentation"><a href="#">New messages <span class="badge" id="msgcount">{{ $new }}</span></a></li>
            </ul>
        </div>

    </div>
</nav>

<div class="container">
    <div id="new-message-notif"></div>
    <div class="row">
        <div class="table-responsive">
            <table id="mytable" class="table table-bordred table-striped">
                <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Time</th>
                <th>Read</th>
                </thead>

                <tbody id="message-tbody">

                @if(count($messages) > 0)

                    @foreach($messages as $message)

                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>{{ $message->created_at }}</td>
                            <td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="{{ $message->id }}"><span class="glyphicon glyphicon-search"></span></a></td>
                        </tr>

                    @endforeach

                @else

                    <tr id="no-message-notif">
                        <td colspan="5" align="center"><div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only"></span> No message</div>
                        </td>
                    </tr>

                @endif

                </tbody>
            </table>

        </div>
    </div>
</div>

<hr>
<footer class="text-center">Simple Realtime Message &copy 2015</footer>
<hr>
<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript" src="{!! asset('node_modules/socket.io-client/dist/socket.io.js') !!}"></script>
<script>
$(document).ready(function(){
    // listen for updates.
    var socket = io.connect( 'http://'+window.location.hostname+':3000' );

    socket.on( 'new_msgcount', function( data ) {
        $( "#msgcount" ).html( data.msgcount );
        //$('#notif_audio')[0].play();
    });

    socket.on( 'update_msgcount', function( data ) {
        $( "#msgcount" ).html( data.msgcount );
    });

    socket.on( 'update_msgcount', function( data ) {
        $( "#msgcount" ).html( data.msgcount ); // data.[update_msgcount] is in sender script.
    });


    // triggered when there is new_message
    socket.on( 'new_message', function( data ) {

        $( "#message-tbody" ).prepend('<tr><td>'+data.name+'</td><td>'+data.email+'</td><td>'+data.subject+'</td><td>'+data.created_at+'</td><td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="'+data.id+'"><span class="glyphicon glyphicon-search"></span></a></td></tr>');
        $( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>New message ...</div>');
    });

});
</script>
</body>
</html>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">✕</button>
                <h4>Detail Message</h4>
            </div>

            <div class="modal-body" style="text-align:center;">
                <div class="row-fluid">
                    <div class="span10 offset1">
                        <div id="modalTab">
                            <div class="tab-content">
                                <div class="tab-pane active" id="about">

                                    <center>
                                        <p class="text-left">
                                            <b>Name</b> : <span id="show_name"></span><br />
                                            <b>Email</b> : <span id="show_email"></span><br />
                                            <b>Subject</b> : <span id="show_subject"></span><br />
                                            <b>Message</b> : <span id="show_message"></span><br />
                                        </p>
                                        <br>
                                    </center>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
