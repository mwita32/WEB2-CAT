<?php
session_start();
$host = 'localhost';
$dbname = 'user_data';
$dbusername = 'root';
$dbpassword = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->execute([$username, $password]); 
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) 
        echo "Login successful!";

    else 
        echo "Invalid username or password!";
}
?>