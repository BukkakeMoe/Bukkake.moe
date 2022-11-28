<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/SelectThumbnail.php");
require_once("includes/classes/VideoInfoSection.php");
require_once("includes/classes/CommentSection.php");
require_once("includes/classes/Comment.php");

if(!isset($_GET["id"])){
	echo "No url passed into page.";
	exit();
}

$video = new Video($con, $_GET["id"], $userLoggedInObj);
$video->incrementViews();



?>
<script src="js/videoPlayerActions.js"></script>
<script src="js/commonActions.js"></script>
<script src="js/userActions.js"></script>
<script src="js/commentActions.js"></script>
<script src="//cdn.delight-vr.com/latest/dl8-98c1479633e9da45254548af063f9a41f270b792.js" async></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<meta name="dl8-customization-primary-color" content="#ec1b2d">
<meta property="og:title" content="<?php echo $video->getTitle(); ?>"/>
<meta property="og:description" content="| <?php echo $video->getDescription(); ?> |"/>
<meta property="og:type" content="website" />
<meta property="og:url" content="https://bukkake.moe/watch?id=<?php echo $video->getID(); ?>"/>
<meta property="og:image" content="<?php echo $video->getThumbnail(); ?>" />
<meta name="twitter:card" content="<?php echo $video->getThumbnail(); ?>" />
<link rel="stylesheet" href="styles/input-style.css?v=1.00000">



