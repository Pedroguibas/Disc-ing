
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

function togglelistaJogado() {
    $.ajax({
        url: BASE_URL + 'form/marcarJogado.php',
        method: 'POST',
        data: {
            gameID: gameID,
            jogado: jogado
        },
        success: function(result) {
            result = parseInt(result);

            if (result) {
                jogado = 1;
                $('#listaJogadoBtn').html('<i class="bi bi-check-lg"></i> Jogado');
            } else {
                jogado = 0;
                $('#listaJogadoBtn').html('<i class="bi bi-plus-square"></i> Marcar como Jogado');
            }
        }
    });
}

function avaliaJogo() {
    let notaNova = parseFloat($(this).val());
    $.ajax({
        url: BASE_URL + 'form/avaliaJogo.php',
        method: 'POST',
        data: {
            gameID: gameID,
            avaliado: avaliado,
            nota: notaNova
        },
        success: function(result) {
            result = JSON.parse(result);
            result.total = parseInt(result.total);
            result.nota = parseFloat(result.nota);
            $('.scoreStarActive').removeClass('scoreStarActive');
            $('.scoreStar')[notaNova - 1].classList.add('scoreStarActive');
            $('#gameScore').html((result.nota / result.total).toFixed(2));
            $('#totalAvaliacoesJogo').html(result.total);
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
        method: 'POST',
        data: {
            jogoID: gameID
        },
        success: function(result) {
            if (result != '') {
                comentariosContainer = document.querySelector('#comentariosContainer');
                comentariosContainer.innerHTML = '';
                result = JSON.parse(result);

                for (let i=0; i<result.length; i++) {
                    let comentarioUsuarioID = result[i].comentarioUsuarioID;
                    let comentarioIDInput = document.createElement('input');
                    let comentarioLikedInput = document.createElement('input');
                    let comentario = document.createElement('div');
                    let perfilUsuario = document.createElement('div');
                    let fotoUsuarioContainer = document.createElement('div');
                    let fotoUsuario = document.createElement('img');
                    let informacoesUsuario = document.createElement('div');
                    let username = document.createElement('a');
                    let nomeUsuario = document.createElement('span');
                    let conteudo = document.createElement('p');
                    let conteudoContainer = document.createElement('div');
                    let comentarioLikeContainer = document.createElement('div');
                    let likeBtn = document.createElement('button');
                    let likeCounter = document.createElement('span');

                    comentario.classList.add('comentario', 'd-flex', 'flex-column', 'gap-1', 'col-lg-8', 'col-10');
                    perfilUsuario.classList.add('perfilUsuarioComentario', 'd-flex', 'align-items-center', 'gap-2')

                    fotoUsuarioContainer.classList.add('fotoUsuarioComentario');

                    fotoUsuario.alt = 'Foto de perfil de ' + result[i].username;


                    informacoesUsuario.classList.add('informacoesUsuarioComentario', 'd-flex', 'flex-column');
                    username.classList.add('usuarioUsernameComentario');
                    username.href = BASE_URL + 'paginasPrincipais/perfilDoUsuario.php?u=' + comentarioUsuarioID;
                    username.textContent = result[i].username;

                    nomeUsuario.classList.add('usuarioNomeComentario');
                    nomeUsuario.textContent = result[i].usuarioNome + ' ' + result[i].usuarioSobrenome;

                    conteudoContainer.classList.add('conteudoComentarioContainer');
                    conteudo.classList.add('conteudoComentario');
                    conteudo.innerHTML = (result[i].conteudo.replace(/\n/g, "<br>")).trim();

                    comentarioLikeContainer.classList.add('comentarioLikeContainer', 'd-flex', 'align-items-center', 'gap-1');
                    likeBtn.classList.add('likeBtn', 'd-flex', 'align-items-center', 'justify-content-center');
                    if (result[i].liked == 1)
                        likeBtn.innerHTML = '<i class="bi bi-hand-thumbs-up-fill"></i>';
                    else
                        likeBtn.innerHTML = '<i class="bi bi-hand-thumbs-up"></i>';

                    likeBtn.addEventListener('click', curtirComentario);
                    likeCounter.classList.add('likeCounter');
                    likeCounter.textContent = result[i].likes;
                    if (likeCounter.textContent == '0') {
                        likeCounter.style = 'display: none';
                    }
                    comentarioIDInput.type = 'hidden';
                    comentarioIDInput.classList.add('comentarioIDInput');
                    comentarioIDInput.value = result[i].comentarioID;
                    comentarioLikedInput.type = 'hidden';
                    comentarioLikedInput.classList.add('comentarioLikedInput');
                    comentarioLikedInput.value = result[i].liked;

                    $.ajax({
                        url: BASE_URL + 'form/checaArquivo.php',
                        method: 'GET',
                        data: {
                            path: 'assets/usuarios/profilePic' + comentarioUsuarioID + '.jpg'
                        },
                        success: function(result) {
                            fotoUsuario.src = result == 1 ? BASE_URL + 'assets/usuarios/profilePic' + comentarioUsuarioID + '.jpg' : BASE_URL + 'assets/usuarios/unknownUser.jpg';
                        }
                    }).then(function() {
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

                        comentarioLikeContainer.appendChild(likeBtn);
                        comentarioLikeContainer.appendChild(likeCounter);
                        comentarioLikeContainer.appendChild(comentarioIDInput);
                        comentarioLikeContainer.appendChild(comentarioLikedInput);

    
                        comentario.appendChild(perfilUsuario);
                        comentario.appendChild(conteudoContainer);
                        comentario.appendChild(comentarioLikeContainer);
    
                        comentariosContainer.appendChild(comentario);

                    });
                }
            }
        }
    });
}

function curtirComentario() {
    let btn = $(this);
    let comentID = btn.parent().find($('.comentarioIDInput')).val();
    let comentLiked = btn.parent().find($('.comentarioLikedInput'));
    let likeCounter = btn.parent().find($('.likeCounter'));
    $.ajax({
        url: BASE_URL + 'form/curtirComentario.php',
        method: 'POST',
        data: {
            comentarioID: comentID,
            liked: comentLiked.val()
        },
        success: function() {
            let likes = likeCounter.text();
            if (comentLiked.val() == 1) {
                btn.find($('i')).removeClass('bi-hand-thumbs-up-fill');
                btn.find($('i')).addClass('bi-hand-thumbs-up');
                comentLiked.val(0);
                likeCounter.text(parseInt(likes) - 1);
                if (likeCounter.text() == 0)
                    likeCounter.hide();
                else
                    likeCounter.show();
            } else {
                btn.find($('i')).removeClass('bi-hand-thumbs-up');
                btn.find($('i')).addClass('bi-hand-thumbs-up-fill');
                comentLiked.val(1);
                likeCounter.text(parseInt(likes) + 1);
                if (likeCounter.text() != 0)
                    likeCounter.show();
            }
        }
    });
}

$('.buttonDrop').on('click', dropdown);

$('#starScoreContainer').on('mouseenter', modoAvaliar);
$('#starScoreContainer').on('mouseleave', modoMostrarAvaliacao);

$('#listaJogadoBtn').on('click', togglelistaJogado);

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
            method: 'POST',
            data: {
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