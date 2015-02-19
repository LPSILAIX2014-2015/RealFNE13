$(document).ready(function(){ // Fonction pour valider la première formulaire 
    $("#formconnec").validate({
        rules:{
            login:{required:false},
            password:{required:false}
        },
        submitHandler: function(form){
            var dataString = 'login='+$('#login').val()+'&password='+$('#password').val(); // les données à encoyer en AJAX
            $.ajax({
                type: "POST", // Mèthode d'envoi
                url:"index.php?EX=login",
                data: dataString,
                success: function(data){
                    $("#result").show();
                    $("#result").html(data);  
                    //location.replace('index.php');              
                }
            });
        }
    });
}); // end document.ready