<?php
user_set_access(3);

  if(isset($_POST['data'])){
    user_editGroup($_POST['id'], $_POST['data']);
    go_to("./?a=list.groups&id=".$_POST['id']);
  }
?>
