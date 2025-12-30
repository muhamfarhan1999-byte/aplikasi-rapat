const modal = document.getElementById("modalDetailRapat");

modal.addEventListener("show.bs.modal", function (event) {
  const button = event.relatedTarget;

  const getData = (attr) => (button.getAttribute(attr) || "").trim();

  const idRapat = getData("data-id");
  const judul = getData("data-judul");
  const status = getData("data-status");
  const tanggal = getData("data-tanggal");
  const waktu = getData("data-waktu");
  const tempat = getData("data-tempat");
  const deskripsi = getData("data-deskripsi");

  // Isi konten modal
  document.getElementById("detailid").textContent = idRapat || "-";
  document.getElementById("detailJudul").textContent = judul || "-";
  document.getElementById("detailTanggal").textContent = tanggal || "-";
  document.getElementById("detailWaktu").textContent = waktu || "-";
  document.getElementById("detailTempat").textContent = tempat || "-";
  document.getElementById("detailDeskripsi").textContent = deskripsi || "-";

  // Badge status
  const badge = document.getElementById("detailStatus");
  badge.className = "badge"; // reset dulu

  if (status === "Online") {
    badge.classList.add("bg-success", "text-white");
    badge.textContent = "Online";
  } else if (status === "Offline") {
    badge.classList.add("bg-warning", "text-dark");
    badge.textContent = "Offline";
  } else {
    badge.classList.add("bg-secondary", "text-white");
    badge.textContent = status || "-";
  }
});
