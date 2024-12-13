import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

function validateAndRedirect() {
    // Get the values of the date inputs
    const start_date = document.getElementById('start_date').value;
    const end_date = document.getElementById('end_date').value;

    // Check if both dates are selected
    if (!start_date || !end_date) {
        alert('Please select both start and end dates before printing.');
        return; // Stop further execution if validation fails
    }

    // Construct the custom URL with the selected dates
    const url = `{{ route('activities.custom-print') }}?start_date=${start_date}&end_date=${end_date}`;
    
    // Open the URL in a new tab
    window.open(url, '_blank');
}