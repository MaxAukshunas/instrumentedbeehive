<!DOCTYPE html>
<?php

	//session_start(); // start the session
	$database= mysqli_connect("localhost","pregqqha_bee","sdp18beehive", "pregqqha_readings") or die ("could not connect to mysql"); 
	if (!$database) {
    	echo "failed to connect";
	}

	$result = mysqli_query($database,"SHOW TABLES");
	$result2 = mysqli_query($database,"SHOW TABLES");
	$result3 = mysqli_query($database,"SHOW TABLES");
	$result4 = mysqli_query($database,"SHOW TABLES");
	$result5 = mysqli_query($database,"SHOW TABLES");
	$result6 = mysqli_query($database,"SHOW TABLES");
	$result7 = mysqli_query($database,"SHOW TABLES");
	$result8 = mysqli_query($database,"SHOW TABLES");
	$result9 = mysqli_query($database,"SHOW TABLES");
	
	// get current battery levels
	$getcurrentbatt = "SELECT * from battery WHERE status='current'";
    $result = mysqli_query($database,$getcurrentbatt)or die(mysqli_error($database));
    $rows = mysqli_fetch_array($result);
    $currentbattlevel = $rows['level'];


    $sensor_names = array(
        
        "sensor0" => "Sensor 0",
        "sensor1" => "Sensor 1",
        "sensor2" => "Sensor 2",
        "sensor3" => "Sensor 3",
        "sensor4" => "Sensor 4",
        "sensor5" => "Sensor 5",
        "waterproof" => "Outside",
        "dht_temp" => "Housing Temp",
        "dht_hum" => "Housing Hum",
        
    );
    
    $sensor_array = array(
	        0 => $value0,
	        1 => $value1,
	        2 => $value2,
	        3 => $value3,
	        4 => $value4,
	        5 => $value5,
	        6 => $waterproof,
	        7 => $dht_temp,
	        8 => $dht_hum,
	);
    
    $sensor_tables = array(
	        0 => "sensor0",
	        1 => "sensor1",
	        2 => "sensor2",
	        3 => "sensor3",
	        4 => "sensor4",
	        5 => "sensor5",
	        6 => "waterproof",
	        7 => "dht_temp",
	        8 => "dht_hum",
	    );


?>

<!-- FRAME & SENSOR SELECTOR -->
 <head><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chart Configuration - Instrumented Beehive</title>
  <link rel="shortcut icon" href="http://instrumentedbeehive.website/favicon.ico?v=2"/>
  <link rel="apple-touch-icon" href="apple-touch-icon.png" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<div class="header">
  <img src="images/bee.png" alt="logo" href="http://instrumentedbeehive.website"/>
  <!--<h1>Instrumented Beehive</h1>-->
</div>
<br>
  <style>
  .header img {
  float: middle;
  width: 100px;
  height: 100px;
  margin-left:600px;
}
body {
    background-color: 	#FFFF99;
}

.header h1 {
    font-family: "Segoe UI";
	font-size: 24px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
	line-height: 26.4px;
  position: relative;
  top: 18px;
  left: 10px;
}
h3 {
    font-family: "Segoe UI";
	font-size: 24px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
	line-height: 26.4px;
  position: relative;
  margin-top: -300px;
  left: 10px;
}
h4 {
    font-family: "Segoe UI";
	font-size: 24px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
	line-height: 26.4px;
	float: middle;
	position: relative;
  top: 50px;
  left: -285px;
}
h4#batterylevels {
    font-family: "Segoe UI";
	font-size: 24px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
	line-height: 26.4px;
	display: inline-block;
	position: relative;
  top: 50px;
  left: -785px;
}
div#battery:after {
    background-color: #000;
    border: 2px solid #000;
    content: "";
    display: block;
    height: 16px;
    position: absolute;
    right: -6px;
    top: 6px;
    width: 6px;
}
div#battery {
    border: 2px solid #000;
    height: 32px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    width: 100px;
    margin-top:300px;
    margin-left:750px;
}
div#battery-level {
    width: 0%;
    height: 100%;
    text-align: center;
    display:inline-block;
    top: 8px;
    left: 16px;
    margin-top:5px;
    margin-left:-115px;
    margin-right:100px;
    font-family: "Segoe UI";
}
span#select-result{
    display: none;
