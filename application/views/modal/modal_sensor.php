<div class="modal fade" id="modalSensor" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSensorTitle">Sensor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="sensor1Area" class="ws-sens-area-modal"></div>
                <div id="sensor2Area" class="ws-sens-area-modal"></div>
                <div id="sensor3Area" class="ws-sens-area-modal"></div>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    $('.ws-sens-kecp').click(function() {
        var no = $(this).data('no');
        $('#noSensor').val(no);

        $('#modalSensor').modal('show');
        $('#modalSensorTitle').html('Sensor ' + no);

        $('.ws-sens-area-modal').hide();

        if (no == 1) {
            $('#sensor1Area').show();
        } else if (no == 2) {
            $('#sensor2Area').show();
        } else if (no == 3) {
            $('#sensor3Area').show();
        }
    });
});
</script>
