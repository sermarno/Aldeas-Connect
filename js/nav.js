function openNav() {
  document.querySelector("#side_nav").style.width = "250px";
  document.querySelector(".all-over-bkg").classList.add("is-visible");
}

function closeNav() {
  document.querySelector("#side_nav").style.width = "0";
  document.querySelector(".all-over-bkg").classList.remove("is-visible");
}

document.querySelector(".openbtn").addEventListener("click", openNav);
document.querySelector(".closebtn").addEventListener("click", closeNav);
