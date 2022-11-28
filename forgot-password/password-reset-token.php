<?php



    

    require '../includes/PHPMailer/Exception.php';

    require '../includes/PHPMailer/PHPMailer.php';

    require '../includes/PHPMailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;

    use PHPMailer\PHPMailer\SMTP;

    use PHPMailer\PHPMailer\Exception;

if(isset($_POST['password-reset-token']) && $_POST['email'])

{

    include "../includes/config.php";

    

    $emailId = $_POST['email'];

    $sql_q = "SELECT * FROM users WHERE email='" . $emailId . "'";

    $result = $con->prepare( $sql_q);

	$result->execute();

    $row = $result->fetch(PDO::FETCH_BOTH)[0];



  if($row)

  {

    

     $token = md5($emailId).rand(10,9999);

     $expFormat = mktime(

     date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")

     );

    $expDate = date("Y-m-d H:i:s",$expFormat);

    $update = mysqli_query($con,"UPDATE users set  password='" . $password . "', reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $emailId . "'");

    $link = "<a href='www.bukkake.moe/forgot-password/reset-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";



    $mail = new PHPMailer();

    $mail->CharSet =  "utf-8";

    $mail->IsSMTP();

    // enable SMTP authentication

    $mail->SMTPAuth = true;                  

    // GMAIL username

    $mail->Username = "dontreply@bukkake.moe";

    // GMAIL password

    $mail->Password = "password";

    $mail->SMTPSecure = "ssl";  

    // sets GMAIL as the SMTP server

    $mail->Host = "hosting.com";

    // set the SMTP port for the GMAIL server

    $mail->Port = "465";

    $mail->From='dontreply@bukkake.moe';

    $mail->FromName='Bukkake.moe';

    $mail->AddAddress($emailId, $emailId);

    $mail->Subject  =  'Reset Password'; 

    $mail->IsHTML(true);

    $mail->Body    = 'Click On This Link to Reset Password '.$link.'';

    if($mail->Send())

    {

      echo "Check Your Email and Click on the link sent to your email";

    }

    else

    {

      echo "Mail Error - >".$mail->ErrorInfo;

    }

  }else{

    echo "Invalid Email Address. Go back";

  }

}

?>
