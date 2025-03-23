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



  //Testimonial Modal
  $(".review-testimonial-btn").click(function () {
    var testimonialId = $(this).data("id");
    var community = $(this).data("community");
    var category = $(this).data("category");
    var story = $(this).data("story");
    var videoUrl = $(this).data("video");


    //Populate
    $("#testimonial-id").val(testimonialId);
    $("#testimonial-community").text(community);
    $("#testimonial-category").text(category);
    $("#testimonial-story").text(story);

//For videos
let videoContainer = $("#testimonial-video-container");
videoContainer.empty(); // Clear any previous video
if (videoUrl) {
  let videoElement = $("<video>", {
    width: "100%",
    controls: true,
  });
  let source = $("<source>", {
    src: videoUrl,
    type: "video/mp4",
  });
  videoElement.append(source);
  videoContainer.append(videoElement);
}

//Show testimonial one
$("#testimonial-modal").show();
});

  // Close modal when 'X' button is clicked
  $(".close").click(function () {
    $("#review-modal").hide();
    $("#testimonial-modal").hide();
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

//For testimonial
$("#approve-testimonial-btn, #deny-testimonial-btn").click(function () {
  var action =
    $(this).attr("id") === "approve-testimonial-btn" ? "approve" : "deny";
  var testimonialId = $("#testimonial-id").val();
  var comment = $("#testimonial-comments").val();

  $.post(
    "process_testimonial.php",
    {
      testimonial_id: testimonialId,
      action: action,
      admin_comments: comment,
    },
    function (response) {
      alert(response);
      location.reload();
    }
  );
});
