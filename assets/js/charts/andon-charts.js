var ctx = document.getElementById('myBarChart').getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['','', ''],
        datasets: [{
            label: 'Andon event',
            backgroundColor: primaryColor,
            borderColor: primaryColor,
            borderRadius: 4,
            maxBarThickness: 250,
            data: [3, 4, 5, 6, 7, 8],
        }],
    },
    options: {
        indexAxis: 'x',
        scales: {
            x: {
                time: {
                    // unit: 'month'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 1
                },
            },
            y: {
                ticks: {
                    min: 0,
                    max: 1,
                    maxTicksLimit: 30
                },
                gridLines: {
                    color: 'rgba(0, 0, 0, .075)',
                },
            },
        },
        plugins: {
            legend: {
                display: false
            },
        },
    }
});
