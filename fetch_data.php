<?php
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost;dbname=db5;", $username, $password);

if ($database) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Retrieve the form data
            $customerFirstName = $_POST['CustomerFirstName'] ?? '';
            $customerLastName = $_POST['CustomerLastName'] ?? '';
            $customerPhone = $_POST['CustomerPhone'] ?? '';
            $customerPassword = $_POST['CustomerPassword'] ?? '';

            // Debugging statements
            var_dump($customerFirstName);
            var_dump($customerLastName);
            var_dump($customerPhone);
            var_dump($customerPassword);

            // Prepare the SQL statement
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
                // Successful insertion
                $response = array("status" => "success");
            } else {
                // Error occurred during insertion
                $errorInfo = $statement->errorInfo();
                $response = array("status" => "error", "message" => $errorInfo[2]);
            }
        } catch (PDOException $e) {
            // Handle any PDO exceptions
            $response = array("status" => "error", "message" => $e->getMessage());
        }
    } else {
        // Handle the case when the request method is not "POST"
        $response = array("status" => "error", "message" => "Invalid request method.");
    }
} else {
    // Handle the error case
    $response = array("status" => "error", "message" => "Failed to connect to the database.");
}

header("Content-Type: application/json");
echo json_encode($response);
exit; // Terminate the script to prevent any additional output
?>