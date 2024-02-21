$(document).ready(function () {
    let container = $('.container-img');
    let cards = $('.card');

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


      $('.dropdown').hover(
        function () {
            // On hover in
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(300);
        },
        function () {
            // On hover out
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(300);
        }
      );
  });
  

  document.addEventListener('DOMContentLoaded', function () {
    const scrollBtn = document.getElementById('scroll_btn');
  
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
      if (window.scrollY > 100) {
        scrollBtn.style.display = 'block';
      } else {
        scrollBtn.style.display = 'none';
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
  
  
  function handleIntersection(entries, observer) {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          startCounterAnimation(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }
    
    function startCounterAnimation(valueDisplay) {
      let startValue = 0;
      let endValue = parseInt(valueDisplay.getAttribute("data-val"));
      let interval = 800;
      let duration = Math.floor(interval / endValue);
    
      function updateCounter() {
        startValue += 1;
        valueDisplay.textContent = startValue;
    
        if (startValue < endValue) {
          requestAnimationFrame(updateCounter);
        }
      }
    
      updateCounter();
    }
    
    let observer = new IntersectionObserver(handleIntersection, { threshold: 0.5 });
    let valueDisplays = document.querySelectorAll(".num");
    
    valueDisplays.forEach((valueDisplay) => {
      observer.observe(valueDisplay);
    });
    
    // Check initial state of elements
    valueDisplays.forEach((valueDisplay) => {
      if (observer.takeRecords().some((entry) => entry.target === valueDisplay && entry.isIntersecting)) {
        startCounterAnimation(valueDisplay);
      }
    });
    

  
