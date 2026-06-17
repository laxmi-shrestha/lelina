<?php
session_start();
require_once 'config/db.php';


// If not registered yet → go to register.php
if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Learn & Play 🌟</title>
  <link rel="stylesheet" href="style.css">
  
</head>
<body>
  <img src="assets/image.png" alt="" height="200px" width="150px">
  <h1>Welcome to Learn & Play! 🌟</h1>
  <p>Choose what you want to learn today!</p>

  <div class="home-grid">

    <a href="abc.php">
      <div class="subject-card">
        <span>🔤</span>
        <p>ABC & Letters</p>
      </div>
    </a>

    <a href="nepali.php">
      <div class="subject-card">
       <span>🇳🇵</span>
        <p>नेपाली वर्णमाला</p>
     </div>
    </a>

    <a href="numbers.php">
      <div class="subject-card">
        <span>🔢</span>
        <p>Numbers & Counting</p>
      </div>
    </a>

    <a href="colors.php">
      <div class="subject-card">
        <span>🎨</span>
        <p>Colors & Shapes</p>
      </div>
    </a>

    <a href="animals.php">
      <div class="subject-card">
        <span>🐾</span>
        <p>Animals & Sounds</p>
      </div>
    </a>

    <a href="body.php">
  <div class="subject-card">
    <span>💪</span>
    <p>Body Parts</p>
  </div>
</a>

<a href="barakhadi.php">
  <div class="subject-card">
    <span>🇳🇵</span>
    <p>बाराखडी</p>
  </div>
</a>

<a href="domestic.php">
  <div class="subject-card">
    <span>🐄</span>
    <p>Domestic Animals</p>
  </div>
</a>

<a href="wild.php">
  <div class="subject-card">
    <span>🦁</span>
    <p>Wild Animals</p>
  </div>
</a>

<a href="water.php">
  <div class="subject-card">
    <span>🐟</span>
    <p>Water Animals</p>
  </div>
</a>

  </div>

</body>
</html>

