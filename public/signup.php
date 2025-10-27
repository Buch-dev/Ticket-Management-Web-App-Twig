<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/data.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $exists = array_filter($_SESSION['users'], fn($u) => $u['email'] === $email);

    if ($exists) {
        $message = 'Email already exists.';
    } else {
        $_SESSION['users'][] = compact('email', 'password', 'name');
        $message = 'Account created! You can login now.';
    }
}

echo $twig->render('signup.twig', ['message' => $message]);
