const res = require("express/lib/response");
const mysql = require("mysql");
const Connection = require("mysql/lib/Connection");
var back = require("express-back");

const bcrypt = require("bcrypt");
const saltRounds = 10;

const { append } = require("express/lib/response");
const session = require("express-session");
const { path } = require("express/lib/application");

const pool = mysql.createPool({
  connectionLimit: 1000,
  connectTimeout: 60 * 60 * 1000,
  acquireTimeout: 60 * 60 * 1000,
  timeout: 60 * 60 * 1000,
  host: "localhost",
  user: "root",
  password: "",
  database: "project_finalyear",
  multipleStatements: true,
});

//USERS

// exports.home = (req, res) => {
//   res.render("home");
// };
const multer = require("multer");

var multerConfig = multer.diskStorage({
  destination: (req, file, callBack) => {
    callBack(null, "./public/images/"); // './public/images/' directory name where save the file
  },
  filename: (req, file, callBack) => {
    callBack(
      null,
      file.fieldname + "-" + Date.now() + path.extname(file.originalname)
    );
  },
});

var upload = multer({
  storage: multerConfig,
});

exports.uploadImage = upload.single("photo");

exports.signup = (req, res) => {
  const { name, email, password, user_image } = req.body;
  console.log(req.body);
  console.log(req.files.file);
  console.log(req.files.file.name);
  let user_img_name = req.files.file.name;

  uploadPath =
    require("path").resolve("./") + "/public/user_image/" + user_img_name;

  console.log(uploadPath);

  let sampleFile = req.files.file;

  pool.getConnection((err, connection) => {
    if (err) throw err;
    sampleFile.mv(uploadPath, function (err) {
      bcrypt.hash(password, saltRounds, (err, hash) => {
        if (err) {
          console.log(err);
        } else {
          connection.query(
            "SELECT * FROM tbl_user WHERE user_userid = ?",
            [email],
            (err, rows) => {
              if (!err) {
                if (rows.length == 0) {
                  connection.query(
                    "INSERT INTO tbl_user SET user_name = ?, user_userid = ?, user_pass = ?,image=?, status=?;",
                    [name, email, hash, user_img_name, "loggedin"],
                    (err, rows) => {
                      if (!err) {
                        connection.query(
                          "SELECT * FROM tbl_user where user_userid = ?",
                          [email],
                          (err, rows) => {
                            connection.release();
                            console.log(rows);
                            if (!err) {
                              res.send({ statusCode: 200, data: rows });
                            } else {
                              console.log("error in fetching userid", err);
                            }
                          }
                        );
                      } else {
                        console.log("error in creation signup here", err);
                      }
                    }
                  );
                } else {
                  res.send({ statusCode: 400, msg: "Email Id already exists" });
                }
              } else {
                console.log("error in creation signup", rows);
              }
            }
          );
        }
      });
    });
  });
};

exports.login = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    console.log(req.body);
    const { email, password } = req.body.obj;
    console.log(email);

    connection.query(
      "SELECT * FROM tbl_user WHERE user_userid = ?",
      [email],
      (err, rows) => {
        console.log(rows[0]);
        if (rows.length != 0) {
          bcrypt.compare(password, rows[0].user_pass, (err, response) => {
            if (response) {
              console.log(response);
              var val = rows;
              var sql =
                "UPDATE tbl_user SET status = 'loggedin' WHERE user_userid = ?;";
              connection.query(sql, [email], (err, rows) => {
                connection.release();
                if (!err) {
                  req.session.isAuth = true;
                  res.send({
                    val,
                    statusCode: 200,
                  });
                } else {
                  console.log("Error Rows login", rows);
                }
              });
            } else {
              res.send({ msg: "Invalid Credentials" });
            }
          });
        } else {
          res.send({ msg: "No Such User Found" });
        }
      }
    );
  });
};

exports.recipefeed = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    console.log("Recipefeed", req.params.email);
    console.log(req.params.email);

    connection.query(
      "SELECT * FROM tbl_user WHERE user_userid = ?",
      [req.params.email],
      (err, rows) => {
        var val = rows;
        var sql =
          "UPDATE tbl_user SET status = 'loggedin' WHERE user_userid = ?; SELECT * FROM tbl_food WHERE status=?;";
        connection.query(
          sql,
          [
            req.params.email,
            // "verified",
            "checked",
          ],
          (err, rows) => {
            connection.release();
            console.log(rows[1]);
            let val = rows[1];
            if (!err) {
              req.session.isAuth = true;
              res.send({
                val,
              });
            } else {
              console.log("Error Rows login", rows);
            }
          }
        );
      }
    );
  });
};

