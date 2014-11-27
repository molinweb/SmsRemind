<?php
header("content-type:text/html;charset=utf-8");//设置头 编码方式为utf-8
require_once("inc/system.inc.php");
session_start ();
include 'functions.php';
header("Content-Type:text/html;   charset=utf-8"); 
echo <<<END

<!DOCTYPE html>
<html lang="zh">
  <head>
    <title>短信提醒管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta http-equiv="Content-Type" content="text/html; charset="utf-8" />

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
	<link href="css/login.css" rel="stylesheet" type="text/css" />

	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

	

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
  
END;

$error = $user = $pass = "";
	

if (isset ( $_POST ['user'] )) {
	$user = sanitizeString ( $_POST ['user'] );
	$pass = sanitizeString ( $_POST ['pass'] );
	
	if ($user == "" || $pass == "") {
		$error = "<div class='alert alert-warning' role='alert'>请输入账号密码</div>";
	} else {
		$query = "select * from admin where username = '$user' and password = '$pass' ";
		
		if (!$executeobj->ExecSQL($query, $pdo)) {
			$error = "<div class='alert alert-danger' role='alert'>账号或密码错误</div>";
		} else {
			$_SESSION ['user'] = $user;
			$_SESSION ['pass'] = $pass;
			
			redirect('welcome.php');
		}
	}
}

echo <<<END
    <div class="container">
      <form class="form-signin" method='post' action='login.php'>
        <h2 class="form-signin-heading">短信提醒管理平台</h2>
		       账号 <input type="text"  name='user' value=''  class="input-block-level" placeholder="请输入账号">
		       密码 <input type="password"  name='pass' value=''  class="input-block-level" placeholder="密码">
        <button class="btn btn-large btn-primary" type="submit">登&nbsp;&nbsp;陆</button> &nbsp;&nbsp; $error
       </form>

    </div> <!-- /container -->

    <!-- Le javascript================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>

  </body>
</html>
END;

?>