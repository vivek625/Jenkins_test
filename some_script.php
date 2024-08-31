// File: some_script.php

<?php
// Include the database configuration file
include 'db_config.php';

// Now you can use the $conn variable to run queries
$sql = "SELECT * FROM some_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the connection when done
$conn->close();
?>

