<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/data.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$tickets = $_SESSION['tickets'];
$stats = [
    'total' => count($tickets),
    'open' => count(array_filter($tickets, fn($t) => $t['status'] === 'open')),
    'inProgress' => count(array_filter($tickets, fn($t) => $t['status'] === 'in_progress')),
    'closed' => count(array_filter($tickets, fn($t) => $t['status'] === 'closed')),
];

echo $twig->render('dashboard.twig', [
    'user' => $_SESSION['user'],
    'stats' => $stats
]);
