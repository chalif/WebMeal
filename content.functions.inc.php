<?php
function wm_getSetByFName($fname){
  global $db;
  return $db->get_assoc("select * from ".DB_TABLE_SETS." where f_name = '".$fname."'");
}

function wm_getCountContent($set){
  global $db;
  return $db->get_item("select count(_id) from ".DB_TABLE_ITEMS." where _set = '".$set."'");
}


function wm_formatFieldFor($field, $rule, $type, $value = ""){
  global $db;

  $rule_data = json_decode(htmlspecialchars_decode($rule['data'], ENT_QUOTES), true);
  $field_parameters = json_decode(htmlspecialchars_decode($field['parameters'], ENT_QUOTES), true);

  $field_attrs = "";
  if($rule_data){
    foreach($rule_data as $a=>$f){
      if($a!='type'){
        $field_attrs.=" ".$a."='".$f."' ";
      }
    }
  }
  if($type['datatype'] == "string"){
    if(!$rule_data){
      ?><input type="text" name="data[<?=$field['_id'];?>]" class="form-control" id="input_<?=$field['f_name'];?>" value="<?=$value;?>" placeholder="<?=$field['name'];?>"/><?
    }else if($rule_data['type'] == 'multiply_set'){
      $set = array();
      if(isset($field_parameters['set_id'])){
        $set = wm_listContent($field_parameters['set_id']);
      }
      $values = array();
      if($value){
        $values = explode(",", $value);
      }
      ?><select name="data[<?=$field['_id'];?>][]" multiple="multiple" class="form-control" <?=$field_attrs;?> id="input_<?=$field['f_name'];?>">
        <?php foreach($set as $s){
          $s_val = array();
          foreach($s['elements'] as $e){
            $s_val[] = $e['value'];
          }
          ?>
          <option value="<?=$s['_id'];?>" <? if(in_array($s['_id'],$values)){ echo "selected";}?>><?=join("; ",$s_val);?></option>
        <?php } ?>
      </select><?
    }else{
      ?><input type="<?=$rule_data['type']?>" name="data[<?=$field['_id'];?>]" <?=$field_attrs;?> class="form-control" id="input_<?=$field['f_name'];?>" value="<?=$value;?>" placeholder="<?=$field['name'];?>"/><?
    }
  }else if($type['datatype'] == "int"){
    if(!$rule_data){
      ?><input type="number" <?=$field_attrs;?> name="data[<?=$field['_id'];?>]" class="form-control" id="input_<?=$field['f_name'];?>"value="<?=$value;?>" placeholder="<?=$field['name'];?>"/><?
    }else{
      if($rule_data['type'] == "range"){
        ?><input type="range" <?=$field_attrs;?> name="data[<?=$field['_id'];?>]" class="form-control" id="input_<?=$field['f_name'];?>" value="<?=$value;?>" placeholder="<?=$field['name'];?>"/><?
      }elseif($rule_data['type'] == 'date'){
        ?>
        <div class="input-group date input_<?=$field['f_name'];?> col-md-12" data-date="<? if(strlen($value)){echo date("d.m.Y", strtotime($value));}?>" data-date-format="dd MM yyyy" data-link-format="t" data-link-field="input_<?=$field['f_name'];?>">
          <input class="form-control" size="16" type="text" value="<? if(strlen($value)){echo date("d.m.Y", strtotime($value));}?>" readonly>
          <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
				<input type="hidden" id="input_<?=$field['f_name'];?>" name="data[<?=$field['_id'];?>]" value="<?=strtotime($value)*1000;?>" />
        <script type="text/javascript">
          $(document).ready(function() {
          	$('.input_<?=$field['f_name'];?>').datetimepicker({
                  language:  'ru',
                  weekStart: 1,
                  todayBtn:  1,
          		    autoclose: 1,
          		    todayHighlight: 1,
          		    startView: 2,
          		    forceParse: 0
              });
            });
        </script>
        <?
      }elseif($rule_data['type'] == 'datetime'){
        ?>
        <div class="input-group date col-md-12 input_<?=$field['f_name'];?>" data-date="<? if(strlen($value)){echo date("d.m.Y, H:i", strtotime($value));}?>" data-date-format="dd.mm.yyyy, HH:ii" data-link-format="t" data-link-field="input_<?=$field['f_name'];?>">
          <input class="form-control" size="16" type="text" value="<? if(strlen($value)){echo date("d.m.Y, H:i", strtotime($value));}?>" readonly>
          <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
				<input type="hidden" id="input_<?=$field['f_name'];?>" name="data[<?=$field['_id'];?>]" value="<?=strtotime($value)*1000;?>" />
        <script type="text/javascript">
          $(document).ready(function() {
          	$('.input_<?=$field['f_name'];?>').datetimepicker({
                  language:  'ru',
                  weekStart: 1,
                  todayBtn:  1,
          		    autoclose: 1,
          		    todayHighlight: 1,
          		    startView: 2,
          		    forceParse: 0
              });
            });
        </script>
        <?
      }else if($rule_data['type'] == 'set'){
        $set = array();
        if(isset($field_parameters['set_id'])){
          $set = wm_listContent($field_parameters['set_id']);
        }
        $values = array();
        if($value){
          $values = explode(",", $value);
        }
        ?><select name="data[<?=$field['_id'];?>]" class="form-control" <?=$field_attrs;?> id="input_<?=$field['f_name'];?>">
          <option value="0">Empty</option>
          <?php foreach($set as $s){
            $s_val = array();
            foreach($s['elements'] as $e){
              $s_val[] = $e['value'];
            }
            ?>
            <option value="<?=$s['_id'];?>" <? if(in_array($s['_id'],$values)){ echo "selected";}?>><?=join("; ",$s_val);?></option>
          <?php } ?>
        </select><?
      }else{
        ?><input type="<?=$rule_data['type']?>" name="data[<?=$field['_id'];?>]" <?=$field_attrs;?> class="form-control" id="input_<?=$field['f_name'];?>" value="<?=$value;?>" placeholder="<?=$field['name'];?>"/><?
      }
    }
  }else if($type['datatype'] == "float"){
    if(!$rule_data){
      ?><input type="text" name="data[<?=$field['_id'];?>]" class="form-control" id="input_<?=$field['f_name'];?>" value="<?=$value;?>" placeholder="<?=$field['name'];?>"/><?
    }else{
        ?><input type="<?=$rule_data['type']?>" name="data[<?=$field['_id'];?>]" <?=$field_attrs;?> class="form-control" id="input_<?=$field['f_name'];?>" value="<?=$value;?>" placeholder="<?=$field['name'];?>"/><?
      }
  }else if($type['datatype'] == "text"){
    if(!$rule_data){
      ?><textarea name="data[<?=$field['_id'];?>]" class="form-control" id="input_<?=$field['f_name'];?>" placeholder="<?=$field['name'];?>"><?=$value;?></textarea><?
    }else if($rule_data['type'] == "wysiwyg"){
      //wysiwyg
      ?>
      <div class="btn-toolbar" data-role="editor-toolbar" data-target="#input_<?=$field['f_name'];?>">
      					<div class="btn-group">
      						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown"
      							title="Font"><i class="fa fa-font"></i><b class="caret"></b>
      						</a>
      						<ul class="dropdown-menu">
      						</ul>
      					</div>
      					<div class="btn-group">
      						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown"
      							title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b
      							class="caret"></b>
      						</a>
      						<ul class="dropdown-menu">
      							<li><a data-edit="fontSize 5" class="fs-Five">Huge</a></li>
      							<li><a data-edit="fontSize 3" class="fs-Three">Normal</a></li>
      							<li><a data-edit="fontSize 1" class="fs-One">Small</a></li>
      						</ul>
      					</div>
      					<div class="btn-group">
      						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Text Highlight Color"><i class="fa fa-paint-brush"></i>&nbsp;<b class="caret"></b></a>
      						<ul class="dropdown-menu">
      							<p>&nbsp;&nbsp;&nbsp;Text Highlight Color:</p>
                                  <li><a data-edit="backColor #00FFFF">Blue</a></li>
                                  <li><a data-edit="backColor #00FF00">Green</a></li>
                                  <li><a data-edit="backColor #FF7F00">Orange</a></li>
                                  <li><a data-edit="backColor #FF0000">Red</a></li>
                                  <li><a data-edit="backColor #FFFF00">Yellow</a></li>
      						</ul>
      					</div>
      					<div class="btn-group">
      						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Font Color"><i class="fa fa-font"></i>&nbsp;<b class="caret"></b></a>
      						<ul class="dropdown-menu">
      							<p>&nbsp;&nbsp;&nbsp;Font Color:</p>
                                  <li><a data-edit="foreColor #000000">Black</a></li>
                                  <li><a data-edit="foreColor #0000FF">Blue</a></li>
                                  <li><a data-edit="foreColor #30AD23">Green</a></li>
                                  <li><a data-edit="foreColor #FF7F00">Orange</a></li>
                                  <li><a data-edit="foreColor #FF0000">Red</a></li>
                                  <li><a data-edit="foreColor #FFFF00">Yellow</a></li>
      						</ul>
      					</div>
      					<div class="btn-group">
      						<a class="btn btn-default" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
      						<a class="btn btn-default" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
      						<a class="btn btn-default" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
      						<a class="btn btn-default" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
      					</div>
      					<div class="btn-group">
      						<a class="btn btn-default" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
      						<a class="btn btn-default" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
      						<a class="btn btn-default" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-outdent"></i></a>
      						<a class="btn btn-default" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
      					</div>
      					<div class="btn-group">
      						<a class="btn btn-default" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
      						<a class="btn btn-default" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
      						<a class="btn btn-default" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
      						<a class="btn btn-default" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
      					</div>
      					<div class="btn-group">
      						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
      						<div class="dropdown-menu input-append">
      							<input placeholder="URL" type="text" data-edit="createLink" />
      							<button class="btn" type="button">Add</button>
      						</div>
      					</div>
      					<div class="btn-group">
      						<a class="btn btn-default" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-unlink"></i></a>
      						<span class="btn btn-default" title="Insert picture (or just drag & drop)" id="picBtn"> <i class="fa fa-picture-o"></i>
      							<input class="imgUpload" type="file" data-role="magic-overlay" data-target="#picBtn" data-edit="insertImage" />
      						</span>
      					</div>
      					<div class="btn-group">
      						<a class="btn btn-default" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
      						<a class="btn btn-default" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
      					</div>
      					<input class="pull-right voiceBtn" type="text" data-edit="inserttext" />
      				</div>
      			<div class="html" id="input_<?=$field['f_name'];?>" data-placeholder="<?=$field['name'];?>"><?=htmlspecialchars_decode($value, ENT_QUOTES);?></div>
            <input type="hidden" id="input_<?=$field['f_name'];?>_source" name="data[<?=$field['_id'];?>]" value="<?=$value;?>"/>
      			<div class="editorPreview"></div>

      			<br />

      <script type='text/javascript'>
          $(document).ready(function() {
      			$('#input_<?=$field['f_name'];?>').wysiwyg().on('change', function(){
              hidden_input = $("#"+$(this).attr('id')+"_source");
              hidden_input.val($(this).cleanHtml(true));
            });
          });
      </script>
      <?
    }
  }else if($type['datatype'] == "file"){
    if(!$rule_data){
      ?><input type="hidden" name="data[<?=$field['_id'];?>]" value="1" />
      <input type="file" name="data[<?=$field['_id'];?>]" class="form-control" id="input_<?=$field['f_name'];?>" placeholder="<?=$field['name'];?>"/><?
    }else{
      ?><input type="hidden" name="data[<?=$field['_id'];?>]" value="1" />
      <input type="file" <?=$fields_attr;?> name="data[<?=$field['_id'];?>]" class="form-control" id="input_<?=$field['f_name'];?>" placeholder="<?=$field['name'];?>"/><?
    }
    if($value){
      ?><br/><a href="./?a=remove.file&amp;id=<?=$value['_id'];?>" target="_BLANK" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> remove</a><?
    }
  }else if($type['datatype'] == "bool"){
    if(!isset($rule_data['positive_value'])){
      $rule_data['positive_value'] = "On";
    }
    if(!isset($rule_data['negative_value'])){
      $rule_data['negative_value'] = "Off";
    }
    ?>
    <div class="btn-group col-sm-12" data-toggle="buttons">
    <label class="btn btn-default <? if($value == '1'){ echo "active";}?>">
      <input type="radio" name="data[<?=$field['_id'];?>]" value="1" id="option_input_<?=$field['f_name'];?>_1" autocomplete="off" <? if($value == '1'){ echo "checked";}?>> <?=$rule_data['positive_value'];?>
    </label>
    <label class="btn btn-default <? if($value == '0' || !strlen($value)){ echo "active";}?>">
      <input type="radio" name="data[<?=$field['_id'];?>]" value="0" id="option_input_<?=$field['f_name'];?>_2" autocomplete="off" <? if($value == '0' || !strlen($value)){ echo "checked";}?>> <?=$rule_data['negative_value'];?>
    </label>
  </div>
    <?
  }
}

