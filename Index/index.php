<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Clothing Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style-index.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        &nbsp;<i class="bi bi-shop"></i>&nbsp;&nbsp;
        <a class="navbar-brand" href="#">Online Clothing Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/Index/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Women/cart.php">Cart</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/contact_us/about_us.html">About US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact_us/contactus.html">Contact US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Index/index.html">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row" style="background-image: url('/images/c2.jpg'); background-size: cover; background-position: center;">
        <div class="col-md-6 p-5"><br><br><br><br>
    <br><br><br><br>
      <h2 class="shop-all mb-6 text-center">Shop All Women's Clothes</h2><br>
      <a href="/Women/home_women.php" class="btn btn-primary btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;Shop Now</a>
    </div>

    <div class="col-md-6 p-5"><br><br><br><br>
    <br><br><br><br>
      <h2 class="shop-all mb-6 text-center">Shop All Men's Clothes</h2><br>
      <a href="/men/home_men.php" class="btn btn-primary btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;Shop Now</a>
    </div>
   <?php
    include 'footer.php'

   ?>


   

<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>