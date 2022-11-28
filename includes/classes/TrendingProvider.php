<?php
class TrendingProvider{
	private $con, $userLoggedInObj;

	public function __construct($con, $userLoggedInObj){
		$this->con = $con;
		$this->userLoggedInObj = $userLoggedInObj;
		if($_COOKIE['gayContent'] == 'enabled'){
			$this->sql30  = "SELECT * FROM videos WHERE privacy='0' AND uploadDate >= now() - INTERVAL 30 DAY ORDER BY views DESC LIMIT 10";
			$this->sql7 = "SELECT * FROM videos WHERE privacy='0' AND uploadDate >= now() - INTERVAL 7 DAY ORDER BY views DESC LIMIT 10";
			$this->sqlNew ="SELECT * FROM videos WHERE privacy='0' ORDER BY id DESC LIMIT 10";
		}else{
			$this->sql30 = "SELECT * FROM videos WHERE privacy='0' AND category not like '%13%' AND uploadDate >= now() - INTERVAL 30 DAY ORDER BY views DESC LIMIT 10";
			$this->sql7 = "SELECT * FROM videos WHERE privacy='0' AND category not like '%13%' AND uploadDate >= now() - INTERVAL 7 DAY ORDER BY views DESC LIMIT 10";
			$this->sqlNew ="SELECT * FROM videos WHERE privacy='0' AND category not like '%13%' ORDER BY id DESC LIMIT 10";
		}
	}

	public function getVideos30(){
		$videos = array();

		$query = $this->con->prepare($this->sql30);
		$query->execute();

		While($row = $query->fetch(PDO::FETCH_ASSOC)){
			$video = new Video($this->con, $row, $this->userLoggedInObj);
			array_push($videos, $video);
		}

		return $videos;
	}
	public function getVideos7(){
		$videos = array();

		$query = $this->con->prepare($this->sql7);
		$query->execute();

		While($row = $query->fetch(PDO::FETCH_ASSOC)){
			$video = new Video($this->con, $row, $this->userLoggedInObj);
			array_push($videos, $video);
		}

		return $videos;
	}
	public function getNewVideos(){
		$videos = array();

		$query = $this->con->prepare($this->sqlNew);
		$query->execute();

		While($row = $query->fetch(PDO::FETCH_ASSOC)){
			$video = new Video($this->con, $row, $this->userLoggedInObj);
			array_push($videos, $video);
		}
		
		return $videos;
	}
}
?>