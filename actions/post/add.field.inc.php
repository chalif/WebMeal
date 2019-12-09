<?php
user_set_access(3);

  if(isset($_POST['data'])){
    $id = wm_addField($_POST['data']);
    go_to("./?a=list.fields&id=".$id);
  }
?>
