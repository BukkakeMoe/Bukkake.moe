<?php
class VideoUploadData{

	public $videoDataArray, $title, $funScript, $description, $privacy, $category, $uploadedBy,$intensity;

	public function __construct($videoUrl, $funScript, $videoThumbnail, $videoCloudId, $duration, $title, $description, $privacy, $category, $uploadedBy,$intensity){
		$this->videoUrl = $videoUrl;
		$this->funScript = $funScript;
		$this->videoThumbnail = $videoThumbnail;
		$this->videoCloudId = $videoCloudId;
		$this->duration = $duration;
		$this->title = $title;
		$this->description = $description;
		$this->privacy = $privacy;
		$this->category = $category;
		$this->uploadedBy = $uploadedBy;
		$this->intensity = $intensity;
	}

	public function updateDetails($con, $videoId){
		$query = $con->prepare("UPDATE videos SET title=:title, funScript=:funScript, description=:description, privacy=:privacy, category=:category,intensity=:intensity WHERE id=:videoId");
		$query->bindParam(":title", $this->title);
		$query->bindParam(":funScript", $this->funScript);
		$query->bindParam(":description", $this->description);
		$query->bindParam(":privacy", $this->privacy);
		$query->bindParam(":category", $this->category);
		$query->bindParam(":videoId", $videoId);
		$query->bindParam(":intensity", $this->intensity);


		return $query->execute();
	}

	public function deleteVideo($con, $videoId){
		$vidTitle = $con->prepare("SELECT filePath FROM videos WHERE id=:videoId LIMIT 1"); 
		$vidTitle->bindParam(":videoId", $videoId);
		$vidTitle->execute();
		$row = $vidTitle->fetch();
		$fsFile = $con->prepare("SELECT funScript FROM videos WHERE id=:videoId LIMIT 1"); 
		$fsFile->bindParam(":videoId", $videoId);
		$fsFile->execute();
		$fsItem = $fsFile->fetch();

		if (unlink($_SERVER['DOCUMENT_ROOT']."/fs/".$fsItem[0])) {
		}
		if (unlink($_SERVER['DOCUMENT_ROOT']."/fs/".str_replace('.csv','',$fsItem[0]))) {
		}
		
		$file = substr($row[0], strpos($row[0], 'videos/'));
		if($file != ''){
		$filePath = '/var/www/html/'.$file;
		$ftp = ftp_connect('162.212.152.67');
		// login with username and password
		$login_result = ftp_login($ftp, 'root', '1L3Zi1Px8VhQ5b7tFp');
		// try to delete $file
		if (ftp_delete($ftp, $filePath)) {
			//error_log('deleted '. $filePath);
		} else {
			if($filePath != '/var/www/html/'){
				error_log("could not delete $filePath");
			}
		}
	}
		// close the connection
		ftp_close($ftp);

		$query = $con->prepare("DELETE FROM videos WHERE id=:videoId");
		$query->bindParam(":videoId", $videoId);
		$query2 = $con->prepare("DELETE FROM thumbnails WHERE videoId=:videoId");
		$query2->bindParam(":videoId", $videoId);
		$query3 = $con->prepare("DELETE FROM likes WHERE videoId=:videoId");
		$query3->bindParam(":videoId", $videoId);
		$query4 = $con->prepare("DELETE FROM dislikes WHERE videoId=:videoId");
		$query4->bindParam(":videoId", $videoId);
		$query5 = $con->prepare("DELETE FROM comments WHERE videoId=:videoId");
		$query5->bindParam(":videoId", $videoId);

		$query2->execute();
		$query3->execute();
		$query4->execute();
		$query5->execute();
		
		return $query->execute();
	}

}

?>