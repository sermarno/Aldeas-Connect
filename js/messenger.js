function toggleChatbox() {
  var chatPopup = document.querySelector(".chat-popup");
  if (chatPopup.style.display === "block") {
    chatPopup.style.display = "none";
  } else {
    chatPopup.style.display = "block";
  }
}
function closeChatbox() {
  document.querySelector(".chat-popup").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {
  const messageForm = document.getElementById("message-form");
  const messagesContainer = document.getElementById("messages-container");
  const recipientSelect = document.getElementById("recipient_id");

  function loadMessages() {
    const recipientId = recipientSelect.value;
    if (!recipientId) {
      messagesContainer.innerHTML =
        "<p>Select a recipient to view messages.</p>";
      return;
    }

    fetch(`fetch_messages.php?recipient_id=${recipientId}`)
      .then((response) => response.text())
      .then((data) => {
        messagesContainer.innerHTML = data || "<p>No messages yet.</p>";
      })
      .catch((error) => console.error("Error fetching messages:", error));
  }

  setInterval(loadMessages, 3000);

  recipientSelect.addEventListener("change", loadMessages);

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
