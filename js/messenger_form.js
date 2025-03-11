document
  .getElementById("message_form")
  .addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent page reload

    let formData = new FormData(this);

    fetch("send_message.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text()) // Convert response to text
      .then((data) => {
        document.getElementById("message_status").innerHTML = data; // Show response inside chat popup
        document.getElementById("message_form").reset(); // Clear the form
      })
      .catch((error) => {
        console.error("Error:", error);
        document.getElementById("message_status").innerHTML =
          "An error occurred. Please try again.";
      });
  });
