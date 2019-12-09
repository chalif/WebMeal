<?php
@session_name("WebMeal");
@session_start();

ini_set('session.gc_maxlifetime', 3600*24*30);
ini_set('session.cookie_lifetime', 3600*24*30);

include("./config.inc.php");

include("./functions.inc.php");
include("./users.functions.inc.php");
include("./content.functions.inc.php");

include("./mysqli.db.class.php");

$db = new database();
$db->clear_parms = 1;
$db->name = "WebMeal";
$db->utf = true;
$db->debug = 0;
$db->connect();

if(!user_check_active()){
  if(isset($_POST['a'])){
    if($_POST['a'] == 'login'){
      include("./actions/post/login.inc.php");
    }
  }
  include("./actions/get/login.inc.php");
  die();
}

if(isset($_GET['ax'])){
  if(isset($_GET['callback'])){
    echo $_GET['callback']."(";
  }
  if(file_exists("./actions/ax/".$_GET['ax'].".inc.php")){
    include("./actions/ax/".$_GET['ax'].".inc.php");
  }else{
    echo "<h1>Controller ax/".$_GET['ax']." not found</h1>";
  }
  if(isset($_GET['callback'])){
    echo ")";
  }
}else if(isset($_POST['a'])){
  if(file_exists("./actions/post/".$_POST['a'].".inc.php")){
    include("./actions/post/".$_POST['a'].".inc.php");
  }else{
    echo "<h1>Controller post/".$_POST['a']." not found</h1>";
  }
}else if(isset($_GET['a'])){
  if(file_exists("./actions/get/".$_GET['a'].".inc.php")){
    include("./actions/get/".$_GET['a'].".inc.php");
  }else{
    echo "<h1>Controller get/".$_GET['a']." not found</h1>";
  }
}else{
  go_to("./?a=index");
}
