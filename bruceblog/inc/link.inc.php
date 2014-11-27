<?php
$conn=new ConnDB($dbtype, $host, $user, $pwd, $dbname);
$pdo=$conn->ConnObj();
$executeobj=new ExecuteSQL();
?>