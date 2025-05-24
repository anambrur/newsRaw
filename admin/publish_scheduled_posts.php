<?php
include('includes/config.php');

// Get all scheduled posts that should be published now
$currentDateTime = date('Y-m-d H:i:s');
$query = mysqli_query(
    $con,
    "SELECT id FROM tblposts 
    WHERE ScheduledPublish IS NOT NULL 
    AND ScheduledPublish <= '$currentDateTime' 
    AND Is_Active = 0"
);


print_r($query);
while ($post = mysqli_fetch_assoc($query)) {
    // Update post to published status
    mysqli_query(
        $con,
        "UPDATE tblposts 
        SET Is_Active = 1, 
            PostingDate = '$currentDateTime',
            ScheduledPublish = NULL 
        WHERE id = " . $post['id']
    );
}

echo "Scheduled posts processed successfully.";
