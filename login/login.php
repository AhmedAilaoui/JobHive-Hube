<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobhive_hub";

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $connection->real_escape_string($_POST['email']);
$mot_de_passe = $connection->real_escape_string($_POST['password']);

$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $password_plain = $connection->real_escape_string($_POST['password']);

    
    $hashed_password_from_database = $row['mot_de_passe'];
    var_dump("Entered Password (trimmed): " . trim($password_plain));
    var_dump("Hashed Password from Database (trimmed): " . trim($hashed_password_from_database));

    if (password_verify(trim($password_plain), $hashed_password_from_database)) {
    echo "Password is correct";
        echo "Password is correct";
        $role = $row['role'];
        switch ($role) {
            case 'utilisateur':
                $_SESSION['id_user'] = $row['id_user'];
                header("Location: ../page-utilisateur/home11.php");
                break;
            case 'employeur':
                $_SESSION['id_user'] = $row['id_user'];
                header("Location: ../page-employeur/employeurr.php");
                break;
            default:
                echo "Invalid role.";
                break;
        }
        exit();
    } else {
        echo "Password is incorrect";
    }
} else {
    echo "Invalid email or password.";
}

$connection->close();
?>