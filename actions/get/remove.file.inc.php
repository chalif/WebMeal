<?php
user_set_access(1);

$item = wm_getFile($_GET['id']);
if(!$item){
  go_to("./?a=index");
}
$page['title'] = "Удаление файла";
include('./templates/head.inc.php');
?>
<h1><?=$page['title'];?></h1>
<a onclick="window.close();" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
<form method="post" action="./" class="form-horizontal">
  <input type="hidden" name="a" value="remove.file"/>
  <input type="hidden" name="id" value="<?=$item['_id'];?>"/>
  <div class="form-group">
    <div class="col-sm-12">
    Вы действительно хотите удалить файл "<?=$item['str_id'];?> / <?=$item['original_name'];?>"?
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
