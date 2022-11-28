<?php
class VideoGridItem{

	private $video, $largeMode;

	public function __construct($video, $largeMode){
		$this->video = $video;
		$this->largeMode = $largeMode;
	}

	public function create(){
		$thumbnail = $this->createThumbnail();
		$details = $this->createDetails();
		$url = "watch?id=" . $this->video->getId();

		return "<a href='$url'>
					<div class='videoGridItem'>
						$thumbnail
						$details
					</div>
				</a>";
	}

	private function createThumbnail(){
		$thumbnail = $this->video->getThumbnail();
		$duration = $this->video->getDuration();
		$title = $this->video->getTitle();
		$duration = substr($duration, 0, strpos($duration, "."));
		$intensity = '';
		if($this->video->getIntensity() != ''){
			if($this->video->getIntensity() < 150){
				$intensity = '<span class="intensity-low">' . $this->video->getIntensity() . '</span>';
			}else if($this->video->getIntensity() < 250){
				$intensity = '<span class="intensity-low-medium">' . $this->video->getIntensity() . '</span>';
			}else if ($this->video->getIntensity() < 350){
				$intensity = '<span class="intensity-medium">' . $this->video->getIntensity() . '</span>';
			}else{
				$intensity = '<span class="intensity-high">' . $this->video->getIntensity() . '</span>';
			}
			//$intensity = "<div class='intensity'> <span>".$this->video->getIntensity()."</span> </div>";
		}
		return "<div class='thumbnail'>
					<img src='$thumbnail'>
					<div class='duration'>
                        <span>$duration</span>
                    </div>
					$intensity
					
					
				</div>";
	}

	private function createDetails(){
		$title = $this->video->getTitle();
		$username = $this->video->getUploadedBy();
		$views = $this->video->getViews();
		$description = $this->createDescription();
		$timeStamp = $this->video->getTimeStamp();

		return "<div class='details'>
					<h3 class='title'>$title</h3>
					<span class='username'>$username</span>
					<div class='stats'>
						<span class='viewCount'>$views views - </span>
						<span class='timeStamp'>$timeStamp</span>
					</div>
					$description
				</div>";
	}

	private function createDescription(){
		if(!$this->largeMode){
			return "";
		}else{
			$description = $this->video->getDescription();
			$description = (strlen($description) > 350) ? substr($description, 0, 347) . "..." : $description;
			return "<span class='description'>$description</span>";
		}
	}
}
?>