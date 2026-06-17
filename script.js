let fcIndex = 0;

function showCard(index) {
  document.getElementById('fc-letter').textContent = cards[index].letter;
  document.getElementById('fc-emoji').textContent  = cards[index].emoji;
  document.getElementById('fc-word').textContent   = cards[index].word;
  document.getElementById('fc-count').textContent  = `${index + 1} / ${cards.length}`;
}

function fcNext() {
  if (fcIndex < cards.length - 1) {
    fcIndex++;
    showCard(fcIndex);
  }
}

function fcPrev() {
  if (fcIndex > 0) {
    fcIndex--;
    showCard(fcIndex);
  }
}

//  MATCHING GAME LOGIC
let flipped  = [];
let matched  = [];
let disabled = false;

function initMatching() {
  flipped  = [];
  matched  = [];
  disabled = false;

  // Make pairs from matchingPairs data
  let cards_m = [];
  matchingPairs.forEach((pair, i) => {
    cards_m.push({ id: i, type: 'key',   value: pair.key });
    cards_m.push({ id: i, type: 'value', value: pair.value });
  });

  // Shuffle
  cards_m.sort(() => Math.random() - 0.5);

  // Build grid
  const grid = document.getElementById('match-grid');
  grid.innerHTML = "";

  cards_m.forEach((card, index) => {
    const div = document.createElement('div');
    div.className        = 'match-card';
    div.dataset.id       = card.id;
    div.dataset.type     = card.type;
    div.dataset.index    = index;
    div.textContent      = '⭐';
    div.onclick          = () => flipCard(div, card);
    grid.appendChild(div);
  });

  document.getElementById('match-status').textContent = "";
}

function flipCard(div, card) {
  if (disabled) return;
  if (div.classList.contains('matched')) return;
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
    // ✅ Correct match
    a.div.classList.add('matched');
    b.div.classList.add('matched');
    matched.push(a.card.id);

    if (matched.length === matchingPairs.length) {
      document.getElementById('match-status').textContent = "🎉 You matched them all!";
      saveStars(3);  // save 3 stars to DB
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
//  SAVE STARS TO DATABASE
function saveStars(stars) {
  const subject = new URLSearchParams(window.location.search).get('subject') || 'abc';

  fetch('api/save_progress.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `subject=${subject}&stars=${stars}`
  })
  .then(res => res.text())
  .then(data => console.log("Saved:", data))
  .catch(err => console.log("Error:", err));
}
//  DRAWING LOGIC
let drawState = {
  drawing : false,
  color   : '#E24B4A',
  size    : 8,
  eraser  : false,
  lastX   : 0,
  lastY   : 0,
};

function initDrawing() {
  const canvas = document.getElementById('drawing-canvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');

  // Color palette
  const colors = [
    '#E24B4A','#EF9F27','#F0E040','#1D9E75',
    '#378ADD','#7F77DD','#D4537E','#000000',
    '#ffffff','#8B4513',
  ];

  const palette = document.getElementById('color-palette');
  if (palette) {
    palette.innerHTML = colors.map(c =>
      `<div class="color-dot" style="background:${c};"
            onclick="setDrawColor('${c}')"></div>`
    ).join('');
  }

  // Get position helper
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

  // Mouse events
  canvas.addEventListener('mousedown', (e) => {
    drawState.drawing = true;
    const pos = getPos(e);
    drawState.lastX = pos.x;
    drawState.lastY = pos.y;
  });

  canvas.addEventListener('mousemove', (e) => {
    if (!drawState.drawing) return;
    const pos = getPos(e);
    ctx.globalCompositeOperation = drawState.eraser
      ? 'destination-out' : 'source-over';
    ctx.strokeStyle = drawState.eraser ? 'rgba(0,0,0,1)' : drawState.color;
    ctx.lineWidth   = drawState.size;
    ctx.lineCap     = 'round';
    ctx.lineJoin    = 'round';
    ctx.beginPath();
    ctx.moveTo(drawState.lastX, drawState.lastY);
    ctx.lineTo(pos.x, pos.y);
    ctx.stroke();
    drawState.lastX = pos.x;
    drawState.lastY = pos.y;
  });

  canvas.addEventListener('mouseup',    () => { drawState.drawing = false; });
  canvas.addEventListener('mouseleave', () => { drawState.drawing = false; });

  // Touch events (phone/tablet)
  canvas.addEventListener('touchstart', (e) => {
    e.preventDefault();
    drawState.drawing = true;
    const pos = getPos(e);
    drawState.lastX = pos.x;
    drawState.lastY = pos.y;
  }, { passive: false });

  canvas.addEventListener('touchmove', (e) => {
    e.preventDefault();
    if (!drawState.drawing) return;
    const pos = getPos(e);
    ctx.globalCompositeOperation = drawState.eraser
      ? 'destination-out' : 'source-over';
    ctx.strokeStyle = drawState.eraser ? 'rgba(0,0,0,1)' : drawState.color;
    ctx.lineWidth   = drawState.size;
    ctx.lineCap     = 'round';
    ctx.beginPath();
    ctx.moveTo(drawState.lastX, drawState.lastY);
    ctx.lineTo(pos.x, pos.y);
    ctx.stroke();
    drawState.lastX = pos.x;
    drawState.lastY = pos.y;
  }, { passive: false });

  canvas.addEventListener('touchend', () => { drawState.drawing = false; });

  // Brush size slider
  const slider = document.getElementById('brush-size');
  if (slider) {
    slider.addEventListener('input', (e) => {
      drawState.size = +e.target.value;
    });
  }
}

function setDrawColor(color) {
  drawState.color  = color;
  drawState.eraser = false;
  document.querySelectorAll('.color-dot').forEach(dot => {
    dot.classList.toggle('selected', dot.style.background === color);
  });
  const eraserBtn = document.getElementById('eraser-btn');
  if (eraserBtn) eraserBtn.classList.remove('active-tool');
}

function toggleEraser() {
  drawState.eraser = !drawState.eraser;
  const btn = document.getElementById('eraser-btn');
  if (btn) btn.classList.toggle('active-tool', drawState.eraser);
}

function clearCanvas() {
  const canvas = document.getElementById('drawing-canvas');
  if (!canvas) return;
  canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
}
//  TAB SWITCHING
function showTab(tabName, clickedBtn) {
  document.querySelectorAll('.tab-content').forEach(tab => {
    tab.style.display = 'none';
  });
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.classList.remove('active');
  });
  document.getElementById(tabName).style.display = 'block';
  clickedBtn.classList.add('active');
}


