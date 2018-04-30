<!DOCTYPE html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
    
  
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chart Configuration - Instrumented Beehive</title>
  <link rel="shortcut icon" href="http://instrumentedbeehive.website/favicon.ico?v=2"/>
  <link rel="apple-touch-icon" href="apple-touch-icon.png" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<a href="homepage.php" style="text-decoration: none">
  <img src="images/bee.png" alt="logo" style="width:100px;height:100px;float:middle;margin-left:600px">
</a>
<br>



<style>

table {
    border-collapse: collapse;
}

th , td {
    padding: 8px;
    text-align: left;
    font-family: "Segoe UI";
	font-size: 16px;
	font-style: normal;
	font-variant: normal;
    border-bottom: 1px solid #ddd;
    border: none;
}



tr{background-color: #F5F5F5;
    border: none;
}

tr#tabl:hover {background-color: #FFFF99;}

button {
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
}

button:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    background-color: #262626 !important;
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
    
.header a {
  float: middle;
  width: 100px;
  height: 100px;
  margin-left:600px;
}
body {
    background-color: 	#FFFF99;
}


</style>
</head>

<?php

    
    $database= mysqli_connect("localhost","pregqqha_bee","sdp18beehive", "pregqqha_readings") or die ("could not connect to mysql"); 
	if (!$database) {
    	echo "failed to connect";
	}
	
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

    // GET SENSOR 
	$sensornumber1 = $_POST['chosen_sensor'];
	$sensornumber2 = $_POST['chosen_sensor2'];
	$sensornumber3 = $_POST['chosen_sensor3'];
	$sensornumber4 = $_POST['chosen_sensor4'];
	$sensornumber5 = $_POST['chosen_sensor5'];
	$sensornumber6 = $_POST['chosen_sensor6'];
	$sensornumber7 = $_POST['chosen_sensor7'];
	$sensornumber8 = $_POST['chosen_sensor8'];
	$sensornumber9 = $_POST['chosen_sensor9'];
	$selectedvalues = array();
	$selected = $_POST['result'];
	$pieces = explode(" ", $selected);
	$sizeofarray = sizeof($pieces);
	if(array_key_exists(1,$pieces)){
	    $sensornumber1 = $sensor_tables[$pieces[1]];
	}
	if(array_key_exists(2,$pieces)){
	    $sensornumber2 = $sensor_tables[$pieces[2]];
	}
	if(array_key_exists(3,$pieces)){
	    $sensornumber3 = $sensor_tables[$pieces[3]];
	}
	if(array_key_exists(4,$pieces)){
	    $sensornumber4 = $sensor_tables[$pieces[4]];
	}
	if(array_key_exists(5,$pieces)){
	    $sensornumber5 = $sensor_tables[$pieces[5]];
	}
	if(array_key_exists(6,$pieces)){
	    $sensornumber6 = $sensor_tables[$pieces[6]];
	}
	if(array_key_exists(7,$pieces)){
	    $sensornumber7 = $sensor_tables[$pieces[7]];
	}
	if(array_key_exists(8,$pieces)){
	    $sensornumber8 = $sensor_tables[$pieces[8]];
	}
	if(array_key_exists(9,$pieces)){
	    $sensornumber9 = $sensor_tables[$pieces[9]];
	}
	/*
	$freqs = array_count_values($pieces);
	$res = array_unique($pieces);
	echo $res[0];
    $cnter=0;
	for($u=1;$u<$sizeofarray;$u++){
	    if((($freqs[$pieces[$u]])%2)!=0){
	        echo "hi";
	        $selectedvalues[$cnter]=$sensor_tables[$pieces[$u]];
	        echo $selectedvalues[$cnter];
	        $cnter++;
	    }
	}*/
	
	
	$array_names = array(
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
    
    $array_variables = array(
        0 => $sensornumber1,
        1 => $sensornumber2,
        2 => $sensornumber3,
        3 => $sensornumber4,
        4 => $sensornumber5,
        5 => $sensornumber6,
        6 => $sensornumber7,
        7 => $sensornumber8,
        8 => $sensornumber9,
        
        );
	
	// GET START DATE
	$start_date = $_POST['datepicker'];
    $start_date_array = explode(",",$start_date);
    $year = $start_date_array[2];
    $month_and_day = $start_date_array[1];
    $month_and_day_array = explode(" ",$month_and_day); 
    $month = $month_and_day_array[2];
    $day = $month_and_day_array[1];
    
    // GET END DATE
    $end_date = $_POST['datepicker2'];
    $end_date_array = explode(",",$end_date);
    $year2 = $end_date_array[2];
    $month_and_day2 = $end_date_array[1];
    $month_and_day_array2 = explode(" ",$month_and_day2); 
    $month2 = $month_and_day_array2[2];
    $day2 = $month_and_day_array2[1];

    // TRIM TO MAKE SURE
    $day = trim($day);
    $month = trim($month);
    $year = trim($year);
    $day2 = trim($day2);
    $month2 = trim($month2);
    $year2 = trim($year2);
    
    // CREATE DICTIONARY FOR MONTHS
    $month_values = array(
    "January" => 1,
    "February" => 2,
    "March" => 3,
    "April" => 4,
    "May" => 5,
    "June" => 6,
    "July" => 7,
    "August" => 8,
    "September" => 9,
    "October" => 10,
    "November" => 11,
    "December" => 12,
    );
    
    // SET START AND END TIME
    $time = '0:00';
    $time2 = '23:59';
    
    // FIND HOW MANY DAYS ARE IN BETWEEN
    $year_diff = intval($year2 - $year);
    $day_diff = intval($day2 - $day);
    $month_diff = intval($month_values[$month2] - $month_values[$month]);
    $total_days = $year_diff*365 + $month_diff*30 + $day_diff;
    
    // FIND OUT WHAT THE TICK INTERVAL SHOULD BE
    $ticks = round($total_days/21);
    if($ticks==1){
        $tick_interval = $ticks . ' day';
    }
    else if($ticks>1){
        $tick_interval = $ticks . ' days';
    }
    else if($ticks<1){
        $total_hours = $total_days * 24;
        $ticks = round($total_hours/21);
        if($ticks==1){
            $tick_interval = '2 hours';
        }
        else if($ticks>1){
            $tick_interval = intval($ticks+1) . ' hours';
        }
        else if($ticks==0){ // SHOULD NEVER BE USED
            $tick_interval = '1 hour';
        }
    }
    
    // CONVERT START DATE INTO DIFF FORM FOR SQL
    if(intval($day)<10){
        $diff_day = "0" . $day;
    }
    else{
        $diff_day = $day;
    }
    if(intval($month_values[$month])<10){
        $diff_month = "0" . $month_values[$month];
    }
    else{
        $diff_month = $month_values[$month];
    }
    
    // CONVERT END DATE INTO DIFF FORM FOR SQL
    if(intval($day2)<10){
        $diff_day2 = "0" . $day2;
    }
    else{
        $diff_day2 = $day2;
    }
    if(intval($month_values[$month2])<10){
        $diff_month2 = "0" . $month_values[$month2];
    }
    else{
        $diff_month2 = $month_values[$month2];
    }
    
    $start_date2 = $year . "-" . $diff_month . "-" . $diff_day . " 00:00:01";
    $start_date2 = trim($start_date2);
    $end_date2 = $year2 . "-" . $diff_month2 . "-" . $diff_day2 . " 23:59:50";
    $end_date2 = trim($end_date2);
    
  
    $sensor_avg=array();
    $sensor_ct=array();
    
    // GET VALUES WITHIN SELECTED TIME PERIOD FOR 1st SENSOR
    if($sensornumber1!='Choose sensor'){
        $sensornumberarray1=array();
        $index1=0;
        $tabledatasearch1 = "SELECT * from $sensornumber1 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $tabledataresult1 = mysqli_query($database,$tabledatasearch1)or die(mysqli_error($database));
        while($rowsarray1 = mysqli_fetch_array($tabledataresult1)){
            $sensornumberarray1[$index1][0]=$rowsarray1['value'];
            $sensornumberarray1[$index1][1]=$rowsarray1['date_time'];
            $index1++;
        }
     
        // GET AVERGE
        $selectaverage1 = "SELECT AVG(value) FROM $sensornumber1 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $averagequery1 = mysqli_query($database,$selectaverage1)or die(mysqli_error($database));
        $averagequeryrow1 = mysqli_fetch_array($averagequery1);
        $avg1 = $averagequeryrow1['AVG(value)'];
        $sensor_avg[0] = number_format($avg1,2);
    
        // GET COUNT
        $selectcount1 = "SELECT COUNT(id) FROM $sensornumber1 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $countquery1 = mysqli_query($database,$selectcount1)or die(mysqli_error($database));
        $countqueryrow1 = mysqli_fetch_array($countquery1);
        $sensor_ct[0] = $countqueryrow1['COUNT(id)'];
    
    }
    
    // GET VALUES WITHIN SELECTED TIME PERIOD FOR 2nd SENSOR
    if($sensornumber2!='Choose sensor'){
        $sensornumberarray2=array();
        $index2=0;
        $tabledatasearch2 = "SELECT * from $sensornumber2 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $tabledataresult2 = mysqli_query($database,$tabledatasearch2)or die(mysqli_error($database));
        while($rowsarray2 = mysqli_fetch_array($tabledataresult2)){
            $sensornumberarray2[$index2][0]=$rowsarray2['value'];
            $sensornumberarray2[$index2][1]=$rowsarray2['date_time'];
            $index2++;
        }
     
        // GET AVERGE
        $selectaverage2 = "SELECT AVG(value) FROM $sensornumber2 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $averagequery2 = mysqli_query($database,$selectaverage2)or die(mysqli_error($database));
        $averagequeryrow2 = mysqli_fetch_array($averagequery2);
        $avg2 = $averagequeryrow2['AVG(value)'];
        $sensor_avg[1] = number_format($avg2,2);
    
        // GET COUNT
        $selectcount2 = "SELECT COUNT(id) FROM $sensornumber2 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $countquery2 = mysqli_query($database,$selectcount2)or die(mysqli_error($database));
        $countqueryrow2 = mysqli_fetch_array($countquery2);
        $sensor_ct[1] = $countqueryrow2['COUNT(id)'];
    }
    
    // GET VALUES WITHIN SELECTED TIME PERIOD FOR 3rd SENSOR
    if($sensornumber3!='Choose sensor'){
        $sensornumberarray3=array();
        $index3=0;
        $tabledatasearch3 = "SELECT * from $sensornumber3 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $tabledataresult3 = mysqli_query($database,$tabledatasearch3)or die(mysqli_error($database));
        while($rowsarray3 = mysqli_fetch_array($tabledataresult3)){
            $sensornumberarray3[$index3][0]=$rowsarray3['value'];
            $sensornumberarray3[$index3][1]=$rowsarray3['date_time'];
            $index3++;
        }
     
        // GET AVERGE
        $selectaverage3 = "SELECT AVG(value) FROM $sensornumber3 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $averagequery3 = mysqli_query($database,$selectaverage3)or die(mysqli_error($database));
        $averagequeryrow3 = mysqli_fetch_array($averagequery3);
        $avg3 = $averagequeryrow3['AVG(value)'];
        $sensor_avg[2] = number_format($avg3,2);
    
        // GET COUNT
        $selectcount3 = "SELECT COUNT(id) FROM $sensornumber3 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $countquery3 = mysqli_query($database,$selectcount3)or die(mysqli_error($database));
        $countqueryrow3 = mysqli_fetch_array($countquery3);
        $sensor_ct[2] = $countqueryrow3['COUNT(id)'];
    }
    
    // GET VALUES WITHIN SELECTED TIME PERIOD FOR 4th SENSOR
    if($sensornumber4!='Choose sensor'){
        $sensornumberarray4=array();
        $index4=0;
        $tabledatasearch4 = "SELECT * from $sensornumber4 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $tabledataresult4 = mysqli_query($database,$tabledatasearch4)or die(mysqli_error($database));
        while($rowsarray4 = mysqli_fetch_array($tabledataresult4)){
            $sensornumberarray4[$index4][0]=$rowsarray4['value'];
            $sensornumberarray4[$index4][1]=$rowsarray4['date_time'];
            $index4++;
        }
     
        // GET AVERGE
        $selectaverage4 = "SELECT AVG(value) FROM $sensornumber4 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $averagequery4 = mysqli_query($database,$selectaverage4)or die(mysqli_error($database));
        $averagequeryrow4 = mysqli_fetch_array($averagequery4);
        $avg4 = $averagequeryrow4['AVG(value)'];
        $sensor_avg[3] = number_format($avg4,2);
    
        // GET COUNT
        $selectcount4 = "SELECT COUNT(id) FROM $sensornumber4 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $countquery4 = mysqli_query($database,$selectcount4)or die(mysqli_error($database));
        $countqueryrow4 = mysqli_fetch_array($countquery4);
        $sensor_ct[3] = $countqueryrow4['COUNT(id)'];
    }
    
    // GET VALUES WITHIN SELECTED TIME PERIOD FOR 5th SENSOR
    if($sensornumber5!='Choose sensor'){
        $sensornumberarray5=array();
        $index5=0;
        $tabledatasearch5 = "SELECT * from $sensornumber5 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $tabledataresult5 = mysqli_query($database,$tabledatasearch5)or die(mysqli_error($database));
        while($rowsarray5 = mysqli_fetch_array($tabledataresult5)){
            $sensornumberarray5[$index5][0]=$rowsarray5['value'];
            $sensornumberarray5[$index5][1]=$rowsarray5['date_time'];
            $index5++;
        }
     
        // GET AVERGE
        $selectaverage5 = "SELECT AVG(value) FROM $sensornumber5 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $averagequery5 = mysqli_query($database,$selectaverage5)or die(mysqli_error($database));
        $averagequeryrow5 = mysqli_fetch_array($averagequery5);
        $avg5 = $averagequeryrow5['AVG(value)'];
        $sensor_avg[4] = number_format($avg5,2);
    
        // GET COUNT
        $selectcount5 = "SELECT COUNT(id) FROM $sensornumber5 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $countquery5 = mysqli_query($database,$selectcount5)or die(mysqli_error($database));
        $countqueryrow5 = mysqli_fetch_array($countquery5);
        $sensor_ct[4] = $countqueryrow5['COUNT(id)'];
    }
    
     // GET VALUES WITHIN SELECTED TIME PERIOD FOR 6th SENSOR
    if($sensornumber6!='Choose sensor'){
        $sensornumberarray6=array();
        $index6=0;
        $tabledatasearch6 = "SELECT * from $sensornumber6 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $tabledataresult6 = mysqli_query($database,$tabledatasearch6)or die(mysqli_error($database));
        while($rowsarray6 = mysqli_fetch_array($tabledataresult6)){
            $sensornumberarray6[$index6][0]=$rowsarray6['value'];
            $sensornumberarray6[$index6][1]=$rowsarray6['date_time'];
            $index6++;
        }
     
        // GET AVERGE
        $selectaverage6 = "SELECT AVG(value) FROM $sensornumber6 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $averagequery6 = mysqli_query($database,$selectaverage6)or die(mysqli_error($database));
        $averagequeryrow6 = mysqli_fetch_array($averagequery6);
        $avg6 = $averagequeryrow6['AVG(value)'];
        $sensor_avg[5] = number_format($avg6,2);
    
        // GET COUNT
        $selectcount6 = "SELECT COUNT(id) FROM $sensornumber6 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $countquery6 = mysqli_query($database,$selectcount6)or die(mysqli_error($database));
        $countqueryrow6 = mysqli_fetch_array($countquery6);
        $sensor_ct[5] = $countqueryrow6['COUNT(id)'];
    }
    
    if($sensornumber7!='Choose sensor'){
        $sensornumberarray7=array();
        $index7=0;
        $tabledatasearch7 = "SELECT * from $sensornumber7 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $tabledataresult7 = mysqli_query($database,$tabledatasearch7)or die(mysqli_error($database));
        while($rowsarray7 = mysqli_fetch_array($tabledataresult7)){
            $sensornumberarray7[$index7][0]=$rowsarray7['value'];
            $sensornumberarray7[$index7][1]=$rowsarray7['date_time'];
            $index7++;
        }
     
        // GET AVERGE
        $selectaverage7 = "SELECT AVG(value) FROM $sensornumber7 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $averagequery7 = mysqli_query($database,$selectaverage7)or die(mysqli_error($database));
        $averagequeryrow7 = mysqli_fetch_array($averagequery7);
        $avg7 = $averagequeryrow7['AVG(value)'];
        $sensor_avg[6] = number_format($avg7,2);
    
        // GET COUNT
        $selectcount7 = "SELECT COUNT(id) FROM $sensornumber7 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $countquery7 = mysqli_query($database,$selectcount7)or die(mysqli_error($database));
        $countqueryrow7 = mysqli_fetch_array($countquery7);
        $sensor_ct[6] = $countqueryrow7['COUNT(id)'];
    }
    
    if($sensornumber8!='Choose sensor'){
        $sensornumberarray8=array();
        $index8=0;
        $tabledatasearch8 = "SELECT * from $sensornumber8 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $tabledataresult8 = mysqli_query($database,$tabledatasearch8)or die(mysqli_error($database));
        while($rowsarray8 = mysqli_fetch_array($tabledataresult8)){
            $sensornumberarray8[$index8][0]=$rowsarray8['value'];
            $sensornumberarray8[$index8][1]=$rowsarray8['date_time'];
            $index6++;
        }
     
        // GET AVERGE
        $selectaverage8 = "SELECT AVG(value) FROM $sensornumber8 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $averagequery8 = mysqli_query($database,$selectaverage8)or die(mysqli_error($database));
        $averagequeryrow8 = mysqli_fetch_array($averagequery8);
        $avg8 = $averagequeryrow8['AVG(value)'];
        $sensor_avg[7] = number_format($avg8,2);
    
        // GET COUNT
        $selectcount8 = "SELECT COUNT(id) FROM $sensornumber8 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $countquery8 = mysqli_query($database,$selectcount8)or die(mysqli_error($database));
        $countqueryrow8 = mysqli_fetch_array($countquery8);
        $sensor_ct[7] = $countqueryrow8['COUNT(id)'];
    }
    
    if($sensornumber9!='Choose sensor'){
        $sensornumberarray9=array();
        $index9=0;
        $tabledatasearch9 = "SELECT * from $sensornumber9 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $tabledataresult9 = mysqli_query($database,$tabledatasearch9)or die(mysqli_error($database));
        while($rowsarray9 = mysqli_fetch_array($tabledataresult9)){
            $sensornumberarray9[$index9][0]=$rowsarray9['value'];
            $sensornumberarray9[$index9][1]=$rowsarray9['date_time'];
            $index9++;
        }
     
        // GET AVERGE
        $selectaverage9 = "SELECT AVG(value) FROM $sensornumber9 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $averagequery9 = mysqli_query($database,$selectaverage9)or die(mysqli_error($database));
        $averagequeryrow9 = mysqli_fetch_array($averagequery9);
        $avg9 = $averagequeryrow9['AVG(value)'];
        $sensor_avg[8] = number_format($avg9,2);
    
        // GET COUNT
        $selectcount9 = "SELECT COUNT(id) FROM $sensornumber9 WHERE date_time >= '$start_date2' AND date_time <= '$end_date2' order by date_time desc";
        $countquery9 = mysqli_query($database,$selectcount9)or die(mysqli_error($database));
        $countqueryrow9 = mysqli_fetch_array($countquery9);
        $sensor_ct[8] = $countqueryrow9['COUNT(id)'];
    }
    
    ?>

    
    <html>
    <style>
    div {
        padding-left: 20px;
    }
    h5 {
        padding-left: 200px;
    }
    </style>
    
    <!-- CREATE TABLE STRUCTURE -->
    <head>
    <style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
    }
    th {
        text-align: left;
    }
    </style>
    
    
    <!-- INCLUDE ALL NECESSARY SCRIPTS -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="../jqplot/jquery.jqplot.js"></script>
    <script type="text/javascript" src="../jqplot/plugins/jqplot.cursor.js"></script>
    <script type="text/javascript" src="../jqplot/plugins/jqplot.dateAxisRenderer.js"></script>
    <script type="text/javascript" src="../jqplot/plugins/jqplot.logAxisRenderer.js"></script>
    <script type="text/javascript" src="../jqplot/plugins/jqplot.canvasTextRenderer.js"></script>
    <script  type="text/javascript"  src="../jqplot/plugins/jqplot.canvasAxisTickRenderer.js"></script>
    <script  type="text/javascript"  src="../jqplot/plugins/jqplot.enhancedLegendRenderer.js"></script>
    <script type="text/javascript" src="../jqplot/plugins/jqplot.pointLabels.js"></script>
    <link rel="stylesheet" type="text/css" href="../jqplot/jquery.jqplot.css" />
    

    </head>
    <body>
        
    <button onclick="toggleTable()">Toggle Data Table</button>
    <!--<button onclick="toggleTable2()">Toggle Data Table2</button>-->

    
    <!-- CREATE TABLE HEADING -->
    <table style="width:100%; display: none;" id="data_table1">
        <tr id="tabl">
    <?php for($m=0;$m<9;$m++){
        if($array_variables[$m]!='Choose sensor'){?>
            <th id="tabl"><?php echo $array_names[$array_variables[$m]]; ?></th> 
          <?php  
        }
    }?>
        <th id="tabl">Date/Time</th>
     </tr>
     
    <?php
    $fluctuation=array();
    $maxvalue=array();
    $maxvaluedt=array();
    $minvalue=array();
    $minvaluedt=array();
    $sd=array();
    $outside1sd=array();
    $outside2sd=array();
    $outside3sd=array();
    // POPULATE TABLE 1 AND MAKE CALCULATIONS
    if($sensornumber1!='Choose sensor'){
        $maxvalue1=0;
        $maxvaluedt1="";
        $minvalue1=100;
        $minvaluedt1="";
        $total=0;
        $tot=0;
        $outside1sd[0]=0;
        $outside2sd[0]=0;
        $outside3sd[0]=0;
        $counter=0;
        
        for($i=0; $i<$sensor_ct[0];$i++){
            $value = $sensornumberarray1[$i][0];
            $dt = $sensornumberarray1[$i][1];
            if($total==0){
                $prev=$value;
            }
            if(floatval($value)>floatval($maxvalue1)){
                $maxvalue1=$value;
                $maxvaluedt1=$dt;
                $maxvalue[0]=$maxvalue1;
                $maxvaluedt[0]=$maxvaluedt1;
            }
            if(floatval($value)<floatval($minvalue1)){
                $minvalue1=$value;
                $minvaluedt1=$dt;
                $minvalue[0]=$minvalue1;
                $minvaluedt[0]=$minvaluedt1;
            }
            $tot+=abs(floatval($value)-floatval($prev));
            $sum=floatval($value)-floatval($sensor_avg[0]);
            $sumsquared = pow($sum,2);
            $total+=$sumsquared;
            $prev = $value;
    ?>
     <tr id="tabl">
        <td> <?php echo $value; ?> </td>
        <?php if($sensornumber2!='Choose sensor'){?>
        <td> <?php echo $sensornumberarray2[$counter][0]; ?> </td>
        <?php }?>
        <?php if($sensornumber3!='Choose sensor'){?>
        <td> <?php echo $sensornumberarray3[$counter][0]; ?> </td>
        <?php }?>
        <?php if($sensornumber4!='Choose sensor'){?>
        <td> <?php echo $sensornumberarray4[$counter][0]; ?> </td>
        <?php }?>
        <?php if($sensornumber5!='Choose sensor'){?>
        <td> <?php echo $sensornumberarray5[$counter][0]; ?> </td>
        <?php }?>
        <?php if($sensornumber6!='Choose sensor'){?>
        <td> <?php echo $sensornumberarray6[$counter][0]; ?> </td>
        <?php }?>
        <?php if($sensornumber7!='Choose sensor'){?>
        <td> <?php echo $sensornumberarray7[$counter][0]; ?> </td>
        <?php }?>
        <?php if($sensornumber8!='Choose sensor'){?>
        <td> <?php echo $sensornumberarray8[$counter][0]; ?> </td>
        <?php }?>
        <?php if($sensornumber9!='Choose sensor'){?>
        <td> <?php echo $sensornumberarray9[$counter][0]; ?> </td>
        <?php }?>
        <td> <?php $dt2=date_create($dt); echo date_format($dt2, 'g:ia \o\n l jS F Y'); ?></td>
    </tr>
     
    <?php
        $counter++;
        }
        
        $maxvaluedt[0] = date_create($maxvaluedt[0]);
        $minvaluedt[0] = date_create($minvaluedt[0]);
    
    $var1=$total/$sensor_ct[0];
    $fluctuation1=$tot/($sensor_ct[0]-1);
    $fluctuation[0]=number_format($fluctuation1,2);
    $sd1=sqrt($var1);
    $sd[0]=number_format($sd1,2);
    for($i=0; $i<$sensor_ct[0];$i++){
            $value = $sensornumberarray1[$i][0];
            $dt = $sensornumberarray1[$i][1];
            if(abs(floatval($value)-floatval($sensor_avg[0]))>$sd[0]*3){
                $outside3sd[0]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[0]))>$sd[0]*2){
                $outside2sd[0]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[0]))>$sd[0]){
                $outside1sd[0]++;
            }
    }
    }
    
    // POPULATE TABLE 1 AND MAKE CALCULATIONS
    if($sensornumber2!='Choose sensor'){
        $maxvalue1=0;
        $maxvaluedt1="";
        $minvalue1=100;
        $minvaluedt1="";
        $total=0;
        $tot=0;
        $outside1sd[1]=0;
        $outside2sd[1]=0;
        $outside3sd[1]=0;
        
        for($i=0; $i<$sensor_ct[1];$i++){
            $value = $sensornumberarray2[$i][0];
            $dt = $sensornumberarray2[$i][1];
            if($total==0){
                $prev=$value;
            }
            if(floatval($value)>floatval($maxvalue1)){
                $maxvalue1=$value;
                $maxvaluedt1=$dt;
                $maxvalue[1]=$maxvalue1;
                $maxvaluedt[1]=$maxvaluedt1;
            }
            if(floatval($value)<floatval($minvalue1)){
                $minvalue1=$value;
                $minvaluedt1=$dt;
                $minvalue[1]=$minvalue1;
                $minvaluedt[1]=$minvaluedt1;
            }
            $tot+=abs(floatval($value)-floatval($prev));
            $sum=floatval($value)-floatval($sensor_avg[1]);
            $sumsquared = pow($sum,2);
            $total+=$sumsquared;
            $prev = $value;
    ?>
     
    <?php
        }
        $maxvaluedt[1] = date_create($maxvaluedt[1]);
        $minvaluedt[1] = date_create($minvaluedt[1]);
    
    $var1=$total/$sensor_ct[1];
    $fluctuation1=$tot/($sensor_ct[1]-1);
    $fluctuation[1]=number_format($fluctuation1,2);
    $sd1=sqrt($var1);
    $sd[1]=number_format($sd1,2);
    for($i=0; $i<$sensor_ct[1];$i++){
            $value = $sensornumberarray2[$i][0];
            $dt = $sensornumberarray2[$i][1];
            if(abs(floatval($value)-floatval($sensor_avg[1]))>$sd[1]*3){
                $outside3sd[1]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[1]))>$sd[1]*2){
                $outside2sd[1]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[1]))>$sd[1]){
                $outside1sd[1]++;
            }
    }
    }
    
    // POPULATE TABLE 1 AND MAKE CALCULATIONS
    if($sensornumber3!='Choose sensor'){
        $maxvalue1=0;
        $maxvaluedt1="";
        $minvalue1=100;
        $minvaluedt1="";
        $total=0;
        $tot=0;
        $outside1sd[2]=0;
        $outside2sd[2]=0;
        $outside3sd[2]=0;
        
        for($i=0; $i<$sensor_ct[2];$i++){
            $value = $sensornumberarray3[$i][0];
            $dt = $sensornumberarray3[$i][1];
            if($total==0){
                $prev=$value;
            }
            if(floatval($value)>floatval($maxvalue1)){
                $maxvalue1=$value;
                $maxvaluedt1=$dt;
                $maxvalue[2]=$maxvalue1;
                $maxvaluedt[2]=$maxvaluedt1;
            }
            if(floatval($value)<floatval($minvalue1)){
                $minvalue1=$value;
                $minvaluedt1=$dt;
                $minvalue[2]=$minvalue1;
                $minvaluedt[2]=$minvaluedt1;
            }
            $tot+=abs(floatval($value)-floatval($prev));
            $sum=floatval($value)-floatval($sensor_avg[2]);
            $sumsquared = pow($sum,2);
            $total+=$sumsquared;
            $prev = $value;
    ?>
     
    <?php
        }
        $maxvaluedt[2] = date_create($maxvaluedt[2]);
        $minvaluedt[2] = date_create($minvaluedt[2]);
    
    $var1=$total/$sensor_ct[2];
    $fluctuation1=$tot/($sensor_ct[2]-1);
    $fluctuation[2]=number_format($fluctuation1,2);
    $sd1=sqrt($var1);
    $sd[2]=number_format($sd1,2);
    for($i=0; $i<$sensor_ct[2];$i++){
            $value = $sensornumberarray3[$i][0];
            $dt = $sensornumberarray3[$i][1];
            if(abs(floatval($value)-floatval($sensor_avg[2]))>$sd[2]*3){
                $outside3sd[2]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[2]))>$sd[2]*2){
                $outside2sd[2]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[2]))>$sd[2]){
                $outside1sd[2]++;
            }
    }
    }
    
    // POPULATE TABLE 1 AND MAKE CALCULATIONS
    if($sensornumber4!='Choose sensor'){
        $maxvalue1=0;
        $maxvaluedt1="";
        $minvalue1=100;
        $minvaluedt1="";
        $total=0;
        $tot=0;
        $outside1sd[3]=0;
        $outside2sd[3]=0;
        $outside3sd[3]=0;
        
        for($i=0; $i<$sensor_ct[3];$i++){
            $value = $sensornumberarray4[$i][0];
            $dt = $sensornumberarray4[$i][1];
            if($total==0){
                $prev=$value;
            }
            if(floatval($value)>floatval($maxvalue1)){
                $maxvalue1=$value;
                $maxvaluedt1=$dt;
                $maxvalue[3]=$maxvalue1;
                $maxvaluedt[3]=$maxvaluedt1;
            }
            if(floatval($value)<floatval($minvalue1)){
                $minvalue1=$value;
                $minvaluedt1=$dt;
                $minvalue[3]=$minvalue1;
                $minvaluedt[3]=$minvaluedt1;
            }
            $tot+=abs(floatval($value)-floatval($prev));
            $sum=floatval($value)-floatval($sensor_avg[3]);
            $sumsquared = pow($sum,2);
            $total+=$sumsquared;
            $prev = $value;
    ?>
     
    <?php
        }
        $maxvaluedt[3] = date_create($maxvaluedt[3]);
        $minvaluedt[3] = date_create($minvaluedt[3]);
    
    $var1=$total/$sensor_ct[3];
    $fluctuation1=$tot/($sensor_ct[3]-1);
    $fluctuation[3]=number_format($fluctuation1,2);
    $sd1=sqrt($var1);
    $sd[3]=number_format($sd1,2);
    for($i=0; $i<$sensor_ct[3];$i++){
            $value = $sensornumberarray4[$i][0];
            $dt = $sensornumberarray4[$i][1];
            if(abs(floatval($value)-floatval($sensor_avg[3]))>$sd[3]*3){
                $outside3sd[3]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[3]))>$sd[3]*2){
                $outside2sd[3]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[3]))>$sd[3]){
                $outside1sd[3]++;
            }
    }
    }
    
    // POPULATE TABLE 1 AND MAKE CALCULATIONS
    if($sensornumber5!='Choose sensor'){
        $maxvalue1=0;
        $maxvaluedt1="";
        $minvalue1=100;
        $minvaluedt1="";
        $total=0;
        $tot=0;
        $outside1sd[4]=0;
        $outside2sd[4]=0;
        $outside3sd[4]=0;
        
        for($i=0; $i<$sensor_ct[4];$i++){
            $value = $sensornumberarray5[$i][0];
            $dt = $sensornumberarray5[$i][1];
            if($total==0){
                $prev=$value;
            }
            if(floatval($value)>floatval($maxvalue1)){
                $maxvalue1=$value;
                $maxvaluedt1=$dt;
                $maxvalue[4]=$maxvalue1;
                $maxvaluedt[4]=$maxvaluedt1;
            }
            if(floatval($value)<floatval($minvalue1)){
                $minvalue1=$value;
                $minvaluedt1=$dt;
                $minvalue[4]=$minvalue1;
                $minvaluedt[4]=$minvaluedt1;
            }
            $tot+=abs(floatval($value)-floatval($prev));
            $sum=floatval($value)-floatval($sensor_avg[4]);
            $sumsquared = pow($sum,2);
            $total+=$sumsquared;
            $prev = $value;
    ?>
     
    <?php
        }
        $maxvaluedt[4] = date_create($maxvaluedt[4]);
        $minvaluedt[4] = date_create($minvaluedt[4]);
    
    $var1=$total/$sensor_ct[4];
    $fluctuation1=$tot/($sensor_ct[4]-1);
    $fluctuation[4]=number_format($fluctuation1,2);
    $sd1=sqrt($var1);
    $sd[4]=number_format($sd1,2);
    for($i=0; $i<$sensor_ct[4];$i++){
            $value = $sensornumberarray5[$i][0];
            $dt = $sensornumberarray5[$i][1];
            if(abs(floatval($value)-floatval($sensor_avg[4]))>$sd[4]*3){
                $outside3sd[4]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[4]))>$sd[4]*2){
                $outside2sd[4]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[4]))>$sd[4]){
                $outside1sd[4]++;
            }
    }
    }
    
    // POPULATE TABLE 1 AND MAKE CALCULATIONS
    if($sensornumber6!='Choose sensor'){
        $maxvalue1=0;
        $maxvaluedt1="";
        $minvalue1=100;
        $minvaluedt1="";
        $total=0;
        $tot=0;
        $outside1sd[5]=0;
        $outside2sd[5]=0;
        $outside3sd[5]=0;
        
        for($i=0; $i<$sensor_ct[5];$i++){
            $value = $sensornumberarray6[$i][0];
            $dt = $sensornumberarray6[$i][1];
            if($total==0){
                $prev=$value;
            }
            if(floatval($value)>floatval($maxvalue1)){
                $maxvalue1=$value;
                $maxvaluedt1=$dt;
                $maxvalue[5]=$maxvalue1;
                $maxvaluedt[5]=$maxvaluedt1;
            }
            if(floatval($value)<floatval($minvalue1)){
                $minvalue1=$value;
                $minvaluedt1=$dt;
                $minvalue[5]=$minvalue1;
                $minvaluedt[5]=$minvaluedt1;
            }
            $tot+=abs(floatval($value)-floatval($prev));
            $sum=floatval($value)-floatval($sensor_avg[5]);
            $sumsquared = pow($sum,2);
            $total+=$sumsquared;
            $prev = $value;
    ?>
     
    <?php
        }
        $maxvaluedt[5] = date_create($maxvaluedt[5]);
        $minvaluedt[5] = date_create($minvaluedt[5]);
    
    $var1=$total/$sensor_ct[5];
    $fluctuation1=$tot/($sensor_ct[5]-1);
    $fluctuation[5]=number_format($fluctuation1,2);
    $sd1=sqrt($var1);
    $sd[5]=number_format($sd1,2);
    for($i=0; $i<$sensor_ct[5];$i++){
            $value = $sensornumberarray6[$i][0];
            $dt = $sensornumberarray6[$i][1];
            if(abs(floatval($value)-floatval($sensor_avg[5]))>$sd[5]*3){
                $outside3sd[5]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[5]))>$sd[5]*2){
                $outside2sd[5]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[5]))>$sd[5]){
                $outside1sd[5]++;
            }
    }
    }

    // POPULATE TABLE 1 AND MAKE CALCULATIONS
    if($sensornumber7!='Choose sensor'){
        $maxvalue1=0;
        $maxvaluedt1="";
        $minvalue1=100;
        $minvaluedt1="";
        $total=0;
        $tot=0;
        $outside1sd[6]=0;
        $outside2sd[6]=0;
        $outside3sd[6]=0;
        
        for($i=0; $i<$sensor_ct[6];$i++){
            $value = $sensornumberarray7[$i][0];
            $dt = $sensornumberarray7[$i][1];
            if($total==0){
                $prev=$value;
            }
            if(floatval($value)>floatval($maxvalue1)){
                $maxvalue1=$value;
                $maxvaluedt1=$dt;
                $maxvalue[6]=$maxvalue1;
                $maxvaluedt[6]=$maxvaluedt1;
            }
            if(floatval($value)<floatval($minvalue1)){
                $minvalue1=$value;
                $minvaluedt1=$dt;
                $minvalue[6]=$minvalue1;
                $minvaluedt[6]=$minvaluedt1;
            }
            $tot+=abs(floatval($value)-floatval($prev));
            $sum=floatval($value)-floatval($sensor_avg[6]);
            $sumsquared = pow($sum,2);
            $total+=$sumsquared;
            $prev = $value;
    ?>
     
    <?php
        }
        $maxvaluedt[6] = date_create($maxvaluedt[6]);
        $minvaluedt[6] = date_create($minvaluedt[6]);
    
    
    $var1=$total/$sensor_ct[6];
    $fluctuation1=$tot/($sensor_ct[6]-1);
    $fluctuation[6]=number_format($fluctuation1,2);
    $sd1=sqrt($var1);
    $sd[6]=number_format($sd1,2);
    for($i=0; $i<$sensor_ct[6];$i++){
            $value = $sensornumberarray7[$i][0];
            $dt = $sensornumberarray7[$i][1];
            if(abs(floatval($value)-floatval($sensor_avg[6]))>$sd[6]*3){
                $outside3sd[6]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[6]))>$sd[6]*2){
                $outside2sd[6]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[6]))>$sd[6]){
                $outside1sd[6]++;
            }
    }
    }
    
    // POPULATE TABLE 1 AND MAKE CALCULATIONS
    if($sensornumber8!='Choose sensor'){
        $maxvalue1=0;
        $maxvaluedt1="";
        $minvalue1=100;
        $minvaluedt1="";
        $total=0;
        $tot=0;
        $outside1sd[7]=0;
        $outside2sd[7]=0;
        $outside3sd[7]=0;
        
        for($i=0; $i<$sensor_ct[7];$i++){
            $value = $sensornumberarray8[$i][0];
            $dt = $sensornumberarray8[$i][1];
            if($total==0){
                $prev=$value;
            }
            if(floatval($value)>floatval($maxvalue1)){
                $maxvalue1=$value;
                $maxvaluedt1=$dt;
                $maxvalue[7]=$maxvalue1;
                $maxvaluedt[7]=$maxvaluedt1;
            }
            if(floatval($value)<floatval($minvalue1)){
                $minvalue1=$value;
                $minvaluedt1=$dt;
                $minvalue[7]=$minvalue1;
                $minvaluedt[7]=$minvaluedt1;
            }
            $tot+=abs(floatval($value)-floatval($prev));
            $sum=floatval($value)-floatval($sensor_avg[7]);
            $sumsquared = pow($sum,2);
            $total+=$sumsquared;
            $prev = $value;
    ?>
     
    <?php
        }
        $maxvaluedt[7] = date_create($maxvaluedt[7]);
        $minvaluedt[7] = date_create($minvaluedt[7]);
    
    $var1=$total/$sensor_ct[7];
    $fluctuation1=$tot/($sensor_ct[7]-1);
    $fluctuation[7]=number_format($fluctuation1,2);
    $sd1=sqrt($var1);
    $sd[7]=number_format($sd1,2);
    for($i=0; $i<$sensor_ct[7];$i++){
            $value = $sensornumberarray8[$i][0];
            $dt = $sensornumberarray8[$i][1];
            if(abs(floatval($value)-floatval($sensor_avg[7]))>$sd[7]*3){
                $outside3sd[7]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[7]))>$sd[7]*2){
                $outside2sd[7]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[7]))>$sd[7]){
                $outside1sd[7]++;
            }
    }
    }
    
    // POPULATE TABLE 1 AND MAKE CALCULATIONS
    if($sensornumber9!='Choose sensor'){
        $maxvalue1=0;
        $maxvaluedt1="";
        $minvalue1=100;
        $minvaluedt1="";
        $total=0;
        $tot=0;
        $outside1sd[8]=0;
        $outside2sd[8]=0;
        $outside3sd[8]=0;
        
        for($i=0; $i<$sensor_ct[8];$i++){
            $value = $sensornumberarray9[$i][0];
            $dt = $sensornumberarray9[$i][1];
            if($total==0){
                $prev=$value;
            }
            if(floatval($value)>floatval($maxvalue1)){
                $maxvalue1=$value;
                $maxvaluedt1=$dt;
                $maxvalue[8]=$maxvalue1;
                $maxvaluedt[8]=$maxvaluedt1;
            }
            if(floatval($value)<floatval($minvalue1)){
                $minvalue1=$value;
                $minvaluedt1=$dt;
                $minvalue[8]=$minvalue1;
                $minvaluedt[8]=$minvaluedt1;
            }
            $tot+=abs(floatval($value)-floatval($prev));
            $sum=floatval($value)-floatval($sensor_avg[8]);
            $sumsquared = pow($sum,2);
            $total+=$sumsquared;
            $prev = $value;
    ?>
     
    <?php
        }
        $maxvaluedt[8] = date_create($maxvaluedt[8]);
        $minvaluedt[8] = date_create($minvaluedt[8]);
    
    $var1=$total/$sensor_ct[8];
    $fluctuation1=$tot/($sensor_ct[8]-1);
    $fluctuation[8]=number_format($fluctuation1,2);
    $sd1=sqrt($var1);
    $sd[8]=number_format($sd1,2);
    for($i=0; $i<$sensor_ct[8];$i++){
            $value = $sensornumberarray9[$i][0];
            $dt = $sensornumberarray9[$i][1];
            if(abs(floatval($value)-floatval($sensor_avg[8]))>$sd[8]*3){
                $outside3sd[8]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[8]))>$sd[8]*2){
                $outside2sd[8]++;
            }
            else if(abs(floatval($value)-floatval($sensor_avg[8]))>$sd[8]){
                $outside1sd[8]++;
            }
    }
    }
    ?>
    
    
    
    </table> 
    
    <!-- CREATE TABLE HEADING -->
    <table style="width:100%; display: none;" id="data_table2">
     <tr>
        <th>Temperature (F) <?php echo $sensornumber2; ?></th> 
        <th>Date/Time</th>
     </tr>
    
    <!-- TOGGLE TABLE SCRIPT -->
    <script>
        function toggleTable2() {
            var data_table = document.getElementById("data_table2");
            if (data_table.style.display === "none") {
                data_table.style.display = "inline-block";
            } 
            else {
                data_table.style.display = "none";
            }
        }
    </script>
    
    <script>
        function toggleTable() {
            var data_table = document.getElementById("data_table1");
            if (data_table.style.display === "none") {
                data_table.style.display = "inline-block";
            } 
            else {
                data_table.style.display = "none";
            }
        }
    </script>
    
    

    <!-- CHECK IF LONG TERM OR SHORT TERM -->
    <?php
    
    if($start_date!=$end_date){
    ?>

    <!-- START SCRIPT FOR LONG TERM PLOT -->
    <script type="text/javascript">
    $(document).ready(function(){
    var lines = [];
    var lines2 = [];
    var lines3 = [];
    var lines4 = [];
    var lines5 = [];
    var lines6 = [];
    var lines7 = [];
    var lines8 = [];
    var lines9 = [];
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 1st SENSOR    
    <?php
    if($sensornumber1!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[0];$j++){
            $value = $sensornumberarray1[$j][0];
            $dt = $sensornumberarray1[$j][1];
    ?>

    lines[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        } 
            
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 2nd SENSOR    
    <?php
    if($sensornumber2!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[1];$j++){
            $value = $sensornumberarray2[$j][0];
            $dt = $sensornumberarray2[$j][1];
    ?>

    lines2[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 3rd SENSOR    
    <?php
    if($sensornumber3!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[2];$j++){
            $value = $sensornumberarray3[$j][0];
            $dt = $sensornumberarray3[$j][1];
    ?>

    lines3[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 4th SENSOR    
    <?php
    if($sensornumber4!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[3];$j++){
            $value = $sensornumberarray4[$j][0];
            $dt = $sensornumberarray4[$j][1];
    ?>

    lines4[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 5th SENSOR    
    <?php
    if($sensornumber5!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[4];$j++){
            $value = $sensornumberarray5[$j][0];
            $dt = $sensornumberarray5[$j][1];
    ?>

    lines5[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 6th SENSOR    
    <?php
    if($sensornumber6!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[5];$j++){
            $value = $sensornumberarray6[$j][0];
            $dt = $sensornumberarray6[$j][1];
    ?>

    lines6[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 7th SENSOR    
    <?php
    if($sensornumber7!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[6];$j++){
            $value = $sensornumberarray7[$j][0];
            $dt = $sensornumberarray7[$j][1];
    ?>

    lines7[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 5th SENSOR    
    <?php
    if($sensornumber8!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[7];$j++){
            $value = $sensornumberarray8[$j][0];
            $dt = $sensornumberarray8[$j][1];
    ?>

    lines8[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 5th SENSOR    
    <?php
    if($sensornumber9!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[8];$j++){
            $value = $sensornumberarray9[$j][0];
            $dt = $sensornumberarray9[$j][1];
    ?>

    lines9[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
        
    $hum_active = false;
    if($sensornumber1=='dht_hum' ||$sensornumber2=='dht_hum'||$sensornumber3=='dht_hum'||$sensornumber4=='dht_hum'||$sensornumber5=='dht_hum'||$sensornumber6=='dht_hum'||$sensornumber7=='dht_hum'||$sensornumber8=='dht_hum'||$sensornumber9=='dht_hum'){
        $hum_active = true;
    }
    ?>
    
    
    // DEFINE VARIABLES OF PLOT 
    var plot2 = $.jqplot('chart2', [lines, lines2, lines3, lines4, lines5, lines6, lines7, lines8, lines9], {
        title:{
            text: 'Raw Data',
            fontFamily: 'Segoe UI'
        },
        axes:{
            xaxis:{
                fontFamily: 'Segoe UI',
                renderer:$.jqplot.DateAxisRenderer, 
                rendererOptions:{
                    tickRenderer:$.jqplot.CanvasAxisTickRenderer
                },
                tickOptions:{
                    fontSize:'10pt', 
                    fontFamily:'Tahoma', 
                    formatString:'%b %#d, %#I %p',
                    angle:-40
                },
                min:'<?php echo $month;?> <?php echo $day;?>, <?php echo $year; ?> <?php echo $time; ?>',
                max:'<?php echo $month2;?> <?php echo $day2;?>, <?php echo $year2; ?> <?php echo $time2; ?>',
                tickInterval:'<?php echo $tick_interval; ?>'
            },
            yaxis: {
                min: <?php if($hum_active){
                    echo 10;
                    }
                    else{
                        echo 60;
                    }
                ?>,
                max: 100
            }
        },
        series:[{lineWidth:4, showMarker:false, color: '#FF0000', label: '<?php if($sensornumber1!='Choose sensor'){
                echo $array_names[$sensornumber1];
            }
            else if($sensornumber1=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#0008FF', label: '<?php if($sensornumber2!='Choose sensor'){
                echo $array_names[$sensornumber2];
            }
            else if($sensornumber2=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#00cc00', label: '<?php if($sensornumber3!='Choose sensor'){
                echo $array_names[$sensornumber3];
            }
            else if($sensornumber3=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#660066', label: '<?php if($sensornumber4!='Choose sensor'){
                echo $array_names[$sensornumber4];
            }
            else if($sensornumber4=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#ff66cc', label: '<?php if($sensornumber5!='Choose sensor'){
                echo $array_names[$sensornumber5];
            }
            else if($sensornumber5=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#ff6600', label: '<?php if($sensornumber6!='Choose sensor'){
                echo $array_names[$sensornumber6];
            }
            else if($sensornumber6=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#FFFF00', label: '<?php if($sensornumber7!='Choose sensor'){
                echo $array_names[$sensornumber7];
            }
            else if($sensornumber7=='Choose sensor'){ 
                echo " ";
            }?>'},
            {lineWidth:4, showMarker:false, color: '#00BFFF', label: '<?php if($sensornumber8!='Choose sensor'){
                echo $array_names[$sensornumber8];
            }
            else if($sensornumber8=='Choose sensor'){ 
                echo " ";
            }?>'},
            {lineWidth:4, showMarker:false, color: '#000000', label: '<?php if($sensornumber9!='Choose sensor'){
                echo $array_names[$sensornumber9];
            }
            else if($sensornumber9=='Choose sensor'){ 
                echo " ";
            }?>'}],
            
            
        legend:{
                show:true,
                placement: 'outsideGrid',
                fontFamily: 'Segoe UI',
                border: '0px solid black'
        },
        cursor:{
            show: true, 
            zoom: true
        }
    });
    });
    </script>
    
    
    
    <!-- SMOOTHED CHART -->
    <script type="text/javascript">
    $(document).ready(function(){
    var line = [];
    var line2 = [];
    var line3 = [];
    var line4 = [];
    var line5 = [];
    var line6 = [];
    var line7 = [];
    var line8 = [];
    var line9 = [];
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 1st SENSOR    
    <?php
    if($sensornumber1!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray1[1][0];
        for($j=0; $j<$sensor_ct[0];$j++){
            $value = $sensornumberarray1[$j][0];
            $dt = $sensornumberarray1[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber2!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray2[1][0];
        for($j=0; $j<$sensor_ct[1];$j++){
            $value = $sensornumberarray2[$j][0];
            $dt = $sensornumberarray2[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line2[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber3!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray3[1][0];
        for($j=0; $j<$sensor_ct[2];$j++){
            $value = $sensornumberarray3[$j][0];
            $dt = $sensornumberarray3[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line3[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber4!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray4[1][0];
        for($j=0; $j<$sensor_ct[3];$j++){
            $value = $sensornumberarray4[$j][0];
            $dt = $sensornumberarray4[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line4[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber5!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray5[1][0];
        for($j=0; $j<$sensor_ct[4];$j++){
            $value = $sensornumberarray5[$j][0];
            $dt = $sensornumberarray5[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line5[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber6!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray6[1][0];
        for($j=0; $j<$sensor_ct[5];$j++){
            $value = $sensornumberarray6[$j][0];
            $dt = $sensornumberarray6[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line6[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber7!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray7[1][0];
        for($j=0; $j<$sensor_ct[6];$j++){
            $value = $sensornumberarray7[$j][0];
            $dt = $sensornumberarray7[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line7[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber8!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray8[1][0];
        for($j=0; $j<$sensor_ct[7];$j++){
            $value = $sensornumberarray8[$j][0];
            $dt = $sensornumberarray8[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line8[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber9!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray9[1][0];
        for($j=0; $j<$sensor_ct[8];$j++){
            $value = $sensornumberarray9[$j][0];
            $dt = $sensornumberarray9[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line9[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    
    var smoothed = $.jqplot('smoothed', [line, line2, line3, line4, line5, line6, line7, line8, line9], {
        title:{
            text: 'Exponentially Smoothed Data',
            fontFamily: 'Segoe UI'
        },
        axes:{
            xaxis:{
                renderer:$.jqplot.DateAxisRenderer, 
                rendererOptions:{
                    tickRenderer:$.jqplot.CanvasAxisTickRenderer
                },
                tickOptions:{
                    fontSize:'10pt', 
                    fontFamily:'Tahoma', 
                    formatString:'%b %#d, %#I %p',
                    angle:-40
                },
                min:'<?php echo $month;?> <?php echo $day;?>, <?php echo $year; ?> <?php echo $time; ?>',
                max:'<?php echo $month2;?> <?php echo $day2;?>, <?php echo $year2; ?> <?php echo $time2; ?>',
                tickInterval:'<?php echo $tick_interval; ?>'
            },
            yaxis: {
                min: <?php if($hum_active){
                    echo 10;
                    }
                    else{
                        echo 60;
                    }
                ?>,
                max: 100
            }
        },
        series:[{lineWidth:4, showMarker:false, color: '#FF0000', label: '<?php if($sensornumber1!='Choose sensor'){
                echo $array_names[$sensornumber1];
            }
            else if($sensornumber1=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#0008FF', label: '<?php if($sensornumber2!='Choose sensor'){
                echo $array_names[$sensornumber2];
            }
            else if($sensornumber2=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#00cc00', label: '<?php if($sensornumber3!='Choose sensor'){
                echo $array_names[$sensornumber3];
            }
            else if($sensornumber3=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#660066', label: '<?php if($sensornumber4!='Choose sensor'){
                echo $array_names[$sensornumber4];
            }
            else if($sensornumber4=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#ff66cc', label: '<?php if($sensornumber5!='Choose sensor'){
                echo $array_names[$sensornumber5];
            }
            else if($sensornumber5=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#ff6600', label: '<?php if($sensornumber6!='Choose sensor'){
                echo $array_names[$sensornumber6];
            }
            else if($sensornumber6=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#FFFF00', label: '<?php if($sensornumber7!='Choose sensor'){
                echo $array_names[$sensornumber7];
            }
            else if($sensornumber7=='Choose sensor'){ 
                echo " ";
            }?>'},
            {lineWidth:4, showMarker:false, color: '#00BFFF', label: '<?php if($sensornumber8!='Choose sensor'){
                echo $array_names[$sensornumber8];
            }
            else if($sensornumber8=='Choose sensor'){ 
                echo " ";
            }?>'},
            {lineWidth:4, showMarker:false, color: '#000000', label: '<?php if($sensornumber9!='Choose sensor'){
                echo $array_names[$sensornumber9];
            }
            else if($sensornumber9=='Choose sensor'){ 
                echo " ";
            }?>'}],
            
            
        legend:{
                show:true,
                placement: 'outsideGrid',
                background: 'white',
                textColor: 'black',
                fontFamily: 'Times New Roman',
                border: '10px solid black'
        },
        cursor:{
            show: true, 
            zoom: true
        }
    });
    });
    </script>
    
    

    
    <?php }
  
    
    // SHORT TERM PLOT
    if($start_date==$end_date){
    ?>
    
    <!-- START SCRIPT FOR LONG TERM PLOT -->
    <script type="text/javascript">
    $(document).ready(function(){
    var lines = [];
    var lines2 = [];
    var lines3 = [];
    var lines4 = [];
    var lines5 = [];
    var lines6 = [];
    var lines7 = [];
    var lines8 = [];
    var lines9 = [];
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 1st SENSOR    
    <?php
    if($sensornumber1!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[0];$j++){
            $value = $sensornumberarray1[$j][0];
            $dt = $sensornumberarray1[$j][1];
    ?>

    lines[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        } 
            
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 2nd SENSOR    
    <?php
    if($sensornumber2!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[1];$j++){
            $value = $sensornumberarray2[$j][0];
            $dt = $sensornumberarray2[$j][1];
    ?>

    lines2[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 3rd SENSOR    
    <?php
    if($sensornumber3!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[2];$j++){
            $value = $sensornumberarray3[$j][0];
            $dt = $sensornumberarray3[$j][1];
    ?>

    lines3[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 4th SENSOR    
    <?php
    if($sensornumber4!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[3];$j++){
            $value = $sensornumberarray4[$j][0];
            $dt = $sensornumberarray4[$j][1];
    ?>

    lines4[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 5th SENSOR    
    <?php
    if($sensornumber5!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[4];$j++){
            $value = $sensornumberarray5[$j][0];
            $dt = $sensornumberarray5[$j][1];
    ?>

    lines5[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 6th SENSOR    
    <?php
    if($sensornumber6!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[5];$j++){
            $value = $sensornumberarray6[$j][0];
            $dt = $sensornumberarray6[$j][1];
    ?>

    lines6[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 7th SENSOR    
    <?php
    if($sensornumber7!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[6];$j++){
            $value = $sensornumberarray7[$j][0];
            $dt = $sensornumberarray7[$j][1];
    ?>

    lines7[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 5th SENSOR    
    <?php
    if($sensornumber8!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[7];$j++){
            $value = $sensornumberarray8[$j][0];
            $dt = $sensornumberarray8[$j][1];
    ?>

    lines8[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
    ?>
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 5th SENSOR    
    <?php
    if($sensornumber9!='Choose sensor'){
        $i=0;
        for($j=0; $j<$sensor_ct[8];$j++){
            $value = $sensornumberarray9[$j][0];
            $dt = $sensornumberarray9[$j][1];
    ?>

    lines9[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $value;?>];
    <?php
        $i++;
    
        }
        }
        
        $hum_active = false;
    if($sensornumber1=='dht_hum' ||$sensornumber2=='dht_hum'||$sensornumber3=='dht_hum'||$sensornumber4=='dht_hum'||$sensornumber5=='dht_hum'||$sensornumber6=='dht_hum'||$sensornumber7=='dht_hum'||$sensornumber8=='dht_hum'||$sensornumber9=='dht_hum'){
        $hum_active = true;
    }
    ?>
        
    
     // DEFINE VARIABLES OF PLOT 
    var plot2 = $.jqplot('chart2', [lines, lines2, lines3, lines4, lines5, lines6, lines7, lines8, lines9], {
        title:{
            text: 'Raw Data',
            fontFamily: 'Segoe UI'
        },
        axes:{
            xaxis:{
                fontFamily: 'Segoe UI',
                renderer:$.jqplot.DateAxisRenderer, 
                rendererOptions:{
                    tickRenderer:$.jqplot.CanvasAxisTickRenderer
                },
                tickOptions:{
                    fontSize:'10pt', 
                    fontFamily:'Tahoma', 
                    formatString:'%b %#d, %#I %p',
                    angle:-40
                },
                min:'<?php echo $month;?> <?php echo $day;?>, <?php echo $year; ?> <?php echo $time; ?>',
                max:'<?php echo $month2;?> <?php echo $day2;?>, <?php echo $year2; ?> <?php echo $time2; ?>',
                tickInterval:'<?php echo $tick_interval; ?>'
            },
            yaxis: {
                min: <?php if($hum_active){
                    echo 10;
                    }
                    else{
                        echo 60;
                    }
                ?>,
                max: 100
            }
        },
        series:[{lineWidth:4, showMarker:false, color: '#FF0000', label: '<?php if($sensornumber1!='Choose sensor'){
                echo $array_names[$sensornumber1];
            }
            else if($sensornumber1=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#0008FF', label: '<?php if($sensornumber2!='Choose sensor'){
                echo $array_names[$sensornumber2];
            }
            else if($sensornumber2=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#00cc00', label: '<?php if($sensornumber3!='Choose sensor'){
                echo $array_names[$sensornumber3];
            }
            else if($sensornumber3=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#660066', label: '<?php if($sensornumber4!='Choose sensor'){
                echo $array_names[$sensornumber4];
            }
            else if($sensornumber4=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#ff66cc', label: '<?php if($sensornumber5!='Choose sensor'){
                echo $array_names[$sensornumber5];
            }
            else if($sensornumber5=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#ff6600', label: '<?php if($sensornumber6!='Choose sensor'){
                echo $array_names[$sensornumber6];
            }
            else if($sensornumber6=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#FFFF00', label: '<?php if($sensornumber7!='Choose sensor'){
                echo $array_names[$sensornumber7];
            }
            else if($sensornumber7=='Choose sensor'){ 
                echo " ";
            }?>'},
            {lineWidth:4, showMarker:false, color: '#00BFFF', label: '<?php if($sensornumber8!='Choose sensor'){
                echo $array_names[$sensornumber8];
            }
            else if($sensornumber8=='Choose sensor'){ 
                echo " ";
            }?>'},
            {lineWidth:4, showMarker:false, color: '#000000', label: '<?php if($sensornumber9!='Choose sensor'){
                echo $array_names[$sensornumber9];
            }
            else if($sensornumber9=='Choose sensor'){ 
                echo " ";
            }?>'}],
            
            
        legend:{
                show:true,
                placement: 'outsideGrid',
                fontFamily: 'Segoe UI',
                border: '0px solid black'
        },
        cursor:{
            show: true, 
            zoom: true
        }
    });
    });
    </script>
    
    <!-- SMOOTHED CHART -->
    <script type="text/javascript">
    $(document).ready(function(){
    var line = [];
    var line2 = [];
    var line3 = [];
    var line4 = [];
    var line5 = [];
    var line6 = [];
    var line7 = [];
    var line8 = [];
    var line9 = [];
    
    // CREATE ARRAY OUT OF DATA POINTS FOR 1st SENSOR    
    <?php
    if($sensornumber1!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray1[1][0];
        for($j=0; $j<$sensor_ct[0];$j++){
            $value = $sensornumberarray1[$j][0];
            $dt = $sensornumberarray1[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber2!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray2[1][0];
        for($j=0; $j<$sensor_ct[1];$j++){
            $value = $sensornumberarray2[$j][0];
            $dt = $sensornumberarray2[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line2[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber3!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray3[1][0];
        for($j=0; $j<$sensor_ct[2];$j++){
            $value = $sensornumberarray3[$j][0];
            $dt = $sensornumberarray3[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line3[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber4!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray4[1][0];
        for($j=0; $j<$sensor_ct[3];$j++){
            $value = $sensornumberarray4[$j][0];
            $dt = $sensornumberarray4[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line4[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber5!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray5[1][0];
        for($j=0; $j<$sensor_ct[4];$j++){
            $value = $sensornumberarray5[$j][0];
            $dt = $sensornumberarray5[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line5[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber6!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray6[1][0];
        for($j=0; $j<$sensor_ct[5];$j++){
            $value = $sensornumberarray6[$j][0];
            $dt = $sensornumberarray6[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line6[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber7!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray7[1][0];
        for($j=0; $j<$sensor_ct[6];$j++){
            $value = $sensornumberarray7[$j][0];
            $dt = $sensornumberarray7[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line7[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber8!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray8[1][0];
        for($j=0; $j<$sensor_ct[7];$j++){
            $value = $sensornumberarray8[$j][0];
            $dt = $sensornumberarray8[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line8[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    <?php
    if($sensornumber9!='Choose sensor'){
        $i=0;
        $alpha=0.1;
        $prev = $sensornumberarray9[1][0];
        for($j=0; $j<$sensor_ct[8];$j++){
            $value = $sensornumberarray9[$j][0];
            $dt = $sensornumberarray9[$j][1];
            $next = $alpha*$value + (1-$alpha)*$prev;
         ?>

    line9[<?php echo $i;?>] = ['<?php echo $dt;?>', <?php echo $next;?>];
    <?php
        $i++;
        $prev=$next;
    
        }
    }
            
    ?>
    
    var smoothed = $.jqplot('smoothed', [line, line2, line3, line4, line5, line6, line7, line8, line9], {
        title:{
            text: 'Exponentially Smoothed Data',
            fontFamily: 'Segoe UI'
        },
        axes:{
            xaxis:{
                renderer:$.jqplot.DateAxisRenderer, 
                rendererOptions:{
                    tickRenderer:$.jqplot.CanvasAxisTickRenderer
                },
                tickOptions:{
                    fontSize:'10pt', 
                    fontFamily:'Tahoma', 
                    formatString:'%b %#d, %#I %p',
                    angle:-40
                },
                min:'<?php echo $month;?> <?php echo $day;?>, <?php echo $year; ?> <?php echo $time; ?>',
                max:'<?php echo $month2;?> <?php echo $day2;?>, <?php echo $year2; ?> <?php echo $time2; ?>',
                tickInterval:'<?php echo $tick_interval; ?>'
            },
            yaxis: {
                min: <?php if($hum_active){
                    echo 10;
                    }
                    else{
                        echo 60;
                    }
                ?>,
                max: 100
            }
        },
        series:[{lineWidth:4, showMarker:false, color: '#FF0000', label: '<?php if($sensornumber1!='Choose sensor'){
                echo $array_names[$sensornumber1];
            }
            else if($sensornumber1=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#0008FF', label: '<?php if($sensornumber2!='Choose sensor'){
                echo $array_names[$sensornumber2];
            }
            else if($sensornumber2=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#00cc00', label: '<?php if($sensornumber3!='Choose sensor'){
                echo $array_names[$sensornumber3];
            }
            else if($sensornumber3=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#660066', label: '<?php if($sensornumber4!='Choose sensor'){
                echo $array_names[$sensornumber4];
            }
            else if($sensornumber4=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#ff66cc', label: '<?php if($sensornumber5!='Choose sensor'){
                echo $array_names[$sensornumber5];
            }
            else if($sensornumber5=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#ff6600', label: '<?php if($sensornumber6!='Choose sensor'){
                echo $array_names[$sensornumber6];
            }
            else if($sensornumber6=='Choose sensor'){ 
                echo " ";
            }?>'},
                {lineWidth:4, showMarker:false, color: '#FFFF00', label: '<?php if($sensornumber7!='Choose sensor'){
                echo $array_names[$sensornumber7];
            }
            else if($sensornumber7=='Choose sensor'){ 
                echo " ";
            }?>'},
            {lineWidth:4, showMarker:false, color: '#00BFFF', label: '<?php if($sensornumber8!='Choose sensor'){
                echo $array_names[$sensornumber8];
            }
            else if($sensornumber8=='Choose sensor'){ 
                echo " ";
            }?>'},
            {lineWidth:4, showMarker:false, color: '#000000', label: '<?php if($sensornumber9!='Choose sensor'){
                echo $array_names[$sensornumber9];
            }
            else if($sensornumber9=='Choose sensor'){ 
                echo " ";
            }?>'}],
            
            
        legend:{
                show:true,
                placement: 'outsideGrid',
                background: 'white',
                textColor: 'black',
                fontFamily: 'Times New Roman',
                border: '10px solid black'
        },
        cursor:{
            show: true, 
            zoom: true
        }
    });
    });
    </script>
    
    <?php
    }
    
    $sensors = array(
            1 => $sensornumber1,
            2 => $sensornumber2,
            3 => $sensornumber3,
            4 => $sensornumber4,
            5 => $sensornumber5,
            6 => $sensornumber6,
        );
        
    $legend = array(
        $sensornumber1 => "Red",
        $sensornumber2 => "Blue",
        $sensornumber3 => "Green",
        $sensornumber4 => "Purple",
        $sensornumber5 => "Pink",
        $sensornumber6 => "Orange",
        );
    ?>
    
    
    <!-- DISPLAY PLOT -->
<?php if($sensor_ct[0]>0){ ?>
    <div id="chart2" style="height:500px; width:1300px;"> </div>
    <br>
    <div id="smoothed" style="height:500px; width:1300px;"> </div>
<?php } ?>
    <!--<h5> Chart Help </h5>
    <p> Double click on graph to reset/zoom out</p>-->
    
    <!-- ALT 0176 -->
    <br>
    <table style="width:100%; inline-block;" id="metrics">
    <tr id="metrics">
        <th>Sensor</th>
        <th>Avg</th>
        <th>Max</th>
        <th>Min</th>
        <th>Avg Change</th>
        <th>Std Dev</th>
        <th>Between 1 and 2 SD</th>
        <th>Between 2 and 3 SD</th>
        <th>More than 3 SD</th>
    </tr>
     
    <?php for($m=0;$m<9;$m++){
    if($array_variables[$m]!='Choose sensor'){?>
    <tr id="metrics">
        <td> <?php echo $array_names[$array_variables[$m]]; ?> </td>
        <td> <?php echo $sensor_avg[$m]; ?> </td>
        <td> <?php echo $maxvalue[$m] . " °F occured at " . date_format($maxvaluedt[$m], 'g:ia \o\n l jS F Y');?> </td>
        <td> <?php echo $minvalue[$m] . " °F occured at " . date_format($minvaluedt[$m], 'g:ia \o\n l jS F Y');?> </td>
        <td> <?php echo $fluctuation[$m]; ?> </td>
        <td> <?php echo $sd[$m];?> </td>
        <td> <?php echo $outside1sd[$m] . " (" . number_format(($outside1sd[$m]/$sensor_ct[$m])*100,0) . "% of readings)";?></td>
        <td> <?php echo $outside2sd[$m] . " (" . number_format(($outside2sd[$m]/$sensor_ct[$m])*100,0) . "% of readings)";?></td>
        <td> <?php echo $outside3sd[$m] . " (" . number_format(($outside3sd[$m]/$sensor_ct[$m])*100,0) . "% of readings)";?></td>

    </tr>
     
    <?php }
    }
    ?>
    </table>
    
    </body>
    </html>
    