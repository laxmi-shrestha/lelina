<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}

$subject = $_GET['subject'] ?? 'abc';

$quizData = [
  'abc' => [
    ['question'=>'A is for?',         'options'=>['Apple','Banana','Cat','Dog'],    'answer'=>'Apple'],
    ['question'=>'B is for?',         'options'=>['Ant','Ball','Car','Egg'],        'answer'=>'Ball'],
    ['question'=>'C is for?',         'options'=>['Dog','Fish','Cat','Hat'],        'answer'=>'Cat'],
    ['question'=>'D is for?',         'options'=>['Dog','Egg','Fish','Grapes'],     'answer'=>'Dog'],
    ['question'=>'E is for?',         'options'=>['Apple','Ball','Egg','Kite'],     'answer'=>'Egg'],
    ['question'=>'F is for?',         'options'=>['Grapes','Fish','Hat','Ice'],     'answer'=>'Fish'],
    ['question'=>'G is for?',         'options'=>['Grapes','Hat','Juice','Kite'],   'answer'=>'Grapes'],
    ['question'=>'H is for?',         'options'=>['Ice','Hat','Juice','Lion'],      'answer'=>'Hat'],
    ['question'=>'What letter is 🍎?', 'options'=>['A','B','C','D'],               'answer'=>'A'],
    ['question'=>'What letter is 🐶?', 'options'=>['C','D','E','F'],               'answer'=>'D'],
  ],
  'numbers' => [
    ['question'=>'How many? 🍎',           'options'=>['1','2','3','4'],    'answer'=>'1'],
    ['question'=>'How many? 🍎🍎',         'options'=>['1','2','3','4'],    'answer'=>'2'],
    ['question'=>'How many? 🍎🍎🍎',       'options'=>['2','3','4','5'],    'answer'=>'3'],
    ['question'=>'How many? 🌟🌟🌟🌟',     'options'=>['3','4','5','6'],    'answer'=>'4'],
    ['question'=>'What comes after 4?',    'options'=>['3','5','6','7'],    'answer'=>'5'],
    ['question'=>'What comes after 9?',    'options'=>['8','10','11','12'], 'answer'=>'10'],
    ['question'=>'2 + 2 = ?',             'options'=>['3','4','5','6'],    'answer'=>'4'],
    ['question'=>'1 + 3 = ?',             'options'=>['3','4','5','6'],    'answer'=>'4'],
    ['question'=>'5 - 2 = ?',             'options'=>['1','2','3','4'],    'answer'=>'3'],
    ['question'=>'10 - 5 = ?',            'options'=>['3','4','5','6'],    'answer'=>'5'],
  ],
  'colors' => [
    ['question'=>'What color is 🍎?',     'options'=>['Red','Blue','Green','Yellow'],   'answer'=>'Red'],
    ['question'=>'What color is the sky?', 'options'=>['Red','Blue','Green','Yellow'],  'answer'=>'Blue'],
    ['question'=>'What color is grass?',   'options'=>['Red','Blue','Green','Yellow'],  'answer'=>'Green'],
    ['question'=>'What color is 🌟?',     'options'=>['Red','Blue','Green','Yellow'],   'answer'=>'Yellow'],
    ['question'=>'What color is 🍊?',     'options'=>['Orange','Purple','Black','White'],'answer'=>'Orange'],
    ['question'=>'What color is 🍇?',     'options'=>['Orange','Purple','Black','White'],'answer'=>'Purple'],
    ['question'=>'What color is night?',   'options'=>['Orange','Purple','Black','White'],'answer'=>'Black'],
    ['question'=>'What color is snow?',    'options'=>['Orange','Purple','Black','White'],'answer'=>'White'],
    ['question'=>'🔴 is which color?',    'options'=>['Red','Blue','Green','Yellow'],   'answer'=>'Red'],
    ['question'=>'🟢 is which color?',    'options'=>['Red','Blue','Green','Yellow'],   'answer'=>'Green'],
  ],
  'animals' => [
    ['question'=>'Which animal says Woof?',    'options'=>['Cat','Dog','Cow','Pig'],      'answer'=>'Dog'],
    ['question'=>'Which animal says Meow?',    'options'=>['Dog','Cat','Cow','Duck'],     'answer'=>'Cat'],
    ['question'=>'Which animal says Moo?',     'options'=>['Pig','Dog','Cow','Lion'],     'answer'=>'Cow'],
    ['question'=>'Which animal says Oink?',    'options'=>['Pig','Cat','Dog','Frog'],     'answer'=>'Pig'],
    ['question'=>'Which animal says Roar?',    'options'=>['Dog','Cat','Lion','Duck'],    'answer'=>'Lion'],
    ['question'=>'Which animal says Quack?',   'options'=>['Frog','Duck','Pig','Cow'],    'answer'=>'Duck'],
    ['question'=>'Which animal says Ribbit?',  'options'=>['Frog','Dog','Cat','Lion'],    'answer'=>'Frog'],
    ['question'=>'🐶 is which animal?',        'options'=>['Cat','Dog','Cow','Pig'],      'answer'=>'Dog'],
    ['question'=>'🦁 is which animal?',        'options'=>['Tiger','Bear','Lion','Fox'],  'answer'=>'Lion'],
    ['question'=>'🐘 is which animal?',        'options'=>['Rhino','Elephant','Hippo','Bear'],'answer'=>'Elephant'],
  ],
  'fruits' => [
    ['question'=>'🍎 is which fruit?',    'options'=>['Apple','Banana','Mango','Grapes'],   'answer'=>'Apple'],
    ['question'=>'🍌 is which fruit?',    'options'=>['Apple','Banana','Orange','Grapes'],  'answer'=>'Banana'],
    ['question'=>'🥭 is which fruit?',    'options'=>['Apple','Banana','Mango','Grapes'],   'answer'=>'Mango'],
    ['question'=>'🍇 is which fruit?',    'options'=>['Apple','Banana','Mango','Grapes'],   'answer'=>'Grapes'],
    ['question'=>'🍊 is which fruit?',    'options'=>['Lemon','Orange','Mango','Kiwi'],     'answer'=>'Orange'],
    ['question'=>'🍋 is which fruit?',    'options'=>['Lemon','Orange','Mango','Kiwi'],     'answer'=>'Lemon'],
    ['question'=>'🍉 is which fruit?',    'options'=>['Melon','Watermelon','Mango','Kiwi'], 'answer'=>'Watermelon'],
    ['question'=>'🍍 is which fruit?',    'options'=>['Mango','Banana','Pineapple','Kiwi'], 'answer'=>'Pineapple'],
    ['question'=>'Yellow fruit is?',      'options'=>['Apple','Banana','Grapes','Mango'],   'answer'=>'Banana'],
    ['question'=>'Red fruit is?',         'options'=>['Banana','Orange','Apple','Mango'],   'answer'=>'Apple'],
  ],
  'vegetables' => [
    ['question'=>'🥕 is which vegetable?', 'options'=>['Potato','Carrot','Onion','Garlic'],  'answer'=>'Carrot'],
    ['question'=>'🥔 is which vegetable?', 'options'=>['Potato','Carrot','Onion','Garlic'],  'answer'=>'Potato'],
    ['question'=>'🧅 is which vegetable?', 'options'=>['Potato','Carrot','Onion','Garlic'],  'answer'=>'Onion'],
    ['question'=>'🧄 is which vegetable?', 'options'=>['Potato','Carrot','Onion','Garlic'],  'answer'=>'Garlic'],
    ['question'=>'🥦 is which vegetable?', 'options'=>['Spinach','Broccoli','Peas','Beans'], 'answer'=>'Broccoli'],
    ['question'=>'🥒 is which vegetable?', 'options'=>['Carrot','Potato','Cucumber','Onion'],'answer'=>'Cucumber'],
    ['question'=>'🍆 is which vegetable?', 'options'=>['Carrot','Brinjal','Potato','Onion'], 'answer'=>'Brinjal'],
    ['question'=>'Orange vegetable is?',   'options'=>['Potato','Carrot','Onion','Broccoli'],'answer'=>'Carrot'],
    ['question'=>'Green vegetable is?',    'options'=>['Potato','Carrot','Onion','Broccoli'],'answer'=>'Broccoli'],
    ['question'=>'🌶️ is which vegetable?', 'options'=>['Carrot','Potato','Chilli','Onion'],  'answer'=>'Chilli'],
  ],
  'nepali' => [
    ['question'=>'क is for?',       'options'=>['कलम','खरायो','गाई','घर'],     'answer'=>'कलम'],
    ['question'=>'ख is for?',       'options'=>['कलम','खरायो','गाई','घर'],     'answer'=>'खरायो'],
    ['question'=>'ग is for?',       'options'=>['कलम','खरायो','गाई','घर'],     'answer'=>'गाई'],
    ['question'=>'घ is for?',       'options'=>['कलम','खरायो','गाई','घर'],     'answer'=>'घर'],
    ['question'=>'च is for?',       'options'=>['चरा','छाता','जहाज','झ्याल'],  'answer'=>'चरा'],
    ['question'=>'छ is for?',       'options'=>['चरा','छाता','जहाज','झ्याल'],  'answer'=>'छाता'],
    ['question'=>'कलम भनेको?',      'options'=>['Pen','Book','Bag','Chair'],    'answer'=>'Pen'],
    ['question'=>'गाई भनेको?',      'options'=>['Dog','Cat','Cow','Horse'],     'answer'=>'Cow'],
    ['question'=>'घर भनेको?',       'options'=>['School','House','Park','Shop'],'answer'=>'House'],
    ['question'=>'चरा भनेको?',      'options'=>['Fish','Bird','Cat','Dog'],     'answer'=>'Bird'],
  ],
  'nepali_numbers' => [
    ['question'=>'१ भनेको?',    'options'=>['One','Two','Three','Four'],    'answer'=>'One'],
    ['question'=>'२ भनेको?',    'options'=>['One','Two','Three','Four'],    'answer'=>'Two'],
    ['question'=>'३ भनेको?',    'options'=>['One','Two','Three','Four'],    'answer'=>'Three'],
    ['question'=>'४ भनेको?',    'options'=>['One','Two','Three','Four'],    'answer'=>'Four'],
    ['question'=>'५ भनेको?',    'options'=>['Three','Four','Five','Six'],   'answer'=>'Five'],
    ['question'=>'एक भनेको?',   'options'=>['१','२','३','४'],              'answer'=>'१'],
    ['question'=>'दुई भनेको?',  'options'=>['१','२','३','४'],              'answer'=>'२'],
    ['question'=>'तीन भनेको?',  'options'=>['१','२','३','४'],              'answer'=>'३'],
    ['question'=>'दश भनेको?',   'options'=>['८','९','१०','११'],            'answer'=>'१०'],
    ['question'=>'पाँच भनेको?', 'options'=>['३','४','५','६'],              'answer'=>'५'],
  ],
];

