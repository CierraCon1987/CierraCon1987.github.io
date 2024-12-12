// Fade-in effect on scroll
document.addEventListener("DOMContentLoaded", function () {
    const fadeElements = document.querySelectorAll('.fade-in');
  
    function fadeInOnScroll() {
      fadeElements.forEach(element => {
        const rect = element.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
          element.classList.add('show');
        }
      });
    }
  
    // Trigger the function on scroll and initial page load
    window.addEventListener('scroll', fadeInOnScroll);
    fadeInOnScroll(); 
  });
  