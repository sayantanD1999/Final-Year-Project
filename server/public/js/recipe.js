function openNav() {
  document.getElementsByClassName("overlay")[0].style.width = "100%";
  // document.getElementById("myBtn").style.display = "none";
}
function closeNav() {
  document.getElementsByClassName("overlay")[0].style.width = "0%";
  // document.getElementById("myBtn").style.display = "block";
}



document.getElementById("si").style.display = "block";
document.getElementById("si_btn").classList.add("active");

function set_tab(ele, e) {
  console.log(ele, e);
  var tab_btns = document.getElementsByClassName("tab_btns");
  for (let i = 0; i < tab_btns.length; i++) {
    tab_btns[i].classList.remove("active");
  }
  var tab = document.getElementsByClassName("tab_content");
  for (let i = 0; i < tab.length; i++) {
    tab[i].style.display = "none";
  }
  document.getElementById(e).style.display = "block";
  console.log(ele);
  ele.classList.add("active");
  closeNav();
}

document.getElementById("si").style.display = "block";
document.getElementById("si_btn").classList.add("active");


// function set_tab(ele, e) {
//   console.log(ele, e);
//   var tab_btns = document.getElementsByClassName("tab_btns");
//   for (let i = 0; i < tab_btns.length; i++) {
//     tab_btns[i].classList.remove("active");
//   }
//   var tab = document.getElementsByClassName("tab_content");
//   for (let i = 0; i < tab.length; i++) {
//     tab[i].style.display = "none";
//   }
//   document.getElementById(e).style.display = "block";
//   console.log(ele);
//   ele.classList.add("active");
// }

// var card = " ";
// for (let i = 0; i < 9; i++) {
//   card += `
//         <div class="card">
//             <img src="pics/bg3.jpg" class="card-img-top" alt="..." />
//             <br>
//             <div class="card_details">
//                 <p><b>Breakfast</b></p>
//                 <p><b>Verified</b> <i class="fas fa-check-circle"></i></p>
//               </div>
//             <h2 style="padding-left:20px">Header</h2>
//             <div class="card-content">
//               <div class="small_box">
//                 <i class="icons far fa-clock"></i>
//                 <p>30 mins</p>
//               </div>
//               <div class="small_box">
//                 <i class="icons fas fa-utensils"></i>
//                 <p>Serving</p>
//               </div>
//               <div class="small_box">
//                 <i class="icons far fa-grin-tongue"></i>
//                 <p>Beginner</p>
//               </div>
//             </div>
//             <div class="card-btn_div">
//               <button class="card-btn">
//                 Check Recipe <i class="fas fa-arrow-circle-right"></i>
//               </button>
//             </div>
//           </div>
//         `;
//   //   var div = document.createElement("DIV");
//   //   div.innerHTML = card;
//   var div2 = document.createElement("DIV");
//   div2.innerHTML = card;

//   var div3 = document.createElement("DIV");
//   div3.innerHTML = card;
//   var div4 = document.createElement("DIV");
//   div4.innerHTML = card;
// }

document.getElementsByClassName("north-indian")[0].append(div2);
document.getElementsByClassName("east-indian")[0].append(div3);
document.getElementsByClassName("west-indian")[0].append(div4);
