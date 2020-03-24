<?php

require('includes/config.php');
session_start();

if( !isset( $_POST['title'] ) ||  !isset( $_POST['content'] ) ){
    header('Location:creationTopic.php?msg= il manque un titre ou un contenu');
    exit;
}

//get the id of the user
$pseudo = $_SESSION['pseudo'];
$q = 'SELECT email FROM USERS WHERE login = ?';
$req = $bdd->prepare($q);
$req->execute([$pseudo]);
$result = $req->fetch(PDO::FETCH_ASSOC);


$title = htmlspecialchars( $_POST['title'] );
$contents = htmlspecialchars( $_POST['content'] );
$working = 1;
$author = $result['email'];
$date = date('Y-m-d');

if (!empty($title) && !empty($contents) ){
    $q = "INSERT INTO TOPIC(title, contents, working, author, postDate) VALUES(:title, :contents, :working, :author, :postDate)";
    $req = $bdd->prepare($q);
    $req->execute([
        			'title'     =>  $title,
					'contents'  =>  $contents,
					'working'   =>  $working,
					'author'    =>  $author,
					'postDate'  =>  $date
				]);

}else{
    header('location: creationTopic.php?msg=Remplissez les champs');
    exit;
}


header('location:forum.php?');
exit;
?>