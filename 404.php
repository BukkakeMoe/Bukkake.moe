<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Bukkake MOE!!</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.6.4.js"></script>

	<link rel="icon" href="img/core-img/favicon.ico">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="https://bukkake.moe/styles/404style.css" />

</head>
<style>
	body, html {
  height: 100%;
}

* {
  box-sizing: border-box;
}

	@font-face {
		font-family: BadUnicorn;
  	src: url("../fonts/BadUnicorn.ttf");
}
	.rainbow {
    text-align: center;
    text-decoration: underline;
    font-size: 32px;
	font-family: BadUnicorn;
    letter-spacing: 5px;
}
.rainbow_text_animated {
    background: linear-gradient(to right, #6666ff, #0099ff , #00ff00, #ff3399, #6666ff);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: rainbow_animation 6s ease-in-out infinite;
    background-size: 400% 100%;
}

@keyframes rainbow_animation {
    0%,100% {
        background-position: 0 0;
    }

    50% {
        background-position: 100% 0;
    }
}
.bg-image {
  /* The image used */
  background-image: url("https://dickdrainers.com/tour/content//contentthumbs/41/92/4192-3x.jpg");
  
  /* Add the blur effect */
  filter: blur(8px);
  -webkit-filter: blur(8px);
  
  /* Full height */
  height: 100%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  box-shadow: 0 0 5px 12px hsl(0deg 0% 0% / 90%);
}

</style>

<body>
<div class="bg-image"></div>

<video  id="v1" width="auto" height="100%" class='center'  loop autoplay muted>
</video>

<img src="" alt="" style='width:auto;height:100%;' class="center">

<a class="center rainbow rainbow_text_animated"style='font-size:10vw;'>404<br>
<p id='pornstar' class="center rainbow rainbow_text_animated"style='white-space:nowrap;font-size: 2.9vw; TOP: 90% !important; text-align: center;'>sorry we can't find that page.<br> but heres &PORNSTAR&.</p></a>

<script>
	function getRandomInt(max) {
	total = Math.floor(Math.random() * max);
	if(total = 0){
		return 1;
	}else{
		return Math.floor(Math.random() * max);
	}
}

function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}
function updateBackground(){
var pornstars = ['Val Steele','Skylar Vox','Charlotte Sartre','Larkin Love','Proxy Paige']
var pornstar = pornstars[getRandomInt(5)];
$("#pornstar").text($("#pornstar").text().replace('&PORNSTAR&',pornstar));

 $.getJSON("https://www.reddit.com/r/" +pornstar.replace(' ','')+"/new/.json?limit=100", function(data) {
 randInt = Math.floor((Math.random() * 100) + 1);
 var imageUrl = (data.data.children[randInt].data.url);
 if(imageUrl.indexOf("jpeg") > -1 ||imageUrl.indexOf("jpg") > -1 || imageUrl.indexOf("png") > -1 || imageUrl.indexOf("gif") > -1){
	if(imageUrl.includes('redgifs')){
		var thumbData = (data.data.children[randInt].data.media.oembed.thumbnail_url);

		const thumb = thumbData.split('.com/')[1].replace('jpg','mp4');
		

		$("#v1").html('<source onerror="updateBackground()" src="'+'https://thumbs2.redgifs.com/'+thumb+'" type="video/mp4"></source>' );
		 $('#v1').fadeIn(1000);
	}else{
 $('img:eq(0)').attr("src", imageUrl);
document.getElementsByClassName('bg-image')[0].style.backgroundImage = "url('"+imageUrl+"')";
 $('img:eq(0)').fadeIn(1000);
	}

}else{
  console.log(imageUrl);
  updateBackground();};
});}

updateBackground();
  </script>
</script>
</body>

</html>
