<script type="text/javascript">
    $(document).ready(function ()
    {


        $("#invernadero").on('change', function (e) {


            if (document.getElementById("invernadero").value == "") {
                $("#siembraPlantula").empty();
                $("#siembraPlantula").append(
                        "<option value='' selected > Selecciona </option>");

            } else {
                var id= e.target.value;
                $.ajax({
                            method: "GET",
                            url: "{{ URL::to('plantula/ajaxSiembraPlantula/carga?id=')  }}"+id,

                        })
                        .done(function( data ) {

                            $("#siembraPlantula").empty();
                            $("#siembraPlantula").append(
                                    "<option value='' selected > Selecciona </option>");

                            $.each(data,function(index,siembras){

                                $("#siembraPlantula").append(
                                        '<option value="'+siembras.id_siembra+'">'+siembras.nombre+'  '+siembras.variedad+" - "+ siembras.fecha +"</option>");
                            });
                            $('#formulario').data('bootstrapValidator').revalidateField('siembraPlantula');

                        });


            }

        });
    });
</script>

