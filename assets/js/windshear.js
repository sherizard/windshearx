var gauge1;
var gauge2;
var gauge3;
var gaugeRes12;
var gaugeRes13;
var alertAudio;
var circleRedAppear = false;
var statusRed = false;
var blinking = false;
var blinkInterval;

// create URL
function baseUrl(url) {
    return 'http://localhost/windshearx/' + url;
}

// get latest sensor data
// function querySensor() {
//     $.ajax({
//         url: baseUrl('api/sensor_get_last'),
//         success: function(result) {
//             result = JSON.parse(result);
//             updateGauge(result);
//             updateSensor(result);
//             calculateShear(result);
//         },
//         complete: function() {
//             setTimeout(querySensor, 5000);
//         }
//     });
// }

function querySensorX() {
    $.ajax({
        url: baseUrl('api/sensor_get_last_three'),
        success: function(result) {
            result = JSON.parse(result);
            updateGaugeX(result);
            updateSensorX(result);
            calculateShearX(result);
        },
        complete: function() {
            setTimeout(querySensorX, 6000);
        }
    });
}

function addData() {
    $.ajax({
        url: baseUrl('api/sensor_add_random'),
        // success: function() {
        //
        // },
        complete: function() {
            setTimeout(addData, 5000);
        }
    });
}

function changeGaugeColor(gauge, color) {
  gauge.fill(color)
  .stroke(null)
  .padding(15)
  .margin(0)
  .startAngle(0)
  .sweepAngle(360);

}


// create a wind gauge
function createGauge(title, direction, velocity) {
    var gauge = anychart.gauges.circular();

    gauge.data([direction, velocity]);

    gauge.fill('#EAFCFF')
    .stroke(null)
    .padding(15)
    .margin(0)
    .startAngle(0)
    .sweepAngle(360);

    gauge.axis().labels()
    .padding(7)
    .position('outside')
    .format('{%Value}\u00B0')
    .fontSize(11)
    .fontColor('#fff');

    gauge.axis().scale()
    .minimum(0)
    .maximum(360)
    .ticks({interval: 30})
    .minorTicks({interval: 10});

    gauge.axis()
    .fill('#7c868e')
    .startAngle(0)
    .sweepAngle(360)
    .width(1)
    .ticks({
        type: 'line',
        fill: '#7c868e',
        length: 4,
        position: 'outside'
    });

    gauge.axis(1)
    .fill('#7c868e')
    .startAngle(270)
    .radius(40)
    .sweepAngle(180)
    .width(1)
    .ticks({
        type: 'line',
        fill: '#7c868e',
        length: 4,
        position: 'outside'
    });

    gauge.axis(1).labels()
    .padding(3)
    .position('outside')
    .format('{%Value}')
    .fontSize(10);

    gauge.axis(1).scale()
    .minimum(0)
    .maximum(100)
    .ticks({interval: 5})
    .minorTicks({interval: 1});

    gauge.title()
    .padding(0)
    .margin([0, 0, 10, 0]);

    gauge.marker()
    .fill('#f63262')
    .stroke(null)
    .size('12%')
    .zIndex(120)
    .radius('97%');

    gauge.needle()
      .fill('#1976d2')
    .stroke(null)
    .axisIndex(1)
    .startRadius('6%')
    .endRadius('38%')
    .startWidth('2%')
    .middleWidth(null)
    .endWidth('0');

    gauge.cap()
    .radius('4%')
    .fill('#1976d2')
    .enabled(true)
    .stroke(null);

    updateGaugeDesc(gauge, title);

    gauge.background().fill("#fff", 0);

    return gauge;
}

// update all gauges display
function updateGauge(data) {
    if (data == null) return;

    gauge1.data([data.arah_1, data.kecepatan_1]);
    updateGaugeDesc(gauge1, '[Sensor 1]', ' m/s');

    gauge2.data([data.arah_2, data.kecepatan_2]);
    updateGaugeDesc(gauge2, '[Sensor 2]', ' m/s');

    gauge3.data([data.arah_3, data.kecepatan_3]);
    updateGaugeDesc(gauge3, '[Sensor 3]', ' m/s');
}

