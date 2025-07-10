const passwordInput = document.getElementById('password-input');
const toggleButton = document.getElementById('toggle-password');
const toggleIcon = document.getElementById('toggle-icon');

toggleButton.addEventListener('click', function(){
    if (passwordInput.type === 'password'){
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    }
})