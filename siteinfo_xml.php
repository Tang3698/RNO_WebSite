<?php
//Database connection


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
$num_row=$all_sites->rowcount();
$result=$all_sites->fetchAll(PDO::FETCH_ASSOC);


header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<sites>';

// Iterate through the rows, printing XML nodes for each
for ($row=0;$row<$num_row;$row++){
  // Add to XML document node
  echo '<site ';
  echo 'ID="' . parseToXML($result[$row]['ID']) . '" ';
  echo 'site_name="' . parseToXML($result[$row]['site_name']) . '" ';
  echo 'region="' . parseToXML($result[$row]['region']) . '" ';
  echo 'site_type="' . parseToXML($result[$row]['site_type']) . '" ';
  echo 'longitude="' . $result[$row]['longitude'] . '" ';
  echo 'latitude="' . $result[$row]['latitude'] . '" ';
  echo '/>';
}

// End XML file 
echo '</sites>';



?>