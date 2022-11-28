<?php 
require_once("includes/config.php");
require_once("includes/classes/ButtonProvider.php");
require_once("includes/classes/Video.php");
require_once("includes/classes/User.php");
require_once("includes/classes/VideoGrid.php");
require_once("includes/classes/VideoGridItem.php");
require_once("includes/classes/SubscriptionsProvider.php");
require_once("includes/classes/TrendingProvider.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $usernameLoggedIn);
$video = new Video($con, null, $userLoggedInObj);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Bukkake MOE</title>
	<meta name="description" content="Bukkake.moe is a free open video sharing site made for interactive masturbators">
	<meta name="keywords" content="the handy, free handy scripts, handy free porn,funscripts, free funscripts, free kiiroo videos, the handy porn free, the handy scripts free">
	<meta name="robots" content="index, follow">
    <meta name="referrer" content="no-referrer">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="English">
    <meta name="juicyads-site-verification" content="965a454357c978a43c1ec4a36b827427">
	<link rel="icon" href="img/core-img/favicon.ico">
    <link rel="stylesheet" href="styles/style.css?v=1.017.5">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
    <script async type="application/javascript" src="https://a.realsrv.com/ad-provider.js"></script> 
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JF84H03DKN"></script>
    <script> //Google Tag
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-JF84H03DKN');
    </script>
	<script>
	$(document).ready(function() {

	$("img").on("error", function () {
    $(this).attr("src", "img/profileImage/default-profile.png");
	});
			$('span')
.filter(function(){ return $(this).text() == 'BasicGirl'; })
.css('color','#ef8913');
	});
	</script>


</head>
<body>
<!--
<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style='color:black;'>Survey #5</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <h3 style='color:black;'>Help improve the site</h3>
       <p>Survey takes like 2 minutes and will help me improve the website.</p>
       <a href="https://forms.gle/KnhCEAtykRc2qDPw9"><p style="color: #D30000;">Survey Here</p></a>
       <p>thx u bby i luv u ~ basicgirl</p>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->
<div class="container">

<script>
$(document).ready(function(){
//loads when document is ready

if (document.cookie.indexOf('modal_shown4=') >= 0) {
} else {
  $('.modal').modal('show');  //show modal pop up
  //document.cookie = 'modal_shown=seen'; //set cookie modal_shown
  document.cookie = "modal_shown4=seen; max-age=86400; path=/;";

  //cookie will expire when browser is closed
}

})
</script>
<script type="application/javascript">
(function() {

    //version 1.0.0

    var adConfig = {
    "ads_host": "a.realsrv.com",
    "syndication_host": "syndication.realsrv.com",
    "idzone": 4472750,
    "popup_fallback": true,
    "popup_force": false,
    "chrome_enabled": true,
    "new_tab": true,
    "frequency_period": 180,
    "frequency_count": 1,
    "trigger_method": 3,
    "trigger_class": "",
    "only_inline": false,
    "t_venor": false
};

window.document.querySelectorAll||(document.querySelectorAll=document.body.querySelectorAll=Object.querySelectorAll=function(o,e,t,i,n){var r=document,c=r.createStyleSheet();for(n=r.all,e=[],t=(o=o.replace(/\[for\b/gi,"[htmlFor").split(",")).length;t--;){for(c.addRule(o[t],"k:v"),i=n.length;i--;)n[i].currentStyle.k&&e.push(n[i]);c.removeRule(0)}return e});var popMagic={version:"1.0.0",cookie_name:"",url:"",config:{},open_count:0,top:null,browser:null,venor_loaded:!1,venor:!1,configTpl:{ads_host:"",syndication_host:"",idzone:"",frequency_period:720,frequency_count:1,trigger_method:1,trigger_class:"",popup_force:!1,popup_fallback:!1,chrome_enabled:!0,new_tab:!1,cat:"",tags:"",el:"",sub:"",sub2:"",sub3:"",only_inline:!1,t_venor:!1,cookieconsent:!0},init:function(o){if(void 0!==o.idzone&&o.idzone){for(var e in this.configTpl)this.configTpl.hasOwnProperty(e)&&(void 0!==o[e]?this.config[e]=o[e]:this.config[e]=this.configTpl[e]);void 0!==this.config.idzone&&""!==this.config.idzone&&(!0!==this.config.only_inline&&this.loadHosted(),this.addEventToElement(window,"load",this.preparePop))}},getCountFromCookie:function(){if(!this.config.cookieconsent)return 0;var o=popMagic.getCookie(popMagic.cookie_name),e=void 0===o?0:parseInt(o);return isNaN(e)&&(e=0),e},shouldShow:function(){if(popMagic.open_count>=popMagic.config.frequency_count)return!1;var o=popMagic.getCountFromCookie();return popMagic.open_count=o,!(o>=popMagic.config.frequency_count)},venorShouldShow:function(){return!popMagic.config.t_venor||popMagic.venor_loaded&&"0"===popMagic.venor},setAsOpened:function(){var o=1;o=0!==popMagic.open_count?popMagic.open_count+1:popMagic.getCountFromCookie()+1,popMagic.config.cookieconsent&&popMagic.setCookie(popMagic.cookie_name,o,popMagic.config.frequency_period)},loadHosted:function(){var o=document.createElement("script");for(var e in o.type="application/javascript",o.async=!0,o.src="//"+this.config.ads_host+"/popunder1000.js",o.id="popmagicldr",this.config)this.config.hasOwnProperty(e)&&"ads_host"!==e&&"syndication_host"!==e&&o.setAttribute("data-exo-"+e,this.config[e]);var t=document.getElementsByTagName("body").item(0);t.firstChild?t.insertBefore(o,t.firstChild):t.appendChild(o)},preparePop:function(){if("object"!=typeof exoJsPop101||!exoJsPop101.hasOwnProperty("add")){if(popMagic.top=self,popMagic.top!==self)try{top.document.location.toString()&&(popMagic.top=top)}catch(o){}if(popMagic.cookie_name="zone-cap-"+popMagic.config.idzone,popMagic.config.t_venor&&popMagic.shouldShow()){var o=new XMLHttpRequest;o.onreadystatechange=function(){o.readyState==XMLHttpRequest.DONE&&(popMagic.venor_loaded=!0,200==o.status&&(popMagic.venor=o.responseText))};var e="https:"!==document.location.protocol&&"http:"!==document.location.protocol?"https:":document.location.protocol;o.open("GET",e+"//"+popMagic.config.syndication_host+"/venor.php",!0);try{o.send()}catch(o){popMagic.venor_loaded=!0}}if(popMagic.buildUrl(),popMagic.browser=popMagic.browserDetector.detectBrowser(navigator.userAgent),popMagic.config.chrome_enabled||"chrome"!==popMagic.browser.name&&"crios"!==popMagic.browser.name){var t=popMagic.getPopMethod(popMagic.browser);popMagic.addEvent("click",t)}}},getPopMethod:function(o){return popMagic.config.popup_force?popMagic.methods.popup:popMagic.config.popup_fallback&&"chrome"===o.name&&o.version>=68&&!o.isMobile?popMagic.methods.popup:o.isMobile?popMagic.methods.default:"chrome"===o.name?popMagic.methods.chromeTab:popMagic.methods.default},buildUrl:function(){var o="https:"!==document.location.protocol&&"http:"!==document.location.protocol?"https:":document.location.protocol,e=top===self?document.URL:document.referrer,t={type:"inline",name:"popMagic",ver:this.version};this.url=o+"//"+this.config.syndication_host+"/splash.php?cat="+this.config.cat+"&idzone="+this.config.idzone+"&type=8&p="+encodeURIComponent(e)+"&sub="+this.config.sub+(""!==this.config.sub2?"&sub2="+this.config.sub2:"")+(""!==this.config.sub3?"&sub3="+this.config.sub3:"")+"&block=1&el="+this.config.el+"&tags="+this.config.tags+"&cookieconsent="+this.config.cookieconsent+"&scr_info="+function(o){var e=o.type+"|"+o.name+"|"+o.ver;return encodeURIComponent(btoa(e))}(t)},addEventToElement:function(o,e,t){o.addEventListener?o.addEventListener(e,t,!1):o.attachEvent?(o["e"+e+t]=t,o[e+t]=function(){o["e"+e+t](window.event)},o.attachEvent("on"+e,o[e+t])):o["on"+e]=o["e"+e+t]},addEvent:function(o,e){var t;if("3"!=popMagic.config.trigger_method)if("2"!=popMagic.config.trigger_method||""==popMagic.config.trigger_method)popMagic.addEventToElement(document,o,e);else{var i,n=[];i=-1===popMagic.config.trigger_class.indexOf(",")?popMagic.config.trigger_class.split(" "):popMagic.config.trigger_class.replace(/\s/g,"").split(",");for(var r=0;r<i.length;r++)""!==i[r]&&n.push("."+i[r]);for(t=document.querySelectorAll(n.join(", ")),r=0;r<t.length;r++)popMagic.addEventToElement(t[r],o,e)}else for(t=document.querySelectorAll("a"),r=0;r<t.length;r++)popMagic.addEventToElement(t[r],o,e)},setCookie:function(o,e,t){if(!this.config.cookieconsent)return!1;t=parseInt(t,10);var i=new Date;i.setMinutes(i.getMinutes()+parseInt(t));var n=encodeURIComponent(e)+"; expires="+i.toUTCString()+"; path=/";document.cookie=o+"="+n},getCookie:function(o){if(!this.config.cookieconsent)return!1;var e,t,i,n=document.cookie.split(";");for(e=0;e<n.length;e++)if(t=n[e].substr(0,n[e].indexOf("=")),i=n[e].substr(n[e].indexOf("=")+1),(t=t.replace(/^\s+|\s+$/g,""))===o)return decodeURIComponent(i)},randStr:function(o,e){for(var t="",i=e||"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",n=0;n<o;n++)t+=i.charAt(Math.floor(Math.random()*i.length));return t},isValidUserEvent:function(o){return!!("isTrusted"in o&&o.isTrusted&&"ie"!==popMagic.browser.name&&"safari"!==popMagic.browser.name)||0!=o.screenX&&0!=o.screenY},isValidHref:function(o){if(void 0===o||""==o)return!1;return!/\s?javascript\s?:/i.test(o)},findLinkToOpen:function(o){var e=o,t=!1;try{for(var i=0;i<20&&!e.getAttribute("href")&&e!==document&&"html"!==e.nodeName.toLowerCase();)e=e.parentNode,i++;var n=e.getAttribute("target");n&&-1!==n.indexOf("_blank")||(t=e.getAttribute("href"))}catch(o){}return popMagic.isValidHref(t)||(t=!1),t||window.location.href},getPuId:function(){return"ok_"+Math.floor(89999999*Math.random()+1e7)},browserDetector:{browserDefinitions:[["firefox",/Firefox\/([0-9.]+)(?:\s|$)/],["opera",/Opera\/([0-9.]+)(?:\s|$)/],["opera",/OPR\/([0-9.]+)(:?\s|$)$/],["edge",/Edg(?:e|)\/([0-9._]+)/],["ie",/Trident\/7\.0.*rv:([0-9.]+)\).*Gecko$/],["ie",/MSIE\s([0-9.]+);.*Trident\/[4-7].0/],["ie",/MSIE\s(7\.0)/],["safari",/Version\/([0-9._]+).*Safari/],["chrome",/(?!Chrom.*Edg(?:e|))Chrom(?:e|ium)\/([0-9.]+)(:?\s|$)/],["chrome",/(?!Chrom.*OPR)Chrom(?:e|ium)\/([0-9.]+)(:?\s|$)/],["bb10",/BB10;\sTouch.*Version\/([0-9.]+)/],["android",/Android\s([0-9.]+)/],["ios",/Version\/([0-9._]+).*Mobile.*Safari.*/],["yandexbrowser",/YaBrowser\/([0-9._]+)/],["crios",/CriOS\/([0-9.]+)(:?\s|$)/]],detectBrowser:function(o){var e=o.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile|WebOS|Windows Phone/i);for(var t in this.browserDefinitions){var i=this.browserDefinitions[t];if(i[1].test(o)){var n=i[1].exec(o),r=n&&n[1].split(/[._]/).slice(0,3),c=Array.prototype.slice.call(r,1).join("")||"0";return r&&r.length<3&&Array.prototype.push.apply(r,1===r.length?[0,0]:[0]),{name:i[0],version:r.join("."),versionNumber:parseFloat(r[0]+"."+c),isMobile:e}}}return{name:"other",version:"1.0",versionNumber:1,isMobile:e}}},methods:{default:function(o){if(!popMagic.shouldShow()||!popMagic.venorShouldShow()||!popMagic.isValidUserEvent(o))return!0;var e=o.target||o.srcElement,t=popMagic.findLinkToOpen(e);return window.open(t,"_blank"),popMagic.setAsOpened(),popMagic.top.document.location=popMagic.url,void 0!==o.preventDefault&&(o.preventDefault(),o.stopPropagation()),!0},chromeTab:function(o){if(!popMagic.shouldShow()||!popMagic.venorShouldShow()||!popMagic.isValidUserEvent(o))return!0;if(void 0===o.preventDefault)return!0;o.preventDefault(),o.stopPropagation();var e=top.window.document.createElement("a"),t=o.target||o.srcElement;e.href=popMagic.findLinkToOpen(t),document.getElementsByTagName("body")[0].appendChild(e);var i=new MouseEvent("click",{bubbles:!0,cancelable:!0,view:window,screenX:0,screenY:0,clientX:0,clientY:0,ctrlKey:!0,altKey:!1,shiftKey:!1,metaKey:!0,button:0});i.preventDefault=void 0,e.dispatchEvent(i),e.parentNode.removeChild(e),window.open(popMagic.url,"_self"),popMagic.setAsOpened()},popup:function(o){if(!popMagic.shouldShow()||!popMagic.venorShouldShow()||!popMagic.isValidUserEvent(o))return!0;var e="";if(popMagic.config.popup_fallback&&!popMagic.config.popup_force){var t=Math.max(Math.round(.8*window.innerHeight),300);e="menubar=1,resizable=1,width="+Math.max(Math.round(.7*window.innerWidth),300)+",height="+t+",top="+(window.screenY+100)+",left="+(window.screenX+100)}var i=document.location.href,n=window.open(i,popMagic.getPuId(),e);setTimeout(function(){n.location.href=popMagic.url},200),popMagic.setAsOpened(),void 0!==o.preventDefault&&(o.preventDefault(),o.stopPropagation())}}};    popMagic.init(adConfig);
})();



