<script type="text/javascript" charset="utf-8" src="display/javascript/jquery-1.11.0.min.js"></script>
<script type="text/javascript" charset="utf-8" src="display/javascript/jquery-ui-1.10.4.custom.min.js"></script>

<link rel="stylesheet" type="text/css" href="display/javascript/DataTables-1.10.12/media/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="display/javascript/DataTables-1.10.12/media/js/jquery.dataTables.min.js"></script>

<!-- Gestion des cookies -->
<script type="text/javascript" src="display/javascript/js.cookie.js"></script>

<style type="text/css" > 
@import "display/CSS/jquery-ui-1.10.4.custom.css";
</style>
<!--  Definition des balises titre et du datepicker par defaut -->
<script>
$(document).ready(function() {
	$('.taux,nombre').attr('title','{$LANG[message].34}');
	<!--$('.taux').attr('placeholder', '100, 95.5...');-->
	$(".date").datepicker( { dateFormat: "dd/mm/yy" } );
	$('.taux').attr( {
		'pattern': '[0-9]+(\.[0-9]+)?',
		'maxlength' : "10"
	} );
	$('.nombre').attr( {
		'pattern': '[0-9]+',
		'maxlength' : "10"
	}
	);
	$('.timepicker').attr('pattern', '[0-9][0-9]\:[0-9][0-9]\:[0-9][0-9]');
} ) ;
</script>