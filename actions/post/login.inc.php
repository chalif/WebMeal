<?php
  if(isset($_POST['login']) && isset($_POST['pass'])){
    user_login($_POST['login'], $_POST['pass']);
  }
  go_to("./");
?>
