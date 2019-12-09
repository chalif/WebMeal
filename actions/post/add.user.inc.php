<?php
user_set_access(2);

  if(isset($_POST['data'])){
    $_POST['data']['pass'] = md5(SALT.$_POST['password']);
    $id = user_addUser($_POST['data']);
    go_to("./?a=list.users&id=".$id);
  }
?>
