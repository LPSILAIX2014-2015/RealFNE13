$(document).ready(function() {

    /////////////////////////////////////////
    ////////// Gestion des bouttons /////////
    /////////////////////////////////////////

    $(function(){
        $("#buttonCreateArticle").on('click',function(){
            $("#buttonCreationArticle").prop('hidden', true);
            $("#contentCreateArticle").prop('hidden', false);
        });
    });

    $(function(){
        $("#buttonCreateArticleInCalendar").on('click',function(){
            $("#buttonCreationArticle").prop('hidden', true);
            $("#contentCreateArticle").prop('hidden', false);
            $(".inputOnlyCalendar").prop('hidden', false);
        });
    });


});

/////////////////////////////////////////
/// Formattage du texte de l'article ////
/////////////////////////////////////////


var insertTag = function(startTag, endTag, tagType){
    if(startTag == "\<taille valeur=\"normal\">"){
        startTag = "";
        endTag = "";
    }

    var field  = document.getElementById('textareaId');
    var scroll = field.scrollTop;
    field.focus();

    //Recuperation des infos sur le texte selectionné (Easier in JS than jquery)
    var startSelection   = field.value.substring(0, field.selectionStart);
    var currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
    var endSelection     = field.value.substring(field.selectionEnd);

    if (tagType) {              //On laisse en switch/case au cas où on ajouterait des operations
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
        }
    }

    field.value = startSelection + startTag + currentSelection + endTag + endSelection;
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

    field = field.replace(/\n/g,"<br>");            //... On remplace le sauts de ligne par de balises </br>

    field = field.replace(/<g>/g, '<b>');           //... On remplace les balises g par des balises b.
    field = field.replace(/<\/g>/g, '</b>');        //On a pas besoin de traiter les balises pour l'italic et les citations,
                                                    //leurs balises marchent directement en HTML.

    field = field.replace(/<lien url/g, '<a target="_blank" href');
    field = field.replace(/<\/lien>/g, '</a>');

    field = field.replace(/<taille valeur/g, '<span class');
    field = field.replace(/<\/taille>/g, '</span>');

    field = field.replace(/<aligne valeur="gauche/g, '<p align="left');
    field = field.replace(/<aligne valeur="droite/g, '<p align="right');
    field = field.replace(/<aligne valeur="centrer/g, '<p align="center');
    field = field.replace(/(<\/aligne>\n|<\/aligne>)/g, '</p>');

    field = field.replace(/&lt;citation nom=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation">Citation : $1</span><div class="citation2">$2</div>');
    field = field.replace(/&lt;citation lien=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$1">Citation</a></span><div class="citation2">$2</div>');
    field = field.replace(/&lt;citation nom=\"(.*?)\" lien=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$2">Citation : $1</a></span><div class="citation2">$3</div>');
    field = field.replace(/&lt;citation lien=\"(.*?)\" nom=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$1">Citation : $2</a></span><div class="citation2">$3</div>');
    field = field.replace(/&lt;citation&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation">Citation</span><div class="citation2">$1</div>');
    field = field.replace(/&lt;taille valeur=\"(.*?)\"&gt;([\s\S]*?)&lt;\/taille&gt;/g, '<span class="$1">$2</span>');

    $("#previewDiv").append("<p>"+ field +"</p>");
    $("#textareaDecrypt").prop('value', "<p>"+ field +"</p>");

};

/*

 [a-z0-9._-]+

//Envoi au serveur
field = field.replace(/&/g, '&amp;');
field = field.replace(/</g, '&lt;').replace(/>/g, '&gt;');
field = field.replace(/\n/g, '<br />').replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

field = field.replace(/&lt;gras&gt;([\s\S]*?)&lt;\/gras&gt;/g, '<b>$1</b>');
field = field.replace(/&lt;italique&gt;([\s\S]*?)&lt;\/italique&gt;/g, '<i>$1</i>');
field = field.replace(/&lt;lien&gt;([\s\S]*?)&lt;\/lien&gt;/g, '<a href="$1">$1</a>');
field = field.replace(/&lt;lien url="([\s\S]*?)"&gt;([\s\S]*?)&lt;\/lien&gt;/g, '<a href="$1" title="$2">$2</a>');
field = field.replace(/&lt;citation nom=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation">Citation : $1</span><div class="citation2">$2</div>');
field = field.replace(/&lt;citation lien=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$1">Citation</a></span><div class="citation2">$2</div>');
field = field.replace(/&lt;citation nom=\"(.*?)\" lien=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$2">Citation : $1</a></span><div class="citation2">$3</div>');
field = field.replace(/&lt;citation lien=\"(.*?)\" nom=\"(.*?)\"&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation"><a href="$1">Citation : $2</a></span><div class="citation2">$3</div>');
field = field.replace(/&lt;citation&gt;([\s\S]*?)&lt;\/citation&gt;/g, '<br /><span class="citation">Citation</span><div class="citation2">$1</div>');
field = field.replace(/&lt;taille valeur=\"(.*?)\"&gt;([\s\S]*?)&lt;\/taille&gt;/g, '<span class="$1">$2</span>');
*/