function wm_getContentData($item, $field = ""){
  global $db;
  $content = $db->get_assoc("select * from ".DB_TABLE_ITEMS_DATA." where _item = '".$item."' and _field = '".$field."'");
  // wm_getDbFieldForField();
  $tmp_field = wm_getDbFieldForField($field);
  $rule = getRuleOfField($field);
  if(isset($content[$tmp_field])){
    if(isset($rule['type'])){
      switch($rule['type']){
        case "set":
          $content['value'] = $content[$tmp_field];
        break;
        case "multiply_set":
          $content['value'] = $content[$tmp_field];
        break;
        case "date":
          $content['value'] = date("d.m.Y", $content[$tmp_field]);
        break;
        case "datetime":
          $content['value'] = date("d.m.Y, H:i", $content[$tmp_field]);
        break;
        default:
          if(isset($content[$tmp_field])){
            $content['value'] = $content[$tmp_field];
          }else {
            $content['value'] = "";
          }
        break;
      }
    }else{
        $content['value'] = $content[$tmp_field];
    }
  }else {
    $content['value'] = "";
  }
  return $content;
}

function wm_addContentData($data){
  global $db;
  $data['date_added'] = time();
  return $db->insert_into(DB_TABLE_ITEMS_DATA, $data);
}

function wm_editContentData($id, $data){
  global $db;
  return $db->update_table(DB_TABLE_ITEMS_DATA, $data, "_id = '".$id."'");
}

