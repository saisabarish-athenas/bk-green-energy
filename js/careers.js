// BK Green Energy - Careers Page JavaScript

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

    // Parallax effect for hero energy icons
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const energyIcons = document.querySelectorAll('.energy-icon');
        
        energyIcons.forEach((icon, index) => {
            const speed = 0.2 + (index * 0.1);
            icon.style.transform = `translateY(${scrolled * speed}px)`;
        });

        // Parallax for background decoration
        const bgDecoration = document.querySelector('.bg-decoration');
        if (bgDecoration) {
            bgDecoration.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
    });

    // Smooth scroll for scroll indicator
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', () => {
            document.querySelector('.why-section').scrollIntoView({
                behavior: 'smooth'
            });
        });
    }

    // Add staggered animation to cards
    const whyCards = document.querySelectorAll('.why-card');
    whyCards.forEach((card, index) => {
        card.style.transitionDelay = `${index * 0.1}s`;
    });

    const roleCards = document.querySelectorAll('.role-card');
    roleCards.forEach((card, index) => {
        card.style.transitionDelay = `${index * 0.1}s`;
    });
});
