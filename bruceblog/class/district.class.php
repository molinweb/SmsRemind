<?php
/*
$area=new District($areaid, $executeobj, $pdo);
$myarea=$area->getList();
*/
class District{
	var $areaid;	//传入地区ID。
	var $rs;    //传入记录集对象。
	var $pdo;	//传入数据库连接对象。
	function District($areaid,$rs,$pdo)
	{
		$this->areaid=$areaid;
		$this->rs=$rs;
		$this->pdo=$pdo;
	}
	
	function getList()
	{
		$list="";
		$id=$this->areaid;
		while($id>0)
		{
			$sql="select * from district where id=".$id;
			$obj=$this->rs->ExecSQL($sql, $this->pdo);
			if($obj)
			{
				$id=$obj[0]['a_up'];
				if($id==0)
				{
					$list=$obj[0]['a_name'].$list;
				}
				else
				{
					$list=" &gt;&gt; ".$obj[0]['a_name'].$list;
				}
			}
		}
		return $list;
	}
}
?>