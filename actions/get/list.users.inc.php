<?php
user_set_access(2);

$page['title'] = "Пользователи";
include('./templates/head.inc.php');
  $items = user_listUsers();
  ?>
  <h1><?=$page['title'];?>
  <a href="./?a=add.user" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> добавить</a>
  </h1>
  <?
  ?>
  <div class="form-group">
    <input data-input="quick-search" class="form-control" data-search-target="#searchable-table tbody > tr" name="quick-search" placeholder="Filter"/>
  <span class="glyphicon glyphicon-remove-circle form-control-feedback form-action-clear" aria-hidden="true"></span>
  </div>
  <table class="table" id="searchable-table">
    <tr>
      <th>_id</th>
      <th>Дата добавления</th>
      <th>Имя</th>
      <th>Логин</th>
      <th>Группа</th>
      <th colspan="2">Операции</th>
    </tr>
    <?
  foreach($items as $k=>$v){
    $group = user_getGroup($v['_group']);
    ?>
    <tr class="<? if(isset($_GET['id']) && $_GET['id'] == $v['_id']){echo "success";}?>">
      <td><?=$v['_id'];?></td>
      <td><?=date("d.m.Y, H:i:s", $v['date_added']);?></td>
      <td><?=$v['name'];?></td>
      <td><?=$v['login'];?></td>
      <td><a href="./?a=edit.group&amp;id=<?=$group['_id'];?>"><?=$group['name'];?></td>
      <td><a href="./?a=edit.user&amp;id=<?=$v['_id'];?>" class="btn btn-default" title="редактировать"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
      <td><a href="./?a=remove.user&amp;id=<?=$v['_id'];?>" class="btn btn-danger" title="удалить"><i class="fa fa-times" aria-hidden="true"></i></a></td>
    </tr>
    <?php
  }
  ?></table><?
include('./templates/foot.inc.php');

?>
