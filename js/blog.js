function fillArticles() {
    // Objet pour envoyer et manipuler des requêtes
    let httpRequest = new XMLHttpRequest();
    // Fonction déclenchée à chaque changement d'état de la requête
    httpRequest.onreadystatechange = function() {
        let infoLayer = document.getElementById("infolayer");
        // Quand la réponse du serveur a été reçue
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            // Si la réponse est valide
            if (httpRequest.status === 200) {
             let data = JSON.parse(httpRequest.responseText);
             let main = document.querySelector('main')
             for(let i = 0; i<= data.length -1; i++) {
                 let h1 = document.createElement('h1');
                 h1.innerText = data[i].id;
                 main.appendChild(h1);
             }
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
    httpRequest.open('GET', 'https://oc-jswebsrv.herokuapp.com/api/articles', true);
    httpRequest.send();    
 }
 fillArticles();