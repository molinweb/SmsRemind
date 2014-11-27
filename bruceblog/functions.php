<?php // Example 21-1: functions.php

function destroySession()
{
    $_SESSION=array();
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $var;
}

function redirect($url)
{
	echo "<script type=text/javascript>window.location.href='$url';</script>";
}
function is_mobile($mobile)
{return true;}



?>
