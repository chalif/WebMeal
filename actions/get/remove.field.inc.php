<?php
user_set_access(3);

$item = wm_getField($_GET['id']);
if(!$item){
  go_to("./?a=list.fields");
}
$page['title'] = "Удаление поля";
include('./templates/head.inc.php');
?>
<h1><?=$page['title'];?></h1>
<a href="./?a=list.fields" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
<form method="post" action="./" class="form-horizontal">
  <input type="hidden" name="a" value="remove.field"/>
  <input type="hidden" name="id" value="<?=$item['_id'];?>"/>
  <div class="form-group">
    <div class="col-sm-12">
    Вы действительно хотите удалить поле "<?=$item['name'];?>"?
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
