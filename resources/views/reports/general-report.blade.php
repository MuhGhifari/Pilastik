<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div>
    <h2>Statistik Sampah</h2>
    <p>Total Organik: {{ $totalOrganic }} kg</p>
    <p>Total Anorganik: {{ $totalInorganic }} kg</p>
    <p>Total Tempat Sampah: {{ $totalTrashBins }}</p>
    <p>Sudah Diambil: {{ $totalCollectedBins }}</p>
    <p>Progress Pengambilan: {{ $progressPercentage }}%</p>
  </div>
  <div style="display: flex; gap: 2rem;">
    <div style="flex:1;">
      <h3>Donut Chart</h3>
      <canvas id="donutChart" class="flex w-full h-full"></canvas>
    </div>
    <div style="flex:2;">
      <h3>Grafik Mingguan</h3>
      <canvas id="weeklyChart" class="flex w-full h-full"></canvas>
      <table border="1" cellpadding="4" cellspacing="0" style="margin-top:1rem; width:100%;">
        <thead>
          <tr>
            <th>Hari</th>
            <th>Organik (kg)</th>
            <th>Anorganik (kg)</th>
          </tr>
        </thead>
        <tbody>
          @php
            $daysIndo = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
          @endphp
          @foreach($daysIndo as $day)
            <tr>
              <td>{{ $day }}</td>
              <td>{{ $weeklyWaste['organic'][$day] ?? 0 }}</td>
              <td>{{ $weeklyWaste['inorganic'][$day] ?? 0 }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
			// Donut Chart
			const donutCtx = document.getElementById('donutChart');
			if (donutCtx) {
        new Chart(donutCtx, {
          type: 'doughnut',
					data: {
            labels: ['Organik', 'Anorganik'],
						datasets: [{
							data: [{{ $totalOrganic }}, {{ $totalInorganic }}],
							backgroundColor: ['#AABA95', '#E6B759'],
						}]
					}
				});
			}
      
			// Weekly Bar Chart
			const weeklyCtx = document.getElementById('weeklyChart');
			const weeklyWaste = @json($weeklyWaste); // expects: { labels: [...], organik: [...], anorganik: [...] }
			if (weeklyCtx && weeklyWaste) {
        new Chart(weeklyCtx, {
          type: 'bar',
					data: {
            labels: weeklyWaste.labels,
						datasets: [
              {
                label: 'Organik',
								data: weeklyWaste.organic,
								backgroundColor: '#AABA95'
							},
							{
                label: 'Anorganik',
								data: weeklyWaste.inorganic,
								backgroundColor: '#E6B759'
							}
						]
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
  </script>
</body>
</html>