<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

<!-- Validation errors -->
<div id="hisErrorMsg" class="alert alert-danger collapse" role="alert"></div>

<!-- Form -->
<?php echo form_open(); ?>

<div class="form-group row">
    <div class="col-md-4">
        <label for="sensNo">Sensor</label>
        <select class="form-control" id="sensNo">
            <option value="1">Sensor 1</option>
            <option value="2">Sensor 2</option>
            <option value="3">Sensor 3</option>
        </select>
    </div>

    <div class="col-md-4">
        <label for="tglAwal">Tanggal Awal</label>
        <input type="date" class="form-control" id="tglAwal" name="tgl_awal"
        value="<?php echo set_value('tgl_awal') ?>">
    </div>

    <div class="col-md-4">
        <label for="tglAkhir">Tanggal Akhir</label>
        <input type="date" class="form-control" id="tglAkhir" name="tgl_akhir"
        value="<?php echo set_value('tgl_akhir') ?>">
    </div>
</div>

<button id="hisBtnSubmit" class="btn btn-primary mb-3">Tampilkan</button>

<?php echo form_close(); ?>

<div id="hisArea" class=""></div>
<p id="exeTime"></p>
<p id="dataDisplayed"></p>
<script>
var chart;

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
    chart.container("hisArea");

    // initiate drawing the chart
    chart.draw();
}

$(function(){

    function exeTime(t2) {
        document.getElementById("exeTime").innerHTML = 'Untuk menampilkan grafik dibutuhkan '+ t2 + ' milidetik ';
    }

    function dataDisplayed(rowCount){
      document.getElementById("dataDisplayed").innerHTML = 'Data yang ditampilkan '+ rowCount + ' baris ';
    }

    $('#hisBtnSubmit').click(function(event) {
        var t0 = performance.now();
        event.preventDefault();
        var number = $('#sensNo').val();
        var startDate = $('#tglAwal').val();
        var endDate = $('#tglAkhir').val();

        if (startDate == '' || endDate == '') {
            $('#hisErrorMsg').show();
            $('#hisErrorMsg').html('Semua field harus diisi');
        }
        else if (startDate > endDate) {
            $('#hisErrorMsg').show();
            $('#hisErrorMsg').html('Tangal Awal harus lebih kecil dari Tanggal Akhir');
        }
        else {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url('api/sensor_get_range/2/') ?>' + startDate + '/' + endDate,
                cache: false,
                success: function(result) {
                    $('#hisErrorMsg').hide();
                    $('#hisArea').html('');
                    // createChart(result, number);
                    createChartX(result, number);
                    var t1 = performance.now();
                    var t2 = t1 - t0;
                    console.log(t2);
                    exeTime(t2);
                    var rowCount = Math.floor(JSON.parse(result).length / 3);
                    dataDisplayed(rowCount)
                }
            });
        }
    });


})

</script>
