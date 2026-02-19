<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Submit Support Ticket</h2>

    <?php if(isset($success)) { ?>
        <div class="success-message">Ticket added successfully ✅</div>
    <?php } ?>

    <form method="POST">
        <label>Full Name</label>
        <input type="text" name="client_name" required>

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Describe your problem</label>
        <textarea name="problem_description" rows="4" required></textarea>

        <label>Priority</label>
        <select name="priority">
            <option value="Low">🟢 Low</option>
            <option value="Medium">🟡 Medium</option>
            <option value="High">🔴 High</option>
        </select>

        <button type="submit">Submit Ticket</button>
    </form>
</div>

</body>
</html>