</script>
	<!-- Preloader -->
    <!-- <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <!-- Breaking News Widget -->
                        <div class="breaking-news-area d-flex align-items-center">
                        <div class="top-search-area">
                                <form action="javascript:localStorage.setItem('handyKey', document.getElementById('handyKey').value );location.reload();" method="GET">
                                    <input title="Enter Your Handy Device Key Here"  type="text" name="term" id="handyKey" placeholder="Handy Key" style='width:50%;'>
                                    <button title="Save your handy key (Green = Connected, Red = Not Connected)"  style='display:block; padding:2px;' type="submit" class="btn"><i id='handyIcon' class="fas fa-fist-raised" aria-hidden="true"></i></button>
                                    <button title="ButtPlug.io Prompt" type="button" id='plugButt' style='display:block; right:4px !important;'><i id='plugIcon' class="fa-solid fa-plug"></i></button>
                                   <!--  <button title="Enable Gay Content" onclick="gayContent()" type="button" id='lgbtButt' style='right:45px !important;'><img id='lgbtIcon' width="auto" height="5px" src=/></button>
-->
                                    <button title="Enable Gay Content" onclick="gayContent()" type="button" id='lgbtButt' style='right:45px !important;'><i id='lgbtIcon' class=""></i></button>
                                </form>
                                
                            </div>
                            <div class="news-title" style='padding:5px;min-width:5px;'>
                            <a href="https://discord.gg/nxEYgbHTna"> <i class="fab fa-discord" aria-hidden="true"></i></a>
                            </div>
                            <div class="news-title" style='padding:5px;min-width:5px;'>
                            <a href="https://twitter.com/BasicGirlNSFW"> <i class="fab fa-twitter" aria-hidden="true"></i></a>
                            </div><!--
                            <div id="breakingNewsTicker" class="ticker">
                                <ul>
                                    <?php //echo $video->getNewVideo(); ?>
                                </ul>
                            </div>-->
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="top-meta-data d-flex align-items-center justify-content-end">
                        
                            <!-- Top Social Info -->
                            <div class="top-social-info">
                                <a rel="noreferrer" href="https://patreon.com/basicgirl"><i class="fab fa-patreon" aria-hidden="true"></i> Patreon</a>
                                <a href="upload"><i class="fas fa-upload"></i>  Upload</a>
                            </div>
                            
                            <!-- Top Search Area -->
                            <div class="top-search-area">
                                <form action="search" method="GET">
                                    <input type="text" name="term" id="topSearch" placeholder="Search...">
                                    <button type="submit" class="btn"><i class="fas fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                            <script>
                            if(localStorage.getItem('handyKey') != null){
                                document.getElementById("handyKey").value = localStorage.getItem('handyKey');
                            }
                            </script>
                            <!-- Login -->
                            <a href="signIn" class="login-btn"><i class="fa fa-user" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="vizew-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">

                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="vizewNav">

                        <!-- Nav brand -->
                        <a href="/" class="nav-brand"><img style="width: auto; height:70px;" src="img/core-img/logo.png" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="/">Home</a></li>
                                    <li><a href="videos">Browse Videos</a></li> 
                                    <li><a href="category?pageno=1&cat=1">Categories</a></li> 
                                    <li><a href="subscriptions">Subscriptions</a></li>
                                    <?php
                                    if($userLoggedInObj->getFirstName() == ""){
                                        echo "";
                                    } else{
                                        $username = $userLoggedInObj->getUsername();
                                        $name = $userLoggedInObj->getName();
                                        echo "<li><a href='likedVideos'>Liked Videos</a></li>
                                              <li><a href='settings'>Settings</a></li>
                                              <li><a href='logout'>Logout</a></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                    <style>
#xhDWfcvorelX {
display: none;
margin-bottom: 30px;
padding: 20px 10px;
background: #D30000;
text-align: center;
font-weight: bold;
color: #fff;
border-radius: 5px;
}
#serverUpdate {
    display: none;
margin-bottom: 30px;
padding: 20px 10px;
background: #D30000;
text-align: center;
font-weight: bold;
color: #fff;
border-radius: 5px;
}
</style>
<div id="serverUpdate">
    Due to mass uploads with out permission/credit, we will be deleting all videos and starting new on 4/6/2020.
    Sorry for the inconvenience.
<br>
https://discord.gg/xs83fujAan < Updates
</div>
<div id="xhDWfcvorelX">
  <!--Our website is made possible by displaying online advertisements to our visitors.<br>
  Please consider supporting us by disabling your ad blocker.-->
</div>

<script src="/wp-banners.js" type="text/javascript"></script>
<script type="text/javascript">

if(!document.getElementById('ECKckuBYwZaP')){
  document.getElementById('xhDWfcvorelX').style.display='block';
}


</script>
                </div>
            </div>
        </div>
    </header>


<div style='margin: auto; width: 60%;'>
    <div class='hide-mobile' style="z-index: -1  !important;">
    <ins class="adsbyexoclick" data-zoneid="4473926"></ins> 
    </div>
    
    <div class='show-mobile'>
    <ins class="adsbyexoclick" data-zoneid="4477908"></ins> 
    </div>
    
</div>
 <!--    ##### Header Area End ##### -->

    