<div class="container">
<section class="post-details-area mb-80">
	<div class="container">
		<div class="row justify-content-center" style="margin-top: 20px;">
			<div class="col-12 col-lg-8">
				<div class="post-details-content d-flex">
					<div class="blog-content">
						<div class="post-content mt-1">

							<div class="single-video-area">
							<div class='hide-mobile' style="z-index: -1  !important;">
								<ins class="adsbyexoclick" data-zoneid="4473924"></ins> 
							</div>
							<div class="col-12 col-lg-">
									<p class="post-title mb-2 noselect"><?php echo $video->getTitle(); ?></p>
							</div>

								<?php 
								if(in_array('VR',$video->getCategory())){
								$videoPlayer = new VideoPlayer($video); echo $videoPlayer->createVR(true); 
								}else{
								$videoPlayer = new VideoPlayer($video); echo $videoPlayer->create(true); 
								}
								?>
								<script>//SpankBang Testing Ground.
								videoStreamURL = '<?php echo $video->getFilePath();?>';
								/*
								if(videoStreamURL.includes('spankbang.com')){
									var cors_url = "https://bukkake.ml:8080/";
									var isVR;
									function SpankBang(url){
										$( ".post-tags li" ).each(function( index ) {
											console.log($( this ).text() );
												if($( this ).text() == "VR"){
												console.log('Got em'+index)
												isVR = true;
												}
											});
										if(isVR == false){	
										$.ajax({
											method:'GET',
											url : cors_url + url,
											success : function(response){
													//data_scraping_logic...
													var parser = new DOMParser();
													var doc = parser.parseFromString(response, "text/html");
													var s = doc.querySelector("#container > script:nth-child(1)").innerHTML;
													$(document.body).append('<script> console.log("Injected SpankBang (.) (.)");'+s+'<\/script>' );
												// $(document.body).append('<video height="512" width="324" src="'+stream_data['1080p'][0]+'">')
													$(".single-video-area").append("<video controls id='bukkakePlayer'></video>");
													$("#bukkakePlayer").html('');
													if(stream_data['4k'] != ''){
														videoStreamURL = stream_data['4k']['0'];
													$("#bukkakePlayer").append('<source data-fluid-hd title="4k" src="'+stream_data['4k'][0]+'" type="video/mp4" />' );
													console.log('4')
													} if(stream_data['1080p']!= ''){
														$("#bukkakePlayer").append('<source data-fluid-hd src="'+stream_data['1080p'][0]+'" title="1080p" type="video/mp4" />' );
													} if(stream_data['720p']!= ''){
														$("#bukkakePlayer").append('<source data-fluid-hd src="'+stream_data['720p'][0]+'" title="720p" type="video/mp4" />' );
													} if(stream_data['480p']!= ''){
														$("#bukkakePlayer").append('<source title="480p" src="'+stream_data['480p'][0]+'" type="video/mp4" />' );
													} if(stream_data['320p']!= ''){
														$("#bukkakePlayer").append('<source title="320p" src="'+stream_data['320p'][0]+'" type="video/mp4" />' );
													} if(stream_data['240p']!= ''){
														$("#bukkakePlayer").append('<source title="240p" src="'+stream_data['240p'][0]+'" type="video/mp4" />');
													}
													CreateVideoPlayer();
													var video = document.getElementById('bukkakePlayer');
													video.load();
													registerVideoPlayer();

													

															}
										});
									}else{
										$.ajax({
											method:'GET',
											url : cors_url + url,
											success : function(response){
													//data_scraping_logic...
													var parser = new DOMParser();
													var doc = parser.parseFromString(response, "text/html");
													var s = doc.querySelector("#container > script:nth-child(1)").innerHTML;
													var sourceTemp;
													$(document.body).append('<script> console.log("Injected SpankBang (.) (.)");'+s+'<\/script>' );
												// $(document.body).append('<video height="512" width="324" src="'+stream_data['1080p'][0]+'">')
													$("#bukkakePlayer").remove();
													if(stream_data['4k'] != ''){
														videoStreamURL = stream_data['4k']['0'];
													sourceTemp +='<source quality="4k" src="'+stream_data['4k'][0]+'" type="video/mp4" />'
													} if(stream_data['1080p']!= ''){
														sourceTemp +='<source  quality="1080p" src="'+stream_data['1080p'][0]+'" type="video/mp4" />'
													} if(stream_data['720p']!= ''){
														sourceTemp +='<source quality="720p" src="'+stream_data['720p'][0]+'" type="video/mp4" />'
													} if(stream_data['480p']!= ''){
														sourceTemp +='<source quality="480p" src="'+stream_data['480p'][0]+'" type="video/mp4" />'
													} if(stream_data['320p']!= ''){
														sourceTemp +='<source quality="320p" src="'+stream_data['320p'][0]+'" type="video/mp4" />'
													} if(stream_data['240p']!= ''){
														sourceTemp +='<source quality="240p" src="'+stream_data['240p'][0]+'" type="video/mp4" />'
													}
													$(".single-video-area").append("<dl8-video style='width: 100%; height: 100%;' id='bukkakePlayer' title='' poster='<?php echo $video->getThumbnail(); ?>' format='STEREO_180_LR'>"+sourceTemp+"</dl8-video>");
													var video = document.getElementById('bukkakePlayer');
													
													registerVideoPlayer();

													

															}
										});

									}
								}
									SpankBang(videoStreamURL);
									
									
								}*/
								</script>
							</div>
							<hr/>

							<div class="d-flex">
								<div class="p-2">
									<a href='#' id="invertScript" title="Invert script (Buttplug.io only)" style='font-size:20px;' onclick="invertScriptFun()">
									<i  class="fa-solid fa-arrow-up"></i>
									</a>
								</div>
								<div class="p-2">
									<a href='#' id="halveScript" title="Halve script (Buttplug.io only)" style='font-size:20px;' onclick="halveScriptFun()">
									<i class="fa-solid fa-circle-half-stroke"></i>
									</a>
								</div>
								<div class="ml-auto p-2">
								<div class="quantity">
										<input type="number" title="Set script offset" step="10" value="0"  onchange='setOffset()' id='Offset' name='Offset'>
								</div>
								</div>
							</div>
							<blockquote class="vizew-blockquote">
								<p id='description' style='white-space: pre-wrap;' class=""><?php echo $video->getDescription(); ?></p>

								<div class="post-tags">
									<ul>
										<?php
										foreach($video->getWatchCategory() as $cat){
											echo $cat;
										};
										?>
									</ul>
								</div>
							</blockquote>

							<div class="d-flex justify-content-between mb-15">
								
								<?php $videoPlayer = new VideoInfoSection($con, $video, $userLoggedInObj); echo $videoPlayer->create(); ?>
									
							</div>

							<div class="vizew-post-author d-flex align-items-center py-2">

								<?php $videoPlayer = new VideoInfoSection($con, $video, $userLoggedInObj); echo $videoPlayer->createSecondary(); ?>

								<?php $videoPlayer = new VideoInfoSection($con, $video, $userLoggedInObj); echo $videoPlayer->createThird(); ?>

							</div>
						</div>
						<div class='show-mobile' style='text-align: center;'>
							
									<ins class="adsbyexoclick" data-zoneid="4477914"></ins> 
								</div>
						<div class="comment_area clearfix mb-20">
							<div class="section-heading style-2">
								<h4>Comments</h4>
								<div class="line"></div>
							</div>

							<?php $commentSection = new CommentSection($con, $video, $userLoggedInObj); echo $commentSection->create(); ?>
							<div id='debugBox' style='height:200px;width:38vw;overflow: auto;display:none;'>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="col-12 col-md-6 col-lg-4">
				<div class="sidebar-area">
					<div class="single-widget add-widget mb-20">
					
					<!-- <a href="https://discord.gg/nxEYgbHTna"><img src="img/core-img/discord.png" alt=""></a> -->

                        <a rel='noreferrer' href="https://www.patreon.com/BasicGirl"><img src="img/donatev3.webp" alt=""></a>
                    </div>
					<div class="single-widget add-widget mb-20" style="z-index: -1  !important;">
					<ins class="adsbyexoclick" data-zoneid="4473912"></ins> 
                       <!-- <a href="https://www.patreon.com/BasicGirl"><img src="img/patreon.gif" alt=""></a> -->
                    </div>
						<?php $videoGrid = new VideoGrid($con, $userLoggedInObj); echo $videoGrid->create(null, null, false); ?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<script src="https://cdn.fluidplayer.com/v3/current/fluidplayer.min.js"></script>

