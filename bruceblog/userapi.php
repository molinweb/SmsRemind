<?php
echo json_encode(
		array(
				"value" => $_REQUEST["value"],
				"valid" => preg_match("/^[A-Z].*$/", $_REQUEST["value"]),
				"message" => urlencode(iconv('gb2312','utf-8','±ØÐëÊÇ´óÐ´×ÖÄ¸')) 
		)
);

?>