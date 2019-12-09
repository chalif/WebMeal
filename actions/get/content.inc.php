<?php
user_set_access(1);

$item = wm_getSet($_GET['id']);
if(!$item){
  go_to("./?a=index");
}
$page['title'] = $item['name'];
$fields = wm_listTemplatesFields($item['_template'], -1, true);
$items = wm_listContent($item['_id'], -1, $fields);
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?>
    <a href="./?a=add.content&amp;set=<?=$item['_id'];?>" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> добавить</a>
  </h1>
  <div><i><?=$item['description'];?></i></div>
  <div class="form-group">
    <input data-input="quick-search" class="form-control" data-search-target="#searchable-table tbody > tr" name="quick-search" placeholder="Фильтр"/>
  <span class="glyphicon glyphicon-remove-circle form-control-feedback form-action-clear" aria-hidden="true"></span>
  </div>
  <table class="table" id="searchable-table">
    <tr>
      <th>_id</th>
      <th>Дата добавления</th>
      <?
      foreach($fields as $field){
        ?><th><?=$field['name'];?></th><?
      }
      ?>
      <th colspan="2">Операции</th>
    </tr>
    <?
    foreach($items as $v){
      ?><tr class="<? if(isset($_GET['cid']) && $_GET['cid'] == $v['_id']){echo "success";}?>">
        <td><?=$v['_id'];?></td>
        <td><?=date("d.m.Y, H:i:s", $v['date_added']);?></td>
        <?
          foreach($v['elements'] as $elem){
            ?><td>
              <?=$elem['value'];?>
            </td><?
          }
        ?>
        <td><a href="./?a=edit.content&amp;set=<?=$item['_id'];?>&amp;id=<?=$v['_id'];?>" class="btn btn-default" title="редактировать"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
        <td><a href="./?a=remove.content&amp;set=<?=$item['_id'];?>&amp;id=<?=$v['_id'];?>" class="btn btn-danger" title="удалить"><i class="fa fa-times" aria-hidden="true"></i></a></td>
      </tr><?
    }
  ?></table>
<?php
include('./templates/foot.inc.php');

?>
