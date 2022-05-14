function getting_img(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#set_img')
                .attr('src', e.target.result)
                .width(145)
                .height(145);
                $('#set_img').css('border-radius','80%');
        };

        reader.readAsDataURL(input.files[0]);
    }
}


function get_img() {
    var ip = document.querySelector('#get_img');
    ip.click();
}


function login() {
    document.getElementsByClassName('get-in')[0].style.display = "block";
    document.querySelector('#log-in').style.display = "block";
}
function signup() {
    document.getElementsByClassName('get-in')[0].style.display = "block";
    document.querySelector('#sign-up').style.display = "block";
}

function toggle_password(e) {
    if (e == "login_show_password") {

        var ip = document.querySelector('#login_show_password');
        if (ip.checked) {
            document.querySelector('#login_pswd').type = "text";
        }
        else {
            document.querySelector('#login_pswd').type = "password";
        }
    }
    if (e == "signup_show_password") {

        var ip = document.querySelector('#signup_show_password');
        if (ip.checked) {
            document.querySelector('#signup_pswd').type = "text";
            document.querySelector('#signup_re-pswd').type = "text";
        }
        else {
            document.querySelector('#signup_pswd').type = "password";
            document.querySelector('#signup_re-pswd').type = "password";
        }
    }
}

function check_password_similarity() {
    console.log('ps')
    var p1 = document.querySelector('#signup_pswd').value;
    var p2 = document.querySelector('#signup_re-pswd').value;
    if (p1 != p2) {
        document.querySelector('#pswd_msg').style.display = "block";
    }
    else {
        document.querySelector('#pswd_msg').style.display = "none";
    }
}



// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    var modal = document.getElementsByClassName('get-in')[0];
    // var div_id = modal.children[0].id; 
    // console.log(div_id);
    if (event.target == modal) {
        document.getElementById("sign-up").style.display = "none";
        document.getElementById("log-in").style.display = "none";
        modal.style.display = "none";
    }
}

window.onscroll=()=>{
    console.log(window.Top);
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200){
        document.querySelectorAll('.fixed_nav')[0].style.backgroundColor="black";
    }
    else{
        document.querySelectorAll('.fixed_nav')[0].style.background="transparent";

    }
}


