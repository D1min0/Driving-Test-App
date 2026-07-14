<?php
$con    = mysqli_connect('localhost', 'root', '', 'bdbac23') or die(mysqli_error($con));
$permis = $_POST['np'];        // FIX: was $_POST['p']
$s      = $_POST['s'];
$sec    = $_POST['sec'];
$cond   = $_POST['cond'];
$conf   = $_POST['conf'];

$req0 = "SELECT * FROM testeur WHERE numPermis='$permis'";
$res0 = mysqli_query($con, $req0) or die(mysqli_error($con));

if (mysqli_num_rows($res0) == 0) {   // FIX: was =0 (assignment instead of comparison)
    echo("Testeur non inscrit");
} else {
    $req1 = "SELECT * FROM evaluation WHERE numPermis='$permis' AND idModele='$s'";
    $res1 = mysqli_query($con, $req1) or die(mysqli_error($con));

    if (mysqli_num_rows($res1) > 0) {
        echo("Vous avez déjà testé ce modèle");
    } else {
        $req2 = "INSERT INTO evaluation (numPermis, idModele, dateTest, securite, conduite, confort) VALUES ('$permis', '$s', NOW(), '$sec', '$cond', '$conf')";
        // FIX: $per→$permis, $s1→$s, $secu→$sec, mysqly_query→mysqli_query
        mysqli_query($con, $req2) or die(mysqli_error($con));
        if (mysqli_affected_rows($con) > 0) {
            echo('Évaluation enregistrée avec succès');
        }
    }
}
?>
