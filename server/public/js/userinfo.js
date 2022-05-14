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
