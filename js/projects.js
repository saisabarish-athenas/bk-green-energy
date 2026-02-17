// ===============================
// BK GREEN ENERGY - PROJECTS JS (FINAL CLEAN)
// ===============================


// ---------- INTERSECTION OBSERVER ----------
const observer = new IntersectionObserver(entries=>{
    entries.forEach(entry=>{
        if(entry.isIntersecting){
            entry.target.classList.add("visible");
        }
    });
},{
    threshold:0.15,
    rootMargin:"0px 0px -50px 0px"
});


// ---------- DOM READY ----------
document.addEventListener("DOMContentLoaded", ()=>{

    /* FADE ANIMATIONS */
    document.querySelectorAll(".fade-up, .fade-left, .fade-right, .fade-in-up")
        .forEach(el=>observer.observe(el));


    /* NAVBAR SCROLL COLOR */
    const navbar=document.querySelector(".custom-navbar");
    if(navbar){
        window.addEventListener("scroll",()=>{
            navbar.classList.toggle("navbar-scrolled", window.scrollY>60);
        });
    }


    /* SCROLL INDICATOR */
    const indicator=document.querySelector(".scroll-indicator");
    if(indicator){
        indicator.addEventListener("click",()=>{
            document.querySelector(".service-showcase")?.scrollIntoView({
                behavior:"smooth"
            });
        });
    }


    /* PARALLAX HERO */
    const heroBg=document.querySelector(".hero-bg");
    if(heroBg){
        window.addEventListener("scroll",()=>{
            heroBg.style.transform=
                `translateY(${window.pageYOffset * 0.35}px)`;
        });
    }


    /* INITIALIZE FEATURES */
    initServiceTabs();
    initCarousel();

});


// ---------- SERVICE TABS ----------
function initServiceTabs(){

    const tabs=document.querySelectorAll(".tab-item");
    const panels=document.querySelectorAll(".content-panel");

    if(!tabs.length || !panels.length) return;

    tabs.forEach(tab=>{
        tab.addEventListener("click",()=>{

            const service=tab.dataset.service;

            tabs.forEach(t=>t.classList.remove("active"));
            tab.classList.add("active");

            panels.forEach(p=>p.classList.remove("active"));

            const activePanel=document.querySelector(
                `.content-panel[data-content="${service}"]`
            );

            if(activePanel){
                activePanel.classList.add("active");

                // smooth scroll on mobile
                if(window.innerWidth<992){
                    activePanel.scrollIntoView({
                        behavior:"smooth",
                        block:"start"
                    });
                }
            }

        });
    });

}


// ---------- CAROUSEL ----------
function initCarousel(){

    const slides=document.querySelectorAll(".carousel-slide");
    const prev=document.querySelector(".carousel-btn.prev");
    const next=document.querySelector(".carousel-btn.next");
    const dotsBox=document.querySelector(".carousel-dots");
    const container=document.querySelector(".carousel-container");

    if(!slides.length || !prev || !next || !dotsBox || !container) return;

    let current=0;
    let autoPlayInterval=null;


    /* CREATE DOTS */
    dotsBox.innerHTML="";

    slides.forEach((_,i)=>{
        const dot=document.createElement("div");
        dot.className="dot"+(i===0?" active":"");
        dot.addEventListener("click",()=>go(i));
        dotsBox.appendChild(dot);
    });

    const dots=dotsBox.querySelectorAll(".dot");


    /* SLIDE CHANGE */
    function go(n){

        slides[current].classList.remove("active");
        dots[current].classList.remove("active");

        current=(n+slides.length)%slides.length;

        slides[current].classList.add("active");
        dots[current].classList.add("active");
    }


    function nextSlide(){ go(current+1); }
    function prevSlide(){ go(current-1); }


    /* BUTTONS */
    next.addEventListener("click",()=>{
        nextSlide();
        restartAutoPlay();
    });

    prev.addEventListener("click",()=>{
        prevSlide();
        restartAutoPlay();
    });


    /* AUTOPLAY */
    function startAutoPlay(){
        stopAutoPlay();
        autoPlayInterval=setInterval(nextSlide,3000);
    }

    function stopAutoPlay(){
        if(autoPlayInterval){
            clearInterval(autoPlayInterval);
            autoPlayInterval=null;
        }
    }

    function restartAutoPlay(){
        startAutoPlay();
    }


    /* PAUSE ON HOVER */
    container.addEventListener("mouseenter",stopAutoPlay);
    container.addEventListener("mouseleave",startAutoPlay);


    /* START */
    startAutoPlay();

}
