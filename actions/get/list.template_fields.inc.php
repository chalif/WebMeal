<?php
user_set_access(3);

  $page['title'] = "Поля шаблона";
  include('./templates/head.inc.php');

  $template_fields = wm_listTemplatesFields($_GET['id']);
  $tmp_fields = array();
  $fields = wm_listFields();
  ?>
  <h1><?=$page['title'];?></h1>
  <a href="./?a=list.templates" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> вернуться</a>
  <form method="post" action="./" class="form-horizontal">
    <input type="hidden" name="a" value="edit.template_fields"/>
    <input type="hidden" name="_template" value="<?=$_GET['id'];?>"/>
  <div class="row">
    <div class="col-sm-6">
      <h3>Активные поля</h3>
      <ul id="activeFields" class="list-unstyled"><?
  foreach($template_fields as $k=>$v){
    $tmp_fields[] = $v['_id'];
    ?><li><span class="btn btn-sm btn-danger" onclick="remove($(this));"><i class="fa fa-times" aria-hidden="true"></i></span><input type="hidden" name="data[_field][]" value="<?=$v['_id'];?>"> <?=$v['name'];?> (<?=$v['f_name'];?>)</li><?
  }
  ?></ul>
</div>
  <div class="col-sm-6">
    <h3>Доступные поля</h3>
  <ul id="inactiveFields" class="list-unstyled"><?
  foreach($fields as $k=>$v){
    if(!in_array($v['_id'], $tmp_fields)){
      ?><li><input type="hidden" name="" value="<?=$v['_id'];?>"> <?=$v['name'];?> (<?=$v['f_name'];?>)</li><?
    }
  }
  ?></ul>
</div>
</div>
<div class="form-group">
  <div class="col-sm-12">
    <input type="submit" class="btn btn-default" value="Сохранить"/>
  </div>
</div>
</form>
  <script>
  $(document).ready(function() {
  sortableFields();
  });
  </script>
  <?

  include('./templates/foot.inc.php');
?>
