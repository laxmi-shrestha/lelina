<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}

$subject = $_GET['subject'] ?? 'abc';

$titles = [
  'abc'              => 'ABC & Letters',
  'numbers'          => 'Numbers & Counting',
  'colors'           => 'Colors & Shapes',
  'animals'          => 'Animals & Sounds',
  'body'       => 'Body Parts 💪',
  'domestic' => 'Domestic Animals 🐄',
  'wild'     => 'Wild Animals 🦁',
  'water'    => 'Water Animals 🐟',
  'nepali'           => 'नेपाली वर्णमाला',
  'barakhadi'        => 'बाराखडी',
];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Drawing 🖍</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <a href="<?php echo $subject; ?>.php">← Back</a>
  <h1>🖍 Drawing — <?php echo $titles[$subject]; ?></h1>
  <p>Draw whatever you like! 🎨</p>

  <!-- Color Palette -->
  <div class="color-palette" id="color-palette"></div>

  <!-- Canvas -->
  <div class="canvas-wrap">
    <canvas id="drawing-canvas" width="500" height="400"></canvas>
  </div>

  <!-- Tools -->
  <div class="draw-tools">
    <label>Size:</label>
    <input type="range" min="2" max="40" value="8" id="brush-size">

    <button class="tool-btn" id="eraser-btn" onclick="toggleEraser()">
      🧹 Eraser
    </button>

    <button class="tool-btn" onclick="clearCanvas()">
      🗑 Clear
    </button>

    <button class="tool-btn" onclick="saveDrawing()">
      💾 Save
    </button>
  </div>

  <!-- Brush size display -->
  <div id="size-display" style="text-align:center; font-size:13px; color:#888; margin-top:4px;">
    Brush size: 8
  </div>

  <script>
    // =====================
    // DRAWING STATE
    // =====================
    let drawState = {
      drawing : false,
      color   : '#E24B4A',
      size    : 8,
      eraser  : false,
      lastX   : 0,
      lastY   : 0,
    };

    // =====================
    // COLOR PALETTE
    // =====================
    const colors = [
      '#E24B4A', // red
      '#EF9F27', // orange
      '#F0E040', // yellow
      '#1D9E75', // green
      '#378ADD', // blue
      '#7F77DD', // purple
      '#D4537E', // pink
      '#8B4513', // brown
      '#000000', // black
      '#ffffff', // white
    ];

    const palette = document.getElementById('color-palette');
    colors.forEach(c => {
      const dot     = document.createElement('div');
      dot.className = 'color-dot' + (c === drawState.color ? ' selected' : '');
      dot.style.background = c;
      dot.style.border     = c === '#ffffff' ? '2px solid #ddd' : '2px solid transparent';
      dot.onclick = () => setDrawColor(c);
      palette.appendChild(dot);
    });

    function setDrawColor(color) {
      drawState.color  = color;
      drawState.eraser = false;

      document.querySelectorAll('.color-dot').forEach(dot => {
        dot.classList.remove('selected');
        dot.style.border = dot.style.background === 'rgb(255, 255, 255)'
          ? '2px solid #ddd' : '2px solid transparent';
      });

      event.target.classList.add('selected');
      event.target.style.border = '3px solid #2C2C2A';

      const eraserBtn = document.getElementById('eraser-btn');
      eraserBtn.classList.remove('active-tool');
    }

    // =====================
    // CANVAS SETUP
    // =====================
    const canvas = document.getElementById('drawing-canvas');
    const ctx    = canvas.getContext('2d');

    // Fill white background
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    function getPos(e) {
      const rect   = canvas.getBoundingClientRect();
      const scaleX = canvas.width  / rect.width;
      const scaleY = canvas.height / rect.height;
      const src    = e.touches ? e.touches[0] : e;
      return {
        x: (src.clientX - rect.left) * scaleX,
        y: (src.clientY - rect.top)  * scaleY,
      };
    }

    function startDraw(e) {
      e.preventDefault();
      drawState.drawing = true;
      const pos = getPos(e);
      drawState.lastX = pos.x;
      drawState.lastY = pos.y;

      // Draw a dot on click
      ctx.beginPath();
      ctx.arc(pos.x, pos.y, drawState.size / 2, 0, Math.PI * 2);
      ctx.fillStyle = drawState.eraser ? '#ffffff' : drawState.color;
      ctx.fill();
    }

    function draw(e) {
      if (!drawState.drawing) return;
      e.preventDefault();
      const pos = getPos(e);

      ctx.globalCompositeOperation = drawState.eraser
        ? 'source-over' : 'source-over';
      ctx.strokeStyle = drawState.eraser ? '#ffffff' : drawState.color;
      ctx.lineWidth   = drawState.size;
      ctx.lineCap     = 'round';
      ctx.lineJoin    = 'round';

      ctx.beginPath();
      ctx.moveTo(drawState.lastX, drawState.lastY);
      ctx.lineTo(pos.x, pos.y);
      ctx.stroke();

      drawState.lastX = pos.x;
      drawState.lastY = pos.y;
    }

    function stopDraw() {
      drawState.drawing = false;
    }

    // Mouse events
    canvas.addEventListener('mousedown',  startDraw);
    canvas.addEventListener('mousemove',  draw);
    canvas.addEventListener('mouseup',    stopDraw);
    canvas.addEventListener('mouseleave', stopDraw);

    // Touch events
    canvas.addEventListener('touchstart', startDraw, { passive: false });
    canvas.addEventListener('touchmove',  draw,      { passive: false });
    canvas.addEventListener('touchend',   stopDraw);

    // Brush size slider
    document.getElementById('brush-size').addEventListener('input', (e) => {
      drawState.size = +e.target.value;
      document.getElementById('size-display').textContent = 'Brush size: ' + e.target.value;
    });

    // =====================
    // TOOLS
    // =====================
    function toggleEraser() {
      drawState.eraser = !drawState.eraser;
      const btn = document.getElementById('eraser-btn');
      btn.classList.toggle('active-tool', drawState.eraser);
    }

    function clearCanvas() {
      ctx.fillStyle = '#ffffff';
      ctx.fillRect(0, 0, canvas.width, canvas.height);
    }

    function saveDrawing() {
      // Download drawing as image
      const link    = document.createElement('a');
      link.download = 'my-drawing.png';
      link.href     = canvas.toDataURL();
      link.click();
    }

  </script>

</body>
</html>