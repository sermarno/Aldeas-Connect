$(document).ready(function () {
  $(".review-btn").click(function () {
    var requestId = $(this).data("id");
    $("#request-id").val(requestId);
    $("#request-details").text("Loading details for request ID: " + requestId);

    // Show modal
    $("#review-modal").show();
  });

  $(".close").click(function () {
    $("#review-modal").hide();
  });

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
