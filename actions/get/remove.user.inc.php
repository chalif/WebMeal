<?php
user_set_access(2);

$item = user_getUser($_GET['id']);
if(!$item){
  go_to("./?a=list.users");
}
$page['title'] = "Удаление пользователя";
include('./templates/head.inc.php');
?>
<h1><?=$page['title'];?></h1>
<a href="./?a=list.users" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
<form method="post" action="./" class="form-horizontal">
  <input type="hidden" name="a" value="remove.user"/>
  <input type="hidden" name="id" value="<?=$item['_id'];?>"/>
  <div class="form-group">
    <div class="col-sm-12">
    Вы действительно хотите удалить пользователя "<?=$item['name'];?>"?
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
