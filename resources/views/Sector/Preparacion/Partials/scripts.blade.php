
<script type="text/javascript">
        $(function () {
            $('#fecha').datetimepicker({
            format:'DD/MM/YYYY'

        });
    });

    //previene lo del input
    $('#fecha').keypress(function(event) {event.preventDefault();});
    ///////////////AGREGAR///////////////////
    ////////////////////////////////////////
</script>

<script type="text/javascript">

    $(document).ready(function() {

        $('#formularioo').bootstrapValidator({
            message: 'Los valores no son válidos',
            feedbackIcons: {
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                sector:{
                    validators: {
                        notEmpty: {
                            message: 'Seleccione un sector'
                        }
                    }
                },
                maquinaria:{
                    validators: {
                        notEmpty: {
                            message: 'Seleccione maquinaria'
                        }
                    }
                },

                numPasadas:{
                    validators: {
                        notEmpty: {
                            message: 'Ingrese valor'
                        },
                        stringLength: {
                            max: 11,
                            message: 'El número no puede exceder 11 digitos'
                        },
                        integer:{
                            message: 'Ingrese un número'
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

        $('#fechaDP')
                .on('dp.change dp.show', function(e) {
                    $('#formulario').data('bootstrapValidator').revalidateField('fecha');
                });
    });
</script>