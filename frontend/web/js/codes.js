/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




function imprSelec()
{

    ////////
    var ficha = document.getElementById('imp_espanol');


    if (document.getElementById('ingles').checked) {
        ficha = document.getElementById('imp_ingles');
    }

    if (document.getElementById('frances').checked) {
        ficha = document.getElementById('imp_frances');
    }

    if (document.getElementById('combo').value != "") {
        ficha = document.getElementById(document.getElementById('combo').value + '_espanol');
    }

    if (document.getElementById('ingles').checked && document.getElementById('combo').value != "") {
        ficha = document.getElementById(document.getElementById('combo').value + '_ingles');
    }

    if (document.getElementById('frances').checked && document.getElementById('combo').value != "") {        
        ficha = document.getElementById(document.getElementById('combo').value + '_frances');
    }



    //var ficha = document.getElementById(nombre);

    var ventimp = window.open(' ', 'popimpr');

    ventimp.document.write(ficha.innerHTML);

    ventimp.document.close();

    ventimp.print();

    ventimp.close();

}






function imprSelecPasa() {
    ////////
    var ficha = document.getElementById('imp_espanolpasa');

    if (document.getElementById('ingles_pasa').checked) {
        ficha = document.getElementById('imp_inglespasa');
    }

    if (document.getElementById('frances_pasa').checked) {
        ficha = document.getElementById('imp_francespasa');
    }



    //var ficha = document.getElementById(nombre);

    var ventimp = window.open(' ', 'popimpr');

    ventimp.document.write(ficha.innerHTML);

    ventimp.document.close();

    ventimp.print();

    ventimp.close();

}




function LoadData(data, idioma) {

    $('#serv').DataTable().destroy();
    $('#serv').empty();

    if (idioma == "Ingles") {
        $('#serv').DataTable({
            "language": {
                "url": "dataTables.es.lang"
            },
            "sort": false,
            "paginate": false,
            "filter": false,
            "info": false,
            data: data,
            columns: [
                {title: "SERVICE", width: 180},
                {title: "QUANTITY", width: 20},
                {title: "PRICE", width: 10},
                {title: "AMOUNT", width: 180}
            ]
        });
    }

    if (idioma == "Frances") {
        $('#serv').DataTable({
            "language": {
                "url": "dataTables.es.lang"
            },
            "sort": false,
            "paginate": false,
            "filter": false,
            "info": false,
            data: data,
            columns: [
                {title: "SERVICE", width: 180},
                {title: "QUANTITÉ", width: 20},
                {title: "PRIX", width: 10},
                {title: "MONTANT", width: 180}
            ]
        });
    }

    if (idioma == "") {
        $('#serv').DataTable({
            "language": {
                "url": "dataTables.es.lang"
            },
            "sort": false,
            "paginate": false,
            "filter": false,
            "info": false,
            data: data,
            columns: [
                {title: "SERVICIO", width: 180},
                {title: "CANTIDAD", width: 20},
                {title: "PRECIO", width: 10},
                {title: "IMPORTE", width: 20}
            ]
        });
    }

}


function LoadDataPasaDia(data, idioma) {

    $('#pasa_ser').DataTable().destroy();
    $('#pasa_ser').empty();

    if (idioma == "Ingles") {
        $('#pasa_ser').DataTable({
            "language": {
                "url": "dataTables.es.lang"
            },
            "sort": false,
            "paginate": false,
            "filter": false,
            "info": false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            data: data,
            columns: [
                {title: "SERVICE"},
                {title: "QUANTITY"},
                {title: "PRICE"},
                {title: "AMOUNT"}
            ]
        });
    }

    if (idioma == "Frances") {
        $('#pasa_ser').DataTable({
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
                {title: "SERVICE"},
                {title: "QUANTITÉ"},
                {title: "PRIX"},
                {title: "MONTANT"}
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
                {title: "SERVICIO"},
                {title: "CANTIDAD"},
                {title: "PRECIO"},
                {title: "IMPORTE"}
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
    $.get(base_url_ocup, {'id': opccion}, null, "json")
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

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                }
            });
}

