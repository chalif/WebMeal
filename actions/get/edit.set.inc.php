<?php
user_set_access(3);

$item = wm_getSet($_GET['id']);
if(!$item){
  go_to("./?a=list.sets");
}
$page['title'] = "Редактирование набора";
$templates = wm_listTemplates();
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.sets" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="edit.set"/>
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
    <label for="inputTemplate" class="col-sm-2 control-label">Шаблон</label>
    <div class="col-sm-10"><select name="data[_template]" id="inputTemplate" class="form-control" onchange="asyncGetFieldsForTemplate($(this).val());">
      <option value="0">Отключено</option>
    <?php foreach($templates as $template){ ?>
      <option value="<?=$template['_id'];?>" <? if($template['_id'] == $item['_template']){echo "selected";} ?>><?=$template['name'];?></option>
    <?php } ?>
    </select></div>
    </div>
    <div class="form-group">
      <label for="inputDescription" class="col-sm-2 control-label">Описание</label>
      <div class="col-sm-10"><textarea type="text" name="data[description]" class="form-control" id="inputDescription" placeholder="Описание"><?=$item['description'];?></textarea></div>
    </div>

    <div class="form-group">
    <label for="inputSortField" class="col-sm-2 control-label">Поле для сортировки</label>
    <div class="col-sm-10"><select name="data[sort_by]" id="inputSortField" class="form-control">
      <option value="0">Дата добавления</option>
    </select></div>
    </div>

    <div class="form-group">
    <label for="inputSortOrder" class="col-sm-2 control-label">Порядок сортировки</label>
    <div class="col-sm-10"><select name="data[sort_order]" id="inputSortOrder" class="form-control">
      <option value="desc" <? if($item['sort_order'] == 'desc'){echo "selected";}?>>по убыванию</option>
      <option value="asc" <? if($item['sort_order'] == 'asc'){echo "selected";}?>>по возрастанию</option>
    </select></div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-default" value="Сохранить"/>
      </div>
    </div>
  </form>
  <script>
  $(document).ready(function() {
    asyncGetFieldsForTemplate($("#inputTemplate").val(), <?=$item['sort_by'];?>);
  });
  </script>
  <?
include('./templates/foot.inc.php');

?>
