$(document).ready(function(){
    $("#chI").hide();
    var file = $("#photo")[0].files[0];
    var fileName = file.name;
    var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
    $('#updateMemberForm').validate({
        success: function(element) {
            if (isImage(fileExtension)) {
                var fileSize = file.size;
                var fileType = file.type;
                showMessage("<p class='bg-warning'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</p>");
                $('#sel_img-error').remove();
            } else{
                document.getElementById('fileName = file.name;').reset();
                $('#sel_img-error').remove();
                message = $("<p class='bg-danger'>Le fichier n'est pas une image!!</p>");
                showMessage(message);
            }
        },
        error: function(){
            message = $("<p class='bg-danger'>Une erreur est survenue pendant le téléchargement de l\'image</p>");
            showMessage(message);
        }
    });
});

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