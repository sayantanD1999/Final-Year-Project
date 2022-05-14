i = 4;
s = 4;
function add_ingredient() {
  if (i <= 10) {
    let html = `<input class="inp2 ingr" type="text" placeholder="Ingredient ${i}">`;
    var div = document.createElement("DIV");
    var span = document.createElement("SPAN");
    span.innerHTML = "&times";
    span.setAttribute("class", "cross");
    span.onclick = function () {
      console.log(event.target.parentNode);
      event.target.parentNode.remove();
    };
    div.innerHTML = html;
    div.appendChild(span);
    console.log(div);
    document.getElementById("ingredients").appendChild(div);
    i++;
  } else {
    alert("You can add only 10 ingredients");
  }
}

function add_steps() {
  if (s <= 8) {
    let html = `<input class="inp2 steps" type="text" placeholder="Step ${s}">`;
    var div = document.createElement("DIV");
    var span = document.createElement("SPAN");
    span.innerHTML = "&times";
    span.setAttribute("class", "cross");
    span.onclick = function () {
      console.log(event.target.parentNode);
      event.target.parentNode.remove();
    };
    div.innerHTML = html;
    div.appendChild(span);
    document.getElementById("steps").appendChild(div);
    s++;
  } else {
    alert("You can add only 8 steps");
  }
}



function getting_user_img() {
  var img = document.getElementById("file-upload");
  console.log(img);
  if (img.files[0]) {
    console.log(2);
    var reader = new FileReader();
    reader.onload = function (e) {
      console.log(3);
      $("#user_img").attr("src", e.target.result).width(145).height(145);
      $("#user_img").css("border-radius", "80%");
    };
    reader.readAsDataURL(img.files[0]);
  }
}

// function get_recipe_details() {
//   var recipe_name = document.querySelector("#recipe_name").value;
//   var recipe_time = document.querySelector("#recipe_time").value;
//   var msg = document.querySelector("#quote").value;
//   var recipe_ingredients = document.querySelectorAll(".ingr");
//   var recipe_ingredients_value = [];
//   for (let i = 0; i < recipe_ingredients.length; i++) {
//     recipe_ingredients_value.push(recipe_ingredients[i].value);
//   }
//   var recipe_steps = document.querySelectorAll(".steps");
//   var recipe_steps_value = [];
//   for (let i = 0; i < recipe_steps.length; i++) {
//     recipe_steps_value.push(recipe_steps[i].value);
//   }

//   var recipe_type = " ";
//   var rt = document.getElementsByClassName("rt");
//   for (let i = 0; i < rt.length; i++) {
//     if (rt[i].checked == true) {
//       recipe_type += rt[i].value + " ";
//     }
//   }

//   console.log(
//     msg,
//     recipe_name,
//     recipe_time,
//     recipe_type,
//     recipe_ingredients_value,
//     recipe_steps_value
//   );
// }
