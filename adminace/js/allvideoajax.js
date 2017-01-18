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
    
    //deleteimagefilter('#filter'); function
    $('.delete').click(function(){
    var id= $(this).attr('id');
    var href= $(this).attr('data-href');
    $('.del-confirm').attr('href',href+id);
    });
    
    // edit album function in same field 
    $('.edit-btn').click(function(){
        var id= $(this).attr('id');
        $.ajax({
            url: "views/allvideoajax.php",
            type: "GET",
            data: {edit : id},
            success: function(data) {
             $('.videodata').html(data);
             disablesubmit();
            }
        });
    });
    
    // update album Form Submit
    $('.update-btn').click(function(){
        var dataimg = new FormData();
        dataimg.append('title', $('#title1').val());
        dataimg.append('url', $('#url').val());
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
    });
    