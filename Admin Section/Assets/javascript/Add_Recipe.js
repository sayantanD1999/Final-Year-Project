i=4;
s=4;
function add_ingredient(){
    let html = `<input class="inp2" type="text" placeholder="Ingredient ${i}">`;
    var div = document.createElement("DIV");
    var span = document.createElement("SPAN");
    span.innerHTML = "&times";
    span.setAttribute('class','cross')
    span.onclick=function(){
        console.log(event.target.parentNode);
        event.target.parentNode.remove();
    }
    div.innerHTML = html;
    div.appendChild(span);
    console.log(div);
    document.getElementById('ingredients').appendChild(div);
    i++;
}



function add_steps(){
    let html = `<input class="inp2" type="text" placeholder="Step ${s}">`;
    var div = document.createElement("DIV");
    var span = document.createElement("SPAN");
    span.innerHTML = "&times";
    span.setAttribute('class','cross')
    span.onclick=function(){
        console.log(event.target.parentNode);
        event.target.parentNode.remove();
    }
    div.innerHTML = html;
    div.appendChild(span);
    document.getElementById('steps').appendChild(div);
    s++;
}

function getting_user_img() {
    var img = document.getElementById('file-upload');
    console.log(img);
    if (img.files[0]) {
        console.log(2);
        var reader = new FileReader();
        reader.onload = function (e) {
            console.log(3);
            $('#user_img')
                .attr('src', e.target.result)
                .width(145)
                .height(145);
                $('#user_img').css('border-radius','80%');
        };
        reader.readAsDataURL(img.files[0]);
    }
}


