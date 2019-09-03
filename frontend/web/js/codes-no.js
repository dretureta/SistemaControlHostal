/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function LoadData(data, idioma) {

    $('#serv').DataTable().destroy();
    $('#serv').empty();

    if (idioma == "Ingles") {
        $('#serv').DataTable({
            "language": {
                "url": "dataTables.es.lang"
            },
            "sort": false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            data: data,
            columns: [
                { title: "NAME" },
                { title: "CANT" },
                { title: "PRICE" },
                { title: "SUB TOTAL" }
            ]
        });
    }

    if (idioma == "Frances") {
        $('#serv').DataTable({
            "language": {
                "url": "dataTables.es.lang"
            },
            "sort": false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            data: data,
            columns: [
                { title: "NAME FA" },
                { title: "CANT FA" },
                { title: "PRICE FA" },
                { title: "SUB TOTAL" }
            ]
        });
    }

    if (idioma == "") {
        $('#serv').DataTable({
            "language": {
                "url": "dataTables.es.lang"
            },
            "sort": false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            data: data,
            columns: [
                { title: "DES" },
                { title: "CANT" },
                { title: "PRECIO" },
                { title: "SUB TOTAL" }
            ]
        });
    }



}







//Charts
function initCharts() {
    //Chart Bar
    $('.chart.chart-bar').sparkline(undefined, {
        type: 'bar',
        barColor: '#fff',
        negBarColor: '#fff',
        barWidth: '4px',
        height: '34px'
    });
    //Chart Pie
    $('.chart.chart-pie').sparkline(undefined, {
        type: 'pie',
        height: '50px',
        sliceColors: ['rgba(255,255,255,0.70)', 'rgba(255,255,255,0.85)', 'rgba(255,255,255,0.95)', 'rgba(255,255,255,1)']
    });
    //Chart Line
    $('.chart.chart-line').sparkline(undefined, {
        type: 'line',
        width: '60px',
        height: '45px',
        lineColor: '#fff',
        lineWidth: 1.3,
        fillColor: 'rgba(0,0,0,0)',
        spotColor: 'rgba(255,255,255,0.40)',
        maxSpotColor: 'rgba(255,255,255,0.40)',
        minSpotColor: 'rgba(255,255,255,0.40)',
        spotRadius: 3,
        highlightSpotColor: '#fff'
    });
}

