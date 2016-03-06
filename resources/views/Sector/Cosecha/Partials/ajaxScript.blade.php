<script type="text/javascript">
    $(document).ready(function ()
    {


        $("#sector").on('change', function (e) {


            if (document.getElementById("sector").value == "") {
                $("#siembra").empty();
                $("#siembra").append(
                        "<option value='' selected > Selecciona </option>");;

            } else {
                var id= e.target.value;

                $.ajax({
                    method: "GET",
                    url: "{{ URL::to('sector/ajaxSiembra/carga?id=')  }}"+id,

                })
                        .done(function( data ) {
                            $("#siembra").empty();
                            $("#siembra").append(
                                    "<option value='' selected > Selecciona </option>");

                            $.each(data,function(index,siembras){

                                $("#siembra").append(
                                        '<option value="'+siembras.id_siembra+'">'+siembras.nombre+'  '+siembras.variedad+" - "+ siembras.fecha +"</option>");
                            });
                            $('#formulario').data('bootstrapValidator').revalidateField('siembra');

                });


            }

        });
    });
</script>

