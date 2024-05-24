<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add_to_cart'])) {
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];

  if (array_key_exists($product_id, $_SESSION['cart'])) {
      // The product is already in the cart, update the quantity
      $_SESSION['cart'][$product_id] += $quantity;
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">The product is already in the cart, quantity updated.
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>'; 
  } else {
      // Add the product and quantity to the cart array
      $_SESSION['cart'][$product_id] = $quantity;
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Product added to cart.
          <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>';
  }
}



include('../data.php');
$products = get_products();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        &nbsp;<i class="bi bi-shop"></i>&nbsp;&nbsp;
        <a class="navbar-brand" href="#"><strong>Women Clothing</strong></a>
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
   
  
    <div class="container">
  <div class="row">
    <?php foreach ($products as $product) : ?>
    <div class="col-md-4">
      <div class="card mb-5">
        <img class="card-img-top divClass" src="<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>" style="object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title"><?php echo $product['title']; ?></h5>
          <p class="card-text"><?php echo $product['description']; ?></p>
          <p class="card-text">$<?php echo number_format($product['price'], 2); ?></p>
          <form method="post" action="" class="d-flex flex-column align-items-center">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="quantity" class="mb-2">Quantity:</label>
            <div class="input-group mb-2">
              <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <div class="input-group-append">
                <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>


   <!-- Font Awesome -->
<script src="https://kit.fontawesome.com/958dca8f68.js" crossorigin="anonymous"></script>


<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1PiO2Sz"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNSbHIp"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


  
</body>
</html>

<?php
include '../Index/footer.php'
?>
