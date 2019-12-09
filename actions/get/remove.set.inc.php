<?php
user_set_access(3);

$item = wm_getSet($_GET['id']);
if(!$item){
  go_to("./?a=list.sets");
}
$page['title'] = "Удаление набора";
include('./templates/head.inc.php');
?>
<h1><?=$page['title'];?></h1>
<a href="./?a=list.sets" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
<form method="post" action="./" class="form-horizontal">
  <input type="hidden" name="a" value="remove.set"/>
  <input type="hidden" name="id" value="<?=$item['_id'];?>"/>
  <div class="form-group">
    <div class="col-sm-12">
    Вы действительно хотите удалить набор "<?=$item['name'];?>"?
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
