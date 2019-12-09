<?php
user_set_access(2);

$item = user_getUser($_GET['id']);
if(!$item){
  go_to("./?a=list.users");
}
$page['title'] = "Редактирование пользователя";
include('./templates/head.inc.php');
$groups = user_listGroups();
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.users" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="edit.user"/>
    <input type="hidden" name="id" value="<?=$item['_id'];?>"/>
    <div class="form-group">
      <label for="inputName" class="col-sm-2 control-label">Имя пользователя</label>
      <div class="col-sm-10"><input type="text" name="data[name]" class="form-control" id="inputName" value="<?=$item['name'];?>" placeholder="Имя пользователя"/></div>
    </div>
    <div class="form-group">
      <label for="inputLogin" class="col-sm-2 control-label">Логин</label>
      <div class="col-sm-10"><input type="text" name="data[login]" class="form-control" id="inputLogin" value="<?=$item['login'];?>" placeholder="Логин"/></div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-sm-2 control-label">Пароль (заполнить для смены)</label>
      <div class="col-sm-10"><input type="text" name="password" class="form-control" id="inputPassword" value="" placeholder="Пароль"/></div>
    </div>
    <div class="form-group">
      <label for="inputGroup" class="col-sm-2 control-label">Группа</label>
      <div class="col-sm-10"><select name="data[_group]" id="inputGroup" class="form-control">
      <?php foreach($groups as $group){ ?>
        <? if(user_getAccess() >= $group['_access']){ ?>
          <option value="<?=$group['_id'];?>" <? if($group['_id'] == $item['_group']){ echo "selected";}?>><?=$group['name'];?></option>
        <? } ?>
      <?php } ?>
      </select></div>
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
