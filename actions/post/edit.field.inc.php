<?php
user_set_access(3);

  if(isset($_POST['data'])){
    wm_editField($_POST['id'], $_POST['data']);
    go_to("./?a=list.fields&id=".$_POST['id']);
  }
?>
