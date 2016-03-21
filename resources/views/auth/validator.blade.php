<script type="text/javascript">

    $(document).ready(function() {

        $('#formulario').bootstrapValidator({
            message: 'Los valores no son válidos',
            feedbackIcons: {
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                contrasenaActual:{
                    validators: {
                        notEmpty: {
                            message: 'El campo es requerido'
                        },
                        stringLength: {
                            min: 6,
                            message: 'La contraseña debe tener al menos 6 carácteres'
                        }
                    }
                },


                contrasena:{
                    validators: {
                        notEmpty: {
                            message: 'El campo es requerido'
                        },
                        stringLength: {
                            min: 6,
                            message: 'La contraseña debe tener al menos 6 carácteres'
                        }
                    }
                },

                contrasena_confirmation:{
                    validators: {
                        notEmpty: {
                            message: 'El campo es requerido'
                        },
                        stringLength: {
                            min: 6,
                            message: 'La contraseña debe tener al menos 6 carácteres'
                        }
                    }
                }
            }
        });
    });
</script>
