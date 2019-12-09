<?php
user_set_access(1);

  if(isset($_POST['id'])){
    wm_removeContent($_POST['id']);
    go_to("./?a=content&id=".$_POST['set']);
  }
?>
