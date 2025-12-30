document.addEventListener("click", function (e) {
  if (e.target.closest(".toggle-password")) {
    const btn = e.target.closest(".toggle-password");
    const td = btn.closest("td");

    const mask = td.querySelector(".password-mask");
    const real = td.querySelector(".password-real");
    const icon = btn.querySelector("i");

    if (real.classList.contains("d-none")) {
      real.classList.remove("d-none");
      mask.classList.add("d-none");
      icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
      real.classList.add("d-none");
      mask.classList.remove("d-none");
      icon.classList.replace("fa-eye-slash", "fa-eye");
    }
  }
});
