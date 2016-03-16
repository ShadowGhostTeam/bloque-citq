<script type="text/javascript">
    $(document).ready(function() {
        if ($('input[name="status"]:checked').val() == "Terminado") {
            $('#Terminacion').show();
        }
        $('input[type="radio"]').click(function() {
            if ($('input[name="status"]:checked').val() == "Terminado") {
                $('#Terminacion').show(500);
            }
            else {
                $('#Terminacion').hide(500);
                $('#fechaTerminacion').val("");
            }
        });

    });
</script>

