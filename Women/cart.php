<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

include('../data.php');
$products = get_products();

// Check if the "clear_cart" form was submitted
if (isset($_POST['clear_cart'])) {
    // Clear the cart by setting the session variable to an empty array
    $_SESSION['cart'] = [];
    echo "<div class='alert alert-success'>Cart cleared successfully. Please go back to home to continue shopping</div>";
}

// Check if the "update_cart" form was submitted
if (isset($_POST['update_cart'])) {
    // Loop through the products and update the quantities in the cart
    foreach ($products as $product) {
        $id = $product['id'];
        if (isset($_POST["quantity_$id"])) {
            $quantity = (int)$_POST["quantity_$id"];
            if ($quantity <= 0) {
                echo "<div class='alert alert-danger'>$product[title] quantity cannot be zero or negative.</div>";
            }  else {
                $_SESSION['cart'][$id] = $quantity;
               
            }
        }
        
    }

    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">The quantity of the product updated successfully.
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if (isset($_POST['remove'])) {
    $remove_id = $_POST['remove_id'];
    unset($_SESSION['cart'][$remove_id]);
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Selected item deleted successfully from cart.
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

// Calculate the total cost of the items in the cart
$total = 0;
foreach ($products as $product) {
    $id = $product['id'];
    if (isset($_SESSION['cart'][$id])) {
        $quantity = $_SESSION['cart'][$id];
        $price = $product['price'];
        $total += $quantity * $price;
    }
}

// Check if the "checkout" form was submitted and the cart is not empty
if (isset($_POST['checkout']) && !empty($_SESSION['cart'])) {
    $total = number_format($total, 2);
    echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Thank you for shopping with us. Your total cost is $'.$total.'.
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    // Clear the cart after checkout
    $_SESSION['cart'] = [];
    $total = 0;
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="/css/style-cart.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        &nbsp;<i class="bi bi-shop"></i>&nbsp;&nbsp;
        <a class="navbar-brand" href="#"><strong>Your Cart</strong></a>
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

<div class="container my-5">
    <div class="row">
        <?php if (empty($products)) : ?>
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    Your cart is empty.
                </div>
            </div>
        <?php else : ?>
            <div class="col-12">
                <form method="post">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <?php if (isset($_SESSION['cart'][$product['id']])) : ?>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="<?= $product['image'] ?>" alt="<?= $product['title'] ?>" class="img-fluid">
                                                    </div>
                                                    <div class="col-8">
                                                        <h5><?= $product['title'] ?></h5>
                                                        <p><?= $product['description'] ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle"><?= $product['price'] ?></td>
                                            <td class="align-middle">
                                                <input type="number" name="quantity_<?= $product['id'] ?>" value="<?= $_SESSION['cart'][$product['id']] ?>" min="1" class="form-control">
                                            </td>
                                            <td class="align-middle"><?= number_format($_SESSION['cart'][$product['id']] * $product['price'], 2) ?></td>
                                            <td class="align-middle">
                                                <input type="hidden" name="remove_id" value="<?= $product['id'] ?>">
                                                <button type="submit" name="remove" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <tr class="table-secondary">
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td class="align-middle"><?= number_format($total, 2) ?></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" name="clear_cart" class="btn btn-secondary me-2">Clear cart</button>
                        <button type="submit" name="update_cart" class="btn btn-primary me-2">Update cart</button>
                        <button type="submit" name="checkout" class="btn btn-success" <?= $total == 0 ? 'disabled' : '' ?>>Checkout</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
include '../Index/footer.php'
?>
