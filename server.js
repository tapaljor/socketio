var express = require('express');
var socket = require('socket.io');
var path = require('path');
var exphbs = require("express-handlebars");

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

app.use(express.urlencoded({ extended: true }));

// Initiate server and database connection
(async () => {
    const db = await connectDB(); // Await database connection

    // Store the database connection in app.locals for access across the app
    app.locals.db = db;
    // Define routes
    app.get("/", (req, res) => {
        res.render('index');
    });
    app.get("/:to", (req, res) => {
        console.log(req.params.to);
        res.render('private', { to: req.params.to });
    });
    app.post("/start", async (req, res) => {
        console.log(req.body);
    });
    // Start the server
    var server = app.listen(3000, () => {
        console.log('Server running on port 3000');
    });

    // Attach socket.io to the server
    var io = socket(server);

    // Socket.io connection
    io.on('connection', function (socket) {
        console.log('A user connected');

        socket.on('disconnect', async() => {
            try {
             /*   let result = await db.collection("chaUsers").deleteOne(
                    {socketId: socket.id}
                );
                if ( result) {
                    users = await db.collection("chaUsers").find({});
                    io.emit('updateUsers', { users });
                }*/
            } catch(err) {
                console.log(err);
            }
        });
        socket.on('userJoin', async (msg) => {
            const data = {socketId: socket.id, username: msg.username }
            try {
                const user = await db.collection('chaUsers').insertOne(
                   data
                );
            } catch(err) {
                console.log(err);
            }
            io.emit('userJoin', data);
        });
        socket.on('chat', (msg) => {
            io.emit('chat', msg); // Broadcast the message to all clients
        });

        socket.on('typing', (msg) => {
            io.emit('typing', msg);
        });
    });
})();
