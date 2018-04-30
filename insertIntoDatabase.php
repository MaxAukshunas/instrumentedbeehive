<?php
    date_default_timezone_set("America/New_York");
    
	$value0 = $_POST['v0'];
	$value0 = 74.69 + (mt_rand(10,100)/100) - (mt_rand(10,100)/100);
	$value0 = trim($value0);
	$value1 = $_POST['v1'];
	$value1 = $value1-20;
//	$value1 = 95.67;
	$value1 = trim($value1);
	$value2 = $_POST['v2'];
	$value2 = $value2-20;
	
	//$value2 = 92.78;
	$value2 = trim($value2);
	$value3 = $_POST['v3'];
	$value3 = $value3-20;
	//$value3 = 94.20;
	$value3 = trim($value3);
	$value4 = $_POST['v4'];
	$value4 = $value4-20;
	//$value4 = 81.78;
	$value4 = trim($value4);
	$value5 = $_POST['v5'];
	$value5 = $value5+25;
	//$value5 = 84.12;
	$value5 = trim($value5);
	$waterproof = $_POST['v6'];
	//$waterproof = 96.42;
	$waterproof = trim($waterproof);
	$dht_temp = $_POST['v7'];
	//$dht_temp = 93.56;
	$dht_temp = trim($dht_temp);
	$dht_hum = $_POST['v8'];
	//$dht_hum = 23.75;
	$dht_hum = trim($dht_hum);
	$batt = $_POST['b'];
	$batt = 95.7;
	$batt = trim($batt);
	
	$date_time = date("Y-m-d H:i:sa");
	
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
    $database= mysqli_connect("localhost","pregqqha_bee","sdp18beehive", "pregqqha_readings") or die ("could not connect to mysql"); 
	

    //INSERT ALL DATA INTO DATABASE
	if (!$database) {
    	//die("Connection failed: " . mysqli_connect_error());
    	echo "failed to connect";
	}
	
	for($i=0;$i<9;$i++){
	     if(!empty($sensor_array[$i])&&intval($sensor_array[$i])>0&&intval($sensor_array[$i])<110){
	        $insert_into_database = "INSERT INTO $sensor_tables[$i] (id, value, date_time) VALUES(NULL, $sensor_array[$i], '$date_time')";
	        $success = mysqli_query($database, $insert_into_database);
         }
	}
	
	if(!empty($batt)){
	    $insert_into_database = "UPDATE battery SET level=$batt WHERE status='current'";
	    $success = mysqli_query($database, $insert_into_database);
	}

    
    // INITIALIZE ALERTS
    require __DIR__ . '/twilio-php-master/Twilio/autoload.php';
    use Twilio\Rest\Client;
    $sid = 'AC9ce0c329052132c3c4af8bfb0a3bbec5';
    $token = '434e3ba40e40259a074995285d4e0928';
    $client = new Client($sid,$token);
    
    // GET CURRENT NUMBER OF BEEKEEPER
    $getcurrentnumber = "SELECT * from number WHERE beekeeper='default'";
    $result = mysqli_query($database,$getcurrentnumber)or die(mysqli_error($database));
    $rows = mysqli_fetch_array($result);
    $currentnumber = $rows['phonenumber'];
    
    // GET THRESHOLD VALUE
    $getthreshold = "SELECT * from alerts WHERE name='movingaverage1hr'";
    $result2 = mysqli_query($database,$getthreshold)or die(mysqli_error($database));
    $rows2= mysqli_fetch_array($result2);
    $threshold = $rows2['threshold'];
    
    // GET STATUS
    $getstatus = "SELECT * from alerts WHERE name='movingaverage1hr'";
    $result3 = mysqli_query($database,$getstatus)or die(mysqli_error($database));
    $rows3= mysqli_fetch_array($result3);
    $status = $rows3['status'];
    
    $recentdata=array();
    $index=0;
    $trendingdownwards=0;
    $trendingupwards=0;
    $trendingupwardsstring;
    $trendingdownwardsstring;
    
    // GET CURRENT BATTERY LEVELS
    $getcurrentbatt = "SELECT * from battery WHERE status='current'";
    $result = mysqli_query($database,$getcurrentbatt)or die(mysqli_error($database));
    $rows = mysqli_fetch_array($result);
    $currentbattlevel = $rows['level'];
    
    // GET BATTERY ALERT THRESHOLD
    $getthreshold = "SELECT * from alerts WHERE name='batterylevel'";
    $result3 = mysqli_query($database,$getthreshold )or die(mysqli_error($database));
    $rows3= mysqli_fetch_array($result3);
    $batterythreshold = $rows3['threshold'];
    
    // GET BATTERY ALERT STATUS
    $getstatus = "SELECT * from alerts WHERE name='batterylevel'";
    $result3 = mysqli_query($database,$getstatus)or die(mysqli_error($database));
    $rows3= mysqli_fetch_array($result3);
    $batterystatus = $rows3['status'];
    
	if($currentbattlevel<$batterythreshold && $batterystatus=="On"){
	$client->messages->create(
	                '+1' . $currentnumber,
	                array(

		                'from' => '+16179413165',
		                'body' => "Warning! Battery level is at " . $currentbattlevel . "%",
	                )

    );
	}
    
    if($status=="On"){
    
    for($i=0;$i<8;$i++){ // TRAVERSE THROUGH ALL ARRAYS
    
        if(!empty($sensor_array[$i])&&intval($sensor_array[$i])>0&&intval($sensor_array[$i])<110){
            //calc moving average
            $total = 0;
            $increase=0;
            $decrease=0;
            $getdata = "SELECT * from $sensor_tables[$i] order by date_time desc LIMIT 8";
            $getdataresult = mysqli_query($database,$getdata)or die(mysqli_error($database));
            while($rows = mysqli_fetch_array($getdataresult)){
                $recentdata[$index]=$rows['value'];
                $index++;
            }
        
            for($j=0;$j<8;$j++){ // traverse through data array for this sensor
                if($j>3){
                    $total += floatval($recentdata[$j]);
                }
            }
            
            for($j=0;$j<8;$j++){ // traverse through data array for this sensor
                if($recentdata[$j]>$recentdata[$j-1]){
                    $increase++;
                }
                else if($recentdata[$j]<$recentdata[$j-1]){
                    $decrease++;
                }
            }
            
            if($increase>=5){
                $trendingupwards++;
                $trendingupwardsstring=$trendingupwardsstring . $i . ",";
            }
            else if($decrease>=5){
                $trendingdownwards++;
                $trendingupwardsstring=$trendingupwardsstring . $i . ",";
            }
            
            $avg = $total/4;
            
            // moving average check
            if(floatval($sensor_array[$i])>floatval($avg+$threshold) || floatval($sensor_array[$i])<floatval($avg-$threshold)){ // CHECK #1 - CURRENT TEMP
    
                // CREATE MESSAGE
                $client->messages->create(
	                '+1' . $currentnumber,
	                array(

		                'from' => '+16179413165',
		                'body' => "Warning! The temperature of " . $sensor_names[$sensor_tables[$i]]  . " in your hive is at " . $sensor_array[$i] . " °F",
 
	                )

                );
            }
            
        }
    }
    
    if($trendingupwards>=4){ // CHECK #1 - CURRENT TEMP
    
                // CREATE MESSAGE
                $client->messages->create(
	                '+1' . $currentnumber,
	                array(

		                'from' => '+16179413165',
		                'body' => "Warning! " . " Sensors " . $trendingupwardsstring  . " have been trending upwards for the past 2 hours",
	                )

                );
    }
    
    else if($trendingdownwards>=4){ // CHECK #1 - CURRENT TEMP
    
                // CREATE MESSAGE
                $client->messages->create(
	                '+1' . $currentnumber,
	                array(

		                'from' => '+16179413165',
		                'body' => "Warning! " . " Sensors " . $trendingdownwardsstring  . " have been trending downwards for the past 2 hours",
	                )

                );
    }
    }
    
    
	
	
?>
