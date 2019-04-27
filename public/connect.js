//When event happens in client/front end
var socket = io.connect("http://192.168.2.239:4000");

var user = document.getElementById('user');
var type = document.getElementById('type');

//Events to server
socket.on('connect', function() {
	if ( type.value === 'login') {
		var data = {
			user: user.value,
			id: id.value
		};
		socket.emit('new connection', data);
	} else {
		socket.emit('left', user.value);
	}
});
