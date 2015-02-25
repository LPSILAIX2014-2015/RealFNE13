$(document).ready(function(){
    $('#newphoto').change(function()
    {
        var file = $("#newphoto")[0].files[0];
        var fileName = file.name;
        var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        if (isImage(fileExtension)) {
            var fileSize = file.size;
            var fileType = file.type;
            showMessage("<p class='bg-warning'>Fichier à télécharger: "+fileName+", taille totale: "+fileSize+" bytes.</p>");
        } else{
            $('#newphoto').value="";
            message = $("<p class='bg-danger'>Le fichier n'est pas une image!!</p>");
            showMessage(message);
        }
    });
    $('#updateMemberForm').validate({
        rules:{
            newphoto:{required:true}
        },
        success: function(element) {
            setTimeout('redirect()',1800);
        }

    });
});

function redirect () {
    location.href='index.php?EX=updateAMember&id='+'<?php echo $id?>';
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