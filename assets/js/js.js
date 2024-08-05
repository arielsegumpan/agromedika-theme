

document.addEventListener('DOMContentLoaded', function () {
  const scrollBtn = document.getElementById('hdr_main');

  // Initial check for scroll position
  checkScroll();

  // Add scroll event listener
  window.addEventListener('scroll', function () {
    checkScroll();
  });

  // Add click event listener to the button
  scrollBtn.addEventListener('click', function () {
    scrollToTop(300);
  });

  function checkScroll() {
    // Show/hide the button based on the scroll position
    if (window.scrollY > 1) {
      // scrollBtn.style.display = 'block';
      $('header.hdr_bg.position-fixed.w-100').addClass('bg-lteal shadow-sm');
      $('header.position-fixed.w-100').addClass('bg-lteal shadow-sm',100);
    } else {
      // scrollBtn.style.display = 'none';
      $('header.hdr_bg.bg-lteal.position-fixed.w-100').removeClass('bg-lteal shadow-sm');
      $('header.position-fixed.w-100').removeClass('shadow-sm', 100);
    }
  }

  function scrollToTop(duration) {
    const start = window.pageYOffset;
    const startTime = 'now' in window.performance ? performance.now() : new Date().getTime();

    function scrollStep(timestamp) {
      const currentTime = 'now' in window.performance ? performance.now() : new Date().getTime();
      const progress = Math.min(1, (currentTime - startTime) / duration);

      window.scrollTo(0, start - start * progress);

      if (progress < 1) {
        requestAnimationFrame(scrollStep);
      }
    }

    requestAnimationFrame(scrollStep);
  }
});

  $(document).ready(() => {
    $('[data-fancybox="gallery"]').fancybox({
      buttons: [
        "slideShow",
        "thumbs",
        "zoom",
        "fullScreen",
        "share",
        "close"
      ],
      loop: false,
      protect: true
    });
  });

$(document).ready(function () {

  // $('figure.wp-block-table').addClass('table-responsive table-striped');
  // $('figure.wp-block-table table').addClass('table align-middle');
  // $('figure.wp-block-table thead tr th').addClass('col');


  $('section#main figure.wp-block-table table tbody tr td:first-child').each(function(){
    $(this).html($(this).html().replace(/<br>/g, ' '));
  });
  $('section#main figure.wp-block-table table tbody tr td a').addClass('text-decoration-none text-primary');
  $('section#main .extract_lists figure.wp-block-table table thead tr th:nth-child(5)').css('width', '120px');
  $('section#main .extract_lists figure.wp-block-table table thead tr th:nth-child(3)').css('width', '200px');


  nextCard();
  setInterval(nextCard, 5000); 


  let container = $('.container-img');
  let cards = $('.container-img .card');

  // Filter gallery based on category 
  $('#filter-menu').on('click', '.filter-item', function () {
    let selectedFilter = $(this).data('filter');
    let matchingCards;

    if (selectedFilter === 'all') {
      matchingCards = cards;
    } else {
      matchingCards = cards.filter(function () {
        let dataId = $(this).find('a').data('id').toLowerCase();
        return dataId === selectedFilter.toLowerCase();
      });
    }

    // Clear the container
    container.empty();

    // Append matching cards to the container with fadeIn animation
    matchingCards.each(function () {
      $(this).removeClass('fade-out').addClass('fade-in').appendTo(container).hide().fadeIn();
    });

    // Add fade-out class to non-matching cards and fade them out
    cards.not(matchingCards).each(function () {
      $(this).removeClass('fade-in').addClass('fade-out').fadeOut();
    });
  });
});

$(document).ready(function () {
  let container = $('.container-img-pdf');
  let cards = $('.container-img-pdf .card');

  $('#filter-menu-2').on('click', '.filter-item', function () {
    let selectedFilter = $(this).data('filter');
    let matchingCards;

    if (selectedFilter === 'all') {
      matchingCards = cards;
    } else {
      matchingCards = cards.filter(function () {
        let dataId = $(this).data('id').toLowerCase();
        return dataId === selectedFilter.toLowerCase();
      });
    }

    container.empty();

    matchingCards.each(function () {
      $(this).removeClass('fade-out').addClass('fade-in').appendTo(container).hide().fadeIn();
    });

    cards.not(matchingCards).each(function () {
      $(this).removeClass('fade-in').addClass('fade-out').fadeOut();
    });
  });
});


var shadow = '0 20px 50px rgba(0,34,45,0)';
var currentIndex = 1; // Start with the second card

function styles(item_id, x, y, z , opacity, shadow){
	$(item_id).css({
		transform: 'translate3d('+ x +'px, ' + y + 'px, ' + z +'px)',
		opacity: opacity,
		'box-shadow': shadow,
		transition: 'transform 1s ease, opacity 1s ease' // Smooth transition
	});
}

function nextCard() {
  $('#first, #second, #third').removeClass('focus');
  currentIndex = currentIndex % 3 + 1; // Cycle through 1, 2, 3
  var currentId = '#' + (currentIndex === 1 ? 'first' : currentIndex === 2 ? 'second' : 'third');
  $(currentId).addClass('focus');

  if (currentIndex === 1) {
    styles('#first', 0, -37, 0, 1, shadow);
    styles('#second', 70, 50, -50, 0.2, 'none');
    styles('#third', 110, -107, -60, 0, 'none');
  } else if (currentIndex === 2) {
    styles('#first', 110, -107, -60, 0, 'none');
    styles('#second', 0, -50, 0, 1, shadow);
    styles('#third', 70, 50, -50, 0.2, 'none');
  } else {
    styles('#first', 70, 50, -50, 0.2, 'none');
    styles('#second', 110, -107, -60, 0, 'none');
    styles('#third', 0, -50, 0, 1, shadow);
  }
}
