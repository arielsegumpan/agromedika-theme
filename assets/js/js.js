

document.addEventListener('DOMContentLoaded', function() {
  var audio = document.getElementById('bg_sound');

  // Function to unmute audio when it starts playing
  function handleAutoPlay() {
    audio.muted = false; // Unmute audio
    audio.removeEventListener("play", handleAutoPlay); // Remove event listener after playing
  }

  // Add event listener to check when audio starts playing
  audio.addEventListener("play", handleAutoPlay);
});


// Close dropdown menus when clicking outside of them
$(document).on('click', function(e) {
  if (!$(e.target).closest('.dropdown').length) {
      $('.dropdown-menu').removeClass('show');
  }
});

// Prevent closing dropdown menu when clicking inside it
$('.dropdown-menu').on('click', function(e) {
  e.stopPropagation();
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



// ADD CLASS wp table
  $('section#main figure.wp-block-table table tbody tr td:first-child').each(function(){
    $(this).html($(this).html().replace(/<br>/g, ' '));
  });
  $('section#main figure.wp-block-table table tbody tr td a').addClass('text-decoration-none text-primary');
  $('section#main .extract_lists figure.wp-block-table table thead tr th:nth-child(5)').css('width', '120px');
  $('section#main .extract_lists figure.wp-block-table table thead tr th:nth-child(3)').css('width', '200px');


 
  nextCard();
  setInterval(nextCard, 5000); 


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
});

