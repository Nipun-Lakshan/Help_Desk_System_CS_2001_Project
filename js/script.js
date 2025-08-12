document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Basic validation
            if (!username || !password) {
                alert('Please fill in all fields');
                return;
            }
            
            // In a real application, you would send this to a server
            console.log('Login attempted with:', { username, password });
            
            // Simulate successful login
            alert('Login successful! Redirecting...');
            
            // Redirect to dashboard
            window.location.href = 'dashboard.html';
        });
    }
});