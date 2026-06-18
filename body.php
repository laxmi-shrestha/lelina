<?php
session_start();
require_once 'config/db.php';

// Security - if not registered go back
if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}

// Save progress when she finishes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = "body";
    $stars   = $_POST['stars'];
    $id      = $_SESSION['student_id'];

    $sql = "INSERT INTO progress (student_id, subject, stars, last_played)
            VALUES ('$id', '$subject', '$stars', NOW())
            ON DUPLICATE KEY UPDATE stars='$stars', last_played=NOW()";

    mysqli_query($conn, $sql);
}

// Load her saved progress
$id  = $_SESSION['student_id'];
$sql = "SELECT stars FROM progress 
        WHERE student_id='$id' AND subject='body'";
$result = mysqli_query($conn, $sql);
//$row    = mysqli_fetch_assoc($result);
$stars  = $row['stars'] ?? 0;  // if no record yet → 0 stars
?>
<!DOCTYPE html>
<html>
<head>
  <title>Body</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <img src="assets/lekha6.png" alt="" width="150px" height="200px">
  <br><br>
  <!-- Back button -->
  <a href="index.php">← Back</a>

  <h1>Body Parts 💪</h1>
  <p>Stars earned: <?php echo $stars; ?> ⭐</p>

  <!-- Instead of tab buttons -->
<div class="tabs">
  <a href="flashcard.php?subject=body" classcolors="tab-btn">📇 Flashcards</a>
  <a href="matching.php?subject=body"  class="tab-btn">🎮 Matching</a>
  <a href="drawing.php?subject=body"   class="tab-btn">🖍 Drawing</a>
  <a href="quiz.php?subject=body"      class="tab-btn">🎯 Quiz</a>
</div>


</div>



  <script src="script.js"></script>
</body>
</html>

