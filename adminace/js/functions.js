$(function () {
    $('#example').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    $('#s_date').datepicker({
      autoclose: true
    });
	 $('#e_date').datepicker({
      autoclose: true
    });
    $('.delete').click(function(){
    var id= $(this).attr('id');
    $('.del-confirm').attr('href','allslides.php?del='+id);
    });
    $('#myModal').on('shown.bs.modal', function () {
    })
  });