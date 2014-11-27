<?php
function GetIP(){
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
	  $cip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
	  $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif(!empty($_SERVER["REMOTE_ADDR"])){
	  $cip = $_SERVER["REMOTE_ADDR"];
	}
	else{
	  $cip = "无法获取！";
	}
	return $cip;
}

//计算date1比date2大多少天,其格式均为2008-08-09 14:05:10。
function DateDiff($date1,$date2){
	$Date_1=explode(" ",$date1);
	$Date_2=explode(" ",$date2);
	$Date_List_a1=explode("-",$Date_1[0]);
	$Date_List_a2=explode("-",$Date_2[0]);
	$d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
	$d2=mktime(0,0,0,$Date_List_a2[1],$Date_List_a2[2],$Date_List_a2[0]);
	$Days=round(($d1-$d2)/3600/24);
	return $Days;
}
?>