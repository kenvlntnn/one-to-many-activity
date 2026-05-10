<?php
require_once 'db.php';
echo $style;

$id = $_GET['id'] ?? null;

if (isset($_POST['confirm_delete'])) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
}

$stmt = $pdo->prepare("SELECT student_name FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();
?>

<div class="card" style="text-align: center;">
    <h2 style="color: #e74c3c;">Wait!</h2>
    <p>Are you sure you want to remove <strong><?= htmlspecialchars($student['student_name']) ?></strong> from the system?</p>
    <p style="font-size: 0.9em; color: #7f8c8d;">This action cannot be undone.</p>
    
    <form method="POST">
        <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete Student</button>
        <a href="index.php" class="btn btn-secondary">No, Keep Student</a>
    </form>
</div>