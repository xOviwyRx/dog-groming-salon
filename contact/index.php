<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>

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
        <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="../index.php">Home</a>
        <a class="nav-link fw-bold py-1 px-0" href="../services.php">Services</a>
        <a class="nav-link fw-bold py-1 px-0 active" href="index.php">Contact</a>
      </nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal pt-5">Contact Us</h1>
    </div>
  </header>
    <form method="POST" id="contact_us_form" action="submit.php">
        <div class="form-group">
            <div class="alert alert-danger" style="display: none;" id="error-valid"></div>
            <div class="alert alert-success" id="alert-success" style="display: none;">Your message was sent</div>
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
                    <label class="col-form-label col-sm-2" for="description">Your message</label>
                    <div class="col-sm-10">
                        <textarea class="form-control border-dark" rows="5" name="description" placeholder="What's up?" required></textarea>
                    </div>
              </div>
                    
               <div class="form-group row">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
               </div>
          </div>
        </div>
      </form>
  
  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <small class="d-block mb-3 text-muted">&copy; 2017–2022</small>
      </div>
      <div class="col-6 col-md">
        <h5>Features</h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="../index.php">Home</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="../services.php">Services</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Resources</h5>
        <ul class="list-unstyled text-small">
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="index.php">Contact Us</a></li>
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
  <script
			  src="https://code.jquery.com/jquery-3.6.0.js"
			  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
			  crossorigin="anonymous"></script>
  <script src="../js/contact.js"></script>
</html>
