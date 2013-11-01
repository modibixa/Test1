<html> 
<head><title>Book List</title></head> 
<body> 
    <table> 
        <tr> 
			<td>Title</td> 
			<td>Decscription</td> 
			<td>Price</td> 
			</tr> 
<?php  
	foreach ($listBooks as $key => $book) 
	{ 	
	    echo '<tr> 
				<td><a href="index.php?controller=book&action=view&id='.$key.'">'.$book["title"].'</a></td>
				<td>'.$book["description"].'</td>
				<td>'.$book["price"].'</td> 
			 </tr>'; 
	}
?> 
    </table> 
</body> 
</html> 
