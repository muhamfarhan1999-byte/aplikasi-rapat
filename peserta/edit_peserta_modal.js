document.addEventListener("DOMContentLoaded", function () {
  var editButtons = document.querySelectorAll(".edit-button");
  editButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      document.getElementById("edit_id").value = this.getAttribute("data-id");
      document.getElementById("edit_username").value = this.getAttribute("data-username");
      document.getElementById("edit_password").value = this.getAttribute("data-password");
      document.getElementById("edit_role").value = this.getAttribute("data-role");
    });
  });
});
