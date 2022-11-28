<?php
require_once("includes/classes/ButtonProvider.php"); 
class VideoInfoControls {

    private $video, $userLoggedInObj;

    public function __construct($video, $userLoggedInObj) {
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {

        $likeButton = $this->createLikeButton();
        $dislikeButton = $this->createDislikeButton();
        $views = $this->video->getViews();
        $numComments = $this->video->getNumberOfComments();
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return "<div class='post-meta d-flex align-items-center'>
                    <a id='fsDownload' href='#'><i class='fa fa-download' aria-hidden='true'></i> Save Script</a>
                    <a href='https://bukkake.moe/report?id=".$this->video->getId()."' onClick=''><i class='fa fa-flag' aria-hidden='true'></i> Report</a>
					<a href='#'><i class='fa fa-eye' aria-hidden='true'></i> $views views</a>
					$likeButton
                    $dislikeButton
				</div>
			


				";
    }

    private function createLikeButton() {
    	$text = $this->video->getLikes();
    	$videoId = $this->video->getId();
    	$action = "likeVideo(this, $videoId)";
    	$class = "likeButton";

    	$imageSrc = "img/icons/thumb-up.png";

    	if($this->video->wasLikedBy()){
    		$imageSrc = "img/icons/thumb-up-active.png";
    	}


        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }

    private function createDislikeButton() {
        $text = $this->video->getDislikes();
    	$videoId = $this->video->getId();
    	$action = "dislikeVideo(this, $videoId)";
    	$class = "dislikeButton";

    	$imageSrc = "img/icons/thumb-down.png";

    	if($this->video->wasDislikedBy()){
    		$imageSrc = "img/icons/thumb-down-active.png";
    	}


        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }
}
?>