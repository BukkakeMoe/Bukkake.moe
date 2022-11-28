<?php require_once("includes/config.php");
      require_once("includes/classes/Account.php");
      require_once("includes/classes/Constants.php");
      require_once("includes/classes/FormSanitizer.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])){
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);

        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);

        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);

        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

        $profileImage=$_FILES["profileImage"]["name"];
        $folder="img/profileImage/";
        $uploadfile = $folder . uniqid() . basename($_FILES['profileImage']['name']);
        move_uploaded_file($_FILES["profileImage"]["tmp_name"], $uploadfile);

        $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2, $uploadfile);

        if($wasSuccessful){
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index");
        }
    }

    function getInputValue($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>BukkakeMOE</title>

	<link rel="icon" href="img/core-img/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="styles/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	
	<div class="vizew-login-area section-padding-80">
        <div class="container">
            
        <div class="modal" tabindex="-1" role="dialog" id="uploadimageModal">
    <div class="modal-dialog" role="document" style="">
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
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="login-content">
                        <!-- Section Title -->
                        <div class="section-heading">
                        	<a href="index" class="nav-brand"><img src="img/core-img/logo.png" alt=""></a>
                        	<br>
                        	<br>
                            <div class="line"></div>
                        </div>
                        
                        <form action="signUp" method="POST" enctype="multipart/form-data">
							<label for="profileImage">Profile Picture</label>
                            <div class='custom-file'>
                                <input type="file" class="form-control" name="profileImage" id="profileImage" accept="image/*" required oninvalid="this.setCustomValidity('Profile Picture is required')">
                            </div>

                            <div class="form-group" style="display:none;">
                                <input type="text" class="form-control" id='firstName' name="firstName" placeholder="First Name" required autocomplete="off" value="<?php getInputValue('firstName'); ?>" 
                                	oninvalid="this.setCustomValidity('First Name is required')" oninput="this.setCustomValidity('')">
                                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                            </div>
                            <div class="form-group" style="display:none;">
                                <input type="text" class="form-control" id='lastName' name="lastName" placeholder="Last Name" value="<?php getInputValue('lastName'); ?>" autocomplete="off">
                                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                            </div>
                            <script>
                                 document.getElementById("firstName").value = "Micheal";
                                 document.getElementById("lastName").value = "hunter";
                            </script>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username" required autocomplete="off" value="<?php getInputValue('username'); ?>"
                                	oninvalid="this.setCustomValidity('Username is required')" oninput="this.setCustomValidity('')">
                                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                                <?php echo $account->getError(Constants::$usernameTaken); ?>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off" value="<?php getInputValue('email'); ?>"
                                	oninvalid="this.setCustomValidity('Email is required')" oninput="this.setCustomValidity('')">
                                <?php echo $account->getError(Constants::$emailInvalid); ?>
                                <?php echo $account->getError(Constants::$emailTaken); ?>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email2" placeholder="Confirm Email" required autocomplete="off" value="<?php getInputValue('email2'); ?>"
                                	oninvalid="this.setCustomValidity('Please confirm your email')" oninput="this.setCustomValidity('')">
                                <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off" 
                                	oninvalid="this.setCustomValidity('Password is required')" oninput="this.setCustomValidity('')">
                                <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                                <?php echo $account->getError(Constants::$passwordLength); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required autocomplete="off" 
                                	oninvalid="this.setCustomValidity('Please confirm your password')" oninput="this.setCustomValidity('')">
                                <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                            </div>
                            <p>By creating an account you agree our <a href='/tos'>Terms Of Service</a>
                            <button type="submit" name="submitButton" class="btn vizew-btn w-100 mt-30">Sign Up</button>
                            <a href="signIn" class="btn vizew-btnregister w-100 mt-30">Back to Login</a>
                        </form>
                    </div>
                </div>
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

        //formData.append('cropped_image', blob);
        //ajaxFormPost(formData, '/upload-image/'); /// Calling my ajax function with my blob data passed to it
    });
    $('#uploadimageModal').modal('hide');
});



</script>
</body>