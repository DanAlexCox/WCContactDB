document.addEventListener('DOMContentLoaded', () => {
    const popupContainer = document.getElementById('popupContainer');
    const mkemlbtn = document.getElementById('mkemlbtn');

    // Check if popupContainer and mkemlbtn exist
    if (!popupContainer || !mkemlbtn) {
        console.error('Popup container or button not found!');
        return;
    }

    // Prevent form submission and show the popup when the 'Contact' button is clicked
    mkemlbtn.addEventListener('click', (event) => {
        event.preventDefault();  // Prevent form submission
        document.body.classList.add('overlay');
        popupContainer.classList.remove('hidden');
    });

    // Close the popup if the user clicks outside of it
    document.addEventListener('click', (event) => {
        if (!popupContainer.contains(event.target) && event.target !== mkemlbtn) {
            document.body.classList.remove('overlay');
            popupContainer.classList.add('hidden');
        }
    });
});
