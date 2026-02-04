// Implementación ligera de jChart usando Chart.js como motor.
window.jChart = {
    drawLine: function (canvas, labels, data) {
        if (!window.Chart) {
            return null;
        }

        return new Chart(canvas, {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Avance de proyectos",
                        data: data,
                        borderColor: "#6366f1",
                        backgroundColor: "rgba(99, 102, 241, 0.2)",
                        tension: 0.4,
                        fill: true,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 20,
                        },
                    },
                },
            },
        });
    },
};
