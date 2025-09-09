<?php
// index.php - Main application file
session_start();

include_once 'config.php';
include_once 'Novel.php';

$database = new Database();
$db = $database->getConnection();
$novel = new Novel($db);

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$message = '';

// Handle form submissions
if ($_POST) {
    switch ($action) {
        case 'create':
            $novel->title = $_POST['title'];
            $novel->author = $_POST['author'];
            $novel->genre = $_POST['genre'];
            $novel->publication_year = $_POST['publication_year'];
            $novel->description = $_POST['description'];
            $novel->rating = $_POST['rating'];
            
            if ($novel->create()) {
                $message = "Novel added successfully! 💖";
                $action = 'list';
            } else {
                $message = "Unable to add novel.";
            }
            break;
            
        case 'update':
            $novel->id = $_POST['id'];
            $novel->title = $_POST['title'];
            $novel->author = $_POST['author'];
            $novel->genre = $_POST['genre'];
            $novel->publication_year = $_POST['publication_year'];
            $novel->description = $_POST['description'];
            $novel->rating = $_POST['rating'];
            
            if ($novel->update()) {
                $message = "Novel updated successfully! ✨";
                $action = 'list';
            } else {
                $message = "Unable to update novel.";
            }
            break;
            
        case 'delete':
            $novel->id = $_POST['id'];
            if ($novel->delete()) {
                $message = "Novel deleted successfully! 🗑️";
                $action = 'list';
            } else {
                $message = "Unable to delete novel.";
            }
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Novel Collection 📚💕</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* your CSS stays the same as before */
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-book-heart"></i> My Novel Collection</h1>
            <p class="subtitle">A cozy place for all my favorite stories 💕</p>
        </header>

        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="nav-buttons">
            <a href="?action=list" class="btn">
                <i class="fas fa-list"></i> View All Novels
            </a>
            <a href="?action=create" class="btn btn-secondary">
                <i class="fas fa-plus"></i> Add New Novel
            </a>
        </div>

        <?php if ($action == 'create'): ?>
            <!-- Create Form -->
            <!-- (form code stays the same as in your original file) -->

        <?php elseif ($action == 'edit'): ?>
            <!-- Edit Form -->
            <!-- (edit form code stays the same as in your original file) -->

        <?php else: ?>
            <!-- List novels -->
            <!-- (list code stays the same as in your original file) -->
        <?php endif; ?>
    </div>
</body>
</html>