function wm_addFile($field_id){
  global $db;
  do{
    $str_id = rand_str(10);
  }while($db->get_item("select _id from ".DB_TABLE_FILES." where str_id = '".$str_id."'"));

  if (move_uploaded_file($_FILES['data']['tmp_name'][$field_id], FILES_FOLDER."/".$str_id)) {
      return $db->insert_into(DB_TABLE_FILES, array(
        "original_name"=>$_FILES['data']['name'][$field_id],
        "mime_type"=>$_FILES['data']['type'][$field_id],
        "str_id"=>$str_id
      ));
  } else {
    return 0;
  }
}

function wm_getFile($file_id){
  global $db;
  return $db->get_assoc("select * from ".DB_TABLE_FILES." where _id = '".$file_id."'");
}

function wm_removeFile($file_id){
  global $db;
  $file = wm_getFile($file_id);
  if(!$file)
    return;
  unlink(FILES_FOLDER."/".$file['str_id']);
  $db->delete_from(DB_TABLE_ITEMS_DATA, "val_file = '".$file_id."'");
  $db->delete_from(DB_TABLE_FILES, "_id = '".$file_id."'");
  return;
}

function getTypeOfField($field_id){
  global $db;
  $field = wm_getField($field_id);
  $rule = wm_getRule($field['_rule']);
  $type = wm_getType($rule['_type']);
  return $type['datatype'];
}

