document.addEventListener("DOMContentLoaded", () => {
    const targets = [
        { sel: ".hdr-label", delay: 200 },
        { sel: ".hdr-title", delay: 450 },
        { sel: ".hdr-divider", delay: 1600 },
        { sel: ".hdr-desc", delay: 1850 },
    ];
    targets.forEach(({ sel, delay }) => {
        const el = document.querySelector(sel);
        if (!el) return;
        setTimeout(() => {
            el.style.transition =
                "opacity 0.9s cubic-bezier(0.22,1,0.36,1), transform 0.9s cubic-bezier(0.22,1,0.36,1)";
            el.style.opacity = "1";
            el.style.transform =
                sel === ".hdr-divider" ? "scaleX(1)" : "translateY(0)";
        }, delay);
    });
});

const revealObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("active");
            }
        });
    },
    { threshold: 0.1 },
);
document
    .querySelectorAll(".reveal")
    .forEach((el) => revealObserver.observe(el));

const COLLAPSED_H = window.innerWidth < 640 ? 160 : 220;
const STACK_OVERLAP = window.innerWidth < 640 ? 96 : 128;
const PANEL_ORDER = ["p1", "p2", "p3", "p4"];
const initialHeights = {};
document.addEventListener("DOMContentLoaded", () => {
    PANEL_ORDER.forEach((id) => {
        const el = document.getElementById(id);
        if (el) initialHeights[id] = el.offsetHeight;
    });
});

let statusTerbuka = false;

const sectionEl = document.getElementById("section-panels");

const sectionObserver = new IntersectionObserver(
    (entries) => {
        if (!entries[0].isIntersecting) return;
        sectionObserver.disconnect();

        PANEL_ORDER.forEach((id, i) => {
            const el = document.getElementById(id);
            if (!el) return;

            setTimeout(() => {
                el.classList.add("visible");

                if (id === "p4") {
                    setTimeout(() => {
                        el.querySelectorAll(".p4-animate").forEach(
                            (child, ci) => {
                                setTimeout(() => {
                                    child.style.opacity = "1";
                                    child.style.transform = "translateY(0)";
                                }, ci * 220);
                            },
                        );

                        const ketentuan =
                            document.getElementById("section-ketentuan");
                        if (ketentuan) {
                            setTimeout(() => {
                                ketentuan.style.opacity = "1";
                                ketentuan.style.transform = "translateY(0)";

                                ketentuan
                                    .querySelectorAll(".ketentuan-item")
                                    .forEach((item, ki) => {
                                        setTimeout(() => {
                                            item.style.opacity = "1";
                                            item.style.transform =
                                                "translateY(0)";
                                        }, ki * 120);
                                    });
                            }, 1800);
                        }
                    }, 450);
                }
            }, i * 280);
        });
    },
    { threshold: 0.05 },
);

if (sectionEl) sectionObserver.observe(sectionEl);

function getFullHeight(el) {
    const prevHeight = el.style.height;
    const prevOverflow = el.style.overflow;

    el.style.height = "auto";
    el.style.overflow = "visible";

    const h = el.scrollHeight;

    el.style.height = prevHeight;
    el.style.overflow = prevOverflow;

    void el.offsetHeight;

    return h + 120;
}
function recalcMargins() {
    PANEL_ORDER.forEach((id, i) => {
        if (i === 0) return;
        const el = document.getElementById(id);
        const above = document.getElementById(PANEL_ORDER[i - 1]);
        if (!el || !above) return;

        const aboveH =
            parseInt(above.style.height) ||
            initialHeights[PANEL_ORDER[i - 1]] ||
            COLLAPSED_H;
        const overlap = Math.min(STACK_OVERLAP, aboveH - 60);
        el.style.marginTop = `-${overlap}px`;
    });
}
function expandPanel(id) {
    const el = document.getElementById(id);
    const content = el ? el.querySelector(`.${id}-content`) : null;
    if (!el) return;

    const fullH = getFullHeight(el);
    el.style.height = fullH + "px";
    el.style.overflow = "hidden";
    el.classList.add("expanded");

    setTimeout(() => recalcMargins(), 50);

    if (content) {
        setTimeout(() => {
            content.style.opacity = "1";
        }, 480);
    }
}

function collapsePanel(id) {
    const el = document.getElementById(id);
    const content = el ? el.querySelector(`.${id}-content`) : null;
    if (!el) return;

    if (content) content.style.opacity = "0";
    el.classList.remove("expanded");

    setTimeout(() => {
        const h = initialHeights[id] || COLLAPSED_H;
        el.style.height = h + "px";
        setTimeout(() => recalcMargins(), 50);
    }, 220);
}
function togglePanel(id) {
    const el = document.getElementById(id);
    const isExpanded = el ? el.classList.contains("expanded") : false;
    ["p1", "p2", "p3"].forEach((pid) => {
        if (document.getElementById(pid)?.classList.contains("expanded")) {
            collapsePanel(pid);
        }
    });

    if (!isExpanded) {
        setTimeout(() => {
            expandPanel(id);

            const btn = document.getElementById("btn-selengkapnya");
            if (btn) btn.innerText = "Ringkas";
            statusTerbuka = true;
            setTimeout(() => {
                const target = document.getElementById(id);
                if (!target) return;
                const rect = target.getBoundingClientRect();
                const targetY = window.scrollY + rect.top - 80;
                smoothScrollTo(targetY, 800);
            }, 950);
        }, 250);
    } else {
        const btn = document.getElementById("btn-selengkapnya");
        if (btn) btn.innerText = "Selengkapnya";
        statusTerbuka = false;
    }
}
function bongkarPanel() {
    const btn = document.getElementById("btn-selengkapnya");
    if (!statusTerbuka) {
        ["p1", "p2", "p3"].forEach((id) => expandPanel(id));
        if (btn) btn.innerText = "Ringkas";
        statusTerbuka = true;
    } else {
        ["p1", "p2", "p3"].forEach((id) => collapsePanel(id));
        if (btn) btn.innerText = "Selengkapnya";
        statusTerbuka = false;
    }
}
function smoothScrollTo(targetY, duration = 900) {
    const start = window.scrollY;
    const diff = targetY - start;
    let startTime = null;

    function ease(t) {
        return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }

    function step(ts) {
        if (!startTime) startTime = ts;
        const progress = Math.min((ts - startTime) / duration, 1);
        window.scrollTo(0, start + diff * ease(progress));
        if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
}
function bukaSpesifikPanel(nomor) {
    const targetId = "p" + nomor;

    ["p1", "p2", "p3"].forEach((id) => {
        if (document.getElementById(id)?.classList.contains("expanded")) {
            collapsePanel(id);
        }
    });

    const target = document.getElementById(targetId);
    if (!target) return;

    expandPanel(targetId);
    const btn = document.getElementById("btn-selengkapnya");
    if (btn) btn.innerText = "Ringkas";
    statusTerbuka = true;

    setTimeout(() => {
        const rect = target.getBoundingClientRect();
        const targetY = window.scrollY + rect.top - 80;
        smoothScrollTo(targetY, 1000);
    }, 950);
}
window.bukaSpesifikPanel = bukaSpesifikPanel;
window.bongkarPanel = bongkarPanel;
window.togglePanel = togglePanel;
