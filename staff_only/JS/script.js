async function checkPassword() {
    const inputPass = prompt("Enter your password to send the email:");
    if (inputPass === null || inputPass.trim() === "") {
        alert("Password input canceled or empty.");
        return false; // Prevent form submission
    }

    // Send the password to the server for verification
    try {
        const response = await fetch('check_password.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ password: inputPass })
        });

        const data = await response.json();

        if (data.success) {
            alert("Password verified. Submitting the form.");
            return true; // Allow form submission
        } else {
            alert(data.error || "Password verification failed.");
            return false; // Prevent form submission
        }
    } catch (error) {
        console.error("Error during password verification:", error);
        alert("An error occurred. Please try again.");
        return false; // Prevent form submission
    }
}

document.querySelector('form').addEventListener('submit', async function (event) {
    event.preventDefault(); // Prevent default form submission
    const canSubmit = await checkPassword();
    if (canSubmit) {
        this.submit(); // Manually submit the form if password is verified
    }
});