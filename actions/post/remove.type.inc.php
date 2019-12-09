<?php
user_set_access(3);
  if(isset($_POST['id'])){
    wm_removeType($_POST['id']);
    go_to("./?a=list.types");
  }
?>
