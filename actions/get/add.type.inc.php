<?php
user_set_access(3);

$page['title'] = "Добавление типа";
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.types" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="add.type"/>
    <div class="form-group">
      <label for="inputName" class="col-sm-2 control-label">Название</label>
      <div class="col-sm-10"><input type="text" name="data[name]" class="form-control" id="inputName" value="" placeholder="Name"/></div>
    </div>
    <div class="form-group">
    <label for="inputDatatype" class="col-sm-2 control-label">Тип данных</label>
    <div class="col-sm-10"><select name="data[datatype]" id="inputDatatype" class="form-control">
      <option value="int">Integer (целое число)</option>
      <option value="float">Float (число с плавающей точкой)</option>
      <option value="string">String (строка, до 255 символов)</option>
      <option value="text">Text (текст)</option>
      <option value="file">File (файл)</option>
      <option value="bool">Boolean (булев тип)</option>
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
