$(document).ready(function(){
  // Hamburger menu toggle
  $('.hamburger').click(function(){
    $(this).toggleClass('active');
    $('.navbar').toggleClass('active');
  });

  // Chiudi menu quando si clicca un link
  $('.menu a').click(function(){
    $('.hamburger').removeClass('active');
    $('.navbar').removeClass('active');
  });
});

window.addEventListener('load', function() {
  AOS.init({
    duration: 750,
    easing: 'ease-out',
    once: true,
    offset: 80,
  });
});

// Carosello immagini pagina Accoglienza
// Se c'è un blocco HTML .accoglienza-swiper, lo usa direttamente.
// Se c'è un blocco Galleria Gutenberg dentro .accoglienza-content, lo converte in Swiper.
document.addEventListener('DOMContentLoaded', function() {
(function() {
  // Caso 1: HTML personalizzato con .accoglienza-swiper
  if (document.querySelector('.accoglienza-swiper')) {
    new Swiper('.accoglienza-swiper', {
      loop: true,
      autoplay: { delay: 4000, disableOnInteraction: false },
      pagination: { el: '.accoglienza-swiper .swiper-pagination', clickable: true },
      navigation: {
        nextEl: '.accoglienza-swiper .swiper-button-next',
        prevEl: '.accoglienza-swiper .swiper-button-prev',
      },
    });
    return;
  }

  // Caso 2: blocco Galleria Gutenberg dentro .accoglienza-content
  var gallery = document.querySelector('.accoglienza-content .wp-block-gallery');
  if (!gallery) return;

  var imgs = gallery.querySelectorAll('img');
  if (imgs.length < 2) return; // con 1 sola foto non serve il carosello

  // Costruiamo la struttura Swiper
  var wrapper = document.createElement('div');
  wrapper.className = 'swiper accoglienza-swiper';

  var slideWrapper = document.createElement('div');
  slideWrapper.className = 'swiper-wrapper';

  imgs.forEach(function(img) {
    var slide = document.createElement('div');
    slide.className = 'swiper-slide';
    var newImg = document.createElement('img');
    newImg.src = img.src;
    newImg.alt = img.alt;
    slide.appendChild(newImg);
    slideWrapper.appendChild(slide);
  });

  var pagination = document.createElement('div');
  pagination.className = 'swiper-pagination';
  var btnPrev = document.createElement('div');
  btnPrev.className = 'swiper-button-prev';
  var btnNext = document.createElement('div');
  btnNext.className = 'swiper-button-next';

  wrapper.appendChild(slideWrapper);
  wrapper.appendChild(pagination);
  wrapper.appendChild(btnPrev);
  wrapper.appendChild(btnNext);

  gallery.parentNode.replaceChild(wrapper, gallery);

  new Swiper('.accoglienza-swiper', {
    loop: true,
    autoplay: { delay: 4000, disableOnInteraction: false },
    pagination: { el: '.accoglienza-swiper .swiper-pagination', clickable: true },
    navigation: {
      nextEl: '.accoglienza-swiper .swiper-button-next',
      prevEl: '.accoglienza-swiper .swiper-button-prev',
    },
  });
})();
}); // fine DOMContentLoaded

// Contatore animato per .counter-number
// Legge prefix/numero/suffix direttamente dal testo — es. "+500", "100%"
// Per cambiare il numero basta editare il testo nel blocco Gutenberg.
(function() {
  var counters = document.querySelectorAll('.counter-number');
  if (!counters.length) return;

  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (!entry.isIntersecting) return;
      var el = entry.target;
      var text = el.textContent.trim();
      var match = text.match(/^([^0-9]*)(\d+)([^0-9]*)$/);
      if (!match) return;
      var prefix = match[1];
      var target = parseInt(match[2], 10);
      var suffix = match[3];
      var duration = 1800;
      var start = null;

      function step(timestamp) {
        if (!start) start = timestamp;
        var progress = Math.min((timestamp - start) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = prefix + Math.floor(eased * target) + suffix;
        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          el.textContent = prefix + target + suffix;
        }
      }
      requestAnimationFrame(step);
      observer.unobserve(el);
    });
  }, { threshold: 0.5 });

  counters.forEach(function(c) { observer.observe(c); });
})();
