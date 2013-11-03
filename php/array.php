<?php
$users=array(	array("name"=>"Peter","age"=>"37","sex"=>"male"),
			array("name"=>"Ben","age"=>"43","sex"=>"female"),
			array("name"=>"Joe","age"=>"32","sex"=>"male"));
foreach($users as $x=>$x_value)
{
	$users[$x]['adrress'] = array('adr1'=>'Da Nang', 'adr2'=>'Quang Tri');
	//$x_value['adrress'] = array('adr1'=>'Da Nang', 'adr2'=>'Quang Tri');
	echo "Key=" . $x . "<br/>"; echo "Value="; var_dump($users[$x]);
	//echo "Key=" . $x . "<br/>"; echo "Value="; var_dump($x_value);
	echo "<br><br>";
}
echo "<pre>";	print_r($users);
?>