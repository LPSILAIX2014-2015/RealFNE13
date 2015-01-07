/*
 *   Appel des fichiers javascript utile au traitement du projet
 *
 */

var src = new Array(); //Tableau appel fichier dans /Js/
var srcL = new Array(); //Tableau appel fichier dans /Lib/

var i = 0;

srcL[i++] = 'bootstrap.min.js';
srcL[i++] = 'jquery.min.js';

for (var j = 0; j < i; ++j)
{
    document.write('<script src="../Js/' + src[j] + '></script>');
    document.write('<script src="../Lib/' + srcL[j] + '></script>');
}