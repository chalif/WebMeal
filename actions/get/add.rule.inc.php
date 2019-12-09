<?php
user_set_access(3);

$page['title'] = "Добавление правила";
$types = wm_listTypes();
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.rules" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="add.rule"/>
    <div class="form-group">
      <label for="inputName" class="col-sm-2 control-label">Название</label>
      <div class="col-sm-10"><input type="text" name="data[name]" class="form-control" id="inputName" value="" placeholder="Название"/></div>
    </div>
    <div class="form-group">
    <label for="inputDatatype" class="col-sm-2 control-label">Тип</label>
    <div class="col-sm-10"><select name="data[_type]" id="inputType" class="form-control">
    <?php foreach($types as $type){ ?>
      <option value="<?=$type['_id'];?>"><?=$type['name'];?></option>
    <?php } ?>
    </select></div>
    </div>
    <div class="form-group">
      <label for="inputData" class="col-sm-2 control-label">Правило (в формате JSON)</label>
      <div class="col-sm-10"><textarea type="text" name="data[data]" class="form-control" id="inputData" placeholder="Правило"></textarea></div>
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
