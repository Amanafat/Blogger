<?php
include 'db.php'; // Include database connection
session_start();

// Check if user is logged in (optional, remove if not using authentication)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    // Handle image upload
    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/"; // Make sure this directory exists
        $image = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;

        // Move uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file; // Store image path in the database
        } else {
            echo "<script>alert('Error uploading image!');</script>";
        }
    }

    // Insert into database
    $sql = "INSERT INTO blogs (title, content, image, created_at) VALUES ('$title', '$content', '$image', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Blog post created successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Create a New Blog Post</h2>
    <form action="create_post.php" method="post" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>
        
        <label>Content:</label>
        <textarea name="content" rows="5" required></textarea>
        
        <label>Image:</label>
        <input type="file" name="image">
        
        <button type="submit">Create Blog</button>
    </form>
    <br>
    <a href="dashboard.php">Go to Dashboard</a>
</body>
</html>
