document.addEventListener("DOMContentLoaded", function () {
  const bell = document.querySelector("#notifToggle");
  const dropdown = document.querySelector("#notifDropdown");
  const badge = document.querySelector(".notif-badge");

  /* =====================
     TOGGLE DROPDOWN
  ====================== */
  bell?.addEventListener("click", function (e) {
    e.stopPropagation();
    dropdown.classList.toggle("show");
  });

  document.addEventListener("click", function () {
    dropdown.classList.remove("show");
  });

  /* =====================
     KLIK NOTIF → DIBACA (SATUAN)
  ====================== */
  document.querySelectorAll(".notif-item").forEach((item) => {
    item.addEventListener("click", function () {
      if (!this.classList.contains("unread")) return;

      fetch("../fungsi/mark_notifikasi_unread.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "id=" + this.dataset.id,
      });

      this.classList.remove("unread");
      this.classList.add("read");

      if (badge) {
        let total = parseInt(badge.textContent);
        total--;
        total <= 0 ? badge.remove() : (badge.textContent = total);
      }
    });
  });

  /* =====================
     MARK ALL NOTIF
  ====================== */
  document.querySelector(".btn-mark-all")?.addEventListener("click", function (e) {
    e.stopPropagation();

    fetch("../fungsi/mark_all_notifikasi.php", {
      method: "POST",
    })
      .then((res) => res.json())
      .then((data) => {
        if (!data.success) return;

        document.querySelectorAll(".notif-item.unread").forEach((item) => {
          item.classList.remove("unread");
          item.classList.add("read");
        });

        badge?.remove();
      });
  });

  /* =====================
     HAPUS SEMUA NOTIF
  ====================== */
  document.querySelector(".btn-delete-all")?.addEventListener("click", function (e) {
    e.stopPropagation();

    if (!confirm("Hapus semua notifikasi?")) return;

    fetch("../fungsi/hapus_semua_notifikasi.php", { method: "POST" })
      .then((res) => res.json())
      .then((data) => {
        if (!data.success) return;

        const body = document.querySelector("#notifDropdown .notif-body");

        // 🔥 RESET TOTAL ISI DROPDOWN
        body.innerHTML = `<div class="notif-empty">Tidak ada notifikasi</div>`;

        // 🔥 HAPUS BADGE
        document.querySelector(".notif-badge")?.remove();
      });
  });

  /* =====================
     TUTUP DROPDOWN
  ====================== */
  document.querySelector(".btn-close-notif")?.addEventListener("click", function (e) {
    e.stopPropagation();
    dropdown.classList.remove("show");
  });
});
