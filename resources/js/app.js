import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['28 Apr', '5 Mei', '12 Mei', '19 Mei', '126 Mei'],
            datasets: [
                {
                    label: 'Preorder',
                    data: [7, 14, 4, 7, 14, 3, 6],
                    borderColor: '#004D39',
                    backgroundColor: 'transparent',
                    borderWidth: 1.5,
                    pointBackgroundColor: '#004D39',
                    pointRadius: 3,
                    tension: 0
                },
                {
                    label: 'Penjualan Bahan',
                    data: [12, 12, 5, 11, 15, 5, 8],
                    borderColor: '#D4AF37',
                    backgroundColor: 'transparent',
                    borderWidth: 1.5,
                    pointBackgroundColor: '#D4AF37',
                    pointRadius: 3,
                    tension: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { min: 0, max: 20, ticks: { stepSize: 5 } }
            },
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 6 } } }
        }
    });
});