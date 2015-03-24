
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
                         showMassageError('On a envoyé un mail avec un lien pour changer votre mot de passe!');
                         $('#mailR').val('');
                         setTimeout('redirectI()',1500);
                    }else{
                        $("#res").html(data);
                        $("#res").show();
                    }                    
                }
            });
        }
    });
}); // end document.ready
function redirectI() {
    location.href='index.php';
 }
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
                        showMassageError('Changement Valide!');
                        setTimeout('redirectI()',1000);
                    }else{
                        $("#res").html(data);
                        $("#res").show();
                    }
                }
            });
        }
    });
}); // end document.ready

function view(element) {
   var theDiv=document.getElementById(element);
   if(theDiv.style.display == 'block') {
      theDiv.style.display = 'none';
   } else {
      theDiv.style.display = 'block';
   }
}

$(document).ready(function(){ // Fonction pour valider le deuxième formulaire (recuperation)
    $("#chP").hide();
    $("#formCHMP").validate({
        rules:{
            act_pass:{required:true},
            new_pass:{required:true, minlength: 4},
            rnew_pass:{required:true, minlength: 4, equalTo: "#new_pass"},
            iCaptcha:{required:true, minlength: 6}
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        },
        submitHandler: function(form){
            var dataString = 'act_pass='+$('#act_pass').val()+'&new_pass='+$('#new_pass').val()+'&rnew_pass='+$('#rnew_pass').val()+'&iCaptcha='+$('#iCaptcha').val();
            $.ajax({
                type: "POST", // Mèthode AJAX pour envoyer les données
                url:"index.php?EX=changePass",
                data: dataString,
                success: function(data){
                    if(data==1){ // Verification selon les resultats du Modèle
                        $("#chP").show();
                        restartAll();
                        showMassageError('Mot de passe changé');
                        $("#ch").hide();
                        $("#chP").hide();
                    }else{
                        $("#chP").html(data);
                        $("#chP").show();
                    }
                }
            });
        }
    });

    //formulaire de maj profile
    $("#formprofil").validate({
        rules:{
            profession:{required:true},
            profession2:{required:true},
            presentation:{required:true},
            theme:{required:true},
            themedetails:{required:true},
            theme2:{required:true}
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        },
        submitHandler: function(form){
            var dataString = 'profession='+$('#profession').val()+'&profession2='+$('#profession2').val()+'&presentation='+$('#presentation').val()+'&theme='+$('#themes1').val()+'&themedetails='+$('#themedetails').val()+'&theme2='+$('#themes2').val()+'&id='+$('#user_id').val();
            $.ajax({
                type: "POST", // Mèthode AJAX pour envoyer les données
                url:"Php/updateMember.php",
                data: dataString,
                success: function(data){
                    if(data==1){ // Verification selon les resultats du Modèle
                        $("#chP1").show();
                        restartAll();
                        showMassageError('Mot de passe changé');
                        $("#ch1").hide();
                        $("#chP1").hide();
                    }else{
                        $("#chP1").html(data);
                        $("#chP1").show();
                    }
                }
            });
        }
    });
}); // end document.ready
function restartAll () {
    document.getElementById('formCHMP').reset();
    $("#act_pass").removeClass('valid');
    $("#act_pass").removeClass('norequired');
    $('#act_pass-error').remove();
    $('#new_pass-error').remove();
    $('#rnew_pass-error').remove();
    $("#iCaptcha").removeClass('valid');
    $("#iCaptcha").removeClass('norequired');
    $('#iCaptcha-error').remove();
}
