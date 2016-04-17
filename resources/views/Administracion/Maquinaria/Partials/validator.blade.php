<script type="text/javascript">

    $(document).ready(function() {

        $('#formulario').bootstrapValidator({
            message: 'Los valores no son válidos',
            feedbackIcons: {
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombre: {
                    validators: {
                        stringLength: {
                            max: 255,
                            message: 'El nombre tener como máximo 255 caracteres'
                        },

                        notEmpty: {
                            message: 'Ingrese nombre'
                        }
                    }
                },


            }
        });

    });
</script>

