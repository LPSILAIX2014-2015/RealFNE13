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

    $('.buttonDeleteCloud').on('click', function() {
        if(confirm("Êtes vous sur de vouloir supprimer le document ?"))
        {
            $(this).parent().parent().remove();
            td = $(this).parent().parent();
            var id = td.attr('id');
            id = id.replace('cloud', '');
            $.getJSON('Ajax/deleteCloud.php', { id : id }).done(function() {
                document.location.href = "index.php?EX=cloud";
            });
        }
    });
});