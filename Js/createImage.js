$(document).ready(function(){               
    $('#photo').change(function()
    {
        var file = $("#photo")[0].files[0];
        var fileName = file.name;
        var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        if (isImage(fileExtension)) {
            var fileSize = file.size;
            var fileType = file.type;
            showMessage("<p class='bg-warning'>Fichier à télécharger: "+fileName+", taille totale: "+fileSize+" bytes.</p>");
            setTimeout('redirect()',1800);
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
        success: function(element) {
            setTimeout('redirect()',1800);
        }

    });
});

function redirectCreate () {
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