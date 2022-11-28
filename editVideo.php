<?php
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoDetailsFormProvider.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/SelectThumbnail.php");

if(!User::isLoggedIn()){
	header("Location: index");
}

if(!isset($_GET["videoId"])){
	echo "<div class='container' style='margin-top: 10px;'>
			No video selected
			</div>";
	exit();
}
function getIntensity($a1,$a2,$p1,$p2) {
    $slope = min(20, 1000.0 / ($a2 - $a1));
   return $slope * abs($p2 - $p1);
 }

$video = new Video($con, $_GET["videoId"], $userLoggedInObj);
if($userLoggedInObj->getUsername() == "BasicGirl"){ // Change to admin username etc, maybe add rank system in database...dumbass.

}elseif($video->getUploadedBy() != $userLoggedInObj->getUsername()){
	echo "<div class='container' style='margin-top: 10px;'>
			This is not your video
			</div>";
	exit();
}
$name = null;
$detailsMessage = "";
$intensitySum = 0;
$intensity = 0;

function intenCheck($intensity){

}
if(isset($_POST["saveButton"])){

	if($_FILES["funScript"]['size'] == 0){
		$name = $video->getScript();
	}else{
		$removedChar = preg_replace("/[^a-zA-Z0-9]+/", "", basename($_FILES["funScript"]["name"]));
		$name = str_replace('funscript','.funscript',rand(5, 9999).str_replace(' ','',$removedChar));
		$target_dir = "fs/";
		$target_file = $target_dir . $name;
		$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			if($fileType == 'csv' || 'funscript'){
				if($fileType == 'funscript'){

			$myfile = fopen($target_dir.$name.'.csv', "w") or die("Unable to open file!");
			$fsFile = file_get_contents($_FILES['funScript']['tmp_name']);
			$decoded_json = json_decode($fsFile, true);
			$a = 0;

			foreach($decoded_json['actions'] as $fsPos){
				$txt = $decoded_json['actions'][$a++]['at'].','.$decoded_json['actions'][$a]['pos']."\n";
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
			$name = $name.'.csv';
			move_uploaded_file($_FILES["funScript"]["tmp_name"], $target_file);
			}
			if($fileType == 'csv'){
				move_uploaded_file($_FILES["funScript"]["tmp_name"], $target_file);
			}
		} 
	}
	if($intensity == 0){
		$intensity = $_POST["video_intensity"];
	}
	$videoData = new VideoUploadData(
		null,
		strval($name),
		null,
		null,
		null,
		$_POST["titleInput"],
		$_POST["descriptionInput"],
		$_POST["privacyInput"],
		implode(",",$_POST["categoryInput"]),
		$userLoggedInObj->getUsername(),
		$intensity
	);

	if($videoData->updateDetails($con, $video->getId())){
		$detailsMessage = "<div class='alert alert-success'>
								<strong>SUCCESS!</strong> Details updated successfully!
							</div>";
		$video = new Video($con, $_GET["videoId"], $userLoggedInObj);
	}else{
		$detailsMessage = "<div class='alert alert-danger'>
								<strong>ERROR!</strong> Something went wrong
							</div>";
	}
}

if(isset($_POST["deleteButton"])){
	$videoData = new VideoUploadData(
		null,
		null,
		null,
		null,
		null,
		null,
		null,
		null,
		null,
		null,
		null
	);
	if($videoData->deleteVideo($con, $video->getId())){

		$vidTitle = $con->prepare("SELECT filePath FROM videos WHERE id=:videoId LIMIT 1"); 
		$vidTitle->bindParam(":videoId", $video->getId());
		$vidTitle->execute();
		$row = $vidTitle->fetch();
		$file = substr($row[0], strpos($row[0], $ftp_server[0]));

		if($file != ''){
			$filePath = $ftp_server[1].$file;
			$ftp = ftp_connect($ftp_server[2]);
			// login with username and password
			$login_result = ftp_login($ftp, $ftp_server[3], $ftp_server[4]);
			// try to delete $file
			if (ftp_delete($ftp, $filePath)) {
				//error_log('deleted '. $filePath);
			} else {
				if($filePath != $ftp_server[1]){
					error_log("could not delete $filePath");
				}
			}// close the connection
		ftp_close($ftp);
		}

		

		header("Location: index");
	}else{
		echo "<div class='container' style='margin-top: 10px;'>
				There is something error
				</div>";
	}
}

function moveFS(){

}
?>
<style>
	
.check-boxes {
  overflow:hidden;
}
.cat_label {
    width: 120px;
    display: block;
    float: left;
    cursor: pointer;
    padding: 6px 0;
    margin: 1px;
    font-size: 1em;
    overflow: hidden;
    text-align: center;
    font-weight: 400;
    background-color: #393c3d;
    color: #ddd;
}
.check-boxes label:hover{
    background-color: #db4437!important;
    color: #ddd;
}
.check-boxes input{
  display: none;
}
.check-boxes input[type=checkbox]:checked + label {
  background-color: #db4437;
  outline: 0;
}

.uppy-StatusBar-progress{background-color: #db4437;} .uppy-DragDrop-container{background-color:#393c3d;} .uppy-StatusBar-statusSecondary{color:#d1d1d1;} .uppy-StatusBar{background-color:#393c3d;} .uppy-StatusBar-statusPrimary{color:#db4437;}</style>

<script src="js/editVideoActions.js"></script>

<div class="container" style="margin-top: 20px;">
	<div class="editVideoContainer column">
		<div class="topSection">
			<?php
				$videoPlayer = new VideoPlayer($video);
				echo $videoPlayer->create(false);

				$selectThumbnail = new SelectThumbnail($con, $video);
				echo $selectThumbnail->create();
			?>
		</div>
		<div class="message">
			<?php echo $detailsMessage; ?>
		</div>
		<div class="bottomSection" style="margin-bottom: 20px;">
			<?php
				$formProvider = new VideoDetailsFormProvider($con);
				echo $formProvider->createEditDetailsForm($video);
			?>
		</div>
	</div>
</div>
<script>

$('input[type=checkbox]').change(function(e){
   if ($('input[type=checkbox]:checked').length > 8) {
        $(this).prop('checked', false)
        
   }
})

function selectCat(cat){
	$('input[type=checkbox][value="' + cat + '"]').prop('checked',true);

}
</script>
<?php
$video2 = new Video($con, $_GET["videoId"], $userLoggedInObj);
foreach ($video->getCategory() as $value) {
	if (preg_match("/^\d+$/", $value)) {
    echo "<script>selectCat($value);</script>";

	}
}



require_once("includes/footer.php");
?>