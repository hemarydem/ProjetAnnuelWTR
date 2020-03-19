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
      <div class="">
        <form method="post" id="formTopic">
          <input type="text" name="title" placeholder="Titre" required>
          <textarea name="content" rows="8" cols="80" placeholder="Description..." required></textarea>
          <input type="submit" name="formTopic" value="Publier">
        </form>
        <?php
        
          if(isset($_POST['formTopic'])){
          	$titleTopic = htmlspecialchars($_POST['title']);
						$contentTopic = htmlspecialchars($_POST['content']);
						
						if(!empty($_POST['title'] and !empty($_POST['content'])){
						$insertTopic = $bdd->prepare("INSERT INTO topic(title, content) VALUES (:title, :content)");
						$insertTopic->execute(array('title'=>$titleTopic, 'content'=>$contentTopic));
						$message = "Votre topic a été ajouté";
						} else {
							$message = "Tout les champs doivent être remplis";
						}
          }
					if (isset($message)) {
						echo '<font color ="red">' . $message . '</font>';
					}
        
        ?>
      </div>
    </main>
  </body>
</html>