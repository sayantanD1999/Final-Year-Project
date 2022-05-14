// fetch("http://localhost:1000/pendingVerifications")
//   .then((response) => response.json())
//   .then((data) => {
//     console.log("Success:", data);
//   });

function checkNoOfRecipe() {
  var cards = document.getElementsByClassName("card");
  console.log(cards.length);
  if (cards.length == 1) {
    document.getElementsByClassName("alert-primary")[0].style.display = "block";
  }
}

function reject(name, email) {
  var recipe_name = name;
  var chef_email = email;
  var reason;

  var rip = document.getElementsByClassName("reason_ip");
  for (let i = 0; i < rip.length; i++) {
    if (rip[i].name == recipe_name) {
      reason = rip[i].value;
    }
  }

  const data = { recipe_name, chef_email, reason };
  const options = {
    method: "PATCH",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  };
  fetch("http://localhost:1000/rejectrecipe", options);
  setTimeout(function () {
    window.location = window.location;
  }, 500);
  checkNoOfRecipe();
}

function verify(name, email) {
  var recipe_name = name;
  var chef_email = email;

  const data = { recipe_name, chef_email };
  const options = {
    method: "PATCH",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  };
  fetch("http://localhost:1000/acceptrecipe", options);

  // setTimeout(location.reload(), 3000);
  setTimeout(function () {
    window.location = window.location;
  }, 500);
  checkNoOfRecipe();
}

var btn = document.getElementsByClassName("btn");
console.log(btn[0].innerText);
for (let i = 0; i < btn.length; i++) {
  if (btn[i].innerText == "Verification Pending") {
    btn[i].classList.add("btn-warning");
  }
  if (btn[i].innerText == "Verified") {
    btn[i].classList.add("btn-success");
  }
  if (btn[i].innerText == "Rejected") {
    btn[i].classList.add("btn-danger");
  }
}

function accordion(button) {
  console.log(button.parentElement.parentElement.parentElement.parentElement);
  var box = button.parentElement.parentElement.parentElement.parentElement;
  var section = box.querySelectorAll(".card-details")[0];
  console.log(section);

  section.classList.toggle("active");
  var panel = section;
  console.log(panel);
  if (panel.style.maxHeight) {
    panel.style.maxHeight = null;
    button.innerText = "See More";
  } else {
    panel.style.maxHeight = panel.scrollHeight + "px";
    button.innerText = "See Less";
  }
}
