<?php
header('Content-Type: application/json');

// Simple file-based storage (for demo - use a real database in production)
$storageFile = 'requests.json';

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

// Add timestamp and ID
$data['id'] = uniqid('REQ_');
$data['dateSubmitted'] = date('Y-m-d H:i:s');
$data['status'] = 'Pending';

// Load existing requests
$requests = [];
if (file_exists($storageFile)) {
    $requests = json_decode(file_get_contents($storageFile), true);
}

// Add new request
$requests[] = $data;

// Save back to file
file_put_contents($storageFile, json_encode($requests));

echo json_encode(['success' => true, 'message' => 'Request submitted']);
?>