<script type="text/javascript">

    $(document).ready(function() {

        $('#formulario').bootstrapValidator({
            message: 'Los valores no son válidos',
            feedbackIcons: {
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                sector:{
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una opción'
                        }
                    }
                },


                maquinaria:{
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una opción'
                        }
                    }
                },



                numPasadas:{
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un número'
                        },
                        greaterThan:{
                            value: -1,
                            message: 'Ingrese número mayor o igual a 0'
                        },
                        stringLength: {
                            max: 3,
                            message: 'Ingrese número entre 0-999'
                        },
                        integer:{
                            message: 'Ingrese número válido'
                        }
                    }
                },
                fecha:{
                    validators: {
                        notEmpty: {
                            message: 'Ingrese fecha'
                        },
                        date: {
                            format: 'DD/MM/YYYY',
                            message: 'Ingrese fecha en formato dd/mm/aaaa'
                        }
                    }
                }
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