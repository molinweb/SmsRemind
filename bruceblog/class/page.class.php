<?php
/****************
使用方法：

****************/
class PageClass{
	var $table;
	var $fields;
	var $where;
	var $orderby;
	var $orderdirect;
	var $pagesize;
	var $page;
	public $recordcount;
	public $pagecount;
	//var $sql;
	var $rs;
	var $conn;
	//构造方法。
	function PageClass($table, $fields, $where, $orderby, $orderdirect, $pagesize, $page, $rs, $conn)
	{
		$this->table=$table;
		$this->fields=$fields;
		$this->where=$where;
		$this->orderby=$orderby;
		$this->orderdirect=$orderdirect;
		$this->pagesize=$pagesize;
		$this->page=$page;
		$this->rs=$rs;
		$this->conn=$conn;
		
		//$this->sql="select $fields from $table where $where order by $orderby $orderdirect limit $page-1,$pagesize";
	}
	//返回数据集。
	function RsArray(){
		$sql="select ".$this->fields." from ".$this->table." where ".$this->where." order by ".$this->orderby." ".$this->orderdirect." limit ".($this->page-1)*($this->pagesize).", ".$this->pagesize;
		$myarray=$this->rs->ExecSQL($sql, $this->conn);
		return $myarray;
	}
	
	function PageCount(){
		$query="select count(*) as num from ".$this->table." where ".$this->where;
		$myarray=$this->rs->ExecSQL($query, $this->conn);		
		$this->recordcount = $myarray[0]['num'];
		$this->pagecount = ceil($this->recordcount/$this->pagesize);//记录条数/每页条数
	}
	
	//返回页码列表。
	function PageList($url, $targetpage){
		$adjacents = 3;
		$query="select count(*) as num from ".$this->table." where ".$this->where;
		$myarray=$this->rs->ExecSQL($query, $this->conn);
		
		$total_pages = $myarray[0]['num'];

		if($url != ""){
			$url = "&".preg_replace('/page=\d+/','',$url);
			$url = str_replace("&&","&",$url);
		}
		
		/* Setup vars for query. */
		//$targetpage = $_SERVER['SCRIPT_NAME']; 	//your file name  (the name of this file)
		//$limit = 1; 	
		$limit=$this->pagesize;							//how many items to show per page
		$page = $this->page;
		if(isset($page)) 
			$start = ($page - 1) * $limit; 			//first item to display on this page
		else
			$start = 0;								//if no page var is given, set start to 0
		
		/* Get data. */
		//$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
		//$result = mysql_query($sql,$link) or die(mysql_error());
		
		/* Setup page vars for display. */
		$limit=$this->pagesize;
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<a href=\"$targetpage?page=$prev$url\">上一页</a>";
			else
				$pagination.= "<span class=\"disabled\">首页</span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter$url\">$counter</a>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage?page=$counter$url\">$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage?page=$lpm1$url\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage?page=$lastpage$url\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"$targetpage?page=1$url\">1</a>";
					$pagination.= "<a href=\"$targetpage?page=2$url\">2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage?page=$counter$url\">$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage?page=$lpm1$url\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage?page=$lastpage$url\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"$targetpage?page=1$url\">1</a>";
					$pagination.= "<a href=\"$targetpage?page=2$url\">2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage?page=$counter$url\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=\"$targetpage?page=$next$url\">下一页</a>";
			else
				$pagination.= "<span class=\"disabled\">尾页</span>";
			$pagination.= "</div>\n";		
		}
		return $pagination;
		//return "kkkkk".$pagination.$total_pages.$limit.$lastpage;
	}
}
?>