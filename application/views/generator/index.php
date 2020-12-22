<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Windshear Data Generator</title>

    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
</head>
<body>

<div class="result"></div>

<script>
var sensorNumber = 1;

function baseUrl(url) {
    return 'http://localhost/windshearx/' + url;
}

function generateData() {
    $.ajax({
        url: baseUrl('api/sensor_add_random_x/' + sensorNumber),
        success: function(result) {
            result = JSON.parse(result)
            $('.result').append('<p>Sensor ' + result.sensor + ': ' + result.arah + ' ' + result.kecepatan + '</p>')
        },
        complete: function(result) {
            sensorNumber = sensorNumber % 3 + 1;
            setTimeout(generateData, 2000);
        }
    });
}

$(function () {
    generateData();
});
</script>

</body>
</html>
