var client;
var canVibrate;
var canRotate;
var canLinear;
var invertScript = false;
var halver = false;
async function runButtPlug() {
  await Buttplug.buttplugInit();

  const connector = new Buttplug.ButtplugEmbeddedConnectorOptions();
   client = new Buttplug.ButtplugClient("Device Control Example");
  await client.connect(connector);

  client.addListener("deviceadded", async (device) => {
    DebugLogger(`Device Connected: ${device.Name}`);
    document.getElementById("plugIcon").style.color="mediumspringgreen";
    console.log("Client currently knows about these devices:");
    client.Devices.forEach((device) => console.log(`- ${device.Name}`));


    DebugLogger("Sending first command");

	if (device.messageAttributes(Buttplug.ButtplugDeviceMessageType.VibrateCmd)) {
		canVibrate = true;
    }else{
		canVibrate = false
	}
	if (device.messageAttributes(Buttplug.ButtplugDeviceMessageType.RotateCmd)) {
		canRotate = true;
    }else{
		canRotate = false
	}
	if (device.messageAttributes(Buttplug.ButtplugDeviceMessageType.LinearCmd)) {
		canLinear = true;
    }else{
		canLinear = false
	}


    try {
      if(canVibrate){
        await device.vibrate(1.0);
      }

		await device.linear(10 * 0.01, this.timeValue * 1000);
    } catch (e) {
      console.log(e);
      if (e instanceof Buttplug.ButtplugDeviceError) {
        console.log("got a device error!");
        swal("Device error!", "Something went wrong, refresh the page and try connecting again", "error");

        
      }
    }

  });
  client
    .addListener("deviceremoved", (device) => console.log(`Device Removed: ${device.Name}`));


  await client.startScanning();
};

function delay(n){
  return new Promise(function(resolve){
      setTimeout(resolve,n*1000);
  });
}

function foo(num1 , num2) {
   return Math.abs(num1-num2);
}

async function updateStroke(value,time) {
    if(time != null && client != null && isPlaying == true){
      if(invertScript == true){
        value = 1 - value;
      }
      if(halver == true){
        value = value/2;
      }
     // client.Devices.forEach(async (element, index) => {
      //  await client.Devices[index].linear(value, time);
     // })
    await client.Devices[0].linear(value, time);
    }
}
async function updateVibrate(value) {
  if(client != null){
  await client.Devices[0].vibrate(value);
  await delay(0.5);
  await client.Devices[0].vibrate(0);
  }
}


let timeUpdate = 0;
let videoTimes;
let isPlaying = false;
let firstPlay = true;


var b_Video = document.getElementById("bukkakePlayer");
var videoScript = scriptUrl;
var fileSCRIPT;
var msTime = [];
var fsTime = [];
var playingScript;

$.get(videoScript, function(data) {
	var newTxt = data.replace(/\n/g,',');
	fileSCRIPT = newTxt.split(',');
	for (var i = 0; i < fileSCRIPT.length; i++) {
		if(i%2==0){
			msTime.push(fileSCRIPT[i]);
		}else{
			fsTime.push(fileSCRIPT[i]);
		}
	}
});

function closest(num, arr) {
    var curr = arr[0],
        diff = Math.abs(num - curr),
        index = 0;

    for (var val = 0; val < arr.length; val++) {
        let newdiff = Math.abs(num - arr[val]);
        if (newdiff < diff) {
            diff = newdiff;
            curr = arr[val];
            index = val;
        }
    }
    return index;
}

function getOffset(){
  var offSet = document.getElementById("Offset").value;
  if(offSet == ''){
    return 0;
  }else{
    return parseInt(offSet);
  }
  
}

//Add event listner to intersept play/pause event.
b_Video.addEventListener('playing', ()=> {
    isPlaying = true;
    if( firstPlay == true){
    curTime =  Math.round(b_Video.currentTime * 1000)+getOffset();
    timeUpdate = closest(curTime,msTime);
    if(timeUpdate = 0){
      timeUpdate = 1;
    }
    firstPlay = false;
  }
    playingScript = setInterval(() => {
            let videoTimes = Math.round(b_Video.currentTime * 1000)+getOffset();
            if (videoTimes >= msTime[timeUpdate]-2 && videoTimes <= msTime[timeUpdate]+2) {
                if(timeUpdate == 0){
                  timeUpdate = 1;
                console.log(videoTimes+' <====> '+fsTime[timeUpdate]);
                }
                /*console.log(videoTimes+' <====> '+fsTime[timeUpdate]);
                //console.log(videoTimes+' <====> '+fsTime[timeUpdate+1]/100);
                console.log(Math.round(b_Video.currentTime * 1000));*/
                  console.log(fsTime[timeUpdate+1]/100, foo(msTime[timeUpdate],msTime[timeUpdate+1]));

                if(canLinear == true){
                updateStroke(fsTime[timeUpdate+1]/100, foo(msTime[timeUpdate],msTime[timeUpdate+1]));

                }
                if(canVibrate == true){
                updateVibrate(fsTime[timeUpdate+1]/100);
                }
                timeUpdate++;
        }
        }, 10)
    
    
            //document.getElementById("state").innerHTML += "<li>Machine reply to syncPlay: " + JSON.stringify(result) + "</li>";
        });
        
b_Video.addEventListener('pause', ()=> {
  isPlaying = false;
	clearInterval(playingScript);
    playingScript = null;
});

b_Video.addEventListener('seeking', ()=> {
    clearInterval(playingScript);
    playingScript = null;
    curTime =  Math.round(b_Video.currentTime * 1000);
    closestTime = closest(curTime,msTime);
    timeUpdate = closestTime;
    console.error(curTime,timeUpdate,msTime[timeUpdate]);
});


document.querySelector('#plugButt').addEventListener('click', function(event) {
	runButtPlug();
  if(navigator.userAgent.indexOf("Firefox") != -1 ) 
  {
    location.replace("https://bukkake.moe/wiki/index.html#/?id=supported")
  }
});
function invertScriptFun(){

  if(invertScript == true){
    invertScript = false;
    document.getElementById('invertScript').innerHTML = '<i class="fa-solid fa-arrow-up"></i>';

  }else{
    invertScript = true;
    document.getElementById('invertScript').innerHTML = '<i class="fa-solid fa-arrow-down"></i>';

  }
}
function halveScriptFun(){
  if(halver == true){
    halver = false;
    document.getElementById('halveScript').innerHTML = '<i class="fa-solid fa-circle-half-stroke"></i>';

  }else{
    halver = true;
    document.getElementById('halveScript').innerHTML = '<i class="fa-solid fa-circle"></i>';

  }
}
