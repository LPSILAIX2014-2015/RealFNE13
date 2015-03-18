$(document).ready(function() {

        //Create News
        $('#formArticle').on('submit', function (e) {
            // On empêche le navigateur de soumettre le formulaire
            e.preventDefault();

            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var data = (formdata !== null) ? formdata : $form.serialize();

            console.log($('#articleImage').val());

            console.log($('#articleImage').val().substr(-4,4));

            $.ajax({
                url: 'Ajax/creationArticleHandler.php',
                type: $form.attr('method'),
                contentType: false, // obligatoire pour de l'upload d'image
                processData: false, // obligatoire pour de l'upload d'image
                data: data,
                success: function(response){

                    var result = JSON.parse(response);

                    switch(result.errorType)
                    {
                        case 'Err_NoTittle':
                            alert("Erreur : Vous devez mettre un titre à votre article.");
                            break;
                        case 'Err_NotAnImage':
                            alert("Erreur : une erreur est survenue, pour des raisons de sécurité, seules les images au format jpg, jpeg et png de taille inférieur à 5 MB sont autorisées.")
                            break;
                        case 'Err_UserNotLogged':
                            alert("Erreur : Vous n'êtes pas connecté.");
                            break;
                        case 'Err_FileTooFat':
                            alert("Erreur : Le fichier que vous avez seléctionné est trop volumineux.");
                            break;
                        case 'Err_UploadFail':
                            alert("Erreur : Un problème est survenu lors du chargement de votre image.");
                            break;
                        case 'Err_QueryFail':
                            alert("Erreur : Votre article n'a pas pu être enregistré (Avez-vous les droits?).");
                            break;
                        case 'Err_NoText':
                            alert("Erreur : Pour limiter l'abus de création d'article, veuillez saisir plus de 50 caractères dans le corps de votre article.");
                            break;
                        case 'EverythingOK':
                            alert("Votre article à été envoyé à la validation, vous pouvez contacter la personne en charge de la validation d'article de votre association pour voir son avancement.")
                            location.reload();
                            break;
                    }
                }
            });
        });

    $('#btnHelp').on('click', function(){
        var help1 =  "Ce traitement de texte fonctionne à l'aide de balise. elles sont représentées par les symboles '<>' et '</>', " +
                     "pour activer les effets de ces différentes balises, vous devez écrire votre texte entre elles.";

        var help2 = "Voici la liste des différentes option possibles :\n\n" +
                    "- Mettre le texte en gras -> il faut insérer le texte que vous voulez afficher en gras entre les balises <g> et </g>\n\n" +
                    "- Mettre le texte en italique -> il faut insérer le texte que vous voulez afficher en italique entre les balises <i> et </i>\n\n" +
                    "- Souligner le texte (underline en anglais) -> il faut insérer le texte que vous voulez souligner entre les balises <u> et </u>\n\n";

        var help3 = "- aligner le texte sur la gauche (activé par défaut) -> il faut insérer le texte que vous voulez aligner entre les balises <aligne valeur=\"gauche\"> et </aligne>\n\n" +
                    "- aligner le texte sur la droite -> il faut insérer le texte que vous voulez aligner entre les balises <aligne valeur=\"droite\"> et </aligne>\n\n" +
                    "- centrer le texte -> il faut insérer le texte que vous voulez aligner entre les balises <aligne valeur=\"centrer\"> et </aligne>\n\n";

        var help4 = "il y 5 tailles de police d'écriture :\n\n"+
                    "- très petite -> il faut insérer le texte entre les balises <taille valeur=\"tpetit\"> et </taille>\n\n" +
                    "- petite -> il faut insérer le texte entre les balises <taille valeur=\"petit\"> et </taille>\n\n" +
                    "- normal -> c'est la taille par défaut, il n'y a pas besoin de balise\n\n" +
                    "- gros -> il faut insérer le texte entre les balises <taille valeur=\"gros\"> et </taille>\n\n" +
                    "- très gros -> il faut insérer le texte entre les balises <taille valeur=\"tgros\"> et </taille>";

        var help5 = "il est possible de combiner ces balises pour par exemple avoir un texte écrit en gros, souligner et aligner sur la droite."+
                    "il suffit de placer les balises à l'interieur de balises. vous pouvez mettres les balise de dans n'importe quel ordre sauf pour les balise d'alignement qui doivent être misent en dernières.";

        var help6 = "Vous pouvez utiliser les boutons situés au dessus de la zone de saisie pour placer automatiquement les balises. "+
                    "si vous surligner votre texte et que vous cliquez sur un boutons, les balises vont venir encadrer votre texte surligner pour lui appliquer leur effet.\n\n"+
                    "Parmis ces boutons, il y en a 2 spéciaux qui permettent d'insérer des liens pour des pages internet ou des citations, "+
                    "il vous suffira de lire les instructions affichées à l'écran lors du clique sur ces bouttons.\n\n"+
                    "Il est également possible de coller un fichier existant dans le cloud du site, pour cela rendez-vous"+
                    "sur la page de partage et copier l'URL du fichier que vous voulez mettre à disposition dans votre article.\n\n";

        var help7 = "Pour toutes autre questions, veuillez contacter l'administrateur de votre association.";

        alert(help1);
        alert(help2);
        alert(help3);
        alert(help4);
        alert(help5);
        alert(help6);
        alert(help7);
    })

    /////////////////////////////////////////
    ////////// Gestion des bouttons /////////
    /////////////////////////////////////////

    $(function(){
        //Lors d'un clic sur un des boutton
        $(".buttonCreate").on('click',function(){
            $("#errorMsg").prop('hidden', true); //Le message d'erreur est caché par défaut

            //Si l'utilisateur n'est pas enregistré ...
            if ($("#verfiUser").val() == ''){    
                $("#errorMsg").empty();
                $("#errorMsg").append('<p>Vous devez être connecté pour écrire un article !</p>');
                $("#errorMsg").prop('hidden', false); //... un message d'erreur apparait ...
            }

            //... sinon on cache les bouttons et on affiche le contenu de création d'article.
            else{
                $("#resetForm").trigger( "click" );
                $("#buttonCreationArticle").prop('hidden', true);
                $("#contentCreateArticle").prop('hidden', false);
            }
        });
    });

    $(function(){
        //Si le bouton cliqué est celui de création d'article lié à l'agenda ...
        $("#buttonCreateArticleInCalendar").on('click',function(){
            $(".inputOnlyCalendar").prop('hidden', false); // ... On affiche les champs obligatoires pour les article liée à l'agenda
        });
    });
});

