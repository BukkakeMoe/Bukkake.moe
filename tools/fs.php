<?php
	$fsFile = file_get_contents($_FILES['funScript']['tmp_name']);
	$decoded_json = json_decode($fsFile, true);
	$a = 0;
    $filename = rand(5, 9999)."_convertedFunScript.csv";
    header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
	foreach($decoded_json['actions'] as $fsPos){
		//$txt = $decoded_json['actions'][$a++]['at'].','.$decoded_json['actions'][$a]['pos']."\n";
		//fwrite($myfile, $txt);
		
		echo $decoded_json['actions'][$a++]['at'].','.$decoded_json['actions'][$a]['pos']."\n";
		}

?>