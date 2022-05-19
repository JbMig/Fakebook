// Test
var cancel = document.querySelector("#cancel");
var newPublicationForm = document.querySelector("#newPublicationForm");
var form_modify_article = document.querySelector("#form_modify_article");

// open the pages list area
let open_pages_list = document.querySelectorAll("#open_pages_list");
open_pages_list.forEach(button => {
  let isVisiblepagesList = false;
  button.addEventListener("click", e => {
    const target = e.target;
    const toDisplay = target.nextElementSibling;
    isVisiblepagesList = !isVisiblepagesList;
    toDisplay.style.display = isVisiblepagesList ? "block" : "none";
    target.innerHTML = isVisiblepagesList ? "Replier la liste" : "Afficher les pages suivies"
  })
})

let open_comment = document.querySelectorAll("#open_comment");
open_comment.forEach(button => {
  let isVisibleComment = false;
  button.addEventListener("click", e => {
    const target = e.target;
    const toDisplay = target.nextElementSibling;
    isVisibleComment = !isVisibleComment;
    toDisplay.style.display = isVisibleComment ? "block" : "none";
    target.innerHTML = isVisibleComment ? "Annuler" : "Comment"
  })
})

// cancel new article
function cancel_new_post() {
  console.log("coucou");
    newPublicationForm.reset();
    var p=document.querySelector("#preview");
    p.innerHTML="";
    p.style.display="none";
}
cancel.addEventListener("click", cancel_new_post);



let open_new_page = document.querySelectorAll("#open_new_page");
open_new_page.forEach(button => {
  let isVisibleName = false;
  button.addEventListener("click", e => {
    const target = e.target;
    const toDisplay = target.nextElementSibling;
    isVisibleName = !isVisibleName;
    toDisplay.style.display = isVisibleName ? "block" : "none";
    target.innerHTML = isVisibleName ? "Annuler" : "Créer une page publique"
  })
})



// open modify article form
let open_modify_article = document.querySelectorAll("#open_modify_article");
open_modify_article.forEach(button => {
  let isVisible = false;
  button.addEventListener("click", e => {
    const target = e.target;
    const toDisplay = target.nextElementSibling;
    console.log("je suis là");
    isVisible = !isVisible;
    toDisplay.style.display = isVisible ? "block" : "none";
    target.innerHTML = isVisible ? "Annuler" : "Modifier"
  })
})
