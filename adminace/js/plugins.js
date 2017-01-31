$(function () {
    $('#example').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      responsive: true,
      columnDefs: [
          { responsivePriority: 1, targets: 0 },
          { responsivePriority: 2, targets: -1 }
      ]
    });
    
    // datepicker for slider start date
    $('#s_date').datepicker({
      autoclose: true
    });
    
    // datepicker for slider end date
	 $('#e_date').datepicker({
      autoclose: true
    });
    
    // html Editor
    CKEDITOR.replace('editor1');
    
    // Custom select box select 2
    $(".select2").select2();
    
    
    
});