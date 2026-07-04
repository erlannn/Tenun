import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const dashboardChart = document.getElementById('dashboardChart');
    const catalogImageModal = document.getElementById('catalogImageModal');
    const catalogImageModalImg = document.getElementById('catalogImageModalImg');
    const catalogImageModalClose = document.getElementById('catalogImageModalClose');

    if (dashboardChart && typeof Chart !== 'undefined') {
        const ctx = dashboardChart.getContext('2d');
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
    }

    if (catalogImageModal && catalogImageModalImg && catalogImageModalClose) {
        const imageTriggers = document.querySelectorAll('.catalog-image-trigger');

        const closeCatalogImageModal = () => {
            catalogImageModal.classList.add('hidden');
            catalogImageModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        };

        imageTriggers.forEach((trigger) => {
            trigger.addEventListener('click', () => {
                catalogImageModalImg.src = trigger.dataset.imageSrc;
                catalogImageModal.classList.remove('hidden');
                catalogImageModal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            });
        });

        catalogImageModalClose.addEventListener('click', closeCatalogImageModal);
        catalogImageModal.addEventListener('click', (event) => {
            if (event.target === catalogImageModal) {
                closeCatalogImageModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeCatalogImageModal();
            }
        });
    }
});

