
function dropdown() {
    if (!$(this).find('.buttonIcon').hasClass('rotated')) {
        $(this).find('.buttonIcon').addClass('rotated');
        $(this).parent().parent().find('.gameDropContent').removeClass('gameDropHidden');
        $(this).addClass('contentVisible');
    }
    else {
        $(this).find('.buttonIcon').removeClass('rotated');
        $(this).parent().parent().find('.gameDropContent').addClass('gameDropHidden');
        $(this).removeClass('contentVisible');
    }
}

function changeScoreColor() {
    let scoreElem = $('#gameScore');
    let score = parseFloat(scoreElem.text);

    if (score < 3)
        scoreElem.css('color' ,'#700000');
    else if (score < 5)
        scoreElem.css('color', '#af6300');
    else if (score < 6.5)
        scoreElem.css('color', '#d8b800');
    else if (score < 8)
        scoreElem.css('color', '#4aac09');
    else if (score < 9)
        scoreElem.css('color', '#007716');
    else
        scoreElem.css('color', '#004d0e');
}

function modoAvaliar() {
    $(this).find('.scoreStar').removeClass('mouseOut');
}

function modoMostrarAvaliacao() {
    $(this).find('.scoreStar').addClass('mouseOut');
}

function toggleLista() {
    $.ajax({
        url: BASE_URL + 'form/adicionaNaLista.php',
        method: 'GET',
        data: {
            gameID: gameID,
            naLista: naLista
        },
        success: function(result) {
            result = parseInt(result);

            if (result) {
                naLista = 1;
                $('#listaBtn').html('<i class="bi bi-check-lg"></i> Minha lista');
            } else {
                naLista = 0;
                $('#listaBtn').html('<i class="bi bi-plus-square"></i> Minha lista');
            }
        }
    });
}

function avaliaJogo() {
    let notaNova = parseFloat($(this).val());
    $.ajax({
        url: BASE_URL + 'form/avaliaJogo.php',
        method: 'GET',
        data: {
            gameID: gameID,
            avaliado: avaliado,
            nota: notaNova
        },
        success: function(result) {
            result = parseFloat(result);
            $('.scoreStarActive').removeClass('scoreStarActive');
            $('.scoreStar')[notaNova - 1].classList.add('scoreStarActive');
            $('#gameScore').html(result.toFixed(2));
            avaliado = 1;
        }
    });
}

function toggleSpoiler() {
    this.nextSibling.classList.remove('spoiler');
    this.style = 'display: none';
}