function DataOcupAct(elemento) {

    var id = elemento.id;
    var opccion = elemento.value;
    //alert(id);
//    alert(opccion);
    $.get(base_url_ocup, {'id': opccion}, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {
                    console.log("La solicitud se ha completado correctamente. " + data.status);
                    //alert("#" + id + "precio");
                    if (data.status === 'Si') {
                        //alert(opccion);
                        $("#" + id + "precio").removeAttr('disabled');
                        $("#" + id + "precio").val(data.precio);
                        // document.getElementById(id + "precio").disabled = false;
                        //document.getElementById(id + "precio").value = data.precio;
                    }

                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                }
            });
}


function DataSub(elemento) {

    var id = elemento.id;
    var opccion = elemento.value;
    //alert(id);
    //alert(opccion);
    $.get(base_url_subprueba, {id: opccion}, null, "json")
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

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                }
            });
}


function sumDias(fecha, numDias) {
    fecha.setDate(fecha.getDate() + numDias);
    return fecha;
}

function DataSubservicio(elemento) {

    var id = elemento.id;
    var opccion = elemento.value;
    //alert(id);
    //alert(opccion);
    $.get(base_url_subprueba, {id: opccion}, null, "json")
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

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
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

    var dopcion = 'serv';


    $("#id_func").change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        // var id = $(this).data('combo');
        var func = document.getElementById("id_func").value;

        if (func != "") {
            $.get(base_url_precio, {'id': func}, null, "json")
                    .done(function(data, textStatus, jqXHR) {
                        if (console && console.log) {


                            document.getElementById('precio').disabled = false;
                            document.getElementById('cant').disabled = false;
                            document.getElementById('bofunciones').disabled = false;
                            document.getElementById('precio').value = data;

                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        if (console && console.log) {

                            UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                        }
                    });
        } else {
            document.getElementById('precio').disabled = true;
            document.getElementById('cant').disabled = true;
            document.getElementById('precio').value = "";
            document.getElementById('bofunciones').disabled = true;
        }

    });






    $('[data-notifychecked]').click(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var notifyid = 'all';

        if (confirm("Esta seguro que desea eliminar todas las notificaciones?")) {



            $.get(base_url_notifychecked, {'notificaciones': notifyid}, null, "json")
                    .done(function(data, textStatus, jqXHR) {
                        if (console && console.log) {


                            if (data.status === 'Si') {
                                $("#" + notifyid).addClass("hidden");
                                $("#notifycount").html(data.cantidad);
                            }

                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        if (console && console.log) {

                            UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                        }
                    });



        } else {

            alert("no");

        }
    });


    $('[data-notify]').click(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var notifyid = $(this).data('notifyid');

        if (confirm("Esta seguro que desea eliminar esta notificacion?")) {



            $.get(base_url_notify, {'id': notifyid}, null, "json")
                    .done(function(data, textStatus, jqXHR) {
                        if (console && console.log) {
                            console.log("La solicitud se ha completado correctamente. " + data.status);
                            console.log("La solicitud se ha completado correctamente. " + data.cantidad);
                            if (data.status === 'Si') {
                                $("#" + notifyid).addClass("hidden");
                                $("#notifycount").html(data.cantidad);
                            }

                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        if (console && console.log) {

                            UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                        }
                    });



        } else {

            alert("no");

        }
    });


    //Textare auto growth
    autosize($('#obs'));


    $('#salvar').bootstrapMaterialDatePicker({
        weekStart: 0,
        //minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    }).on('change', function(e, date) {
        $('#reservacion-fecha_salida').bootstrapMaterialDatePicker('setMinDate', date);
    });


    $('#reservacion-fecha_salida').bootstrapMaterialDatePicker({
        weekStart: 0,
        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    });



    $('#reservacion-fecha_entrada').bootstrapMaterialDatePicker({
        weekStart: 0,
        //minDate: new Date(),
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


    $('#fecha_func').bootstrapMaterialDatePicker({
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



    $('#gastos_salida').bootstrapMaterialDatePicker({
        weekStart: 0,
//        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    });
    $('#gastos_entrada').bootstrapMaterialDatePicker({
        weekStart: 0,
//        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    }).on('change', function(e, date) {
        $('#gastos_salida').bootstrapMaterialDatePicker('setMinDate', date);
    });

    $('#gastos_entrada').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        document.getElementById("gastos_salida").disabled = false;

    });





    $('#dos').bootstrapMaterialDatePicker({
        weekStart: 0,
        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    });



    $('#uno').bootstrapMaterialDatePicker({
        weekStart: 0,
        //minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    }).on('change', function(e, date) {
        $('#dos').bootstrapMaterialDatePicker('setMinDate', date);
    });





    $('#ing_salida').bootstrapMaterialDatePicker({
        weekStart: 0,
//        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    });
    $('#ing_entrada').bootstrapMaterialDatePicker({
        weekStart: 0,
//        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    }).on('change', function(e, date) {
        $('#ing_salida').bootstrapMaterialDatePicker('setMinDate', date);
    });

    $('#ing_entrada').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        document.getElementById("ing_salida").disabled = false;

    });




    $('#general_salida').bootstrapMaterialDatePicker({
        weekStart: 0,
//        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    });
    $('#general_entrada').bootstrapMaterialDatePicker({
        weekStart: 0,
//        minDate: new Date(),
        locale: 'es',
        //weekStart: 1,
        time: false
    }).on('change', function(e, date) {
        $('#general_salida').bootstrapMaterialDatePicker('setMinDate', date);
    });

    $('#general_entrada').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        document.getElementById("general_salida").disabled = false;

    });





    $('#rep_inicial').datepicker({
        format: "mm-yyyy",
        viewMode: 1,
        locale: 'es',
        minViewMode: 2
    }).on('changeDate', function(e) {
        $(this).datepicker('hide');
    });



    $('#prueba').bootstrapMaterialDatePicker({
        weekStart: 0,
        format: "mm/yyyy",
        viewMode: 1,
        locale: 'es',
        minViewMode: 2
    })





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
        "lengthMenu": [[8]],
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });


    $("#terminadas").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        "lengthMenu": [[8]],
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });

    $("#traba").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        "lengthMenu": [[8]],
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
        "lengthMenu": [[8]],
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#hab").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "lengthMenu": [[8]],
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
        "lengthMenu": [[8]],
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
    });
    $("#ocupacion").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "lengthMenu": [[8]],
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
        "lengthMenu": [[8]],
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#report").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "lengthMenu": [[7]],
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
    });

    $("#report22").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "lengthMenu": [[7]],
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
    });


    $("#subservicios").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        "lengthMenu": [[8]],
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#gastos").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "lengthMenu": [[11]],
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
        "lengthMenu": [[6]],
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $("#activas").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "lengthMenu": [[6]],
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
        "lengthMenu": [[6]],
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
        "lengthMenu": [[7]],
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });

    $('#infopasa55').DataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        "lengthMenu": [[7]],
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });


    $("#liberadas").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "lengthMenu": [[7]],
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });

    $("#denegadas").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        "lengthMenu": [[5]],
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });

    $("#pasa_servicio").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        "lengthMenu": [[8]],
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });

    $("#reportes").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "paginate": false,
        "filter": false,
        "lengthMenu": [[7]],
        "info": false

    });

    $("#reportes_extra").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "paginate": false,
        "filter": false,
        "lengthMenu": [[7]],
        "info": false

    });



    $("#addgastos3").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        dom: 'Bfrtip',
        "lengthMenu": [[12]],
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });


    $("#pasa_ser").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "paginate": false,
        "filter": false,
        "lengthMenu": [[8]],
        "info": false
    });


    $("#reportes_general").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "paginate": true,
        "lengthMenu": [[7]],
        "filter": true,
        "info": true
    });

    $("#reportes_ingreso").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "paginate": true,
        "lengthMenu": [[7]],
        "filter": true,
        "info": true
    });

    $("#reportes_ingresopasa").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "lengthMenu": [[7]],
        "paginate": true,
        "filter": true,
        "info": true
    });


    $("#inforeserv").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "lengthMenu": [[7]],
        "paginate": true,
        "filter": true,
        "info": true
    });

    $("#tra_info").dataTable({
        "language": {
            "url": "dataTables.es.lang"
        },
        "sort": false,
        "lengthMenu": [[8]],
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
    });


    /*Esto es pare q el select me complete */
    //$(".select2").select2();






    /* $("cal").stickyHeaderFooter({
     bottom: '20px',
     top: '60px'
     });*/











    /*ESTO ES PARA LA OCUPACION PONERLE PRECIO*/

    $('[data-ocup1]').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var id = $(this).data('ocup1');
        var opccion = document.getElementById(id + "ocupacion").value;
        //alert(id);
        $.get(base_url_ocup, {'id': opccion}, null, "json")
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

                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
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
            var enviar = document.getElementById(id).value;

            $.get(base_url_hab, {'id': enviar}, null, "json")
                    .done(function(data, textStatus, jqXHR) {
                        if (console && console.log) {
                            // console.log("La solicitud se ha completado correctamente. " + data.status);

                            if (data.status === 'Si') {

                                $("#" + enviar + "body").removeClass('hidden');
                                select_ocup += '<select name="' + enviar + 'ocupacion" id="' + enviar + 'ocupacion" onchange="DataOcup(this)" data-ocup="' + enviar + '" class="form-control bootstrap-select">';
                                select_ocup += "<option value='0'>Ocupación</option>";
                                var mos = data.array;
                                for (var i = 0; i < mos.length; i++) {
                                    select_ocup += "<option value='" + mos[i]['id'] + "'>" + mos[i]['nombre'] + "</option>";
                                }


                                select_ocup += '</select>';
                                $("#" + enviar + "select_ocup_output").html(select_ocup);
                            }

                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        if (console && console.log) {

                            UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                        }
                    });
        } else {
            document.getElementById(id + "ocupacionprecio").disabled = true;
            document.getElementById(id + "ocupacionprecio").value = "";
            document.getElementById(id + "ocupacion").disabled = true;
        }
    });



    $('[data-act]').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var id = $(this).data('act');


        if (document.getElementById(id + 'act').checked) {

            //document.getElementById(id + "precio").disabled = false;
            //document.getElementById(id + "ocupacion").disabled = false;
            select_ocup = "";
            var enviar = document.getElementById(id + 'act').value;

            $.get(base_url_hab, {'id': enviar}, null, "json")
                    .done(function(data, textStatus, jqXHR) {
                        if (console && console.log) {
                            // console.log("La solicitud se ha completado correctamente. " + data.status);

                            if (data.status === 'Si') {

                                $("#" + enviar + "body").removeClass('hidden');
                                select_ocup += '<select name="' + enviar + 'ocupacionact" id="' + enviar + 'ocupacionact" onchange="DataOcupAct(this)" data-ocup="' + enviar + '" class="form-control bootstrap-select">';
                                select_ocup += "<option value='0'>Ocupación</option>";
                                var mos = data.array;
                                for (var i = 0; i < mos.length; i++) {
                                    select_ocup += "<option value='" + mos[i]['id'] + "'>" + mos[i]['nombre'] + "</option>";
                                }


                                select_ocup += '</select>';
                                $("#" + enviar + "select_ocup_output").html(select_ocup);
                            }

                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        if (console && console.log) {

                            UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
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
        //var res = document.getElementById("res").value;

        document.getElementById('ingles').checked = false;
        document.getElementById('frances').checked = false;


        if (hab != '') {
            $('#' + dopcion).addClass('hidden');
            $('#' + hab).removeClass('hidden');
            dopcion = hab;
        } else {
            $('#' + dopcion).addClass('hidden');
            $('#serv').removeClass('hidden');
            dopcion = 'serv';
        }



//        $.get(base_url_combo, {'id': res, 'hab': hab}, null, "json")
//                .done(function(data, textStatus, jqXHR) {
//                    if (console && console.log) {
//                        console.log("La solicitud se ha completado correctamente.");
//                        /*  INTRODUCIR LOS DATOS AL DATATABLE*/
//                        var idioma = "";
//                        LoadData(data, idioma);
//                    }
//                })
//                .fail(function(jqXHR, textStatus, errorThrown) {
//                    if (console && console.log) {
//
//                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
//                    }
//                });
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


        $.get(base_url_fecha, {'fe_entrada': fecha_ent, 'fe_salida': fecha_sal}, null, "json")
                .done(function(data, textStatus, jqXHR) {
                    if (console && console.log) {
                        //console.log("La solicitud se ha completado correctamente.");
                        //ENVIAR PARA LA PAGINA DE RESERVAS PARA CAPTURAR EL ARREGLO
                        //  $.get('http://localhost/sistema/frontend/web/index.php?r=reservacion%2Fcreate', {'datos':data}, null, "json");



                        var dis = data.dis;
                        var hab = data.hab;
                        var ban = 0;
                        var anexo = 0;
                        for (var i = 0; i < hab.length; i++) {
                            for (var j = 0; j < dis.length; j++) {
                                if (hab[i].id == dis[j].id) {
                                    ban = 1;
                                    if (dis[j].nombre != 'ANEXO') {
                                        anexo = 1;
                                    }
                                }


                            }
                            if (ban == 1) {
                                $('#' + hab[i].id + 'card_habitacion').removeClass('hidden');
                                ban = 0;
                            } else {
                                $('#' + hab[i].id + 'card_habitacion').addClass('hidden');
                            }
                        }

                        if (dis.length == 0 || anexo == 0) {
                            $('#vinculos').removeClass('hidden');

                            document.getElementById('reservacion-agencia').disabled = true;
                            document.getElementById('reservacion-plan').disabled = true;
                            document.getElementById('reservacion-codigo').disabled = true;
                            document.getElementById('obs').disabled = true;
                            document.getElementById('conjunto').disabled = true;
                            document.getElementById('bus_act').disabled = true;

                            var nombre = document.getElementById('reservacion-nombre_cliente').value;


                            /** ESTO ES PARA MOSTRAR LOS VINCULOS CON LAS FECHAS*/

                            $.get(base_url_rango, {'entrada': fecha_ent, 'salida': fecha_sal}, null, "json")
                                    .done(function(datos, textStatus, jqXHR) {
                                        if (console && console.log) {
                                            console.log("La solicitud se ha completado correctamente.");
                                            /*  TENGO TODAS LAS FECHA EN DATOS*/
                                            var res = document.getElementById('act_reser').value;

                                            for (var i = 0; i < datos.length; i++) {
                                                $('#hiper').append('<a href="index.php?r=reservacion%2Faddfecha&fecha=' + datos[i] + '&res=' + res + '&inicial=' + fecha_ent + '&final=' + fecha_sal + '&nombre=' + nombre + '"><span class="glyphicon glyphicon-calendar"></span> &nbsp;' + datos[i] + '</a><br>');
                                            }

                                        }
                                    })
                                    .fail(function(jqXHR, textStatus, errorThrown) {
                                        if (console && console.log) {

                                            UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                                        }
                                    });

                            $('#vinculos').append()(col);



                            //var div = document.getElementById('vinculos');
                            var col = '<div class=col-md-12><a href="' + div + '"></a></div>';
                        } else {
                            document.getElementById('bus_act').disabled = false;
                            $('#vinculos').addClass('hidden');
                        }

                        document.getElementById('uno').value = fecha_ent;
                        document.getElementById('dos').value = fecha_sal;

                        $loading.waitMe('hide');
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {

                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                    }
                });
    });

    function sumDias(fecha, numDias) {
        fecha.setDate(fecha.getDate() + numDias);
        return fecha;
    }

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

                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                    }
                });
    });
    $('#reservacionservicios-servicio').change(function(e) {
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        var id = $('#reservacionservicios-servicio').val();
        $.get(base_url_subprueba, {id: id}, null, "json")
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

                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
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
        $.get(base_url_sub, {id: servicio}, null, "json")
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

                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                    }
                });
    });



    $("#id_serv").change(function(e) {
        var servicio = $("#id_serv").val();
        $.get(base_url_sub, {id: servicio}, null, "json")
                .done(function(data, textStatus, jqXHR) {
                    if (console && console.log) {

                        pasadia(data);
                    }


                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {

                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                    }
                });
    });


    $("#ingles").change(function(e) {
        e.preventDefault();
        if (document.getElementById('ingles').checked) {
            document.getElementById('frances').disabled = true;
        } else {
            document.getElementById('frances').disabled = false;
        }

    });



    $("#frances").change(function(e) {
        e.preventDefault();
        if (document.getElementById('frances').checked) {
            document.getElementById('ingles').disabled = true;
        } else {
            document.getElementById('ingles').disabled = false;
        }

    });



    $("#ingles_pasa").change(function(e) {
        e.preventDefault();
        if (document.getElementById('ingles_pasa').checked) {
            document.getElementById('frances_pasa').disabled = true;
        } else {
            document.getElementById('frances_pasa').disabled = false;
        }
    });

    $("#frances_pasa").change(function(e) {
        e.preventDefault();
        if (document.getElementById('frances_pasa').checked) {
            document.getElementById('ingles_pasa').disabled = true;
        } else {
            document.getElementById('ingles_pasa').disabled = false;
        }

    });



    $("#gastos_salida").change(function(e) {
        e.preventDefault();
        document.getElementById('gastos_rep').disabled = false;

    });





    /* VALIDAR LOS FORM Q NO SON DEL YII*/


    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una dirección de correo valida",
        url: "Por favor, escribe una URL valida.",
        date: "Por favor, escribe una fecha valida.",
        dateISO: "Por favor, escribe una fecha (ISO) valida.",
        number: "Por favor, escribe un numero.",
        digits: "Por favor, escribe solo digitos.",
        creditcard: "Por favor, escribe un numero de tarjeta valido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        accept: "Por favor, escribe un valor con una extension aceptada.",
        maxlength: jQuery.validator.format("Por favor, no escribas mas de {0} caracteres."),
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
            'preciosub23': {
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


    /*$('#repagencia_validar').validate({
     highlight: function(input) {
     $(input).parents('.form-line').addClass('error');
     },
     unhighlight: function(input) {
     $(input).parents('.form-line').removeClass('error');
     },
     errorPlacement: function(error, element) {
     $(element).parents('.form-group').append(error);
     }
     });*/





    $('#horizontalTab').responsiveTabs();

    //$('#horizontalTab').responsiveTabs('activate', 1);

//    $('#id_tabprevia').click(function(e) {
//       alert('ddd');
//        $('#horizontalTab').responsiveTabs('activate', 1);
//    });


    $("#rep_agencia").select2();

    $("#reservacion-agencia").select2();

    $("#pasadia-agencia").select2();


    $("#add_gastos").select2();


    $("#id_serv").select2();
    $("#id_func").select2();

    $("#gastos_rep").select2();

    $("#pasadia_servicio").select2();

    $("#rep_servicios").select2();

    $("#general_agencia").select2();

    $("#general_servicios").select2();

    $("#trabajador-dpto").select2();

    $("#pasadia_agencia2").select2();





    $('#rep_agencia').change(function(e) {
        var agencia = document.getElementById("rep_agencia").value;
        var inicial = document.getElementById("rep_inicial").value;

        $.get(base_url_cliente, {id: agencia, fecha: inicial}, null, "json")
                .done(function(data, textStatus, jqXHR) {
                    if (console && console.log) {
                        var sub = document.getElementById('rep_cliente');


                        /*  REVISARA EL CODIGO Q ESTA MAL*/
                        sub += '<select name="rep_cliente" id="rep_cliente"  class="form-control show-tick">';
                        sub += "<option value='0'>Elija cliente</option>";
                        var mos = data;
                        for (var i = 0; i < mos.length; i++) {
                            sub += "<option value='" + mos[i]['id'] + "'>" + mos[i]['nombre'] + "</option>";
                        }


                        sub += '</select>';
                        $("#rep_cliente").html(sub);

                    }


                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {

                        UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                    }
                });



    });


    $('#incluir').change(function(e) {
        if (document.getElementById('incluir').checked) {
            document.getElementById('rdingresos').disabled = true;
            alert('ESTAS SEGURO QUE NO DESEA INCLUIRLO EN LA FACTURA');

        } else {
            document.getElementById('rdingresos').disabled = false;
        }
    })

    $('#rdingresos').change(function(e) {
        if (document.getElementById('rdingresos').checked) {
            document.getElementById('incluir').disabled = true;
            alert('ESTAS SEGURO QUE NO DESEA INCLUIRLO EN LOS INGRESOS');
        } else {
            document.getElementById('incluir').disabled = false;
        }
    })



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


$('#rep_servicios').change(function(e) {
    var serv = document.getElementById("rep_servicios").value;

    $.get(base_url_sub, {id: serv}, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {


                    var sub = "";
                    sub += '<select name="rep_subservicios" id="rep_subservicios"  class="form-control show-tick">';
                    sub += "<option value='0'>Elija primero servicio</option>";
                    var mos = data;
                    for (var i = 0; i < mos.length; i++) {
                        sub += "<option value='" + mos[i]['id'] + "'>" + mos[i]['nombre'] + "</option>";
                    }


                    sub += '</select>';
                    $("#add_rep_subservicios").html(sub);



                }


            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                }
            });



});




