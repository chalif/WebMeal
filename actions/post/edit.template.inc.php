<?php
user_set_access(3);

  if(isset($_POST['data'])){
    wm_editTemplate($_POST['id'], $_POST['data']);
    go_to("./?a=list.templates&id=".$_POST['id']);
  }
?>
