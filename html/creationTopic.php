<?php
	session_start();
  	include('includes/config.php');
	//head

	if( !isset($_SESSION['pseudo']) ){
		header('Location:signIn.php');
		exit;
	}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<?php include('includes/head.php'); ?>
	</head>	
	<body>
		<!-- header -->
		<?php
			include('includes/header.php');
		?>
    <main>
		<?php
			if(isset($_GET['msg'])) {
				echo $_GET['msg'];
			}
			 
		?>
      <div class="">
        <form method="post" id="formTopic" action="addTopicProcess.php">
          <input type="text" name="title" placeholder="Titre" required>
          <textarea name="content" rows="8" cols="80" placeholder="Description..." required></textarea>
          <input type="submit" name="formTopic" value="Publier">
        </form>

		
      </div>
    </main>
  </body>
</html>