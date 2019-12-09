<?php
  $fields = wm_listTemplatesFields($_GET['template_id']);
  echo json_encode($fields, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
?>
