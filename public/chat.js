//When event happens in client/front end
var socket = io.connect('http://localhost:4000');

var message = document.getElementById('message');
var handle = document.getElementById('handle');
var user = document.getElementById('user');
var destination = document.getElementById('destination');
var messageform = document.getElementById('messageform');

//When event magic happens from client/front end
socket.on('connect', function() {
	socket.emit('new connection', user.value);
});
messageform.addEventListener('submit', function(e) {

	e.preventDefault();
	var data = {
		message: message.value,
		handle: handle.value,
		user: user.value,
		destination: destination.value
	};
	$("#message").val('');
	socket.emit('chat', data);
});
message.addEventListener('keypress', function() {

	var data = {
		user: user.value,
		handle: handle.value,
		destination: destination.value
	};
	socket.emit('typing', data);
});

//Events from server
socket.on('new connection', function(data) {
	notification.innerHTML = '<p><a href="home.php?destinationh='+data+'">'+data+'</a></p>'+notification.innerHTML;
});
socket.on('disconnect', function() {
	notification.innerHTML = '<p><i style="color: red;">'+handle.value+' left<i></p>'+notification.innerHTML;
});
socket.on('chat', function(data) {
	feedback.innerHTML = 'Send';
	if ( (data.destination === handle.value &&  
		destination.value === data.handle ) ||
		handle.value === data.handle
		) { 
		output.innerHTML = '<p><b>'+data.user+':</b> '+data.message+'</p>'+output.innerHTML;
	}
});
socket.on('typing', function(data) {
	if ( data.handle === destination.value && data.destination === handle.value) {
		feedback.innerHTML = '<i>'+data.user+' is typing..</i>';
	}
});

