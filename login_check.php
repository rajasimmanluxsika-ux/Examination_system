<?php
session_start();
$conn = new mysqli("localhost", "root", "", "exam_system");

$name = $_POST['name'];
$id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];

// For demo - allow any login, just check not empty
if(!empty($name) && !empty($id) && !empty($email) && !empty($password)){
    $_SESSION['admin'] = $name;
    $_SESSION['id'] = $id;
    header("Location: dashboard.php");
    exit();
} else {
    echo "All fields required! <a href='login.php'>Go back</a>";
}
?>