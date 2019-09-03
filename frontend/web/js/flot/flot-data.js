//Flot Line Chart
$(document).ready(function() {
    console.log("document ready");
//    plot();




    //Equivalente a lo anterior
    $.get('http://localhost/restaurante/frontend/web/index.php?r=site%2Fgrafica', {}, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {
                    console.log("La solicitud se ha completado correctamente. " + data[0]['label']);
                    datos = data;
                    plot(datos);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + textStatus);

                }
            });



    function plot(datos) {
        var plotObj = $.plot($("#flot-pie-chart"), datos, {
            series: {
                pie: {
                    show: true
                }
            },
            grid: {
                hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            }
        });
    }
});
