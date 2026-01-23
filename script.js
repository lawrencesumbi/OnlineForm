document.addEventListener("DOMContentLoaded", () => {
  const radios = document.querySelectorAll('input[name="cs"]');
  const otherText = document.getElementById("otherText");

  radios.forEach(radio => {
    radio.addEventListener("change", () => {
      if (radio.value === "others" && radio.checked) {
        otherText.disabled = false;
        otherText.required = true;
        otherText.focus();
      } else if (radio.checked) {
        otherText.disabled = true;
        otherText.required = false;
        otherText.value = "";
      }
    });
  });
});


document.addEventListener("DOMContentLoaded", () => {
  const checkbox = document.getElementById("sameAddress");
  const addressDiv = document.getElementById("addressDiv");
  const addressInput = document.getElementById("address");
  const pobInput = document.getElementById("pob");

  checkbox.addEventListener("change", () => {
    if (checkbox.checked) {
      // Hide Home Address
      addressDiv.style.display = "none";

      // Disable to prevent submission
      addressInput.disabled = true;
      addressInput.value = "";
    } else {
      // Show Home Address
      addressDiv.style.display = "block";
      addressInput.disabled = false;
    }
  });
});




