<?php
$con = mysqli_connect('localhost', 'root', '', 'bdbac23') or die(mysqli_error($con));
$permis = $_POST['np'];        // FIX: was $_POST['p']
$nom    = $_POST['n'];
$prenom = $_POST['p'];
$genre  = $_POST['g'];
$ville  = $_POST['s'];

$req0 = "SELECT * FROM testeur WHERE numPermis='$permis'";
$res0 = mysqli_query($con, $req0) or die(mysqli_error($con));

if (mysqli_num_rows($res0) > 0) {
    echo('Numéro de permis déjà existant');
} else {
    $req1 = "INSERT INTO testeur (numPermis, nom, prenom, genre, idVille) VALUES ('$permis', '$nom', '$prenom', '$genre', '$ville')";
    mysqli_query($con, $req1) or die(mysqli_error($con));  // FIX: was mysqly_query
    if (mysqli_affected_rows($con) > 0) {
        echo('Enregistrement avec succès');
    }
}
?>
