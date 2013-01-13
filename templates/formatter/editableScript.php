<script>
	$('span.editable').each(function(){
	    var key = $(this).data().pk, type = $(this).data().type;
	    $(this).editable({ url: '/epicms/admin/'+key+'/'+type, placement: 'bottom' });
	});
</script>