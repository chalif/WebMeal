<?php
user_set_access(3);

  if(isset($_POST['id'])){
    wm_removeSet($_POST['id']);
    go_to("./?a=list.sets");
  }
?>
