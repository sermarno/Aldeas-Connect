var modal = document.getElementById("projectModal");
var span = document.getElementsByClassName("close")[0];

function openModal(projectId, communityId) {
  fetchProjectData(projectId, communityId);
  modal.style.display = "block";
}

// Function to fetch project data via AJAX (or PHP)
function fetchProjectData(projectId, communityId) {
  var projectTitle = document.querySelector(
    `[data-project-id="${projectId}"] h3`
  ).innerText;
  var projectDescription = document.querySelector(
    `[data-project-id="${projectId}"] p`
  ).innerText;
  var projectImage = document.querySelector(
    `[data-project-id="${projectId}"] .proj-image`
  ).src;

  var communityName = communityId;
  var startDate = "Start Date: 2022-06-05";
  var communityDetailsLink =
    "community_details.php?community_id=" + communityId;

  // Set the modal content
  document.getElementById("modalTitle").innerText = projectTitle;
  document.getElementById("modalDescription").innerText = projectDescription;
  document.getElementById("modalImage").src = projectImage;
  document.getElementById("modalCommunity").innerText =
    "Community: " + communityName;
  document.getElementById("modalStartDate").innerText = startDate;
  document.getElementById("communityDetailsLink").href = communityDetailsLink;
}

span.onclick = function () {
  modal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

// Add event listener for clicking on each project card
document.querySelectorAll(".proj-card").forEach(function (card) {
  card.addEventListener("click", function () {
    var projectId = this.getAttribute("data-project-id");
    var communityId = this.getAttribute("data-community-id");
    openModal(projectId, communityId);
  });
});
