<?php
include("../config.inc.php");

include("../functions.inc.php");
include("../content.functions.inc.php");

include("./mysqli.db.class.php");

$db = new database();
$db->clear_parms = 1;
$db->name = "WebMeal";
$db->utf = true;
$db->debug = 0;
$db->connect();

if(isset($_GET['debug'])){
  $db->debug = 1;
  print_r($_GET);
}
$retVal = array();
$page = -1;
if(isset($_GET['page'])){
  $page = intval($_GET['page']);
}
$offset = 0;
if(isset($_GET['offset'])){
  $offset = intval($_GET['offset']);
}
$count = DB_SELECT_COUNT;
if(isset($_GET['count'])){
  $count = intval($_GET['count']);
}

if(isset($_GET['a'])){
  if($_GET['a'] == 'set'){

    if(isset($_GET['f_name'])){
      $set = wm_getSetByFName($_GET['f_name']);
      $items_count = wm_getCountContent($set['_id']);
      $retVal['set'] = array("_id"=>intval($set['_id']), "name"=>$set['name'], "f_name"=>$set['f_name']);
      $retVal['count'] = intval($items_count);
      if($page > -1){
        $retVal['pages'] = ceil($items_count / $count);
      }
      $retVal['elements'] = wm_listContent_json($set['_id'], $page, $count);
    }
  }else if($_GET['a'] == 'search'){
    $retVal = array();
    if(isset($_GET['query']) && strlen($_GET['query'])){
      $items = wm_searchContent($_GET['query']);
      foreach($items as $item){
        $set = wm_getSet($item['_set']);

        $set_val = array("_id"=>intval($set['_id']), "name"=>$set['name'], "f_name"=>$set['f_name']);
        $retVal[] = array("set"=>$set_val,"item"=>wm_getContent_json($item['_id']));
      }
    }
  }else if($_GET['a'] == 'content'){

  }
}
if(isset($_GET['callback'])){
  header("Content-type: application/javascript; charset=utf-8");
  echo $_GET['callback']."(";
  echo json_encode($retVal, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
  echo ")";
}else{
  header("Content-type: application/json; charset=utf-8");
  echo json_encode($retVal, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>
