<?php
user_set_access(3);

$page['title'] = "Добавление группы";
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.groups" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="add.group"/>
    <div class="form-group">
      <label for="inputName" class="col-sm-2 control-label">Название</label>
      <div class="col-sm-10"><input type="text" name="data[name]" class="form-control" id="inputName" value="" placeholder="Название"/></div>
    </div>
    <div class="form-group">
      <label for="inputAccess" class="col-sm-2 control-label">Уровень доступа</label>
      <div class="col-sm-10"><input type="number" name="data[_access]" class="form-control" id="inputAccess" value="" placeholder="Уровень доступа [0 - n]"/></div>
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
