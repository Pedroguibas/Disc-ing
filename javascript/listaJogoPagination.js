function carregaJogos() {
    $.ajax({
        url: BASE_URL + 'form/buscaJogos.php',
        method: 'POST',
        data:{
            offset: (Pagination.curPage - 1) * 10
        },
        success: function(result) {
            result = JSON.parse(result);
            listaJogo = document.querySelector('#listaJogo');
            listaJogo.innerHTML = '';

            for (let i=0; i<result.length; i++) {
                let itemListaJogo = document.createElement('a');
                let coverContainer = document.createElement('div');
                let cover = document.createElement('img');

                let jogoInfo = document.createElement('div');
                let tituloContainer = document.createElement('div');
                let titulo = document.createElement('span');
                let platContainer = document.createElement('div');

                let classificacaoContainer = document.createElement('div');
                let classificacao = document.createElement('img');

                let notaContainer = document.createElement('div');
                let nota = document.createElement('span');

                let notaJogo = result[i].nAvaliacoes > 0 ? (result[i].nota / result[i].nAvaliacoes).toFixed(2) : '0.00';

                itemListaJogo.href = BASE_URL + 'paginasPrincipais/gamePage.php?gameID=' + result[i].jogoID;
                itemListaJogo.classList.add('itemListaJogo', 'd-flex', 'gap-2', 'col-md-8', 'col-12', 'mt-2');
                coverContainer.classList.add('itemListaJogoImg');
                cover.classList.add('w-100');
                cover.alt = 'Capa ' + result[i].jogoNome;
                cover.src = BASE_URL + 'assets/Jogos/cover' + result[i].jogoID + '.jpg';

                jogoInfo.classList.add('itemListaJogoInfo', 'd-flex', 'flex-column');
                tituloContainer.classList.add('itemListaJogoTituloContainer');
                titulo.classList.add('itemListaJogoTitulo');
                titulo.textContent = result[i].jogoNome;
                platContainer.classList.add('itemListaJogoPlatContainer', 'd-flex', 'gap-1');
                let plat = '';
                if (result[i].windowsOS)
                    plat += '<i class="bi bi-microsoft itemListaJogoPlat"></i>';
                if (result[i].linuxOS)
                    plat += '<i class="bi bi-ubuntu itemListaJogoPlat"></i>';
                if (result[i].macOS)
                    plat += '<i class="bi bi-apple itemListaJogoPlat"></i>';
                if (result[i].playstation)
                    plat += '<i class="bi bi-playstation itemListaJogoPlat"></i>';
                if (result[i].xbox)
                    plat += '<i class="bi bi-xbox itemListaJogoPlat"></i>';
                if (result[i].nintendoSwitch)
                    plat += '<i class="bi bi-nintendo-switch itemListaJogoPlat"></i>';
                if (result[i].androidOS)
                    plat += '<i class="bi bi-android2 itemListaJogoPlat"></i>';

                platContainer.innerHTML = plat;

                classificacaoContainer.classList.add('itemListaJogoClassificacao');
                classificacao.classList.add('w-100');
                classificacao.alt = 'Classificacao ' + result[i].classificacao;
                classificacao.src = BASE_URL + 'assets/Jogos/classificacao/age' + result[i].classificacao + '.png';

                notaContainer.classList.add('itemListaJogoNotaContainer');
                nota.classList.add('itemListaJogoNota');
                nota.innerHTML = '<i class="bi bi-star-fill"></i> ' + notaJogo;
                
                coverContainer.appendChild(cover);

                tituloContainer.appendChild(titulo);
                jogoInfo.appendChild(tituloContainer);
                jogoInfo.appendChild(platContainer);

                classificacaoContainer.appendChild(classificacao);

                notaContainer.appendChild(nota);

                itemListaJogo.appendChild(coverContainer);
                itemListaJogo.appendChild(jogoInfo);
                itemListaJogo.appendChild(classificacaoContainer);
                itemListaJogo.appendChild(notaContainer);

                listaJogo.appendChild(itemListaJogo);
            }
        }
    })
}

function mudaPagina() {
    if ($(this).attr('id') == 'rightPageBtn') {
        Pagination.curPage++;
        if (Pagination.curPage == Pagination.totalPages)
            $(this).removeClass('active');

        $('#leftPageBtn').addClass('active');
    } else {
        Pagination.curPage--;
        if (Pagination.curPage == 1)
            $(this).removeClass('active');

        $('#rightPageBtn').addClass('active');
    }
    $('#currentPage').text(Pagination.curPage);
    $('.paginationBtn.active').on('click', mudaPagina);

    carregaJogos();
}

$('.paginationBtn.active').on('click', mudaPagina);