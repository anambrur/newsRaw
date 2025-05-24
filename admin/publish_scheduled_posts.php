<?php

try {
    include('includes/config.php');
    if (!$con) {
        throw new Exception("Database connection failed");
    }
    // Get current datetime
    $currentDateTime = date('Y-m-d H:i:s');

    // Get scheduled posts
    $query = mysqli_query(
        $con,
        "SELECT id FROM tblposts 
        WHERE ScheduledPublish IS NOT NULL 
        AND ScheduledPublish <= '$currentDateTime' 
        AND Is_Active = 0"
    );
    
    print_r($query);

    if (!$query) {
        throw new Exception("Failed to fetch scheduled posts");
    }

    while ($post = mysqli_fetch_assoc($query)) {
        $update = mysqli_query(
            $con,
            "UPDATE tblposts 
            SET Is_Active = 1, 
                PostingDate = '$currentDateTime',
                ScheduledPublish = NULL 
            WHERE id = " . (int)$post['id']
        );

        if (!$update) {
            throw new Exception("Failed to publish post ID: " . $post['id']);
        }
    }

    echo "Scheduled posts processed successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
