<script type="text/javascript">

    $(document).ready(function() {

        $('#formulario').bootstrapValidator({
            message: 'Los valores no son válidos',
            feedbackIcons: {
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    validators: {
                        stringLength: {
                            max: 255,
                            message: 'El correo debe tener como máximo 255 caracteres'
                        },

                        emailAddress: {
                            message: 'Ingrese un correo válido'
                        },

                        notEmpty: {
                            message: 'Ingrese correo'
                        }
                    }
                },
                password: {
                    validators: {
                        stringLength: {
                            min:6 ,
                            message: 'La contraseña debe tener mínimo 6 caracteres'
                        },

                        notEmpty: {
                           message: 'Ingrese contraseña'
                        }
                    }
                },


                rol:{
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una opción'
                        }
                    }
                }





            }
        });

    });
</script>

