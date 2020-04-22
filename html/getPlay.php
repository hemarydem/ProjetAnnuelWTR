<?php
    include('includes/config.php');
    session_start();
    
    $q = 'SELECT enigma, user FROM Play WHERE enigma = ?  AND user = ?';
    $req = $bdd->prepare($q);
    $req->execute([ $idenigma, $playerId]);
    $results = $req->fetch(PDO::FETCH_ASSOC);

    var_dump($results);


?>