<?php
user_set_access(3);

$page['title'] = "Редактирование правила";
$item = wm_getRule($_GET['id']);
if(!$item){
  go_to("./a=list.rules");
}
$types = wm_listTypes();
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.rules" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="edit.rule"/>
    <input type="hidden" name="id" value="<?=$item['_id'];?>"/>
    <div class="form-group">
      <label for="inputName" class="col-sm-2 control-label">Название</label>
      <div class="col-sm-10"><input type="text" name="data[name]" class="form-control" id="inputName" value="<?=$item['name'];?>" placeholder="Название"/></div>
    </div>
    <div class="form-group">
    <label for="inputDatatype" class="col-sm-2 control-label">Тип</label>
    <div class="col-sm-10"><select name="data[_type]" id="inputType" class="form-control">
    <?php foreach($types as $type){ ?>
      <option value="<?=$type['_id'];?>" <? if($type['_id'] == $item['_type']){ echo "selected";} ?>><?=$type['name'];?></option>
    <?php } ?>
    </select></div>
    </div>
    <div class="form-group">
      <label for="inputData" class="col-sm-2 control-label">Данные правила (в формате JSON)</label>
      <div class="col-sm-10"><textarea type="text" name="data[data]" class="form-control" id="inputData" placeholder="Данные"><?=$item['data'];?></textarea></div>
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
