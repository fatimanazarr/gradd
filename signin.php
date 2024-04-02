<?php
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost;dbname=db5;", $username, $password);

if ($database) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if it's a sign-in request
        if (isset($_POST['phone']) && isset($_POST['password'])) {

            try {
                // Retrieve the form data
                $phone = $_POST['phone'];
                $password = $_POST['password'];

                // Prepare the SQL statement for sign-in
                $selectSQL = "SELECT * FROM Customers WHERE CustomerPhone = :phone AND CustomerPassword = :password";
                $statement = $database->prepare($selectSQL);

                // Bind the form data to the prepared statement parameters
                $statement->bindParam(':phone', $phone);
                $statement->bindParam(':password', $password);

                // Execute the statement
                $statement->execute();

                // Check if a row was returned
                if ($statement->rowCount() > 0) {
                    // Successful sign-in
                    $response = array("status" => "success");
                } else {
                    // Invalid credentials
                    $response = array("status" => "error", "message" => "Invalid credentials.");
                }
            } catch (PDOException $e) {
                // Handle any PDO exceptions
                $response = array("status" => "error", "message" => $e->getMessage());
            }
        } else {
            // Invalid sign-in request
            $response = array("status" => "error", "message" => "Invalid sign-in request.");
        }
    } else {
        // Fetch data request
        // Query the menu table and retrieve the data
        $menu_sql = "SELECT DishID, DishCategory, DishName, DishDescription, TotalPrice FROM menu";
        $menu_statement = $database->query($menu_sql);
$menu_data = $menu_statement->fetchAll(PDO::FETCH_ASSOC);

        $images_sql = "SELECT DishName, Dishimage FROM images"; // Select only the 'image' column
        $images_statement = $database->query($images_sql);
        $images_data = $images_statement->fetchAll(PDO::FETCH_ASSOC);

        $reviews_sql = "SELECT CustomerName, CustomerReview FROM reviews";
        $reviews_statement = $database->query($reviews_sql);
        $reviews_data = $reviews_statement->fetchAll(PDO::FETCH_ASSOC);

        $database = null;

        $response = array(
            "menu" => $menu_data,
            "images" => $images_data,
            "reviews" => $reviews_data
        );
    }
} else {
    // Handle the error case
    $response = array("status" => "error", "message" => "Failed to connect to the database.");
}

header("Content-Type: application/json");
echo json_encode($response);
exit; // Terminate the script to prevent any additional output
?>