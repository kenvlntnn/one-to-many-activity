<?php 
require_once 'db.php';
echo $style;

$stmt = $pdo->query("SELECT students.*, courses.course_name FROM students JOIN courses ON students.course_id = courses.id");
$students = $stmt->fetchAll();
?>

<div class="card" style="max-width: 800px;">
    <h2>Student Directory</h2>
    <a href="insert.php" class="btn btn-primary">+ Register New Student</a>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $s): ?>
            <tr>
                <td><?= htmlspecialchars($s['student_name']) ?></td>
                <td><?= htmlspecialchars($s['course_name']) ?></td>
                <td>
                    <a href="update.php?id=<?= $s['id'] ?>" style="color: #3498db;">Edit</a> | 
                    <a href="delete.php?id=<?= $s['id'] ?>" style="color: #e74c3c;">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>