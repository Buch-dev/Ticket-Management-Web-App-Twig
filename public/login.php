<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/data.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = array_filter(
        $_SESSION['users'],
        fn($u) =>
        $u['email'] === $email && $u['password'] === $password
    );

    if ($user) {
        $_SESSION['user'] = array_values($user)[0];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}

echo $twig->render('login.twig', ['error' => $error]);
