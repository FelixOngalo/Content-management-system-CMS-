<?php

// Connect to database

$servername = "localhost";

$username = "username";

$password = "password";

$dbname = "database_name";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {

  die("Connection failed: " . mysqli_connect_error());

}

// Function to generate random product IDs

function generateProductID() {

  return uniqid();

}

// Function to get all products

function getAllProducts() {

  global $conn;

  $sql = "SELECT * FROM products";

  $result = mysqli_query($conn, $sql);

  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

  return $products;

}

// Function to get a product by ID

function getProductByID($id) {

  global $conn;

  $sql = "SELECT * FROM products WHERE id='$id'";

  $result = mysqli_query($conn, $sql);

  $product = mysqli_fetch_assoc($result);

  return $product;

}

// Function to add a product to the cart

function addToCart($id, $quantity) {

  if (!isset($_SESSION['cart'])) {

    $_SESSION['cart'] = array();

  }

  $_SESSION['cart'][$id] = $quantity;

}

// Function to remove a product from the cart

function removeFromCart($id) {

  unset($_SESSION['cart'][$id]);

}

// Function to get the total price of the items in the cart

function getTotalPrice() {

  global $conn;

  $total_price = 0;

  foreach ($_SESSION['cart'] as $id => $quantity) {

    $product = getProductByID($id);

    $price = $product['price'];

    $total_price += $price * $quantity;

  }

  return $total_price;

}

// Function to display a product

function displayProduct($product) {

  echo "<div class='product'>";

  echo "<h2>" . $product['name'] . "</h2>";

  echo "<img src='" . $product['image'] . "' alt='" . $product['name'] . "' width='200'>";

  echo "<p>" . $product['description'] . "</p>";

  echo "<p>Price: $" . $product['price'] . "</p>";

  echo "<form method='post' action='products.php'>";

  echo "<input type='number' name='quantity' value='1' min='1' max='" . $product['quantity'] . "' required>";

  echo "<input type='hidden' name='id' value='" . $product['id'] . "'>";

  echo "<input type='submit' name='add_to

