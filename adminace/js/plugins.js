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
});