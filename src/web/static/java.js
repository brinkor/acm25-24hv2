function licz()
{
    if (localStorage.ile_razy)
    {
        localStorage.ile_razy = Number(localStorage.ile_razy) + 1;
    }
    else
    {
        localStorage.ile_razy = 1;
    }
    window.alert("Whops, dałeś się nabrać już " +
        localStorage.ile_razy + " raz, nie ma nic za darmo, wypełnij formularz.");
}

function liczSesja()
{
    if (sessionStorage.ile_razyS)
    {
        sessionStorage.ile_razyS = Number(sessionStorage.ile_razyS) + 1;
    }
    else
    {
        sessionStorage.ile_razyS = 1;
    }
    if (sessionStorage.ile_razyS > 4) {
        window.alert("Ehh, widzę, że naprawdę muszę usunąć ten przycisk :(");
        var div = document.getElementById("tutaj");
        div.parentNode.removeChild(div);
    }
    else if (sessionStorage.ile_razyS > 3)
    {
        window.alert("Dobra, " + sessionStorage.ile_razyS + " razy to już za dużo, usuwam to.");
        var div = document.getElementById("tutaj");
        div.innerHTML = "<h2>Proszę nie klikać w ten przycisk, AWARIA!</h2><button type= \"button\" onclick= \"licz(); liczSesja();\" > Kliknij!</button> ";
    }
    else if (sessionStorage.ile_razyS > 1)
    {
        window.alert("Naprawdę, " + sessionStorage.ile_razyS + " razy w tej samej sesji?!\nLepiej zrób sobie przerwę.");
    }
}
function daneDzialaja()
{
    var dane = document.getElementById("daneNieDzialaja");
    dane.style.display = "none";
}
function galeriaDziala()
{
    var galeria = document.getElementById("galeriaNieDziala");
    galeria.style.display = "none";
}
function przyciskDziala()
{
    var przycisk = document.getElementById("przyciskNieDziala");
    przycisk.style.display = "none";
}
function wyswietlDane()
{
    var divDane = document.getElementById("dane");
    divDane.firstChild.innerHTML = "Dane kontaktowe:";
    divDane.firstChild.className = "on";
    var div = document.createElement('div');
    divDane.parentNode.appendChild(div).id = "nowydiv";
    var nowyDiv = document.getElementById("nowydiv");
    nowyDiv.className = "centered";
    nowyDiv.appendChild(document.createElement('h3')).innerHTML = "mail:";
    nowyDiv.appendChild(document.createElement('p')).innerHTML = "acm2524h@gmail.com";
    nowyDiv.appendChild(document.createElement('h3')).innerHTML = "telefon:";
    nowyDiv.appendChild(document.createElement('p')).innerHTML = "887547389";
    nowyDiv.appendChild(document.createElement('h3')).innerHTML = "adres:";
    nowyDiv.appendChild(document.createElement('p')).innerHTML = "ul. Warszawska 16/31";
    nowyDiv.appendChild(document.createElement('p')).innerHTML = "Warszawa, 01-109";
    divDane.innerHTML = "<button>Wyświetl danek kontaktowe</button>";
}
function czas() {
    var dzisiaj = new Date();

    var dzien = dzisiaj.getDate();
    var miesiac = dzisiaj.getMonth() + 1;
    var rok = dzisiaj.getFullYear();

    var godzina = dzisiaj.getHours();
    if (godzina < 10) godzina = "0" + godzina;

    var minuta = dzisiaj.getMinutes();
    if (minuta < 10) minuta = "0" + minuta;

    var sekunda = dzisiaj.getSeconds();
    if (sekunda < 10) sekunda = "0" + sekunda;

    document.getElementById("zegar").innerHTML =
        dzien + "/" + miesiac + "/" + rok + " " + godzina + ":" + minuta + ":" + sekunda;

    setTimeout("czas()", 1000);
}

function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "search?q=" + str, true);
        xmlhttp.send();
    }
}