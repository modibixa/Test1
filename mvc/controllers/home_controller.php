<?php
#include "models/home_model.php"; 
class Home_Controller 
{
	public $model; 
	public $action = "index";
	public function  __construct($act) 
	{
		//$this->index();
	}
	
	public function invoke($act) 
	{ 
		$this->index();
	}

	public function index() 
	{
		include "views/home.php";
	} 
}
?>
