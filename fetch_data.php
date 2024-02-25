<?php 
$username = "root"; 
$password = ""; 
$database = new PDO("mysql:host=localhost;dbname=db5;", $username, $password); 
 
if ($database) { 
    // Query the menu table and retrieve the data 
    $menu_sql = "SELECT DishID, DishName, DishDescription, TotalPrice, DishImage FROM menu"; 
    $menu_statement = $database->query($menu_sql); 
    $menu_data = $menu_statement->fetchAll(PDO::FETCH_ASSOC); 

    $images_sql = "SELECT Dishimage FROM images"; // Select only the 'image' column
    $images_statement = $database->query($images_sql); 
    $images_data = $images_statement->fetchAll(PDO::FETCH_ASSOC); 

    $database = null; 

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
