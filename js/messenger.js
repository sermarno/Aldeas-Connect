function toggleChatbox() {
  var chatPopup = document.querySelector(".chat-popup");
  if (chatPopup.style.display === "block") {
    chatPopup.style.display = "none";
  } else {
    chatPopup.style.display = "block";
  }
}

function closeChatbox() {
  const chatPopup = document.querySelector(".chat-popup");
  if (chatPopup) {
    chatPopup.style.display = "none";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const messageForm = document.getElementById("message-form");
  const messagesContainer = document.getElementById("messages-container");
  const recipientSelect = document.getElementById("recipient_id");

  // Ensure elements exist before continuing
  if (!messageForm || !messagesContainer || !recipientSelect) {
    console.error("One or more required elements are missing from the DOM.");
    return; // Exit the function if any element is missing
  }

  function loadMessages() {
    let recipient_id = document.getElementById("recipient_id").value;
    // This function now fetches messages for the current logged-in user
    fetch("fetch_messages.php?recipient_id=" + recipient_id) // Assuming the server-side fetch function can return all messages for the current user
      .then((response) => response.text())
      .then((data) => {
        messagesContainer.innerHTML = data || "<p>No messages yet.</p>";
      })
      .catch((error) => console.error("Error fetching messages:", error));
  }

  // Load messages every 3 seconds
  setInterval(loadMessages, 3000);

  // Load messages when the page first loads
  loadMessages();

  // Event listener for when the recipient changes
  recipientSelect.addEventListener("change", loadMessages);

  // Handle the form submission for sending messages
  messageForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(messageForm);
    formData.append("recipient_id", recipientSelect.value);

    fetch("send_message.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data === "success") {
          messageForm.reset();
          loadMessages();
        } else {
          console.error("Message sending failed:", data);
        }
      })
      .catch((error) => console.error("Error sending message:", error));
  });
});
