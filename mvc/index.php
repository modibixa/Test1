<?php
$c = $_GET["controller"]? $_GET["controller"] : "home"; 
$act = $_GET["action"];
include "controllers/".$c."_controller.php"; 
$c = $c."_controller"; 
$controller = new $c($act); 
$controller->invoke($act); 
?>