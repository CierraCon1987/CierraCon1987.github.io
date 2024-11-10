document.addEventListener('DOMContentLoaded', () => {
    const logos = document.querySelectorAll('.logo img, .brand-logo img');
    
    logos.forEach(logo => {
        logo.addEventListener('mouseover', () => {
            logo.classList.add('wiggle-effect');
        });

        // Remove the wiggle effect once the animation is done
        logo.addEventListener('animationend', () => {
            logo.classList.remove('wiggle-effect');
        });
    });
});

