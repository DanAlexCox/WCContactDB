// Function to set up the inactivity timer
function setupInactivityTimer() {
    let timeout;

    // Function to redirect to logout.php
    const logout = () => {
        const message = encodeURIComponent("Inactive for too long");
        const logoutURL = `logout.php?msg=${message}`;
        window.location.href = logoutURL;
    };

    // Function to reset the timer
    const resetTimer = () => {
        clearTimeout(timeout); // Clear the existing timer
        timeout = setTimeout(logout, 600000); // Set a new timer (10 mins)
    };

    // Attach event listeners for user activity
    window.addEventListener("mousemove", resetTimer);
    window.addEventListener("keypress", resetTimer);
    window.addEventListener("click", resetTimer);
    window.addEventListener("touchstart", resetTimer);

    resetTimer(); // Initialize the timer
}

// Initialize the timer when the page loads
window.onload = setupInactivityTimer;