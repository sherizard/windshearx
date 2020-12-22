<div class="modal fade" id="modalGrafik" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalGrafikTitle">Grafiks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="grafikErrorMsg" class="alert alert-danger collapse" role="alert"></div>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggalAwal">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tanggalAwal" name="tanggal_awal">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggalAkhir">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tanggalAkhir" name="tanggal_akhir">
                            <input type="hidden" id="nomorSensor">
                        </div>
                    </div>
                </form>

                <div class="mb-3 text-right">
                    <button id="btnTampilGrafik" class="btn btn-primary">Tampilkan</button>
                </div>

                <div id="areaGrafik" class="" style="height: 200px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
var chart;

function createChart(sensors, number) {
    // create data
    var data = [];

    var parsedSensors = JSON.parse(sensors);

    for (var i = 0; i < parsedSensors.length; i++) {
        if (number == 1) {
            data.push({
                timestamp: parsedSensors[i].timestamp,
                velocity: parsedSensors[i].kecepatan_1,
                direction: parsedSensors[i].arah_1
            });
        } else if (number == 2) {
            data.push({
                timestamp: parsedSensors[i].timestamp,
                velocity: parsedSensors[i].kecepatan_2,
                direction: parsedSensors[i].arah_2
            });
        } else if (number == 3) {
            data.push({
                timestamp: parsedSensors[i].timestamp,
                velocity: parsedSensors[i].kecepatan_3,
                direction: parsedSensors[i].arah_3
            });
        }
    }

    // create a data set
    var dataSet = anychart.data.set(data);

    // map the data
    var mapping1 = dataSet.mapAs({x: 'timestamp', value: 'velocity'});
    var mapping2 = dataSet.mapAs({x: 'timestamp', value: 'direction'});

    // create a chart
    chart = anychart.line();

    // create a spline series and set the data
    var series1 = chart.spline(mapping1);
    series1.name('Kecepatan');
    var series2 = chart.spline(mapping2);
    series2.name('Arah');
    series2.zIndex(-1);

    // set the chart title
    chart.title("");

    // set the titles of the axes
    var xAxis = chart.xAxis();
    xAxis.labels().enabled(false);
    xAxis.title("Timestamp");
    var yAxis = chart.yAxis();
    yAxis.title("Kecepatan, m/s");
    chart.yScale().maximum(45);

    // set the container id
    chart.container("areaGrafik");

    // initiate drawing the chart
    chart.draw();
    // chart.tooltip().valuePostfix(" m/s");
    // series2.tooltip().valuePostfix("°");
}

$(function() {
    $('.ws-sens-arah').click(function() {
        var nomor = $(this).data('nomor');
        $('#nomorSensor').val(nomor);

        $('#modalGrafik').modal('show');
        $('#modalGrafikTitle').html('Grafik Sensor ' + nomor);
        $('#areaGrafik').html('');
    });
    function getDataGrafik(){
      $.ajax({
          type: 'GET',
          url: '<?php echo base_url('api/sensor_get_range/') ?>' + startDate + '/' + endDate,
          cache: false,
          success: function(result) {
              var number = $('#nomorSensor').val();
              $('#grafikErrorMsg').hide();
              $('#areaGrafik').html('');
              createChart(result, number);
          },
          complete: function() {
              setTimeout(getDataGrafik, 1000);}
      });
}
    $('#btnTampilGrafik').click(function() {
        var startDate = $('#tanggalAwal').val();
        var endDate = $('#tanggalAkhir').val();

        if (startDate == '' || endDate == '') {
            $('#grafikErrorMsg').show();
            $('#grafikErrorMsg').html('Semua field harus diisi');
        } else {
            getDataGrafik();
        }

    });

    $('#btnLoginSubmit').click(function() {
        var username = $('#username').val();
        var password = $('#password').val();

        if (username == '' || password == '') {
            $('#errorMsg').show();
            $('#errorMsg').html('Semua field harus diisi');
        } else {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('admin/login') ?>',
                data: {username: username, password: password},
                cache: false,
                success: function(result) {
                    if (result != 0) {
                        location.replace(result);
                    } else {
                        $('#errorMsg').show();
                        $('#errorMsg').html('Login gagal');
                    }
                }
            });
        }
    });
})
</script>