function updateGaugeX(sensors) {
    if (sensors == null) return;

    for (var sensor of sensors) {
        if (sensor.sensor == '1') {
            gauge1.data([sensor.arah, sensor.kecepatan]);
            updateGaugeDesc(gauge1, '[Sensor 1]', ' m/s');
        }

        if (sensor.sensor == '2') {
            gauge2.data([sensor.arah, sensor.kecepatan]);
            updateGaugeDesc(gauge2, '[Sensor 2]', ' m/s');
        }

        if (sensor.sensor == '3') {
            gauge3.data([sensor.arah, sensor.kecepatan]);
            updateGaugeDesc(gauge3, '[Sensor 3]', ' m/s');
        }
    }
}

function getDirection(angle) {
    var directions = ['North', 'North-East', 'East', 'South-East', 'South', 'South-West', 'West', 'North-West'];
    return directions[Math.round(((angle %= 360) < 0 ? angle + 360 : angle) / 45) % 8];
}

// function updateSensor(data) {
//     if (data == null) return;
//
//     $('#sens1Kecp').html('Kecepatan: ' + data.kecepatan_1 + ' m/s');
//     $('#sens1Arah').html('Arah: ' + data.arah_1 + '&#x00B0;' +'/' + getDirection(data.arah_1));
//     $('#sens2Kecp').html('Kecepatan: ' + data.kecepatan_2 + ' m/s');
//     $('#sens2Arah').html('Arah: ' + data.arah_2 + '&#x00B0;' +'/'+ getDirection(data.arah_2));
//     $('#sens3Kecp').html('Kecepatan: ' + data.kecepatan_3 + ' m/s');
//     $('#sens3Arah').html('Arah: ' + data.arah_3 + '&#x00B0;' +'/'+ getDirection(data.arah_3));
// }

function updateSensorX(sensors) {
    if (sensors == null) return;

    for (var sensor of sensors) {
        if (sensor.sensor == '1') {
            $('#sens1Kecp').html('Kecepatan: ' + sensor.kecepatan + ' m/s');
            $('#sens1Arah').html('Arah: ' + sensor.arah + '&#x00B0;' +'/' + getDirection(sensor.arah));
        }

        if (sensor.sensor == '2') {
            $('#sens2Kecp').html('Kecepatan: ' + sensor.kecepatan + ' m/s');
            $('#sens2Arah').html('Arah: ' + sensor.arah + '&#x00B0;' +'/' + getDirection(sensor.arah));
        }

        if (sensor.sensor == '3') {
            $('#sens3Kecp').html('Kecepatan: ' + sensor.kecepatan + ' m/s');
            $('#sens3Arah').html('Arah: ' + sensor.arah + '&#x00B0;' +'/' + getDirection(sensor.arah));
        }
    }
}

// update gauge description of direction and velocity
function updateGaugeDesc(gauge, title, unit) {
    var bigTooltipTitleSettings = {
        fontFamily: "'Verdana', Helvetica, Arial, sans-serif",
        fontWeight: 'normal',
        fontSize: '12px',
        hAlign: 'left',
        fontColor: '#212121'
    };

    gauge.label()
    .text('<span style="color: #000; font-size: 14px;  font-weight:bold">' + title + '</span><br>' +
    '<span style="color: #166ABD; font-size: 12px">Kec.:</span> ' +
    '<span style="color: #166ABD; font-size: 12px">' + gauge.data().row(1) + unit + '</span><br>' +
    '<span style="color: #166ABD; font-size: 12px">Arah: </span>' +
    '<span style="color: #166ABD; font-size: 12px">' + gauge.data().row(0) + '\u00B0' + '</span><br>').useHtml(true)
    .textSettings(bigTooltipTitleSettings);

    gauge.label()
    .hAlign('center')
    .anchor('center-top')
    .offsetY(-10)
    .padding(5, 5)
    .background({
        fill: '#F9F871 0',
        stroke: {
            thickness: 0,
            color: '#7c868e'
        }
    });
}

// convert degree to radian
function degToRad(deg) {
    return deg * Math.PI / 180;
}

// convert radian to degree
function radToDeg(rad) {
    return rad * 180 / Math.PI;
}

