$('input[id=lefile]').change(function() {
	$('#photoCover').val($(this).val());
});

$(document).ready(function(){
 
    $("#chI").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    $(':file').change(function()
    {
        var file = $("#sel_img")[0].files[0];
        var fileName = file.name;
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        if (isImage(fileExtension)) {
        	var fileSize = file.size;
	        var fileType = file.type;
	        showMessage("<p class='bg-warning'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</p>");
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
	                setTimeout('',5500);
                    //location.replace('index.php?EX=profil');
	            },
	            error: function(){
	                message = $("<p class='bg-danger'>Une erreur est survenue pendant le téléchargement de l\'image</p>");
	                showMessage(message);
	            }
	        });
        }
    });
})
 
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