document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("modalDetailRapat");

  modal.addEventListener("show.bs.modal", (event) => {
    let button = event.relatedTarget;

    // 🔒 Pastikan ambil BUTTON, bukan icon di dalamnya
    if (button && button.tagName !== "BUTTON") {
      button = button.closest("button");
    }

    if (!button) return;

    const { id, judul, status, tanggal, waktu, tempat, deskripsi } = button.dataset;

    // ===== ISI DATA =====
    document.getElementById("detailId").innerText = id || "-";
    document.getElementById("detailJudul").innerText = judul || "-";
    document.getElementById("detailTanggal").innerText = tanggal || "-";
    document.getElementById("detailWaktu").innerText = waktu || "-";
    document.getElementById("detailTempat").innerText = tempat || "-";
    document.getElementById("detailDeskripsi").innerText = deskripsi || "-";

    // ===== STATUS =====
    const badge = document.getElementById("detailStatus");
    badge.className = "badge";

    if (status === "Online") {
      badge.classList.add("bg-success");
      badge.innerText = "Online";
    } else if (status === "Offline") {
      badge.classList.add("bg-warning", "text-dark");
      badge.innerText = "Offline";
    } else {
      badge.classList.add("bg-secondary");
      badge.innerText = "-";
    }

    // ===== PESERTA =====
    const peserta = document.getElementById("detailPeserta");
    peserta.innerHTML = "Memuat...";

    fetch(`get_peserta_rapat.php?id_rapat=${id}`)
      .then((res) => res.json())
      .then((data) => {
        peserta.innerHTML = data.length ? `<ul class="mb-0">${data.map((n) => `<li>${n}</li>`).join("")}</ul>` : "-";
      })
      .catch(() => (peserta.innerText = "Gagal memuat peserta"));
  });
});