height:0px 
line-height: 0px;
font-size: 0px;
}
input[type=text]#datepicker {
    border: 3px solid #555;
    width: 20%;
    display: inline;
    padding: 12px 10px;
    margin: 15px 0px;
    margin-left: 10px;
    box-sizing: border-box;
    font-family: "Segoe UI";
	font-size: 15px;
	background-image: url('calendar-3xx.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding-left: 40px;
    margin-top: -200px;
}
input[type=text]#datepicker2 {
    border: 3px solid #555;
    width: 20%;
    display: inline;
    padding: 12px 10px;
    margin: -5px 0px;
    margin-left: 10px;
    box-sizing: border-box;
    font-family: "Segoe UI";
	font-size: 15px;
	background-image: url('calendar-3xx.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding-left: 40px;
    margin-top: -200px;
}
input[type=text]#newnum {
    border: 3px solid #555;
    width: 20%;
    display: inline;
    padding: 12px 10px;
    margin: -5px 0px;
    margin-left: 430px;
    box-sizing: border-box;
    float: middle;
    font-family: "Segoe UI";
	font-size: 15px;
	background-image: url('cellphone2.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding-left: 40px;
}
select#statusdd {
    border: 3px solid #555;
    width: 7%;
    display: inline;
    padding: 12px 3px;
    margin: 0px 0px;
    margin-left: 10px;
    box-sizing: border-box;
    float: middle;
    font-family: "Segoe UI";
	font-size: 15px;
    padding-left: 7px;
}
input[type=text]#delay1 {
    border: 3px solid #555;
    width: 20%;
    display: inline;
    padding: 12px 10px;
    margin: -5px 0px;
    margin-left: 430px;
    box-sizing: border-box;
    float: middle;
    font-family: "Segoe UI";
	font-size: 15px;
	background-image: url('clock2.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding-left: 40px;
}
input[type=text]#batterylevel1 {
    border: 3px solid #555;
    width: 12%;
    display: inline;
    padding: 12px 10px;
    margin: -5px 0px;
    margin-left: 430px;
    box-sizing: border-box;
    float: middle;
    font-family: "Segoe UI";
	font-size: 15px;
	background-image: url('battery.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding-left: 40px;
}
input[type=text]#alert1 {
    border: 3px solid #555;
    width: 12%;
    display: inline;
    padding: 12px 10px;
    margin: -5px 0px;
    margin-left: 430px;
    box-sizing: border-box;
    float: middle;
    font-family: "Segoe UI";
	font-size: 15px;
	background-image: url('thermometer.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding-left: 40px;
}
input[type=button] {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    background-color: #000000;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    margin-left: 10px;
    margin-top: -20px;
    font-family: "Segoe UI";
    font-style: normal;
	font-variant: normal;
	font-weight: 500;
    cursor: pointer;
     margin-top: -200px;
}
input[type=button]#longer {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    background-color: #000000;
    border: none;
    color: white;
    padding: 15px 43px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    margin-left: 10px;
    font-family: "Segoe UI";
    font-style: normal;
	font-variant: normal;
	font-weight: 500;
    cursor: pointer;
}
input[type=button]:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    background-color: #262626;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    margin-left: 10px;
    margin-top: -20px;
    font-family: "Segoe UI";
    font-style: normal;
	font-variant: normal;
	font-weight: 500;
    cursor: pointer;
}


  #feedback { font-size: 1.4em; }
  #selectable .ui-selecting { background: #FECA40; }
  #selectable .ui-selected { background: #F39814; color: white; }
  #selectable { list-style-type: none; margin: 0; padding: 0; width: 630px; float: left; margin-left:220px; border-radius: 25px; padding: 20px; border: 4px solid #000000; background-color: #FFFF66;}
  #selectable li { margin: 3px; padding: 1px; width: 140px; height: 140px; font-size: 1em; height: 90px; text-align: center; border-radius: 25px; display: inline-block; border: 2px solid #000000; font-family: "Segoe UI"; font-size: 15px;} 
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


  
  

 <script>
  $( function() {
    var text = "";
    $(".ui-state-default").click( function() {
    $(this).toggleClass("ui-selected");
    text = text + " " + $(this).index();
    $("#select-result").text(text);
  } );
   

  } );
  </script>
  
  
