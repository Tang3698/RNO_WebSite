
<?php

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

$conn=new PDO('mysql:localhost;port=3306;dbname=test;','Test','1234');

if (!$conn){
	die('The database can\'t be connected :'.$conn->erroCode());
}

$query1="SELECT * FROM test.site_info";
$all_sites=$conn->prepare($query1);
$all_sites->execute();

$result=$all_sites->fetchAll(PDO::FETCH_ASSOC);


$site_json=json_encode($result);

echo $site_json;

?> 