// calculate wind shear
function calculateShear(data) {
    if (data == null) return;

    var velo1X = data.kecepatan_1 * Math.sin(degToRad(data.arah_1));
    var velo1Y = data.kecepatan_1 * Math.cos(degToRad(data.arah_1));
    var velo2X = data.kecepatan_2 * Math.sin(degToRad(data.arah_2));
    var velo2Y = data.kecepatan_2 * Math.cos(degToRad(data.arah_2));
    var velo3X = data.kecepatan_3 * Math.sin(degToRad(data.arah_3));
    var velo3Y = data.kecepatan_3 * Math.cos(degToRad(data.arah_3));

    var velo12 = Math.sqrt(Math.pow(velo2Y - velo1Y, 2) + Math.pow(velo2X - velo1X, 2));
    var velo13 = Math.sqrt(Math.pow(velo3Y - velo1Y, 2) + Math.pow(velo3X - velo1X, 2));

    velo12 = velo12.toFixed(1);
    velo13 = velo13.toFixed(1);

    var dire12 = radToDeg(Math.atan((velo2Y - velo1Y) / (velo2X - velo1X)));
    var dire13 = radToDeg(Math.atan((velo3Y - velo1Y) / (velo3X - velo1X)));

    if (dire12 < 0) {
        dire12 += 180;
    }

    if (dire13 < 0) {
        dire13 += 180;
    }

    dire12 = dire12.toFixed(1);
    dire13 = dire13.toFixed(1);

    gaugeRes12.data([dire12, velo12]);
    updateGaugeDesc(gaugeRes12, '[Resultan 1 2]','kt');

    gaugeRes13.data([dire13, velo13]);
    updateGaugeDesc(gaugeRes13, '[Resultan 1 3]','kt');

    updateInfo(velo12, velo13, dire12, dire13);
}

function calculateShearX(sensors) {
    if (sensors == null) return;

    var velo1;
    var velo2;
    var velo3;
    var dire1;
    var dire2;
    var dire3;

    for (var sensor of sensors) {
        if (sensor.sensor == '1') {
            velo1 = sensor.kecepatan;
            dire1 = sensor.arah;
        }

        if (sensor.sensor == '2') {
            velo2 = sensor.kecepatan;
            dire2 = sensor.arah;
        }

        if (sensor.sensor == '3') {
            velo3 = sensor.kecepatan;
            dire3 = sensor.arah;
        }
    }

    var velo1X = velo1 * Math.sin(degToRad(dire1));
    var velo1Y = velo1 * Math.cos(degToRad(dire1));
    var velo2X = velo2 * Math.sin(degToRad(dire2));
    var velo2Y = velo2 * Math.cos(degToRad(dire2));
    var velo3X = velo3 * Math.sin(degToRad(dire3));
    var velo3Y = velo3 * Math.cos(degToRad(dire3));

    var velo12 = Math.sqrt(Math.pow(velo2Y - velo1Y, 2) + Math.pow(velo2X - velo1X, 2));
    var velo13 = Math.sqrt(Math.pow(velo3Y - velo1Y, 2) + Math.pow(velo3X - velo1X, 2));

    velo12 = velo12.toFixed(1);
    velo13 = velo13.toFixed(1);

    var dire12 = radToDeg(Math.atan((velo2Y - velo1Y) / (velo2X - velo1X)));
    var dire13 = radToDeg(Math.atan((velo3Y - velo1Y) / (velo3X - velo1X)));

    if (dire12 < 0) {
        dire12 += 180;
    }

    if (dire13 < 0) {
        dire13 += 180;
    }

    dire12 = dire12.toFixed(1);
    dire13 = dire13.toFixed(1);

    gaugeRes12.data([dire12, velo12]);
    updateGaugeDesc(gaugeRes12, '[Resultan 1 2]','kt');

    gaugeRes13.data([dire13, velo13]);
    updateGaugeDesc(gaugeRes13, '[Resultan 1 3]','kt');

    updateInfo(velo12, velo13, dire12, dire13);
}

