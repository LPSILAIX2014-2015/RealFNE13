$(document).ready(function() {
    $('.addFile').on('click', function(event) {
        event.preventDefault();
        $('.inputFile').trigger('click');
        //$(this).hide();
    });

    $('.inputFile').on('change', function(event) {
        $('.sendFile').hide();
        $('.cancelFile').hide();
        $('.addFile').hide();
        $('.valInput').empty();
        if($(this).val() != '')
        {
            var filename = $(this).val();
            filename = baseName(filename);
            $('.valInput').html(filename);
            $('.sendFile').show();
            $('.cancelFile').show();
        }
        else
        {
            $('.addFile').show();
        }
    });

    $('.sendFile').on('click', function(event) {
        event.preventDefault();
        if($('.inputFile').val() != '')
        {
            $('#formFile').submit();
        }
    });

    $('.cancelFile').on('click', function(event) {
        event.preventDefault();
        $('.sendFile').hide();
        $('.valInput').empty();
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

function baseName(path)
{
   return path.replace(/\\/g,'/').replace( /.*\//, '' );
}