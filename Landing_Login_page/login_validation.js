document.querySelector(".login-form").addEventListener("submit", function (event) {
  let username = document.getElementById("username").value.trim();
  let password = document.getElementById("password").value.trim();
  let valid = true;

  if (username === "") {
    document.getElementById("nameerror").style.display = "block";
    valid = false;
  } else {
    document.getElementById("nameerror").style.display = "none";
  }

  if (password.length < 6) {
    document.getElementById("passworderror").style.display = "block";
    valid = false;
  } else {
    document.getElementById("passworderror").style.display = "none";
  }

  if (!valid) event.preventDefault();
});
