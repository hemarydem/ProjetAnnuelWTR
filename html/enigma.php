<?php
session_start();
	require('includes/config.php');
    $req = $bdd ->prepare('SELECT FROM ENIGMA WHERE idEnigma = ?');
    $req->execute([$_GET['id']]);
    $result = $req->fetch(PDO::FETCH_ASSOC);
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

                        echo "<div id =" . $results[$i]['idEnigma'] . " onclick=enigmaLink(". $i .")>";

                        echo "<h1>" . $results[$i]['title'] . "</h1><br>";
                        echo "<p>" . $results[$i]['description'] . "</p>";
                        echo $results[$i]['mark'] == NULL ? 'Enigme inédite !': $results[$i]['mark'];
                        echo '<p><a href="reportEnigmaForm.php?idEnigma=' . $results[$i]['idEnigma'] . '">Signaler</a></p>';
                        echo "</div>";

                        echo "</section>";
                        ?>
                        </main>
                    <script src="script/selectIndex.js"></script>
                </body>
            </html>
