var express = require('express');
var socket = require('socket.io');
var path = require('path');

var app = express();
var server = app.listen(3000, function() {
	console.log('Server running on port 3000');
});

var io = socket(server);

// Serve static HTML file
app.get("/", (req, res) => {
    res.sendFile(path.join(__dirname, 'public', "index.html"));  // Serve index.html
});

io.on('connection', function(socket) {
    console.log('New user connected');

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
