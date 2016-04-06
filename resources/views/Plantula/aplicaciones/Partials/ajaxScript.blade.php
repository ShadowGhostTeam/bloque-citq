<script type="text/javascript">
    $(document).ready(function ()
    {


        $("#invernadero").on('change', function (e) {


            if (document.getElementById("invernadero").value == "") {
                $("#siembraT").empty();
                $("#siembraT").append(
                        "<option value='' selected > Selecciona </option>");

            } else {
                var id= e.target.value;

                $.ajax({
                            method: "GET",
                            url: "{{ URL::to('invernadero/ajaxSiembraInvernadero/carga?id=')  }}"+id,

                        })
                        .done(function( data ) {

                            $("#siembraT").empty();
                            $("#siembraT").append(
                                    "<option value='' selected > Selecciona </option>");

                            $.each(data,function(index,siembras){

                                $("#siembraT").append(
                                        '<option value="'+siembras.id_siembra+'">'+siembras.nombre+'  '+siembras.variedad+" - "+ siembras.fecha +"</option>");
                            });
                            $('#formulario').data('bootstrapValidator').revalidateField('siembraT');

                        });


            }

        });
    });
</script>

