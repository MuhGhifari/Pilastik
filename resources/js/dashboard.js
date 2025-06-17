import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
	// Donut Chart
	const donutCtx = document.getElementById('donutChart');
	if (donutCtx) {
		new Chart(donutCtx, {
			type: 'doughnut',
			data: {
				labels: ['Organik', 'Anorganik'],
				datasets: [{
					data: [300, 200],
					backgroundColor: ['#AABA95', '#E6B759'],
				}]
			}
		});
	}

	// Weekly Bar Chart
	const weeklyCtx = document.getElementById('weeklyChart');
	if (weeklyCtx) {
		new Chart(weeklyCtx, {
			type: 'bar',
			data: {
				labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
				datasets: [{
					label: 'Berat Sampah (Kg)',
					data: [10, 15, 20, 18, 25, 22, 12],
					backgroundColor: '#6F8650'
				}]
			},
			options: {
				responsive: true,
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	}
});

window.addEventListener('resize', () => {
	if (Chart.instances) {
		Object.values(Chart.instances).forEach(chart => {
			if (chart && typeof chart.resize === 'function') {
				chart.resize();
			}
		});
	}
});