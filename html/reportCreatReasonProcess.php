<?php
    include('includes/config.php');

    if(isset($_GET['option']) && $_GET['option'] == 1) {
         //___________check the value of user's moderator____________\\
         $q = 'SELECT reason  FROM REPORTREASON';
         $req = $bdd->prepare($q);
         $req->execute(['idUser' => $idUser]);
         $result = $req->fetch(PDO::FETCH_ASSOC);
         $result = $result['moderator'];
        
    }


?>