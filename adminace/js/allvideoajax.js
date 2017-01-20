// initialize datatable on adalbums page
   $('#example4').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    
    // popover
    $('[data-toggle="popover"]').popover({
        placement : 'top',
        trigger : 'hover'
    });  
    
    //delete video function
    $('.delete').click(function(){
    var id= $(this).attr('id');
    var href= $(this).attr('data-href');
    $('.del-confirm').attr('href',href+id);
    });
     //delete video function
    
   // popover
    $('[data-toggle="popover"]').popover({
        placement : 'top',
        trigger : 'hover'
    });
     // popover
     
    //getting local datetime
    setInterval(localdate(), 1000);
     
    // update video Form Submit
    function updateVideo(){
        var dataimg = new FormData();
        dataimg.append('id', $('#id').val());
        dataimg.append('date', $('#localdate').val());
        dataimg.append('title', $('#title1').val());
        dataimg.append('form', "update");
            $.ajax({
                url : 'ajax/videosajax.php',
                type: 'post',
                data :dataimg,
                processData: false,
                contentType: false
            }).done(function(response){ //
                $("#result").html(response);
                $.ajax({
                    url: "views/allvideoajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.videodata').html(data);
                        disablesubmit();
                    }
                });
            });
    }
    // update video Form Submit