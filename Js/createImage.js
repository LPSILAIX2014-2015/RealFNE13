$(document).ready(function(){               
    $(':file').change(function()
    {
        var file = $("#photo")[0].files[0];
        var fileName = file.name;
        var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        if (isImage(fileExtension)) {
            var fileSize = file.size;
            var fileType = file.type;
            showMessage("<p class='bg-warning'>Fichier à télécharger: "+fileName+", taille totale: "+fileSize+" bytes.</p>");
        } else{
            $("#photo").val('');
            message = $("<p class='bg-danger'>Le fichier n'est pas une image!!</p>");
            showMessage(message);
        }
    });
    $('#createMemberForm').validate({
        rules:{
            photo:{required:true}
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        },
        submitHandler: function(form){
            //Donées du formulaire
            var formData = new FormData($("#createMemberForm"));
            var message = "";

            $.ajax({
                url: 'Php/update-mail.php?email='+'<?php echo $email?>',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    message = $("<p class='bg-success'>L\'image a été téléchargé avec succès.</p>");
                    showMessage(message);
                    setTimeout('redirect()',1100);
                },
                error: function(){
                    message = $("<p class='bg-danger'>Une erreur est survenue pendant le téléchargement de l\'image</p>");
                    showMessage(message);
                }
            });
        }
    });
});

function redirect() {
    location.href='Php/update-mail.php?email='+'<?php echo $email?>';
}

function showMessage(message){
    $("#chI").html("").show();
    $("#chI").html(message);
}

function isImage(extension)
{
    switch(extension.toLowerCase())
    {
        case 'jpg': case 'gif': case 'png': case 'jpeg':
        return true;
        break;
        default:
            return false;
            break;
    }
}