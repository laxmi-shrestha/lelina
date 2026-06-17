<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}

$subject = $_GET['subject'] ?? 'abc';

$matchData = [
  'abc' => [
    ['key'=>'A', 'value'=>'🍎'],
    ['key'=>'B', 'value'=>'⚽'],
    ['key'=>'C', 'value'=>'🐱'],
    ['key'=>'D', 'value'=>'🐶'],
    ['key'=>'E', 'value'=>'🥚'],
    ['key'=>'F', 'value'=>'🐟'],
  ],

  'barakhadi' => [
    
    ['key'=>'क',  'value'=>'क'],
    ['key'=>'का', 'value'=>'का'], 
    ['key'=>'कि', 'value'=>'कि'],
    ['key'=>'की', 'value'=>'की'], 
    ['key'=>'कु', 'value'=>'कु'],
    ['key'=>'कू', 'value'=>'कू'],
    ],
  'numbers' => [
    ['key'=>'1', 'value'=>'1️⃣'],
    ['key'=>'2', 'value'=>'2️⃣'],
    ['key'=>'3', 'value'=>'3️⃣'],
    ['key'=>'4', 'value'=>'4️⃣'],
    ['key'=>'5', 'value'=>'5️⃣'],
    ['key'=>'6', 'value'=>'6️⃣'],
  ],
  'colors' => [
    ['key'=>'Red',    'value'=>'🔴'],
    ['key'=>'Blue',   'value'=>'🔵'],
    ['key'=>'Green',  'value'=>'🟢'],
    ['key'=>'Yellow', 'value'=>'🟡'],
    ['key'=>'Orange', 'value'=>'🟠'],
    ['key'=>'Purple', 'value'=>'🟣'],
  ],
  'animals' => [
    ['key'=>'Dog',      'value'=>'🐶'],
    ['key'=>'Cat',      'value'=>'🐱'],
    ['key'=>'Cow',      'value'=>'🐮'],
    ['key'=>'Pig',      'value'=>'🐷'],
    ['key'=>'Lion',     'value'=>'🦁'],
    ['key'=>'Elephant', 'value'=>'🐘'],
  ],
  'body' => [
    ['key'=>'Eye',   'value'=>'👁️'],
    ['key'=>'Nose',  'value'=>'👃'],
    ['key'=>'Mouth', 'value'=>'👄'],
    ['key'=>'Ear',   'value'=>'👂'],
    ['key'=>'Hand',  'value'=>'✋'],
    ['key'=>'Foot',  'value'=>'🦶'],
  ],
  'domestic' => [
    ['key'=>'Cow',     'value'=>'🐄'],
    ['key'=>'Goat',    'value'=>'🐐'],
    ['key'=>'Dog',     'value'=>'🐕'],
    ['key'=>'Cat',     'value'=>'🐈'],
    ['key'=>'Horse',   'value'=>'🐴'],
    ['key'=>'Duck',    'value'=>'🦆'],
  ],
  'wild' => [
    ['key'=>'Lion',     'value'=>'🦁'],
    ['key'=>'Tiger',    'value'=>'🐯'],
    ['key'=>'Bear',     'value'=>'🐻'],
    ['key'=>'Fox',      'value'=>'🦊'],
    ['key'=>'Zebra',    'value'=>'🦓'],
    ['key'=>'Giraffe',  'value'=>'🦒'],
  ],
  'water' => [
    ['key'=>'Fish',     'value'=>'🐟'],
    ['key'=>'Shark',    'value'=>'🦈'],
    ['key'=>'Dolphin',  'value'=>'🐬'],
    ['key'=>'Whale',    'value'=>'🐳'],
    ['key'=>'Octopus',  'value'=>'🐙'],
    ['key'=>'Crab',     'value'=>'🦀'],
  ],
  'nepali' => [
    ['key'=>'क',  'value'=>'कलम ✏️'],
    ['key'=>'ख',  'value'=>'खरायो 🐰'],
    ['key'=>'ग',  'value'=>'गाई 🐮'],
    ['key'=>'घ',  'value'=>'घर 🏠'],
    ['key'=>'च',  'value'=>'चरा 🐦'],
    ['key'=>'छ',  'value'=>'छाता ☂️'],
  ],
];


$titles = [
  'abc'            => 'ABC & Letters',
  'nepali'         => 'नेपाली वर्णमाला',
  'numbers'        => 'Numbers & Counting',
  'colors'         => 'Colors & Shapes',
  'animals'        => 'Animals & Sounds',
  'body'           => 'Body Parts 💪',
  'barakhadi'      => 'बाराखडी',
  'domestic'       => 'Domestic Animals 🐄',
  'wild'           => 'Wild Animals 🦁',
  'water'          => 'Water Animals 🐟',
];

$pairs = $matchData[$subject];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Matching Game 🎮</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <a href="<?php echo $subject; ?>.php">← Back</a>
  <h1>🎮 Matching — <?php echo $titles[$subject]; ?></h1>
  <p>Match the correct pairs! 🌟</p>

  <div class="match-grid" id="match-grid"></div>
  <div class="match-status" id="match-status"></div>
  <button class="play-again-btn" onclick="initMatching()">🔄 Play Again</button>

  <script>
    const matchingPairs = <?php echo json_encode($pairs); ?>;

    let flipped  = [];
    let matched  = [];
    let disabled = false;

    function initMatching() {
      flipped  = [];
      matched  = [];
      disabled = false;

      // Make pairs — one key card, one value card
      let cards = [];
      matchingPairs.forEach((pair, i) => {
        cards.push({ id: i, type: 'key',   value: pair.key });
        cards.push({ id: i, type: 'value', value: pair.value });
      });

      // Shuffle
      cards.sort(() => Math.random() - 0.5);

      // Build grid
      const grid = document.getElementById('match-grid');
      grid.innerHTML = "";

      cards.forEach((card, index) => {
        const div        = document.createElement('div');
        div.className    = 'match-card';
        div.dataset.id   = card.id;
        div.dataset.type = card.type;
        div.textContent  = '⭐';
        div.onclick      = () => flipCard(div, card);
        grid.appendChild(div);
      });

      document.getElementById('match-status').textContent = "";
      document.getElementById('match-status').className   = "match-status";
    }

    function flipCard(div, card) {
      if (disabled) return;
      if (div.classList.contains('matched')) return;
      if (div.classList.contains('flipped')) return;
      if (flipped.length === 2) return;

      div.textContent = card.value;
      div.classList.add('flipped');
      flipped.push({ div, card });

      if (flipped.length === 2) {
        disabled = true;
        setTimeout(() => checkMatch(), 700);
      }
    }

    function checkMatch() {
      const [a, b] = flipped;

      if (a.card.id === b.card.id && a.card.type !== b.card.type) {
        // ✅ Correct!
        a.div.classList.add('matched');
        b.div.classList.add('matched');
        matched.push(a.card.id);

        if (matched.length === matchingPairs.length) {
          document.getElementById('match-status').textContent = "🎉 You matched them all! Well done!";
          document.getElementById('match-status').className   = "match-status win";
          saveStars(3);
        }
      } else {
        // ❌ Wrong - flip back
        setTimeout(() => {
          a.div.textContent = '⭐';
          b.div.textContent = '⭐';
          a.div.classList.remove('flipped');
          b.div.classList.remove('flipped');
        }, 400);
      }

      flipped  = [];
      disabled = false;
    }

    function saveStars(stars) {
      const subject = "<?php echo $subject; ?>";
      fetch('api/save_progress.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `subject=${subject}&stars=${stars}`
      });
    }

    // Start game on load
    initMatching();
  </script>

</body>
</html>