function getRuleOfField($field_id){
  global $db;
  $field = wm_getField($field_id);
  $rule = wm_getRule($field['_rule']);
  $rule_data = json_decode(htmlspecialchars_decode($rule['data'], ENT_QUOTES), true);

  return $rule_data;
}

function wm_getDbFieldForField($field_id){
  global $db;
  $type = getTypeOfField($field_id);
  $retField = "val_string";
  switch($type){
    case "string":
      $retField = "val_string";
    break;
    case "int":
      $retField = "val_int";
    break;
    case "float":
      $retField = "val_float";
    break;
    case "text":
      $retField = "val_text";
    break;
    case "bool":
      $retField = "val_bool";
    break;
    case "file":
      $retField = "val_file";
    break;
  }
  return $retField;
}

function wm_getFileById($id){
  global $db;

  return $db->get_assoc("select 'file' as type, original_name, mime_type, str_id from ".DB_TABLE_FILES." where _id = '".$id."'");
}

function wm_searchContent($query){
  global $db;
  $query_arr = explode(" ", mb_strtolower($query));
  $query = "+".join(" +",$query_arr);
  $items = $db->get_assocs("select * from ".DB_TABLE_ITEMS." where MATCH (s_index) AGAINST ('".$query."' IN BOOLEAN MODE)");
  return $items;
}

