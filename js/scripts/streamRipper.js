var cors_url = "https://milk.bukkake.moe:8080/";
var videoURL = videoStreamURL;


if(videoURL.includes('spankbang.com')){
    getVideoSourceSB(videoURL);
}

function getVideoSourceSB(url){         
    var isVR;
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
                    var s = document.querySelectorAll("script")[11].innerHTML//doc.querySelector("#container > script:nth-child(1)").innerHTML;
                    $(document.body).append('<script> console.log("Injected SpankBang (.) (.)");'+s+'<\/script>' );
                // $(document.body).append('<video height="512" width="324" src="'+stream_data['1080p'][0]+'">')
                    $(".single-video-area").append("<video controls id='bukkakePlayer'></video>");
                    $("#bukkakePlayer").html('');
                    if(stream_data['4k'] != ''){
                    $("#bukkakePlayer").append('<source data-fluid-hd title="4k" src="'+stream_data['4k'][0]+'" type="video/mp4" />' );
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
                    var s = doc.querySelectorAll("script")[11].innerHTML//doc.querySelector("#container > script:nth-child(1)").innerHTML;
 
                    var sourceTemp = '';
                    $(document.body).append('<script> console.log("Injected SpankBang (.) (.)");'+s+'<\/script>' );
                // $(document.body).append('<video height="512" width="324" src="'+stream_data['1080p'][0]+'">')
                    $("#bukkakePlayer").remove();
                    if(stream_data['4k'] != ''){
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
                    console.log(sourceTemp)
                    $(".single-video-area").append("<dl8-video style='width: 100%; height: 100%;' id='bukkakePlayer' title='' poster='"+stream_data['cover_image']+"' format='STEREO_180_LR'>"+sourceTemp+"</dl8-video>");
                    var video = document.getElementById('bukkakePlayer');
                    
                    registerVideoPlayer();

                    

                            }
        });

    }
}



    
    



