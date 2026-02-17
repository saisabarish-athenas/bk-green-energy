// BK Green Energy - About Page JavaScript

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


// Initialize animations on page load
document.addEventListener('DOMContentLoaded', () => {
    // Observe all animated elements
    const animatedElements = document.querySelectorAll('.fade-up, .slide-right');
    animatedElements.forEach(el => observer.observe(el));

    // Parallax effect for intro section
    const introSection = document.querySelector('.intro-section');
    if (introSection) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const bgDecoration = document.querySelector('.bg-decoration');
            if (bgDecoration) {
                bgDecoration.style.transform = `translateY(${scrolled * 0.3}px)`;
            }
        });
    }

    // Timeline animation on scroll
    const timelineItems = document.querySelectorAll('.timeline-item');
    const timelineObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, index * 100);
            }
        });
    }, { threshold: 0.2 });

    timelineItems.forEach(item => timelineObserver.observe(item));
});
