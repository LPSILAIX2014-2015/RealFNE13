
$(document).ready(function(){ // Fonction pour valider la première formulaire 
    $("#frmRMail").validate({
        rules:{
            mailR:{required:true, email:true}
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        },
        submitHandler: function(form){
            var dataString = 'mail='+$('#mailR').val(); // les données à encoyer en AJAX
            $.ajax({
                type: "POST", // Mèthode d'envoi
                url:"index.php?EX=mailconf",
                data: dataString,
                success: function(data){
                     if(data==1){
                         $("#res").show();
                         showMassageError('Valide');
                         $('#mailR').val('');
                         setTimeout('',1500);
                    }else{
                        $("#res").html(data);
                        $("#res").show();
                    }                    
                }
            });
        }
    });
}); // end document.ready

$(document).ready(function(){ // Fonction pour valider le deuxième formulaire (recuperation)
    $("#result").hide();
    $("#formRMP").validate({
        rules:{
            mail:{required:true, email:true},
            pass1:{required:true, minlength: 4},
            pass2:{required:true, minlength: 4, equalTo: "#pass1"},
            iCaptcha:{required:true, minlength: 6}
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        },
        submitHandler: function(form){
            var dataString = 'mail='+$('#mail').val()+'&pass1='+$('#pass1').val()+'&pass2='+$('#pass2').val()+'&iCaptcha='+$('#iCaptcha').val();
            $.ajax({
                type: "POST", // Mèthode AJAX pour envoyer les données
                url:"index.php?EX=insert",
                data: dataString,
                success: function(data){
                    if(data==1){ // Verification selon les resultats du Modèle
                        $("#res").show();
                        showMassageError('Valide');
                        setTimeout('',1500);
                        location.replace('index.php');
                    }else{
                        $("#res").html(data);
                        $("#res").show();
                    }
                }
            });
        }
    });
}); // end document.ready
