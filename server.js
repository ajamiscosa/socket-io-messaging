var socket  = require( './public/node_modules/socket.io' );
var express = require('./public/node_modules/express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

server.listen(port, function () {
    console.log('Server listening at port %d', port);
});

io.on('connection', function (socket) {

    socket.on( 'update_msgcount', function( data ) {
        io.sockets.emit( 'update_msgcount', {
            msgcount: data.msgcount
        });
    });

    socket.on( 'new_msgcount', function( data ) {
        io.sockets.emit( 'new_msgcount', {
            msgcount: data.msgcount
        });
    });

    socket.on( 'new_message', function( data ) {
        io.sockets.emit( 'new_message', {
            name: data.name,
            email: data.email,
            subject: data.subject,
            created_at: data.created_at,
            id: data.id
        });
    });


});
