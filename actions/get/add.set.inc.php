<?php
user_set_access(3);

$page['title'] = "Добавление набора";
$templates = wm_listTemplates();
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.sets" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="add.set"/>
    <div class="form-group">
      <label for="inputName" class="col-sm-2 control-label">Название</label>
      <div class="col-sm-10"><input type="text" name="data[name]" class="form-control" id="inputName" value="" placeholder="Название"/></div>
    </div>
    <div class="form-group">
      <label for="inputFName" class="col-sm-2 control-label">Название функции вызова</label>
      <div class="col-sm-10"><input type="text" name="data[f_name]" class="form-control" id="inputFName" value="" placeholder="Function Name"/></div>
    </div>
    <div class="form-group">
    <label for="inputTemplate" class="col-sm-2 control-label">Шаблон</label>
    <div class="col-sm-10"><select name="data[_template]" id="inputTemplate" class="form-control" onchange="asyncGetFieldsForTemplate($(this).val(), 0);">
      <option value="0">Отключено</option>
    <?php foreach($templates as $template){ ?>
      <option value="<?=$template['_id'];?>"><?=$template['name'];?></option>
    <?php } ?>
    </select></div>
    </div>
    <div class="form-group">
      <label for="inputDescription" class="col-sm-2 control-label">Описание</label>
      <div class="col-sm-10"><textarea type="text" name="data[description]" class="form-control" id="inputDescription" placeholder="Description"></textarea></div>
    </div>

    <div class="form-group">
    <label for="inputSortField" class="col-sm-2 control-label">Поле для сортировки</label>
    <div class="col-sm-10"><select name="data[sort_by]" id="inputSortField" class="form-control">
      <option value="0">Дата добавления элемениа</option>
    </select></div>
    </div>

    <div class="form-group">
    <label for="inputSortOrder" class="col-sm-2 control-label">Порядок сортировки</label>
    <div class="col-sm-10"><select name="data[sort_order]" id="inputSortOrder" class="form-control">
      <option value="desc">по убыванию</option>
      <option value="asc">по возрастанию</option>
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
