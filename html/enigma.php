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
                    echo '<main>';

                        ?>
                        </main>
                    <script src="script/selectIndex.js"></script>
                </body>
            </html>
