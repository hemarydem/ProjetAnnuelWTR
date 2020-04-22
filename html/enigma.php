<?php
session_start();
    require('includes/config.php');
    require('includes/functions.php');
    $today = date("Y-m-d H:i:s");
    if(isset($_GET['id'])){
        $idenigma =strval($_GET['id']);
    }
    if($_SESSION['id']){
        $playerId = strval($_SESSION['id']);
    }
    $trigger = false;
  
    $req = $bdd ->prepare('SELECT title, description,  question, falseAnswers, answer FROM ENIGMA WHERE idEnigma = ?');
    $req->execute([$_GET['id']]);
    $results = $req->fetch(PDO::FETCH_ASSOC);
    echo '<!DOCTYPE html>
            <html lang="en" dir="ltr">
                <head>';
                echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
                include('includes/head.php'); 
                echo '</head>
                <body onload= "countdown()">';
                echo '<main>';
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
                    $answerArray = $results['falseAnswers'];
                    $answerArray = spliter('|',$answerArray,0);
                    echo $results['answer'];
                    array_push($answerArray,$results['answer']);
                    shuffle($answerArray);
                    $arrayDisplayAnsw = [];
                    $i=0;
                    foreach ($answerArray as $key => $value) {
                        $arrayDisplayAnsw[$i] = $value;
                        $i++;
                    }
                    if(sizeof($arrayDisplayAnsw) <= 4) {
                        $limit = sizeof($arrayDisplayAnsw);
                    }else{
                        $limit = 4;
                        $trigger = true;
                    }
            
                    echo '<div class="container">';
                        echo '<div class="row">';
                        for($i = 0; $i < $limit; $i++ ) {
                            echo '<div class="col" id="'.$i.'" onclick="getAnwser('.$i.')">'.$arrayDisplayAnsw[$i].'</div>';
                        }
                        echo '</div>';
                        if($trigger){
                            echo '<div class="row">';
                            for($i = $limit; $i < sizeof($arrayDisplayAnsw); $i++ ) {
                                echo '<div class="col" id="'.$i.'" onclick="getAnwser('.$i.')">'.$arrayDisplayAnsw[$i].'</div>';
                            }
                        echo '</div>';
                        }
                    echo '</div>';
                    echo'<input type="hidden" id="tanck" value="'.$_SESSION['id'].'">';
                        ?>
                        </main>
                </body>
                <script src="script/enigmaScript.js"></script>
                <script src="script/enigmaTimer.js"></script>
            </html>