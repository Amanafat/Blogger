<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO blogs (title, author, description, content) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $author, $description, $content);
    $stmt->execute();
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Blog</title>
</head>
<body>
    <h1>Add a New Blog</h1>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="author" placeholder="Author" required>
        <textarea name="description" placeholder="Short Description" required></textarea>
        <textarea name="content" placeholder="Full Content" required></textarea>
        <button type="submit">Publish</button>
    </form>
</body>
</html>
