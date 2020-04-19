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
        $$req->execute([ $idenigma, $playerId]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        // if yes check when was last time was urly than 2 he is doint the enimga
        // he have to wait a cooldown of 5 min
        if($today - $lastTimePLayed['datePlay'] > 60 * 2 && $today - $lastTimePLayed['datePlay'] < 5*60 ) {
            header('locacation :index.php');
        }else{
            $q = 'INSERT INTO play(user,enigma,datePlay) VALUES ( :user, :enigma, :date )';
            $req = $bdd->prepare($q);
            $$req->execute([$playerId, $idenigma,$today]);
        }
    }else{
        $q = 'INSERT INTO play(user,enigma,datePlay) VALUES ( :user, :enigma, :date )';
        $req = $bdd->prepare($q);
        $$req->execute([$playerId, $idenigma,$today]);
    }
    $req = $bdd ->prepare('SELECT*FROM ENIGMA WHERE idEnigma = ?');
    $req->execute([$_GET['id']]);
    $results = $req->fetch(PDO::FETCH_ASSOC);
    echo '<!DOCTYPE html>
            <html lang="en" dir="ltr">
                <head>';
                echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
                include('includes/head.php'); 
                echo '</head>
                <body>';
                    include('includes/header.php');
                    echo'<h1>'.$results['title'].'</h1>'; 
                    echo '<p>'.$results['description'].'</p>';
                    echo '<h2>'.$results['question'].'</h2>';
                    echo '<button onclick="enigmaTrick()">indice</button>';
                    echo '<div id="tricksBox"> </div>';
                    echo '<main>';
                    echo $answerArray = $results['falseAnswers'];
                    $answerArray = spliter('|',$answerArray,0);
                    $i=1;
                    foreach ($answerArray as $key => $value) {
                        echo '<div id="'.$i.'" onclick="getAnwser('.$i.')">'.$value.'</div>';
                        $i++;
                    }
                        ?>
                        </main>
                </body>
                <script src="script/enigmaScript.js"></script>
            </html>