<p id="feedback">
<span style="visibility: hidden" id="select-result"></span>
</p>

</head>
<body>

<ol id="selectable">
    <?php for($i=0;$i<9;$i++){
            date_default_timezone_set("America/New_York");
            $now = new DateTime();
            $now = date_format($now, 'Y-m-d H:i:s');
            $totaltime = 0;
            $getcurrval= "SELECT * from $sensor_tables[$i] order by date_time desc";
            $currvalresult = mysqli_query($database,$getcurrval)or die(mysqli_error($database));
            $row = mysqli_fetch_array($currvalresult);
            $currval = $row['value'];
            $lastupdated = $row['date_time'];
            $lastupdateddt = date_create($lastupdated);
            $lastupdateddt = date_format($lastupdateddt,"Y-m-d H:i:s");
            $datetime1 = new DateTime($now);
            $datetime2 = new DateTime($lastupdateddt);
            $interval = $datetime1->diff($datetime2);
            $totaltime += intval($interval->i);
            $totaltime += intval($interval->h)*60;
            $totaltime += intval($interval->d)*1440;
            if($currval>=75 && $currval <= 77){
            $background="#74DE76";
            }
            else if($currval>77){
            $background="#FF6868";
            }
            else if($currval<75){
            $background="#e0e0eb";
            }
            ?>
            <li class="ui-state-default" style="background-color:<?php echo $background?>;"><strong><?php echo $sensor_names[$sensor_tables[$i]];?></strong><br></br><? if($sensor_names[$sensor_tables[$i]]!="Housing Hum") echo $currval . "°F"; else echo $currval . "%";?><br><small><?php echo $totaltime . " minutes ago";?></small></li>
    <?php
    }?>
</ol>

<?php 

if($currentbattlevel>=75){
    $background2 ="#05d931";
}
if($currentbattlevel<75 && $currentbattlevel>=50){
    $background2 ="#d0cf01";
}
if($currentbattlevel<50 && $currentbattlevel>=25){
    $background2 ="#ff7401";
}
if($currentbattlevel<25){
    $background2 ="#f50b0c";
}

?>
 
<div id="battery" style="background-color:<?php echo $background2?>;"><div id="battery-level"><?php echo number_format($currentbattlevel,1) . "%"; ?></div></div>
</body>
<!--<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>-->


 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      altField: "#alternate",
      altFormat: "DD, d MM, yy"
    });
  } );
  </script>
  <script>
  $( function() {
    $( "#datepicker2" ).datepicker({
      altField: "#alternate2",
      altFormat: "DD, d MM, yy"
    });
  } );
  </script>

