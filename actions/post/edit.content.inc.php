<?php
user_set_access(1);

  if(isset($_POST['data'])){
    foreach($_POST['data'] as $field_id=>$value){

      $content = wm_getContentData($_POST['id'], $field_id);
      $addVal = array();

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
              $addVal['val_file'] = $file_id;
            }else{
              break;
            }

          break;
        }
        if(!isset($content['_id'])){
          $addVal["_item"]=$_POST['id'];
          $addVal["_set"]=$_POST['set'];
          $addVal["_field"]=$field_id;
          wm_addContentData($addVal);
        }else{
          wm_editContentData($content['_id'], $addVal);
        }
        $tmp_c = wm_getContent_json($_POST['id']);
        $result = [];
        array_walk_recursive($tmp_c, function($v) use (&$result) {
          $result[] = $v;
        });
        $index_data = array("s_index" => join(";", $result));
        wm_editContent($_POST['id'], $index_data);
    }

    go_to("./?a=content&id=".$_POST['set']."&cid=".$_POST['id']);
  }
?>
