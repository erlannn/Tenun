import './bootstrap';
import Chart from 'chart.js/auto';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.Chart = Chart;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const toastElements = document.querySelectorAll('[data-toast]');
    const dashboardChart = document.getElementById('dashboardChart');
    const catalogImageModal = document.getElementById('catalogImageModal');
    const catalogImageModalImg = document.getElementById('catalogImageModalImg');
    const catalogImageModalClose = document.getElementById('catalogImageModalClose');

    toastElements.forEach((toast) => {
        const closeButton = toast.querySelector('[data-toast-close]');
        const duration = Number(toast.dataset.duration || 2000);

        const dismissToast = () => {
            toast.classList.add('opacity-0', 'translate-x-4', 'scale-95');
            toast.classList.remove('opacity-100', 'translate-x-0', 'scale-100');

            window.setTimeout(() => {
                toast.remove();
            }, 250);
        };

        window.requestAnimationFrame(() => {
            toast.classList.remove('opacity-0', 'translate-x-4', 'scale-95');
            toast.classList.add('opacity-100', 'translate-x-0', 'scale-100');
        });

        const autoDismissTimer = window.setTimeout(dismissToast, duration);

        if (closeButton) {
            closeButton.addEventListener('click', () => {
                window.clearTimeout(autoDismissTimer);
                dismissToast();
            });
        }
    });

    if (dashboardChart && typeof Chart !== 'undefined') {
        const chartData = dashboardChart.dataset.chart ? JSON.parse(dashboardChart.dataset.chart) : null;

        if (!chartData) {
            return;
        }

        const ctx = dashboardChart.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
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

