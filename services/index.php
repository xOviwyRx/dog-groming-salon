<?php
  session_start();
  require_once '../classes/autoload.php';
  include_once '../config/config.php';

  $database = new classes\Database();
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
    <title>Our Services</title>

    <!-- Include Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/pages.css" rel="stylesheet">
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
        <a class="nav-link fw-bold py-1 px-0 active" href="index.php">Services</a>
        <a class="nav-link fw-bold py-1 px-0" href="../contact/">Contact</a>
        <?php if ($account->isAuthenticated($database)): ?>
             <a class="nav-link fw-bold py-1 px-0" href="/login/logout.php">Log Out</a>
         <?php else: ?>
             <a class="nav-link fw-bold py-1 px-0" href="/login/">Login</a>
         <?php endif; ?>
      </nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal pt-5">Salon Services</h1>
      <p class="fs-5 text-muted">Please see our available services and pricing below, then <a href="/contact/">Contact Us</a> to book an appointment.</p>
    </div>
  </header>

  <main>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <?php
        $services = classes\Service::getAllServicesFromDB($database);
        foreach ($services as $service):
      ?>
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <?php if ($account->isAdmin()): ?>
                    <a href="edit.php?id=<?=$service->getId()?>" class="w-100 btn btn-lg btn-success">Edit</a>
                <?php endif ?>
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
                <a href="/booking?id=<?=$service->getId()?>" type="button" class="w-100 btn btn-lg btn-primary mb-3">Book</a>
                <a href="/contact/" type="button" class="w-100 btn btn-lg btn-primary">Contact to Book</a>
              
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
    <?php include '../footer.html'; ?>
</div>



  </body>
</html>
