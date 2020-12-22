<div class="dash-container">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card h-10 ws-card">
                    <div id="statHead" class="card-header text-center text-white ws-card-head">
                        <h5 class="card-title m-0">STATUS</h5>
                    </div>

                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <img id="statCircle" class="w-50"
                            src="<?php echo base_url('assets/img/status_circle_green_min.png') ?>"
                            alt="Status">
                        </div>
                        <div class="text-center">
                            <hr>
                            <h4 id="btnSensRandom" style="cursor:pointer">Resultan </h4>
                            <hr>
                            <p id="statInfo12" class="ws-stat-info"></p>
                            <p id="statInfo13" class="ws-stat-info"></p>

                            <!-- <button id="btnSensRandom" class="btn btn-sm btn-primary">Add Random</button> -->
                        </div>
                    </div>
                    <div id="statMark" class="card-footer text-center bg-success text-white ws-card-foot">
                        <h5 id="statMarkText" class="card-title m-0">NORMAL</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row ws-sens-area">
                    <div id="sens1" class="col-md-6 offset-md-3 p-2 text-center" data-no="1">
                        <h5>Sensor 1</h5>
                        <i class="fas fa-tachometer-alt ws-sens-logo"></i><br>
                        <a id="sens1Kecp" class="ws-sens-kecp text-dark" href="#" data-no="1"></a><br>
                        <a id="sens1Arah" class="ws-sens-arah text-dark" href="#" data-no="1"></a>
                    </div>
                </div>

                <div class="row ws-res-area">
                    <div id="res12" class="col-md-6 pt-0 pb-0 gauge-info"></div>
                    <div id="res13" class="col-md-6 pt-0 pb-0 gauge-info"></div>
                </div>

                <div class="row ws-sens-area">
                    <div id="sens2" class="col-md-6 pt-3 text-center" data-no="2">
                        <h5>Sensor 2</h5>
                        <i class="fas fa-tachometer-alt ws-sens-logo"></i><br>
                        <a id="sens2Kecp" class="ws-sens-kecp text-dark" href="#" data-no="2"></a><br>
                        <a id="sens2Arah" class="ws-sens-arah text-dark" href="#" data-no="2"></a>
                    </div>
                    <div id="sens3" class="col-md-6 pt-3 text-center" data-no="3">
                        <h5>Sensor 3</h5>
                        <i class="fas fa-tachometer-alt ws-sens-logo"></i><br>
                        <a id="sens3Kecp" class="ws-sens-kecp text-dark" href="#" data-no="3"></a><br>
                        <a id="sens3Arah" class="ws-sens-arah text-dark" href="#" data-no="3"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<audio id="sirenAudio">
    <source src="<?php echo base_url('assets/audio/siren.mp3') ?>" type="audio/mpeg">
</audio>

<script>var batas = <?php echo $batas ?></script>

<script src="<?php echo base_url('assets/js/windshear.js') ?>"></script>
