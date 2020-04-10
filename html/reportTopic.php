<?php
	
  	include('includes/config.php');
	session_start();
	
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('includes/head.php'); ?>
	</head>
	<body>
		<?php
			include('includes/header.php');
		?>
    <body>
        <main>
        
        <?php

            $reason = $bdd->prepare('SELECT * FROM reportReason');
            $reason ->execute(array());

            if(isset($_GET['msg'])) {
				echo $_GET['msg'];
			}
    
        ?>

            <form method="POST" id="formReport" action="sendReportTopic.php?idTopic=<?=$_GET['idTopic']?>">
                <select name="reason">
                    <option selected="selected" disabled="disabled">Selectionner un motif</option>

                    <?php
                    while($reasons=$reason->fetch()) { ?>
                    <option value="<?= $reasons['idReason'] ?>"><?= $reasons['reason'] ?></option>
                    <?php } ?>

                </select>
                <textarea name="details" placeholder="Détails" cols="30" rows="10"></textarea>
                <input type="submit" name="formReport" value="Envoyer"/>
            </form>
        </main>
    </body>
</html>