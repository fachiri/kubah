const telkomselPrefixes = ["0812", "0813", "0821", "0822", "0852", "0853", "0823", "0851"];
const indosatPrefixes = ["0814", "0815", "0816", "0855", "0856", "0857", "0858"];
const threePrefixes = ["0895", "0896", "0897", "0898", "0899"];
const smartfrenPrefixes = ["0881", "0882", "0883", "0884", "0885", "0886", "0887", "0888", "0889"];
const xlPrefixes = ["0817", "0818", "0819", "0859", "0877", "0878"];
const axisPrefixes = ["0838", "0831", "0832", "0833"];

document.addEventListener('DOMContentLoaded', () => {
    const phoneInput = document.querySelector('.phone-id');

    phoneInput.addEventListener('keyup', checkNumber);
    phoneInput.addEventListener('input', checkNumber);
    phoneInput.addEventListener('keypress', restrictToNumbers);

    checkNumber();
});

function checkNumber() {
    const phoneInput = document.querySelector('.phone-id');
    const phoneNumber = phoneInput.value;
    const phoneNumberLength = phoneNumber.length;

    if (phoneNumberLength >= 4 && phoneNumberLength <= 12) {
        const prefix = phoneNumber.substring(0, 4);
        const providers = [
            { prefixes: telkomselPrefixes, image: "telkomsel.png" },
            { prefixes: indosatPrefixes, image: "indosat.png" },
            { prefixes: threePrefixes, image: "three.png" },
            { prefixes: smartfrenPrefixes, image: "smartfren.png" },
            { prefixes: xlPrefixes, image: "xl.png" },
            { prefixes: axisPrefixes, image: "axis.png" }
        ];

        let operatorFound = false;

        for (const provider of providers) {
            if (provider.prefixes.includes(prefix)) {
                phoneInput.style.backgroundImage = `url(../images/providers/${provider.image})`;
                phoneInput.style.backgroundRepeat = "no-repeat";
                phoneInput.style.backgroundPosition = "98% 50%";
                phoneInput.style.backgroundSize = "auto 50%";
                operatorFound = true;
                break;
            }
        }

        if (!operatorFound) {
            removeOperatorImage();
        }
    } else {
        removeOperatorImage();
    }
}

function removeOperatorImage() {
    document.querySelector('.phone-id').style.backgroundImage = "url('')";
}

function restrictToNumbers(event) {
    const asciiCode = event.which ? event.which : event.keyCode;
    if (asciiCode > 31 && (asciiCode < 48 || asciiCode > 57)) {
        event.preventDefault();
    }
}