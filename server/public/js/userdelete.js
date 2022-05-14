function delete_user(email) {
  console.log(email);
  var user_email = email;
  const data = { user_email };
  const options = {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  };
  fetch("http://localhost:1000/userDelete", options);
  setTimeout(function () {
    location.reload();
  }, 500);
  console.log("fe");
}
