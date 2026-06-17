<?php
session_start();
require_once 'config/db.php';


?>
<!Doctype html>
<html>
    <head>
        <title>
            My Sister App ❤️❤️
        
        </title>
        <link rel="stylesheet" href="registration.css">
        

    </head>
   <body>
  <div class="page-wrapper">
    <div class="form-card">

      <img src="assets/lekha1.png" alt="Lelina" width="100px">
      <h1>Welcome! 🌟 Let's Get Started</h1>

      <form action="save.php" method="POST">

        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Age:</label>
        <input type="number" name="age" min="1" max="10" required>

        <label>Address:</label>
        <input type="text" name="address" required>

        <label>Class:</label>
        <input type="text" name="class" required>

        <input type="submit" value="Let's Start Learning! 🚀">

      </form>

    </div>
  </div>
</body>