<?php
$item = wm_getSet($_GET['id']);
if(!$item){
  go_to("./?a=index");
}
$page['title'] = $item['name'];
$fields = wm_listTemplatesFields($item['_id'], -1, true);
include('./templates/head.inc.php');
?>
  <h1><?=$page['title'];?>
    <a href="./?a=create.in.set" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> add</a>
  </h1>
  <div><i><?=$item['description'];?></i></div>
  <table class="table">
    <tr>
      <th>_id</th>
      <th>date_added</th>
      <?
      foreach($fields as $field){
        ?><th><?=$field['name'];?></th><?
      }
      ?>
      <th colspan="2">operations</th>
    </tr>
    <?

  ?></table>
<?php
include('./templates/foot.inc.php');

?>
