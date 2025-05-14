<?php
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

// Database connection
$conn = new mysqli("localhost", "username", "password", "test");

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

$stmt = $conn->prepare("SELECT * FROM barangay_id_requests ORDER BY date_submitted DESC");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $requests[] = [
        'id' => $row['id'],
        'residentInfo' => [
            'fullName' => $row['full_name'],
            'sex' => $row['sex'],
            'dob' => $row['dob'],
            'nationality' => $row['nationality'],
            'dateResidency' => $row['date_residency'],
            'contactNumber' => $row['contact_number'],
            'address' => $row['address']
        ],
        'emergencyInfo' => [
            'name' => $row['emergency_name'],
            'relationship' => $row['emergency_relationship'],
            'contactNumber' => $row['emergency_contact']
        ],
        'status' => $row['status'],
        'dateSubmitted' => $row['date_submitted']
    ];
}

echo json_encode($requests);
$conn->close();
?>