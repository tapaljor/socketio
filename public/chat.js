//When event happens in client/front end
var socket = io.connect('http://localhost:4000');

var message = document.getElementById('message');
var handle = document.getElementById('handle');
var messageform = document.getElementById('messageform');

//When event magic happens from client/front end
socket.on('connect', function() {
	socket.emit('new connection', handle.value);
});
messageform.addEventListener('submit', function(e) {

	e.preventDefault();
	var data = {
		message: message.value,
		handle: handle.value
	};
	$("#message").val('');
	socket.emit('chat', data);
});
message.addEventListener('keypress', function() {
	socket.emit('typing', handle.value);
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
	output.innerHTML = '<p><b>'+data.handle+':</b> '+data.message+'</p>'+output.innerHTML;
});
socket.on('typing', function(data) {
	feedback.innerHTML = '<i>'+data+' is typing..</i>';
});

