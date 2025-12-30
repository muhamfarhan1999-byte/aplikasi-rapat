document.addEventListener("DOMContentLoaded", function () {
  const uploadModal = document.getElementById("uploadFileModal");

  uploadModal.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;
    const idRapat = button.getAttribute("data-id");

    document.getElementById("upload-id").value = idRapat;
  });
});
