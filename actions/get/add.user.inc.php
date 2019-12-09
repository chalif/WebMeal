<?php
user_set_access(2);

$page['title'] = "Добавление пользователя";
include('./templates/head.inc.php');
$groups = user_listGroups();
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.users" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="add.user"/>
    <div class="form-group">
      <label for="inputName" class="col-sm-2 control-label">Имя пользователя</label>
      <div class="col-sm-10"><input type="text" name="data[name]" class="form-control" id="inputName" value="" placeholder="Имя"/></div>
    </div>
    <div class="form-group">
      <label for="inputLogin" class="col-sm-2 control-label">Логин</label>
      <div class="col-sm-10"><input type="text" name="data[login]" class="form-control" id="inputLogin" value="" placeholder="Логин"/></div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-sm-2 control-label">Пароль</label>
      <div class="col-sm-10"><input type="text" name="password" class="form-control" id="inputPassword" value="" placeholder="Пароль"/></div>
    </div>
    <div class="form-group">
      <label for="inputGroup" class="col-sm-2 control-label">Группа</label>
      <div class="col-sm-10"><select name="data[_group]" id="inputGroup" class="form-control">
      <?php foreach($groups as $group){ ?>
        <? if(user_getAccess() >= $group['_access']){ ?>
        <option value="<?=$group['_id'];?>"><?=$group['name'];?></option>
      <? } ?>
      <?php } ?>
      </select></div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-default" value="Добавить"/>
      </div>
    </div>
  </form>
  <?
include('./templates/foot.inc.php');

?>
