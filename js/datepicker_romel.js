
$( ".datepicker" ).datepicker({
      dateFormat : 'dd-mm-yy',
      changeYear: true,
      maxDate: "+0d",
      minDate: new Date(2018, 1 - 1, 1),
      monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
      dayNamesMin: [ "Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ]

});	