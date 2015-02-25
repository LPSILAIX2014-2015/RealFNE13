/**
 * Controlateur de changement d'image
 * @author Cesar Hernandez <[Mex]>
 */
$('input[id=lefile]').change(function() {
	$('#photoCover').val($(this).val());
});

$(document).ready(function(){

    $("#chI").hide();
    var fileExtension = "";
    $(':file').change(function()
    {
        var file = $("#sel_img")[0].files[0];
        var fileName = file.name;
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        if (isImage(fileExtension)) {
        	var fileSize = file.size;
	        var fileType = file.type;
	        showMessage("<p class='bg-warning'>Fichier à télécharger : "+fileName+", poid total: "+fileSize+" octets.</p>");
	        $('#sel_img-error').remove();
        } else{
        	document.getElementById('frmCHIMG').reset();
        	$('#sel_img-error').remove();
        	message = $("<p class='bg-danger'>Le fichier n'est pas une image!!</p>");
            showMessage(message);
        }
    });
 	$('#frmCHIMG').validate({
        rules:{
            sel_img:{required:true}
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        },
        submitHandler: function(form){
        	//Donées du formulaire
	        var formData = new FormData($("#frmCHIMG")[0]);
	        var message = "";

	        $.ajax({
	            url: 'index.php?EX=chImg',
	            type: 'POST',
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false,
	            beforeSend: function(){
	                message = $("<p class='bg-danger'>Transfert en cours, attendez s\'il vous plaît ...</p>");
	                showMessage(message)
	            },
	            success: function(data){
	                message = $("<p class='bg-success'>L\'image a été téléchargé avec succès.</p>");
	                showMessage(message);
	                document.getElementById('frmCHIMG').reset();
	                setTimeout('redirect()',1100);
	            },
	            error: function(){
	                message = $("<p class='bg-danger'>Une erreur est survenue pendant le téléchargement de l\'image</p>");
	                showMessage(message);
	            }
	        });
        }
    });
})
 function redirect () {
 	location.href='index.php?EX=profil';
 }
// Function pour montrer un message
function showMessage(message){
    $("#chI").html("").show();
    $("#chI").html(message);
}
// Verification d'extension de l'image
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
