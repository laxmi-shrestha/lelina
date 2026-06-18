<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}
$id     = $_SESSION['student_id'];
$sql    = "SELECT stars FROM progress WHERE student_id='$id' AND subject='nepali_numbers'";
$result = mysqli_query($conn, $sql);
$row    = mysqli_fetch_assoc($result);
$stars  = $row['stars'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
  <title>नेपाली संख्या</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="subject-wrapper">
  <a href="index.php" class="back-btn">← Back</a>
  <div class="subject-header">
    <img src="assets/lekha1.png" width="60px" height="60px">
    <div>
      <h1>🔢 नेपाली संख्या</h1>
      <p>Stars earned: <?php echo str_repeat('⭐', $stars) ?: '☆☆☆'; ?></p>
    </div>
  </div>
  <div class="tabs">
    <a href="flashcard.php?subject=nepali_numbers" class="tab-btn">📇 Flashcards</a>
    <a href="matching.php?subject=nepali_numbers"  class="tab-btn">🎮 Matching</a>
    <a href="drawing.php?subject=nepali_numbers"   class="tab-btn">🖍 Drawing</a>
    <a href="quiz.php?subject=nepali_numbers"      class="tab-btn">🎯 Quiz</a>
  </div>
</div>
</body>
</html>