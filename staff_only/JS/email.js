document.addEventListener('DOMContentLoaded', () => {
    const popupContainer = document.getElementById('popupContainer');
    const mkemlbtn = document.getElementById('mkemlbtn');
    const sendallbtn = document.getElementById('sendallbtn');

    // Check if popupContainer and mkemlbtn exist
    if (!popupContainer || !mkemlbtn) {
        console.error('Specific Popup container or button not found!');
        return;
    }

    // Check if popupContainer and sendallbtn exist
    if (!popupContainer || !sendallbtn) {
        console.error('All Popup container or button not found!');
        return;
    }

    document.body.classList.add('overlay');

    // Close the popup if the user clicks outside of it
    document.addEventListener('click', (event) => {
        if (!popupContainer.contains(event.target) && event.target !== mkemlbtn) {
            let url = window.location.href;
            if(url.endsWith('?')){
                url = url.slice(0, -1);
            }
            window.location.href = url;
        }
        if (!popupContainer.contains(event.target) && event.target !== sendallbtn) {
            let url = window.location.href;
            if(url.endsWith('?')){
                url = url.slice(0, -1);
            }
            window.location.href = url;
        }
    });
});
