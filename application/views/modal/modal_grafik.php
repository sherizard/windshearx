<div class="modal fade" id="modalGrafik" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalGrafikTitle">Grafik</h5>
                <input type="hidden" id="noSensor">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="grafikArea" class=""></div>
                <div id="exeTime"></div>
                <div id="dataDisplayed"></div>
            </div>
        </div>
    </div>
</div>

<script>
var chart;
function getDirection(angle) {
    var directions = ['North', 'North-East', 'East', 'South-East', 'South', 'South-West', 'West', 'North-West'];
    return directions[Math.round(((angle %= 360) < 0 ? angle + 360 : angle) / 45) % 8];
}



function createChartX(resultJSON, number) {
    // create data
    var data = [];

    var parsed = JSON.parse(resultJSON);

    for (var i = 0; i < parsed.length; i++) {
        if (number == parsed[i].sensor) {
            data.push({
                time: parsed[i].timestamp,
                velo: parsed[i].kecepatan,
                dire: parsed[i].arah
            });
        }
    }

    // create a data set
    var dataSet = anychart.data.set(data);

    // map the data
    var mapping1 = dataSet.mapAs({x: 'time', value: 'velo'});
    var mapping2 = dataSet.mapAs({x: 'time', value: 'dire'});

    // create a chart
    chart = anychart.line();

    // create a spline series and set the data
    var series1 = chart.spline(mapping1);
    series1.name('Kecepatan');
    var series2 = chart.spline(mapping2);
    series2.name('Arah');
    series2.zIndex(-1);
    chart.tooltip().valuePostfix(" m/s");
    series2.tooltip().valuePostfix("°");

    // set the titles of the axes
    var xAxis = chart.xAxis();
    xAxis.labels().enabled(false);
    xAxis.title("Timestamp");
    var yAxis = chart.yAxis();
    yAxis.title("Kecepatan, m/s");
    chart.yScale().maximum(45);

    // set the container id
    chart.container("grafikArea");

    // initiate drawing the chart
    chart.draw();
}

function exeTime(t2) {
  document.getElementById("exeTime").innerHTML = 'Untuk menampilkan grafik dibutuhkan '+ t2 + ' miliseconds ';
}

function dataDisplayed(rowCount){
  document.getElementById("dataDisplayed").innerHTML = 'Data yang ditampilkan '+ rowCount + ' baris ';
}

$(function() {

    $('.ws-sens-arah').click(function() {
        var no = $(this).data('no');
        $('#noSensor').val(no);

        $('#modalGrafik').modal('show');
        $('#modalGrafikTitle').html('Grafik Sensor ' + no);
        $('#grafikArea').html('');

        var t0 = performance.now();
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('api/sensor_get_today') ?>',
            cache: false,
            success: function(result) {
                var number = $('#noSensor').val();
                $('#grafikArea').html('');
                createChartX(result, number);
                var t1 = performance.now();
                var t2 = t1-t0
                exeTime(t2)
                var rowCount = Math.floor(JSON.parse(result).length / 3);
                dataDisplayed(rowCount)
            }
        });
    });
})
</script>
