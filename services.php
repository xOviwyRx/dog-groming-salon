<?php
  require_once 'classes/autoload.php';
  $database = new classes\Database();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Services</title>

    <!-- Include Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/services.css" rel="stylesheet">
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
        <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="index.php">Home</a>
        <a class="nav-link fw-bold py-1 px-0 active" href="services.php">Services</a>
        <a class="nav-link fw-bold py-1 px-0" href="contact.php">Contact</a>
      </nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal pt-5">Salon Services</h1>
      <p class="fs-5 text-muted">Please see our available services and pricing below, then <a href="contact.php">Contact Us</a> to book an appointment.</p>
    </div>
  </header>

  <main>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <?php
        $services = classes\Service::getAllServicesFromDB($database);

        // $wash_service = $database->getServiceFromDB('Wash');
        foreach ($services as $service):
      ?>
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
              <div class="card-header py-3">
                <h4 class="my-0 fw-normal"><?=$service->getName()?></h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title">$<?=$service->getPrice();?></h1>
                <ul class="list-unstyled mt-3 mb-4">
                  <?php $desc_array = $service->getDescription();
                  foreach ($desc_array as $element): ?>
                    <li><?=$element?></li>
                  <?php endforeach; ?>
                </ul>
                <a href="contact.php" type="button" class="w-100 btn btn-lg btn-primary">Contact to Book</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
    </div>

    <h2 class="display-6 text-center mb-4">Compare Services</h2>

    <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <th style="width: 34%;"></th>
            <?php foreach ($services as $service): ?>
                <th style="width: 22%;"><?=$service->getName();?></th>
            <?php endforeach;?>
          </tr>
        </thead>
        <tbody>
          <?php $categories = ['Basic Wash', 'Extra Wash', 'Standard Trim', 'Extra Trim', 'Hair Ribbon'];
            foreach ($categories as $category): ?>
            
                <tr>
                  <th scope="row" class="text-start"><?= $category ?></th>
                  <?php foreach ($services as $service): ?>
                      <td>
                      <?php if (in_array($category, $service->getDescription()) || $service->getName() === 'Full Grooming'): ?>
                        <svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg>
                      <?php endif; ?>
                      </td>
                  <?php endforeach; ?>
         <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <small class="d-block mb-3 text-muted">&copy; 2017–2022</small>
      </div>
      <div class="col-6 col-md">
        <h5>Features</h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="index.php">Home</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="services.php">Services</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Resources</h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="contact.php">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>About</h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Team</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Locations</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Privacy</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Terms</a></li>
        </ul>
      </div>
    </div>
  </footer>
</div>



  </body>
</html>
