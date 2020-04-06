<?php
    require('includes/config.php');

    if(isset($_POST['name']) && isset($_POST['threshold'])) {
        $name = trim($_POST['name']);
        $threshold = trim($_POST['threshold']);
        if(strlen($name) < 2 || strlen($name) > 60 ) {
            echo 'error name length';
            exit;
        }
        //_____________check if only numbers are in threshold__//
        if( !preg_match("/^[0-9]*$/", $threshold ) ) {
            echo 'error it must have only numbers';
            exit;
        }

        $request= $bdd->prepare('INSERT INTO level(name, threshold) VALUES (?, ?)');
        $request->execute([$name, $threshold]);

        $request= $bdd->prepare('SELECT name, threshold FROM level WHERE name = ?');// Name must be unique
        $request->execute([$name]);                                    //delete the comment above if name are uniques
        $results = $request->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($results);
    }
?>