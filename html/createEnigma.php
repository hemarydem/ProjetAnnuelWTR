<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include('includes/head.php') ?>
  </head>
  <body>
      <?php include('includes/header.php') ?>
    <main>
      <form class="createEnigma" action="#" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre">
        <input type="text" name="description" placeholder="Description">
        <input type="text" name="question" placeholder="question">
        <input type="text" name="trick" placeholder="Indice">
        <img src="#" alt="Img_Enigma">
        <input type="file" name="" value="">
        <input type="number" name="minutes" placeholder="05">
        <input type="number" name="seconds" placeholder="00">
      </form>
    </main>
    <footer>
      <?php include('includes/footer.php') ?>
    </footer>
  </body>
</html>
