//Déclaration des variables
var pourcentage = 0.78;
var pourcentageInfo = document.getElementById("pourcentageInfo");

var horaireBrut = document.getElementById("horaireBrut");
var mensuelBrut = document.getElementById("mensuelBrut");
var annuelBrut = document.getElementById("annuelBrut");

var horaireNet = document.getElementById("horaireNet");
var mensuelNet = document.getElementById("mensuelNet");
var annuelNet = document.getElementById("annuelNet");

var salarieNonCadre = document.getElementById("salariéNonCadre");
var salarieCadre = document.getElementById("salariéCadre");
var fonctionPublique = document.getElementById("fonctionPublique");
var professionLiberale = document.getElementById("professionLibérale");
var portageSalarial = document.getElementById("portageSalarial");

function changePourcentage(input) {
    switch(input) {
        case "nonCadre":
            salarieNonCadre.checked = true;
            pourcentage = 0.78;
            pourcentageInfo.innerText = "Non Cadre : -22%";
            break;

        case "Cadre":
            salarieCadre.checked = true;
            pourcentage = 0.75;
            pourcentageInfo.innerText = "Cadre : -25%";
            break;

        case "fonctionPublique":
            fonctionPublique.checked = true;
            pourcentage = 0.85;
            pourcentageInfo.innerText = "Fonction Publique : -15%";
            break;

        case "professionLibérale":
            professionLiberale.checked = true;
            pourcentage = 0.55;
            pourcentageInfo.innerText = "Profession Libérale : -45%";
            break;

        case "portageSalarial":
            portageSalarial.checked = true;
            pourcentage = 0.49;
            pourcentageInfo.innerText = "Portage Salarial : -51%";
            break;        
    }
    if (mensuelBrut.value !== "") {
        calculSalaire("changePourcentage");
    }
}

function calculSalaire(where){
    switch(where) {
        case "horaireBrut":
            mensuelBrut.value = (horaireBrut.value * 140).toFixed(0);
            annuelBrut.value = (horaireBrut.value * 1680).toFixed(0);
            horaireNet.value = (horaireBrut.value * pourcentage).toFixed(2);
            mensuelNet.value = (horaireNet.value * 140).toFixed(0);
            annuelNet.value = (horaireNet.value * 1680).toFixed(0);
            break;

        case "mensuelBrut":
            horaireBrut.value = (mensuelBrut.value / 140).toFixed(2);
            annuelBrut.value = (horaireBrut.value * 1680).toFixed(0);
            horaireNet.value = (horaireBrut.value * pourcentage).toFixed(2);
            mensuelNet.value = (horaireNet.value * 140).toFixed(0);
            annuelNet.value = (horaireNet.value * 1680).toFixed(0);
            break;

        case "annuelBrut":
            horaireBrut.value = (annuelBrut.value / 1680).toFixed(2);
            mensuelBrut.value = (annuelBrut.value / 12).toFixed(0);
            horaireNet.value = (horaireBrut.value * pourcentage).toFixed(2);
            annuelNet.value = (horaireNet.value * 1680).toFixed(0);
            mensuelNet.value = (annuelNet.value / 12).toFixed(0);
            break;
        
        case "horaireNet":
            mensuelNet.value = (horaireNet.value * 140).toFixed(0);
            annuelNet.value = (horaireNet.value * 1680).toFixed(0);
            horaireBrut.value = (horaireNet.value / pourcentage).toFixed(2);
            mensuelBrut.value = (horaireBrut.value * 140).toFixed(0);
            annuelBrut.value = (horaireBrut.value * 1680).toFixed(0);
            break;

        case "mensuelNet":
            horaireNet.value = (mensuelNet.value / 140).toFixed(2);
            annuelNet.value = (horaireNet.value * 1680).toFixed(0);
            horaireBrut.value = (horaireNet.value / pourcentage).toFixed(2);
            mensuelBrut.value = (horaireBrut.value * 140).toFixed(0);
            annuelBrut.value = (horaireBrut.value * 1680).toFixed(0);
            break;

        case "annuelNet":
            horaireNet.value = (annuelNet.value / 1680).toFixed(2);
            mensuelNet.value = (annuelNet.value / 12).toFixed(0);
            horaireBrut.value = (horaireNet.value / pourcentage).toFixed(2);
            annuelBrut.value = (horaireBrut.value * 1680).toFixed(0);
            mensuelBrut.value = (horaireBrut.value * 140).toFixed(0);
            break;

        case "changePourcentage":
            mensuelNet.value = (mensuelBrut.value * pourcentage).toFixed(0);
            horaireNet.value = (mensuelNet.value / 140).toFixed(2);
            annuelNet.value = (mensuelNet.value *12).toFixed(0);
            break;
    }
    if(mensuelBrut.value < 0) {
        horaireBrut.value = "";
        mensuelBrut.value = "";
        annuelBrut.value = "";
        horaireNet.value = "";
        mensuelNet.value = "";
        annuelNet.value = "";
    }
}