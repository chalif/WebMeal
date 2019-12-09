<?php
user_set_access(3);

  if(isset($_POST['id'])){
    wm_removeRule($_POST['id']);
    go_to("./?a=list.rules");
  }
?>
