<?php
require_once 'db.php';
echo $style;

$id = $_GET['id'] ?? null;

// Handle the update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("UPDATE students SET course_id = ?, student_name = ?, email = ? WHERE id = ?");
    $stmt->execute([$_POST['course_id'], $_POST['student_name'], $_POST['email'], $id]);
    header("Location: index.php");
}

// Fetch current student data
$student = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$student->execute([$id]);
$current = $student->fetch();

$courses = $pdo->query("SELECT * FROM courses")->fetchAll();
?>

<div class="card">
    <h2>Edit Student Profile</h2>
    <form method="POST">
        <label>Student Name</label>
        <input type="text" name="student_name" value="<?= htmlspecialchars($current['student_name']) ?>" required>
        
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($current['email']) ?>" required>
        
        <label>Change Course</label>
        <select name="course_id">
            <?php foreach ($courses as $c): ?>
                <option value="<?= $c['id'] ?>" <?= ($c['id'] == $current['course_id']) ? 'selected' : '' ?>>
                    <?= $c['course_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Update Record</button>
            <a href="index.php" class="btn btn-secondary">Go Back</a>
        </div>
    </form>
</div>