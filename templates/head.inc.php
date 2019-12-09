<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title><?=@$page['title'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"-->
   <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->
   <link href="./css/animate.css" rel="stylesheet">
   <link href="./css/custom-style.css" rel="stylesheet">
   <link href="./css/style.css" rel="stylesheet">
   <link href="./css/font-awesome.min.css" rel="stylesheet">
   <link href="./css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
   <link href="./css/bootstrap-quick-search.min.css" rel="stylesheet">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <script src="./js/script.js"></script>
   <script src="./js/jquery.hotkeys.js"></script>
   <script src="./js/bootstrap-wysiwyg.js"></script>
   <script type="text/javascript" src="./js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
   <script type="text/javascript" src="./js/locales/bootstrap-datetimepicker.ru.js" charset="UTF-8"></script>
   <script src="./js/bootstrap-quick-search.min.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
  <div id="top-nav" class="navbar navbar-inverse navbar-static-top top-bar">
      <div class="container-fluid">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="./">WebMeal</a>
          </div>

          <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['wm_session']['name'];?> <b class="caret"></b></a>
                <ul class="dropdown-menu animated fadeInUp">
                  <li><a href="./?a=logout">Выйти</a></li>
                </ul>
              </li>
            </ul>
          </nav>
      </div>
      <!-- /container -->
  </div>
  <!-- /Header -->

  <!-- Main -->
  <div class="container-fluid">
      <div class="row">
          <div class="col-xs-3 sidebar">
              <? if(user_getAccess() >= 3){ ?>
              <strong><i class="glyphicon glyphicon-wrench"></i>&nbsp;Настройки</strong>
              <hr>
              <ul class="nav nav-stacked collapse in" id="settingsMenu">
                <li><a href="./?a=list.sets"><i class="fa fa-archive" aria-hidden="true"></i>&nbsp;Наборы</a></li>
                <li><a href="./?a=list.templates"><i class="fa fa-building" aria-hidden="true"></i>&nbsp;Шаблоны</a></li>
                <li><a href="./?a=list.fields"><i class="glyphicon glyphicon-th"></i>&nbsp;Поля</a></li>
                <li><a href="./?a=list.rules"><i class="glyphicon glyphicon-magnet"></i>&nbsp;Правила</a></li>
                <li><a href="./?a=list.types"><i class="glyphicon glyphicon-align-justify"></i>&nbsp;Типы</a></li>
              </ul>
              <hr>
            <? } ?>
            <? if(user_getAccess() >= 2){ ?>
              <strong><i class="fa fa-key" aria-hidden="true"></i>&nbsp;Управление пользователями</strong>
              <hr>
              <ul class="nav nav-stacked collapse in" id="settingsMenu">
                <li><a href="./?a=list.users"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Пользователи</a></li>
                <? if(user_getAccess() >= 3){ ?>
                <li><a href="./?a=list.groups"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;Группы</a></li>
                <? } ?>
              </ul>
              <hr>
            <? } ?>
            <? if(user_getAccess() >= 1){ ?>
              <strong><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;Контент</strong>
              <hr>
              <ul class="nav nav-stacked collapse in" id="contentMenu">
              <?php
                $sets = wm_listSets();
                foreach($sets as $k=>$v){
                  ?><li><a href="./?a=content&amp;id=<?=$v['_id'];?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;<?=$v['name'];?></a></li><?
                }
              ?>
              </ul>
            <? } ?>
          </div>
          <div class="col-xs-9 content">
