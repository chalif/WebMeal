<?php
user_set_access(2);

  if(isset($_POST['id'])){
    user_removeUser($_POST['id']);
    go_to("./?a=list.users");
  }
?>
