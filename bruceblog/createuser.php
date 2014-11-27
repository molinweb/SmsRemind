<?php
header("content-type:text/html; charset=utf-8");
include 'header.php';
include 'inc/system.inc.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">人员管理</li>
              <li class="active"><a href="createuser.php">新建用户</a></li>
              <li><a href="userlist.php">人员列表</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
END;

$name = $password = $mobile = $gender=$remark=$error=$sql= "";

if (isset ( $_POST ['mobile'] ) && isset ( $_POST ['password']) && is_mobile($_POST['mobile']))
 {
	$name = sanitizeString ( $_POST ['name'] );
	$password = sanitizeString ( $_POST ['password'] );
	$mobile=sanitizeString($_POST['mobile']);
	$gender=$_POST['gender'];
	$remark=sanitizeString($_POST['remark']);

	if ($name == "" || $password == "" || $mobile == "")
		$error = "存在字段不能为空";
	else {
		if ( $executeobj->ExecSQL("SELECT * FROM user WHERE mobile='$mobile'", $pdo))
			$error = "手机号已被注册过";
		else {
			 $sql="INSERT INTO user(name,mobile,password,gender,remark) VALUES('$name', '$mobile','$password','$gender','$remark')" ;
			if($executeobj->ExecSQL($sql,$pdo))
			{
			$error = "用户创建成功";
			redirect('userlist.php');
			}	
		else
			{$error="用户创建失败";}
		}
	}
}
		
		
echo <<<END
<div class="well">
<form class="form-horizontal" action='createuser.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">创建用户</legend>
    </div>
        <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="name">姓名</label>
      <div class="controls">
        <input type="text" id="name" name="name" value="$name" placeholder="" class="input-xlarge"  required>
        <p class="help-block">请输入人员姓名</p>
      </div>
    </div>
    <div class="control-group">
      <!-- name -->
      <label class="control-label"  for="mobile">手机号码</label>
      <div class="controls">
        <input type="text" id="mobile" name="mobile" value="$mobile" placeholder="" class="input-xlarge"  required>
        <p class="help-block">请输入手机号码，手机号将作为在微网站登陆账号</p>
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
		  <label class="control-label" for="gender" >性别</label>
          <div class="controls">
            <select id="gender" name="gender" class="input-xlarge">
              <option value="0">男</option>
              <option value="1">女</option>
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
       
      </div>
    </div>
  </fieldset>
  <div class="alert alert-warning" role="alert">$error</div>
</form>
</div>

END;

include 'bottom.php';
?>