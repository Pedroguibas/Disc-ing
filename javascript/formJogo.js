$('#formRegistroJogo').on('submit', function(e) {
    e.preventDefault();
    let count=0;

    if($('.platCheckInput:checked').length == 0) {
        $('#nenhumaPlataformaWarning').show();
        count++;
    }
    $.ajax({
        url: BASE_URL + 'form/validaNomeJogo.php',
        method: 'GET',
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