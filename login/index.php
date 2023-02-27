<?php
  require_once '../classes/autoload.php';
  include_once '../config/config.php';

  $database = new classes\Database();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Include Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/pages.css" rel="stylesheet">
    
  </head>
  <body>
  <div class="container py-3">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Dog Grooming Salon</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="../index.php">Home</a>
        <a class="nav-link fw-bold py-1 px-0" href="../services/">Services</a>
        <a class="nav-link fw-bold py-1 px-0 active" href="../contact/">Contact</a>
      </nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal pt-5">Login    <a href="signUp.php">Sign Up</a></h1>
    </div>
      <form method="POST" id="ajax_form" action="submitLogin.php">
        <div class="form-group">
            <div class="alert alert-danger" style="display: none;" id="error-valid"></div>
              <div class="row mb-3">
                    <label class="col-form-label col-sm-2" for="name">Your Name</label>
                    <div class="col-sm-10">
                        <input class="form-control border-dark" name="name" minlength="8" maxlength="16" type="text" required/>
                    </div>
              </div>
              
              <div class="row mb-3">
                    <label class="col-form-label col-sm-2" for="password">Your Password</label>
                    <div class="col-sm-10">
                        <input class="form-control border-dark" name="password" minlength="8" maxlength="16" type="password" required/>
                    </div>
              </div>
                    
               <div class="form-group row">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary" id="submit">Login</button>
                    </div>
               </div>
          </div>
   </form>
    </header>
      <?php
        include "../footer.html";
        ?>
  </div>
  </body>
      <script
			  src="https://code.jquery.com/jquery-3.6.0.js"
			  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
			  crossorigin="anonymous"></script>
      <script src="../js/ajax_submit.js"></script>
</html>