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

// Function to get a page by slug

function getPageBySlug($slug) {

  global $conn;

  $sql = "SELECT * FROM pages WHERE slug='$slug'";

  $result = mysqli_query($conn, $sql);

  $page = mysqli_fetch_assoc($result);

  return $page;

}

// Function to display a page

function displayPage($page) {

  echo "<h2>" . $page['title'] . "</h2>";

  echo "<p>" . $page['content'] . "</p>";

}

// Check if the user is logged in

session_start();

if (!isset($_SESSION['user'])) {

  $_SESSION['user'] = array();

}

// Function to log in a user

function login($username, $password) {

  global $conn;

  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

  $result = mysqli_query($conn, $sql);

  $user = mysqli_fetch_assoc($result);

  if ($user) {

    $_SESSION['user'] = $user;

    header("Location: admin.php");

    exit;

  } else {

    echo "<p class='error'>Invalid username or password</p>";

  }

}

// Function to log out a user

function logout() {

  session_destroy();

  header("Location: index.php");

  exit;

}

// Function to add a page

function addPage($title, $slug, $content) {

  global $conn;

  $sql = "INSERT INTO pages (title, slug, content) VALUES ('$title', '$slug', '$content')";

  mysqli_query($conn, $sql);

  header("Location: admin.php");

  exit;

}

// Function to update a page

function updatePage($id, $title, $slug, $content) {

  global $conn;

  $sql = "UPDATE pages SET title='$title', slug='$slug', content='$content' WHERE id='$id'";

  mysqli_query($conn, $sql);

  header("Location: admin.php");

  exit;

}

// Function to delete a page

function deletePage($id) {

  global $conn;

  $sql = "DELETE FROM pages WHERE id='$id'";

  mysqli_query($conn, $sql);

  header("Location: admin.php");

  exit;

}

// Display pages for non-logged in
