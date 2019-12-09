<?php
user_set_access(1);

  if(isset($_POST['data'])){
    $id = wm_addContent(array("_set"=>$_POST['set']));
    foreach($_POST['data'] as $field_id=>$value){
      $addVal = array("_item"=>$id, "_set"=>$_POST['set'], "_field"=>$field_id);

        $field = wm_getField($field_id);
        $rule = wm_getRule($field['_rule']);
        $rule_data = json_decode(htmlspecialchars_decode($rule['data'], ENT_QUOTES), true);

        $type = wm_getType($rule['_type']);
        switch($type['datatype']){
          case "string":
            if(is_array($value)){
              $value = join(",", $value);
            }
            $addVal['val_string'] = $value;
          break;
          case "int":
            if(in_array( $rule_data['type'], array("date", "datetime") )){
              $value = $value / 1000;
            }
            $addVal['val_int'] = $value;
          break;
          case "float":
            $addVal['val_float'] = $value;
          break;
          case "text":
            $addVal['val_text'] = $value;
          break;
          case "bool":
            $addVal['val_bool'] = $value;
          break;
          case "file":
            if(isset($_FILES['data']['tmp_name'][$field_id]) && !$_FILES['data']['error'][$field_id]){
              $file_id = wm_addFile($field_id);
            }
            $addVal['val_file'] = $file_id;
          break;
        }
        wm_addContentData($addVal);
    }
    $tmp_c = wm_getContent_json($id);
    $result = [];
    array_walk_recursive($tmp_c, function($v) use (&$result) {
      $result[] = $v;
    });
    $index_data = array("s_index" => join(";", $result));
    wm_editContent($id, $index_data);

    go_to("./?a=content&id=".$_POST['set']."&cid=".$id);
  }
?>
