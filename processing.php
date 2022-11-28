<?php
require_once("includes/header.php");
require_once("includes/footer.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/VideoProcessor.php");

if(!isset($_POST["uploadButton"])){
	echo "No file sent to the page";
	exit();
}

function getIntensity($a1,$a2,$p1,$p2) {
    $slope = min(20, 1000.0 / ($a2 - $a1));
   return $slope * abs($p2 - $p1);
 }

$target_dir = "fs/";
$removedChar = preg_replace("/[^a-zA-Z0-9]+/", "", basename($_FILES["funScript"]["name"]));
$name = str_replace('funscript','.funscript',rand(5, 9999).str_replace(' ','',$removedChar));
/*$name = rand(5, 9999).str_replace(' ','',basename($_FILES["funScript"]["name"]));*/
$target_file = $target_dir . $name;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($fileType == 'csv' || 'funscript'){
if($fileType == 'funscript'){

	$myfile = fopen($target_dir.$name.'.csv', "w") or die("Unable to open file!");
	$fsFile = file_get_contents($_FILES['funScript']['tmp_name']);
	$decoded_json = json_decode($fsFile, true);
	$a = 0;
    $intensitySum = 0;
    $intensity = 0;
	foreach($decoded_json['actions'] as $fsPos){
		$txt = $decoded_json['actions'][$a]['at'].','.$decoded_json['actions'][$a]['pos']."\n";
		fwrite($myfile, $txt);

        $firstPos = (int)$decoded_json['actions'][$a]['pos'];
        $secondPos = (int)$decoded_json['actions'][$a-1]['pos'];
        $firstAct = (int)$decoded_json['actions'][$a]['at'];
        $secondAct = (int)$decoded_json['actions'][$a-1]['at'];
        if($secondAct < $firstAct){
        $temp = $secondAct;
        $secondAct = $firstAct;
        $firstAct = $temp;
        }
        $intensitySum += getIntensity($firstAct,$secondAct,$firstPos,$secondPos);
        $a++;
        if($a == count($decoded_json['actions'])){
            $intensity = round($intensitySum / count($decoded_json['actions']));
            
          }
		//echo $decoded_json['actions'][$a++]['at'].','.$decoded_json['actions'][$a]['pos'];
		}
	fclose($myfile);
    move_uploaded_file($_FILES["funScript"]["tmp_name"], $target_file);
	$videoUploadData = new VideoUploadData($_POST["video_url"],$name.'.csv', $_POST["video_thumbnail"], $_POST["cloud_id"], $_POST["duration"], $_POST["titleInput"], $_POST["descriptionInput"], $_POST["privacyInput"], implode(",",$_POST["categoryInput"]), $userLoggedInObj->getUsername(),$intensity);

}
if($fileType == 'csv'){
	move_uploaded_file($_FILES["funScript"]["tmp_name"], $target_file);
	$videoUploadData = new VideoUploadData($_POST["video_url"],$name, $_POST["video_thumbnail"], $_POST["cloud_id"], $_POST["duration"], $_POST["titleInput"], $_POST["descriptionInput"], $_POST["privacyInput"], implode(",",$_POST["categoryInput"]), $userLoggedInObj->getUsername(),0);

}


//1) create file upload data

//2) process video data (upload)
$videoProcessor = new VideoProcessor($con);
$wasSuccessful = $videoProcessor->upload($videoUploadData);

//3) check if upload was successful
if($wasSuccessful){
	//echo "Upload successful";
	echo "<div class='container' style='margin-top: 10px;'>
			Video has been successfully uploaded.
			</div>"
	;
			
if($_POST["privacyInput"] == 0){
$webhookurl = "https://discord.com/api/webhooks";

//=======================================================================================================
// Compose message. You can use Markdown
// Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
//========================================================================================================

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([
    // Message
    
    // Username
    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    "embeds" => [
        [
            // Embed Title
            "title" =>  $_POST["titleInput"],

            // Embed Type
            "type" => "rich",

            // Embed Description
            "description" => $_POST["descriptionInput"],

            // URL of title link
            "url" => "https://bukkake.moe",

            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,

            // Embed left border color in HEX
            "color" => hexdec( "3366ff" ),

            // Footer
            "footer" => [
                "text" => "Bukkake.Moe",
                "icon_url" => "https://bukkake.moe"
            ],

            // Image to send
            "image" => [
                "url" => $_POST["video_thumbnail"]
            ],

            // Thumbnail
            //"thumbnail" => [
            //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
            //],

        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
curl_close( $ch );
}
}
}else{
	echo "<div class='container' style='margin-top: 10px;'>
			Fuuuck, thats not a script man. thats a $fileType
			</div>";
}

?>
