
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
        address.value = pob.value;      // copy value
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

    // Remove all non-digit characters
    value = value.replace(/\D/g, '');

    // Add dashes automatically
    if (value.length > 2) {
        value = value.slice(0, 2) + '-' + value.slice(2);
    }
    if (value.length > 10) {
        value = value.slice(0, 10) + '-' + value.slice(10, 11);
    }

    // Limit total length to 13 characters (00-0000000-0)
    value = value.slice(0, 13);

    this.value = value;
});



// FOR TIN NUMBER VALIDATION

const tinInput = document.getElementById('tin_number');

tinInput.addEventListener('input', function () {
    // Remove non-digit characters
    let numbersOnly = this.value.replace(/\D/g, '');
    
    // Limit to maximum of 9 digits
    numbersOnly = numbersOnly.substring(0, 9);
    
    // Format as 000-000-000
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
    // Remove any character that is not a number
    let numbersOnly = this.value.replace(/\D/g, '');
    
    // Limit to maximum of 4 digits
    numbersOnly = numbersOnly.substring(0, 4);
    
    this.value = numbersOnly;
});


// FOR MOBILE NUMBER VALIDATION

const mobileInput = document.getElementById('mobile');

mobileInput.addEventListener('input', function() {
    let value = this.value;

    // Remove any non-digit characters
    value = value.replace(/\D/g, '');

    // Limit to 11 digits (09XXXXXXXXX)
    value = value.substring(0, 11);

    this.value = value;
});




// FOR TELEPHONE NUMBER VALIDATION

const telInput = document.getElementById('tel');

telInput.addEventListener('input', function() {
    let value = this.value;

    // Remove any non-digit characters
    value = value.replace(/\D/g, '');

    // Limit to 11 digits (09XXXXXXXXX)
    value = value.substring(0, 11);

    this.value = value;
});



// FOR EMAIL ADD VALIDATION

const emailInput = document.getElementById('email');

emailInput.addEventListener('input', function() {
    // Remove spaces
    this.value = this.value.trim();

    // Optional: Restrict to letters, numbers, dots, underscores, and @
    this.value = this.value.replace(/[^a-zA-Z0-9@._-]/g, '');
});

// Example: Form submit validation
function validateEmail() {
    const email = emailInput.value;
    // General email regex
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/;

    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }
    return true;
}