var cancelCreactArticle = function(){
    $("#resetForm").trigger( "click" ); // Lors d'un click sur le bouton "tout effacer", on remet les champs du formulaire à leur valeur par défaut
    location.reload();
}

/////////////////////////////////////////
/// Formattage du texte de l'article ////
/////////////////////////////////////////


var insertTag = function(startTag, endTag, tagType){

    //Capture du tag de valeur taille normal (soucis de lisibilité)
    if(startTag == "\<taille valeur=\"normal\">"){
        startTag = "";
        endTag = "";
    }

    //On se place sur le textarea, scroll auto si necessaire.
    var field  = document.getElementById('textareaId');
    var scroll = field.scrollTop;
    field.focus();

    //Recuperation des infos sur le texte selectionné (Easier in JS than jquery)
    var startSelection   = field.value.substring(0, field.selectionStart);
    var currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
    var endSelection     = field.value.substring(field.selectionEnd);

    if (tagType) {    //Pas super utile mais on laisse en switch/case au cas où on ajouterait des operations
        switch (tagType) {

            case "lien":

                endTag = "</lien>";
                if (currentSelection) { // Il y a une sélection
                    if (currentSelection.indexOf("http://") == 0 || currentSelection.indexOf("https://") == 0 || currentSelection.indexOf("ftp://") == 0 || currentSelection.indexOf("www.") == 0) {
                        // La sélection semble être un lien. On demande alors le libellé
                        var label = prompt("Tapez le libelle du lien ?\n\nexemple : lien vers google\n\n/!\\ Des balises vont être insérées dans votre traitement de texte /!\\") || "";
                        startTag = "<lien url=\"" + currentSelection + "\">";
                        currentSelection = label;
                    } else {
                        // La sélection n'est pas un lien, donc c'est le libelle. On demande alors l'URL
                        var URL = prompt("copier l'URL de votre lien ici\n(clique droit - copier sur l'URL voulu\n clique droit - coller sur la zone de texte ci dessous)\n\nexemple: http://www.google.fr\n\n/!\\ Des balises vont être insérées dans votre traitement de texte /!\\");
                        startTag = "<lien url=\"" + URL + "\">";
                    }
                } else { // Pas de sélection, donc on demande l'URL et le libelle
                    var URL = prompt("copier l'URL de votre lien ici\n(clique droit - copier sur l'URL voulu\n clique droit - coller sur la zone de texte ci dessous)\n\nexemple: http://www.google.fr") || "";
                    var label = prompt("Quel est le libellé du lien ?\n\nexemple : lien vers google\n\n/!\\ Des balises vont être insérées dans votre traitement de texte /!\\") || "";
                    startTag = "<lien url=\"" + URL + "\">";
                    currentSelection = label;
                }
                break;

            case "cite":

                endTag = "</cite>";
                var auteur = prompt("Qui est l'auteur de la citation ? (ne mettez rien s'il n'y en a pas)\n\nexemple : Aristote") || "";
                var citation = prompt("Quelle est la citation ?\n\nexemple : Le doute est le commencement de la sagesse.\n\n/!\\ Des balises vont être insérées dans votre traitement de texte /!\\") || "";
                if (auteur == '') {
                    startTag = "<cite>";
                } else {
                    startTag = "<cite nom=\"" + auteur + "\">";
                }

                currentSelection = citation;

            break;
        }
    }

    field.value = startSelection + startTag + currentSelection + endTag + endSelection; //on formate le texte
    field.focus();  // On remet le focus sur la zone de texte

    // On recalcul la zone de selection avec les balises ajoutées
    field.setSelectionRange(startSelection.length + startTag.length, startSelection.length + startTag.length + currentSelection.length);

    field.scrollTop; // On replace bien le scroll.
};

