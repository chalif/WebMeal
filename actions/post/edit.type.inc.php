<?php
user_set_access(3);

  if(isset($_POST['data'])){
    wm_editType($_POST['id'], $_POST['data']);
    go_to("./?a=list.types&id=".$_POST['id']);
  }
?>
