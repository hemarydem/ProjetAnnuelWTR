<?php
session_start();
	require('includes/config.php');
    $req = $bdd ->prepare('SELECT idEnigma,title,description,question, trick FROM ENIGMA WHERE idEnigma = ?');
        
    $req->execute([$_GET['id']]);
    $results = $req->fetch(PDO::FETCH_ASSOC);
    echo '<!DOCTYPE html>
            <html lang="en" dir="ltr">
                <head>';
                include('includes/head.php'); 
                echo '</head>
                <body>';
                    include('includes/header.php'); 
                    echo '<main>';

                        echo "<section class='enigmaContainer flex'>";

                        echo '<img src="img/enigma/defaultPicture.png" alt="logo enigma" height="180px"/>';


                        echo "<h1>" . $results['title'] . "</h1><br>";
                        echo "<p>" . $results['description'] . "</p>";
                        echo "<h2>".$results['question']."</h2>";
                        echo '<p><a href="reportEnigmaForm.php?idEnigma=' . $results["idEnigma"] . '">Signaler</a></p>';
                        echo "</div>";

                        echo "</section>";
                        ?>
                    </main>
                <script src="script/.js"></script>
            </body>
        </html>
