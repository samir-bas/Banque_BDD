let layer = document.getElementById("layer");
let btnLayer = document.getElementById("btnLayer");

btnLayer.addEventListener("click",closeLayer);



function closeLayer() {
    layer.style.display = "none";
}

function infoLayers() {
    // Objet pour envoyer et manipuler des requêtes
    let httpRequest = new XMLHttpRequest();
    // Fonction déclenchée à chaque changement d'état de la requête
    httpRequest.onreadystatechange = function() {
        let infoLayer = document.getElementById("infolayer");
        // Quand la réponse du serveur a été reçue
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            // Si la réponse est valide
            if (httpRequest.status === 200) {
                infoLayer.innerHTML  = httpRequest.responseText;
            } 
            // Si une erreur est survenue (exemple un fichier qui n'existe pas)
            else {
                infoLayer.innerText = "Nous n'avons pas réussi à récupérer le contenu";
            }
        } 
        // Le serveur n'a pas encore répondu
        else {
            infoLayer.innerText = "Requête en cours";
        }
    };
    // On envoie la requête
    httpRequest.open('GET', 'infolayer.txt', true);
    httpRequest.send();
}
infoLayers();