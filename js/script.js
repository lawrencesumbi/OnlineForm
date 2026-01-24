// FOR CIVIL STATUS OTHER TEXT 

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

// FOR PLACE OF BIRTH SAME ADDRESS 

document.getElementById('sameAddress').addEventListener('change', function () {
    const addressDiv = document.getElementById('addressDiv');
    const pob = document.getElementById('pob');
    const address = document.getElementById('address');

    if (this.checked) {
        address.value = pob.value;
        addressDiv.style.display = 'none';
        address.removeAttribute('required');
    } else {
        addressDiv.style.display = 'block';
        address.value = '';
        address.setAttribute('required', 'required');
    }
});

// FOR SS NUMBER VALIDATION

const sssInput = document.getElementById('sss_number');

sssInput.addEventListener('input', function (e) {
    let value = this.value;
    value = value.replace(/\D/g, '');

    if (value.length > 2) {
        value = value.slice(0, 2) + '-' + value.slice(2);
    }
    if (value.length > 10) {
        value = value.slice(0, 10) + '-' + value.slice(10, 11);
    }

    value = value.slice(0, 13);
    this.value = value;
});

// FOR TIN NUMBER VALIDATION

const tinInput = document.getElementById('tin_number');

tinInput.addEventListener('input', function () {
    let numbersOnly = this.value.replace(/\D/g, '');
    numbersOnly = numbersOnly.substring(0, 9);
    
    if (numbersOnly.length > 6) {
        numbersOnly = numbersOnly.replace(/^(\d{3})(\d{3})(\d{0,3})$/, '$1-$2-$3');
    } else if (numbersOnly.length > 3) {
        numbersOnly = numbersOnly.replace(/^(\d{3})(\d{0,3})$/, '$1-$2');
    }

    this.value = numbersOnly;
});

// FOR ZIP CODE VALIDATION

const zipInput = document.getElementById('zip');

zipInput.addEventListener('input', function() {
    let numbersOnly = this.value.replace(/\D/g, '');
    numbersOnly = numbersOnly.substring(0, 4);
    this.value = numbersOnly;
});

// FOR MOBILE NUMBER VALIDATION

const mobileInput = document.getElementById('mobile');

mobileInput.addEventListener('input', function() {
    let value = this.value;
    value = value.replace(/\D/g, '');
    value = value.substring(0, 11);
    this.value = value;
});

// FOR TELEPHONE NUMBER VALIDATION

const telInput = document.getElementById('tel');

telInput.addEventListener('input', function () {
    let value = this.value;
    value = value.replace(/\D/g, '');
    value = value.substring(0, 10);

    if (value.length > 6) {
        value = value.replace(/^(\d{3})(\d{3})(\d{0,4})$/, '$1 $2 $3');
    } else if (value.length > 3) {
        value = value.replace(/^(\d{3})(\d{0,3})$/, '$1 $2');
    }

    this.value = value;
});

// FOR EMAIL ADDRESS VALIDATION

const emailInput = document.getElementById('email');

emailInput.addEventListener('input', function() {
    this.value = this.value.trim();
    this.value = this.value.replace(/[^a-zA-Z0-9@._-]/g, '');
});

function validateEmail() {
    const email = emailInput.value;
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/;

    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }
    return true;
}

// FOR NAME VALIDATION (CLASS VERSION)

const nameInputs = document.querySelectorAll('.fullname');

nameInputs.forEach(input => {
    input.addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z\s,.-]/g, '');
        this.value = this.value.replace(/\s{2,}/g, ' ');
    });
});

// FOR MONEY VALIDATION

const earningInputs = document.querySelectorAll('.money');

earningInputs.forEach(input => {
    input.addEventListener('input', function () {
        let value = this.value;
        value = value.replace(/[^0-9.]/g, '');

        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts.slice(1).join('');
        }

        if (parts[1]?.length > 2) {
            value = parts[0] + '.' + parts[1].substring(0, 2);
        }

        let [integer, decimal] = value.split('.');
        integer = integer.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        this.value = decimal !== undefined ? `${integer}.${decimal}` : integer;
    });
});

// FOR COMMON REFERENCE NUMBER (CRN) VALIDATION

const crnInput = document.getElementById('crn_number');

crnInput.addEventListener('input', function () {
    let value = this.value;
    value = value.replace(/\D/g, '');
    value = value.substring(0, 12);
    this.value = value;
});