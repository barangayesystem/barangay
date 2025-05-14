<?php
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

// Get the input data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validate input
if (!$data || !isset($data['id']) || !isset($data['status'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// Load existing requests
$requests = [];
if (file_exists('requests.json')) {
    $requests = json_decode(file_get_contents('requests.json'), true);
}

// Find and update the request
$updated = false;
foreach ($requests as &$request) {
    if ($request['id'] === $data['id']) {
        $request['status'] = $data['status'];
        $request['date'] = date('m/d/Y'); // Add current date
        $updated = true;
        break;
    }
}

// Save back to file
file_put_contents('requests.json', json_encode($requests));

echo json_encode(['success' => $updated]);
?>