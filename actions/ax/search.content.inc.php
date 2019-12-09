<?php
if(isset($_GET['query']) && strlen($_GET['query'])){
  $retVal = array();
  $items = wm_searchContent($_GET['query']);
  foreach($items as $item){
    $retVal[] = array("info"=>$item,"html"=>wm_getContent_html($item['_id']));
  }

  echo json_encode($retVal, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>
