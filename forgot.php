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
    $email = $_POST['email'];
    $newpassword = $_POST['new_password'];
    $confirmpassword = $_POST['confirm_password'];

    if ($newpassword == $confirmpassword) {
        $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND email = ?");
        $stmt->execute([$username, $email]);
        $user = $stmt->fetch();

        if ($user) {
            $update_stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
            $update_stmt->execute([$hashed_password, $username]);
            echo "Password updated successfully!";
            
        } else 
            echo "User not found!";
    } else 
        echo "Passwords do not match!";
}
?>