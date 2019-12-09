<?php
user_set_access(3);

$item = wm_getTemplate($_GET['id']);
if(!$item){
  go_to("./?a=list.templates");
}
$page['title'] = "Редактирование шаблона";
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.templates" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="edit.template"/>
    <input type="hidden" name="id" value="<?=$item['_id'];?>"/>
    <div class="form-group">
      <label for="inputName" class="col-sm-2 control-label">Название</label>
      <div class="col-sm-10"><input type="text" name="data[name]" class="form-control" id="inputName" value="<?=$item['name'];?>" placeholder="Название"/></div>
    </div>
    <div class="form-group">
      <label for="inputFName" class="col-sm-2 control-label">Название функции вызова</label>
      <div class="col-sm-10"><input type="text" name="data[f_name]" class="form-control" id="inputFName" value="<?=$item['f_name'];?>" placeholder="Function Name"/></div>
    </div>
    <div class="form-group">
      <label for="inputDescription" class="col-sm-2 control-label">Описание</label>
      <div class="col-sm-10"><textarea type="text" name="data[description]" class="form-control" id="inputDescription" placeholder="Описание"><?=$item['description'];?></textarea></div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-default" value="Сохранить"/>
      </div>
    </div>
  </form>
  <?
include('./templates/foot.inc.php');

?>
