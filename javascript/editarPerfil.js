function carregaFotoPerfil() {
    let caminho = 'assets/usuarios/profilePic' + userID + '.jpg'
    $.ajax({
        url: BASE_URL + 'form/checaArquivo.php',
        method: 'GET',
        data: {
            path: caminho
        },
        success: function(result) {
            if (result == 1) 
                $('#fotoDePerfilPreview').attr('src', BASE_URL + caminho);
            else
                $('#fotoDePerfilPreview').attr('src', BASE_URL + 'assets/usuarios/unknownUser.jpg');
        }
    });
}

$('#profilePicInput').on('change', function() {
    file = $(this).val();
    src = '';
    const fr = new FileReader();
    fr.addEventListener('load', () => {
        src = fr.result
        $('#fotoDePerfilPreview').attr('src', src);
    });
    fr.readAsDataURL($(this).prop('files')[0]);
});

$('#mostrarFotoDePerfilInputBtn').on('click', function() {
    $('#fotoDePerfilInputContainer').toggle();
    if ($(this).text() == 'Cancelar')
        $(this).text('Alterar');
    else
        $(this).text('Cancelar');
        
});

$('#editarPerfilBtn').on('click', function() {
    $('#editarPerfilModal').modal('toggle');
});
$('.fecharModalBtn').on('click', function() {
    $('#editarPerfilModal').modal('toggle');
});