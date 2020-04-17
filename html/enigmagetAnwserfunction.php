<?php
    require('includes/config.php');
    if(isset($_POST['id']) && isset($_POST['answer'])) {
        $req = $bdd ->prepare('SELECT answer FROM ENIGMA WHERE idEnigma = ?');
        $req->execute([$_POST['id']]);
        $results = $req->fetch(PDO::FETCH_ASSOC);
        if($results['trick'] == $_POST['answer']) {
            echo 1; // good answer
        } else {
            echo 0; // bad answer
        }
    }
?>