<script type="application/javascript">
$(document).ready(function () {
  jQuery('<div class="quantity-nav"><button title="Increase offset" class="quantity-button quantity-up">&#xf106;</button><button title="Decrease offset" class="quantity-button quantity-down">&#xf107</button></div>').insertAfter('.quantity input');
  jQuery('.quantity').each(function () {
    var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

    btnUp.click(function () {
      var oldValue = parseFloat(input.val());
      if (oldValue >= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 10;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

    btnDown.click(function () {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 10;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

  });
});

$('#description').each(function(){
   $(this).html( $(this).html().replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g, '<a href="$1">$1</a> ') );
});


var p = $("#description");
var string = p.html()
p.html(string.replace(/(?<!\S)#([a-zA-Z0-9\&\-\.']+)/gi,'<a class="videoTag" href="https://bukkake.moe/search?term=$1">#$1</a>'));
/*(function (win,doc) {
  'use strict';
  var siteURL = 'https://bukkake.moe/',
      entries = doc.querySelectorAll('p#description'),
      i;
  
  if ( entries.length > 0 ) {
    for (i = 0; i < entries.length; i = i + 1) {
      entries[i].innerHTML = entries[i].innerHTML.replace(/(^|\s)(#\w+)/g,'<a href="'+siteURL+'search?term=$1" title="Find more videos tagged with #$1">#$1</a>');
    }
  }
  
}(this, this.document));*/

var newTitle = "<?php echo $video->getTitle(); ?> | Bukkake.MOE";
if (document.title != newTitle) {
    document.title = newTitle;
}
$('meta[name="description"]').attr("content", '| <?php $str = preg_replace("/[\r\n]*/","",$video->getDescription()); echo $str ?> |');
$('meta[property="og:title"]').attr("content", "<?php echo $video->getTitle(); ?>");
$('meta[property="og:url"]').attr("content", '?');
$('meta[property="og:image"]').attr("content", "<?php echo $video->getThumbnail(); ?>");
$('meta[name="twitter:card"]').attr("content", "<?php echo $video->getThumbnail(); ?>");

var bukkakePlayer;
function CreateVideoPlayer(){
if("<?php if (in_array('VR',$video->getCategory())){
	echo 'VR';
}else{
	echo '0';
}
?>" != 'VR'){

bukkakePlayer = fluidPlayer(
   'bukkakePlayer',
    {
        layoutControls: {
			posterImage: '<?php echo $video->getThumbnail(); ?>',
				autoPlay: false,
				mute: false,
				allowTheatre: true,
				fillToContainer: true,
				subtitlesEnabled: false,
				loop:                   true,
				playPauseAnimation: false,
				allowDownload: false,
				playButtonShowing: false,

				playbackRateEnabled: true,
				controlBar: {
                autoHide:           true,
                autoHideTimeout:    3,
                animated:           true
            },
			controlForwardBackward: {
                show: true // Default: false
            },
			theatreSettings: {
                width:     '80%', // Default '100%'
                height:    '70%', // Default '60%'
                marginTop: 100, // Default 0
                horizontalAlign:     'center' // 'left', 'right' or 'center'
            },
			persistentSettings: {
                theatre: false // Default true
            },
			contextMenu: {
                controls: true,
                links: [
                    {
                        href: 'https://wikipedia.org',
                        label: '?'
                    } 
                ]
            },
        },
        vastOptions: {
            // Parameters to customise how the ads are displayed & behave
        }
    }
);
bukkakePlayer.on('theatreModeOn', function(){ document.getElementsByClassName('col-12 col-lg-8')[0].appendChild(document.getElementById('fluid_video_wrapper_bukkakePlayer')); });
bukkakePlayer.on('theatreModeOff', function(){ document.getElementsByClassName('single-video-area')[0].appendChild(document.getElementById('fluid_video_wrapper_bukkakePlayer')); });
}else{
	console.log('anime');
}
}
CreateVideoPlayer();


</script>

<script>
let embedURL ='';
let embedCreated = false;
var div = document.getElementById('description');
function createCreatorVideo(url){
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	}else if (embedCreated == false){
		embedCreated = true; 
		if(url.includes('pornhub.com')){
			$( ".single-video-area" ).append('<h6 id="creatorVideoText">Unlock the video by watching 5 seconds of the original to support the videos creator</h6>');
			$( ".single-video-area" ).append( '<iframe id="creatorVideo" src="https://www.pornhub.com/embed/'+url.split("viewkey=")[1].split(" ")[0]+'" frameborder="0" width="560" height="315" scrolling="no"></iframe>' );
			$('#fluid_video_wrapper_bukkakePlayer').hide();
		}
		if(url.includes('xvideos.com')){
		//	var str1 = url.split("/video")[1].split(" ")[0].toString();
		//	var str2 = str1.substr(str1.indexOf("/")+3, str1.length);
		//$( ".single-video-area" ).append('<h6 id="creatorVideoText">Unlock the video by watching 5 seconds of the original to support the videos creator</h6>');
		//$( ".single-video-area" ).append( '<iframe src="https://www.xvideos.com/embedframe/'+str2+'" frameborder="0" width="560" height="315" scrolling="no"></iframe>' );
		//$('#fluid_video_wrapper_bukkakePlayer').hide();
		}
		
	}
	
}
var matches = div.innerText.toString().match(/\bhttps?:\/\/\S+/gi);
if(matches != null){
for (let s of matches){
	if (s.includes("pornhub.com")){
		createCreatorVideo(s);
	}
};
}

$.getJSON("https://bukkake.moe/fs/<?php echo $video->getScriptDownload();?>", function(data) {
	if(getValues(data,'title') != ''){
		div.innerHTML += '<br>[Funscript Credits]'+'<br>'+'Title : '+getValues(data,'title');
		if(getValues(data,'creator') != ''){
			div.innerHTML += '<br>'+'Creator : '+getValues(data,'creator');
		}
		if(getValues(data,'script_url') != ''){
			div.innerHTML += '<br>'+'Script Url : <a href="'+getValues(data,'script_url')+'">'+getValues(data,'script_url')+'</a>'
		}
		if(getValues(data,'video_url') != ''){
			div.innerHTML += '<br>Video Url : <a href="'+getValues(data,'video_url')+'">'+getValues(data,'video_url')+'</a>';
			createCreatorVideo(getValues(data,'video_url').toString());
		}
	}

});
var monitor = setInterval(function(){
    var elem = document.activeElement;
    if(elem && elem.tagName == 'IFRAME'){

        setTimeout(function() {
		$('#creatorVideoText').remove();
		$('#creatorVideo').remove();
		$('#fluid_video_wrapper_bukkakePlayer').show();
		document.getElementById("bukkakePlayer").play();
		}, 5000);
		clearInterval(monitor);
    }
}, 100);


window.focus(); //force focus on the currenct window;
window.addEventListener('blur', function(e){
    if(document.activeElement == document.querySelector('iframe'))
    {			

        setTimeout(function() {
		$('#creatorVideoText').remove();
		$('#creatorVideo').remove();
		$('#fluid_video_wrapper_bukkakePlayer').show();
		document.getElementById("bukkakePlayer").play();
		}, 5000);
    }
});


document.getElementById('fsDownload').href = "fs/<?php echo $video->getScriptDownload();?>";

function showDebug() {
   document.getElementById('debugBox').style.display = "block";
}

function DebugLogger(logText){
 let error='red';
 let good='green';
 let warning='yellow';
 let notice='blue';
 let ColorLog='white';
logText= logText.toString();
 if(logText.includes('error')){
	ColorLog = error;
 }

 if(logText.includes('"success":true')){
	ColorLog = good;
 }

document.getElementById('debugBox').innerHTML += "<pre style='color:"+ColorLog+"';>"+logText+"</pre>";
}//End Debug


//return an array of objects according to key, value, or key and value matching
function getObjects(obj, key, val) {
    var objects = [];
    for (var i in obj) {
        if (!obj.hasOwnProperty(i)) continue;
        if (typeof obj[i] == 'object') {
            objects = objects.concat(getObjects(obj[i], key, val));    
        } else 
        //if key matches and value matches or if key matches and value is not passed (eliminating the case where key matches but passed value does not)
        if (i == key && obj[i] == val || i == key && val == '') { //
            objects.push(obj);
        } else if (obj[i] == val && key == ''){
            //only add if the object is not already in the array
            if (objects.lastIndexOf(obj) == -1){
                objects.push(obj);
            }
        }
    }
    return objects;
}
//return an array of values that match on a certain key
function getValues(obj, key) {
    var objects = [];
    for (var i in obj) {
        if (!obj.hasOwnProperty(i)) continue;
        if (typeof obj[i] == 'object') {
            objects = objects.concat(getValues(obj[i], key));
        } else if (i == key) {
            objects.push(obj[i]);
        }
    }
    return objects;
}

// var URL_BASE = "http://192.168.137.1:3000/";
		var URL_BASE = "https://www.handyfeeling.com/";
		var URL_API_ENDPOINT = "api/v1/";
		
		
		/*
			sync time with server
		*/
		let timeSyncMessage = 0;
		let timeSyncAggregatedOffset = 0;
		let timeSyncAvrageOffset = 0;
		let timeSyncInitialOffset = 0;

		function getServerTime(){
			let serverTimeNow = Date.now() + timeSyncAvrageOffset + timeSyncInitialOffset;
			return Math.round(serverTimeNow);
		}
		function setOffset(){
		let customOffset = urlAPI + "/syncOffset?offset="+document.getElementById("Offset").value+"&timeout=5000"
		$.get(customOffset);

		}

		function updateServerTime() {
			let sendTime = Date.now();
			let url = urlAPI + "/getServerTime";
			 console.log("url:",url);
			
			$.ajax({url: url, success: function(result){
				console.log(result);
				console.log(result);
				DebugLogger(JSON.stringify(result));
				let now = Date.now();
				let receiveTime = now;
				let rtd = receiveTime - sendTime;
				let serverTime = result.serverTime;
				let estimatedServerTimeNow = serverTime + rtd /2;
				let offset = 0;
				if(timeSyncMessage == 0){
					timeSyncInitialOffset = estimatedServerTimeNow - now;
					DebugLogger("timeSyncInitialOffset: "+timeSyncInitialOffset);
					//console.log("timeSyncInitialOffset:",timeSyncInitialOffset);
				}else{
					offset = estimatedServerTimeNow - receiveTime- timeSyncInitialOffset;
            		timeSyncAggregatedOffset += offset;
            		timeSyncAvrageOffset = timeSyncAggregatedOffset / timeSyncMessage;
				}
				DebugLogger("Time sync reply nr " + timeSyncMessage + " (rtd, this offset, avrage offset): "+ rtd +' '+offset+' '+timeSyncAvrageOffset);
				//console.log("Time sync reply nr " + timeSyncMessage + " (rtd, this offset, avrage offset):",rtd,offset,timeSyncAvrageOffset);
				timeSyncMessage++;
				if(timeSyncMessage < 30){
					updateServerTime();
				}else{
					//Time in sync
					//document.getElementById("state").innerHTML += "<li>Server time in sync. Avrage offset from client time: " + Math.round(timeSyncAvrageOffset) + "ms</li>"; 
				}
  			}});
			
		}
		
		
		/*
			Input params from the URL
		*/
		//Test video: https://s3-eu-central-1.amazonaws.com/sweettecheu/videos/admin/dataset1_v2_converted.mp4
		//Test script: "https://sweettecheu.s3.eu-central-1.amazonaws.com/scripts/admin/dataset+(2)_fix_150420.csv"

		let videoUrl = qs("videourl");
		let connectionkey = qs("key");
		let fps = qs("fps");
		let format = qs("format");
		if(fps === null){
			fps = 30;
		}
		if(format === null){
			format = "MONO_FLAT";
		}



		/*
			Parse url params function
			Credits: https://stackoverflow.com/questions/7731778/get-query-string-parameters-url-values-with-jquery-javascript-querystring
		*/
		function qs(key) {
			key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, "\\$&"); // escape RegEx meta chars
			var match = location.search.match(new RegExp("[?&]"+key+"=([^&]+)(&|$)"));
			return match && decodeURIComponent(match[1].replace(/\+/g, " "));
		}
		let scriptUrl = "https://bukkake.moe/fs/<?php echo $video->getScript(); ?>";
		//DebugLogger(videoUrl, scriptUrl,connectionkey,fps,format);		
		//console.log(videoUrl, scriptUrl,connectionkey,fps,format);
		if(localStorage.getItem('handyKey') != null){
			connectionkey = localStorage.getItem('handyKey');
}


		/*
			Init sequence
		*/
		var urlAPI = URL_BASE + URL_API_ENDPOINT + connectionkey;
		updateServerTime(); //Strat time sync with teh server
		//DebugLogger(scriptUrl,connectionkey);
		console.log(scriptUrl,connectionkey);
		//Prepare Handy by telling it where to download the script
		$.ajax({url: urlAPI + "/syncPrepare", data:{ url: scriptUrl, timeout: 30000}, success: function(result){
			DebugLogger("<li>Machine reply to syncPrepare: " + JSON.stringify(result) + "</li>");
			DebugLogger("Uploaded Script "+scriptUrl)
			console.log("<li>Machine reply to syncPrepare: " + JSON.stringify(result) + "</li>");
			console.log("Uploaded")
			if(result.connected==true){
				document.getElementById("handyIcon").style.color="mediumspringgreen";
			}else{
				document.getElementById("handyIcon").style.color="red";

			}
			DebugLogger(JSON.stringify(result));
    		console.log(result);
		},  error: function (request, status, error) {
    }});
		  

					registerVideoPlayer();

		

		/*
			Player logic
		*/
		function registerVideoPlayer(){
			console.log("Registrating video player");
			DebugLogger("Registrating video player");
			var video = document.getElementById("bukkakePlayer");
			//Add event listner to intersept play/pause event.
			video.addEventListener('playing', ()=> {
				DebugLogger("playing");
				console.log("playing");
				let videoTime = Math.round(video.currentTime*1000);
				DebugLogger("playing",videoTime);
				console.log("playing",videoTime);
				$.ajax({url: urlAPI + "/syncPlay", data:{ 
					play: true,
					serverTime: getServerTime(),
					time: videoTime
				}, success: function(result){
					//document.getElementById("state").innerHTML += "<li>Machine reply to syncPlay: " + JSON.stringify(result) + "</li>";
					DebugLogger(JSON.stringify(result));
					console.log(result);
				}});
			});
			video.addEventListener('pause', ()=> {
				DebugLogger("pause");
				console.log("pause");
				$.ajax({url: urlAPI + "/syncPlay", data:{ 
					play: false
				}, success: function(result){
					//document.getElementById("state").innerHTML += "<li>Machine reply to syncPlay: " + JSON.stringify(result) + "</li>";
					DebugLogger(JSON.stringify(result));
					console.log(result);
				}});
			});
			}
		


			
	</script>
<script lang="javascript" src="https://cdn.jsdelivr.net/npm/buttplug@1.0.16/dist/web/buttplug.min.js"></script>
<script>document.write("<script type='text/javascript' src='/js/buttplug_support.js?v=" + Date.now() + "'><\/script>");</script>
<script>document.write("<script type='text/javascript' src='/js/scripts/streamRipper.js?v=" + Date.now() + "'><\/script>");</script>

<?php require_once("includes/footer.php"); ?>