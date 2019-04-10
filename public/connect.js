//When event happens in client/front end
var socket = io.connect('http://localhost:4000');

var user = document.getElementById('user');
var type = document.getElementById('type');

//Events to server
socket.on('connect', function() {

	if ( type.value === 'login') {
		socket.emit('new connection', user.value);
	} else {
		socket.emit('left', user.value);
	}
});

//Events from server

