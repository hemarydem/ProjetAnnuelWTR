<?php
	session_start();
  	include('includes/config.php');
	//head
	include('includes/head.php');
?>
	<body>
		<!-- header -->
		<?php
			include('includes/header.php');
		?>
    <main>
      <section id="body_forum">
	  <a href="creationTopic.php">Creer un Topic</a>
        <?php
				$q = 'SELECT idTopic, title, contents FROM TOPIC ORDER BY idTopic DESC';
				$req = $bdd->prepare($q);
				$req->execute();
				//$result = $req->fetchAll(PDO::FETCH_ASSOC);
				//var_dump($result);
				
				while($result=$req->fetch()) {?>
				<a href="pageTopic.php?topic=<?php echo $result['idTopic'] ?>">
					<div class="topic">
						<h4><?php echo $result['title'];?></h4>
						 <?php echo $result['contents'] ?>
					</div>
				</a>
		<?php } 
				
				
		?>
		
		
      </section>
    </main>   
  </body>
</html>