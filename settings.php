<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/SettingsFormProvider.php");

if(!User::isLoggedIn()){
	header("Location: signIn");
}

$detailsMessage = "";
$passwordMessage = "";
$pictureMessage  = "";
$formProvider = new SettingsFormProvider();

if(isset($_POST["saveDetailsButton"])){
	$account = new Account($con);

	$firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
	$lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
	$email = FormSanitizer::sanitizeFormString($_POST["email"]);

	if($account->updateDetails($firstName, $lastName, $email, $userLoggedInObj->getUsername())){
		$detailsMessage = "<div class='alert alert-success'>
							<strong>SUCCESS!</strong> Details updated successfully
							</div>";
	}else{
		$errorMessage = $account->getFirstError();

		if($errorMessage == "") $errorMessage = "Something went wrong";

		$detailsMessage = "<div class='alert alert-danger'>
							<strong>ERROR!</strong> $errorMessage
							</div>";
	}
}

if(isset($_POST["savePasswordButton"])){
	$account = new Account($con);

	$oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]);
	$newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
	$newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);

	if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedInObj->getUsername())){
		$passwordMessage = "<div class='alert alert-success'>
							<strong>SUCCESS!</strong> Password updated successfully
							</div>";
	}else{
		$errorMessage = $account->getFirstError();

		if($errorMessage == "") $errorMessage = "Something went wrong";

		$passwordMessage = "<div class='alert alert-danger'>
							<strong>ERROR!</strong> $errorMessage
							</div>";
	}
}

if(isset($_POST["updatePic"])){
	$account = new Account($con);

	$profileImage=$_FILES["profileImage"]["name"];
	$folder="img/profileImage/";
	$uploadfile = $folder . uniqid() . basename($_FILES['profileImage']['name']);
	move_uploaded_file($_FILES["profileImage"]["tmp_name"], $uploadfile);
	if($account->updatePicture($uploadfile, $userLoggedInObj->getUsername())){
		$pictureMessage = "<div class='alert alert-success'>
							<strong>SUCCESS!</strong> Picture updated successfully
							</div>";
	}else{
		$errorMessage = $account->getFirstError();

		if($errorMessage == "") $errorMessage = "Something went wrong";

		$pictureMessage = "<div class='alert alert-danger'>
							<strong>ERROR!</strong> $errorMessage
							</div>";
	}
}
//$pat = new PatreonApi();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="container">

<div class="modal" tabindex="-1" role="dialog" id="uploadimageModal">
    <div class="modal-dialog" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="image_demo"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary crop_image">Crop and Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

	<div class="settingsContainer column">


			<!--<div class="formSection">
			<div class="message"><?php// echo $pictureMessage; ?></div>
			<form action="settings" method="POST" enctype="multipart/form-data">
			<span class="title">Link Patreon</span>
					<hr class="lineForm">
					<div class="form-group">
                    <a  href='<?php // echo $pat->create_href();?>'><img style="max-height: 50vh; max-width: 100%;" src='/img/core-img/Digital-Patreon-Wordmark_FieryCoral.png'></a>
					<?php /* if (!empty($_GET['code'])) { 
						if($pat->get_status() != null){
							if($pat->get_charge() == "Paid"){
								if($account->updateVIP('1', $userLoggedInObj->getUsername())){
								echo "Account Linked, You're now ad-free. Thanks for supporting the site.";
							}
						}
						}else{
							echo "You're not currently subscribed. Fund the site here https://patreon.com/basicgirl (This site is non-profit) ";
						}
						
						if($pat->get_code() == "Paid"){
							if($account->updateVIP('1', $userLoggedInObj->getUsername())){
							echo "Account Linked, You're now ad-free. Thanks for supporting the site.";
						}
						}else{
							echo 'ERROR:'.$pat->get_code();
						}
					}*/ ?>
                </div>
				</form>		
				</div> -->
			<div class="formSection">
			<div class="message"><?php echo $pictureMessage; ?></div>
			<form action="settings" method="POST" enctype="multipart/form-data">
			<span class="title">Profile Picture</span>
					<hr class="lineForm">
					<div class="form-group">
                    <input type="file" class="form-control" name="profileImage" id="profileImage" accept="image/*">
					<button hidden type="submit" name="updatePic" id='updatePic' value="updatePic">Change Image</button>
                </div>
				</form>		
				</div>
			
		<div class="formSection">
			<div class="message">
				<?php echo $detailsMessage; ?>
			</div>
			<?php
				echo $formProvider->createUserDetailsForm(
					isset($_POST["firstName"]) ? $_POST["firstName"] : $userLoggedInObj->getFirstName(),
					isset($_POST["lastName"]) ? $_POST["lastName"] : $userLoggedInObj->getLastName(),
					isset($_POST["email"]) ? $_POST["email"] : $userLoggedInObj->getEmail()
				);
			?>
		</div>

		<div class="formSection">
			<div class="message">
				<?php echo $passwordMessage; ?>
			</div>
			<?php
				echo $formProvider->createPasswordForm();
			?>
		</div>
	</div>
</div>
<script>
	var image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'circle'
    },
    boundary:{
        width: 300,
        height: 300
    }
});
/// catching up the cover_image change event and binding the image into my croppie. Then show the modal.
$('#profileImage').on('change', function(){
    
    var reader = new FileReader();
    reader.onload = function (event) {
        image_crop.croppie('bind', {
            url: event.target.result,
        });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
});
var uploadField = document.getElementById("profileImage");

$('.crop_image').click(function(event){
    var formData = new FormData();
    image_crop.croppie('result', {type: 'blob'}).then(function(blob) {
        let file = new File([blob], Math.floor(Math.random()*1000000000)+"img.jpg",{type:"image/jpeg", lastModified:new Date().getTime()});
        let container = new DataTransfer();
        container.items.add(file);
        console.log( file);
        uploadField.value = null;
        console.log( uploadField.value,2);
        uploadField.files = container.files;
        console.log( uploadField.value,3);
		$('#updatePic').click();

        //formData.append('cropped_image', blob);
        //ajaxFormPost(formData, '/upload-image/'); /// Calling my ajax function with my blob data passed to it
    });
    $('#uploadimageModal').modal('hide');
});
</script>
<?php

require_once("includes/footer.php");
?>
