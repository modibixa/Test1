<?php
include "models/book_model.php"; 
class Book_Controller 
{
	public $model; 
	public $action = "lists";
    public function  __construct($act) 
    {
    	 $this->action = $act; 
       $this->model = new Book_Model();
    } 

	public function invoke($act) 
	{ 
		switch($act)
		{
		   case "view" : {
		       $id = $_GET["action"] || 0; 
		       $this->view($id);
		   } break;  
		   case "lists": 
		          $this->lists();break; 
		    default: 
		          $this->lists();
		} 
	} 

	public function lists() 
	{
		$listBooks = $this->model->getListBooks(); 
		include "views/booklist.php";
	} 

	public function view($id) 
	{ 
	   $bookView = $this->model->getBook($id); 
	   include "views/bookview.php"; 
	}
}
?>
