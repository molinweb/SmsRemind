<?php
class MyMemcached{
	var $cache;
	function MyMemcached(){	
		$this->cache=new Memcache;
		$this->cache->addserver("localhost", 11211);
	}
	//写数据。
	function set($key,$value,$expiration){
		$key=md5($key);				
		return $this->cache->set($key,$value,0,$expiration);
	}
	//取数据。
	function get($key){
		$key=md5($key);		
		return $this->cache->get($key);
	}
	//删除数据。
	function delete($key){		
		$this->cache->delete($key);
	}
}
?>