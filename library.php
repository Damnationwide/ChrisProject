<?php
function readValue($x)
{
	if(isset($_GET[$x])) $value=$_GET[$x];
	else $value=null;
	return $value;
}
/*
function isInteger($x)
{
	if (ctype_digit(strval($x))) return true;
	else return false;
}
*/

function isNumber($x)
{
	if ($x==null|| $x==""|| trim($x)==" ") return false;
	else if(filter_var($x, FILTER_VALIDATE_FLOAT)) return true;
	else return false;
}

function isInteger($x)
{
	if ($x==null|| $x==""|| trim($x)==" ") return false;
	else if(filter_var($x, FILTER_VALIDATE_INT)) return true;
	else return false;
}
?>
