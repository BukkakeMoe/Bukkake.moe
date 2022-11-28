<?php
class VideoGrid{

	private $con, $userLoggedInObj;
	private $largeMode = false;
	private $gridClass2 = "single-widget mb-20 videoGrid";

	public function __construct($con, $userLoggedInObj){
		$this->con = $con;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	public function create($videos, $title, $showFilter){

		if($videos == null){

			$gridItems = $this->generateItems();

		}else{
			$gridItems = $this->generateItemsFromVideos($videos);
		}

		$header = "";

		if($title != null){
			$header = $this->createGridHeader($title, $showFilter);
		}

		return "$header
				<div class='$this->gridClass2'>
					$gridItems
				</div>";
	}

	public function generateItems(){
		$query = $this->con->prepare("SELECT * FROM videos WHERE privacy='0' ORDER BY RAND() LIMIT 10");
		$query->execute();

		$elementsHtml = "";

		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$video = new Video($this->con, $row, $this->userLoggedInObj);
			$item = new VideoGridItem($video, $this->largeMode);
			$elementsHtml .= $item->create();
		}

		return $elementsHtml;
	}

	public function generateItemsFromVideos($videos){
		$elementsHtml = "";

		foreach($videos as $video){
			$item = new VideoGridItem($video, $this->largeMode);
			$elementsHtml .= $item->create();
		}
		return $elementsHtml;
	}


	public function createGridHeader($title, $showFilter){
		$filter = "";

        if($showFilter){
        	$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        	$urlArray = parse_url($link);
        	$query = $urlArray["query"];

        	parse_str($query, $params);

        	unset($params["orderBy"]);

        	$newQuery = http_build_query($params);

        	$newUrl = basename($_SERVER["PHP_SELF"]) . "?" . $newQuery;
			$lengthVar = "<a href='$newUrl&orderBy=d-l'>Duration</a>";
			$intensityVar = "<a href='$newUrl&orderBy=intensity'>Intensity</a>";
			$viewVar = "<a href='$newUrl&orderBy=views'>Most viewed</a>";
			if($_GET["orderBy"] == "views"){
				$viewVar = "<a href='$newUrl&orderBy=-views'>Most viewed <i class='fa-solid fa-arrow-up'></i></a>";
			}
			if($_GET["orderBy"] == "-views"){
				$viewVar = "<a href='$newUrl&orderBy=views'>Least viewed <i class='fa-solid fa-arrow-down'></i></a>";
			}
			if($_GET["orderBy"] == "intensity"){
				$intensityVar = "<a href='$newUrl&orderBy=-intensity'>Intensity <i class='fa-solid fa-arrow-up'></i></a>";
			}
			if($_GET["orderBy"] == "-intensity"){
				$intensityVar = "<a href='$newUrl&orderBy=intensity'>Intensity <i class='fa-solid fa-arrow-down'></i></a>";
			}

			if($_GET["orderBy"] == "d-l"){
				$lengthVar = "<a href='$newUrl&orderBy=d-s'>Duration <i class='fa-solid fa-arrow-up'></i></a>";
			}
			if($_GET["orderBy"] == "d-s"){
				$lengthVar = "<a href='$newUrl&orderBy=d-l'>Duration <i class='fa-solid fa-arrow-down'></i></a>";
			}
			
			$advanced = "<div class='row justify-content-center' style='display:none;margin-top: 20px;'>

			<div class='right' style='display:none;'>
			<input type='number' id='min' name='min'>
			<input type='number' id='max' name='max'>	
			<input type='button' value='Filter' onclick='filter()'>
			</div>
			</div>";

        	$filter = "<div class='right'>
							<span>Order by:</span>
							<a href='$newUrl&orderBy=decending'>Newest</a>
							<a href='$newUrl&orderBy=ascending'>Oldest</a>
							$intensityVar
							$viewVar
							$lengthVar
							$advanced
        				</div>";

			
        }

        return "<div class='videoGridHeader'>
                        <div class='left'>
                            $title
                        </div>
                        $filter
                    </div>";
	}

	public function createLarge($videos, $title, $showFilter){
		$this->gridClass2 .= " large";
		$this->largeMode = true;
		return $this->create($videos, $title, $showFilter);
	}
}


?>