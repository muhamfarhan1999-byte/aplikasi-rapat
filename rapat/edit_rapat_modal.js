document.addEventListener("DOMContentLoaded", () => {
  const editModal = document.getElementById("editDataModal");

  editModal.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;
    if (!button) return;

    const getData = (attr) => (button.getAttribute(attr) || "").trim();

    document.getElementById("edit-id-rapat").value = getData("data-id");
    document.getElementById("edit-id-view").value = getData("data-id");
    document.getElementById("edit-judul").value = getData("data-judul");
    document.getElementById("edit-status").value = getData("data-status");
    document.getElementById("edit-tempat").value = getData("data-tempat");
    document.getElementById("edit-tanggal").value = getData("data-tanggal");
    document.getElementById("edit-waktu").value = getData("data-waktu");
    document.getElementById("edit-deskripsi").value = getData("data-deskripsi");
  });
});
