document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
     
    const fullName = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    alert('Login successful!');
    
    window.location.href = 'Customer Home.html';
});