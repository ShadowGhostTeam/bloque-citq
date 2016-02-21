/**
 * Created by saulzini on 20/02/16.
 */

<script type="text/javascript">
    $(document).ready(function ()
    {


        $("#sector").on('change', function (e) {


            if (document.getElementById("sector").value == 0) {
                document.getElementById("siembra").value = null;

            } else {
                var idSector = e.target.value;

                $.ajax({
                    type: 'get',
                    url: "/sector/fertilizacion/carga",
                    data: {
                        idSector: idSector
                    },
                    success: function( datas ) {
                        window.alert(datas);
                       // $( "#weather-temp" ).html( "<strong>" + data + "</strong> degrees" );
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        if(xhr.status==404) {
                            alert(thrownError);
                        }
                    }
                });


            }

        });
    });
</script>

