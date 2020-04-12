<?php
	
  	include('includes/config.php');
	session_start();
	
?>
<!DOCTYPE html>
<html>
	<head>
        <?php include('includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="style/css/creatLevel.css">
	</head>
	<body>
		<?php
			include('includes/header.php');
		?>
    <body>
        <main>
        
            <div id="formReason">
                <input type="text" id="newReason">
                <button onclick="checkInputReason()">ajouté une raison</button>
                <div>
                    <div>
                        <p>trop court </p>
                        <div id="shorter" class="circle"></div>
                    </div>
                    <div>
                        <p>trop long </p>
                        <div id="longer" class="circle"></div>
                    </div>
                </div>
                <div id="mother">
                </div>
            </div>
        </main>
        <script src="script/reasonForm.js"></script>
    </body>
</html>