(function () {
  const galeria = document.getElementById('galeria');
  if (!galeria) return;

  const thumbs = Array.from(galeria.querySelectorAll('img'));
  const lightbox = document.getElementById('lightbox');
  const lbImg = document.getElementById('lb-img');
  const lbCaption = document.getElementById('lb-caption');
  const btnClose = document.getElementById('lb-close');
  const btnPrev = document.getElementById('lb-prev');
  const btnNext = document.getElementById('lb-next');

  let currentIndex = -1;
  let lastFocused = null;

  function openAt(index) {
    if (index < 0 || index >= thumbs.length) return;
    currentIndex = index;
    const imgEl = thumbs[currentIndex];

    lbImg.src = imgEl.src;
    lbImg.alt = imgEl.alt || '';
    lbCaption.textContent = imgEl.alt || `Foto ${currentIndex + 1} de ${thumbs.length}`;

    lightbox.removeAttribute('hidden');
    document.body.style.overflow = 'hidden';
    btnClose.focus();

    // Preload vizinhas
    preload(currentIndex - 1);
    preload(currentIndex + 1);
  }

  function close() {
    lightbox.setAttribute('hidden', '');
    document.body.style.overflow = '';
    if (lastFocused) lastFocused.focus();
    currentIndex = -1;
  }

  function next(delta) {
    if (currentIndex === -1) return;
    let idx = currentIndex + delta;
    if (idx < 0) idx = thumbs.length - 1;
    if (idx >= thumbs.length) idx = 0;
    openAt(idx);
  }

  function onThumbClick(e, idx) {
    e.preventDefault();
    lastFocused = e.currentTarget.closest('.thumb') || e.currentTarget;
    openAt(idx);
  }

  function onBackdropClick(e) {
    // Fecha se clicou fora da figura
    const isOutside = !e.target.closest('.lb-figure') && !e.target.closest('.lb-prev') && !e.target.closest('.lb-next');
    if (isOutside) close();
  }

  function onKey(e) {
    if (lightbox.hasAttribute('hidden')) return;
    switch (e.key) {
      case 'Escape':   close(); break;
      case 'ArrowLeft':  next(-1); break;
      case 'ArrowRight': next(1); break;
    }
  }

  function preload(idx) {
    if (idx < 0 || idx >= thumbs.length) return;
    const i = new Image();
    i.src = thumbs[idx].src;
  }

  // Eventos
  thumbs.forEach((img, i) => {
    const btn = img.closest('.thumb');
    (btn || img).addEventListener('click', (ev) => onThumbClick(ev, i));
    (btn || img).addEventListener('keydown', (ev) => {
      if (ev.key === 'Enter' || ev.key === ' ') {
        ev.preventDefault();
        onThumbClick(ev, i);
      }
    });
  });

  btnClose.addEventListener('click', close);
  btnPrev.addEventListener('click', () => next(-1));
  btnNext.addEventListener('click', () => next(1));
  lightbox.addEventListener('click', onBackdropClick);
  document.addEventListener('keydown', onKey);

  // Suporte simples a swipe (mobile)
  let touchStartX = 0;
  lbImg.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
  lbImg.addEventListener('touchend', (e) => {
    const dx = e.changedTouches[0].screenX - touchStartX;
    if (Math.abs(dx) > 40) next(dx < 0 ? 1 : -1);
  }, { passive: true });
})();
