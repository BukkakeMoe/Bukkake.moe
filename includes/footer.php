	
    <footer class="footer-area">
        <div class="copywrite-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-6">
                        <p class="copywrite-text">
						<a href="https://discord.gg/nxEYgbHTna">Join our discord</a>
						</p>
                        <?php
                            //GET VIDEOS
                            $sql = "SELECT count(*) FROM `videos`"; 
                            $result = $con->prepare($sql); 
                            $result->execute([$bar]); 
                            $number_of_rows = $result->fetchColumn(); 
                            //GET SERVER SIZE
                            $url = 'https://milk.bukkake.moe/size.php';
                            $options = array(
                                'http' => array(
                                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                    'method'  => 'POST',
                                )
                            );
                            $context  = stream_context_create($options);
                            $result = file_get_contents($url, false, $context);
                            if ($result === FALSE) { /* Handle error */ }

                            echo "<a>Total Videos: $number_of_rows<a/>";
                            echo "<a> | <a/>";
                            //echo "<a> ".$result."/200 GB<a/>";
                            ?>
                    </div>
                    <div class="col-12 col-sm-6">
                        <nav class="footer-nav">
                            <ul>
                                <a href="https://bukkake.moe/contact">Contact us.</a>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
	</footer> 
    <script>
  //      $('.thumbnail').on('mouseover', function(e) {
  //  console.log($(e.children('img').src));
  //  $e.children('img').attr('src', '<source here>');
//});
function imageExists(image_url){

var http = new XMLHttpRequest();

http.open('HEAD', image_url, false);
http.send();

return http.status != 404;

}
var oldimg;
var isHover = false;
$('.thumbnail img').mouseover(function() {

    if(this.src.includes('bukkake')){
    let imgUrl = this.src.replace('thumbnails','thumb-gif')+'.gif';
    if(!imgUrl.includes('https')){
        imgUrl = imgUrl.replace('http','https');
    }
     
    if(imageExists(imgUrl) && isHover ==false){
        oldimg = this.src;
        this.src = imgUrl;
        isHover = true;

    }
}

    if(this.src.includes('tb-lb.sb-cd.com')){
        oldimg = this.src;
        isHover = true;
        var animatedPreview = this.src;
        animatedPreview = animatedPreview.replace('tb-lb','tbv');
        animatedPreview = animatedPreview.split("w:")[0]+"/td.mp4";
       // $(this).parent().html('<video id="thumbVideo" src="'+animatedPreview+'"loop muted autoplay>');
    }
});
$('.thumbnail img').mouseleave(function() {
    if(isHover == true){
        this.src = oldimg;
        isHover = false;
    }
});

//LGBT Detection
if (document.cookie.indexOf('gayContent=') >= 0) {
    if(document.cookie.includes("gayContent=disabled")){
    //    document.getElementById("lgbtIcon").src = "../img/icons/lgbtq-disabled.png";
        document.getElementById("lgbtIcon").className = 'fa-solid fa-rainbow'
    }else{
      //  document.getElementById("lgbtIcon").src = "../img/icons/lgbtq-enabled.png";
        document.getElementById("lgbtIcon").className = 'fa-solid fa-restroom'
        
    }

}else{
   // document.getElementById("lgbtIcon").src = "../img/icons/lgbtq-disabled.png";
    document.getElementById("lgbtIcon").className = 'fa-solid fa-rainbow'
    document.cookie = "gayContent=disabled;expires=Fri, 31 Dec 9999 23:59:59 GMT";
}

function gayContent(){
    if(document.cookie.includes("gayContent=enabled")){
        document.cookie = "gayContent=disabled;expires=Fri, 31 Dec 9999 23:59:59 GMT";
        location.reload();
    }else{
        document.cookie = "gayContent=enabled;expires=Fri, 31 Dec 9999 23:59:59 GMT";
        location.reload();
    }
}

    </script>
    
	<script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- All Plugins js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/plugins/plugins.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
    <!-- Video Player -->
    <?php 
    if(!$usernameLoggedIn){
        echo"<script>(AdProvider = window.AdProvider || []).push({'serve': {}});</script>"; 

    }else{
    $userName = $userLoggedInObj->getUsername();
    $result = $con->prepare("SELECT * FROM users WHERE username='$userName'");
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if($row['vip'] == 0){
        echo"<script>(AdProvider = window.AdProvider || []).push({'serve': {}});</script>"; 
    }else{

    }
}

    ?>

    

</body>
</html>