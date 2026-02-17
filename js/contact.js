// BK Green Energy - Contact Page JavaScript

// Intersection Observer for scroll animations
const observerOptions = {
    threshold: 0.15,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);
// Navbar scroll effect
window.addEventListener("scroll", function () {
    let navbar = document.querySelector(".custom-navbar");
    if (window.scrollY > 60) {
        navbar.classList.add("navbar-scrolled");
    } else {
        navbar.classList.remove("navbar-scrolled");
    }
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Observe all animated elements
    const animatedElements = document.querySelectorAll('.fade-up, .fade-left, .fade-right');
    animatedElements.forEach(el => observer.observe(el));

    // Parallax effect for hero shapes
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const shapes = document.querySelectorAll('.shape');
        
        shapes.forEach((shape, index) => {
            const speed = 0.3 + (index * 0.1);
            shape.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });

    // Form input placeholder handling
    const formInputs = document.querySelectorAll('.form-group input, .form-group textarea');
    formInputs.forEach(input => {
        input.setAttribute('placeholder', ' ');
    });

    // Smooth scroll for scroll indicator
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', () => {
            document.querySelector('.contact-form-section').scrollIntoView({
                behavior: 'smooth'
            });
        });
    }
});