$(document).ready(function () {

  let container = $('.container-img-pdf');
  let cards = $('.card');

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


//  // Add hover event handlers
//  $('.dropdown').hover(
//   function () {
//       // On hover in
//       $(this).find('.dropdown-menu.drop-1').stop(true, true).delay(200).fadeIn(300);
//   },
//   function () {
//       // On hover out
//       $(this).find('.dropdown-menu.drop-1').stop(true, true).delay(200).fadeOut(300);
//   }
// );

// document.addEventListener('DOMContentLoaded', function () {
//   const scrollBtn = document.getElementById('scroll_btn');

//   // Initial check for scroll position
//   checkScroll();

//   // Add scroll event listener
//   window.addEventListener('scroll', function () {
//     checkScroll();
//   });

//   // Add click event listener to the button
//   scrollBtn.addEventListener('click', function () {
//     scrollToTop(300);
//   });

//   function checkScroll() {
//     // Show/hide the button based on the scroll position
//     if (window.scrollY > 100) {
//       scrollBtn.style.display = 'block';
//     } else {
//       scrollBtn.style.display = 'none';
//     }
//   }

//   function scrollToTop(duration) {
//     const start = window.pageYOffset;
//     const startTime = 'now' in window.performance ? performance.now() : new Date().getTime();

//     function scrollStep(timestamp) {
//       const currentTime = 'now' in window.performance ? performance.now() : new Date().getTime();
//       const progress = Math.min(1, (currentTime - startTime) / duration);

//       window.scrollTo(0, start - start * progress);

//       if (progress < 1) {
//         requestAnimationFrame(scrollStep);
//       }
//     }

//     requestAnimationFrame(scrollStep);
//   }
// });

//   $(document).ready(() => {
//     $('[data-fancybox="gallery"]').fancybox({
//       buttons: [
//         "slideShow",
//         "thumbs",
//         "zoom",
//         "fullScreen",
//         "share",
//         "close"
//       ],
//       loop: false,
//       protect: true
//     });
//   });

// $(document).ready(function () {

//   $('.bookmark-button').on('click', function(e) {
//     e.preventDefault();
//     var postId = $(this).data('post-id');
//     var bookmarkedPosts = JSON.parse(localStorage.getItem('bookmarkedPosts')) || [];
    
//     if (bookmarkedPosts.includes(postId)) {
//         // Remove post from bookmarks
//         var index = bookmarkedPosts.indexOf(postId);
//         bookmarkedPosts.splice(index, 1);
//         $(this).removeClass('bookmarked').find('i').removeClass('bi-bookmark-fill').addClass('bi-bookmark');
//     } else {
//         // Add post to bookmarks
//         bookmarkedPosts.push(postId);
//         $(this).addClass('bookmarked').find('i').removeClass('bi-bookmark').addClass('bi-bookmark-fill');
//     }

//       // Save updated bookmarks to localStorage
//       localStorage.setItem('bookmarkedPosts', JSON.stringify(bookmarkedPosts));
//   });

//   // Check if post is bookmarked on page load
//   $('.bookmark-button').each(function() {
//       var postId = $(this).data('post-id');
//       var bookmarkedPosts = JSON.parse(localStorage.getItem('bookmarkedPosts')) || [];
//       if (bookmarkedPosts.includes(postId)) {
//           $(this).addClass('bookmarked').find('i').removeClass('bi-bookmark').addClass('bi-bookmark-fill');
//       }
//   });


//   nextCard();
//   setInterval(nextCard, 5000); 


//   let container = $('.container-img');
//   let cards = $('.card');

//   // Filter gallery based on category
//   $('#filter-menu').on('click', '.filter-item', function () {
//     let selectedFilter = $(this).data('filter');
//     let matchingCards;

//     if (selectedFilter === 'all') {
//       matchingCards = cards;
//     } else {
//       matchingCards = cards.filter(function () {
//         let dataId = $(this).find('a').data('id').toLowerCase();
//         return dataId === selectedFilter.toLowerCase();
//       });
//     }

//     // Clear the container
//     container.empty();

//     // Append matching cards to the container with fadeIn animation
//     matchingCards.each(function () {
//       $(this).removeClass('fade-out').addClass('fade-in').appendTo(container).hide().fadeIn();
//     });

//     // Add fade-out class to non-matching cards and fade them out
//     cards.not(matchingCards).each(function () {
//       $(this).removeClass('fade-in').addClass('fade-out').fadeOut();
//     });
//   });
// });

// $(document).ready(function () {
//   let container = $('.container-img-pdf');
//   let cards = $('.card');

//   $('#filter-menu-2').on('click', '.filter-item', function () {
//     let selectedFilter = $(this).data('filter');
//     let matchingCards;

//     if (selectedFilter === 'all') {
//       matchingCards = cards;
//     } else {
//       matchingCards = cards.filter(function () {
//         let dataId = $(this).data('id').toLowerCase();
//         return dataId === selectedFilter.toLowerCase();
//       });
//     }

//     container.empty();

//     matchingCards.each(function () {
//       $(this).removeClass('fade-out').addClass('fade-in').appendTo(container).hide().fadeIn();
//     });

//     cards.not(matchingCards).each(function () {
//       $(this).removeClass('fade-in').addClass('fade-out').fadeOut();
//     });
//   });
// });


// var shadow = '0 20px 50px rgba(0,34,45,0)';
// var currentIndex = 1; // Start with the second card

// function styles(item_id, x, y, z , opacity, shadow){
// 	$(item_id).css({
// 		transform: 'translate3d('+ x +'px, ' + y + 'px, ' + z +'px)',
// 		opacity: opacity,
// 		'box-shadow': shadow,
// 		transition: 'transform 1s ease, opacity 1s ease' // Smooth transition
// 	});
// }

// function nextCard() {
//   $('#first, #second, #third').removeClass('focus');
//   currentIndex = currentIndex % 3 + 1; // Cycle through 1, 2, 3
//   var currentId = '#' + (currentIndex === 1 ? 'first' : currentIndex === 2 ? 'second' : 'third');
//   $(currentId).addClass('focus');

//   if (currentIndex === 1) {
//     styles('#first', 0, -37, 0, 1, shadow);
//     styles('#second', 70, 50, -50, 0.2, 'none');
//     styles('#third', 110, -107, -60, 0, 'none');
//   } else if (currentIndex === 2) {
//     styles('#first', 110, -107, -60, 0, 'none');
//     styles('#second', 0, -50, 0, 1, shadow);
//     styles('#third', 70, 50, -50, 0.2, 'none');
//   } else {
//     styles('#first', 70, 50, -50, 0.2, 'none');
//     styles('#second', 110, -107, -60, 0, 'none');
//     styles('#third', 0, -50, 0, 1, shadow);
//   }
// }
