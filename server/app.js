const path = require("path");
const express = require("express");
const fileupload = require("express-fileupload");
const session = require("express-session");
const cors = require("cors");

const fs = require("fs");
const formidable = require("formidable");

const mysql = require("mysql");
const Connection = require("mysql/lib/Connection");

const app = express();
// const port = process.env.PORT || 3004;
const PORT = 3005;
const bodyParser = require("body-parser");
app.use(bodyParser.json());
const cookieParser = require("cookie-parser");
const pool = mysql.createPool({
  connectionLimit: 10,
  host: "localhost",
  user: "root",
  password: "",
  database: "project-finalyear",
  multipleStatements: true,
});

app.use(
  cors({
    origin: ["http://localhost:3000"], //all the links in the website
    methods: ["GET", "POST"], //methods involved
    credentials: true,
  })
);

// Parsing middleware
// Parse application/x-www-form-urlencoded
app.use(express.urlencoded({ extended: true })); // New
// Parse application/json
app.use(express.json()); // New

app.use(
  session({
    // key: "id", //name of the cookie
    secret: "anylongsecret", //anythin but generally use large secrets for privacy
    resave: false,
    saveUninitialized: false,
    // cookie: {
    //   expires: 60 * 60 * 24, //takes millisecond until when the login should exist, here 24hrs
    // },
  })
);

// Static Files
app.use(express.static("public"));
app.use(express.static(__dirname + "/public"));
app.use(express.static("upload"));
app.use(express.static("./public"));
app.use("/", express.static(path.join(__dirname, "public")));
// app.use(express.static(__dirname + '/server'));
app.use(express.static(path.join(__dirname, "public")));
app.use(fileupload());

app.get("/pendingVerifications", (req, res) => {
  console.log("here");
  pool.getConnection((err, connection) => {
    if (err) throw err;
    connection.query(
      "SELECT * FROM items WHERE status = ?",
      ["Verification Pending"],
      (err, rows) => {
        connection.release();
        if (!err) {
          // res.send({ rows });
          res.render("pendingVerifications", { rows });
        } else {
          console.log("Error AJAX", rows);
        }
      }
    );
  });
});



const route = require("./server/routes/user");
const { constants } = require("buffer");
app.use("/", route);
// Listen on enviroment port or 3004

app.listen(process.env.PORT || PORT, () => {
  console.log(`Server listening on ${PORT}`);
});
