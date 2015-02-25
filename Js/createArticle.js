$(document).ready(function() {


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

            //... sinon on cache les boutton et on affiche le contenu de création d'article.
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
                        var label = prompt("Tapez le libelle du lien ?") || "";
                        startTag = "<lien url=\"" + currentSelection + "\">";
                        currentSelection = label;
                    } else {
                        // La sélection n'est pas un lien, donc c'est le libelle. On demande alors l'URL
                        var URL = prompt("copier l'URL de votre lien ici\n(clique droit - copier sur l'URL voulu\n clique droit - coller sur la zone de texte ci dessous)");
                        startTag = "<lien url=\"" + URL + "\">";
                    }
                } else { // Pas de sélection, donc on demande l'URL et le libelle
                    var URL = prompt("copier l'URL de votre lien ici\n(clique droit - copier sur l'URL voulu\n clique droit - coller sur la zone de texte ci dessous)") || "";
                    var label = prompt("Quel est le libellé du lien ?") || "";
                    startTag = "<lien url=\"" + URL + "\">";
                    currentSelection = label;
                }
                break;

            case "cite":

                endTag = "</cite>";
                var auteur = prompt("Qui est l'auteur de la citation ? (ne mettez rien s'il n'y en a pas)") || "";
                var citation = prompt("Quelle est la citation ?") || "";
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
    
    //On recup les balise de citation
    field = field.replace(/<cite>([\s\S]*?)<\/cite>/g, '<div class="txtIta">"$1"</div>');
    field = field.replace(/<taille valeur=\"(.*?)\">([\s\S]*?)<\/taille>/g, '<span class="$1">$2</span>');

    //On recupere les balise de "taille" pour leur appliquer leur style
    field = field.replace(/<taille valeur/g, '<span class');
    field = field.replace(/<\/taille>/g, '</span>');

    //On recupere les balise de formattage de texte pour leur appliquer leur style
    field = field.replace(/<aligne valeur="gauche/g, '<p align="left');
    field = field.replace(/<aligne valeur="droite/g, '<p align="right');
    field = field.replace(/<aligne valeur="centrer/g, '<p align="center');
    field = field.replace(/(<\/aligne>\n|<\/aligne>)/g, '</p>');

    //On affiche enfin le résultat dans le div de preview. OKLM
    $("#previewDiv").append("<p>"+ field +"</p>");
    $("#textareaDecrypt").prop('value', "<p>"+ field +"</p>");

};

/*

    [a-z0-9._-]+

    //Envoi au serveur
    field = field.replace(/&/g, '&amp;');
    field = field.replace(/</g, '<').replace(/>/g, '>');
    field = field.replace(/\n/g, '<br />').replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

    field = field.replace(/<gras>([\s\S]*?)<\/gras>/g, '<b>$1</b>');
    field = field.replace(/<italique>([\s\S]*?)<\/italique>/g, '<i>$1</i>');
    field = field.replace(/<lien>([\s\S]*?)<\/lien>/g, '<a href="$1">$1</a>');
    field = field.replace(/<lien url="([\s\S]*?)">([\s\S]*?)<\/lien>/g, '<a href="$1" title="$2">$2</a>');
    field = field.replace(/<cite nom=\"(.*?)\">([\s\S]*?)<\/cite>/g, '<br /><span class="cite">Cite : $1</span><div class="txtIta">$2</div>');
    field = field.replace(/<cite lien=\"(.*?)\">([\s\S]*?)<\/cite>/g, '<br /><span class="cite"><a href="$1">Cite</a></span><div class="txtIta">$2</div>');
    field = field.replace(/<cite nom=\"(.*?)\" lien=\"(.*?)\">([\s\S]*?)<\/cite>/g, '<br /><span class="cite"><a href="$2">Cite : $1</a></span><div class="txtIta">$3</div>');
    field = field.replace(/<cite lien=\"(.*?)\" nom=\"(.*?)\">([\s\S]*?)<\/cite>/g, '<br /><span class="cite"><a href="$1">Cite : $2</a></span><div class="txtIta">$3</div>');
    field = field.replace(/<cite>([\s\S]*?)<\/cite>/g, '<br /><span class="cite">Cite</span><div class="txtIta">$1</div>');
    field = field.replace(/<taille valeur=\"(.*?)\">([\s\S]*?)<\/taille>/g, '<span class="$1">$2</span>');

    field = field.replace(/&/g, '&amp;');

    field = field.replace(/</g, '&lt;').replace(/>/g, '&gt;');

    field = field.replace(/\n/g, '<br />').replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

    field = field.replace(/&lt;gras&gt;([\s\S]*?)&lt;\/gras&gt;/g, '<strong>$1</strong>');
    field = field.replace(/&lt;italique&gt;([\s\S]*?)&lt;\/italique&gt;/g, '<em>$1</em>');
    
    field = field.replace(/&lt;lien&gt;([\s\S]*?)&lt;\/lien&gt;/g, '<a href="$1">$1</a>');
    field = field.replace(/&lt;lien url="([\s\S]*?)"&gt;([\s\S]*?)&lt;\/lien&gt;/g, '<a href="$1" title="$2">$2</a>');
    field = field.replace(/&lt;image&gt;([\s\S]*?)&lt;\/image&gt;/g, '<img src="$1" alt="Image" />');
    field = field.replace(/&lt;citation nom=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation">Citation : $1</span><div class="citation2">$2</div>');
    field = field.replace(/&lt;citation lien=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$1">Citation</a></span><div class="citation2">$2</div>');
    field = field.replace(/&lt;citation nom=\"(.*?)\" lien=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$2">Citation : $1</a></span><div class="citation2">$3</div>');
    field = field.replace(/&lt;citation lien=\"(.*?)\" nom=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$1">Citation : $2</a></span><div class="citation2">$3</div>');
    field = field.replace(/&lt;citation&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation">Citation</span><div class="citation2">$1</div>');
    field = field.replace(/&lt;taille valeur=\"(.*?)\"&gt;([\s\S]*?)&lt;\/taille&gt;/g, '<span class="$1">$2</span>');
    
*/