function bsModalToggle() {
    $('#excluiJogoModal').modal('toggle');
    $('#jogoNomeConfirmacaoExclusao').text($(this).find('.itemListaJogoTitulo').text());
    $('#excluirJogoID').val($(this).find('.inputJogoID').val());
    $('#excluirJogoNome').val($(this).find('.itemListaJogoTitulo').text());
}

function carregaJogos() {
    $.ajax({
        url: BASE_URL + 'form/buscaJogos.php',
        method: 'POST',
        data:{
            offset: (Pagination.curPage - 1) * 10,
            search: "%" + $('#gameSearchbar').val() + "%"
        },
        success: function(result) {
            result = JSON.parse(result);
            listaJogo = document.querySelector('#listaJogo');
            listaJogo.innerHTML = '';
            
            for (let i=0; i<result.length; i++) {
                r = result[i];
                let itemListaJogo = document.createElement('div'); //colocado div em vez de button por conta de erro de responsividade
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

                let inputJogoID = document.createElement('input');


                let notaJogo = r.nAvaliacoes > 0 ? (r.nota / r.nAvaliacoes).toFixed(2) : '0.00';

                itemListaJogo.classList.add('itemListaJogo', 'd-flex', 'gap-2', 'col-md-8', 'col-12', 'mt-2');
                $(itemListaJogo).attr('data-toggle', 'modal');
                $(itemListaJogo).attr('data-target', '#excluiJogoModal');
                $(itemListaJogo).attr('type', 'button');

                coverContainer.classList.add('itemListaJogoImg');
                cover.classList.add('w-100');
                cover.alt = 'Capa ' + r.jogoNome;
                cover.src = BASE_URL + 'assets/Jogos/cover' + r.jogoID + '.jpg';

                jogoInfo.classList.add('itemListaJogoInfo', 'd-flex', 'flex-column', 'justify-content-between');
                tituloContainer.classList.add('itemListaJogoTituloContainer');
                titulo.classList.add('itemListaJogoTitulo');
                titulo.textContent = r.jogoNome;
                platContainer.classList.add('itemListaJogoPlatContainer', 'd-flex', 'gap-1');
                let plat = '';
                if (r.windowsOS)
                    plat += '<i class="bi bi-microsoft itemListaJogoPlat"></i>';
                if (r.linuxOS)
                    plat += '<i class="bi bi-ubuntu itemListaJogoPlat"></i>';
                if (r.macOS)
                    plat += '<i class="bi bi-apple itemListaJogoPlat"></i>';
                if (r.playstation)
                    plat += '<i class="bi bi-playstation itemListaJogoPlat"></i>';
                if (r.xbox)
                    plat += '<i class="bi bi-xbox itemListaJogoPlat"></i>';
                if (r.nintendoSwitch)
                    plat += '<i class="bi bi-nintendo-switch itemListaJogoPlat"></i>';
                if (r.androidOS)
                    plat += '<i class="bi bi-android2 itemListaJogoPlat"></i>';

                platContainer.innerHTML = plat;

                classificacaoContainer.classList.add('itemListaJogoClassificacao');
                classificacao.classList.add('w-100');
                classificacao.alt = 'Classificacao ' + r.classificacao;
                classificacao.src = BASE_URL + 'assets/Jogos/classificacao/age' + r.classificacao + '.png';

                notaContainer.classList.add('itemListaJogoNotaContainer');
                nota.classList.add('itemListaJogoNota');
                nota.innerHTML = '<i class="bi bi-star-fill"></i> ' + notaJogo;

                inputJogoID.type = 'hidden';
                inputJogoID.classList.add('inputJogoID');
                inputJogoID.value = r.jogoID;
                
                coverContainer.appendChild(cover);

                tituloContainer.appendChild(titulo);
                jogoInfo.appendChild(tituloContainer);
                jogoInfo.appendChild(platContainer);
                jogoInfo.appendChild(notaContainer);

                classificacaoContainer.appendChild(classificacao);

                notaContainer.appendChild(nota);

                itemListaJogo.appendChild(coverContainer);
                itemListaJogo.appendChild(jogoInfo);
                itemListaJogo.appendChild(classificacaoContainer);
                itemListaJogo.appendChild(inputJogoID);

                listaJogo.appendChild(itemListaJogo);
                $(itemListaJogo).on('click', bsModalToggle);
            }
        }
    })
}

function mudaPagina() {
    if ($(this).attr('id') == 'rightPageBtn') {
        
        if (Pagination.curPage != Pagination.totalPages)
            Pagination.curPage++;

        if (Pagination.curPage == Pagination.totalPages)
            $(this).removeClass('active');

        $('#leftPageBtn').addClass('active');
    } else {
        if (Pagination.curPage > 1)
            Pagination.curPage--;

        if (Pagination.curPage == 1)
            $(this).removeClass('active');

        $('#rightPageBtn').addClass('active');
    }
    $('#currentPage').text(Pagination.curPage);
    $('.paginationBtn.active').on('click', mudaPagina);

    carregaJogos();
}

function search() {
    $.ajax({
        url: BASE_URL + 'form/buscaTotalJogosPesquisa.php',
        method: 'POST',
        data: {
            search: '%' + $('#gameSearchbar').val() + '%'
        },
        success: function(result) {
            $('#totalPages').text(Math.ceil(result / 10));
            Pagination.totalPages = Math.ceil(result / 10);
            Pagination.curPage = 1;
            if (Pagination.curPage == Pagination.totalPages) {
                $('#rightPageBtn').removeClass('active');
                $('#rightPageBtn').off();
            } else {
                $('#rightPageBtn').addClass('active');
                $('#rightPageBtn').on('click', mudaPagina);
            }

            $('#leftPageBtn').removeClass('active');
            $('#leftPageBtn').off();
        }
    }).then(function() {
        carregaJogos();
    });
}

$('#gameSearchbar').on('input', search);
$('.paginationBtn.active').on('click', mudaPagina);
$('.fecharModalBtn').on('click', function() {
    $('#excluiJogoModal').modal('toggle');
});