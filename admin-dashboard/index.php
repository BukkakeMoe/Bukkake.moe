<?php 
require_once __DIR__."/../includes/config.php";  
require_once __DIR__."/../includes/classes/Video.php"; 
require_once __DIR__."/../includes/classes/VideoUploadData.php"; 
require_once __DIR__."/../includes/classes/User.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if(!User::isLoggedIn()){
	header("Location: ../404");
}else{
$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $usernameLoggedIn);
}
if($userLoggedInObj->getUsername() == "BasicGirl"){

}else{
	header("Location: ../404.php");
}
if( isset($_POST['videoID']) ){
$videoData = new VideoUploadData(
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null
);
foreach($_POST['videoID'] as $v){
    $videoData->deleteVideo($con,$v);
}}


?>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet"/>
</head>
<style>

.text {
   overflow: hidden;
   text-overflow: ellipsis;
   max-width: 13ch;
   -webkit-line-clamp: 2; /* number of lines to show */
}
/*.table-responsive {
    max-height:80%;
    max-width: 50%;
}*/
.my-custom-scrollbar {
position: relative;
height: 31vw;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
</style>
<body>
  

<div class="container">
<form method="post">
    <input type="text" id="searchInput" onkeyup="search()" placeholder="Search.." title="search">
    <input id='deleteBut' class="btn btn-primary" type="submit" name="Delete" value="Delete"/>
    <input id='deleteBut' hidden type="submit" name="Delete" value="Delete"/>
</form>
<div class="row align-items-start">
    <div class="col">
    <div class="table-wrapper-scroll-y my-custom-scrollbar">

                        <div class="panel-body table-responsive">

                            <table class="table table-bordered table-sm" id='videoTable'>
                                <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Convert</th>
                                      <th>Title</th>
                                      <th>Uploader</th>
                                      <th>Thumbnail</th>
                                      <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

$sqlQuery = "SELECT * FROM videos ORDER BY id DESC";
$query = $con->prepare($sqlQuery);
$query->execute();
While($row = $query->fetch(PDO::FETCH_ASSOC)){
    $video = new Video($con, $row, $userLoggedInObj);

    echo '<tr>
    <th><a href="https://bukkake.moe/editVideo.php?id=' .$row['id'] .'">'. $row["id"]. '</a></th><th>
    <button class="btn btn-primary" type="button" onclick="convert('."'".basename($row["filePath"])."'".')">Convert</button></th>
    <th class="text">'. $row["title"]. '</th><th>'.
    $row["uploadedBy"]. '</th><td>'.
    '<img border=3 height=100 width=100 src="'.$video->getThumbnail().'" loading="lazy"></td><th>
    <input type="checkbox" name="videoID[]" value="'. $row["id"].'"></th></tr>
    ';

}
//deleteVideo
function convertVideo($video){
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL,"https://www.milk.bukkake.moe/convert");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,
            "video=$video");

  // receive server response ...
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);

  curl_close ($ch);


}
//echo convertVideo('test.mp4');
?>
                                </tbody>
                            </table>
                        </div>
              </div>
          </div>
            <div class="col my-custom-scrollbar"><div>
                <ul id="log">

                </ul>
            </div>
        </div>

      </div>
</div>







<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script>
var messageBody = document.querySelector('#log');
messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
function convert(vid){

  s = $.post('https://www.milk.bukkake.moe/convert', { video: vid });
  console.log(s);
}

var $rows = $('#videoTable tr');
$('#searchInput').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

$(function(){

setInterval(function(){
    $.getJSON( "https://www.milk.bukkake.moe/logger.php", function( data ) {
      var $log = $('#log');
      $.each( data, function( key, val ) {
        $log.prepend( "<li>" + val + "</li>" );
      });
    });

},2500);

});


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>
</body>