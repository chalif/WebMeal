<?php
user_set_access(3);

  if(isset($_POST['id'])){
    user_removeGroup($_POST['id']);
    go_to("./?a=list.groups");
  }
?>
