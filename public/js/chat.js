var socket = io.connect('http://localhost:3000');

//receiving msg through socket/server
socket.on('updatedUser', (data) => {
	let userList = document.getElementById('user-list');
	if (userList) { //if logged in then see user list
		let listItems = userList.getElementsByTagName('li');

		for (let i = 0; i < listItems.length; i++) {
			if (listItems[i].textContent == data.username) {
				listItems[i].remove();
			}
		}
		let li = document.createElement('li');//for link
		li.innerHTML = `<a href="/to/${data.username}">${data.username}</a>`;
		userList.prepend(li);
	}
});
socket.on('chat', function (data) {
	let fromm = document.getElementById('fromm');
	let too = document.getElementById('too');
	if (fromm && too) {
		if (fromm.value === data.too && data.fromm === too.value) { //only particular user msg comes here
			let output = document.getElementById('output');
			let li = document.createElement('li');//for link
			li.innerHTML = `<a href="/to/${data.fromm}"><b>${data.fromm}:</b> <i>${data.message}</i></a>`;
			output.prepend(li);
		}
	}
	// notifications of new msgs
	let notifications = document.getElementById('notifications');
	let lin = document.createElement('li');
	lin.innerHTML = `<a href="/to/${data.fromm}">New message from ${data.fromm}</a>`;
	notifications.appendChild(lin);
});
socket.on('typing', function (data) {
	let typingMsg = document.getElementById('actions');
	typingMsg.innerHTML = `<i>${data.fromm} is typing...</i>`;
	setTimeout(() => {
		typingMsg.innerHTML = '...';
	}, 2000);  // Delay of 2000 milliseconds (2 seconds)
});
socket.on('registrationDone', (data) => {
	if (data.success == true) {
		window.location.href = `/index/${data.username}`;
	} else {
		console.log(data.message);
	}
});
/*socket server msg receiving ends */

// from the server side to server
let sendMessage = document.getElementById('sendMessage');
var messageInput = document.getElementById('message');

if (sendMessage || messageInput) {
	sendMessage.addEventListener('click', (e) => {
		e.preventDefault();
		sendMessageToServer();
	});
	messageInput.addEventListener('keydown', (e) => {
		if (e.key === 'Enter') {
			sendMessageToServer();
		}
	});
}
function sendMessageToServer() {
	const output = document.getElementById('output');
	var fromm = document.getElementById('fromm').value;
	var too = document.getElementById('too').value;
	var message = messageInput.value;
	socket.emit('chat', { fromm: fromm, too: too, message: message });

	//message for yourself
	let li = document.createElement('li');
	li.textContent = `me: ${messageInput.value}`;
	output.prepend(li);
	messageInput.value = '';  // Clear input field
}

/*sending broading where the message is typing*/
let messageTyping = document.getElementById('message');
if (messageTyping) {
	messageTyping.addEventListener('keypress', function () {
		var fromm = document.getElementById('fromm').value;
		socket.emit('typing', { fromm: fromm });
	});
}

// starting chat, sending to server's socket to do necessay registertion
let userJoinButton = document.getElementById('userJoin');
let usernameInput = document.getElementById('username');
let roomInput = document.getElementById('room');
if (userJoinButton) {
	userJoinButton.addEventListener('click', (e) => {
		e.preventDefault();
		const username = usernameInput.value;
		if (username) {
			socket.emit('userJoin', { username: username, room: roomInput.value });
		} else {
			alert('Fields cannot be empty.');
		}
	});
}

// selecting users based on room
let roomSelect = document.getElementById('room');
let userList = document.getElementById('user-list');
if (roomSelect) {
	roomSelect.addEventListener('change', (e) => {
		e.preventDefault();
		fetch(`/fetchUsersByRoom/${roomSelect.value}`)
			.then(response => response.json())
			.then(users => {
				userList.innerHTML = '';
				for (let a = 0; a < users.length; a++) {
					let li = document.createElement('li');//for link
					li.innerHTML = `<a href="/to/${users[a].username}">${users[a].username}</a>`;
					userList.prepend(li);
				}
			});
	});
}