$titles = [
  'abc'             => 'ABC & Letters',
  'numbers'         => 'Numbers & Counting',
  'colors'          => 'Colors & Shapes',
  'animals'         => 'Animals & Sounds',
  'nepali'          => 'नेपाली वर्णमाला',
  'nepali_numbers'  => 'नेपाली संख्या',
  'fruits'          => 'Fruits 🍎',
  'vegetables'      => 'Vegetables 🥦',
  'body_parts'      => 'Body Parts 💪',
  'domestic_animals'=> 'Domestic Animals 🐄',
  'wild_animals'    => 'Wild Animals 🦁',
  'water_animals'   => 'Water Animals 🐟',
];

$questions = $quizData[$subject] ?? $quizData['abc'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Quiz 🎯</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="subject-wrapper">

  <a href="<?php echo $subject; ?>.php" class="back-btn">← Back</a>
  <h1>🎯 Quiz — <?php echo $titles[$subject]; ?></h1>

  <!-- Progress bar -->
  <div class="quiz-progress">
    <div class="quiz-progress-bar" id="progress-bar"></div>
  </div>

  <!-- Score display -->
  <div class="quiz-score">
    Score: <span id="score">0</span> /
    <span id="total"><?php echo count($questions); ?></span>
  </div>

  <!-- Question box -->
  <div class="quiz-box" id="quiz-box">
    <div class="question-number" id="q-number">Question 1</div>
    <div class="question-text"   id="q-text"></div>
    <div class="options-grid"    id="options-grid"></div>
    <div class="quiz-feedback"   id="quiz-feedback"></div>
  </div>

  <!-- Result screen (hidden initially) -->
  <div class="quiz-result" id="quiz-result" style="display:none;">
    <div class="result-emoji" id="result-emoji"></div>
    <div class="result-text"  id="result-text"></div>
    <div class="result-score" id="result-score"></div>
    <button class="play-again-btn" onclick="restartQuiz()">🔄 Try Again</button>
    <a href="<?php echo $subject; ?>.php" class="play-again-btn" style="margin-top:10px; display:block; text-align:center; text-decoration:none;">🏠 Back to Subject</a>
  </div>

</div>

<script>
  const questions = <?php echo json_encode($questions); ?>;
  let currentQ  = 0;
  let score     = 0;
  let answered  = false;

  function showQuestion(index) {
    const q = questions[index];
    answered = false;

    document.getElementById('q-number').textContent   = 'Question ' + (index + 1) + ' of ' + questions.length;
    document.getElementById('q-text').textContent     = q.question;
    document.getElementById('quiz-feedback').textContent = '';
    document.getElementById('quiz-feedback').className   = 'quiz-feedback';

    // Update progress bar
    const pct = (index / questions.length) * 100;
    document.getElementById('progress-bar').style.width = pct + '%';


      speak(q.question, 'en-US');

    // Build options
    const grid = document.getElementById('options-grid');
    grid.innerHTML = '';
    q.options.forEach(opt => {
      const btn     = document.createElement('button');
      btn.className = 'option-btn';
      btn.textContent = opt;
      btn.onclick   = () => checkAnswer(btn, opt, q.answer);
      grid.appendChild(btn);
    });
  }

  function checkAnswer(btn, selected, correct) {
    if (answered) return;
    answered = true;

    const allBtns = document.querySelectorAll('.option-btn');

    if (selected === correct) {
      // ✅ Correct
      btn.classList.add('correct');
      score++;
      document.getElementById('score').textContent = score;
      document.getElementById('quiz-feedback').textContent = '✅ Correct! Great job!';
      document.getElementById('quiz-feedback').className   = 'quiz-feedback correct-feedback';
      speak('Correct! Great job!', 'en-US'); 
    } else {
      // ❌ Wrong
      btn.classList.add('wrong');
      document.getElementById('quiz-feedback').textContent = '❌ Wrong! Correct answer: ' + correct;
      document.getElementById('quiz-feedback').className   = 'quiz-feedback wrong-feedback';
      speak('Wrong! Correct answer is ' + correct, 'en-US');

      // Show correct answer
      allBtns.forEach(b => {
        if (b.textContent === correct) b.classList.add('correct');
      });
    }

    // Go to next question after 1.5 seconds
    setTimeout(() => {
      currentQ++;
      if (currentQ < questions.length) {
        showQuestion(currentQ);
      } else {
        showResult();
      }
    }, 1500);
  }

    function speak(text, lang) {
    window.speechSynthesis.cancel();
    const utterance  = new SpeechSynthesisUtterance(text);
    utterance.lang   = lang || 'en-US';
    utterance.rate   = 0.8;
    utterance.pitch  = 1.2;
    utterance.volume = 1;
    window.speechSynthesis.speak(utterance);
  }

  function showResult() {
    document.getElementById('quiz-box').style.display    = 'none';
    document.getElementById('quiz-result').style.display = 'block';
    document.getElementById('progress-bar').style.width  = '100%';

    const pct = (score / questions.length) * 100;
    let emoji, text, stars;

    if (pct === 100) {
      emoji = '🏆'; text = 'Perfect Score! Amazing!'; stars = 3;
    } else if (pct >= 70) {
      emoji = '🌟'; text = 'Great job! Well done!';   stars = 2;
    } else if (pct >= 50) {
      emoji = '👍'; text = 'Good try! Keep learning!'; stars = 1;
    } else {
      emoji = '💪'; text = 'Keep practicing! You can do it!'; stars = 0;
    }

    document.getElementById('result-emoji').textContent = emoji;
    document.getElementById('result-text').textContent  = text;
    document.getElementById('result-score').textContent =
      'You got ' + score + ' out of ' + questions.length + ' correct!';

    // Save stars to DB
    if (stars > 0) saveStars(stars);
  }

  function restartQuiz() {
    currentQ = 0;
    score    = 0;
    document.getElementById('score').textContent         = '0';
    document.getElementById('quiz-box').style.display    = 'block';
    document.getElementById('quiz-result').style.display = 'none';
    showQuestion(0);
  }

  function saveStars(stars) {
    const subject = "<?php echo $subject; ?>";
    fetch('api/save_progress.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `subject=${subject}&stars=${stars}`
    });
  }

  // Start quiz
  showQuestion(0);
</script>

</body>
</html>