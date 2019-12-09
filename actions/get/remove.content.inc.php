<?php
user_set_access(1);

$set = wm_getSet($_GET['set']);
if(!$set){
  go_to("./?a=index");
}
$item = wm_getContent($_GET['id']);
if(!$item){
  go_to("./?a=content&id=".$_GET['set']);
}
$page['title'] = "Удаление контента";
include('./templates/head.inc.php');
?>
<h1><?=$page['title'];?></h1>
<a href="./?a=list.fields" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
<form method="post" action="./" class="form-horizontal">
  <input type="hidden" name="a" value="remove.content"/>
  <input type="hidden" name="set" value="<?=$set['_id'];?>"/>
  <input type="hidden" name="id" value="<?=$item['_id'];?>"/>
  <div class="form-group">
    <div class="col-sm-12">
    Вы действительно хотите удалить контент "id:<?=$item['_id'];?>"?
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <input type="submit" class="btn btn-danger" value="Удалить"/>
    </div>
  </div>
</form>
<?
include('./templates/foot.inc.php');
?>
