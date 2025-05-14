<?php
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

$storageFile = 'requests.json';

if (file_exists($storageFile)) {
    $requests = json_decode(file_get_contents($storageFile), true);
    echo json_encode($requests ?: []);
} else {
    echo json_encode([]);
}
?>