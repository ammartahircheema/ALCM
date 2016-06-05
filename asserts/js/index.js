//var app = require('express')();
//var http = require('http').Server(app);
//var io = require('socket.io')(http);
//
//app.get('/', function (req, res) {
//    res.sendfile('index.html');
//});


var io = require('socket.io')();
//io.on('connection', function(socket){
//    console.log('a user connected');
//    socket.on('disconnect', function () {
//        console.log('user disconnected');
//    });
//    socket.on('chat message', function(msg){
//    console.log('message: ' + msg.id + ', '+msg.name+', '+msg.msg);
//    io.emit('chat message', msg);
//  });
//});


io.on('connection', function (socket) {
    console.log('a user connected');
    socket.on('disconnect', function () {
        console.log('user disconnected');
    });
    socket.on('chat message', function(msg){
    console.log('message: ' + msg.id + ', '+msg.name+', '+msg.msg);
    io.emit('chat message', msg);
  });
});
io.listen(3000);

//http.listen(80, function () {
//    console.log('listening on *:3000');
//});