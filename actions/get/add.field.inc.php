<?php
user_set_access(3);

$page['title'] = "Добавление поля";
$rules = wm_listRules();
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.fields" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="add.field"/>
    <div class="form-group">
      <label for="inputName" class="col-sm-2 control-label">Название</label>
      <div class="col-sm-10"><input type="text" name="data[name]" class="form-control" id="inputName" value="" placeholder="Название"/></div>
    </div>
    <div class="form-group">
      <label for="inputFName" class="col-sm-2 control-label">Название функции вызова</label>
      <div class="col-sm-10"><input type="text" name="data[f_name]" class="form-control" id="inputFName" value="" placeholder="Function Name"/></div>
    </div>
    <div class="form-group">
    <label for="inputRule" class="col-sm-2 control-label">Правило</label>
    <div class="col-sm-10"><select name="data[_rule]" id="inputRule" class="form-control">
    <?php foreach($rules as $rule){ ?>
      <option value="<?=$rule['_id'];?>"><?=$rule['name'];?></option>
    <?php } ?>
    </select></div>
    </div>
    <div class="form-group">
      <label for="inputParameters" class="col-sm-2 control-label">Параметры<br/><small>Для правил 'Set' или 'Multiply set': {&quot;set_id&quot;:<i>set identifier</i>}</small></label>
      <div class="col-sm-10"><input type="text" name="data[parameters]" class="form-control" id="inputParameters" value="" placeholder="Параметры"/></div>
    </div>
    <div class="form-group">
      <label for="inputDescription" class="col-sm-2 control-label">Описание</label>
      <div class="col-sm-10"><textarea type="text" name="data[description]" class="form-control" id="inputDescription" placeholder="Description"></textarea></div>
    </div>
    <div class="form-group">
      <label for="" class="col-sm-2 control-label">Видимость в списке</label>
      <div class="btn-group col-sm-10" data-toggle="buttons">
      <label class="btn btn-default active">
        <input type="radio" name="data[_show_in_list]" value="1" id="option1" autocomplete="off" checked> Отображать
      </label>
      <label class="btn btn-default">
        <input type="radio" name="data[_show_in_list]" value="0" id="option2" autocomplete="off"> Скрыть
      </label>
    </div>
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
