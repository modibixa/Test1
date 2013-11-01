<?php
while($row = mysqli_fetch_array($listRegisters))
{
?>
  <a href="index.php?controller=register&action=view&id=<?php echo $row['id'];?>"> <?php echo $row['f_name'] . " " . $row['l_name'];?></a><br/>
<?php
}
?>