/////////////////////////////////////////
////////// PREVISUALISATION /////////////
/////////////////////////////////////////

var preview = function() {
    $("#previewDiv").empty();
    $("#textareaDecrypt").empty();
    var field = $("#textareaId").val();

    field = field.replace(/\n/g,"<br>");                        //... On remplace le sauts de ligne par de balises </br>
    field = field.replace(/<\/g>/g, '<\/b>');
    field = field.replace(/<g>/g, '<b>');                       //On remplace les balises g par des balises <b>.
    field = field.replace(/<i>/g, '<i class="txtIta">');        //Les balises <u> et <i> ne fonctionnant pas, on utilise des
    field = field.replace(/<u>/g, '<u class="txtUndln">');      //classes CSS pour formatter le texte.

    //On capture les balises correspondantes aux liens
    field = field.replace(/<lien url/g, '<a target="_blank" href');
    field = field.replace(/<\/lien>/g, '</a>');

    //Tous les cas possibles de combinaison de balises Lien + Citation
    field = field.replace(/<cite nom=\"(.*?)\">([\s\S]*?)<\/cite>/g, '<b>$1 :</b><div class="txtIta">"$2"</div>');
    field = field.replace(/<cite lien=\"(.*?)\">([\s\S]*?)<\/cite>/g, '<b><a href="$1">Citation</a></b><div class="txtIta">"$2"</div>');
    field = field.replace(/<cite nom=\"(.*?)\" lien=\"(.*?)\">([\s\S]*?)<\/cite>/g, '<b><a href="$2">$1 :</a></b><div class="txtIta">"$3"</div>');
    field = field.replace(/<cite lien=\"(.*?)\" nom=\"(.*?)\">([\s\S]*?)<\/cite>/g, '<b><a href="$1">$2 :</a></b><div class="txtIta">"$3"</div>');
    
    //On recup les balises de citation
    field = field.replace(/<cite>([\s\S]*?)<\/cite>/g, '<div class="txtIta">"$1"</div>');
    field = field.replace(/<taille valeur=\"(.*?)\">([\s\S]*?)<\/taille>/g, '<span class="$1">$2</span>');

    //On recupere les balises de "taille" pour leur appliquer leur style
    field = field.replace(/<taille valeur/g, '<span class');
    field = field.replace(/<\/taille>/g, '</span>');

    //On recupere les balises de formattage de texte pour leur appliquer leur style
    field = field.replace(/<aligne valeur="gauche/g, '<p align="left');
    field = field.replace(/<aligne valeur="droite/g, '<p align="right');
    field = field.replace(/<aligne valeur="centrer/g, '<p align="center');
    field = field.replace(/(<\/aligne>\n|<\/aligne>)/g, '</p>');

    //On affiche enfin le résultat dans le div de preview. OKLM
    $("#previewDiv").append("<p>"+ field +"</p>");
    $("#textareaDecrypt").prop('value', "<p>"+ field +"</p>");

};
