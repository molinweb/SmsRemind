<?php
include 'header.php';
header("Content-Type:text/html;charset=utf-8"); 
echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">人员管理</li>
              <li class="active"><a href="createuser.php">新建档案</a></li>
              <li><a href="userlist.php">人员列表</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

END;

echo <<<END

		<div class="well">
		<h3>欢迎您！系统正在建设中。。。</h3>
		</div>

END;

include 'bottom.php';
?>