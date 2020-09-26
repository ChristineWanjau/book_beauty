var modal = document.querySelector("#myModal");

// Get the button that opens the modal
var btn = document.querySelectorAll("#myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function openModal(){
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function closeModal() {
modal.style.display = "none";
}

for (var i = 0 ; i< btn.length;i++){
btn[i].addEventListener('click',openModal);}

span.addEventListener('click',closeModal);
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}