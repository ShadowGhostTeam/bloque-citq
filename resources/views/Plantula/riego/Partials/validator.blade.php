<script type="text/javascript">

    $(document).ready(function() {

        $('#formulario').bootstrapValidator({
            message: 'Los valores no son válidos',
            feedbackIcons: {
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                invernadero:{
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una opción'
                        }
                    }
                },


                siembraPlantula:{
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una opción'
                        }
                    }
                },

                tiempoRiego:{
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un valor'
                        },
                        numeric: {
                            message: 'No es un número válido'
                        },
                        greaterThan: {
                            value: 0,
                            message: 'El número tiene que ser positivo'
                        }
                    }
                },

                frecuencia:{
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un valor'
                        },
                        numeric: {
                            message: 'No es un número válido'
                        },
                        greaterThan: {
                            value: 0,
                            message: 'El número tiene que ser positivo'
                        }
                    }
                },

                fecha:{
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una opción'
                        },

                        date: {
                            format: 'DD/MM/YYYY',
                            message: 'Ingrese fecha en formato dd/mm/aaaa'
                        }
                    }
                },



            }
        });

        $('#fecha')
                .on('dp.change dp.show', function(e) {
                    $('#formulario').data('bootstrapValidator').revalidateField('fecha');
                });




    });
</script>

<script type="text/javascript">
    $(function () {
        $('#fecha').datetimepicker({
            format:'DD/MM/YYYY'

        });

    });

    $('#fecha').keypress(function(event) {event.preventDefault();});



</script>