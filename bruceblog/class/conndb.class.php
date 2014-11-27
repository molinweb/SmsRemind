<?php
//连接数据库类。
class ConnDB{
	var $dbtype;
	var $host;
	var $user;
	var $pwd;
	var $dbname;
	//构造方法。
	function ConnDB($dbtype, $host, $user, $pwd, $dbname){
		$this->dbtype=$dbtype;
		$this->host=$host;
		$this->user=$user;
		$this->pwd=$pwd;
		$this->dbname=$dbname;
	}
	//实现数据库的连接并返回连接对象。
	function ConnObj(){
		if($this->dbtype=="mysql" || $this->dbtype=="mssql"){
			$dsn="$this->dbtype:host=$this->host;dbname=$this->dbname";	
		}else{
			$dsn="$this->dbtype:dbname=$this->dbname";
		}
		try{
			$conn=new PDO($dsn, $this->user, $this->pwd);
			$conn->query("set names utf8");
			return $conn;
		}catch(PDOException $ex){
			die("Database Error:".$ex->getMessage()."<br />");
		}
	}
}

//数据库操作类。
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