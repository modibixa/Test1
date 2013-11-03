<?php 
 //Gets the IP address 
 $ip = getenv("REMOTE_ADDR") ; 
 Echo "<br/>Your IP is " . $ip; 
 ?> 
 <?php 
 //Gets the document root 
 $root = getenv("DOCUMENT_ROOT") ; 
 Echo '<br/>'.$root; 
 ?> 
 <?php 
 //Gets the server admin's email
 $ad = getenv("SERVER_ADMIN") ; 
 Echo '<br/>'.$ad; 
 ?> 