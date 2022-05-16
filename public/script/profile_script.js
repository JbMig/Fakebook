// Test

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