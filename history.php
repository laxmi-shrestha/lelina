<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}

$id = $_SESSION['student_id'];

// Get student info
$sql    = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);

// Get all progress
$sql    = "SELECT * FROM progress WHERE student_id='$id' ORDER BY last_played DESC";
$result = mysqli_query($conn, $sql);
$progress = [];
while ($row = mysqli_fetch_assoc($result)) {
    $progress[] = $row;
}

// Calculate total stars
$totalStars = 0;
foreach ($progress as $p) {
    $totalStars += $p['stars'];
}

// Subject titles and emojis
$subjects = [
  'abc'              => ['title'=>'ABC & Letters',       'emoji'=>'🔤'],
  'numbers'          => ['title'=>'Numbers & Counting',  'emoji'=>'🔢'],
  'colors'           => ['title'=>'Colors & Shapes',     'emoji'=>'🎨'],
  'animals'          => ['title'=>'Animals & Sounds',    'emoji'=>'🐾'],
  'nepali'           => ['title'=>'नेपाली वर्णमाला',     'emoji'=>'🇳🇵'],
  'nepali_numbers'   => ['title'=>'नेपाली संख्या',       'emoji'=>'🔢'],
  'barakhadi'        => ['title'=>'बाराखडी',             'emoji'=>'📝'],
  'body_parts'       => ['title'=>'Body Parts',          'emoji'=>'💪'],
  'domestic_animals' => ['title'=>'Domestic Animals',    'emoji'=>'🐄'],
  'wild_animals'     => ['title'=>'Wild Animals',        'emoji'=>'🦁'],
  'water_animals'    => ['title'=>'Water Animals',       'emoji'=>'🐟'],
  'fruits'           => ['title'=>'Fruits',              'emoji'=>'🍎'],
  'vegetables'       => ['title'=>'Vegetables',          'emoji'=>'🥦'],
];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Score History 📊</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="subject-wrapper">

  <a href="index.php" class="back-btn">← Back</a>

  <!-- Profile Card -->
  <div class="history-profile">
    <img src="assets/lekha1.png" width="80px" height="80px">
    <div class="history-profile-info">
      <h2><?php echo $student['name']; ?> 🌟</h2>
      <p>Age: <?php echo $student['age']; ?> years</p>
      <p>Class: <?php echo $student['class']; ?></p>
      <p>Address: <?php echo $student['address']; ?></p>
    </div>
  </div>

  <!-- Total Stars Banner -->
  <div class="total-stars-banner">
    <div class="total-stars-emoji">🏆</div>
    <div class="total-stars-count"><?php echo $totalStars; ?> Total Stars</div>
    <div class="total-stars-sub">
      <?php echo count($progress); ?> subjects completed
    </div>
  </div>

  <!-- Progress Cards -->
  <h2 class="history-section-title">📊 Subject Progress</h2>

  <?php if (empty($progress)): ?>
    <div class="history-empty">
      <div style="font-size:48px;">📚</div>
      <p>No progress yet!</p>
      <p>Start learning to earn stars! ⭐</p>
      <a href="index.php" class="play-again-btn">Start Learning!</a>
    </div>
  <?php else: ?>

    <div class="history-grid">
      <?php foreach ($progress as $p):
        $subjectKey = $p['subject'];
        $info       = $subjects[$subjectKey] ?? ['title'=>$subjectKey, 'emoji'=>'📚'];
        $stars      = $p['stars'];
        $date       = $p['last_played'] ? date('M d, Y', strtotime($p['last_played'])) : 'Not played';
        $pct        = min(($stars / 3) * 100, 100);
      ?>
        <div class="history-card">
          <div class="history-card-top">
            <span class="history-emoji"><?php echo $info['emoji']; ?></span>
            <div class="history-card-info">
              <div class="history-card-title"><?php echo $info['title']; ?></div>
              <div class="history-card-date">Last played: <?php echo $date; ?></div>
            </div>
          </div>

          <!-- Star display -->
          <div class="history-stars">
            <?php
              for ($i = 1; $i <= 3; $i++) {
                echo $i <= $stars ? '⭐' : '☆';
              }
            ?>
            <span class="history-star-count"><?php echo $stars; ?>/3</span>
          </div>

          <!-- Progress bar -->
          <div class="history-bar-wrap">
            <div class="history-bar" style="width:<?php echo $pct; ?>%"></div>
          </div>

          <!-- Play again button -->
          <a href="<?php echo $subjectKey; ?>.php" class="history-play-btn">
            Play Again 🎮
          </a>
        </div>
      <?php endforeach; ?>
    </div>

  <?php endif; ?>

  <!-- Subjects not started yet -->
  <?php
    $startedSubjects = array_column($progress, 'subject');
    $notStarted = array_diff(array_keys($subjects), $startedSubjects);
  ?>

  <?php if (!empty($notStarted)): ?>
    <h2 class="history-section-title">🔒 Not Started Yet</h2>
    <div class="history-grid">
      <?php foreach ($notStarted as $key):
        $info = $subjects[$key];
      ?>
        <div class="history-card locked">
          <div class="history-card-top">
            <span class="history-emoji"><?php echo $info['emoji']; ?></span>
            <div class="history-card-info">
              <div class="history-card-title"><?php echo $info['title']; ?></div>
              <div class="history-card-date">Not started yet</div>
            </div>
          </div>
          <div class="history-stars">☆☆☆ <span class="history-star-count">0/3</span></div>
          <div class="history-bar-wrap">
            <div class="history-bar" style="width:0%"></div>
          </div>
          <a href="<?php echo $key; ?>.php" class="history-play-btn">
            Start Now! 🚀
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

</div>
</body>
</html>