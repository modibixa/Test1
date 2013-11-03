<?php

for($i = 0; $i < 4000; $i++)
{
echo $i . "  "; // extra spaces
}
// keeps it flowing to the browser�
flush();
// 50000 microseconds keeps things flowing in safari, IE, firefox, etc
usleep(5000);

?>