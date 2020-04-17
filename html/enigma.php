<?php
session_start();
	require('includes/config.php');
    $req = $bdd ->prepare('SELECT*FROM ENIGMA WHERE idEnigma = ?');
    $req->execute([$_GET['id']]);
    $results = $req->fetch(PDO::FETCH_ASSOC);
    echo '<!DOCTYPE html>
            <html lang="en" dir="ltr">
                <head>';
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
                    $answerArray = $results['falseAnswers'];
                        ?>
                        </main>
                    <script src="script/enigmaScript.js"></script>
                </body>
            </html>
