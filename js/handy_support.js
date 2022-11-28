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
			// console.log("url:",url);
			
			$.ajax({url: url, success: function(result){
				// console.log(result);
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
					console.log("timeSyncInitialOffset:",timeSyncInitialOffset);
				}else{
					offset = estimatedServerTimeNow - receiveTime- timeSyncInitialOffset;
            		timeSyncAggregatedOffset += offset;
            		timeSyncAvrageOffset = timeSyncAggregatedOffset / timeSyncMessage;
				}
				DebugLogger("Time sync reply nr " + timeSyncMessage + " (rtd, this offset, avrage offset): "+ rtd +' '+offset+' '+timeSyncAvrageOffset);
				console.log("Time sync reply nr " + timeSyncMessage + " (rtd, this offset, avrage offset):",rtd,offset,timeSyncAvrageOffset);
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
		console.log(videoUrl, scriptUrl,connectionkey,fps,format);
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
		}});
		  

					registerVideoPlayer();

		

		/*
			Player logic
		*/
		function registerVideoPlayer(){
			console.log("Registrating video player");
			DebugLogger("Registrating video player");
			var video = document.getElementById("vid");
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
		

