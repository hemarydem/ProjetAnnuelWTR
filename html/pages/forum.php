<?php
	session_start();
  include('../includes/config.php');
	//head
	include('../includes/head.php');
	
?>
	<body>
		<!-- header -->
		<?php
			include('../includes/header.php');
		?>
    <main>
      <section id="body_forum">
        <?php
				
				$req = $bdd->prepare('SELECT idTopic , title FROM topic ORDER BY id DESC');
				$req->execute(array());
				
				while($topic=$req->fetch()) {?>
					<div class="topic">
						<h4><?= $topic['title'];?></h4>
						<a href="https://Thomarlas.online/pages/page_topic?topic=<?= $topic['id'] ?>">Plus</a>
					</div>
				<?php } ?>
      </section>
    </main>
    
  </body>
</html>