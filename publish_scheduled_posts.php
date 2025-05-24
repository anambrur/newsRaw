<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/home/mhanamco/news.mhanam.com/logs/scheduled_posts_errors.log');

// Define root path
define('ROOT_PATH', '/home/mhanamco/news.mhanam.com/');

// Log execution
file_put_contents(
    ROOT_PATH . 'logs/scheduled_posts.log',
    "[" . date('Y-m-d H:i:s') . "] Cron job started\n",
    FILE_APPEND
);

// Include config with full path
include(ROOT_PATH . 'includes/config.php');

// Verify database connection
if (!$con) {
    $error = "Database connection failed: " . mysqli_connect_error();
    file_put_contents(
        ROOT_PATH . 'logs/scheduled_posts.log',
        "[" . date('Y-m-d H:i:s') . "] $error\n",
        FILE_APPEND
    );
    exit(1);
}

// Set timezone to match your location
date_default_timezone_set('Asia/Dhaka');

// Process scheduled posts
$currentDateTime = date('Y-m-d H:i:s');
$query = mysqli_query(
    $con,
    "SELECT id FROM tblposts 
    WHERE ScheduledPublish IS NOT NULL 
    AND ScheduledPublish <= '$currentDateTime' 
    AND Is_Active = 0"
);

if (!$query) {
    $error = "Query failed: " . mysqli_error($con);
    file_put_contents(
        ROOT_PATH . 'logs/scheduled_posts.log',
        "[" . date('Y-m-d H:i:s') . "] $error\n",
        FILE_APPEND
    );
    exit(1);
}

$count = mysqli_num_rows($query);
file_put_contents(
    ROOT_PATH . 'logs/scheduled_posts.log',
    "[" . date('Y-m-d H:i:s') . "] Found $count posts to publish\n",
    FILE_APPEND
);

if ($count > 0) {
    $successCount = 0;
    while ($post = mysqli_fetch_assoc($query)) {
        $result = mysqli_query(
            $con,
            "UPDATE tblposts 
            SET Is_Active = 1, 
                PostingDate = '$currentDateTime',
                ScheduledPublish = NULL 
            WHERE id = " . $post['id']
        );

        if ($result) {
            $successCount++;
        } else {
            file_put_contents(
                ROOT_PATH . 'logs/scheduled_posts.log',
                "[" . date('Y-m-d H:i:s') . "] Failed to update post ID " . $post['id'] . ": " . mysqli_error($con) . "\n",
                FILE_APPEND
            );
        }
    }

    file_put_contents(
        ROOT_PATH . 'logs/scheduled_posts.log',
        "[" . date('Y-m-d H:i:s') . "] Successfully published $successCount/$count posts\n",
        FILE_APPEND
    );
}

file_put_contents(
    ROOT_PATH . 'logs/scheduled_posts.log',
    "[" . date('Y-m-d H:i:s') . "] Cron job completed\n",
    FILE_APPEND
);
echo "Processed $count scheduled posts";
