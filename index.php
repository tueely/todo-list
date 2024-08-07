<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
</head>
<body>
    <h1>To-Do List</h1>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'todo_list_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Add task
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
        $task = $conn->real_escape_string($_POST['task']);
        $sql = "INSERT INTO tasks (task) VALUES ('$task')";
        $conn->query($sql);
    }

    // Get tasks
    $sql = "SELECT * FROM tasks";
    $result = $conn->query($sql);
    ?>

    <form method="post" action="">
        <input type="text" name="task" required>
        <button type="submit">Add Task</button>
    </form>

    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <?php if ($row['status']): ?>
                    <del><?php echo $row['task']; ?></del>
                <?php else: ?>
                    <?php echo $row['task']; ?>
                <?php endif; ?>
                <a href="complete.php?id=<?php echo $row['id']; ?>">Complete</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </li>
        <?php endwhile; ?>
    </ul>

    <?php $conn->close(); ?>
</body>
</html>
