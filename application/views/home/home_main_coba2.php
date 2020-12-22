<h1 id="coba1" class="text-danger">Coba</h1>
<h2 id="coba2" class="text-danger">Coba</h2>

<button id="btnOver" class="btn btn-primary">Toggle Over</button>

<script>
var textOverOn = false;

$(function() {
    var flag = false;

    setInterval(function() {
        if (flag) {
            $('.text-over').addClass('text-danger');
        } else {
            $('.text-over').removeClass('text-danger');
        }
        flag = !flag;
    }, 1000);

    $('#btnOver').click(function() {
        if (textOverOn) {
            $('#coba2').removeClass('text-over');
        } else {
            $('#coba2').addClass('text-over');
        }
        textOverOn = !textOverOn;
    });
});
</script>
