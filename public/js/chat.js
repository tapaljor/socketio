var socket = io.connect('http://localhost:3000');

socket.emit('new connection', { username: 'User joined the chat' });

//receiving msg through socket
socket.on('chat', function (data) {
	let lounge = document.getElementById('lounge');
	let a = document.createElement('a');//for link
	a.href = `/${data.username}`;
	a.innerHTML = `<b>${data.username}:</b> ${data.message}<br/>`;
	lounge.prepend(a);
});

socket.on('typing', function (data) {
	let typingMsg = document.getElementById('actions');
	typingMsg.innerHTML = `<i>${data} is typing...</i>`;
	setTimeout(() => {
		typingMsg.innerHTML = '...';
	}, 2000);  // Delay of 2000 milliseconds (2 seconds)
});
socket.on('updateUsers', (data) => {
	console.log(`got message from server emit ${data}` );
	let users = document.getElementById('chat-left');
	data.users.forEach((user) => {
		let a = document.createElement('a');//for link
		a.href = `/${data.socketId}`;
		a.textContent = `${data.username}`;
		users.prepend(a);
	});
});
/*function sendMessage() {
	var username = document.getElementById('username').value;
	var message = document.getElementById('message').value;

	socket.emit('chat', { username: username, message: message });
	document.getElementById('message').value = '';  // Clear input field
}
document.getElementById('message').addEventListener('keypress', function () {
	var username = document.getElementById('username').value;
	socket.emit('typing', username);
});*/


// starging chat
let userJoin = document.getElementById('userJoin');
let usernameInput = document.getElementById('username');
if (userJoin) {
	userJoin.addEventListener('click', (e) => {
		e.preventDefault();
		const username = usernameInput.value;
		socket.emit('userJoin', { username: username });
	});
}

