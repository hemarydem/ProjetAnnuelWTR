<?php
    session_start();
    require('includes/config.php');
    require('includes/functions.php');
    //take to tim of loading page
   $today = date("Y-m-d H:i:s");

   
   $idenigma =strval($_GET['id']);
   $playerId = strval($_SESSION['id']);
    
   //check if the play alraydy played this enigma
    $q = 'SELECT * FROM Play WHERE enigma = ?  AND user = ?';
    $req = $bdd->prepare($q);
    $req->execute([ $idenigma, $playerId]);
    $results = $req->fetch(PDO::FETCH_ASSOC);
    if($results) {

        // if yes check when was last time
        $q = 'SELECT MIN(datePlay) FROM Play WHERE enigma = ?  AND user = ?';
        $req = $bdd->prepare($q);
        $req->execute([ $idenigma, $playerId]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $lastTimePLayed =$results['datePlay'];
        
       
       $q1='SELECT Max(datePlay) FROM Play WHERE enigma = '.$idenigma.'  AND user = '.$playerId;
       //a     -   b
        $q ='SELECT TIMESTAMPDIFF(SECOND, ('.$q1.'), ?) AS time';
        $req = $bdd->prepare($q);
        $req->execute([$today]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        echo date('H:i:s', $result['time']);
        // if yes check when was last time was urly than 2 he is doint the enimga
        // he have to wait a cooldown of 5 min
        // more than 2mins                                      less than 5 min
            if( $result['time'] > 60 * 2 &&  $result['time'] < 5*60 ) {   
            header('location:index.php?msg=vous devez attendre la fin du cooddown');
        } else {
            $q = 'INSERT INTO play(user,enigma,datePlay) VALUES ( :user, :enigma, :date )';
            $req = $bdd->prepare($q);
            $req->execute([    
                'user' => $playerId,
                'enigma' => $idenigma,
                'date' =>$today
            ]);
            $_SESSION['time'] = 2;
        }

    } else { //if he never player this enigma or if its a new try
        $q = 'INSERT INTO play(user,enigma,datePlay) VALUES ( :user, :enigma, :date )';
        $req = $bdd->prepare($q);
        $req->execute([
            "user"=>$playerId,
            "enigma"=> $idenigma,
            "date"=>$today]);
        $_SESSION['time'] = 2;
    }
    header('location:enigma.php?id='.$idenigma);
    exit;
?>