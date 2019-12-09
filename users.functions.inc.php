<?php
function user_login($login, $pass){
	global $db;

	$user_id = $db->get_item("select _id from ".DB_TABLE_USERS." where login = '".$login."' and pass = '".md5(SALT.$pass)."' and _disabled = '0' limit 1");
	if(!$user_id)
		return;

	$_SESSION['wm_session'] = $db->get_assoc("select u._id _id, u.name name, u._group group_id, g.name group_name, g._access group_access from ".DB_TABLE_USERS." u left join ".DB_TABLE_USERS_GROUPS." g on g._id = u._group where u._id = ".$user_id." limit 1");
	return;
}

function user_check_active(){
	global $db;
	if(isset($_SESSION['wm_session'])){
		$user_id = $db->get_item("select _id from ".DB_TABLE_USERS." where _id = ".$_SESSION['wm_session']['_id']." and _disabled = '0' limit 1");
		if($user_id){
			return true;
		}
		unset($_SESSION['wm_session']);
	}
	return false;
}

function user_set_access($access){
	if(user_getAccess() < $access){
		header('HTTP/1.0 403 Forbidden');
		die();
	}
}

function user_getAccess(){
	return $_SESSION['wm_session']['group_access'];
}

function user_logout(){
	unset($_SESSION['wm_session']);
	return;
}

function user_listGroups($page = -1){ // -1 = all
  global $db;
  if($page == -1){
    return $db->get_assocs("select * from ".DB_TABLE_USERS_GROUPS." where 1 order by _id desc");
  }
  $offset = $page * DB_SELECT_COUNT;
  return $db->get_assocs("select * from ".DB_TABLE_USERS_GROUPS." where 1 order by _id desc limit ".$offset.", ".DB_SELECT_COUNT);
}
function user_getGroup($id){
	global $db;
	return $db->get_assoc("select * from ".DB_TABLE_USERS_GROUPS." where _id = '".$id."'");
}

function user_addGroup($data = array()){
	global $db;
	return $db->insert_into(DB_TABLE_USERS_GROUPS, $data);
}
function user_editGroup($id, $data = array()){
	global $db;
	return $db->update_table(DB_TABLE_USERS_GROUPS, $data, "_id = '".$id."'");
}
function user_removeGroup($id){
	global $db;
	$db->update_table(DB_TABLE_USERS, array("_group"=>1), "_group = '".$id."'");
	return $db->delete_from(DB_TABLE_USERS_GROUPS, "_id = '".$id."'");
}

function user_listUsers($page = -1){ // -1 = all
  global $db;
  if($page == -1){
    return $db->get_assocs("select * from ".DB_TABLE_USERS." where 1 order by _id desc");
  }
  $offset = $page * DB_SELECT_COUNT;
  return $db->get_assocs("select * from ".DB_TABLE_USERS." where 1 order by _id desc limit ".$offset.", ".DB_SELECT_COUNT);
}

function user_getUser($id){
	global $db;
	return $db->get_assoc("select * from ".DB_TABLE_USERS." where _id = '".$id."'");
}

function user_addUser($data = array()){
	global $db;
	$data['date_added'] = time();
	return $db->insert_into(DB_TABLE_USERS, $data);
}
function user_editUser($id, $data = array()){
	global $db;
	return $db->update_table(DB_TABLE_USERS, $data, "_id = '".$id."'");
}
function user_removeUser($id){
	global $db;
	return $db->delete_from(DB_TABLE_USERS, "_id = '".$id."'");
}
?>