function wm_getContent_html($id){
  global $db;
  $item = $db->get_assoc("select _id, _set, date_added from ".DB_TABLE_ITEMS." where _id = '".$id."'");
  $set_settings = wm_getSet($item['_set']);
  $data = wm_getContent_json($id);
  $strVal = "<a href='./?a=content&amp;id=".$item['_set']."'>".$set_settings['name']."</a> &lt; <a href='./?a=edit.content&amp;set=".$item['_set']."&amp;id=".$item['_id']."'>".join(";", $data)."</a>";
  return $strVal;
}

function wm_getContent_json($id, $fields = array()){
  global $db;

  $item = $db->get_assoc("select _id, _set, date_added from ".DB_TABLE_ITEMS." where _id = '".$id."'");
  $set_settings = wm_getSet($item['_set']);

  $plain_fields = array();
  foreach($fields as $k=>$v){
    $plain_fields[] = $v['_id'];
  }

  $itemVal = array();
  if(sizeof($plain_fields)){
    $elements = $db->get_assocs("select * from ".DB_TABLE_ITEMS_DATA." where _item = ".$item['_id']." and _field in (".join(",", $plain_fields).") order by _id asc");
  }else{
    $elements = $db->get_assocs("select * from ".DB_TABLE_ITEMS_DATA." where _item = ".$item['_id']." order by _id asc");
  }
  foreach($elements as $k=>$elem){
    $field = wm_getField($elem['_field']);
    $tmp_field = wm_getDbFieldForField($elem['_field']);
    $rule = getRuleOfField($elem['_field']);
    $type = getTypeOfField($elem['_field']);

    $value = "";
    if(isset($elem[$tmp_field])){
      if(isset($rule['type'])){
        switch($rule['type']){
          case "set":
            $value = "";
            if($elem[$tmp_field]){
              $value = wm_getContent_json($elem[$tmp_field]);
            }
          break;
          case "multiply_set":
            $value = array();
            $tmp_ids = explode(",",$elem[$tmp_field]);
            foreach($tmp_ids as $tmp_id){
              $value[] = wm_getContent_json($tmp_id);
            }
          break;
          case "date":
            $value = date("d.m.Y", $elem[$tmp_field]);
          break;
          case "datetime":
            $value = date("d.m.Y, H:i", $elem[$tmp_field]);
          break;
          default:
            $value = $elem[$tmp_field];
          break;
        }
      }else if($type == "file"){
        $value = wm_getFileById($elem[$tmp_field]);
      }else{
        $value = $elem[$tmp_field];
      }
    }
    $itemVal[$field['f_name']] = $value;

  }
  return $itemVal;
}

function wm_listContent_json($set, $page = -1, $count = -1, $fields = array()){
  global $db;

  if($count == -1){
    $count = DB_SELECT_COUNT;
  }
  $set_settings = wm_getSet($set);

  $plain_fields = array();
  foreach($fields as $k=>$v){
    $plain_fields[] = $v['_id'];
  }
  if($set_settings['sort_by'] != 0){
    $sort_field = wm_getDbFieldForField($set_settings['sort_by']);
    if($page == -1){
      $items = $db->get_assocs("select d._item as _id, i.date_added date_added from ".DB_TABLE_ITEMS_DATA." d left join ".DB_TABLE_ITEMS." i on i._id = d._item where d._field = ".$set_settings['sort_by']." and d._set = ".$set_settings['_id']." order by d.".$sort_field." ".$set_settings['sort_order']);
    }else{
      $offset = $page * $count;
      $items = $db->get_assocs("select d._item as _id, i.date_added date_added from ".DB_TABLE_ITEMS_DATA." d left join ".DB_TABLE_ITEMS." i on i._id = d._item where d._field = ".$set_settings['sort_by']." and d._set = ".$set_settings['_id']." order by d.".$sort_field." ".$set_settings['sort_order']." limit ".$offset.", ".$count);
    }
  }else{
    if($page == -1){
      $items = $db->get_assocs("select _id, date_added from ".DB_TABLE_ITEMS." where _set = ".$set_settings['_id']." order by date_added ".$set_settings['sort_order']);
    }else{
      $offset = $page * $count;
      $items = $db->get_assocs("select _id, date_added from ".DB_TABLE_ITEMS." where _set = ".$set_settings['_id']." order by date_added ".$set_settings['sort_order']." limit ".$offset.", ".$count);
    }
  }

  $retVal = array();
  foreach($items as $key=>$item){
    $item_detail = wm_getSet($item['_id']);
    $itemVal = array();
    if(sizeof($plain_fields)){
      $elements = $db->get_assocs("select * from ".DB_TABLE_ITEMS_DATA." where _item = ".$item['_id']." and _field in (".join(",", $plain_fields).") order by _id asc");
    }else{
      $elements = $db->get_assocs("select * from ".DB_TABLE_ITEMS_DATA." where _item = ".$item['_id']." order by _id asc");
    }
    foreach($elements as $k=>$elem){
      $field = wm_getField($elem['_field']);
      $tmp_field = wm_getDbFieldForField($elem['_field']);
      $rule = getRuleOfField($elem['_field']);
      $type = getTypeOfField($elem['_field']);

      $value = "";
      if(isset($elem[$tmp_field])){
        if(isset($rule['type'])){
          switch($rule['type']){
            case "set":
              $value = "";
              if($elem[$tmp_field]){
                $value = wm_getContent_json($elem[$tmp_field]);
              }
            break;
            case "multiply_set":
              $value = array();
              $tmp_ids = explode(",",$elem[$tmp_field]);
              // var_dump($tmp_ids);
              foreach($tmp_ids as $tmp_id){
                $value[] = wm_getContent_json($tmp_id);
              }
            break;
            case "date":
              $value = date("d.m.Y", $elem[$tmp_field]);
            break;
            case "datetime":
              $value = date("d.m.Y, H:i", $elem[$tmp_field]);
            break;
            default:
              $value = $elem[$tmp_field];
            break;
          }
        }else if($type == "file"){
          $value = wm_getFileById($elem[$tmp_field]);
        }else{
          $value = $elem[$tmp_field];
        }
      }
      $itemVal[$field['f_name']] = $value;

    }
    $retVal[] = $itemVal;

  }
  return $retVal;
}

