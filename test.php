<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

<body>
<canvas id="myChart" style="overflow:auto;width:100%;max-width:600px"></canvas>

<script>
$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "fs/2569HMV-SweetHMVShotIt.funscript.csv",
        dataType: "text",
        success: function(data) {processData(data);}
     });
});
var lines = [];
var linesX = [];
var linesY = [];

function processData(allText) {
    var allTextLines = allText.split(/\r\n|\n/);
    var headers = allTextLines[0].split(',');

    for (var i=1; i<allTextLines.length; i++) {
        var data = allTextLines[i].split(',');
        if (data.length == headers.length) {

            var tary = [];
			var tarx = [];

            for (var j=0; j<headers.length; j++) {
				tarx.push(data[j]);
            }
            lines.push(tarx);
        }
    }
	for (var q=0; q<lines.length; q++) {
			linesX.push(lines[q][1]);
            linesY.push(lines[q][0]);

    }
	
}
var xValues = linesY;
var yValues = linesX;

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
	backgroundColor: '#54ACEF',
      data: yValues
    }]
  },
    options: {
		responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: false // Hide legend
        },
        scales: {
			xAxes: [{
        type: 'linear',
      }],
            y: {
                display: false // Hide Y axis labels
            },
            x: {
                display: false // Hide X axis labels
            }
        }   
    }
});
</script>

</body>
</html>