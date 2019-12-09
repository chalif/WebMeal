<?php
user_set_access(3);

$item = wm_getType(intval($_GET['id']));
if(!$item){
  go_to("./a=list.types");
}
$page['title'] = "Редактирование типа";
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.types" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="edit.type"/>
    <input type="hidden" name="id" value="<?=$item['_id'];?>"/>
    <div class="form-group">
      <label for="inputName" class="col-sm-2 control-label">Название</label>
      <div class="col-sm-10"><input type="text" name="data[name]" class="form-control" id="inputName" value="<?=$item['name'];?>" placeholder="Название"/></div>
    </div>
    <div class="form-group">
    <label for="inputDatatype" class="col-sm-2 control-label">Тип данных</label>
    <div class="col-sm-10"><select name="data[datatype]" id="inputDatatype" class="form-control">
      <option value="int" <? if($item['datatype'] == 'int'){echo "selected";}?>>Integer (целое число)</option>
      <option value="float" <? if($item['datatype'] == 'float'){echo "selected";}?>>Float (число с плавающей точкой)</option>
      <option value="string" <? if($item['datatype'] == 'string'){echo "selected";}?>>String (строка, до 255 символов)</option>
      <option value="text" <? if($item['datatype'] == 'text'){echo "selected";}?>>Text (текст)</option>
      <option value="file" <? if($item['datatype'] == 'file'){echo "selected";}?>>File (файл)</option>
      <option value="bool" <? if($item['datatype'] == 'bool'){echo "selected";}?>>Boolean (булев тип)</option>
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
