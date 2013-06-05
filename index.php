<?php
require_once('config/config.php');
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//asking for authorization
	//step 1
	$url="https://accounts.google.com/o/oauth2/auth?";
	$url.="client_id=".CLIENT_ID;	
	$url.="&response_type=code";
	$url.='&redirect_uri='.CALL_BACK;	
	$url.='&scope='.SCOPE;
	header("location:".$url);
	exit();
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


