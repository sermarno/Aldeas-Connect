$(document).ready(function () {
  $(".review-btn").click(function () {
    var requestId = $(this).data("id");
    var title = $(this).data("title");
    var description = $(this).data("description");
    var startDate = $(this).data("start");
    var endDate = $(this).data("end");
    var status = $(this).data("status");

    // Populate modal fields
    $("#request-id").val(requestId);
    $("#request-details").html(
      "<strong>Title:</strong> " +
        title +
        "<br>" +
        "<strong>Description:</strong> " +
        description +
        "<br>" +
        "<strong>Start Date:</strong> " +
        startDate +
        "<br>" +
        "<strong>End Date:</strong> " +
        endDate +
        "<br>" +
        "<strong>Status:</strong> " +
        status
    );

    // Show the modal
    $("#review-modal").show();
  });

  // Close modal when 'X' button is clicked
  $(".close").click(function () {
    $("#review-modal").hide();
  });

  // Handle approve/deny buttons
  $("#approve-btn, #deny-btn").click(function () {
    var action = $(this).attr("id") === "approve-btn" ? "approve" : "deny";
    var requestId = $("#request-id").val();
    var comment = $("#admin-comments").val();

    $.post(
      "process_request.php",
      { id: requestId, action: action, comment: comment },
      function (response) {
        alert(response);
        location.reload();
      }
    );
  });
});
