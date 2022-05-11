var cancel = document.querySelector("#cancel");
var newPublicationForm = document.querySelector("#newPublicationForm");
var form_modify_article = document.querySelector("#form_modify_article");


// cancel new article
function cancel_new_post() {
    newPublicationForm.reset();
    var p=document.querySelector("#preview");
    p.innerHTML="";
    p.style.display="none";
}
cancel.addEventListener("click", cancel_new_post);

// open modify article form
let open_modify_article = document.querySelectorAll("#open_modify_article");
open_modify_article.forEach(button => {
  let isVisible = false;
  button.addEventListener("click", e => {
    const target = e.target;
    const toDisplay = target.nextElementSibling;
    isVisible = !isVisible;
    toDisplay.style.display = isVisible ? "block" : "none";
    target.innerHTML = isVisible ? "Annuler" : "Modifier"
  })
})

// drag n drop
var new_image_input = document.querySelector("#fileToUpload");
var depose = document.querySelector("#depose");

depose.addEventListener("click", function(evt) {
    evt.preventDefault();
    new_image_input.click();
    new_image_input.addEventListener("change", openVignette);
  });
  
  depose.addEventListener("dragover", function(evt) {
    evt.preventDefault();
  });
  depose.addEventListener("dragenter", function() {
    this.className="onDropZone";
  });
  depose.addEventListener("dragleave", function() {
    this.className="";
  }); 
  depose.addEventListener("drop", function(evt) {
    evt.preventDefault();
    new_image_input.files=evt.dataTransfer.files;
    this.className="";
    openVignette()
  });
  
  // affiche la mignature de l'image upload
  function openVignette() {
    var p=document.querySelector("#preview");
    p.innerHTML="";
    for (var i=0; i<new_image_input.files.length; i++) {
      var f=new_image_input.files[i];
      var div=document.createElement("div");
      div.className="fichier";
      var vignette=document.createElement("img");
      vignette.src = window.URL.createObjectURL(f);
      div.appendChild(vignette);
      p.appendChild(div);
    }
    p.style.display="block"; 
  };