// update wind status
function updateInfo(velo12, velo13, dire12, dire13) {
    $('#statInfo12').html(
        'Resultan 1 2 <br>' + velo12 + ' knot | ' + dire12 + '&#x00B0;'
    );

    $('#statInfo13').html(
        'Resultan 1 3 <br>' + velo13 + ' knot | ' + dire13 + '&#x00B0;'
    );

    if (velo12 > batas || velo13 > batas) {
        $('#statMarkText').html('BAHAYA');
        $('#statMark').removeClass('bg-success');
        $('#statMark').addClass('bg-danger');

        $('#statCircle').attr('src', baseUrl('assets/img/status_circle_red_min.png'));

        if (velo12 > batas) {
            $('#statInfo12').addClass('info-red');
            $('#res12').addClass('gauge-red');
        } else {
            $('#statInfo12').removeClass('info-red');
            $('#res12').removeClass('gauge-red');
            $('#statInfo12').removeClass('bg-danger');
            $('#statInfo12').removeClass('text-white');
            changeGaugeColor(gaugeRes12, '#EAFCFF');

        }

        if (velo13 > batas) {
            $('#statInfo13').addClass('info-red');
            $('#res13').addClass('gauge-red');
        } else {
            $('#statInfo13').removeClass('info-red');
            $('#res13').removeClass('gauge-red');
            $('#statInfo13').removeClass('bg-danger');
            $('#statInfo13').removeClass('text-white');
            changeGaugeColor(gaugeRes13, '#EAFCFF');
        }


        statusRed = true;
        circleRedAppear = true;
    } else {
        $('#statMarkText').html('NORMAL');
        $('#statMark').removeClass('bg-danger');
        $('#statMark').addClass('bg-success');

        $('.ws-stat-info').removeClass('info-red');
        $('#res12').removeClass('gauge-red');
        $('#res13').removeClass('gauge-red');
        $('.ws-stat-info').removeClass('bg-danger');
        $('.ws-stat-info').removeClass('text-white');
        $('#statCircle').attr('src', baseUrl('assets/img/status_circle_green_min.png'));
        changeGaugeColor(gaugeRes12, '#EAFCFF');
        changeGaugeColor(gaugeRes13, '#EAFCFF');

        statusRed = false;
        circleRedAppear = false;
        blinking = false;

        clearInterval(blinkInterval);
    }
}

// blink red circle and info beyond limit
function blinkCircleAndInfo() {
    if (circleRedAppear) {
        $('#statCircle').attr('src', baseUrl('assets/img/status_circle_transparent.png'));
        $('.info-red').removeClass('bg-danger');
        $('.info-red').removeClass('text-white');

        if ($('#res12').hasClass('gauge-red')) {
          changeGaugeColor(gaugeRes12, '#EAFCFF');
        }

        if ($('#res13').hasClass('gauge-red')) {
          changeGaugeColor(gaugeRes13, '#EAFCFF');
        }
    } else {
        $('#statCircle').attr('src', baseUrl('assets/img/status_circle_red_min.png'));
        $('.info-red').addClass('bg-danger');
        $('.info-red').addClass('text-white');

        if ($('#res12').hasClass('gauge-red')) {
          changeGaugeColor(gaugeRes12, '#f76573');
        }

        if ($('#res13').hasClass('gauge-red')) {
          changeGaugeColor(gaugeRes13, '#f76573');
        }
    }

    circleRedAppear = !circleRedAppear;
}

// play siren audio if paused
function playSirenAudio() {
    if (sirenAudio.paused) {
        sirenAudio.play().catch(function() {
            console.log('cannot play audio');
        });
    }
}

// stop siren audio
function stopSirenAudio() {
    if (!sirenAudio.paused) {
        sirenAudio.pause();
    }

    sirenAudio.currentTime = 0;
}


$(function() {
    // loop alert audio
    sirenAudio = $('#sirenAudio').get(0);
    sirenAudio.onended = function() {
        this.play();
    }

    gauge1 = createGauge('[Sensor ]', 0, 0);
    gauge2 = createGauge('[Sensor 2]', 0, 0);
    gauge3 = createGauge('[Sensor 3]', 0, 0);
    gaugeRes12 = createGauge('[Resultan 1 2]', 0, 0);
    gaugeRes13 = createGauge('[Resultan 1 3]', 0, 0);

    gauge1.container('sensor1Area');
    gauge2.container('sensor2Area');
    gauge3.container('sensor3Area');
    gaugeRes12.container('res12');
    gaugeRes13.container('res13');

    gauge1.draw();
    gauge2.draw();
    gauge3.draw();
    gaugeRes12.draw();
    gaugeRes13.draw();

    // query sensor periodically
    // querySensor();
    querySensorX();
    // addData();

    // check status periodically
    setInterval(function() {
        if (statusRed) {
            if (!blinking) {
                blinking = true;
                blinkInterval = setInterval(blinkCircleAndInfo, 500);
            }

            playSirenAudio();
        } else {
            stopSirenAudio();
        }
    }, 100);

    // just for simulation
    $('#btnSensRandom').click(function() {
        $.ajax({
            url: baseUrl('api/sensor_add_random')
        });
    });
});
