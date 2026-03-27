(function () {
    const _setTimeout = window.setTimeout;
    window.setTimeout = function (fn, delay) {
        return _setTimeout(function () {
            try {
                fn();
            } catch (e) {
                if (
                    e instanceof TypeError &&
                    e.message.includes("getBoundingClientRect")
                ) {
                } else {
                    throw e;
                }
            }
        }, delay);
    };
})();

document.addEventListener("DOMContentLoaded", function () {
    const alerts = document.querySelectorAll(".alert");
    if (alerts.length > 0) {
        alerts.forEach((alert) => {
            setTimeout(() => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    if (typeof simpleDatatables !== "undefined") {
        setTimeout(() => {
            const tables = document.querySelectorAll("table.dataTable");
            tables.forEach((table) => {
                if (
                    table &&
                    table.tBodies.length > 0 &&
                    table.tBodies[0].rows.length > 0
                ) {
                    try {
                        new simpleDatatables.DataTable(table);
                    } catch (e) {
                        console.log("DataTable init skipped");
                    }
                }
            });
        }, 500);
    }
});

(function () {
    const POLL_URL = window.ADMIN_UNREAD_COUNT_URL;
    const MESSAGES_URL = window.ADMIN_MESSAGES_URL;
    const POLL_MS = 30_000;
    const badgeSidebar = document.getElementById("sidebar-unread-badge");
    const badgeDash = document.getElementById("dash-unread-badge");
    let lastCount = null;

    function updateBadges(count) {
        if (badgeSidebar) {
            if (count > 0) {
                badgeSidebar.textContent = count > 99 ? "99+" : count;
                badgeSidebar.style.display = "inline-block";
            } else {
                badgeSidebar.style.display = "none";
            }
        }

        if (badgeDash) {
            badgeDash.textContent = count;
        }

        if (lastCount !== null && count > lastCount) {
            const diff = count - lastCount;
            showToast(diff + " pesan baru masuk");
        }

        lastCount = count;
    }

    function showToast(msg) {
        const toast = document.createElement("div");
        toast.style.cssText = `
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 9999;
            background: #1e3a2f;
            color: #fff;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,.25);
            border: 1px solid rgba(197,160,89,.3);
            animation: toastIn .3s ease;
        `;
        toast.innerHTML = `
            <span style="width:8px;height:8px;border-radius:50%;background:#e05c5c;flex-shrink:0;
                         box-shadow:0 0 0 3px rgba(224,92,92,.25);"></span>
            ${msg}
            <a href="${MESSAGES_URL}"
               style="color:#c5a059;font-size:11px;margin-left:4px;text-decoration:none;">
                Lihat →
            </a>`;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = "toastOut .3s ease forwards";
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }

    async function poll() {
        if (!POLL_URL) return; // jaga-jaga kalau URL tidak di-set
        try {
            const res = await fetch(POLL_URL, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
            });
            const data = await res.json();
            updateBadges(data.count);
        } catch (e) {}
    }

    poll();
    setInterval(poll, POLL_MS);
})();
