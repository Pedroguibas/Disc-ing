let passwordVisible = false;

function togglePassword() {
    if (passwordVisible) {
        this.innerHTML = '<i class="bi bi-eye-slash"></i>';
        this.parentElement.querySelector('.passwordInput').type = 'password';
        passwordVisible = false;
    } else {
        this.innerHTML = '<i class="bi bi-eye"></i>';
        this.parentElement.querySelector('.passwordInput').type = 'text';
        passwordVisible = true;
    }
}

const showPasswordBtn = document.getElementById('showPasswordBtn');
showPasswordBtn.addEventListener('click', togglePassword);