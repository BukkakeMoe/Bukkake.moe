<?php require_once("includes/header.php"); ?>
<meta name="eroads_" content="284f0cd83544bce00d340fc519b69ab1" />
<div class="container">

	<div class="videoSection">
		<div class="subs">
			<?php
				$subscriptions = $userLoggedInObj->getSubscriptions();

				if(User::isLoggedIn() && sizeof($subscriptions) > 0){
					foreach($subscriptions as $sub){
						$subUsername = $sub->getUsername();
						$profilePic = $sub->getProfilePic();
						echo 	"<div class='listOfSubs'>
									<a href='profile?username=$subUsername'><img src='$profilePic'></a>
									<span class='caption'>$subUsername</span>
								</div>";	
					}
				}
			?>
		</div>
		<?php
			$subscriptionsProvider = new SubscriptionsProvider($con, $userLoggedInObj);
			$trendingProvider = new TrendingProvider($con, $userLoggedInObj);
			$trendingVideos30 = $trendingProvider->getVideos30();
			$trendingVideos7 = $trendingProvider->getVideos7();
			$subscriptionsVideos = $subscriptionsProvider->getVideos();
			$newVideos = $trendingProvider->getNewVideos();
			$videoGrid = new VideoGrid($con, $userLoggedInObj->getUsername());

			if(User::isLoggedIn() && sizeof($subscriptionsVideos) > 0){
				echo $videoGrid->create($subscriptionsVideos, "Subscriptions", false);
			}

			echo $videoGrid->create($trendingVideos30, "Most Popular 30 Days", false);
			echo $videoGrid->create($trendingVideos7, "Trending", false);
			echo $videoGrid->create($newVideos, "Recently Uploaded", false);?>
			<div class="videoGridHeader">
                        <div class="left">
						Advertisement 
                        </div>
                        
                    </div>
			<div class="single-widget mb-20 videoGrid">
			<script type="application/javascript" data-idzone="4490105" src="https://a.realsrv.com/nativeads-v2.js" ></script>		</div>
			<?php
			echo $videoGrid->create(null, "Random", false);
			//echo $videoGrid->createGridHeader('Videos',false);
		?>
	</div>
</div>

<?php require_once("includes/footer.php"); ?>