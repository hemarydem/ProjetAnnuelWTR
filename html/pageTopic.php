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
    <main>

	<?php 
		//Récupération de l'id du topic
		$idTopic = $_GET['topic'];

		//Récupération des informations du topic (Titre, contenu)
		$reqTopic = $bdd->prepare('SELECT title, content FROM topic WHERE idTopic=:id');
		$reqTopic->execute(array('id'=>$idTopic));
		$resultTopic = $reqTopic->fetch();

	?>

      <h1><?= $resultTopic['title']?></h1>
	  <p><?= $resultTopic['content']?></p>
	  <a href="report.php?idTopic=<?= $_GET['topic']?>">Signaler</a>
	  
    </main>   
  </body>
</html>