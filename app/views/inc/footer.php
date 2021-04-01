		</div>
		<script type="text/javascript" src="/js/main.js"></script>
		<script type="text/javascript" src="/js/popper.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/js/all.js"></script>
		<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
		<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/js/dataTables.bootstrap.min.js"></script>
		<link rel="stylesheet" href="/css/bootstrap-datepicker3.css"/>
		
		<script>
			$(document).ready(function()
			{
				var date_input=$('input[name="fecha"]'); //our date input has the name "date"
				var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
				date_input.datepicker({
					format: 'dd/mm/yyyy',
					container: container,
					todayHighlight: true,
					autoclose: true,
				})
			})
		</script>
	</body>
</html>
