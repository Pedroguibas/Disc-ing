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
}

function validaEmail() {
    let email = $('#email');
    if (email.val() != '')
        if (email.val().search('@') != -1) {

            let usuario = (email.val().substring(0, email.val().indexOf('@')))
            let dominio = (email.val().substring(email.val().indexOf('@')+1, email.val().length));
            console.log('?')
            if (usuario.length > 0 &&
                dominio.length >= 3 &&
                usuario.search('@') == -1 &&
                dominio.search('@') == -1 &&
                dominio.search('.') != -1 &&
                dominio.indexOf('.') >=1 &&
                email.val().search(' ') == -1 &&
                dominio.lastIndexOf(".") < dominio.length - 1) {

                    let requisicao = $.ajax({
                        url: BASE_URL + "form/checaUsuarioEmail.php?email=" + email.val()
                    });
                    requisicao.done(checaValidacaoEmail);
                } else {
                    $('#emailInvalidoWarning').show();
                }
            
            

        } else {
            $('#emailInvalidoWarning').show();
        }
}

function validaUsername() {
    if ($('#username').val() != '') {
        let requisicao = $.ajax({
            url: BASE_URL + "form/checaUsuarioUsername.php?username=" + $('#username').val()
        });
        requisicao.done(checaValidacaoUsername);
    }
}


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
});