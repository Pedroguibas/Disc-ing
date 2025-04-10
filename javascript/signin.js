function checkSenha() {
    let s1 = document.querySelector('#senha').value;
    let s2 = document.querySelector('#confirma-senha').value;

    if (s1 == s2)
        return true;

    document.getElementById('wrongPasswordWarning').style = 'display: block';
    return false;
}

function checaValidacaoEmail(result) {
    result = parseInt(result);
    if (result != 1)
            return true;

    document.querySelector('#emailCadastradoWarning').style = 'display: block';
    return false;
}

function validaEmail() {
    let email = emailInput.value;
    if (email != '') {
        let requisicao = $.ajax({
            url: BASE_URL + "form/checaUsuarioEmail.php?email=" + email
        });
        requisicao.done(checaValidacaoEmail);
    }
}

function desativaMensagem() {
    if (this == emailInput) {
        document.querySelector('#emailCadastradoWarning').style = 'display: none';
        return;
    }

    if (this == confirmaSenhaInput) {
        document.getElementById('wrongPasswordWarning').style = 'display: none';
        return;
    }
}

const confirmaSenhaInput = document.querySelector('#confirma-senha');
confirmaSenhaInput.addEventListener('focusout', checkSenha);
confirmaSenhaInput.addEventListener('focus', desativaMensagem);


const emailInput = document.querySelector('#email');
emailInput.addEventListener('focusout', validaEmail);
emailInput.addEventListener('focus', desativaMensagem);
