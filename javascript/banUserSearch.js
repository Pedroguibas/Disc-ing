function pesquisaUsuarios() {
    let val = $(this).val();

    if (val == "") {
        $('#userSearchReturn').addClass('hidden');
    } else {
            $('#userSearchReturn').removeClass('hidden');

        $.ajax({
            url: BASE_URL + 'form/buscaUsuario.php',
            method: 'POST',
            data: {
                search: '%' + val + '%',
                limit: 3
            },
            success: function(result) {
                result = JSON.parse(result);

                let container = document.querySelector('#userSearchReturn');
                container.innerHTML = '';
                for (let i=0; i<result.length; i++) {
                    let r = result[i];
                    
                    let userProfile = document.createElement('button');
                    let pfp = document.createElement('img');
                    let div = document.createElement('div');
                    let username = document.createElement('span');
                    let nome = document.createElement('span');
                    let input = document.createElement('input');

                    userProfile.classList.add('userProfileBtn', 'list-group-item', 'd-flex', 'gap-2', 'p-2');

                    pfp.classList.add('userProfileBtnPic', 'col-md-2', 'col-3');
                    pfp.alt = 'Foto de ' + r.username;

                    div.classList.add('d-flex', 'flex-column');

                    username.classList.add('userProfileBtnUsername');
                    username.textContent = r.username

                    nome.classList.add('userProfileBtnNome');
                    nome.textContent = r.usuarioNome + ' ' + r.usuarioSobrenome;

                    input.classList.add('inputBanUserID');
                    input.type = 'hidden';
                    console.log('../assets/usuarios/profilePic' + r.usuarioID + '.jpg');
                    $.ajax({
                        url: BASE_URL + 'form/checaArquivo.php',
                        method: 'GET',
                        data: {
                            path: 'assets/usuarios/profilePic' + r.usuarioID + '.jpg'
                        },
                        success: function(result) {
                            pfp.src = result == 1 ? BASE_URL + 'assets/usuarios/profilePic' + r.usuarioID + '.jpg' : BASE_URL + 'assets/usuarios/unknownUser.jpg';
                        }
                    }).then(function () {
                        div.appendChild(username);
                        div.appendChild(nome);

                        userProfile.appendChild(input);
                        userProfile.appendChild(pfp);
                        userProfile.appendChild(div);

                        container.appendChild(userProfile);

                        $(userProfile).on('click', preencheForm);
                    });
                }
            }
        });
    }
}

function preencheForm() {
    $('#formBanUsuarioInputID').val($(this).find('.inputBanUserID').val());
}

$('#userSearchBar').on('input', pesquisaUsuarios);