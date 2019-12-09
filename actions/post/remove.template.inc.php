<?php
user_set_access(3);

  if(isset($_POST['id'])){
    wm_removeTemplate($_POST['id']);
    wm_removeTemplateFields($_POST['id']);
    go_to("./?a=list.templates");
  }
?>
