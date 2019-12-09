<?php
user_set_access(3);

$page['title'] = "Наборы";
include('./templates/head.inc.php');
  $items = wm_listSets();
  ?>
  <h1><?=$page['title'];?>
  <a href="./?a=add.set" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> добавить</a>
  </h1>
  <?
  ?>
  <div class="form-group">
    <input data-input="quick-search" class="form-control" data-search-target="#searchable-table tbody > tr" name="quick-search" placeholder="Фильтр"/>
  <span class="glyphicon glyphicon-remove-circle form-control-feedback form-action-clear" aria-hidden="true"></span>
  </div>
  <table class="table" id="searchable-table">
    <tr>
      <th>_id</th>
      <th>Дата добавления</th>
      <th>Название</th>
      <th>f_name</th>
      <th>Описание</th>
      <th>Шаблон</th>
      <th>Сортировать по</th>
      <th>Порядок сортировки</th>
      <th colspan="2">Операции</th>
    </tr>
    <?
  foreach($items as $k=>$v){
    $template = wm_getTemplate($v['_template']);
    $sort_by = "date_added";
    if($v['sort_by']){
      $tmp_field = wm_getField($v['sort_by']);
      $sort_by = $tmp_field['name'];
    }
    ?>
    <tr class="<? if(isset($_GET['id']) && $_GET['id'] == $v['_id']){echo "success";}?>">
      <td><?=$v['_id'];?></td>
      <td><?=date("d.m.Y, H:i:s", $v['date_added']);?></td>
      <td><?=$v['name'];?></td>
      <td><?=$v['f_name'];?></td>
      <td><?=$v['description'];?></td>
      <td><a href="./?a=edit.template&amp;id=<?=$v['_template'];?>"><?=$v['_template'];?> (<?=$template['name'];?>)</a></td>
      <td><?=$sort_by;?></td>
      <td><?=$v['sort_order'];?></td>
      <td><a href="./?a=edit.set&amp;id=<?=$v['_id'];?>" class="btn btn-default" title="редактировать"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
      <td><a href="./?a=remove.set&amp;id=<?=$v['_id'];?>" class="btn btn-danger" title="удалить"><i class="fa fa-times" aria-hidden="true"></i></a></td>
    </tr>
    <?php
  }
  ?></table><?
include('./templates/foot.inc.php');

?>
