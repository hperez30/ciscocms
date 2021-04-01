		</div>
		<script type="text/javascript" src="/js/main.js"></script>
		<script type="text/javascript" src="/js/popper.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/js/all.js"></script>
		<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
		<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> -->
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="http://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
		<link rel="stylesheet" href="/css/bootstrap-datepicker3.css"/>
		<script>
			$(document).ready(function(){
				var date_input=$('input[name="fecha"]'); //our date input has the name "date"
				var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
				date_input.datepicker({
					format: 'dd/mm/yyyy',
					container: container,
					todayHighlight: true,
					autoclose: true,
				})
				var dtable = $("#product-list").dataTable().api();

				// Grab the datatables input box and alter how it is bound to events
				$(".dataTables_filter input")
					.unbind() // Unbind previous default bindings
					.bind("input", function(e) { // Bind our desired behavior
						// If the length is 3 or more characters, or the user pressed ENTER, search
						if(this.value.length >= 3 || e.keyCode == 13) {
							// Call the API search function
							dtable.search(this.value).draw();
						}
						// Ensure we clear the search if they backspace far enough
						if(this.value == "") {
							dtable.search("").draw();
						}
						return;
					});
				
			})
		</script>
		<script>
		    var t = $('#product-list').DataTable({
				 "language":	{
					"sProcessing":     "Procesando...",
					"sLengthMenu":     "Mostrar _MENU_ registros",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":    "",
					"sSearch":         "Buscar:",
					"sUrl":            "",
					"sInfoThousands":  ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst":    "Primero",
						"sLast":     "Último",
						"sNext":     "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}},
			"processing": true,
			"serverSide": true,
			"ordering": false,
			"ajax": {
				url : "<?php echo URLROOT;?>/cospaces/getCoSpaces",
				type : 'GET',
				dataType: 'json'
				
			},
			 columns :[
				{data: 'id'},
				{data: 'nombre'},
				{data: 'uri'},
				{data: 'acciones'}]
			
    });
    
   // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
</script>
	</body>
</html>
