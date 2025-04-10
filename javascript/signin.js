function checkSenha() {
    let s1 = document.querySelector('#senha').value;
    let s2 = document.querySelector('#confirma-senha').value;

    if (s1 == s2)
        return true;

    document.getElementById('wrongPasswordWarning').style = 'display: block';
    return false;
}