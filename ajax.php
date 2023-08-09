<?php
include_once 'db.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header('Location:login.php?empty');
    } else {
        // Assuming $connection is your database connection
        $query = "SELECT * FROM user WHERE (username = '$email' OR email='$email') AND password='$password'";
        
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            header('Location:index.php?dashboard');
        } else {
            header('Location:login.php?loginE');
        }
    }
}
?>