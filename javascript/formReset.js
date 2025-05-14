$('form').on('submit', function() {
    $(this).preventDefault();
    $(this).submit();
    this.reset();
});