<?php

class Book_Model 
{ 
	public  $dataTemp = array( 
		1 => array( 
			"title" => "Yii framerk", 
			"description" => "Yii framework description", 
			"price" => 45.5 
		), 
		2 => array( 
			"title" => "javascript ahead", 
			"description" => "javascript ahead description", 
			"price" => 15.8 
		), 
		3 => array( 
			"title" => "PHP Beginner", 
			"descrition" => "PHP Beginner description", 
			"price" => 55.55 
		) 
	); 
	public function  __construct() 
	{
		
	} 
	public function getListBooks() 
	{ 
		return $this->dataTemp; 
	} 
	public function getBook($id) 
	{ 
			  return $this->dataTemp[$id]; 
	} 
}  
?>
