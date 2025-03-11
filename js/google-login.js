"use strict";

function handleCredentialResponse(response) {
  const data = response.credential;
  fetch("verify_token.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "token=" + response.credential,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        window.location.href = "index.php?login=success";
      } else {
        alert("Login failed.");
      }
    })
    .catch((error) => console.error("Error:", error));
}

window.onload = function () {
  google.accounts.id.initialize({
    client_id:
      "425696034712-7ns8jm05qgakn29cmkfvmaffv6bpnvp9.apps.googleusercontent.com",
    callback: handleCredentialResponse,
  });
  google.accounts.id.renderButton(document.getElementById("g_id_signin"), {
    theme: "outline",
    size: "large",
  });
};
