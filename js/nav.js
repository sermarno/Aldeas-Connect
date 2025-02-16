function openNav() {
  document.querySelector("#side_nav").style.width = "150px";
  document.querySelector(".all-over-bkg").classList.add("is-visible");
}

function closeNav() {
  document.querySelector("#side_nav").style.width = "0";
  document.querySelector(".all-over-bkg").classList.remove("is-visible");
}

document.querySelector(".openbtn").addEventListener("click", openNav);
document.querySelector(".closebtn").addEventListener("click", closeNav);

// making it to where the nav links will show if close btn clicked in mobile view
window.addEventListener("resize", function () {
  if (this.window.innerWidth >= 768) {
    this.document.getElementById("side_nav").style.width = "auto";
  } else {
    this.document.getElementById("side_nav").style.width = "0";
  }
});
