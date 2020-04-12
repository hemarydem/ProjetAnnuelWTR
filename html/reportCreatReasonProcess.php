<?php
    include('includes/config.php');

    if(isset($_GET['option']) && $_GET['option'] == 2) {
         //___________searche all reasons____________\\
         $q = 'SELECT reason  FROM REPORTREASON';
         $req = $bdd->prepare($q);
         $req->execute([]);
         $result = $req->fetch(PDO::FETCH_ASSOC);
         echo json_encode($result);
    }
?>