<?php
$database= mysqli_connect("localhost","pregqqha_bee","sdp18beehive", "pregqqha_readings") or die ("could not connect to mysql"); 
$getdelay = "SELECT * from delay WHERE name='readings'";
$result3 = mysqli_query($database,$getdelay)or die(mysqli_error($database));
$rows3= mysqli_fetch_array($result3);
$delay = $rows3['length'];
echo $delay;
?>