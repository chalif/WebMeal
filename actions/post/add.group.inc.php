<?php
user_set_access(3);

  if(isset($_POST['data'])){
    $id = user_addGroup($_POST['data']);
    go_to("./?a=list.groups&id=".$id);
  }
?>