<h3> Choose Time Period</h3>
<form id="config" name="customizer" action="/outputData.php" method=POST style="display">
    <input type="text" id="datepicker" value="Start Date" >&nbsp;<input type="text" id="alternate" style="visibility: hidden" name="datepicker" size="0">
    <input type="text" id="datepicker2" value="End Date" >&nbsp;<input type="text" id="alternate2" style="visibility: hidden" name="datepicker2" size="30">
    <input type="text" id="select" style="visibility: hidden" name="result" size="30" value="This is hidden">
    <!--<input type="hidden" name="a" id="select-result" value="hello" />-->
    <select style="visibility: hidden" name="chosen_sensor" id="dropdown1">
		<option selected="sensor">Choose sensor</option>
		<?php 
		while($tables = mysqli_fetch_array($result)){
		        if($tables[0]!="number"&&$tables[0]!="alerts"){
		?>
		<option value="<?php echo $tables[0];?>"><?php echo $tables[0];?></option>
		<?php
		}
		}
		?>
	</select>
	<select style="display: none;" name="chosen_sensor2" id="dropdown2">
		<option selected="sensor2">Choose sensor</option>
		<?php 
		while($tables2 = mysqli_fetch_array($result2)){
		        if($tables2[0]!="number"&&$tables2[0]!="alerts"){
		?>
		<option value="<?php echo $tables2[0];?>"><?php echo $tables2[0];?></option>
		<?php
		}
		}
		?>
	</select>
	<select style="display: none;" name="chosen_sensor3" id="dropdown3">
		<option selected="sensor3">Choose sensor</option>
		<?php 
		while($tables3 = mysqli_fetch_array($result3)){
		    if($tables3[0]!="number"&&$tables3[0]!="alerts"){
		?>
		<option value="<?php echo $tables3[0];?>"><?php echo $tables3[0];?></option>
		<?php
		}
		}
		?>
	</select>
	<select style="display: none;" name="chosen_sensor4" id="dropdown4">
		<option selected="sensor4">Choose sensor</option>
		<?php 
		while($tables4 = mysqli_fetch_array($result4)){
		    if($tables4[0]!="number"&&$tables4[0]!="alerts"){
		?>
		<option value="<?php echo $tables4[0];?>"><?php echo $tables4[0];?></option>
		<?php
		}
		}
		?>
	</select>
	<select style="display: none;" name="chosen_sensor5" id="dropdown5">
		<option selected="sensor5">Choose sensor</option>
		<?php 
		while($tables5 = mysqli_fetch_array($result5)){
		    if($tables5[0]!="number"&&$tables5[0]!="alerts"){
		?>
		<option value="<?php echo $tables5[0];?>"><?php echo $tables5[0];?></option>
		<?php
		}
		}
		?>
	</select>
	<select style="display: none;" name="chosen_sensor6" id="dropdown6">
		<option selected="sensor6">Choose sensor</option>
		<?php 
		while($tables6 = mysqli_fetch_array($result6)){
		    if($tables6[0]!="number"&&$tables6[0]!="alerts"){
		?>
		<option value="<?php echo $tables6[0];?>"><?php echo $tables6[0];?></option>
		<?php
		}
		}
		?>
	</select>
	<select style="display: none;" name="chosen_sensor7" id="dropdown7">
		<option selected="sensor7">Choose sensor</option>
		<?php 
		while($tables7 = mysqli_fetch_array($result7)){
		    if($tables7[0]!="number"&&$tables7[0]!="alerts"){
		?>
		<option value="<?php echo $tables7[0];?>"><?php echo $tables7[0];?></option>
		<?php
		}
		}
		?>
	</select>
	<select style="display: none;" name="chosen_sensor8" id="dropdown8">
		<option selected="sensor8">Choose sensor</option>
		<?php 
		while($tables8 = mysqli_fetch_array($result8)){
		    if($tables8[0]!="number"&&$tables8[0]!="alerts"){
		?>
		<option value="<?php echo $tables8[0];?>"><?php echo $tables8[0];?></option>
		<?php
		}
		}
		?>
	</select>
	<select style="display: none;" name="chosen_sensor9" id="dropdown9">
		<option selected="sensor9">Choose sensor</option>
		<?php 
		while($tables9 = mysqli_fetch_array($result9)){
		    if($tables9[0]!="number"&&$tables9[0]!="alerts"){
		?>
		<option value="<?php echo $tables9[0];?>"><?php echo $tables9[0];?></option>
		<?php
		}
		}
		?>
	</select>
    <input type="button" onclick="myFunction()" value="Display Graph">
