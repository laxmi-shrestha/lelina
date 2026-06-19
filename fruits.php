<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}

// Save progress when she finishes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = "fruits";
    $stars   = $_POST['stars'];
    $id      = $_SESSION['student_id'];

    $sql = "INSERT INTO progress (student_id, subject, stars, last_played)
            VALUES ('$id', '$subject', '$stars', NOW())
            ON DUPLICATE KEY UPDATE stars='$stars', last_played=NOW()";

    mysqli_query($conn, $sql);
}




$id     = $_SESSION['student_id'];
$sql    = "SELECT stars FROM progress 
            WHERE student_id='$id' AND subject='fruits'";
$result = mysqli_query($conn, $sql);
//$row    = mysqli_fetch_assoc($result);
$stars  = $row['stars'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Fruits 🍎</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
      <img src="assets/lekha1.png" alt="" width="150px" height="200px">
  <br><br>
  <!-- Back button -->
  <a href="index.php">← Back</a>

  <h1>Fruits 🍎</h1>
  <p>Stars earned: <?php echo $stars; ?> ⭐</p>
  <div class="tabs">
    <a href="flashcard.php?subject=fruits" class="tab-btn">📇 Flashcards</a>
    <a href="matching.php?subject=fruits"  class="tab-btn">🎮 Matching</a>
    <a href="drawing.php?subject=fruits"   class="tab-btn">🖍 Drawing</a>
    <a href="quiz.php?subject=fruits"      class="tab-btn">🎯 Quiz</a>
  </div>
</div>
    <script src="script.js"></script>
</body>
</html>