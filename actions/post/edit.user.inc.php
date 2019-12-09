<?php
user_set_access(2);

  if(isset($_POST['data'])){
    if(strlen($_POST['password'])){
      $_POST['data']['pass'] = md5(SALT.$_POST['password']);
    }
    user_editUser($_POST['id'], $_POST['data']);
    go_to("./?a=list.users&id=".$_POST['id']);
  }
?>