function carregaComentarios() {
    $.ajax({
        url: BASE_URL + 'form/buscaComentario.php',
        method: 'GET',
        data: {
            jogoID: gameID
        },
        success: function(result) {
            if (result != '') {
                comentariosContainer = document.querySelector('#comentariosContainer');
                comentariosContainer.innerHTML = '';
                result = JSON.parse(result);

                for (let i=0; i<result.length; i++) {
                    let comentario = document.createElement('div');
                    let perfilUsuario = document.createElement('div');
                    let fotoUsuarioContainer = document.createElement('div');
                    let fotoUsuario = document.createElement('img');
                    let informacoesUsuario = document.createElement('div');
                    let username = document.createElement('span');
                    let nomeUsuario = document.createElement('span');
                    let conteudo = document.createElement('p');
                    let conteudoContainer = document.createElement('div');
                    comentario.classList.add('comentario', 'd-flex', 'flex-column', 'gap-1', 'col-lg-8', 'col-10');
                    perfilUsuario.classList.add('perfilUsuarioComentario', 'd-flex', 'align-items-center', 'gap-2')

                    fotoUsuarioContainer.classList.add('fotoUsuarioComentario');

                    fotoUsuario.alt = 'Foto de perfil de ' + result[i].username;
                    $.get(BASE_URL + 'assets/usuarios/profilePic' + result[i].comentarioUsuarioID + '.jpg')
                        .done(function() {
                            fotoUsuario.src = BASE_URL + 'assets/usuarios/profilePic' + result[i].comentarioUsuarioID + '.jpg';
                        }).fail(function() {
                            fotoUsuario.src = BASE_URL + 'assets/usuarios/unknownUser.jpg';
                        })


                    informacoesUsuario.classList.add('informacoesUsuarioComentario', 'd-flex', 'flex-column');
                    username.classList.add('usuarioUsernameComentario');
                    username.textContent = result[i].username;

                    nomeUsuario.classList.add('usuarioNomeComentario');
                    nomeUsuario.textContent = result[i].usuarioNome + ' ' + result[i].usuarioSobrenome;

                    conteudoContainer.classList.add('conteudoComentarioContainer');
                    conteudo.classList.add('conteudoComentario');
                    conteudo.innerHTML = (result[i].conteudo.replace(/\n/g, "<br>")).trim();
                    if (result[i].spoiler == 1) {
                        conteudo.classList.add('spoiler');
                        let removeSpoilerBtn = document.createElement('button');
                        removeSpoilerBtn.classList.add('removeSpoilerBtn');
                        removeSpoilerBtn.innerHTML = 'Ver Spoiler';
                        removeSpoilerBtn.addEventListener('click', toggleSpoiler);
                        conteudoContainer.appendChild(removeSpoilerBtn);
                    }

                    fotoUsuarioContainer.appendChild(fotoUsuario);
                    informacoesUsuario.appendChild(username);
                    informacoesUsuario.appendChild(nomeUsuario);

                    perfilUsuario.appendChild(fotoUsuarioContainer);
                    perfilUsuario.appendChild(informacoesUsuario);

                    conteudoContainer.appendChild(conteudo)

                    comentario.appendChild(perfilUsuario);
                    comentario.appendChild(conteudoContainer);

                    comentariosContainer.appendChild(comentario);
                }
            }
        }
    });
}

$('.buttonDrop').on('click', dropdown);

$('#starScoreContainer').on('mouseenter', modoAvaliar);
$('#starScoreContainer').on('mouseleave', modoMostrarAvaliacao);

$('#listaBtn').on('click', toggleLista);

$('.scoreStar').on('click', avaliaJogo);

$('#novoComentario').on('input', function() {
    $('#novoComentario').attr('placeholder', ' ');
    if ($(this).val().trim() != '')
        $('#enviaComentarioBtn').addClass('active');
    else
        $('#enviaComentarioBtn').removeClass('active');
});

$('#novoComentario').on('focus', function() {
    $('#novoComentarioBtnContainer').show();
});

$('#cancelaComentarioBtn').on('click', function() {
    $('#novoComentario').attr('placeholder', 'Adicione um comentário...');
    $('#novoComentario').val('');
    $('#enviaComentarioBtn').removeClass('active');
    $('#novoComentarioBtnContainer').hide();
});

$('#spoilerCheckContainer').on('click', function() {
    if ($(this).html() == '<i class="bi bi-square"></i><span>Spoiler</span>')
        $(this).html('<i class="bi bi-check-square"></i><span>Spoiler</span>');
    else
        $(this).html('<i class="bi bi-square"></i><span>Spoiler</span>');
});

$('#enviaComentarioBtn').on('click', function() {
    if($(this).hasClass('active')) {
        $.ajax({
            url: BASE_URL + "form/registraComentario.php",
            method: 'GET',
            data: {
                usuarioID: 1, //trocar por id quando iniciar sessão
                jogoID: gameID,
                conteudo: $('#novoComentario').val(),
                spoiler: $('#spoilerTag').is(":checked") ? 1 : 0 
            },
            success: function() {
                $('#novoComentario').attr('placeholder', 'Adicione um comentário...');
                $('#novoComentario').val('');
                $('#enviaComentarioBtn').removeClass('active');
                $('#novoComentarioBtnContainer').hide();
                carregaComentarios();
            }
        })
    }
});

$('body').load(carregaComentarios());