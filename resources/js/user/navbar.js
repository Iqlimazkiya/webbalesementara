const navbar = document.getElementById("main-nav");
const menuBtn = document.getElementById("menu-btn");
const mobileMenu = document.getElementById("mobile-menu");
const mobileLinks = document.querySelectorAll(".mobile-link");

// Variables for scroll-based hide/show
let lastScrollY = 0;
let scrollDirection = "none";
const SCROLL_THRESHOLD = 10; // Minimum scroll to detect direction

menuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("translate-x-full");
    menuBtn.classList.toggle("menu-open");
    navbar.classList.toggle("nav-active-bg");

    const isOpen = !mobileMenu.classList.contains("translate-x-full");
    document.body.style.overflow = isOpen ? "hidden" : "";
});

mobileLinks.forEach((link) => {
    link.addEventListener("click", () => {
        mobileMenu.classList.add("translate-x-full");
        menuBtn.classList.remove("menu-open");
        navbar.classList.remove("nav-active-bg");
        document.body.style.overflow = "";
    });
});

// Scroll-based navbar hide/show functionality
function handleScroll() {
    const currentScrollY = window.scrollY;

    // Determine scroll direction
    if (Math.abs(currentScrollY - lastScrollY) > SCROLL_THRESHOLD) {
        if (currentScrollY > lastScrollY) {
            scrollDirection = "down";
        } else {
            scrollDirection = "up";
        }

        // Only hide/show when not at the top
        if (currentScrollY > 50) {
            if (scrollDirection === "down") {
                // Hide navbar when scrolling down
                navbar.classList.add("navbar-hidden");
            } else if (scrollDirection === "up") {
                // Show navbar when scrolling up (keep it visible)
                navbar.classList.remove("navbar-hidden");
            }
        } else {
            // Always show navbar at top
            navbar.classList.remove("navbar-hidden");
        }

        lastScrollY = currentScrollY;
    }
}

// Add scroll event listener
window.addEventListener("scroll", handleScroll, { passive: true });
