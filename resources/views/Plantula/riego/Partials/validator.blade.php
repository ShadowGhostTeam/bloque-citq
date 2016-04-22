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
                            message: 'El número tiene que ser mayor a cero'
                        },
                        integer:{
                            message: 'Ingrese número entero'
                        },
                        stringLength: {
                            max: 3,
                            message: 'Ingrese número entre 0-999'
                        },
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
                            message: 'El número tiene que ser mayor a cero'
                        },
                        integer:{
                            message: 'Ingrese número entero'
                        },
                        stringLength: {
                            max: 3,
                            message: 'Ingrese número entre 0-999'
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
                formulacion:{
                    validators: {
                        stringLength: {
                            max: 255,
                            message: 'Exceso de texto'
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