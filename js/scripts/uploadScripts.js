var cors_url = "https://bukkake.ml:8080/";
var urlUploadValues = [];
var animatedPreview;
//muted autoplay loop

function processURL(url){
    if(url.includes('spankbang.com')){
        getDataSB(url);
    }
}  
function success(){
    if(animatedPreview != ''){
        document.getElementById('urlUpload').innerHTML = '<video loop muted autoplay style="display: block;margin-left: auto;margin-right: auto;width: 40%;" src='+animatedPreview+'>';
    }else{
        document.getElementById('urlUpload').innerHTML = '<img style="display: block;margin-left: auto;margin-right: auto;width: 40%;" src='+urlUploadValues[1]+'>';
    }
    document.getElementsByName('uploadButton')[0].style = "display:block";

}

function getDataSB(url){
    console.log(url);
    $.ajax({
        method:'GET',
        url : cors_url + url,
        success : function(response){
                //data_scraping_logic...
                console.log(response) + 's';
                var parser = new DOMParser();
                var doc = parser.parseFromString(response, "text/html");
                document.getElementById('duration').value = doc.getElementsByClassName('i-length')[0].textContent
                document.getElementById('video_thumbnail').value = $(doc).find("meta[property='og:image:secure_url']").attr('content');//$('meta[property=og:image:secure_url]').attr('content');
                document.getElementById('video_url').value = url;
                animatedPreview = document.getElementById('video_thumbnail').value;
                animatedPreview = animatedPreview.replace('tb-lb','tbv');
                animatedPreview = animatedPreview.split("w:")[0]+"/td.mp4";
                urlUploadValues.push(document.getElementById('duration').value,document.getElementById('video_thumbnail').value,document.getElementById('video_url').value);
                return success()
        }
    });

}