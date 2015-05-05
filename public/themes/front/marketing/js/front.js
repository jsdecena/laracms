$(document).ready(function(){
	$('#btn_search').click(function(){
		$(this).closest('form').submit();

		return false;
	});
});