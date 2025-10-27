<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/data.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Handle new ticket form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $_SESSION['tickets'][] = [
        'title' => $title,
        'description' => $description,
        'status' => 'open',
        'priority' => $priority,
    ];
}

echo $twig->render('tickets.twig', [
    'tickets' => $_SESSION['tickets']
]);
