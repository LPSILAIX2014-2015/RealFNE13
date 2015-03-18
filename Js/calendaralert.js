/*
 * @author <Loubna EL MARNAOUI>
 */


function closeAlert() {
    var Calert ;
    if (Calert = document.getElementById('customAlert')) {
        Calert.parentNode.removeChild(Calert);
        customAlerts.shift();
        if (customAlerts.length > 0) {
            setTimeout(customAlert(),500);
        }
    }
}
function customAlert() {
    if (customAlerts.length > 0) {
        var El = document.createElement('div') ;
        El.setAttribute('id','customAlert');
        El.setAttribute('class','customAlert');
        El.innerHTML = '<div class="box">'+ customAlerts[0] +'<input type="button" value="OK" class="ok" onClick="closeAlert();"></div>' ;
        document.getElementsByTagName('body')[0].appendChild(El);
        window.addEventListener("keypress", closeAlert);
    }
}
customAlert();