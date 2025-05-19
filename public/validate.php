<?php
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['valid' => false, 'error' => 'Only POST requests are allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$submittedPassword = $data['password'] ?? '';

if (strlen($submittedPassword) !== 4 || !ctype_digit($submittedPassword)) {
    http_response_code(400);
    echo json_encode(['valid' => false, 'error' => 'Invalid password format']);
    exit;
}

$basePath = realpath(dirname(__DIR__)); // project root
$passwordsFile = $basePath . '/passwords.json';

if (!file_exists($passwordsFile)) {
    http_response_code(500);
    echo json_encode(['valid' => false, 'error' => 'Password data unavailable']);
    exit;
}

$passwords = json_decode(file_get_contents($passwordsFile), true);
$today = date('Y-m-d');

if (!isset($passwords[$today])) {
    http_response_code(403);
    echo json_encode(['valid' => false, 'error' => 'No password set for today']);
    exit;
}

$isValid = password_verify($submittedPassword, $passwords[$today]);

echo json_encode(['valid' => $isValid]);
