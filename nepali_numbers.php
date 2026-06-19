<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}

// Save progress when she finishes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = "nepali_numbers";
    $stars   = $_POST['stars'];
    $id      = $_SESSION['student_id'];

    $sql = "INSERT INTO progress (student_id, subject, stars, last_played)
            VALUES ('$id', '$subject', '$stars', NOW())
            ON DUPLICATE KEY UPDATE stars='$stars', last_played=NOW()";
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
  <img src="assets/lekha6.png" alt="" width="150px" height="200px">
  <br><br>
  <!-- Back button -->
  <a href="index.php">← Back</a>

  <h1>नेपाली संख्या</h1>
  <p>Stars earned: <?php echo $stars; ?> ⭐</p>


  <div class="tabs">
    <a href="flashcard.php?subject=nepali_numbers" class="tab-btn">📇 Flashcards</a>
    <a href="matching.php?subject=nepali_numbers"  class="tab-btn">🎮 Matching</a>
    <a href="drawing.php?subject=nepali_numbers"   class="tab-btn">🖍 Drawing</a>
    <a href="quiz.php?subject=nepali_numbers"      class="tab-btn">🎯 Quiz</a>
  </div>
    <script src="script.js"></script>
</div>
</body>
</html>