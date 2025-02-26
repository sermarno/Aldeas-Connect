"use strict";

document.addEventListener("DOMContentLoaded", function () {
  const container = document.querySelector(".proj-grid");
  const cards = document.querySelectorAll(".proj-card");
  let currentIndex = 0;

  // Ensure the container is wide enough for all cards
  container.style.width = `${cards.length * 100}%`;

  function showCard(index) {
    const cardWidth = cards[0].offsetWidth; // Get the width of one card
    container.style.transform = `translateX(${-index * cardWidth}px)`;
  }

  document.getElementById("backbtn").addEventListener("click", function () {
    currentIndex = currentIndex > 0 ? currentIndex - 1 : cards.length - 1;
    showCard(currentIndex);
  });

  document.getElementById("nextbtn").addEventListener("click", function () {
    currentIndex = currentIndex < cards.length - 1 ? currentIndex + 1 : 0;
    showCard(currentIndex);
  });

  // Ensure initial card is visible
  showCard(currentIndex);
});
