let passwordVisible = false;

function togglePassword() {
    if (passwordVisible) {
        $(this).html('<i class="bi bi-eye-slash"></i>');
        $(this).parent().find('#senha').attr('type', 'password');
        passwordVisible = false;
    } else {
        $(this).html('<i class="bi bi-eye"></i>');
        $(this).parent().find('#senha').attr('type', 'text');
        passwordVisible = true;
    }
}


$('.showPasswordBtn').on('click', togglePassword);

$('#loginForm').on('submit', function(e) {
    e.preventDefault();

    if($('#senha').val().length >= 8) {
        
        $.ajax({
            url: BASE_URL + 'form/validaLogin.php?usuario=' + $('#usuario').val() + '&senha=' + $('#senha').val(),
            success: function(result) {
                result = parseInt(result);
                
                if (result == 1) {
                    $('#loginForm')[0].submit();
                } else {
                    $('#usuarioOuSenhaWarning').show();
                }
            }
        });
        
    }
});

$('.loginInput').on('focus', function() {
    $('#usuarioOuSenhaWarning').hide();
});