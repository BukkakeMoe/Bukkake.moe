<?php

class VideoPlayer{

	private $video;

	public function __construct($video){
		$this->video = $video;
	}

	public function create($autoplay){

		if($autoplay){
			$autoplay = "autoplay";
		} else{
			$autoplay = "";
		}

		$filePath = $this->video->getFilePath();

		//return "<iframe src='$filePath' allow='accelerometer; $autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";

		//or return "<video class='videoPlayer' oncontextmenu='return false;' controls $autoplay id='vid'>

		return "<video controls id='bukkakePlayer'>
					<source src='$filePath' type='video/mp4' />
				</video>
				"
				;
	}
	public function createVR($autoplay){

		if($autoplay){
			$autoplay = "autoplay";
		} else{
			$autoplay = "";
		}

		$filePath = $this->video->getFilePath();

		//return "<iframe src='$filePath' allow='accelerometer; $autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";

		//or return "<video class='videoPlayer '  oncontextmenu='return false;' controls $autoplay id='vid'>
		return "<dl8-video id='bukkakePlayer' format='STEREO_180_LR'>
			<source src='$filePath' type='video/mp4' />
		</dl8-video>
		";
	}
}

?>