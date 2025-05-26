function pesquisaUsuarios() {
    let val = $(this).val();
    $('#formBanirUsuarioConfirm').attr('style', 'display: none !important;');
    if (val == "") {
        $('#userSearchReturn').addClass('hidden');
    } else {
            $('#userSearchReturn').removeClass('hidden');

        $.ajax({
            url: BASE_URL + 'form/buscaUsuario.php',
            method: 'POST',
            data: {
                search: '%' + val + '%',
                usuarioID: userID,
                limit: 3
            },
            success: function(result) {
                result = JSON.parse(result);

                let container = document.querySelector('#userSearchReturn');
                container.innerHTML = '';
                if (result.length > 0) {
                    for (let i=0; i<result.length; i++) {
                        let r = result[i];
                        
                        let userProfile = document.createElement('button');
                        let pfp = document.createElement('img');
                        let div = document.createElement('div');
                        let username = document.createElement('span');
                        let nome = document.createElement('span');
                        let inputID = document.createElement('input');
                        let inputUsername = document.createElement('input');

                        userProfile.classList.add('userProfileBtn', 'list-group-item', 'd-flex', 'gap-2', 'p-2');

                        pfp.classList.add('userProfileBtnPic', 'col-md-2', 'col-3');
                        pfp.alt = 'Foto de ' + r.username;

                        div.classList.add('d-flex', 'flex-column');

                        username.classList.add('userProfileBtnUsername');
                        username.textContent = r.username

                        nome.classList.add('userProfileBtnNome');
                        nome.textContent = r.usuarioNome + ' ' + r.usuarioSobrenome;

                        inputID.classList.add('inputBanUserID');
                        inputID.type = 'hidden';
                        inputID.value = r.usuarioID;

                        inputUsername.classList.add('inputBanUserUsername');
                        inputUsername.type = 'hidden';
                        inputUsername.value = r.username;
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

                            userProfile.appendChild(inputUsername);
                            userProfile.appendChild(inputID);
                            userProfile.appendChild(pfp);
                            userProfile.appendChild(div);

                            container.appendChild(userProfile);

                            $(userProfile).on('click', preencheForm);
                        });
                    }
                } else {
                    let msgContainer = document.createElement('div');
                    let msg = document.createElement('span');

                    msgContainer.classList.add('d-flex', 'justify-content-center', 'align-items-center', 'list-group-item');
                    msg.textContent = 'Nenhum usuário ativo com este username.';
                    msg.classList.add('p-4');

                    msgContainer.appendChild(msg);
                    container.appendChild(msgContainer);
                }
            }
        });
    }
}

function preencheForm() {
    $('#userSearchReturn').addClass('hidden');
    $('#formBanUsuarioInputID').val($(this).find('.inputBanUserID').val());
    $('#formBanUsuarioInputUsername').val($(this).find('.inputBanUserUsername').val());
    $('#banirUsuarioUsername').text($(this).find('.userProfileBtnUsername').text());
    $('#banUserModal').modal('toggle');
}

$('#userSearchBar').on('input', pesquisaUsuarios);
$('.fecharModalBtn').on('click', function() {
    $('#banUserModal').modal('toggle');
});