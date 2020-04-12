<?php
    include('includes/config.php');
    if(isset($_GET['option']) && $_GET['option'] == 2) {
         //___________searche all reasons____________\\
         $q = 'SELECT idReason, reason  FROM REPORTREASON WHERE reason <>' .'\'supp\'';
         $req = $bdd->prepare($q);
         $req->execute([]);
         $result = $req->fetchAll(PDO::FETCH_ASSOC);
         header('Content-Type: application/json');
         echo json_encode($result);
    }
    if(isset($_POST['newReason']) && !empty($_POST['newReason']) && isset($_POST['option']) && $_POST['option'] == 1) {
        //___________insert a new reason____________\\
        $newData =trim($_POST['newReason']);
        if ($newData == 'supp')exit;
        $q = 'INSERT INTO REPORTREASON(reason) VALUES (?)';
        $req = $bdd->prepare($q);
        $req->execute([$newData]);
   }

   if(isset($_POST['idReason']) && $_POST['option'] == 3) {
    $data = $_POST['idReason'];

    $q = 'UPDATE REPORTREASON SET reason = ? WHERE idReason = ? ';
        $req = $bdd->prepare($q);
        $req->execute(['supp', $data]);

    $q = 'SELECT idReason, reason  FROM REPORTREASON';
    $req = $bdd->prepare($q);
    $req->execute([]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($result);
   }

   
?>