function wm_listContent($set, $page = -1, $fields = array()){
  global $db;

  $set_settings = wm_getSet($set);

  $plain_fields = array();
  foreach($fields as $k=>$v){
    $plain_fields[] = $v['_id'];
  }
  if($set_settings['sort_by'] != 0){
    $sort_field = wm_getDbFieldForField($set_settings['sort_by']);
    if($page == -1){
      $items = $db->get_assocs("select d._item as _id, i.date_added date_added from ".DB_TABLE_ITEMS_DATA." d left join ".DB_TABLE_ITEMS." i on i._id = d._item where d._field = ".$set_settings['sort_by']." and d._set = ".$set_settings['_id']." order by d.".$sort_field." ".$set_settings['sort_order']);
    }else{
      $offset = $page * DB_SELECT_COUNT;
      $items = $db->get_assocs("select d._item as _id, i.date_added date_added from ".DB_TABLE_ITEMS_DATA." d left join ".DB_TABLE_ITEMS." i on i._id = d._item where d._field = ".$set_settings['sort_by']." and d._set = ".$set_settings['_id']." order by d.".$sort_field." ".$set_settings['sort_order']." limit ".$offset.", ".DB_SELECT_COUNT);
    }
  }else{
    if($page == -1){
      $items = $db->get_assocs("select _id, date_added from ".DB_TABLE_ITEMS." where _set = ".$set_settings['_id']." order by date_added ".$set_settings['sort_order']);
    }else{
      $offset = $page * DB_SELECT_COUNT;
      $items = $db->get_assocs("select _id, date_added from ".DB_TABLE_ITEMS." where _set = ".$set_settings['_id']." order by date_added ".$set_settings['sort_order']." limit ".$offset.", ".DB_SELECT_COUNT);
    }
  }

  foreach($items as $key=>$item){
    if(sizeof($plain_fields)){
      $elements = $db->get_assocs("select * from ".DB_TABLE_ITEMS_DATA." where _item = ".$item['_id']." and _field in (".join(",", $plain_fields).") order by _id asc");
    }else{
      $elements = $db->get_assocs("select * from ".DB_TABLE_ITEMS_DATA." where _item = ".$item['_id']." order by _id asc");
    }
    foreach($elements as $k=>$elem){
      $tmp_field = wm_getDbFieldForField($elem['_field']);
      $rule = getRuleOfField($elem['_field']);
      $value = "";
      if(isset($elem[$tmp_field])){
        if(isset($rule['type'])){
          switch($rule['type']){
            case "date":
              $elements[$k]['value'] = date("d.m.Y", $elem[$tmp_field]);
            break;
            case "datetime":
              $elements[$k]['value'] = date("d.m.Y, H:i", $elem[$tmp_field]);
            break;
            default:
              $elements[$k]['value'] = $elem[$tmp_field];
            break;
          }
        }else{
          $elements[$k]['value'] = $elem[$tmp_field];
        }
      }else{
        $elements[$k]['value'] = $value;
      }
    }
    $items[$key]['elements'] = $elements;

  }
  return $items;
}

