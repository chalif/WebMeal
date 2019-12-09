<?php
user_set_access(3);

  if(isset($_POST['data'])){
    $id = wm_addType($_POST['data']);
    go_to("./?a=list.types&id=".$id);
  }
?>
