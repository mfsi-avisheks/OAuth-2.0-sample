<?php
require_once('config/config.php');
if(!isset($_GET['access_token'])&&isset($_GET['code'])){
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	//step 2
	//getting the access_token
	$url="https://accounts.google.com/o/oauth2/token?";
	$query="code=".$_GET['code'];
	$query.="&client_id=".CLIENT_ID;
	$query.="&client_secret=".CLIENT_SECRET;
	$query.='&redirect_uri='.CALL_BACK;
	$query.='&grant_type=authorization_code';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);		
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);            
	
	$result=curl_exec($ch);		
	echo $curl_err = curl_error($ch);
	curl_close($ch);

	$result=json_decode($result,true);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	//calling the google apis
	//getting the profile info
	//step 3
	$url="https://www.googleapis.com/oauth2/v1/userinfo";
	$access_token = $result['access_token'];
	$token_type = $result['token_type'];	
		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);		
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: ". $token_type ." " . $access_token));
	curl_setopt($ch, CURLOPT_HEADER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);            
	
	$result=curl_exec($ch);		
	echo $curl_err = curl_error($ch);
	curl_close($ch);
		
	$result=json_decode($result,true);
?>
	<center>
	<h1>Profile Info</h1>
	<table border=1>
		<? 
			foreach ($result as $key => $value) {
				echo("<tr>");
				echo("<td>".ucwords($key)."</td>");
				echo("<td>");
					if($key=='picture'){
						echo("<img src='".$value."'>");
					}else{
						echo($value);
					}
				echo("</td>");
				echo("</tr>");
			}
		?>
	</table>
	</center>
<?
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
}else{
	echo "ohh!!! you refused the connection :(";
}
