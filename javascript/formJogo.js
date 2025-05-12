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

$('#nomeJogoInput').on('focus', function() {
    $('#nomeJaExisteWarning').hide();
});

$('.formJogoImgInput').on('change', function() {
    file = $(this).val();
    src = '';
    const fr = new FileReader();
    fr.addEventListener('load', () => {
        src = fr.result
        $(this).parent().find('.formJogoImgPreview').attr('src', src);
        $(this).parent().find('.formJogoImgContainerPreview').show();
    });
    fr.readAsDataURL($(this).prop('files')[0]);
});