<?php
include 'db.php';
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE blogs SET title=?, author=?, description=?, content=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $author, $description, $content, $id);
    $stmt->execute();
    header("Location: dashboard.php");
}

$result = $conn->query("SELECT * FROM blogs WHERE id = $id");
$blog = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Blog</title>
</head>
<body>
    <h1>Edit Blog</h1>
    <form method="POST">
        <input type="text" name="title" value="<?= htmlspecialchars($blog['title']) ?>" required>
        <input type="text" name="author" value="<?= htmlspecialchars($blog['author']) ?>" required>
        <textarea name="description" required><?= htmlspecialchars($blog['description']) ?></textarea>
        <textarea name="content" required><?= htmlspecialchars($blog['content']) ?></textarea>
        <button type="submit">Update</button>
    </form>
</body>
</html>
