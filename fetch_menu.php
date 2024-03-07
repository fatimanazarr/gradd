<?php 
$category = $_GET["category"];

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost;dbname=db5;", $username, $password);

if ($database) {
  // Query the menu table and retrieve the data based on the category
  $menu_sql = "SELECT DishID, DishCategory, DishName, DishDescription, TotalPrice FROM menu WHERE DishCategory = :category";
  $menu_statement = $database->prepare($menu_sql);
  $menu_statement->bindParam(":category", $category);
  $menu_statement->execute();
  $menu_data = $menu_statement->fetchAll(PDO::FETCH_ASSOC);

  $images_sql = "SELECT DishName, Dishimage FROM images"; // Select all data from the 'images' table
  $images_statement = $database->query($images_sql);
  $images_data = $images_statement->fetchAll(PDO::FETCH_ASSOC);

  $response = array(
    "menu" => $menu_data,
    "images" => $images_data
  );

  header("Content-Type: application/json");
  echo json_encode($response);
  exit; // Terminate the script to prevent any additional output
} else {
  // Handle the error case
  header("HTTP/1.1 500 Internal Server Error");
  exit; // Terminate the script to prevent any additional output
}
?>
