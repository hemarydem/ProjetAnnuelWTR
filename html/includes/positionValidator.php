<?php
  session_start();

  if($_POST['position'] == $_SESSION['position']){
    $_SESSION['captcha'] = true;
    echo 'OK';
  }else{
    $_SESSION['captcha'] = false;
    echo 'KO';
  }
