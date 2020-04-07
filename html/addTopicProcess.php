<?php

require('includes/config.php');
session_start();

if( !isset( $_POST['title'] ) ||  !isset( $_POST['content'] ) ){
    header('Location:creationTopic.php?msg= il manque un titre ou un contenu');
    exit;
}

//get the id of the user
$pseudo = $_SESSION['pseudo'];
$q = 'SELECT idUser FROM USER WHERE login = ?';
$req = $bdd->prepare($q);
$req->execute([$pseudo]);
$result = $req->fetch(PDO::FETCH_ASSOC);


$title = htmlspecialchars( $_POST['title'] );
$content = htmlspecialchars( $_POST['content'] );
$active = 1;
$author = $result['idUser'];
$date = date('Y-m-d');

if (!empty($title) && !empty($content) ){
    $q = "INSERT INTO TOPIC(title, content, active, author, postDate) VALUES(:title, :content, :active, :author, :postDate)";
    $req = $bdd->prepare($q);
    $req->execute([
        			'title'     =>  $title,
					'content'  =>  $content,
					'active'   =>  $active,
					'author'    =>  $author,
					'postDate'  =>  $date
				]);

}else{
    header('location:creationTopic.php?msg=Remplissez les champs');
    exit;
}


header('location:forum.php?');
exit;
?>
