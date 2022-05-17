// section.scrollTop = scroll.scrollHeight;
setInterval(() => {
    let section = document.querySelector("#section_message");
    fetch("/chat2")
        .then(res => res.json())
        .then(data => {
            section.innerHTML = "";
            var name = "";
            var color = "";
            var margin = "";
            let user = data.user;
            let members = data.members;
            data.messages.forEach(element => {
                if(element.user_id == user.user_id) {
                    name = user.first_name + " " + user.last_name;
                    color = "#3CFEAF";
                    margin = "300px";
                } else {
                    members.forEach(membrs => {
                        if(membrs.user_id === element.user_id) {
                            name = membrs.first_name + " " + membrs.last_name;
                            color = "#99E7FF";
                            margin = "0px";
                        }
                    })
                }
                div = document.createElement("div");
                div.style.margin = "10px";
                div.style.marginLeft = margin;

                
                section.appendChild(div);
                span = document.createElement("span");
                span.style.border = "1px solid black";
                span.style.padding = "5px";
                span.style.borderRadius = "5px";
                span.style.backgroundColor = color;
                span.innerHTML = name + ": " + element.content;
                div.appendChild(span);
            });
        });
}, 2000);
var new_message = document.querySelector("#new_message");
var new_message_btn = document.querySelector("#new_message_btn");
function send_message() {
    fetch("/new_message")
}

new_message_btn.addEventListener("click", send_message);
