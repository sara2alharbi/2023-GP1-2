<?php
if (isset($_POST['temperature_id'])) {

    // Create a connection
    $conn = mysqli_connect("localhost","u169182990_elmam","E123l123", "u169182990_elmam");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate the input data
    $temperature_id = $_POST['temperature_id'];
    $air_id = $_POST['air_id'];
    $type = $_POST['type'];
    session_start();
    $user_email = $_SESSION['email'];
    // SQL query to insert data into the old_notifications table using prepared statements to prevent SQL injection
    $sql = "INSERT INTO deleted_notifications (temperature_id,airquality_id,type, user_email) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("iiss", $temperature_id,$air_id,$type, $user_email);

        if ($stmt->execute()) {
            $message =  "Data inserted successfully into old_notifications"." ".$user_email;
        } else {
            $message =  "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    } else {
        $message =  "Error preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
else {
    $message =  "Missing required data.";
}

echo json_encode($message);

?>