</form>

    <button onclick="toggleDropdown()" id="more_sensors" style="visibility: hidden"></button></button>
    
    <script>
        function toggleDropdown() {
            var data_table2 = document.getElementById("dropdown2");
            var data_table3 = document.getElementById("dropdown3");
            var data_table4 = document.getElementById("dropdown4");
            var data_table5 = document.getElementById("dropdown5");
            var data_table6 = document.getElementById("dropdown6");
            var data_table7 = document.getElementById("dropdown7");
            var data_table8 = document.getElementById("dropdown8");
            var data_table9 = document.getElementById("dropdown9");
            var button = document.getElementById("more_sensors");
            if (data_table2.style.display === "none") {
                data_table2.style.display = "inline-block";
            } 
            else if (data_table3.style.display === "none") {
                data_table3.style.display = "inline-block";
            }
            else if (data_table4.style.display === "none") {
                data_table4.style.display = "inline-block";
            }
            else if (data_table5.style.display === "none") {
                data_table5.style.display = "inline-block";
            }
            else if (data_table6.style.display === "none") {
                data_table6.style.display = "inline-block";
            }
            else if (data_table7.style.display === "none") {
                data_table7.style.display = "inline-block";
            }
            else if (data_table8.style.display === "none") {
                data_table8.style.display = "inline-block";
            }
            else if (data_table9.style.display === "none") {
                data_table9.style.display = "inline-block";
                button.style.display = "none";
            }
        }
    </script>


<script>
function myFunction() {
    var first_date = document.getElementById("alternate").value;
    var second_date = document.getElementById("alternate2").value;
    var first_dropdown = document.getElementById("dropdown1").value;
    var val = document.getElementById("select-result").innerHTML;
    if(first_date.length>10 && second_date.length>10 && val.length>0){
        document.customizer.result.value = val;
        document.getElementById("config").submit();
    }
    else{
        returnToPreviousPage();
    }
}
</script>

<br><br><br>
<h4> My Settings</h4>
<br><br>

<?php

	
    $getcurrentnumber = "SELECT * from number WHERE beekeeper='default'";
    $result = mysqli_query($database,$getcurrentnumber)or die(mysqli_error($database));
    $rows = mysqli_fetch_array($result);
    $currentnumber = $rows['phonenumber'];
?>


<form id="numberchangeform" action="twilio.php" method="POST">

<p><input type="text" name = "number" id="newnum" size = "30" placeholder="<?php echo $currentnumber; ?>"/><input type="button" onclick="changeNumber()" value="Update Number"></p>


</form>


<script>
    function changeNumber(){
        var newnum = document.getElementById("newnum").value;
        if(newnum.length==10){
            document.getElementById("numberchangeform").submit();
        }
        else{
            returnToPreviousPage();
        }
    }
</script>

<!-- CHANGE DELAY -->
<br>
<?php
$database= mysqli_connect("localhost","pregqqha_bee","sdp18beehive", "pregqqha_readings") or die ("could not connect to mysql"); 
$getdelay = "SELECT * from delay WHERE name='readings'";
$result3 = mysqli_query($database,$getdelay)or die(mysqli_error($database));
$rows3= mysqli_fetch_array($result3);
$delay = $rows3['length'];
?>


<form id="changedelay" action="delay.php" method="POST">

<p><input style="inline-block" type="text" name = "delay" id="delay1" size="10" placeholder="<?php echo $delay . " minutes"; ?>"/><input id="longer" type="button" onclick="changeDelay()" value="Update Delay">
</p>

</form>


<script>
    function changeDelay(){
        var newnum = document.getElementById("delay1").value;
        if(newnum.length>0){
            document.getElementById("changedelay").submit();
        }
        else{
            returnToPreviousPage();
        }
    }
</script>

