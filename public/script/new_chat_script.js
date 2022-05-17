let firstFriend = document.querySelector("#friend");
let sendFormBtn = document.querySelector("#valider");
let addFriend = document.querySelector("#add_friend");
let formValidate = document.querySelector("#form_validate");
let select = document.querySelector("#select");
function addValue() {
    if (!firstFriend.value){
        firstFriend.value = select.value
        firstFriend.type = "text";
    } else {
        newInput = document.createElement("input");
        newInput.id = "friend";
        newInput.type = "text";
        newInput.value = select.value;
        newInput.className = "col-md-8 mx-5";
        formValidate.appendChild(newInput);
        formValidate.insertAdjacentElement("beforeend", sendFormBtn);
    }
}

addFriend.addEventListener("click", addValue);

function changeName() {
    if (!firstFriend.value){
        alert("Ajouter un ami");
    }
    let input = document.querySelectorAll("#friend");
    row = input.length;
    for (let i = 0; i < row; i++) {
        let name = "friend" + i;
        input[i].name = name;
    }
    
}

sendFormBtn.addEventListener("click", changeName);