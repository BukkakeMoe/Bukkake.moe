<?php require_once("includes/header.php"); ?>

<?php
if( isset($_POST['report']) ){

// Replace the URL with your own webhook url
$webhookurl = "https://discord.com/api/webhooks/945806603234463795/9J5b-EL184GyezqwehjwgznjJevgsiSy6iwuIvKyXxLm4u096tm-XNllfESDlqmURpF3";
$id = $_GET['id'];
$email = $_POST['email'];
$reportMessage = $_POST['message'];
$reportReason = $_POST['report'];
//=======================================================================================================
// Compose message. You can use Markdown
// Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
//========================================================================================================

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([
    // Message
    "content" => "Report for: $id",
    
    // Username

    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    "embeds" => [
        [
            // Embed Title
            "title" => "Report for: $id",

            // Embed Type
            "type" => "rich",

            // Embed Description
            "description" => "Contact email:$email\nReport Reason:$reportReason\nReport Message:$reportMessage",

            // URL of title link
            "url" => "https://bukkake.moe/watch?id=$id",

            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,

            // Embed left border color in HEX
            "color" => hexdec( "3366ff" ),

            // Footer
            "footer" => [
                "text" => "bukkake.moe",
                "icon_url" => "https://bukkake.moe/img/core-img/logo.png"
            ],

            // Image to send
            //"image" => [
             //   "url" => "https://static.displate.com/280x392/displate/2020-12-04/48a83b62c60e84eed98ddb10dc078964_32b1148c3fdf7a3261c8a32657ce7508.jpg"
            //],

            // Thumbnail
            //"thumbnail" => [
            //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
            //],


        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close( $ch );
}
?>
<div class="row justify-content-center">
<div class="col-12">

<div class="form-group">

<form action="" method="POST">
<p>Report Reason:</p>
<input type="radio" id="reportType" name="report" value="DCMA">
  <label for="reportType">DCMA File</label><br>
  <input type="radio" id="reportType2" name="report" value="Broken Script">
  <label for="reportType2">Broken Script</label><br>  
  <input type="radio" id="reportType3" name="report" value="Missing Video">
  <label for="reportType3">Missing Video</label><br>
  <input type="radio" id="reportType4" name="report" value="Other">
  <label for="reportType4">Other</label><br>
  
<p>Message</p>
<textarea class="form-control" name="message" rows="6" cols="25"></textarea><br />
<p>Email (Required for DCMA)</p>
 <input class="form-control" type="text" name="email">
<input class='btn vizew-btn mt-30' type="submit" value="Send">
</form>
</div>
</div>

</div>
<?php require_once("includes/footer.php"); ?>