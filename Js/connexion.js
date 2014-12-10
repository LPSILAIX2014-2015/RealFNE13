// ToDo inclure le fichier connexion.js dans un fichier appelant tout les JS (comme xhtml.css pour le css)

// JQuery
$(document).ready(function() {

    $('#formconnec').submit(function(){
        var urlFunction = "../Php/connexion.php";
        var szLogin = $('#login').value();
        var szPassword = $('#password').value();

        $.ajax({
            url : urlFunction,
            type: "POST",
            data:
            {
                login : szLogin,
                password : szPassword
            }
        }).done(function () {
            location.reload();
        });
    });
});