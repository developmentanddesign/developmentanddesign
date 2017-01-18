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
            url: "views/allalbumsajax.php",
            type: "GET",
            data: {edit : id},
            success: function(data) {
             $('.albumdata').html(data);
             disablesubmit();
            }
        });
    });
    
    // update album Form Submit
    $('.update-btn').click(function(){
        var dataimg = new FormData();
        dataimg.append('cover', $('#file1')[0].files[0]);
        dataimg.append('id', $('#id1').val());
        dataimg.append('title', $('#title1').val());
        dataimg.append('imgold', $('#img1').val());
        dataimg.append('form', $('#form1').val());
            $.ajax({
                url : 'ajax/albumajax.php',
                type: 'post',
                data :dataimg,
                processData: false,
                contentType: false
            }).done(function(response){ //
                $("#result").html(response);
                $.ajax({
                    url: "views/allalbumsajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.albumdata').html(data);
                     disablesubmit();
                     $(".image-preview-input-title").text("Browse");
                    }
                });
            });
    });
    
    
    //Image Preview Code starts
    $(document).on('click', '#close-preview-new', function(){ 
        $('.image-preview-new').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
               $('.image-preview-new').popover('show');
            }, 
             function () {
               $('.image-preview-new').popover('hide');
            }
        );    
    });
        
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview-new',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    
    // Set the popover default content
    $('.image-preview-new').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    
    // Clear event
    $('.image-preview-clear-new').click(function(){
        $('.image-preview-new').attr("data-content","").popover('hide');
        $('.image-preview-filename-new').val("");
        $('.image-preview-clear-new').hide();
        $('.image-preview-input-new input:file').val("");
        $(".image-preview-input-title-new").text("Browse"); 
    }); 
    
    // Create the preview image
    $(".image-preview-input-new input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        
    // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title-new").text("Change");
            $(".image-preview-clear-new").show();
            $(".image-preview-filename-new").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview-new").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
    //Image Preview Code Ends