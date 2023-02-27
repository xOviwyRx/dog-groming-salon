<?php session_start(); 
require_once '../classes/autoload.php';
include_once '../config/config.php';
$db = new classes\Database;
if (!isset($_SESSION['account'])){
    $account = new classes\Account;
} else {
    $account = unserialize($_SESSION['account']);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking</title>

    <!-- Include Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/pages.css" rel="stylesheet">
    <link href="../css/booking/main.css" rel="stylesheet">
  </head>
  <body>
    
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check" viewBox="0 0 16 16">
    <title>Check</title>
    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
  </symbol>
</svg>

<div class="container py-3">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Dog Grooming Salon</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="../index.php">Home</a>
        <a class="nav-link fw-bold py-1 px-0" href="../services/">Services</a>
        <a class="nav-link fw-bold py-1 px-0 active" href="index.php">Contact</a>
        <?php if ($account->isAuthenticated($db)): ?>
            <a class="nav-link fw-bold py-1 px-0" href="../login/logout.php">Log Out</a>
        <?php else: ?>
            <a class="nav-link fw-bold py-1 px-0" href="../login/">Login</a>
        <?php endif; ?>
      </nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal pt-5">Booking</h1>
    </div>
  </header>
    <form method="POST" id="ajax_form" action="submit.php">
        <div class="form-group">
            <div class="alert alert-danger" style="display: none;" id="error-valid"></div>
            <div class="alert alert-success" id="alert-success" style="display: none;">You successfully done preservation</div>
              <div class="row mb-3">
                    <label class="col-form-label col-sm-2" for="service">Service</label>
                    <div class="col-sm-5 select_box">
                        <select class="form-control border-dark" name = "service">
                            <?php $services = classes\Service::getAllServicesFromDB($db);
                            foreach ($services as $service): ?>
                            <option value = "<?=$service->getId()?>" <?php if ($service->getId() === $_GET['id']) echo selected ?>>
                                <?=$service->getName()?></option>    
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
              <div class="row mb-3">
                    <label class="col-form-label col-sm-2" for="name">Your Name</label>
                    <div class="col-sm-10">
                        <input class="form-control border-dark" name="name" type="text" required/>
                    </div>
              </div>
              
              <div class="row mb-3">
                    <label class="col-form-label col-sm-2" for="email">Your Email</label>
                    <div class="col-sm-10">
                        <input class="form-control border-dark" name="email" type="email" required/>
                    </div>
              </div>
            
               <div class="row mb-3">
                    <label class="col-form-label col-sm-2" for="email">Date</label>
                    <div class="col-sm-10">
                        <input class="form-control border-dark" name="email" type="date" required/>
                    </div>
              </div>
            
              <div class="row mb-3">
                        <label class="col-form-label col-sm-2" for="email">Time</label>
                    <div class="col-sm-10">
                        <input class="form-control border-dark" name="email" type="time" required/>
                    </div>
              </div>
                    
              <div class="row mb-3">
                    <label class="col-form-label col-sm-2" for="description">Your message</label>
                    <div class="col-sm-10">
                        <textarea class="form-control border-dark" rows="5" name="description"></textarea>
                    </div>
              </div>
                    
               <div class="form-group row">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary" id="submit">Book</button>
                    </div>
               </div>
          </div>
   </form>
  
  <?php include '../footer.html'; ?>
</div>



    
  </body>
  <script src="../js/ajax_submit.js"></script>
</html>
