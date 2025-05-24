<?php
session_start();
include('includes/config.php');

// Define status constants
define('STATUS_ACTIVE', 1);
define('STATUS_DRAFT', 2);
define('STATUS_SCHEDULED', 3);
define('STATUS_BIN', 4);

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['login']) || strlen($_SESSION['login']) == 0) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

// Get and validate parameters
$postId = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
$newStatus = isset($_POST['new_status']) ? intval($_POST['new_status']) : 0;

if ($postId <= 0 || !in_array($newStatus, [STATUS_ACTIVE, STATUS_DRAFT, STATUS_SCHEDULED])) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit();
}

// Get current status first
$query = mysqli_query($con, "SELECT Is_Active FROM tblposts WHERE id = $postId");
if (mysqli_num_rows($query) == 0) {
    echo json_encode(['success' => false, 'message' => 'Post not found']);
    exit();
}

$row = mysqli_fetch_assoc($query);
$oldStatus = $row['Is_Active'];

// Update status
$updateQuery = mysqli_query($con, "UPDATE tblposts SET Is_Active = $newStatus WHERE id = $postId");

if ($updateQuery && mysqli_affected_rows($con) > 0) {
    echo json_encode([
        'success' => true,
        'message' => 'Status updated',
        'old_status' => $oldStatus
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Update failed: ' . mysqli_error($con),
        'old_status' => $oldStatus
    ]);
}
