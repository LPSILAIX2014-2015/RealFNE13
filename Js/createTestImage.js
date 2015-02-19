$(document).ready(function(){
    $("#chI").hide();
    var file = $("#photo")[0].files[0];
    var fileName = file.name;
    var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
    $(':file').change(function()
    {
        if (isImage(fileExtension)) {
            var fileSize = file.size;
            var fileType = file.type;
            showMessage("<p class='bg-warning'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</p>");
        } else{
            document.getElementById('photo').value="";
            message = $("<p class='bg-danger'>Le fichier n'est pas une image!!</p>");
            showMessage(message);
        }
        $('#createMemberForm').validate({
            rules:{
                photo:{required:true}
            },
            highlight: function(element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function(element) {
                element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
            }
        });
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