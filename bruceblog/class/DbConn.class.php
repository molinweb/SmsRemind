<?php
class DbConn
{  //使用pdo扩展连接数据库
	var $dbtype='mysql';
	var  $dbhost='localhost';
	var $dbname='smsremind';
	var $dbuser='root';
	var $dbpwd='root';
	var $dsn='$dbtype:host=$dbhost;dbname=$dbName';

	public function ConnDb()
	{
		try
		{ 
		$conn=new PDO($this->dsn,$this->dbuser,$this->dbpwd);
		$conn->query("set names 'utf-8'");
		return $conn;
		}
			catch(PDOException $ex){
			die("Database Error:".$ex->getMessage()."<br />");
		}
	}

}

class ExecuteSQL{
	function ExecSQL($sql, $conn){
		$sqltype=strtolower(substr(trim($sql),0,6));
		$rs=$conn->prepare($sql);
		$rs->execute();
		if($sqltype=="select"){
			$array=$rs->fetchAll(PDO::FETCH_ASSOC);
			if(count($array)==0 || $rs==false)
				return false;
			else
				return $array;
		}elseif($sqltype=="update" || $sqltype=="insert" || $sqltype=="delete"){
			if($rs)
				return true;
			else
				return false;
		}
	}
}







?>