<?php  $getmoveavg = "SELECT * from alerts WHERE name='movingaverage1hr'";
    $result = mysqli_query($database,$getmoveavg)or die(mysqli_error($database));
    $rows= mysqli_fetch_array($result);
    $movingaveragethreshold = $rows['threshold'];
    
    $getstatus = "SELECT * from alerts WHERE name='movingaverage1hr'";
    $result2 = mysqli_query($database,$getstatus)or die(mysqli_error($database));
    $rows2= mysqli_fetch_array($result2);
    $status = $rows2['status'];
?>
<br>

<form id="changealerts1" action="twilio.php" method="POST">

<p><input style="inline-block" type="text" name = "movingaverage" id="alert1" size="10" placeholder="<?php echo $movingaveragethreshold . " F"; ?>"/><select style="inline-block" name="status" id="statusdd">Status
		<option selected="statusdd"><?php echo $status;?></option>
        <?php if($status=="On"){?>
		<option value="Off">Off</option>
		<?php }
		else if($status=="Off"){?> <option value="On">On</option>
		<?php }?>
		</select>

<input id="longer" type="button" onclick="changeAlert()" value="Update Alert">
</p>

</form>


<script>
    function changeAlert(){
        var newnum = document.getElementById("alert1").value;
        var status = document.getElementById("statusdd").value;
        if(newnum.length>0 || status!='undefined'){
            document.getElementById("changealerts1").submit();
        }
        else{
            returnToPreviousPage();
        }
    }
</script>

<!-- CHANGE BATTERY ALERT -->
<?php  $getcurrbatt = "SELECT * from alerts WHERE name='batterylevel'";
    $result = mysqli_query($database,$getcurrbatt)or die(mysqli_error($database));
    $rows= mysqli_fetch_array($result);
    $battlevel = $rows['threshold'];
    
    $getstatus = "SELECT * from alerts WHERE name='batterylevel'";
    $result2 = mysqli_query($database,$getstatus)or die(mysqli_error($database));
    $rows2= mysqli_fetch_array($result2);
    $battstatus = $rows2['status'];
?>
<br>

<form id="changebatteryalert" action="twilio.php" method="POST">

<p><input style="inline-block" type="text" name = "batterylevel" id="batterylevel1" size="10" placeholder="<?php echo $battlevel . "%"; ?>"/><select style="inline-block" name="status2" id="statusdd">Status
		<option selected="statusdd"><?php echo $battstatus;?></option>
        <?php if($battstatus=="On"){?>
		<option value="Off">Off</option>
		<?php }
		else if($battstatus=="Off"){?> <option value="On">On</option>
		<?php }?>
		</select>

<input id="longer" type="button" onclick="changeBatteryAlert()" value="Update Alert">
</p>

</form>


<script>
    function changeBatteryAlert(){
        var newnum = document.getElementById("batterylevel1").value;
        var status = document.getElementById("statusdd").value;
        if(newnum.length>0 || status!='undefined'){
            document.getElementById("changebatteryalert").submit();
        }
        else{
            returnToPreviousPage();
        }
    }
</script>
<br>

<?php 

    $sensor_names = array(
        
        "sensor0" => "Sensor 0",
        "sensor1" => "Sensor 1",
        "sensor2" => "Sensor 2",
        "sensor3" => "Sensor 3",
        "sensor4" => "Sensor 4",
        "sensor5" => "Sensor 5",
        "waterproof" => "Outside Waterproof",
        "dht_temp" => "Housing Temp",
        "dht_hum" => "Housing Humidity",
        
    );
    
    $sensor_array = array(
	        0 => $value0,
	        1 => $value1,
	        2 => $value2,
	        3 => $value3,
	        4 => $value4,
	        5 => $value5,
	        6 => $waterproof,
	        7 => $dht_temp,
	        8 => $dht_hum,
	);
    
    $sensor_tables = array(
	        0 => "sensor0",
	        1 => "sensor1",
	        2 => "sensor2",
	        3 => "sensor3",
	        4 => "sensor4",
	        5 => "sensor5",
	        6 => "waterproof",
	        7 => "dht_temp",
	        8 => "dht_hum",
	    );?>
    
</HTML>
