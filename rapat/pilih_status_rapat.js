document.addEventListener("DOMContentLoaded", function () {
  const statusSelect = document.getElementById("statusTambah");
  const fieldTempat = document.getElementById("field_tempat_tambah");
  const fieldLink = document.getElementById("field_link_tambah");

  if (!statusSelect) return;

  statusSelect.addEventListener("change", function () {
    if (this.value === "Offline") {
      fieldTempat.style.display = "block";
      fieldLink.style.display = "none";

      fieldTempat.querySelector("input").required = true;
      fieldLink.querySelector("input").required = false;
    } else if (this.value === "Online") {
      fieldLink.style.display = "block";
      fieldTempat.style.display = "none";

      fieldLink.querySelector("input").required = true;
      fieldTempat.querySelector("input").required = false;
    }
  });
});

const modal = document.getElementById("tambahDataModal");

modal.addEventListener("show.bs.modal", function () {
  fieldTempat.style.display = "none";
  fieldLink.style.display = "none";

  fieldTempat.querySelector("input").value = "";
  fieldLink.querySelector("input").value = "";

  fieldTempat.querySelector("input").required = false;
  fieldLink.querySelector("input").required = false;

  statusSelect.selectedIndex = 0;
});
