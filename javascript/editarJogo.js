let bannersrc = '';
let coversrc = '';

function buscaDadosJogo() {
    let search = '%' + $(this).find($('.inputJogoNome')).val() + '%';
    let gameID;
    $.ajax({
        url: BASE_URL + 'form/buscaJogos.php',
        method: 'POST',
        data: {
            search: search,
            offset: 0
        },
        success: function(result) {
            r = JSON.parse(result)[0];

            $('#inputJogoID').val(r.jogoID);

            $('#nomeJogoInput').val(r.jogoNome);
            $('option[value="'+ r.classificacao +'"]').attr('selected', 'selected');

            bannersrc = BASE_URL + 'assets/Jogos/banner' + r.jogoID + '.jpg';
            coversrc = BASE_URL + 'assets/Jogos/cover' + r.jogoID + '.jpg';

            $('#bannerPreview').attr('src', bannersrc);
            $('#bannerPreview').attr('alt', 'Banner ' + r.jogoNome);
            $('#coverPreview').attr('src', coversrc);
            $('#coverPreview').attr('alt', 'Cover ' + r.jogoNome);

            $('#sinopseTextarea').val((r.sinopse).replace(/&quot;/g, '"'));
            
            if (r.nintendoSwitch)
                $('.platCheckInput[value="switch"]').prop('checked', true);
            else
                $('.platCheckInput[value="switch"]').prop('checked', false);

            if (r.playstation)
                $('.platCheckInput[value="playstation"]').prop('checked', true);
            else
                $('.platCheckInput[value="playstation"]').prop('checked', false);

            if (r.xbox)
                $('.platCheckInput[value="xbox"]').prop('checked', true);
            else
                $('.platCheckInput[value="xbox"]').prop('checked', false);

            if (r.windowsOS)
                $('.platCheckInput[value="windowsOS"]').prop('checked', true);
            else
                $('.platCheckInput[value="windowsOS"]').prop('checked', false);

            if (r.linuxOS)
                $('.platCheckInput[value="linuxOS"]').prop('checked', true);
            else
                $('.platCheckInput[value="linuxOS"]').prop('checked', false);

            if (r.macOS)
                $('.platCheckInput[value="macOS"]').prop('checked', true);
            else
                $('.platCheckInput[value="macOS"]').prop('checked', false);

            if (r.androidOS)
                $('.platCheckInput[value="androidOS"]').prop('checked', true);
            else
                $('.platCheckInput[value="androidOS"]').prop('checked', false);

            gameID = r.jogoID;

        }
    }).then(function () {
        $.ajax({
                url: BASE_URL + 'form/buscaRequisitos.php',
                method: 'POST',
                data: {
                    j: r.jogoID
                },
                success: function(result) {
                    r = JSON.parse(result);
                    console.log(r);
                    $('#inputReqID').val(r.requisitosJogoID)
                    $('#soInput').val(r.so);
                    $('#cpuInput').val(r.cpu);
                    $('#gpuInput').val(r.gpu);
                    $('#ramInput').val(r.ram);
                    $('#armazenamentoInput').val(r.armazenamento);
                }
            })
    }).then(function () {
        $('#formUpdateJogo').show();
        $('#formUpdateJogo').get(0).scrollIntoView({behavior: 'smooth'});
    });
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
                let itemListaJogo = document.createElement('div');
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

                let inputJogoNome = document.createElement('input');


                let notaJogo = r.nAvaliacoes > 0 ? (r.nota / r.nAvaliacoes).toFixed(2) : '0.00';

                itemListaJogo.classList.add('itemListaJogo', 'd-flex', 'gap-2', 'col-md-8', 'col-12', 'mt-2');
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

                inputJogoNome.type = 'hidden';
                inputJogoNome.classList.add('inputJogoNome');
                inputJogoNome.value = r.jogoNome;
                
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
                itemListaJogo.appendChild(inputJogoNome);

                itemListaJogo.addEventListener('click', buscaDadosJogo);
                listaJogo.appendChild(itemListaJogo);
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
    $('.paginationBtn.active').unbind('click');
    $('.paginationBtn.active').on('click', mudaPagina);

    carregaJogos();
    $('#listaJogo').get(0).scrollIntoView({behavior: 'smooth'});
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
                $('#rightPageBtn').unbind('click');
                $('#rightPageBtn').on('click', mudaPagina);
            }

            $('#leftPageBtn').removeClass('active');
            $('#leftPageBtn').off();
        }
    }).then(function() {
        carregaJogos();
    });
}

function mostraInputImagem() {
    $(this).parent().find('.imageInputEditarJogo').show();
    $(this).text('Cancelar');
    $(this).addClass('esconderInputEditarJogoBtn');
    $(this).removeClass('mostrarInputEditarJogoBtn');
    $('.esconderInputEditarJogoBtn').on('click', escondeInputImagem);
}

function escondeInputImagem () {
    $(this).parent().find('.imageInputEditarJogo input').val('');
    $(this).parent().find('.imageInputEditarJogo').hide();
    $(this).text('Alterar');
    $(this).addClass('mostrarInputEditarJogoBtn');
    $(this).removeClass('esconderInputEditarJogoBtn');
    $('.mostrarInputEditarJogoBtn').on('click', mostraInputImagem);
    $(this).parent().find('#bannerPreview').attr('src', bannersrc);
    $(this).parent().find('#coverPreview').attr('src', coversrc);
}

$('.formJogoImgInput').on('change', function() {
    file = $(this).val();
    src = '';
    const fr = new FileReader();
    fr.addEventListener('load', () => {
        src = fr.result
        $(this).parent().parent().find('.formJogoImgPreview').attr('src', src);
    });
    fr.readAsDataURL($(this).prop('files')[0]);
});

$('#formRegistroJogo').on('submit', function(e) {
    e.preventDefault();

    let count=0;

    if($('.platCheckInput:checked').length == 0) {
        $('#nenhumaPlataformaWarning').show();
        count++;
    }
    $.ajax({
        url: BASE_URL + 'form/validaNomeJogo.php',
        method: 'POST',
        data:{
            nome: $('#nomeJogoInput').val()
        },
        success: function(result) {
            result = parseInt(result);
            if (result != 0) {
                count++
                $('#nomeJaExisteWarning').show();
                $('#nomeJogoInput').get(0).scrollIntoView({behavior: 'smooth'});
            }
        }
    }).then(function() {
        if (count == 0)
            $('#formRegistroJogo')[0].submit();
    });
});

$('.platCheckInput').on('change', function() {
    if ($('.platCheckInput:checked').length != 0) {
        $('#nenhumaPlataformaWarning').hide ();
    }
});


$('.mostrarInputEditarJogoBtn').on('click', mostraInputImagem);
$('.esconderInputEditarJogoBtn').on('click', escondeInputImagem);
$('#gameSearchbar').on('input', search);
$('.paginationBtn.active').on('click', mudaPagina);