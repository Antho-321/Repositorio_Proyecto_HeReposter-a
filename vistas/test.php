<?php
$password = 'hola'; // replace 'YourPassword' with the actual password

// Hash the password using PHP's built-in function
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

echo "Hashed Password: " . $hashed_password;
?>