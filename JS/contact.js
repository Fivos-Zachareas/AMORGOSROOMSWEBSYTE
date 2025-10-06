document.addEventListener('DOMContentLoaded', () => {
    // Function to generate a random number between min and max (inclusive)
    function generateRandomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    // Generate and display the CAPTCHA
    const captchaNumber1 = generateRandomNumber(1, 9);
    const captchaNumber2 = generateRandomNumber(1, 9);
    document.getElementById('captcha_question').innerText = `${captchaNumber1} + ${captchaNumber2} = ?`;

    // Store the correct answer in a hidden field
    document.getElementById('captcha_answer').value = captchaNumber1 + captchaNumber2;

    const form = document.getElementById('reservationForm');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const checkin = document.getElementById('checkin').value;
        const checkout = document.getElementById('checkout').value;
        const captchaInput = document.getElementById('captcha_input').value.trim();
        const captchaAnswer = document.getElementById('captcha_answer').value;

        let valid = true;
        let message = '';

        // Επικύρωση ονόματος
        if (firstName.length < 2) {
            valid = false;
            message += 'Το όνομα πρέπει να έχει τουλάχιστον 2 χαρακτήρες.\n';
        }

        // Επικύρωση επιθέτου
        if (lastName.length < 2) {
            valid = false;
            message += 'Το επώνυμο πρέπει να έχει τουλάχιστον 2 χαρακτήρες.\n';
        }

        // Επικύρωση email
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            valid = false;
            message += 'Παρακαλώ εισάγετε μια έγκυρη διεύθυνση email.\n';
        }

        // Επικύρωση τηλεφώνου
        const phonePattern = /^\d{10,15}$/;
        if (!phonePattern.test(phone)) {
            valid = false;
            message += 'Το τηλέφωνο πρέπει να περιέχει μόνο ψηφία και να έχει από 10 έως 15 χαρακτήρες.\n';
        }

        // Επικύρωση ημερομηνίας άφιξης
        const today = new Date().toISOString().split('T')[0];
        if (checkin < today) {
            valid = false;
            message += 'Η ημερομηνία άφιξης δεν μπορεί να είναι προγενέστερη της σημερινής.\n';
        }

        // Επικύρωση ημερομηνίας αναχώρησης
        if (checkout <= checkin) {
            valid = false;
            message += 'Η ημερομηνία αναχώρησης πρέπει να είναι μεταγενέστερη της ημερομηνίας άφιξης.\n';
        }

        // Επικύρωση CAPTCHA
        if (captchaInput != captchaAnswer) {
            valid = false;
            message += 'Λάθος απάντηση στην CAPTCHA.\n';
        }

        if (!valid) {
            alert(message);
            return;
        } else {
            message += 'Στάλθηκε με επιτυχία η φόρμα.\n';
            alert(message);
            // Refresh the page after displaying the success message
            location.reload();
        }

        
    });
});