function wm_getContent($id){
  global $db;
  return $db->get_assoc("select * from ".DB_TABLE_ITEMS." where _id = '".$id."'");
}


function wm_addContent($data = array()){
  global $db;
  $data['date_added'] = time();
  return $db->insert_into(DB_TABLE_ITEMS, $data);
}

function wm_editContent($id, $data = array()){
  global $db;
  return $db->update_table(DB_TABLE_ITEMS, $data, "_id = '".$id."'");
}

function wm_removeContent($id){
  global $db;
  return $db->delete_from(DB_TABLE_ITEMS_DATA, "_item = '".$id."'");
  return $db->delete_from(DB_TABLE_ITEMS, "_id = '".$id."'");
}

function wm_listSets($page = -1){ // -1 = all
  global $db;
  if($page == -1){
    return $db->get_assocs("select * from ".DB_TABLE_SETS." where 1 order by _id desc");
  }
  $offset = $page * DB_SELECT_COUNT;
  return $db->get_assocs("select * from ".DB_TABLE_SETS." where 1 order by _id desc limit ".$offset.", ".DB_SELECT_COUNT);
}
function wm_getSet($id){
  global $db;
  return $db->get_assoc("select * from ".DB_TABLE_SETS." where _id = '".$id."'");
}
function wm_addSet($data = array()){
  global $db;
  $data['date_added'] = time();
  return $db->insert_into(DB_TABLE_SETS, $data);
}
function wm_editSet($id, $data = array()){
  global $db;
  return $db->update_table(DB_TABLE_SETS, $data, "_id = '".$id."'");
}
function wm_removeSet($id){
  global $db;
  return $db->delete_from(DB_TABLE_SETS, "_id = '".$id."'");
}

function wm_listTemplates($page = -1){ // -1 = all
  global $db;
  if($page == -1){
    return $db->get_assocs("select * from ".DB_TABLE_TEMPLATES." where 1 order by _id desc");
  }
  $offset = $page * DB_SELECT_COUNT;
  return $db->get_assocs("select * from ".DB_TABLE_TEMPLATES." where 1 order by _id desc limit ".$offset.", ".DB_SELECT_COUNT);
}
function wm_getTemplate($id){
  global $db;
  return $db->get_assoc("select * from ".DB_TABLE_TEMPLATES." where _id = '".$id."'");
}
function wm_addTemplate($data = array()){
  global $db;
  $data['date_added'] = time();
  return $db->insert_into(DB_TABLE_TEMPLATES, $data);
}
function wm_editTemplate($id, $data = array()){
  global $db;
  return $db->update_table(DB_TABLE_TEMPLATES, $data, "_id = '".$id."'");
}
function wm_removeTemplate($id){
  global $db;
  return $db->delete_from(DB_TABLE_TEMPLATES, "_id = '".$id."'");
}

