<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<?php
include 'db.php';
$result = $conn->query("SELECT * FROM blogs");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <a href="index.php">Back to Home</a>
    <h2>Manage Blogs</h2>
    <a href="add_blog.php">Add New Blog</a>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <?= htmlspecialchars($row['title']) ?> 
                <a href="edit_blog.php?id=<?= $row['id'] ?>">Edit</a> 
                <a href="delete_blog.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this blog?');">Delete</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