function DataOcup(elemento) {

    var id = elemento.id;
    var opccion = elemento.value;
    //alert(id);
    //alert(opccion);
    $.get(base_url_ocup, { 'id': opccion }, null, "json")
        .done(function(data, textStatus, jqXHR) {
            if (console && console.log) {
                console.log("La solicitud se ha completado correctamente. " + data.status);
                //alert("#" + id + "precio");
                if (data.status === 'Si') {
                    $("#" + id + "precio").removeAttr('disabled');
                    $("#" + id + "precio").val(data.precio);
                    // document.getElementById(id + "precio").disabled = false;
                    //document.getElementById(id + "precio").value = data.precio;
                }

            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            if (console && console.log) {

                UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
            }
        });
}


function DataSub(elemento) {

    var id = elemento.id;
    var opccion = elemento.value;
    //alert(id);
    //alert(opccion);
    $.get('http://localhost/sistema/frontend/web/index.php?r=dependencias%2Fsubservicios', { id: opccion }, null, "json")
        .done(function(data, textStatus, jqXHR) {
            if (console && console.log) {

                var prueba = 0;
                prueba = JSON.parse(data);
                document.getElementById("pasadia_impb").value = prueba;
                document.getElementById("pasadia_impb").disabled = false;
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            if (console && console.log) {

                UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
            }
        });
}

function DataSubservicio(elemento) {

    var id = elemento.id;
    var opccion = elemento.value;
    //alert(id);
    //alert(opccion);
    $.get('http://localhost/sistema/frontend/web/index.php?r=dependencias%2Fsubservicios', { id: opccion }, null, "json")
        .done(function(data, textStatus, jqXHR) {
            if (console && console.log) {

                var prueba = 0;
                prueba = JSON.parse(data);
                document.getElementById("preciosub23").value = prueba;
                document.getElementById("preciosub23").disabled = false;
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            if (console && console.log) {

                UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
            }
        });
}



//Init Loading
function initLoading() {
    $('[data-toggle="cardloading"]').on('click', function() {
        var effect = $(this).data('loadingEffect');
        var color = $.AdminBSB.options.colors["lightBlue"];
        var $loading = $(this).parents('.card').waitMe({
            effect: "timer",
            text: 'Loading...',
            bg: 'rgba(255,255,255,0.90)',
            color: color
        });
        setTimeout(function() {
            //Loading hide
            $loading.waitMe('hide');
        }, 3200);
    });
}

function pasadia(data) {
    var sub = "";
    sub += '<select name="id_sub" id="id_sub" onchange="DataSubservicio(this)" class="form-control show-tick">';
    sub += "<option value='0'>Elija primero servicio</option>";
    var mos = data;
    for (var i = 0; i < mos.length; i++) {
        sub += "<option value='" + mos[i]['id'] + "'>" + mos[i]['nombre'] + "</option>";
    }


    sub += '</select>';
    $("#subadd").html(sub);
}





$(document).ready(function() {


    //Textare auto growth
    autosize($('#obs'));
    $('#reservacion-fecha_salida').bootstrapMaterialDatePicker({
        weekStart: 0,
        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    });
    $('#reservacion-fecha_entrada').bootstrapMaterialDatePicker({
        weekStart: 0,
        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    }).on('change', function(e, date) {
        $('#reservacion-fecha_salida').bootstrapMaterialDatePicker('setMinDate', date);
    });
    $('#fechagastos').bootstrapMaterialDatePicker({
        weekStart: 0,
        locale: 'es',
        //weekStart: 1,
        time: false
    });
    $('#fechapasa').bootstrapMaterialDatePicker({
        weekStart: 0,
        locale: 'es',
        //weekStart: 1,
        time: false
    });
    $('#cambia-fecha_salida').bootstrapMaterialDatePicker({
        weekStart: 0,
        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    });
    //    $('#cambia-fecha_entrada').bootstrapMaterialDatePicker({
    //        weekStart: 0,
    //        minDate: new Date(),
    //        locale: 'es',
    //        //weekStart: 1,
    //        time: false
    //    }).on('change', function(e, date)
    //    {
    //        $('#cambia-fecha_salida').bootstrapMaterialDatePicker('setMinDate', date);
    //    });

    /*$('#reservacion-fecha_entrada').bootstrapMaterialDatePicker({
     format: 'DD/MM/YYYY',
     minDate : new Date(),
     clearButton: false,
     locale: 'es',
     //weekStart: 1,
     time: false
     });
     
     $('#reservacion-fecha_salida').bootstrapMaterialDatePicker({
     format: 'DD/MM/YYYY',
     //minDate : moment(''+ $('#reservacion-fecha_salida').val() + ''),
     clearButton: false,
     locale: 'es',
     //weekStart: 1,
     time: false
     });*/










    $('.chart.chart-bar').sparkline(undefined, {
        type: 'bar',
        barColor: '#fff',
        negBarColor: '#fff',
        barWidth: '4px',
        height: '34px'
    });
    //Chart Pie
    $('.chart.chart-pie').sparkline(undefined, {
        type: 'pie',
        height: '50px',
        sliceColors: ['rgba(255,255,255,0.70)', 'rgba(255,255,255,0.85)', 'rgba(255,255,255,0.95)', 'rgba(255,255,255,1)']
    });
    //Chart Line
    $('.chart.chart-line').sparkline(undefined, {
        type: 'line',
        width: '60px',
        height: '45px',
        lineColor: '#fff',
        lineWidth: 1.3,
        fillColor: 'rgba(0,0,0,0)',
        spotColor: 'rgba(255,255,255,0.40)',
        maxSpotColor: 'rgba(255,255,255,0.40)',
        minSpotColor: 'rgba(255,255,255,0.40)',
        spotRadius: 3,
        highlightSpotColor: '#fff'
    });
    $('[data-star]').click(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var color = $(this).data('star');
        var codigo = $(this).data('id');
        document.getElementById('color').value = color;
        document.getElementById('codigo').value = codigo;
    });
    $("#agencia").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#sub").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#hab").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#pdia").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#ocupacion").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#ocu_hab").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    //    $("#serv").dataTable({
    //        "language": {
    //            "url": "dataTables.es.lang"
    //        },
    //        "sort": false,
    //        dom: 'Bfrtip',
    //        buttons: [
    //            'excel', 'pdf', 'print'
    //        ],
    //    });
    $("#subservicios").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#gastos").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#reservaciones").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#activas").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#pendientes").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $('#servicio').DataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#reportes").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#addgastos3").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#pasa_ser").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    /*Esto es pare q el select me complete */
    //$(".select2").select2();


















    /*ESTO ES PARA LA OCUPACION PONERLE PRECIO*/

    $('[data-ocup1]').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var id = $(this).data('ocup1');
        var opccion = document.getElementById(id + "ocupacion").value;
        //alert(id);
        $.get(base_url_ocup, { 'id': opccion }, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {
                    console.log("La solicitud se ha completado correctamente. " + data.campo);
                    if (data.status === 'Si') {
                        document.getElementById(id + "precio").disabled = false;
                        document.getElementById(id + "precio").value = data.precio;
                    }

                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
                }
            });
    });
    //    /*ICONO RESERVACION*/

    $('[data-hab]').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var id = $(this).data('hab');
        if (document.getElementById(id).checked) {
            //document.getElementById(id + "precio").disabled = false;
            //document.getElementById(id + "ocupacion").disabled = false;
            select_ocup = "";
            $.get(base_url_hab, { 'id': id }, null, "json")
                .done(function(data, textStatus, jqXHR) {
                    if (console && console.log) {
                        // console.log("La solicitud se ha completado correctamente. " + data.status);

                        if (data.status === 'Si') {

                            $("#" + id + "body").removeClass('hidden');
                            select_ocup += '<select name="' + id + 'ocupacion" id="' + id + 'ocupacion" onchange="DataOcup(this)" data-ocup="' + id + '" class="form-control bootstrap-select">';
                            select_ocup += "<option value='0'>Ocupaci�n</option>";
                            var mos = data.array;
                            for (var i = 0; i < mos.length; i++) {
                                select_ocup += "<option value='" + mos[i]['id'] + "'>" + mos[i]['nombre'] + "</option>";
                            }


                            select_ocup += '</select>';
                            $("#" + id + "select_ocup_output").html(select_ocup);
                        }

                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {

                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
                    }
                });
        } else {
            document.getElementById(id + "ocupacionprecio").disabled = true;
            document.getElementById(id + "ocupacionprecio").value = "";
            document.getElementById(id + "ocupacion").disabled = true;
        }
    });
    /*ESTO ES LO Q LLENA LA TABLA Q SE VA A IMPRIMIR */


    $('[data-combo]').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        // var id = $(this).data('combo');
        var hab = document.getElementById("combo").value;
        var res = document.getElementById("res").value;

        document.getElementById('ingles').checked = false;
        document.getElementById('frances').checked = false;

        $.get(base_url_combo, { 'id': res, 'hab': hab }, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {
                    console.log("La solicitud se ha completado correctamente.");
                    /*  INTRODUCIR LOS DATOS AL DATATABLE*/
                    var idioma = "";
                    LoadData(data, idioma);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
                }
            });
    });
    /* MUESTRO LAS HABITACIONES DISPONIBLES EN EL INTERVALO D FECHAS*/

    $('#reservacion-fecha_salida').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var fecha_ent = $('#reservacion-fecha_entrada').val();
        var fecha_sal = $('#reservacion-fecha_salida').val();
        var color = $.AdminBSB.options.colors["indigo"];
        var $loading = $('#card-reservacion').waitMe({
            effect: "timer",
            text: 'Cargando Datos...',
            bg: 'rgba(255,255,255,0.90)',
            color: color
        });
        /*setTimeout(function () {
         //Loading hide
         $loading.waitMe('hide');
         }, 3200);*/

        $.get(base_url_fecha, { 'fe_entrada': fecha_ent, 'fe_salida': fecha_sal }, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {
                    //console.log("La solicitud se ha completado correctamente.");
                    //ENVIAR PARA LA PAGINA DE RESERVAS PARA CAPTURAR EL ARREGLO
                    //  $.get('http://localhost/sistema/frontend/web/index.php?r=reservacion%2Fcreate', {'datos':data}, null, "json");



                    var dis = data.dis;
                    var hab = data.hab;
                    var ban = 0;
                    for (var i = 0; i < hab.length; i++) {
                        for (var j = 0; j < dis.length; j++) {
                            if (hab[i].id == dis[j].id) {
                                ban = 1;
                            }

                        }
                        if (ban == 1) {
                            $('#' + hab[i].id + 'card_habitacion').removeClass('hidden');
                            ban = 0;
                        } else {
                            $('#' + hab[i].id + 'card_habitacion').addClass('hidden');
                        }
                    }

                    $loading.waitMe('hide');
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
                }
            });
    });
    /*   ESTO ES PARA RESETEAR LAS HABITACIONES Y QUITAR LA FECHA D SALIDA*/

    $('#reservacion-fecha_entrada').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        document.getElementById("reservacion-fecha_salida").disabled = false;
        document.getElementById("reservacion-fecha_salida").value = '';
        $.get(base_url_reshab, {}, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {

                    for (var j = 0; j < data.length; j++) {
                        $('#' + data[j].id + 'card_habitacion').addClass('hidden');
                    }
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
                }
            });
    });
    $('#reservacionservicios-servicio').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var id = $('#reservacionservicios-servicio').val();
        $.get('http://localhost/sistema/frontend/web/index.php?r=dependencias%2Fsubservicios', { id: id }, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {

                    var prueba = 0;
                    prueba = JSON.parse(data);
                    document.getElementById("preciosub").value = prueba;
                    document.getElementById("preciosub").disabled = false;
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
                }
            });
    });
    $('[data-ver]').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var id = $(this).data('ver');
        if (document.getElementById(id).checked) {
            document.getElementById(id + "ocupacion_precio").disabled = false;
            document.getElementById(id + "ocupacion_precio").value = "";
        } else {
            document.getElementById(id + "ocupacion_precio").disabled = true;
            document.getElementById(id + "ocupacion_precio").value = "";
        }

    });
    $("#pasadia_servicio").change(function(e) {
        e.preventDefault();
        var servicio = $("#pasadia_servicio").val();
        var sub = "";
        $.get('http://localhost/sistema/frontend/web/index.php?r=dependencias%2Fsub', { id: servicio }, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {


                    sub += '<select name="pasadia_sub" id="pasadia_sub" onchange="DataSub(this)" class="form-control show-tick">';
                    sub += "<option value='0'>Elija primero servicio</option>";
                    var mos = data;
                    for (var i = 0; i < mos.length; i++) {
                        sub += "<option value='" + mos[i]['id'] + "'>" + mos[i]['nombre'] + "</option>";
                    }


                    sub += '</select>';
                    $("#subadd").html(sub);
                }


            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
                }
            });
    });



    $("#id_serv").change(function(e) {
        var servicio = $("#id_serv").val();
        $.get('http://localhost/sistema/frontend/web/index.php?r=dependencias%2Fsub', { id: servicio }, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {

                    pasadia(data);
                }


            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
                }
            });
    });






    $("#ingles").change(function(e) {
        e.preventDefault();
        if (document.getElementById('ingles').checked) {

            document.getElementById('frances').checked = false;
            var hab = document.getElementById("combo").value;
            var res = document.getElementById("res").value;
            var idioma = "Ingles";


            $.get('http://localhost/sistema/frontend/web/index.php?r=site%2Fidioma', { id: res, hab: hab, idioma: idioma }, null, "json")
                .done(function(data, textStatus, jqXHR) {
                    if (console && console.log) {
                        LoadData(data, idioma);
                    }


                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {

                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
                    }
                });
        }

    });



    $("#frances").change(function(e) {
        e.preventDefault();
        if (document.getElementById('frances').checked) {

            document.getElementById('ingles').checked = false;

            var hab = document.getElementById("combo").value;
            var res = document.getElementById("res").value;
            var idioma = "Frances";


            $.get('http://localhost/sistema/frontend/web/index.php?r=site%2Fidioma', { id: res, hab: hab, idioma: idioma }, null, "json")
                .done(function(data, textStatus, jqXHR) {
                    if (console && console.log) {
                        LoadData(data, idioma);
                    }


                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {

                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, { timeout: 0, status: 'danger', pos: 'bottom-right' });
                    }
                });
        }

    });





    /* VALIDAR LOS FORM Q NO SON DEL YII*/


    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una direcci�n de correo v�lida",
        url: "Por favor, escribe una URL v�lida.",
        date: "Por favor, escribe una fecha v�lida.",
        dateISO: "Por favor, escribe una fecha (ISO) v�lida.",
        number: "Por favor, escribe un numero.",
        digits: "Por favor, escribe s�lo d�gitos.",
        creditcard: "Por favor, escribe un n�mero de tarjeta v�lido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        accept: "Por favor, escribe un valor con una extensi�n aceptada.",
        maxlength: jQuery.validator.format("Por favor, no escribas m�s de {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
        max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
        min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
    });


    $('#validar_pasadia').validate({
        rules: {
            'pasadia_impb': {
                number: true
            },
            'pasadia_cant': {
                number: true
            }
        },
        highlight: function(input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function(input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }
    });


    $('#res_servcicio').validate({
        rules: {
            'res_cant': {
                number: true
            },
            'precio23': {
                number: true
            }
        },
        highlight: function(input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function(input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }
    });


    $('#repagencia_validar').validate({
        highlight: function(input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function(input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }
    });


    $('#horizontalTab').responsiveTabs({
        //startCollapsed: 'accordion'
    });

    //$("#id_serv").select2();


});


function Imprimir(id) {
    var comp = document.getElementById('print');
    var ventana = window.open('', '_blank');

    /*Esto es para q cargue el css*/
    // comp.createStyleSheet("http://localhost/sistema/frontend/web/css/bootstrap.min.css");

    ventana.document.write(comp.innerHTML);

    ventana.document.close();
    var opcion = confirm('Desea terminar la reservación');
    if (opcion) {
        alert(id);
    }
    ventana.print();
    ventana.close();
}