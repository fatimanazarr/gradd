<?php
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost;dbname=db5;", $username, $password);

if ($database) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if it's a sign-up request
        if (isset($_POST['CustomerFirstName']) && isset($_POST['CustomerLastName']) &&
            isset($_POST['CustomerPhone']) && isset($_POST['CustomerPassword'])) {

            try {
                // Retrieve the form data
                $customerFirstName = $_POST['CustomerFirstName'];
                $customerLastName = $_POST['CustomerLastName'];
                $customerPhone = $_POST['CustomerPhone'];
                $customerPassword = $_POST['CustomerPassword'];

                // Prepare the SQL statement for sign-up
                $insertSQL = "INSERT INTO Customers (CustomerFirstName, CustomerLastName, CustomerPhone, CustomerPassword) 
                              VALUES (:CustomerFirstName, :CustomerLastName, :CustomerPhone, :CustomerPassword)";
                $statement = $database->prepare($insertSQL);

                // Bind the form data to the prepared statement parameters
                $statement->bindParam(':CustomerFirstName', $customerFirstName);
                $statement->bindParam(':CustomerLastName', $customerLastName);
                $statement->bindParam(':CustomerPhone', $customerPhone);
                $statement->bindParam(':CustomerPassword', $customerPassword);

                // Execute the statement
                if ($statement->execute()) {
                    // Successful sign-up
                    $response = array("status" => "success");
                } else {
                    // Error occurred during sign-up
                    $errorInfo = $statement->errorInfo();
                    $response = array("status" => "error", "message" => $errorInfo[2]);
                }
            } catch (PDOException $e) {
                // Handle any PDO exceptions
                $response = array("status" => "error", "message" => $e->getMessage());
            }
        } else if (isset($_POST['order_type']) && isset($_POST['customer_name']) &&
                   isset($_POST['Customer_table_num']) && isset($_POST['Pickup_time']) &&
                   isset($_POST['order_count']) && isset($_POST['order_item']) &&
                   isset($_POST['order_price']) && isset($_POST['order_sale'])) {

            try {
                // Retrieve the form data
                $orderType = $_POST['order_type'];
                $customerName = $_POST['customer_name'];
                $customerTableNum = $_POST['Customer_table_num'];
                $pickupTime = $_POST['Pickup_time'];
                $orderCount = $_POST['order_count'];
                $orderItem = $_POST['order_item'];
                $orderPrice = $_POST['order_price'];
                $orderSale = $_POST['order_sale'];

                // Prepare the SQL statement for adding an order
                $insertOrderSQL = "INSERT INTO OrderTable (order_type, customer_name, Customer_table_num, Pickup_time, order_count, order_item, order_price, order_sale) 
                              VALUES (:order_type, :customer_name, :Customer_table_num, :Pickup_time, :order_count, :order_item, :order_price, :order_sale)";
                $orderStatement = $database->prepare($insertOrderSQL);

                // Bind the form data to the prepared statement parameters
                $orderStatement->bindParam(':order_type', $orderType);
                $orderStatement->bindParam(':customer_name', $customerName);
                $orderStatement->bindParam(':Customer_table_num', $customerTableNum);
                $orderStatement->bindParam(':Pickup_time', $pickupTime);
                $orderStatement->bindParam(':order_count', $orderCount);
                $orderStatement->bindParam(':order_item', $orderItem);
                $orderStatement->bindParam(':order_price', $orderPrice);
                $orderStatement->bindParam(':order_sale', $orderSale);

                // Execute the statement
                if ($orderStatement->execute()) {
                    // Successful order placement
                    $response = array("status" => "success");
                } else {
                    // Error occurred during order placement
                    $errorInfo = $orderStatement->errorInfo();
                    $response = array("status" => "error", "message" => $errorInfo[2]);
                }
            } catch (PDOException $e) {
                // Handle any PDO exceptions
                $response = array("status" => "error", "message" => $e->getMessage());
            }
        } else {
            // Invalid request
            $response = array("status" => "error", "message" => "Invalid request.");
        }
    } else {
        // Fetch data request
        // Query the menu table and retrieve the data
        $menu_sql = "SELECT DishID, DishCategory,DishName, DishDescription, TotalPrice FROM menu";
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