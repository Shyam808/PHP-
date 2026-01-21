<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "travel_form";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
    die("Database connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name   = isset($_POST['name'])   ? trim($_POST['name'])   : '';
    $age    = isset($_POST['age'])    ? (int)$_POST['age']    : 0;
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $email  = isset($_POST['email'])  ? trim($_POST['email'])  : '';
    $number = isset($_POST['number']) ? trim($_POST['number']) : '';
    $other  = isset($_POST['other'])  ? trim($_POST['other'])  : '';

    $sql = "INSERT INTO users (`name`, `age`, `gender`, `email`, `number`, `other`)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sissss", $name, $age, $gender, $email, $number, $other);
        if (mysqli_stmt_execute($stmt)) {
            echo "<h2 style='text-align:center;color:green;margin-top:50px;'>
                  Form Submitted Successfully!
                  </h2>";
        } else {
            echo "Error executing statement: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Prepare failed: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
