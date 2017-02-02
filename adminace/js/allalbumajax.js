// initialize datatable on adalbums page
   $('#example2').DataTable({
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
    // popover
    
    //deleteimagefilter('#filter'); function
    $('.delete').click(function(){
    var id= $(this).attr('id');
    var href= $(this).attr('data-href');
    $('.del-confirm').attr('href',href+id);
    });
    
    // cancle update
    $('.cancle').click(function(){
        //get all albums 
        $.ajax({
                url: "views/allalbumsajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                $("#result").html('');
                 $('.albumdata').html(data);
                }
            });
        //get all albums
    });
    // cancle update
    
    // edit album function in same field 
    $('.edit-btn').click(function(){
        var id= $(this).attr('id');
        $.ajax({
            url: "views/editalbumajax.php",
            type: "POST",
            data: {edit : id},
            beforeSend: function(){
                 $('.cssload-whirlpool1').show();
                 $('.addform').fadeTo(0,0.1);
             },
            success: function(data) {
             $('.form-box').html(data);
             $('.cssload-whirlpool1').delay(2000).fadeOut();
             $('.addform').delay(2000).fadeTo(0, 1);
             disablesubmit();
            }
        });
    });
    
    //call to localdate function
   //getting local datetime
    setInterval(localdate(), 1000);
    
    
    // update album Form Submit
    $('.update-btn').click(function(){
        var dataimg = new FormData();
        dataimg.append('cover', $('#file1')[0].files[0]);
        dataimg.append('id', $('#id1').val());
        dataimg.append('date', $('#localdate').val());
        dataimg.append('title', $('#title1').val());
        dataimg.append('imgold', $('#img1').val());
        dataimg.append('form', $('#form1').val());
            $.ajax({
                url : 'ajax/albumajax.php',
                type: 'post',
                data :dataimg,
                processData: false,
                contentType: false,
            beforeSend: function(){
                 $('.cssload-whirlpool').show();
                 $('.album-box').fadeTo(0,0.1);
             }
            }).done(function(response){ //
                $("#result").html(response);
                $.ajax({
                    url: "views/allalbumsajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.albumdata').html(data);
                     $('.cssload-whirlpool').delay(2000).fadeOut();
                     $('.album-box').delay(2000).fadeTo(0, 1);
                     disablesubmit();
                     $(".image-preview-input-title").text("Browse");
                    }
                });
            });
    });
    
    
   