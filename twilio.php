<?php

$newnumber = $_POST['number'];
$movingavgthresh = $_POST['movingaverage'];
$status = $_POST['status'];
$newbattery = $_POST['batterylevel'];
$newbattstatus = $_POST['status2'];
$url = 'http://www.instrumentedbeehive.website/homepage.php';
     require __DIR__ . '/twilio-php-master/Twilio/autoload.php';

    use Twilio\Rest\Client;

    $sid = 'AC9ce0c329052132c3c4af8bfb0a3bbec5';
    $token = '434e3ba40e40259a074995285d4e0928';
    $client = new Client($sid,$token);


// CONNECT TO DATABASE
$database= mysqli_connect("localhost","pregqqha_bee","sdp18beehive", "pregqqha_readings") or die ("could not connect to mysql"); 

if(!empty($movingavgthresh)){
    $changemovingavg = "UPDATE alerts SET threshold = $movingavgthresh WHERE name = 'movingaverage1hr'";
    $success = mysqli_query($database, $changemovingavg);
}

if(!empty($status)){
    $status=trim($status);
    $changestatus = "UPDATE alerts SET status = '$status' WHERE name = 'movingaverage1hr'";
    $success2 = mysqli_query($database, $changestatus);
}

if(!empty($newbattstatus)){
    $newbattstatus=trim($newbattstatus);
    $changestatus2 = "UPDATE alerts SET status = '$newbattstatus' WHERE name = 'batterylevel'";
    $success3 = mysqli_query($database, $changestatus2);
}

if(!empty($newbattery)){
    $newbattery=trim($newbattery);
    $changebatterylevel = "UPDATE alerts SET threshold = $newbattery WHERE name = 'batterylevel'";
    $success4 = mysqli_query($database, $changebatterylevel);
}

    if($success2 || $success || $success3 || $success4){
        header( "Location: $url" );
    }



// CHANGE NUMBER IF FORM HAS BEEN FILLED OUT
if(!empty($newnumber)){
     
    $changenumber = "UPDATE number SET phonenumber = $newnumber WHERE beekeeper = 'default'";
	$success = mysqli_query($database, $changenumber);

	if($success){
			//echo "You should be receiving a test text message shortly.";
			$client->messages->create(
	        '+1' . $newnumber,
        	array(
		        'from' => '+16179413165',
		        'body' => "This is a test alert."
	        )
            );
			}
			else{
				echo "Couldn't change number, you probably entered your number in the wrong form.";
			}
    }
    if($success){
        header( "Location: $url" );
    }

?>

 <!-- NAVIGATE BACK TO CHART CONFIG PAGE -->
    <form>
    <input type="button" value="GO BACK TO CHART CONFIG" onclick="window.location.href='http://www.instrumentedbeehive.website/homepage.php'" />
    </form>
