<script type="text/javascript">
    $(document).ready(function ()
    {


        $("#sector").on('change', function (e) {


            if (document.getElementById("sector").value == 0) {
                document.getElementById("siembra").value = null;

            } else {
                var id= e.target.value;

                $.ajax({
                    method: "GET",
                    url: "{{ URL::to('sector/fertilizacion/carga?id=')  }}"+id,

                })
                        .done(function( data ) {
                            $("#siembra").empty();
                            $("#siembra").append(
                                    "<option value='' selected > Selecciona </option>");

                            $.each(data,function(index,siembras){

                             //  alert('<option value="'+siembras.id+' "> '+ siembras.nombre+' ' + siembras.variedad+ '</option>');
                                $("#siembra").append(
                                        '<option value="'+siembras.id+'">'+siembras.nombre+' '+siembras.variedad+"</option>");
                            });
                            $('#formulario').data('bootstrapValidator').revalidateField('siembra');

                });


            }

        });
    });
</script>

