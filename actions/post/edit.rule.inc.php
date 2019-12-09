<?php
user_set_access(3);

  if(isset($_POST['data'])){
    wm_editRule($_POST['id'], $_POST['data']);
    go_to("./?a=list.rules&id=".$_POST['id']);
  }
?>
