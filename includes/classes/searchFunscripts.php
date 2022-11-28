<?php
require_once('../config.php');
require_once('Video.php');
require_once('SelectThumbnail.php');
require_once('VideoGridItem.php');
require_once("VideoGrid.php");
require_once("User.php");


$removedChar = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['funscript']);
$name = str_replace(' ','',$removedChar);
$name = $_POST['funscript'];
$sql_q = "SELECT * FROM videos WHERE funScript LIKE '%$name%'";
$result = $con->prepare($sql_q);
$result->execute();


$row = $result->fetch(PDO::FETCH_ASSOC);
    $queryThumb = $con->prepare("SELECT * FROM thumbnails WHERE videoId=:videoId");
    $queryThumb->bindParam(":videoId", $videoId);
    $videoId = $row['id'];
    $queryThumb->execute();
    $thumbnail = $queryThumb->fetch(PDO::FETCH_ASSOC);
    $video = new Video($con, $row,$userLoggedInObj);
    $item = new VideoGridItem($video, false);
    $elementsHtml .= $item->create();
    if($videoId != null) {
        echo $elementsHtml;

    }
?>