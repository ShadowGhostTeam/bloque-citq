<script type="text/javascript">

    $(document).ready(function() {
        @if(isset($mantenimientoSector))
        {
            @if($mantenimientoSector->actividad=="Deshierbe manual"||$mantenimientoSector->actividad=="Deshierbe máquina")
            $('#divProducto').hide();
            $('#divTipoAplicacion').hide();
            $('#divCantidad').hide();
            @endif
        }
        @else
        $('#divProducto').hide();
        $('#divTipoAplicacion').hide();
        $('#divCantidad').hide();
      @endif

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


                siembra:{
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una opción'
                        }
                    }
                },
                actividad:{
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una opción'
                        }
                    }
                },

                cantidad:{
                    validators: {

                        numeric: {
                            message: 'No es un número válido',
                            // The default separators
                            decimalSeparator: '.'
                        },
                        greaterThan:{
                            value: 0,
                            message: 'El número tiene que ser positivo'
                        }

                    }
                },

                producto:{
                    validators: {

                        stringLength: {
                            max: 255,
                            message: 'Debe ser menor de 255 caracteres'
                        }

                    }
                },
                comentario:{
                    validators: {

                        stringLength: {
                            max: 65534,
                            message: 'Debe ser menor de 65535 caracteres'
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
                }
            }
        });

        $('#fecha')
                .on('dp.change dp.show', function(e) {
                    $('#formulario').data('bootstrapValidator').revalidateField('fecha');
                });

        $('#actividad').on('change', function() {
            if ($('#actividad')[0].selectedIndex < 3){
                $('#divProducto').hide();
                $('#divTipoAplicacion').hide();


                $('#tipoAplicacion').val("");
                $('#producto').val("");
                $('#cantidad').val("");
                $('#formulario').data('bootstrapValidator').revalidateField('cantidad');
                $('#divCantidad').hide();

            }
            else{
                $('#divProducto').show();
                $('#divTipoAplicacion').show();
                $('#divCantidad').show();


            }
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