$('#general_servicios').change(function(e) {

    var serv = document.getElementById("general_servicios").value;

    $.get(base_url_sub, {id: serv}, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {


                    var sub = "";
                    sub += '<select name="general_subservicios" id="general_subservicios"  class="form-control show-tick">';
                    sub += "<option value='0'>Elija primero servicio</option>";
                    var mos = data;
                    for (var i = 0; i < mos.length; i++) {
                        sub += "<option value='" + mos[i]['id'] + "'>" + mos[i]['nombre'] + "</option>";
                    }


                    sub += '</select>';
                    $("#add_general_subservicios").html(sub);



                }


            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                }
            });



});



$('#reservacion-agencia').change(function(e) {
    var nom = document.getElementById("reservacion-agencia").value;


    $.get(base_url_aloj, {id: nom}, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {
                    if (data.status === 'Si') {
                        document.getElementById('conjunto').checked = true;
                    } else {
                        document.getElementById('conjunto').checked = false;
                    }
                }


            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {

                    UIkit.notify('<i class="fa fa-warning"></i><strong> Attention!</strong> ' + errorThrown, {timeout: 0, status: 'danger', pos: 'bottom-right'});
                }
            });


});


function prueba() {
    var fecha = document.getElementById("check").value.split("-");
   
    var num = parseInt(fecha[0]);
    var num_mes = parseInt(fecha[1]);

    var fe = parseInt(moment().format("DD"));
    var mes = parseInt(moment().format("MM"));
   
    if (num_mes < mes) {
        var result = confirm("YA IMPRIMIO EL COMPROBANTE");
        if (result) {
            return true;
        } else {
            return false;
        }
    }

    if (num <= fe && (num_mes < mes || num_mes == mes) ) {
        var result = confirm("YA IMPRIMIO EL COMPROBANTE");
        if (result) {
            return true;
        } else {
            return false;
        }
    } else {
        alert("LA RESERVACION NO TIENE SALIDA PARA EL DIA DE HOY. DEBE MODIFICAR FECHA DE SALIDA");
        return false;
    }
    
}



/*ESTO ES PARA SELECCIONAR EN LA TABLA*/

window.onload = function() {
    function highlight(e) {
        if (selected[0])
            selected[0].className = '';
        e.target.parentNode.className = 'selected';
    }
    var table = document.getElementById('table'),
            selected = table.getElementsByClassName('selected');
    table.onclick = highlight;

    $("#tst").click(function() {
        var value = $(".selected td:first").html();
        value = value || "No row Selected";
        alert(value);
    });
};
