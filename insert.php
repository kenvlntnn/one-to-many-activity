<?php
require_once 'db.php';
echo $style;

// Process the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO students (course_id, student_name, email) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['course_id'], $_POST['student_name'], $_POST['email']]);
    header("Location: index.php");
}

$courses = $pdo->query("SELECT * FROM courses")->fetchAll();
?>

<div class="card">
    <h2>Add New Student</h2>
    <form method="POST">
        <label>Full Name</label>
        <input type="text" name="student_name" required>
        
        <label>Email Address</label>
        <input type="email" name="email" required>
        
        <label>Select Course</label>
        <select name="course_id" required>
            <?php foreach ($courses as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['course_name'] ?></option>
            <?php endforeach; ?>
        </select>
        
        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Save Student</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>