﻿<?php
header("content-type:text/html;charset=utf-8");
include 'header.php';
include 'inc/system.inc.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">人员管理</li>
              <li><a href="createuser.php">新建用户</a></li>
              <li class="active"><a href="userlist.php">用户列表</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

<div class="btn-toolbar">
    <a class="btn btn-primary" href="createuser.php" >新 建</a>
    <button class="btn">导 入</button>
    <button class="btn">导出</button>
</div>
END;

echo <<<END
		
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>姓名</th>
          <th>性别</th>
          <th>手机号码</th>
		  <th>密码</th>
          <th>备注</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
END;

$sql=" select name,mobile,password,remark,gender from user ORDER BY id asc ";
$rs=$executeobj->ExecSQL($sql,$pdo);
$name="";
if($rs)
{ 
	for($i=0;$i<count($rs);$i++)
	{ 
		
		$name=$rs[$i]['name'];
		$mobile=$rs[$i]['mobile'];
		$password=$rs[$i]['password'];
		$remark=$rs[$i]['remark'];
		if($rs[$i]['gender']=="1")
			{$gender="男";}
		else
			{$gender="女";}
		
		    echo <<<END
<tr>
<td>$name</td>
<td>$gender</td>
<td>$mobile</td>
<td>$password</td>
<td>$remark</td>
<td>
<a href="edituser.php?mobile=$mobile"><i class="icon-pencil"></i></a>
<a href="deleteuser.php?mobile=$mobile"><i class="icon-remove"></i></a>
<!--<a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>-->
</td>
</tr>
END;
	}
}



echo <<<END

      </tbody>
    </table>
</div>
<div class="pagination">
    <ul>
        <li><a href="#">Prev</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">Next</a></li>
    </ul>
</div>
<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">确认</h3>
    </div>
    <div class="modal-body">
        <p class="error-text">您确认删除这个用户吗?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button class="btn btn-danger" data-dismiss="modal">删除</button>
    </div>
</div>

END;

include 'bottom.php';
?>