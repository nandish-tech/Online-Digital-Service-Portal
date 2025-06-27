<?php
// Get data from the form
$Name = $_POST["name"];
$Email = $_POST["email"];
$Transaction_refNo = $_POST["transaction_ref"];

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "nandishportal");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully....!<br>";
}

// Check if Transaction_refNo already exists
$check_sql = "SELECT COUNT(*) FROM Transaction WHERE Transaction_refNo = ?";
$check_stmt = mysqli_prepare($conn, $check_sql);

if ($check_stmt) {
    mysqli_stmt_bind_param($check_stmt, "s", $Transaction_refNo);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_bind_result($check_stmt, $count);
    mysqli_stmt_fetch($check_stmt);
    mysqli_stmt_close($check_stmt); // Close the check statement

    if ($count > 0) {
        // Duplicate entry found
        echo '<script type="text/javascript">';
        echo 'alert("Error: Duplicate Transaction Reference Number!");';
        echo 'window.history.back();'; // Go back to form
        echo '</script>';
    } else {
        // Proceed with insert
        $sql = "INSERT INTO Transaction (Name, Email, Transaction_refNo) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $Name, $Email, $Transaction_refNo);

            if (mysqli_stmt_execute($stmt)) {
                echo '<script type="text/javascript">';
                echo 'alert("Data is added successfully...!");';
                echo 'window.location.href = "upload.html";';
                echo '</script>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt); // Close the insert statement
        } else {
            echo "SQL Preparation Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "SQL Preparation Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
