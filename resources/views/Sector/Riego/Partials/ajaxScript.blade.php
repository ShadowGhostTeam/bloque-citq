<script type="text/javascript">
    $(document).ready(function ()
    {

        $("#sector").on('change', function (e) {


            if (document.getElementById("sector").value == "") {
                $("#siembra").empty();
                $("#siembra").append(
                        "<option value='' selected > Selecciona </option>");

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

        $( "#tiempo" ).keyup(function() {
            a = isNaN(document.getElementById("tiempo").value);
            b = isNaN(document.getElementById("distanciaLineas").value);
            if(document.getElementById("distanciaLineas").value == "" || document.getElementById("tiempo").value == ""){
                document.getElementById("litrosHectarea").value = "Falta información para calcular este dato.";
                document.getElementById("lamina").value = "Falta información para calcular este dato.";
            }else{
                if (a || b){
                    document.getElementById("litrosHectarea").value = "Alguno de los valores no es válido.";
                    document.getElementById("lamina").value = "Alguno de los valores no es válido.";
                }else{
                    x = document.getElementById("tiempo").value * (100/document.getElementById("distanciaLineas").value) * 500;
                    document.getElementById("litrosHectarea").value = x + " litros por hectárea.";

                    y = x / 10000;
                    document.getElementById("lamina").value = y + " milimetros de agua.";
                }
            }
        });

        $( "#distanciaLineas" ).keyup(function() {
            a = isNaN(document.getElementById("tiempo").value);
            b = isNaN(document.getElementById("distanciaLineas").value);
            if(document.getElementById("tiempo").value == "" || document.getElementById("distanciaLineas").value == ""){
                document.getElementById("litrosHectarea").value = "Falta información para calcular este dato.";
                document.getElementById("lamina").value = "Falta información para calcular este dato.";
            }else{
                if (a || b){
                    document.getElementById("litrosHectarea").value = "Alguno de los valores no es válido.";
                    document.getElementById("lamina").value = "Alguno de los valores no es válido.";
                }else{
                    x = document.getElementById("tiempo").value * (100/document.getElementById("distanciaLineas").value) * 500;
                    document.getElementById("litrosHectarea").value = x + " litros por hectárea.";

                    y = x / 10000;
                    document.getElementById("lamina").value = y + " milimetros de agua.";
                }
            }
        });

    });
</script>

