<?php
include 'functions.php';
include 'inc/system.inc.php';


$username =$error= "";

echo "<script> if(confirm( '确认删除？'));else location.href='userlist.php' </script>"; 


if(isset($_GET['mobile']))
{
	$mobile = sanitizeString ( $_GET['mobile'] );
	





	if ($mobile== "") {
		$error = "";
	} else {
		$query = " delete from user where account = '$username'";
		$sql=" delete from user where mobile = '$mobile' ";
		$rs=$executeobj->ExecSQL($sql,$pdo);
		if ($rs) {
			$error = "成功！";
			echo <<<END
			<script type="text/javascript">
	{
	alert('删除成功');
	}
</script>
END;
redirect('userlist.php');
		} else {
			$error = "删除失败！";
		}
		
		
	}
}

?>