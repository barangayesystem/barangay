<?php
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

try {
    $storageFile = 'requests.json';
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Invalid data');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name']; // If sending form data
    $id = $_POST['id'];
    } else {
    http_response_code(405); // Method Not Allowed
    echo "Error: Only POST requests are allowed!";
    }
    
    // Load existing requests
    $requests = [];
    if (file_exists($storageFile) && filesize($storageFile) > 0) {
        $fileContent = file_get_contents($storageFile);
        $requests = json_decode($fileContent, true) ?: [];
    }

    // Generate ID and timestamps
    $year = date('Y');
    $nextNumber = count($requests) + 1;
    
    // Add metadata to request
    $data['id'] = 'BRGY-' . $year . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    $data['dateSubmitted'] = date('Y-m-d H:i:s'); // ISO format for storage
    $data['status'] = 'Pending';
    $data['date'] = date('F j, Y'); // More readable format for display
    $data['timestamp'] = time(); // Unix timestamp for sorting

    $requests[] = $data;
    file_put_contents($storageFile, json_encode($requests, JSON_PRETTY_PRINT));

    echo json_encode([
        'success' => true, 
        'message' => 'Request submitted',
        'requestId' => $data['id'],
        'submittedDate' => $data['date']
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}
?>
