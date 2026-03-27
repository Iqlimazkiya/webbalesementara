document.addEventListener("DOMContentLoaded", function () {
    const line1 = document.getElementById("text-line-1");
    const line2 = document.getElementById("text-line-2");
    const arrow = document.getElementById("scroll-arrow");
    setTimeout(() => {
        line1.classList.remove("opacity-0", "translate-y-10");
        line1.classList.add("opacity-100", "translate-y-0");
    }, 300);
    setTimeout(() => {
        line2.classList.remove("opacity-0", "translate-y-10");
        line2.classList.add("opacity-100", "translate-y-0");
    }, 800);
    setTimeout(() => {
        arrow.classList.remove("opacity-0");
        arrow.classList.add("opacity-100");
    }, 1500);

    // ── Scroll reveal ────────────────────────────────────
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove(
                        "opacity-0",
                        "translate-y-10",
                        "translate-y-20",
                        "scale-105",
                        "scale-95",
                        "-translate-x-10",
                        "translate-y-5",
                    );
                    entry.target.classList.add(
                        "opacity-100",
                        "translate-y-0",
                        "scale-100",
                        "translate-x-0",
                    );
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12 },
    );
    document.querySelectorAll(".reveal").forEach((el) => observer.observe(el));

    document
        .querySelectorAll(".carousel-photo-container")
        .forEach((container) => {
            const slides = container.querySelectorAll(".carousel-slide");
            if (slides.length <= 1) return;
            let idx = 0;
            setInterval(() => {
                slides[idx].classList.replace("opacity-100", "opacity-0");
                idx = (idx + 1) % slides.length;
                slides[idx].classList.replace("opacity-0", "opacity-100");
            }, 5000);
        });
});

window.scrollToNext = function () {
    window.scrollTo({ top: window.innerHeight, behavior: "smooth" });
};

let currentSlideIndex = 0;
let isTransitioning = false;

window.moveSlide = function (direction) {
    if (isTransitioning) return;
    const track = document.getElementById("carousel-track");
    const slides = document.querySelectorAll(".carousel-unit");
    const totalSlides = slides.length;
    isTransitioning = true;

    if (direction === 1 && currentSlideIndex === totalSlides - 1) {
        const clone = slides[0].cloneNode(true);
        track.appendChild(clone);
        track.style.transition = "transform .5s ease-in-out";
        track.style.transform = `translateX(-${totalSlides * 100}%)`;
        currentSlideIndex = 0;
        track.addEventListener(
            "transitionend",
            function h() {
                track.style.transition = "none";
                track.style.transform = "translateX(0%)";
                track.removeChild(clone);
                isTransitioning = false;
                track.removeEventListener("transitionend", h);
            },
            { once: true },
        );
    } else if (direction === -1 && currentSlideIndex === 0) {
        const clone = slides[totalSlides - 1].cloneNode(true);
        track.insertBefore(clone, slides[0]);
        track.style.transition = "none";
        track.style.transform = "translateX(-100%)";
        track.offsetHeight;
        track.style.transition = "transform .5s ease-in-out";
        track.style.transform = "translateX(0%)";
        currentSlideIndex = totalSlides - 1;
        track.addEventListener(
            "transitionend",
            function h() {
                track.style.transition = "none";
                track.style.transform = `translateX(-${(totalSlides - 1) * 100}%)`;
                track.removeChild(clone);
                isTransitioning = false;
                track.removeEventListener("transitionend", h);
            },
            { once: true },
        );
    } else {
        currentSlideIndex += direction;
        track.style.transition = "transform .5s ease-in-out";
        track.style.transform = `translateX(-${currentSlideIndex * 100}%)`;
        setTimeout(() => {
            isTransitioning = false;
        }, 500);
    }
    updateIndicators(currentSlideIndex);
};

function updateIndicators(index) {
    document.querySelectorAll(".indicator-bar").forEach((ind, i) => {
        ind.className =
            i === index
                ? "indicator-bar h-1 w-12 bg-[#335A40] rounded-full transition-all duration-500"
                : "indicator-bar h-2 w-2 bg-gray-400 rounded-full transition-all duration-500";
    });
}

window.navigateToUnit = function (index) {
    document
        .getElementById("detail-unit")
        .scrollIntoView({ behavior: "smooth" });
    setTimeout(() => {
        currentSlideIndex = index;
        const track = document.getElementById("carousel-track");
        track.style.transition = "transform .8s cubic-bezier(.4,0,.2,1)";
        track.style.transform = `translateX(-${currentSlideIndex * 100}%)`;
        updateIndicators(index);
    }, 700);
};

window.handleMobileClick = function (el, index) {
    const allCards = document.querySelectorAll(".unit-card-mobile");
    if (el.classList.contains("active")) {
        document
            .getElementById("detail-unit")
            .scrollIntoView({ behavior: "smooth" });
        setTimeout(() => {
            currentSlideIndex = index;
            const track = document.getElementById("carousel-track");
            track.style.transition = "transform .8s cubic-bezier(.4,0,.2,1)";
            track.style.transform = `translateX(-${index * 100}%)`;
            updateIndicators(index);
        }, 600);
    } else {
        allCards.forEach((c) => c.classList.remove("active"));
        el.classList.add("active");
        setTimeout(() => {
            el.scrollIntoView({ behavior: "smooth", block: "nearest" });
        }, 300);
    }
};