function wm_listTemplatesFields($template_id = 0, $page = -1, $in_list = false){ // -1 = all
  global $db;
  $sql_add = "";
  if($in_list){
    $sql_add = " and f._show_in_list = 1 ";
  }
  if($page == -1){
    return $db->get_assocs("select f.* from ".DB_TABLE_LINKS_TEMPLATES_FIELDS." l left join ".DB_TABLE_FIELDS." f on f._id = l._field where l._template = '".$template_id."' ".$sql_add." order by position asc");
  }
  $offset = $page * DB_SELECT_COUNT;
  return $db->get_assocs("select f.* from ".DB_TABLE_LINKS_TEMPLATES_FIELDS." l left join ".DB_TABLE_FIELDS." f on f._id = l._field where l._template = '".$template_id."' ".$sql_add." order by position asc ".$offset.", ".DB_SELECT_COUNT);
}
function wm_getTemplateField($id){
  global $db;
  return $db->get_assoc("select * from ".DB_TABLE_LINKS_TEMPLATES_FIELDS." where _id = '".$id."'");
}
function wm_addTemplateField($data = array()){
  global $db;
  $data['date_added'] = time();
  return $db->insert_into(DB_TABLE_LINKS_TEMPLATES_FIELDS, $data);
}
function wm_editTemplateField($id, $data = array()){
  global $db;
  return $db->update_table(DB_TABLE_LINKS_TEMPLATES_FIELDS, $data, "_id = '".$id."'");
}
function wm_removeTemplateField($id){
  global $db;
  return $db->delete_from(DB_TABLE_LINKS_TEMPLATES_FIELDS, "_id = '".$id."'");
}
function wm_removeTemplateFields($id){
  global $db;
  return $db->delete_from(DB_TABLE_LINKS_TEMPLATES_FIELDS, "_template = '".$id."'");
}
function wm_listFields($page = -1){ // -1 = all
  global $db;
  if($page == -1){
    return $db->get_assocs("select * from ".DB_TABLE_FIELDS." where 1 order by _id desc");
  }
  $offset = $page * DB_SELECT_COUNT;
  return $db->get_assocs("select * from ".DB_TABLE_FIELDS." where 1 order by _id desc limit ".$offset.", ".DB_SELECT_COUNT);
}
function wm_getField($id){
  global $db;
  return $db->get_assoc("select * from ".DB_TABLE_FIELDS." where _id = '".$id."'");
}
function wm_addField($data = array()){
  global $db;
  $data['date_added'] = time();
  return $db->insert_into(DB_TABLE_FIELDS, $data);
}
function wm_editField($id, $data = array()){
  global $db;
  return $db->update_table(DB_TABLE_FIELDS, $data, "_id = '".$id."'");
}
function wm_removeField($id){
  global $db;
  return $db->delete_from(DB_TABLE_FIELDS, "_id = '".$id."'");
}

function wm_listRules($page = -1){ // -1 = all
  global $db;
  if($page == -1){
    return $db->get_assocs("select * from ".DB_TABLE_RULES." where 1 order by _id desc");
  }
  $offset = $page * DB_SELECT_COUNT;
  return $db->get_assocs("select * from ".DB_TABLE_RULES." where 1 order by _id desc limit ".$offset.", ".DB_SELECT_COUNT);
}
function wm_getRule($id){
  global $db;
  return $db->get_assoc("select * from ".DB_TABLE_RULES." where _id = '".$id."'");
}
function wm_addRule($data = array()){
  global $db;
  $data['date_added'] = time();
  return $db->insert_into(DB_TABLE_RULES, $data);
}
function wm_editRule($id, $data = array()){
  global $db;
  return $db->update_table(DB_TABLE_RULES, $data, "_id = '".$id."'");
}
function wm_removeRule($id){
  global $db;
  return $db->delete_from(DB_TABLE_RULES, "_id = '".$id."'");
}

function wm_listTypes($page = -1){ // -1 = all
  global $db;
  if($page == -1){
    return $db->get_assocs("select * from ".DB_TABLE_TYPES." where 1 order by _id desc");
  }
  $offset = $page * DB_SELECT_COUNT;
  return $db->get_assocs("select * from ".DB_TABLE_TYPES." where 1 order by _id desc limit ".$offset.", ".DB_SELECT_COUNT);
}
function wm_getType($id){
  global $db;
  return $db->get_assoc("select * from ".DB_TABLE_TYPES." where _id = '".$id."'");
}
function wm_addType($data = array()){
  global $db;
  $data['date_added'] = time();
  return $db->insert_into(DB_TABLE_TYPES, $data);
}
function wm_editType($id, $data = array()){
  global $db;
  return $db->update_table(DB_TABLE_TYPES, $data, "_id = '".$id."'");
}
function wm_removeType($id){
  global $db;
  return $db->delete_from(DB_TABLE_TYPES, "_id = '".$id."'");
}

function wm_list($table, $page = -1){ // -1 = all
  global $db;
  if($page == -1){
    return $db->get_assocs("select * from ".$table." where 1 order by _id desc");
  }
  $offset = $page * DB_SELECT_COUNT;
  return $db->get_assocs("select * from ".$table." where 1 order by _id desc limit ".$offset.", ".DB_SELECT_COUNT);
}
function wm_add($table, $data = array()){
  global $db;
  $data['date_added'] = time();
  return $db->insert_into($table, $data);
}
function wm_edit($table, $id, $data = array()){
  global $db;
  return $db->update_table($table, $data, "_id = '".$id."'");
}
function wm_remove($table, $id){
  global $db;
  return $db->delete_from($table, "_id = '".$id."'");
}

?>
