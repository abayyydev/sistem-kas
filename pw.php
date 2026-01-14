<?php
// Membuat hash password
$password = "user";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo "Password Hash: " . $hashedPassword . "<br>";

// Verifikasi password saat login
$input = "user";

if (password_verify($input, $hashedPassword)) {
    echo "Password cocok!";
} else {
    echo "Password salah!";
}
?>