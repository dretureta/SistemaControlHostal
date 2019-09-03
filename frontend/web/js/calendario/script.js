
$(document).ready(function() {



    $.get('http://localhost/sistema/frontend/web/index.php?r=site%2Fcalendar', {}, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {
                    //console.log("La solicitud se ha completado correctamente. " + data[0]['end']);


                    /*FUNCION QUE PINTA EL CALENADRIO  */
                    $(function() {
                        /* initialize the external events
                         -----------------------------------------------------------------*/
                        function ini_events(ele) {
                            ele.each(function() {

                                var eventObject = {
                                    title: $.trim($(this).text()) // use the element's text as the event title
                                };
                                // store the Event Object in the DOM element so we can get to it later
                                $(this).data('eventObject', eventObject);
                                // make the event draggable using jQuery UI
                                $(this).draggable({
                                    zIndex: 1070,
                                    revert: true, // will cause the event to go back to its
                                    revertDuration: 0  //  original position after the drag
                                });
                            });
                        }

                        ini_events($('#external-events div.external-event'));
                        /* initialize the calendar
                         -----------------------------------------------------------------*/

                        $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            buttonText: {
                                today: 'Hoy',
                                month: 'Mes',
                                week: 'Semana',
                                day: 'Dia'
                            },
                            //Random default events
                            //datos = [],
                            events: data,
                            editable: false,
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            drop: function(date, allDay) { // this function is called when something is dropped

                                // retrieve the dropped element's stored Event Object
                                var originalEventObject = $(this).data('eventObject');
                                // we need to copy it, so that multiple events don't have a reference to the same object
                                var copiedEventObject = $.extend({}, originalEventObject);
                                // assign it the date that was reported
                                copiedEventObject.start = date;
                                copiedEventObject.allDay = allDay;
                                copiedEventObject.backgroundColor = $(this).css("background-color");
                                copiedEventObject.borderColor = $(this).css("border-color");
                                // render the event on the calendar
                                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                                // is the "remove after drop" checkbox checked?
                                if ($('#drop-remove').is(':checked')) {
                                    // if so, remove the element from the "Draggable Events" list
                                    $(this).remove();
                                }

                            },
                            eventClick: function(event) {

                                alert(JSON.stringify(event.id));

                          }
                        });
                    });

                }
            })

            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + textStatus);

                }
            });
            
            
            
            
            
            /* CALENDARIO PASA DIAS*/
            
            
            $.get('http://localhost/sistema/frontend/web/index.php?r=site%2Fpasadia', {}, null, "json")
            .done(function(data, textStatus, jqXHR) {
                if (console && console.log) {
                    //console.log("La solicitud se ha completado correctamente. " + data[0]['end']);


                    /*FUNCION QUE PINTA EL CALENADRIO  */
                    $(function() {
                        /* initialize the external events
                         -----------------------------------------------------------------*/
                        function ini_events(ele) {
                            ele.each(function() {

                                var eventObject = {
                                    title: $.trim($(this).text()) // use the element's text as the event title
                                };
                                // store the Event Object in the DOM element so we can get to it later
                                $(this).data('eventObject', eventObject);
                                // make the event draggable using jQuery UI
                                $(this).draggable({
                                    zIndex: 1070,
                                    revert: true, // will cause the event to go back to its
                                    revertDuration: 0  //  original position after the drag
                                });
                            });
                        }

                        ini_events($('#external-events div.external-event'));
                        /* initialize the calendar
                         -----------------------------------------------------------------*/

                        $('#calendar_pasa').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            buttonText: {
                                today: 'Hoy',
                                month: 'Mes',
                                week: 'Semana',
                                day: 'Dia'
                            },
                            //Random default events
                            //datos = [],
                            events: data,
                            editable: false,
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            drop: function(date, allDay) { // this function is called when something is dropped

                                // retrieve the dropped element's stored Event Object
                                var originalEventObject = $(this).data('eventObject');
                                // we need to copy it, so that multiple events don't have a reference to the same object
                                var copiedEventObject = $.extend({}, originalEventObject);
                                // assign it the date that was reported
                                copiedEventObject.start = date;
                                copiedEventObject.allDay = allDay;
                                copiedEventObject.backgroundColor = $(this).css("background-color");
                                copiedEventObject.borderColor = $(this).css("border-color");
                                // render the event on the calendar
                                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                                // is the "remove after drop" checkbox checked?
                                if ($('#drop-remove').is(':checked')) {
                                    // if so, remove the element from the "Draggable Events" list
                                    $(this).remove();
                                }

                            },
                            eventClick: function(event) {

                                alert(JSON.stringify(event.id));

                          }
                        });
                    });

                }
            })

            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + textStatus);

                }
            });








});