exports.getSpecifiRecipe = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    console.log(req.params.foodId);
    connection.query(
      "SELECT * FROM tbl_food WHERE id=?",
      [req.params.foodId],
      (err, rows) => {
        connection.release();
        if (!err) {
          res.send({ rows });
          // console.log(rows);
        } else {
          console.log("Error", err);
        }
      }
    );
  });
};

exports.userinfo = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    console.log("Email", req.params.email);
    connection.query(
      "SELECT * FROM tbl_user WHERE user_userid = ?;SELECT * FROM tbl_food WHERE email = ?",
      [req.params.email, req.params.email],
      (err, rows) => {
        connection.release();
        if (!err) {
          var row1 = rows[0];
          var row2 = rows[1];
          console.log(rows);
          res.send({ row1, row2 });
          // console.log(rows);
        } else {
          console.log("Error Rows userinfo", err);
        }
      }
    );
  });
};

exports.submitMsg = (req, res) => {
  pool.getConnection((err, connection) => {
    console.log(req.body);
    const { name, email, msg } = req.body.obj;

    let date = new Date().toLocaleDateString();

    console.log(date);

    if (err) throw err;
    connection.query(
      "INSERT INTO message SET user_userid = ?, name=?, date = ?, content=?",
      [email, name, date, msg],
      (err, rows) => {
        if (!err) {
          // res.status(204).send();
          res.send({ msg: "good" });
        } else {
          console.log("There is an error", err);
        }
      }
    );
  });
};

exports.submitrecipe = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    // console.log(req.files.file);
    console.log(req.body);
    const {
      email,
      name,
      time,
      recipetype,
      description,
      ingredients,
      procedure,
      category,
      subcategory,
      userid,
      region,
      author,
    } = req.body;

    // name of the input is recipe_img
    var recipe_img = req.files.file.name;
    uploadPath = require("path").resolve("./") + "/public/upload/" + recipe_img;

    console.log(uploadPath);

    let sampleFile = req.files.file;
    sampleFile.mv(uploadPath, function (err) {
      connection.query(
        "INSERT INTO tbl_food SET user_id = ?, email=?, food=?, time = ?, type=?, image_name=?, description=?, ingredients=?, proce=?, status=?, category_id=?, subcategory_id=?,region=?,author=?",
        [
          userid,
          email,
          name,
          time,
          recipetype,
          recipe_img,
          description,
          ingredients,
          procedure,
          "",
          category,
          subcategory,
          region,
          author,
        ],
        (err, rows) => {
          if (!err) {
            res.send({ msg: "Recipe Added Succesfully", statusCode: 200 });

            console.log("Success");
          } else {
            console.log("Error Rows recipe upload here", err);
          }
        }
      );
    });
  });
};

exports.edituser = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    connection.query(
      "SELECT * FROM tbl_user WHERE user_userid = ?",
      [req.params.email],
      (err, rows) => {
        connection.release();
        if (!err) {
          console.log(rows);
          res.send({ rows });
          // console.log(rows);
        } else {
          console.log("Error Rows edituser", rows);
        }
      }
    );
  });
};

exports.update = (req, res) => {
  // User the connection
  pool.getConnection((err, connection) => {
    if (err) throw err;
    const { name, email, phone, password } = req.body.obj;
    console.log(req.body);
    connection.query(
      "UPDATE tbl_user SET user_name = ?, user_userid = ?, phone = ?, user_pass = ? WHERE user_userid = ?",
      [name, email, phone, password, req.params.email],
      (err, rows) => {
        if (!err) {
          // User the connection
          connection.query(
            "SELECT * FROM tbl_user WHERE user_userid = ?",
            [req.params.email],
            (err, rows) => {
              // When done with the connection, release it
              connection.release();
              if (!err) {
                console.log("update", rows);
                // res.send({ row });
              } else {
                console.log(err);
              }
              console.log("Update  The data from tbl_user table: \n", rows);
            }
          );
        } else {
          console.log(err);
        }
        console.log("Update The data from user table: \n", rows);
      }
    );
  });
};

