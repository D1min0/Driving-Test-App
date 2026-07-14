function uniquementLettres(x) {
    x = x.toUpperCase()
    var i = 0
    while (x.charAt(i) >= "A" && x.charAt(i) <= "Z" && i < x.length)
        i++
    return i == x.length
}

function uniquementLettresEspaces(x) {
    x = x.toUpperCase()
    for (var i = 0; i < x.length; i++) {
        if (x.charAt(i) !== " " && (x.charAt(i) < "A" || x.charAt(i) > "Z"))
            return false
    }
    return true
}

function verif1() {
    var resultat = true
    var numPermis = document.getElementById("np").value
    var nom = document.getElementById("n").value
    var prenom = document.getElementById("p").value
    var s = document.getElementById('s').selectedIndex

    var nb1 = numPermis.substr(0, 2)
    var nb2 = numPermis.substr(3)

    if (numPermis.indexOf('/') != 2 || isNaN(nb1) || isNaN(nb2) || nb1.length != 2 || nb2.length != 5) {
        resultat = false
        alert("Le numéro du permis n'est pas conforme")
    }
    else if (nom.length < 3 || nom.length > 20 || !uniquementLettres(nom)) {
        resultat = false
        alert("Le nom doit avoir de 3 à 20 lettres")
    }
    else if (prenom.length < 3 || prenom.length > 20 || !uniquementLettresEspaces(prenom)) {
        resultat = false
        alert("Le prénom doit avoir de 3 à 20 lettres")
    }
    else if (!(document.getElementById("F").checked || document.getElementById("M").checked)) {
        resultat = false
        alert("Spécifier le genre du pilote!")
    }
    else if (s < 1) {
        resultat = false
        alert('Vous devez choisir une ville')
    }
    return resultat
}

function verif2() {
    var resultat = true
    var numPermis = document.getElementById("np").value
    var s = document.getElementById("s").selectedIndex   // FIX: was s1
    var sec = document.getElementById("sec").value
    var cond = document.getElementById("cond").value
    var conf = document.getElementById("conf").value
    var c = document.getElementById("c").checked

    var nb1 = numPermis.substr(0, 2)
    var nb2 = numPermis.substr(3)

    if (numPermis.indexOf('/') != 2 || isNaN(nb1) || isNaN(nb2) || nb1.length != 2 || nb2.length != 5) {
        resultat = false
        alert("Le numéro du permis n'est pas conforme")
    }
    else if (s < 1) {                                    // FIX: was s1
        resultat = false
        alert('Vous devez choisir un modèle')
    }
    else if (sec < 1 || sec > 5) {                       // FIX: was secu
        resultat = false
        alert('Sécurité est un entier entre 1 et 5')
    }
    else if (cond < 1 || cond > 5) {
        resultat = false
        alert('Conduite est un entier entre 1 et 5')
    }
    else if (conf < 1 || conf > 5) {
        resultat = false
        alert('Confort est un entier entre 1 et 5')
    }
    else if (!c) {                                       // FIX: was cb
        resultat = false
        alert('Vous devez cocher "Je ne suis pas un robot"')
    }
    return resultat
}
