let firstFriend = document.querySelector("#friend");
let sendFormBtn = document.querySelector("#valider");
let addFriend = document.querySelector("#add_friend");
let formValidate = document.querySelector("#form_validate");
let select = document.querySelector("#select");
function addValue() {
    let splitSelect = ""
    if (!firstFriend.value){
        splitSelect = select.value.split(" ")
        firstFriend.value = splitSelect[0];
        firstFriend.type = "text";
        firstFriend.style.display = "none";
    } else {
        splitSelect = select.value.split(" ")
        newInput = document.createElement("input");
        newInput.id = "friend";
        newInput.type = "text";
        newInput.value = splitSelect[0];
        newInput.className = "col-md-8 mx-5";
        newInput.style.display = "none";
        formValidate.appendChild(newInput);
    }
    let newLabel = document.createElement("input");
    newLabel.value = splitSelect[1] + " " + splitSelect[2]
    newLabel.className = "col-md-8 mx-5";
    formValidate.appendChild(newLabel);
    formValidate.insertAdjacentElement("beforeend", sendFormBtn);
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