exports.logout = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    console.log(req.params.email, "logout");
    connection.query(
      "UPDATE tbl_user SET status = 'loggedout' WHERE user_userid = ?",
      [req.params.email],
      (err, rows) => {
        connection.release();
        if (!err) {
          req.session.destroy();
          // res.redirect("/");
          res.send({ statusCode: 200 });
          // console.log(rows);
        } else {
          console.log("User Logout Error Rows", rows);
        }
      }
    );
  });
};

//ADMIN
exports.adminlogin = (req, res) => {
  // res.render("add-user");
  pool.getConnection((err, connection) => {
    if (err) throw err;
    const { email, password } = req.body;
    connection.query(
      "SELECT * FROM admin WHERE email = ? AND password = ?",
      [email, password],
      (err, rows) => {
        // console.log(rows);
        if (!err && rows.length != 0) {
          connection.query(
            "SELECT * FROM tbl_user; SELECT * FROM admin WHERE email = ?; UPDATE admin SET status = 'loggedin' WHERE email = ?",
            [email, email],
            (err, rows) => {
              // When done with the connection, release it
              connection.release();
              if (!err) {
                req.session.isAuth = true;
                res.render("admin", {
                  row1: rows[0],
                  row2: rows[1],
                });
                // console.log("admin login",rows,email);
              } else {
                console.log(err);
              }
              // console.log("Admin Login The data from user table: \n", rows);
            }
          );
        } else {
          res.render("adminlogin", {
            alert: "Invalid Credentials",
          });
          console.log("Admin Login Error Rows", rows);
        }
      }
    );
  });
};

exports.adminlogout = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    connection.query(
      "UPDATE admin SET status = 'loggedout' WHERE email = ?",
      [req.params.email],
      (err, rows) => {
        connection.release();
        if (!err) {
          req.session.destroy();
          res.redirect("/");
          // console.log("Admin logout");
        } else {
          console.log("Amin Logout Error Rows", rows);
        }
      }
    );
  });
};

exports.msgBox = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    connection.query("SELECT * FROM message", (err, rows) => {
      connection.release();
      if (!err) {
        res.render("message", { rows });
        // console.log(rows);
      } else {
        console.log("Error messageBox", err);
      }
    });
  });
};

exports.userdelete = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    const { user_email } = req.body;
    console.log(req.body);
    connection.query(
      "DELETE FROM user WHERE email = ?",
      [user_email],
      (err, rows) => {
        connection.release();
        if (!err) {
          console.log("be");
          res.status(204).send({ alert: "Deleted" });
        } else {
          console.log("Admin Logout Error Rows", rows);
        }
      }
    );
  });
};

exports.rejectrecipe = (req, res) => {
  console.log("reject", req.body);
  pool.getConnection((err, connection) => {
    if (err) throw err;
    const { recipe_name, chef_email, reason } = req.body;
    connection.query(
      "UPDATE items SET status = ?,reason = ? WHERE email = ? AND name=?",
      ["Rejected", reason, chef_email, recipe_name],
      (err, rows) => {
        connection.release();
        if (!err) {
          res.status(204).send();
        } else {
          console.log("Error AJAX", err);
        }
      }
    );
  });
};

exports.acceptrecipe = (req, res) => {
  console.log("accept", req.body);
  pool.getConnection((err, connection) => {
    if (err) throw err;
    const { recipe_name, chef_email } = req.body;
    connection.query(
      "UPDATE items SET status = ? WHERE email = ? AND name=?",
      ["Verified", chef_email, recipe_name],
      (err, rows) => {
        connection.release();
        if (!err) {
          res.status(204).send();
        } else {
          console.log("Error AJAX", err);
        }
      }
    );
  });
};

exports.viewuser = (req, res) => {
  pool.getConnection((err, connection) => {
    if (err) throw err;
    connection.query(
      "SELECT * FROM user WHERE email = ?; SELECT * FROM items WHERE email = ?;",
      [req.params.email, req.params.email],
      (err, rows) => {
        connection.release();
        if (!err) {
          var row1 = rows[0];
          var row2 = rows[1];
          res.render("viewuser", { row1, row2 });
          // console.log(rows);
        } else {
          console.log("Error Rows userinfo", rows);
        }
      }
    );
  });
};
