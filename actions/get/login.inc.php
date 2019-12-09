<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Ауфторизация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
     <!-- Latest compiled and minified JavaScript -->
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

  <div class="container">
      <div class="row">
        <div class="col-sm-3"></div>
      <form class="form-signin col-sm-6" method="POST">
        <input type="hidden" name="a" value="login"/>
        <h2 class="form-signin-heading">Выполните проникновение</h2>
        <label for="inputLogin" class="sr-only">Логин</label>
        <input type="text" name="login" id="inputLogin" class="form-control" placeholder="Логин" required autofocus>
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Пароль" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
      </form>
      <div class="col-sm-3"></div>
    </div>
    </div> <!-- /container -->
  </body>
</html>
