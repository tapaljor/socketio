var express = require('express');
var socket = require('socket.io');
var path = require('path');
var exphbs = require("express-handlebars");
const session = require("express-session");
const cookieParser = require("cookie-parser");
const ioSession = require("express-socket.io-session");
const { MongoClient } = require("mongodb");

const uri = "mongodb+srv://tapaljor:A81Z6ZvQjnhud1Xx@tpcluster.pmqosjh.mongodb.net/?retryWrites=true&w=majority&appName=TPCluster";
const client = new MongoClient(uri);

async function connectDB() {
    try {
        await client.connect();
        console.log("Connected to database.");
        return client.db('resident');
    } catch (err) {
        console.error(err);
        process.exit(1); // Exit if there is a connection error
    }
}
var app = express();

// Serve static files
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, 'public')));

// Handlebars setup
app.engine(".hbs", exphbs.engine({
    extname: ".hbs",
    defaultLayout: false,
    layoutsDir: path.join(__dirname, "/views")
}));
app.set("view engine", ".hbs");
app.set("views", path.join(__dirname, "/views"));

// Use cookie-parser
app.use(cookieParser());

// Session middleware
const sessionMiddleware = session({
    secret: "#WFDSO*&(jHUIL38slds3IIH",
    resave: false,
    saveUninitialized: true,
    cookie: {
        sameSite: 'Lax', 
        secure: false,
        maxAge: 600000
    }
});

// session middleware in express
app.use(sessionMiddleware);

// Initiate server and database connection
(async () => {
    const db = await connectDB(); // Await database connection

    //for developing resetting collection to 0
    //await db.collection("chaUsers").deleteMany({});

    // Store the database connection in app.locals for access across the app
    app.locals.db = db;

    // Define routes
    app.get("/", async (req, res) => {
        try {
            const rooms = await db.collection("chaRooms").find({}).toArray();
            res.render('index', { rooms });
        } catch (err) {
            console.error(err);
        }
    });
    // setting session
    app.get("/index/:username", async (req, res) => {
        req.session.username = req.params.username; //setting up session
        try {
            const users = await db.collection("chaUsers").find({}).toArray();
            const rooms = await db.collection("chaRooms").find({}).toArray();
            res.render('users', { users, rooms });
        } catch (err) {
            console.error(err);
        }
    });
    app.get("/users", async (req, res) => {
        try {
            if (req.session.username) {
                const users = await db.collection("chaUsers").find({}).toArray();
                const rooms = await db.collection("chaRooms").find({}).toArray();
                res.render('users', { users, rooms });
            } else {
                const rooms = await db.collection("chaRooms").find({}).toArray();
                res.render('index', { rooms });
            }
        } catch (err) {
            console.error(err);
        }
    });
    app.get("/fetchUsersByRoom/:room", async (req, res) => {
        try {
            const users = await db.collection("chaUsers").find({
                room: req.params.room
            }).toArray();
            res.json(users);
        } catch (err) {
            console.error(err);
        }
    });
    app.get("/to/:too", async (req, res) => {
        try {
            const users = await db.collection("chaUsers").find({}).toArray();
            res.render('index', { users, fromm: req.session.username, too: req.params.too });
        } catch (err) {
            console.error(err);
        }
    });
    // Start the server
    var server = app.listen(3000, function () {
        console.log('Server running on port 3000');
    });
    // Attach socket.io to the server
    var io = socket(server);

    // Use the session middleware in Socket.io
    io.use(ioSession(sessionMiddleware, {
        autoSave: true  // Save the session automatically after each request
    }));

    // Socket.io connection
    io.on('connection', function (socket) {

        //accessing session into websocket
        const session = socket.handshake.session;

        console.log('socket id refreshed ', socket.id);

        // update the socket id when users refreshes
        if (session.username) {
            db.collection('chaUsers').updateOne(
                { username: session.username },
                { $set: { socketId: socket.id } },
                { upsert: true }
            ).then(() => {
                console.log(`Socket ID ${socket.id} updated for user ${session.username}`);
                io.emit('updatedUser', { username: session.username, socketId: socket.id });
            }).catch(err => {
                console.error('Error updating socket ID:', err);
            });
            socket.on('disconnect', function () {
                console.log('A user disconnected');
            });
            socket.on('chat', async (msg) => {
                try {
                    const user = await db.collection("chaUsers").findOne(
                        { username: msg.too },
                        { projection: { socketId: 1 } }
                    );
                    if (user) {
                        io.to(user.socketId).emit('chat', msg);
                    }
                } catch (err) {
                    console.error(err);
                }
            });
            socket.on('typing', (msg) => {
                io.emit('typing', msg);
            });
        }
        socket.on('userJoin', async (msg) => {
            const data = { socketId: socket.id, username: msg.username, room: msg.room }
            try {
                const result = await db.collection('chaUsers').findOne(
                    { username: msg.username },
                    { projection: { username: 1 } }
                );
                if (result) { // if already registered, update with newly selected room
                    try {
                        const updatedUser = await db.collection('chaUsers').updateOne(
                            { username: msg.username },
                            { $set: { room: msg.room } }
                        );
                        if (updatedUser) {
                            socket.emit('registrationDone', { success: true, username: msg.username, message: "Registration done." });
                        }
                    } catch (err) {
                        console.error(err);
                    }
                } else { //if the user is not registered, then register
                    const user = await db.collection('chaUsers').insertOne(data);
                    if (user) {
                        socket.emit('registrationDone', { success: true, username: msg.username, message: "Registration done." });
                    } else {
                        socket.emit('registrationDone', { success: false, message: "Registration not done." });
                    }
                }
            } catch (err) {
                console.log(err);
            }
        });
    });
})();
