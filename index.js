var express = require('express');
var socket = require('socket.io');

var app = express();
var server = app.listen(4000, function() {
	console.log('Server created with : 4000');
});

var io = socket(server);

io.on('connection', function(socket) {
	socket.on('new connection', function(data) {
		socket.broadcast.emit('new connection', data);
	});
	socket.on('left', function(data) {
		socket.broadcast.emit('left', data);
	});
	socket.on('chat', function(data) {
		io.emit('chat', data);
	});
	socket.on('typing', function(data) {
		socket.broadcast.emit('typing', data);
	});
});
