let passwordVisible = false;

function togglePassword() {
    console.log($(this).parent().find('.passwordInput'));
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

$('.loginInput').on('focusout', function() {
    if ($(this).val() != '')
        $(this).parent().addClass('preenchido');
    else
        $(this).parent().removeClass('preenchido');
});

function checkSenha() {

    if ($('#senha').val() == $('#confirma-senha').val())
        return true;

    $('#wrongPasswordWarning').show();
    return false;
}

function checaValidacaoEmail(result) {
    result = parseInt(result);
    
    if (result != 1)
            return true;

    $('#emailCadastradoWarning').show();
    return false;
}

function checaValidacaoUsername(result) {
    result = parseInt(result);
    if (result != 1)
        return true;

    $('#usuarioCadastradoWarning').show();
    return false;
}

function validaEmail() {
    let email = $('#email');
    if (email.val() != '')
        if (email.val().search('@') != -1) {

            let usuario = (email.val().substring(0, email.val().indexOf('@')))
            let dominio = (email.val().substring(email.val().indexOf('@')+1, email.val().length));
            if (usuario.length > 0 &&
                dominio.length >= 3 &&
                usuario.search('@') == -1 &&
                dominio.search('@') == -1 &&
                dominio.search('.') != -1 &&
                dominio.indexOf('.') >=1 &&
                email.val().search(' ') == -1 &&
                dominio.lastIndexOf(".") < dominio.length - 1)
                    return true;


                $('#emailInvalidoWarning').show();
                return false;

        } else {
            $('#emailInvalidoWarning').show();
            return false;
        }

    return false;
}

function validaUsername() {
    if ($('#username').val() != '' && $('#username').val().indexOf(' ') == -1)
        return true;

    $('#usernameComEspaco').show();
    return false;
}


$('#loginForm').on('submit', function(e) {
    e.preventDefault();
    let count = 0;
    
    if(validaEmail() && validaUsername()) {
        $.ajax({
            url: BASE_URL + "form/checaUsuarioEmail.php",
            method: 'POST',
            data: {
                email: $('#email').val()
            },
            success: function(result) {
                if (result == 1) {
                    $('#emailCadastradoWarning').show();
                    count ++;
                }
            }
        }).then(function() {
            $.ajax({
                url: BASE_URL + 'form/checaUsuarioUsername.php',
                method: 'POST',
                data: {
                    username: $('#username').val()
                },
                success: function(result) {
                    result = parseInt(result);
        
                    if (result == 1) { 
                        $('#usuarioCadastradoWarning').show();
                        count ++;
                    }
                }
            }).then(function() {
                checkSenha();
        
                if (!checkSenha())
                    count++
            
            }).then(function() {
        
                if (count == 0)
                    $('#loginForm')[0].submit();
            });
        });
    }
});

$('#confirma-senha').on('focusout', checkSenha);
$('#confirma-senha').on('focus', function() {
    $('#wrongPasswordWarning').hide();
});

$('#email').on('focusout', validaEmail);
$('#email').on('focus', function() {
    $('#emailInvalidoWarning').hide();
    $('#emailCadastradoWarning').hide();
});

$('#username').on('focusout', validaUsername);
$('#username').on('focus', function() {
    $('#usuarioCadastradoWarning').hide();
    $('#usernameComEspaco').hide();
});

$('.showPasswordBtn').on('click', togglePassword);