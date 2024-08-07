<?php
$conn = new mysqli('localhost', 'root', '', 'todo_list_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "DELETE FROM tasks WHERE id = $id";
    $conn->query($sql);
}

$conn->close();
header('Location: index.php');
?>
