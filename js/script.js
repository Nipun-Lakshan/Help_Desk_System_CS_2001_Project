document.addEventListener('DOMContentLoaded', function() {
    // Get the form and registration number input
    const form = document.querySelector('.login-form');
    const regNumberInput = document.getElementById('reg_number');
    
    // Regular expression pattern for registration number: 5 numbers, 's', 5 numbers
    const regNumberPattern = /^\d{5}s\d{5}$/;
    
    // Function to validate registration number
    function validateRegNumber(regNumber) {
        return regNumberPattern.test(regNumber);
    }
    
    // Function to show error dialog
    function showErrorDialog(message) {
        alert(message);
    }
    
    // Add event listener for form submission
    form.addEventListener('submit', function(event) {
        const regNumberValue = regNumberInput.value.trim();
        
        // Validate registration number pattern
        if (!validateRegNumber(regNumberValue)) {
            event.preventDefault(); // Prevent form submission
            showErrorDialog('Registration number does not follow the correct pattern. It should be in the format: 5 numbers, "s", and 5 numbers (e.g., 12345s67890)');
            regNumberInput.focus(); // Focus on the problematic field
        }
    });
    
    // Optional: Add real-time validation feedback
    regNumberInput.addEventListener('input', function() {
        const value = this.value.trim();
        if (value && !validateRegNumber(value)) {
            this.style.borderColor = 'red';
        } else {
            this.style.borderColor = '';
        }
    });
    
    // Optional: Add blur validation for better user experience
    regNumberInput.addEventListener('blur', function() {
        const value = this.value.trim();
        if (value && !validateRegNumber(value)) {
            this.style.borderColor = 'red';
            showErrorDialog('Registration number should be in the format: 5 numbers, "s", and 5 numbers (e.g., 12345s67890)');
        } else {
            this.style.borderColor = '';
        }
    });
});