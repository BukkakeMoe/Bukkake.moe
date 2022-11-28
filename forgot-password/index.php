<?php// require_once("../includes/header.php"); ?>


   <head>
  
      <title>Reset Password</title>
       <!-- CSS -->
   </head>
   <body>
      <div class="container bg-dark text-white">
          <div class="card bg-dark text-white">
            <div class="card-header text-center">
              Reset Password
            </div>
            <div class="container bg-dark text-white">
              <form action="password-reset-token.php" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <input type="submit" name="password-reset-token" class="btn btn-primary">
              </form>
            </div>
          </div>
      </div>
   </body>

<?php //require_once("../includes/footer.php"); ?>