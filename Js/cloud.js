$(document).ready(function() {
    $('.addFile').on('click', function(event) {
        event.preventDefault();
        $('.inputFile').trigger('click');
        $('.sendFile').show();
        $('.cancelFile').show();
        $(this).hide();
    });

    $('.sendFile').on('click', function(event) {
        event.preventDefault();
        $('#formFile').submit();
    });

    $('.cancelFile').on('click', function(event) {
        event.preventDefault();
        $('.sendFile').hide();
        $('.addFile').show();
        $('.inputFile').replaceWith($('.inputFile').val('').clone(true));
        $(this).hide();
    });
});