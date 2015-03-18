<<<<<<< HEAD
﻿function showMassageError(errorValue){ // Pesentation de fenetre emergente pour les erreurs et succès
    var p = document.createElement('p');
    p.innerHTML='Message : ';
=======
function showMassageError(errorValue){ // Pesentation de fenetre emergente pour les erreurs et succès
    var p = document.createElement('p');
    p.innerHTML='Vous devez renseigner le champ suivant : ';
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b

    var window = document.getElementById('result');
    window.appendChild(p);

    var p = document.createElement('p');
    p.innerHTML = errorValue;
    p.setAttribute('class', 'label');
    var br = document.createElement('br');
    p.appendChild(br);
    window.appendChild(p);

    var button = document.createElement('input');
    button.setAttribute('type', 'button');
    button.setAttribute('value', 'OK');
    button.setAttribute('onclick', 'closeDivError()');
    button.setAttribute('class', 'btn btn-success');

    var p = document.createElement('p');
    var br = document.createElement('br');
    p.appendChild(br);
    p.setAttribute('class', 'center');
    p.appendChild(button);

    window.appendChild(p);

    window.style.display = 'block';

    var window_width = window.offsetWidth;
    var window_height = window.offsetHeight;

    window.style.marginLeft = '-' + Math.round(window_width/2) + 'px';
    window.style.marginTop = '-' + Math.round(window_height/2) + 'px';
    return true;
}

function closeDivError()
{
    var window = document.getElementById('result');
    window.innerHTML = '';

    window.style.display = 'none';

    return;

} // closeDivError()

function insertE () {
    showMassageError('Le code ne coïncide pas avec l`image !!');
    document.getElementById('iCaptcha').focus();
    $(document).ready(function(){
        $('#iCaptcha').addClass('norequired');
        $('#iCaptcha').val('');
        $('#iCaptcha').attr('aria-invalid','true');
        $('#iCaptcha-error').remove();
    });
}
function insertCH () {
    
    document.getElementById("chP").innerHTML='Le code ne coïncide pas avec l`image !!';
    document.getElementById('iCaptcha').focus();
    $(document).ready(function(){
        $('#iCaptcha').addClass('norequired');
        $('#iCaptcha').val('');
        $('#iCaptcha').attr('aria-invalid','true');
        $('#iCaptcha-error').remove();
    });
}
function errorCH () {
    document.getElementById("chP").innerHTML='Le mot de passe ingresé ne correspond pas a votre profile!!';
    document.getElementById('act_pass').focus();
    $(document).ready(function(){
        $('#act_pass').addClass('norequired');
        $('#act_pass').val('');
        $('#act_pass').attr('aria-invalid','true');
        $('#act_pass-error').remove();
    });
}

function mailErr(){
    $(document).ready(function(){
        $('#mailR').addClass('norequired');
        $('#mailR').attr('aria-invalid','true');
        $('#mailR-error').remove();
    });
    showMassageError('Il n\'y a pas un account liée à cette mail !!!');
    document.getElementById('mailR').focus();
}
function mailMod(){
    showMassageError('Il n\'y a pas un account liée à cette mail!!!');
    document.getElementById('mail').focus();
}