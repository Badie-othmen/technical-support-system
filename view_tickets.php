<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}


require 'config/db.php';

/* UPDATE STATUS */
if (isset($_POST['update_status'])) {
    $id = $_POST['ticket_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tickets SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

/* DELETE */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM tickets WHERE id=$id");
}

$sql = "SELECT * FROM tickets ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<h2>All Support Tickets</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Problem</th>
    <th>Priority</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
while($row = $result->fetch_assoc()) {
?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['client_name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['problem_description'] ?></td>
    <td><?= $row['priority'] ?></td>

    <td>
        <form method="POST">
            <input type="hidden" name="ticket_id" value="<?= $row['id'] ?>">
            <select name="status">
                <option <?= $row['status']=='Open'?'selected':'' ?>>Open</option>
                <option <?= $row['status']=='In Progress'?'selected':'' ?>>In Progress</option>
                <option <?= $row['status']=='Resolved'?'selected':'' ?>>Resolved</option>
            </select>
            <button type="submit" name="update_status">Update</button>
        </form>
    </td>

    <td>
        <a href="?delete=<?= $row['id'] ?>" 
           onclick="return confirm('Are you sure?')">
           Delete
        </a>
    </td>
</tr>
<?php } ?>

</table>
