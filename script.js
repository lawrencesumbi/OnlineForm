const radios = document.querySelectorAll('input[name="cs"]');
const otherInput = document.getElementById('otherText');

radios.forEach(radio => {
    radio.addEventListener('change', function () {
        if (this.value === 'others') {
            otherInput.disabled = false;
            otherInput.required = true;
            otherInput.focus();
        } else {
            otherInput.disabled = true;
            otherInput.required = false;
            otherInput.value = '';
        }
    });
});


document.getElementById('sameAddress').addEventListener('change', function () {
    const addressDiv = document.getElementById('addressDiv');
    const pob = document.getElementById('pob');
    const address = document.getElementById('address');

    if (this.checked) {
        address.value = pob.value;      // copy value
        addressDiv.style.display = 'none';
        address.removeAttribute('required');
    } else {
        addressDiv.style.display = 'block';
        address.value = '';
        address.setAttribute('required', 'required');
    }
});




