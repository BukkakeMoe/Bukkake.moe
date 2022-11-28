<?php
$videoGrid = new VideoGrid($con, $userLoggedInObj->getUsername());

    if (isset($_GET['cat'])) {
        $cat = $_GET['cat'];
    } else {
        $cat = 0;
    }
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    if($_GET["orderBy"] == "views"){
        $orderBy = "views";
        $acendORdecend = 'DESC';
    }
    if($_GET["orderBy"] == "-views"){
        $orderBy = "views";
        $acendORdecend = 'ASC';
    }
    if($_GET["orderBy"] == "intensity"){
        $orderBy = "intensity+0";
        $acendORdecend = 'DESC';
    }
    if($_GET["orderBy"] == "-intensity"){
        $orderBy = "intensity+0";
        $acendORdecend = 'ASC';
    }
    //Upload Date
    if($_GET["orderBy"] == "ascending"){
        $orderBy = "uploadDate";
        $acendORdecend = 'ASC';
    }

    if($_GET["orderBy"] == "decending"){
        $orderBy = "uploadDate";
        $acendORdecend = 'DESC';
    }
    //EndUpload date
    //Duration
    if($_GET["orderBy"] == "d-l"){
        $orderBy = "duration";
        $acendORdecend = 'DESC';
    }
    if($_GET["orderBy"] == "d-s"){
        $orderBy = "duration";
        $acendORdecend = 'ASC';
    }
    //End Duration
    if(!isset($_GET["orderBy"])){
        $orderBy = "uploadDate";
        $acendORdecend = 'DESC';
    }

    
    $queryCat = $con->prepare("SELECT name FROM categories WHERE id=:id");
    $queryCat->bindParam(":id", $cat);
    $queryCat->execute();

    $catName = $queryCat->fetchColumn();
    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;

    if($_COOKIE['gayContent'] == 'enabled'){
        $sqlCount = "SELECT COUNT(*) FROM videos WHERE privacy='0' AND FIND_IN_SET('$cat',category)";
        $sqlQuery = "SELECT * FROM videos WHERE privacy='0' AND FIND_IN_SET('$cat',category) ORDER BY $orderBy $acendORdecend LIMIT $offset, $no_of_records_per_page";
    }else{
        $sqlCount = "SELECT COUNT(*) FROM videos WHERE privacy='0' AND FIND_IN_SET('$cat',category) and category not like '%13%'";
        $sqlQuery = "SELECT * FROM videos WHERE privacy='0' AND FIND_IN_SET('$cat',category) and category not like '%13%' ORDER BY $orderBy $acendORdecend LIMIT $offset, $no_of_records_per_page";
    }

    $result = $con->prepare($sqlCount);
	$result->execute();
    
    $total_rows = $result->fetch(PDO::FETCH_BOTH)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $videos = array();

    $query = $con->prepare($sqlQuery);
	$query->execute();
    While($row = $query->fetch(PDO::FETCH_ASSOC)){
        $video = new Video($con, $row, $userLoggedInObj);
        array_push($videos, $video);
    }
    if(count($videos) > 0 ){
    echo $videoGrid->create($videos, $catName." - Page ".$pageno, true);
	}else{
        echo '<p>No Videos</p>';
    }
?>