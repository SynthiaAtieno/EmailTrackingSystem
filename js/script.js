
const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'bar',
  data: {
   // labels: <?php echo json_encode($status); ?>,
    datasets: [{
      label: '# of Votes',
     // data: <?php echo json_encode($count);?>,
      backgroundColor: [
          'rgb(0,128,0)',
          'rgba(255,0,0)',
          'rgba(255,255,0)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
