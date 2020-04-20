<?php
session_start();
    require('includes/config.php');
    require('includes/functions.php');
    $today = date("Y-m-d H:i:s");
    $idenigma =strval($_GET['id']);
    $playerId = strval($_SESSION['id']);

    $q = 'SELECT MAX(datePlay) as datePlay FROM Play WHERE enigma = ?  AND user = ?';
    $req = $bdd->prepare($q);
    $req->execute([ $idenigma, $playerId]);
    $result = $req->fetch(PDO::FETCH_ASSOC);

    //$_SESSION['time'] = strtotime(date('Y-m-d H:i:s')) - strtotime($result['datePlay']);
    //echo $_SESSION['time'];exit;
  
    $req = $bdd ->prepare('SELECT*FROM ENIGMA WHERE idEnigma = ?');
    $req->execute([$_GET['id']]);
    $results = $req->fetch(PDO::FETCH_ASSOC);
    echo '<!DOCTYPE html>
            <html lang="en" dir="ltr">
                <head>';
                echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
                include('includes/head.php'); 
                echo '</head>
                <body onload= "countdown()">';
                    include('includes/header.php');
                    echo'<h1>' . $results['title'] . '</h1>';
                    echo '<div> 
                            Time Left :: 
                            <input id="minutes" type="text" style="width: 10px; 
                            border: none; font-size: 16px;  
                            font-weight: bold; color: black;"><font size="5"> : 
                            </font> 
                            <input id="seconds" type="text" style="width: 20px; 
                            border: none; font-size: 16px; 
                            font-weight: bold; color: black;"> 
                            </div>  '; 
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
                <script src="script/enigmaTimer.js"></script>
            </html>