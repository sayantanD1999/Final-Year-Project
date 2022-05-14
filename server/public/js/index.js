

function toggle_password(e) {
  if (e == "login_show_password") {
    var ip = document.querySelector("#login_show_password");
    if (ip.checked) {
      document.querySelector("#login-pswd").type = "text";
    } else {
      document.querySelector("#login-pswd").type = "password";
    }
  }
  if (e == "signup_show_password") {
    var ip = document.querySelector("#signup_show_password");
    if (ip.checked) {
      document.querySelector("#signup_pswd").type = "text";
      document.querySelector("#signup_re-pswd").type = "text";
    } else {
      document.querySelector("#signup_pswd").type = "password";
      document.querySelector("#signup_re-pswd").type = "password";
    }
  }

  if (e == "admin_show_password") {
    var ip = document.querySelector("#admin_show_password");
    if (ip.checked) {
      document.querySelector("#admin-pswd").type = "text";
    } else {
      document.querySelector("#admin-pswd").type = "password";
    }
  }
}

function check_password_similarity() {
  console.log("ps");
  var p1 = document.querySelector("#signup_pswd").value;
  var p2 = document.querySelector("#signup_re-pswd").value;
  if (p1 != p2) {
    document.querySelector("#pswd_msg").style.display = "block";
  } else {
    document.querySelector("#pswd_msg").style.display = "none";
  }
}


window.onscroll = () => {
  console.log(window.Top);
  if (
    document.body.scrollTop > 200 ||
    document.documentElement.scrollTop > 200
  ) {
    document.querySelectorAll(".fixed_nav")[0].style.backgroundColor = "black";
  } else {
    document.querySelectorAll(".fixed_nav")[0].style.background = "transparent";
  }
};

function openNav() {
  document.getElementsByClassName("overlay")[0].style.width = "100%";
  // document.getElementById("myBtn").style.display = "none";
}
function closeNav() {
  document.getElementsByClassName("overlay")[0].style.width = "0%";
  // document.getElementById("myBtn").style.display = "block";
}

document.addEventListener("mouseup", function (e) {
  var container = document.getElementsByClassName("overlay")[0];
  if (!container.contains(e.target) || container.contains(e.target)) {
    document.getElementsByClassName("overlay")[0].style.width = "0%";
    // document.getElementById("myBtn").style.display = "block";
  }
});
// window.onload = function () {
//   var fileUpload = document.getElementById("user_image");
//   fileUpload.onchange = function () {
//     if (typeof FileReader != "undefined") {
//       var dvPreview = document.getElementById("img_container");
//       dvPreview.innerHTML = "";
//       var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
//       for (var i = 0; i < fileUpload.files.length; i++) {
//         var file = fileUpload.files[i];
//         if (regex.test(file.name.toLowerCase())) {
//           var reader = new FileReader();
//           reader.onload = function (e) {
//             // setSrc(e.target.result);
//             var img = document.createElement("IMG");
//             img.id = "img";
//             // img.name = "user_image";
//             img.height = 100;
//             img.width = 100;
//             img.src = e.target.result;
//             dvPreview.appendChild(img);
//           };
//           reader.readAsDataURL(file);
//         } else {
//           alert(file.name + " is not a valid image file.");
//           dvPreview.innerHTML = "";
//           return false;
//         }
//       }
//     } else {
//       alert("This browser does not support HTML5 FileReader.");
//     }
//   };
// };

// $("#signup").on("click", function () {
//   $.get("/", function (data) {
//     console.log(data);
//   });
// });

// document.forms[0].onsubmit = async function (e) {
//   console.log(e);
//   e.preventDefault();
//   const response = await fetch("http://localhost:1000/admin");
//   // console.log(response);
//   const msg = await response.json();
//   console.log(msg);
//   return false;
// };

// document.forms[0].onsubmit = function (e) {
//   console.log(e);
//   e.preventDefault();
//   const formData = new FormData(this);

//   fetch("http://localhost:1000/admin", {
//     method: "POST",
//     body: formData,
//   })
//     .then(function (response) {
//       return response.text();
//     })
//     .then(function (text) {
//       console.log(text);
//     })
//     .catch(function (error) {
//       console.log(error);
//     });
//   return false;
// };

// document.forms[1].onsubmit = function (e) {
//   console.log(e);
//   e.preventDefault();
//   const formData = new FormData(this);

//   fetch("http://localhost:1000/recipe", {
//     method: "POST",
//     body: formData,
//   })
//     .then(function (response) {
//       return response.text();
//     })
//     .then(function (text) {
//       console.log(text);
//     })
//     .catch(function (error) {
//       console.log(error);
//     });
// };

// document.getElementById("login").onclick = async (e) => {
//   var email = document.getElementById("login-email").value;
//   var password = document.getElementById("login-pswd").value;
//   const data = { email, password };
//   const options = {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/json",
//     },
//     body: JSON.stringify(data),
//   };
//   fetch("http://localhost:1000/recipe", options);

//   console.log(e);
//   e.preventDefault();
//   const response = await fetch("http://localhost:1000/recipe");
//   // console.log(response);
//   const msg = await response.json();
//   console.log(msg);
//   return false;
// };

// async function submit_login() {
//   // e.preventDefault();
//   console.log(2);
//   const response = await fetch("http://localhost:1000/recipe");
//   console.log(response);
//   const msg = await response.json();
//   return false;
// }

// $("#login").on("click", function () {
//   $.get("/recipe", function (data) {
//     console.log(data);
//   });
// });
