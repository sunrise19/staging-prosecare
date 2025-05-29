<?php
// api_update_hospital_info.php
include('../../STATIC_API/Config.php');  // your DB connection

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hospital_id = $_GET['hospital_id'] ?? null;
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    
    if (!$hospital_id || !$name || !$email || !$phone) {
        echo json_encode(['success' => false, 'message' => 'Missing data']);
        exit;
    }
    
    // Handle phone number transformation
    if (substr($phone, 0, 4) === '+234') {
        $phone = '0' . substr($phone, 4);
    }
    
    // Sanitize inputs (basic)
    $hospital_id = intval($hospital_id);
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    // Update query
    $sql = "UPDATE hospitals h
            JOIN users u ON h.user_id = u.user_id
            SET h.name = '$name', u.email = '$email', h.phone = '$phone'
            WHERE h.hospital_id = $hospital_id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'DB update failed']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$conn->close();
?>
