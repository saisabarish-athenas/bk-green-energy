document.addEventListener("DOMContentLoaded", function () {

  const form = document.getElementById("wf-form-Footer-Form");
  const successMsg = document.querySelector(".w-form-done");
  const failMsg = document.querySelector(".w-form-fail");

  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const emailInput = form.querySelector("input[type='email']");
      const email = emailInput.value.trim();

      if (validateEmail(email)) {
        successMsg.style.display = "block";
        failMsg.style.display = "none";
        emailInput.value = "";
      } else {
        successMsg.style.display = "none";
        failMsg.style.display = "block";
      }
    });
  }

  function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

});
