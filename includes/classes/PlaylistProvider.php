<?php
class PlaylistProvider{

	private $con, $userLoggedInObj;

	public function __construct($con, $userLoggedInObj){
		$this->con = $con;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	public function getVideos($title){
		$query = $this->con->prepare("SELECT * FROM playlists WHERE title=:title");
		$query->bindParam(":title", $title);
		$query->execute();

		$videos = array();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$video = new Video($this->con, $row, $this->userLoggedInObj);
			array_push($videos, $video);
		}

		return $videos;
	}
    public function create_playlist($title,$video){
        if(!$video == null){
        $query = $this->con->prepare("INSERT INTO playlist(user, title, videos)
        VALUES(:user, :title, :video)");		
        $query->bindParam(":title", $title);
        $query->bindParam(":title", $video);
		$query->bindParam(":user", $this->userLoggedInObj->getUsername());
		$query->execute();
        }else{
            $query = $this->con->prepare("INSERT INTO playlist(user, title)
            VALUES(:user, :title)");		
            $query->bindParam(":title", $title);
            $query->bindParam(":user", $this->userLoggedInObj->getUsername());
            $query->execute();
        }

    }
    public function get_user_playlists(){
		$query = $this->con->prepare("SELECT videos FROM playlists WHERE user:user");
		$query->bindParam(":user", $this->userLoggedInObj->getUsername());
		$query->execute();

		return $query;
        
    }

    public function add_to_playlist($title){

    }

}
?>