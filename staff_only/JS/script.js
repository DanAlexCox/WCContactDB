document.getElementById('emailForm').addEventListener('submit', async function (event) {
    event.preventDefault(); // Prevent default submission
    const form = this; // Reference to the specific form

    const inputPass = prompt("Enter your password to send the email:");
    if (inputPass === null || inputPass.trim() === "") {
        alert("Password input canceled or empty.");
        return false; // Stop form submission
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
            form.submit(); // Submit this specific form
        } else {
            alert(data.error || "Password verification failed.");
        }
    } catch (error) {
        console.error("Error during password verification:", error);
        alert("An error occurred. Please try again.");
    }
});3

function confirmPartner() {
    // Display the confirmation popup
    const userConfirmed = confirm("Are you sure you want to add this partner?");
    return userConfirmed; // Proceed if "Yes" (true), cancel if "No" (false)
}

function confirmClient() {
    // Display the confirmation popup
    const userConfirmed = confirm("Are you sure you want to add this client?");
    return userConfirmed; // Proceed if "Yes" (true), cancel if "No" (false)
}

