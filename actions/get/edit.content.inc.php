<?php
user_set_access(1);

$set = wm_getSet($_GET['set']);
if(!$set){
  go_to("./?a=index");
}
$item = wm_getContent($_GET['id']);
if(!$item){
  go_to("./?a=index");
}

$page['title'] = $set['name'];
$fields = wm_listTemplatesFields($set['_template']);
include('./templates/head.inc.php');
?>
  <h1>Редактирование контента "<?=$page['title'];?>"</h1>
  <a href="./?a=content&amp;id=<?=$set['_id'];?>" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
    <form method="post" action="./" class="form-horizontal" enctype="multipart/form-data">
      <input type="hidden" name="a" value="edit.content"/>
      <input type="hidden" name="set" value="<?=$set['_id'];?>"/>
      <input type="hidden" name="id" value="<?=$item['_id'];?>"/>
<?php
  foreach($fields as $field){
    $content = wm_getContentData($item['_id'], $field['_id']);
    $rule = wm_getRule($field['_rule']);
    $type = wm_getType($rule['_type']);
    ?><div class="form-group">
      <label for="input_<?=$field['f_name'];?>" class="col-sm-2 control-label"><?=$field['name'];?></label>
      <div class="col-sm-10"><?
      wm_formatFieldFor($field, $rule, $type, $content['value']);
    ?>
  </div>
  </div>
    <?
  }
?>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <input type="submit" class="btn btn-default" value="Сохранить"/>
  </div>
</div>
  </form>
  <?
include('./templates/foot.inc.php');

?>
