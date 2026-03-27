let visitorChart, unitChart;
let chartData = {};
let unitChartData = {};

function fmtK(val) {
    if (val >= 1000000)
        return (val / 1000000).toFixed(1).replace(/\.0$/, "") + "Jt";
    if (val >= 1000) return (val / 1000).toFixed(1).replace(/\.0$/, "") + "K";
    return val;
}

function initChart(type = "monthly") {
    const ctx = document.getElementById("visitorChart");
    if (!ctx) return;
    if (visitorChart) visitorChart.destroy();

    const d = chartData[type];

    const minWidth = Math.max(700, d.labels.length * 150);
    ctx.style.width = minWidth + 'px';
    ctx.style.height = '260px';
    const scrollInner = ctx.closest('.chart-scroll-inner');
    if (scrollInner) scrollInner.style.width = minWidth + 'px';

    visitorChart = new Chart(ctx.getContext("2d"), {
        type: "line",
        data: {
            labels: d.labels,
            datasets: [
                {
                    label: "Pengunjung",
                    data: d.data,
                    borderColor: "#335A40",
                    backgroundColor: "rgba(51,90,64,0.08)",
                    tension: 0.45,
                    fill: true,
                    pointBackgroundColor: "#335A40",
                    pointBorderColor: "#fff",
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    borderWidth: 2.5,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: { duration: 450 },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: "#1e3a2f",
                    padding: 10,
                    borderRadius: 8,
                    displayColors: false,
                    callbacks: {
                        title: (ctx) =>
                            d.dates?.[ctx[0].dataIndex] ||
                            d.labels[ctx[0].dataIndex] ||
                            "",
                        label: (ctx) =>
                            "Pengunjung: " + ctx.parsed.y.toLocaleString("id"),
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: "rgba(0,0,0,0.04)" },
                    ticks: {
                        font: { size: 11 },
                        color: "#9ca3af",
                        maxTicksLimit: 6,
                        callback: (v) => fmtK(v),
                    },
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { size: 11 },
                        color: "#9ca3af",
                        maxRotation: 0,
                        autoSkip: false,
                        callback: function(val, index) {
                            const label = this.getLabelForValue(val);
                            const match = label.match(/^(.+?)\s*(\(.+\))$/);
                            if (match) return [match[1], match[2]];
                            return label;
                        },
                    },
                },
            },
        },
    });
}

function changeChart(type) {
    initChart(type);
}
window.changeChart = changeChart;
window.toggleGuide = toggleGuide;

function initUnitChart() {
    const el = document.getElementById("unitChart");
    if (!el) return;
    if (unitChart) unitChart.destroy();

    const colors = ["#1e3a2f", "#2d5240", "#40916C", "#74C69D", "#b7e4c7"];

    unitChart = new Chart(el.getContext("2d"), {
        type: "doughnut",
        data: {
            labels: unitChartData.labels,
            datasets: [
                {
                    data: unitChartData.data,
                    backgroundColor: colors.slice(0, unitChartData.labels.length),
                    borderColor: "#fff",
                    borderWidth: 3,
                    hoverOffset: 6,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: "55%",
            animation: { duration: 450 },
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        padding: 14,
                        usePointStyle: true,
                        pointStyle: "circle",
                        font: { size: 11 },
                        color: "#374151",
                    },
                },
                tooltip: {
                    backgroundColor: "#1e3a2f",
                    padding: 10,
                    borderRadius: 8,
                    callbacks: {
                        label: (ctx) => {
                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const pct = total > 0
                                ? ((ctx.parsed / total) * 100).toFixed(1)
                                : 0;
                            return ` ${ctx.label}: ${ctx.parsed} (${pct}%)`;
                        },
                    },
                },
            },
        },
    });
}

function toggleGuide(btn) {
    const body = btn.nextElementSibling;
    const isOpen = body.classList.contains("open");
    document.querySelectorAll(".guide-body").forEach((b) => b.classList.remove("open"));
    document.querySelectorAll(".guide-toggle").forEach((b) => b.classList.remove("open"));
    if (!isOpen) {
        body.classList.add("open");
        btn.classList.add("open");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    chartData = {
        daily: window.CHART_DATA_DAILY,
        weekly: window.CHART_DATA_WEEKLY,
        monthly: window.CHART_DATA_MONTHLY,
    };
    unitChartData = window.UNIT_CHART_DATA;

    initChart("monthly");
    initUnitChart();

    const periodSelect = document.querySelector('.period-select');
    if (periodSelect) {
        periodSelect.addEventListener('change', (e) => initChart(e.target.value));
    }
});