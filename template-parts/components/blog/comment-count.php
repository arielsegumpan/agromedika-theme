<?php
// Get the total number of comments
$total_comments = get_comments_number();

// Format the total comments count
$comments_text = $total_comments === 0 ? 'No comments' : ($total_comments === 1 ? '1 comment' : $total_comments . ' comments');
?>

<!-- Display the comments count with an icon -->
    <small class="text-secondary">
        <i class="bi bi-chat-dots text-primary border rounded-2 px-2 border-primary p-1 me-2"></i>
        <?php echo $comments_text; ?>
    </small>
