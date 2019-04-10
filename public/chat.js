//When event happens in client/front end
var socket = io.connect('http://localhost:4000');

var message = document.getElementById('message');
var handle = document.getElementById('handle');
var user = document.getElementById('user');
var destination = document.getElementById('destination');
var messageform = document.getElementById('messageform');

if ( messageform) {//When you are chatting with single user

	//When event magic happens from client/front end to SERVER
	messageform.addEventListener('submit', function(e) {
		e.preventDefault();
		var data = {
			message: message.value,
			source: handle.value,
			user: user.value,
			destination: destination.value
		};
		socket.emit('chat', data); //Message send to server to be sent to clients connected

		//Saving message in database after it is send on socket
		$.ajax ({
			type: "POST",
			url: "save_message.php",
			data: {message: message.value, source: handle.value, destination: destination.value},
			success: function() {
				$("#message").val('');
			}
		});
	});
	message.addEventListener('keypress', function() {
		var data = {
			user: user.value,
			source: handle.value,
			destination: destination.value
		};
		socket.emit('typing', data);
	});
	//Events from server
	socket.on('chat', function(data) {
		feedback.innerHTML = 'Send';
		if ( (data.destination === handle.value &&  
			data.source === destination.value) ||
			data.source === handle.value 
			) { 
			output.innerHTML = '<p><b>'+data.user+': </b><i>'+data.message+'</i></p>'+output.innerHTML;
		} 
	});
	socket.on('typing', function(data) {
		if ( data.source === destination.value && data.destination === handle.value) {
			feedback.innerHTML = '<i>'+data.user+' is typing..</i>';
		}
	});
}

//Event from server to clients
socket.on('chat', function(data) {
	if ( data.destination === handle.value) {
		new_message.innerHTML = 'New message';
	}
});
socket.on('new connection', function(data) {
	notification.innerHTML = '<p style="color: green;">'+data+'</p>'+notification.innerHTML;
});
socket.on('left', function(data) {
	notification.innerHTML = '<p style="color: red;">'+data+'</p>'+notification.innerHTML;
});

