// ===============================
// BK GREEN ENERGY - SERVICES PAGE JS (FINAL CLEAN)
// ===============================


// ---------- INTERSECTION OBSERVER ----------
const observer = new IntersectionObserver(entries=>{
    entries.forEach(entry=>{
        if(entry.isIntersecting){
            entry.target.classList.add("visible");

            // counter animation
            if(entry.target.classList.contains("stat-card")){
                const num = entry.target.querySelector(".stat-number");
                if(num && !num.classList.contains("counted")){
                    animateCounter(num);
                    num.classList.add("counted");
                }
            }
        }
    });
},{
    threshold:0.15,
    rootMargin:"0px 0px -50px 0px"
});


// ---------- DOM READY ----------
document.addEventListener("DOMContentLoaded",()=>{

    // observe elements
    document.querySelectorAll(".fade-up, .fade-in-up")
        .forEach(el=>observer.observe(el));

    document.querySelectorAll(".stat-card")
        .forEach(el=>observer.observe(el));

    // navbar scroll effect
    const navbar=document.querySelector(".custom-navbar");
    if(navbar){
        window.addEventListener("scroll",()=>{
            navbar.classList.toggle("navbar-scrolled", window.scrollY>60);
        });
    }

    // scroll arrow
    const arrow=document.querySelector(".scroll-arrow");
    if(arrow){
        arrow.addEventListener("click",()=>{
            document.querySelector(".project-gallery")?.scrollIntoView({
                behavior:"smooth"
            });
        });
    }

    initFilters();
    initMobileAccordion();

});


// ---------- FILTER BUTTONS ----------
function initFilters(){

    const buttons=document.querySelectorAll(".filter-btn");
    const cards=document.querySelectorAll(".project-card");

    if(!buttons.length) return;

    buttons.forEach(btn=>{
        btn.addEventListener("click",()=>{

            const filter=btn.dataset.filter;

            buttons.forEach(b=>b.classList.remove("active"));
            btn.classList.add("active");

            cards.forEach(card=>{

                const cat=card.dataset.category;

                if(filter==="all" || cat===filter){
                    card.style.display="block";
                    requestAnimationFrame(()=>{
                        card.style.opacity="1";
                        card.style.transform="scale(1)";
                    });
                }
                else{
                    card.style.opacity="0";
                    card.style.transform="scale(0.95)";

                    setTimeout(()=>{
                        card.style.display="none";
                    },250);
                }

            });

        });
    });
}


// ---------- COUNTER ----------
function animateCounter(el){

    const target=parseInt(el.dataset.target);
    const duration=1800;
    const startTime=performance.now();

    function update(now){

        const progress=Math.min((now-startTime)/duration,1);
        el.textContent=Math.floor(progress*target);

        if(progress<1){
            requestAnimationFrame(update);
        }else{
            el.textContent=target;
        }
    }

    requestAnimationFrame(update);
}


// ---------- MOBILE ACCORDION ----------
function initMobileAccordion(){

    const panels=document.querySelectorAll(".content-panel");

    if(!panels.length) return;

    panels.forEach(panel=>{
        panel.addEventListener("click",()=>{

            if(window.innerWidth>991) return;

            panels.forEach(p=>{
                if(p!==panel) p.classList.remove("active");
            });

            panel.classList.toggle("active");

        });
    });
}
