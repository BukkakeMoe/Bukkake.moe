<?php require_once("includes/header.php"); ?>
    <title>Contact Form</title>
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>

<style>
#fcf-form{display:block}.fcf-body{margin:0;font-family:-apple-system,Arial,sans-serif;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;text-align:left;background-color:#222627;padding:30px;padding-bottom:10px;border:1px solid #ced4da;border-radius:.25rem;max-width:100%}.fcf-form-group{margin-bottom:1rem}.fcf-input-group{position:relative;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-ms-flex-align:stretch;align-items:stretch;width:100%}.fcf-form-control{display:block;width:100%;height:calc(1.5em + .75rem + 2px);padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;outline:0;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out}.fcf-form-control:focus{border:1px solid #313131}select.fcf-form-control[multiple],select.fcf-form-control[size]{height:auto}textarea.fcf-form-control{font-family:-apple-system,Arial,sans-serif;height:auto}label.fcf-label{display:inline-block;margin-bottom:.5rem}.fcf-credit{padding-top:10px;font-size:.9rem;color:#545b62}.fcf-credit a{color:#545b62;text-decoration:underline}.fcf-credit a:hover{color:#0056b3;text-decoration:underline}.fcf-btn{display:inline-block;font-weight:400;color:#212529;text-align:center;vertical-align:middle;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out}@media (prefers-reduced-motion:reduce){.fcf-btn{transition:none}}.fcf-btn:hover{color:#212529;text-decoration:none}.fcf-btn.focus,.fcf-btn:focus{outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25)}.fcf-btn-primary{color:#fff;background-color:#007bff;border-color:#007bff}.fcf-btn-primary:hover{color:#fff;background-color:#0069d9;border-color:#0062cc}.fcf-btn-primary.focus,.fcf-btn-primary:focus{color:#fff;background-color:#0069d9;border-color:#0062cc;box-shadow:0 0 0 .2rem rgba(38,143,255,.5)}.fcf-btn-group-lg>.fcf-btn,.fcf-btn-lg{padding:.5rem 1rem;font-size:1.25rem;line-height:1.5;border-radius:.3rem}.fcf-btn-block{display:block;width:100%}.fcf-btn-block+.fcf-btn-block{margin-top:.5rem}input[type=button].fcf-btn-block,input[type=reset].fcf-btn-block,input[type=submit].fcf-btn-block{width:100%}
</style>
<div class="container">
<div class="videoSection">
<div class="fcf-body">

    <div id="fcf-form">
    <h3 class="fcf-h3">Contact us</h3>

    <form id="fcf-form-id" class="fcf-form-class" method="post" action="contact-form-process.php">
        
        <div class="fcf-form-group">
            <h3 for="Subject" class="title">Email Subject</h3>
            <div class="fcf-input-group">
                <input type="text" id="Subject" name="Subject" class="fcf-form-control" required>
            </div>
        </div>

        <div class="fcf-form-group">
            <h3 for="Email" class="title">Your email address (optional)</h3>
            <div class="fcf-input-group">
                <input type="email" id="Email" name="Email" class="fcf-form-control">
            </div>
        </div>

        <div class="fcf-form-group">
            <h3 for="Message" class="title">Your message</h3>
            <div class="fcf-input-group">
                <textarea id="Message" name="Message" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
            </div>
        </div>

        <div class="fcf-form-group">
        <div class="h-captcha" data-sitekey="de3ed0e2-c2ca-406e-bbf1-f9c9ba411780"></div>

            <button type="submit" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Send Message</button>
        </div>


    </form>
    </div>
</div>
</div>

</div>



<?php require_once("includes/footer.php"); ?>