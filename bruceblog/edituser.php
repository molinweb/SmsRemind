﻿<?php
include 'header.php';
include 'inc/system.inc.php';
echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">用户管理</li>
              <li class="active"><a href="createuser.php">新建用户</a></li>
              <li><a href="userlist.php">用户列表</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
END;

$name = $password = $mobile = $gender=$remark=$error=$sql= "";

if (isset($_POST['username']))
 {
	$username = sanitizeString ( $_POST ['username'] );
	$password = sanitizeString ( $_POST ['password'] );
	$email = sanitizeString ( $_POST ['email'] );
	$status = sanitizeString ( $_POST ['status'] );
	$remark = sanitizeString ( $_POST ['remark'] );
	
	
	if ($username == "" || $password == "" || $status == "")
		$error = "存在字段不能为空";
	else {
		queryMysql ( "update user set password = '$password',email='$email',status='$status',remark ='$remark' where account='$username' " );
		$error = "用户修改成功";
			//redirect('userlist.php');
	}
}
else
{
	if(isset($_GET['mobile']))
	{
		$mobile=$_GET['mobile'];
	
		if ($mobile == "") {
			$error = "";
		} else {
			$sql = " select name,mobile,password,gender,remark  from user where mobile = '$mobile'";
			$rs=$executeobj->ExecSQL($sql,$pdo);
			
			if ($rs)
			{
				$name = stripslashes($rs[0]['name']);
				$gender=stripcslashes($rs[0]['gender']);
				$password = stripslashes($rs[0]['password']);
				$mobile =  stripslashes($rs[0]['mobile']);
				$remark= stripslashes($rs[0]['remark']);
			}
		else $error = "查询不到该用户！";
	
		}
	}
}
		
		
echo <<<END
<div class="well">
<form class="form-horizontal" action='edituser.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">修改用户</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="name">姓名</label>
      <div class="controls">
        <input type="text" id="username" name="name" value="$name" placeholder="" class="input-xlarge" >
        <p class="help-block"></p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">密码</label>
      <div class="controls">
        <input type="password" id="password" name="password" value="$password" placeholder="" class="input-xlarge" required>
        <p class="help-block">请输入密码</p>
      </div>
    </div>
 
	    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="mobile">邮箱</label>
      <div class="controls">
        <input id="mobile" name="mobile" value="$mobile" placeholder="" class="input-xlarge" type="email">
        <p class="help-block">请输入手机号</p>
      </div>
    </div>

    <div class="control-group">
		  <label class="control-label" for="gender" >状态</label>
          <div class="controls">
            <select id="gender" name="gender" class="input-xlarge">
              <option value="1">男</option>
              <option value="0">女</option>	
            </select>
          </div>
	</div>
		
   <div class="control-group">
      <!-- remark -->
      <label class="control-label"  for="remark">备注</label>
	  <div class="controls">
        <textarea rows="4" class="" id="remark" name="remark" value="$remark" placeholder="" > </textarea>
		<p class="help-block">请输入备注信息</p>
      </div>
    </div>
		
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">保  存</button> &nbsp;&nbsp;
        <a class="btn" href='userlist.php'>返 回</a>
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>