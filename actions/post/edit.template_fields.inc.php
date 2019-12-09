<?php
user_set_access(3);

if(!intval($_POST['_template']))
  go_to("./?a=list.templates");
  wm_removeTemplateFields($_POST['_template']);
  foreach($_POST['data']['_field'] as $k=>$v){
    wm_addTemplateField(array('_template'=>$_POST['_template'], '_field'=>$v, 'position'=>$k));
  }
  go_to("./?a=list.templates&id=".$_POST['_template']);
?>
