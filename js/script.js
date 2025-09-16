// ----------------------------
// Countdown Timer
// ----------------------------
function initCountdown() {
    if (typeof eventStart === "undefined") return;

    const countDownDate = new Date(eventStart).getTime();

    const countdownTimer = setInterval(() => {
        const now = Date.now();
        const distance = countDownDate - now;

        if (distance <= 0) {
            clearInterval(countdownTimer);
            updateCountdown(0, 0, 0, 0);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        updateCountdown(days, hours, minutes, seconds);
    }, 1000);
}

function updateCountdown(days, hours, minutes, seconds) {
    document.getElementById("days").innerText = days.toString().padStart(2, "0");
    document.getElementById("hours").innerText = hours.toString().padStart(2, "0");
    document.getElementById("minutes").innerText = minutes.toString().padStart(2, "0");
    document.getElementById("seconds").innerText = seconds.toString().padStart(2, "0");
}


// ----------------------------
// Smooth Scrolling
// ----------------------------
function initSmoothScrolling() {
    const navbar = document.querySelector(".navbar");
    const navbarHeight = navbar ? navbar.offsetHeight : 0;

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", e => {
            e.preventDefault();
            const target = document.querySelector(anchor.getAttribute("href"));
            if (target) {
                const offset = target.offsetTop - navbarHeight;
                window.scrollTo({ top: offset, behavior: "smooth" });

                // Close mobile menu if open
                const offcanvas = bootstrap.Offcanvas.getInstance(
                    document.getElementById("offcanvasNavbar")
                );
                if (offcanvas) offcanvas.hide();
            }
        });
    });
}


// ----------------------------
// Scroll Spy
// ----------------------------
function initScrollSpy() {
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".nav-link[href^='#']");

    function setActiveLink() {
        let current = "";

        sections.forEach(section => {
            const sectionTop = section.offsetTop - 120; // adjust offset
            if (window.scrollY >= sectionTop) {
                current = section.id;
            }
        });

        navLinks.forEach(link => {
            link.classList.toggle("active", link.getAttribute("href") === `#${current}`);
        });
    }

    window.addEventListener("scroll", setActiveLink);
    setActiveLink();
}


// ----------------------------
// Scroll Animations
// ----------------------------
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll(
        ".feature-card, .project-card, .stat-box"
    );

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

    animatedElements.forEach(el => {
        el.style.opacity = "0";
        el.style.transform = "translateY(30px)";
        el.style.transition = "opacity 0.6s ease, transform 0.6s ease";
        observer.observe(el);
    });
}


// ----------------------------
// Init All
// ----------------------------
document.addEventListener("DOMContentLoaded", () => {
    initCountdown();
    initSmoothScrolling();
    initScrollSpy();
    initScrollAnimations();
});
