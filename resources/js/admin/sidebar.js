(function () {
    "use strict";

    var sidebar = null;
    var overlay = null;
    var burger = null;
    var isMobile = function () {
        return window.innerWidth < 1200;
    };

    function sbOpen() {
        sidebar.classList.add("sb-open");
        overlay.style.display = "block";
        document.body.style.overflow = "hidden";
    }

    window.sbClose = function () {
        sidebar.classList.remove("sb-open");
        overlay.style.display = "none";
        document.body.style.overflow = "";
    };

    document.addEventListener("DOMContentLoaded", function () {
        sidebar = document.getElementById("sidebar");
        overlay = document.getElementById("sb-overlay");
        burger = document.querySelector(".burger-btn");

        if (!sidebar || !overlay) return;

        overlay.addEventListener("click", window.sbClose);

        if (burger) {
            burger.addEventListener(
                "click",
                function (e) {
                    if (!isMobile()) return;
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    var isOpen = sidebar.classList.contains("sb-open");
                    isOpen ? window.sbClose() : sbOpen();
                },
                true,
            );
        }

        sidebar
            .querySelectorAll(
                '.sidebar-link[href]:not([href="#"]):not([href="javascript:void(0)"])',
            )
            .forEach(function (link) {
                link.addEventListener("click", function () {
                    if (isMobile()) setTimeout(window.sbClose, 100);
                });
            });

        window.addEventListener("resize", function () {
            if (!isMobile()) window.sbClose();
        });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") window.sbClose();
        });
    });

    window.toggleLayanan = function () {
        var submenu = document.getElementById("layananSubmenu");
        var chevron = document.getElementById("layananChevron");
        var hidden =
            submenu.style.display === "none" || submenu.style.display === "";
        submenu.style.display = hidden ? "block" : "none";
        chevron.style.transform = hidden ? "rotate(180deg)" : "rotate(0deg)";
    };

    window.initLayananSubmenu = function () {
        var sub = document.getElementById("layananSubmenu");
        var chev = document.getElementById("layananChevron");
        if (sub) sub.style.display = "block";
        if (chev) chev.style.transform = "rotate(180deg)";
    };
})();
