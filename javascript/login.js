let passwordVisible = false;

function togglePassword() {
    if (passwordVisible) {
        $(this).html('<i class="bi bi-eye-slash"></i>');
        $(this).parent().find('.passwordInput').attr('type', 'password');
        passwordVisible = false;
    } else {
        $(this).html('<i class="bi bi-eye"></i>');
        $(this).parent().find('.passwordInput').attr('type', 'text');
        passwordVisible = true;
    }
}

$('.showPasswordBtn').on('click', togglePassword);