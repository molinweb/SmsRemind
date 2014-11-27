<?php
class GetFldValue{
	private $table;
	private $field;
	private $where;
	private $pdo;
	private $executeobj;
	function GetFldValue($table,$field,$where,$pdo,$executeobj){
		$this->table=$table;
		$this->field=$field;
		$this->where=$where;
		$this->pdo=$pdo;
		$this->executeobj=$executeobj;
	}
	function ReturnRs(){
		$sql="select ".$this->field." from ".$this->table." where ".$this->where;
		$rs=$this->executeobj->ExecSQL($sql,$this->pdo);
		return $rs;
	}
}
?>